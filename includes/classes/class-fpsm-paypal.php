<?php

defined('ABSPATH') or die('No script kiddies please!!');

if (!class_exists('FPSM_PayPal')) {
    class FPSM_PayPal {

        /**
         * Returns PayPal settings saved in options
         *
         * @return array
         */
        public function get_settings() {
            $settings = get_option('fpsm_settings');
            $paypal_settings = array(
                'mode' => (!empty($settings['paypal_mode'])) ? $settings['paypal_mode'] : 'sandbox',
                'client_id' => (!empty($settings['paypal_client_id'])) ? $settings['paypal_client_id'] : '',
                'secret' => (!empty($settings['paypal_secret'])) ? $settings['paypal_secret'] : '',
                'currency' => (!empty($settings['paypal_currency'])) ? $settings['paypal_currency'] : 'USD',
            );

            return $paypal_settings;
        }

        /**
         * Returns API base URL depending upon the mode
         *
         * @param string $mode
         * @return string
         */
        public function get_api_base($mode = 'sandbox') {
            return ($mode === 'live') ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';
        }

        /**
         * Returns PayPal access token
         *
         * @return array
         */
        public function get_access_token() {
            $settings = $this->get_settings();
            if (empty($settings['client_id']) || empty($settings['secret'])) {
                return array('success' => false, 'message' => esc_html__('PayPal credentials are missing', 'frontend-post-submission-manager'));
            }
            $cache_key = 'fpsm_paypal_token_' . md5($settings['client_id'] . $settings['mode']);
            $cached_token = get_transient($cache_key);
            if ($cached_token) {
                return array('success' => true, 'token' => $cached_token);
            }
            $api_base = $this->get_api_base($settings['mode']);
            $response = wp_remote_post(
                $api_base . '/v1/oauth2/token',
                array(
                    'headers' => array(
                        'Authorization' => 'Basic ' . base64_encode($settings['client_id'] . ':' . $settings['secret']),
                    ),
                    'body' => array(
                        'grant_type' => 'client_credentials',
                    ),
                    'timeout' => 30,
                )
            );
            if (is_wp_error($response)) {
                return array('success' => false, 'message' => $response->get_error_message());
            }
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (empty($body['access_token'])) {
                return array('success' => false, 'message' => esc_html__('Unable to fetch PayPal access token.', 'frontend-post-submission-manager'));
            }
            $expires = (!empty($body['expires_in'])) ? intval($body['expires_in']) : 3300;
            set_transient($cache_key, $body['access_token'], $expires);
            return array('success' => true, 'token' => $body['access_token']);
        }

        /**
         * Creates PayPal order
         *
         * @param array $args
         * @return array
         */
        public function create_order($args = array()) {
            $defaults = array(
                'amount' => 0,
                'currency' => 'USD',
                'description' => '',
            );
            $args = wp_parse_args($args, $defaults);
            $settings = $this->get_settings();
            $token_data = $this->get_access_token();
            if (empty($token_data['success'])) {
                return $token_data;
            }

            $payload = array(
                'intent' => 'CAPTURE',
                'purchase_units' => array(
                    array(
                        'amount' => array(
                            'currency_code' => $args['currency'],
                            'value' => number_format((float) $args['amount'], 2, '.', ''),
                        ),
                        'description' => $args['description'],
                    ),
                ),
            );

            $api_base = $this->get_api_base($settings['mode']);
            $response = wp_remote_post(
                $api_base . '/v2/checkout/orders',
                array(
                    'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token_data['token'],
                    ),
                    'body' => wp_json_encode($payload),
                    'timeout' => 30,
                )
            );
            if (is_wp_error($response)) {
                return array('success' => false, 'message' => $response->get_error_message());
            }
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (empty($body['id'])) {
                return array('success' => false, 'message' => esc_html__('Unable to create PayPal order.', 'frontend-post-submission-manager'));
            }
            return array('success' => true, 'order_id' => $body['id'], 'raw' => $body);
        }

        /**
         * Captures a PayPal order
         *
         * @param string $order_id
         * @return array
         */
        public function capture_order($order_id) {
            $settings = $this->get_settings();
            $token_data = $this->get_access_token();
            if (empty($token_data['success'])) {
                return $token_data;
            }
            $api_base = $this->get_api_base($settings['mode']);
            $response = wp_remote_post(
                $api_base . '/v2/checkout/orders/' . $order_id . '/capture',
                array(
                    'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token_data['token'],
                    ),
                    'timeout' => 30,
                )
            );
            if (is_wp_error($response)) {
                return array('success' => false, 'message' => $response->get_error_message());
            }
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if (empty($body['status'])) {
                return array('success' => false, 'message' => esc_html__('Unable to capture PayPal order.', 'frontend-post-submission-manager'));
            }
            return array('success' => true, 'data' => $body);
        }

        /**
         * Inserts or updates payment record
         *
         * @param array $data
         * @return void
         */
        public function upsert_payment($data) {
            global $wpdb;
            $table = $wpdb->prefix . 'fpsm_payments';
            $defaults = array(
                'post_id' => 0,
                'form_alias' => '',
                'amount' => 0,
                'currency' => 'USD',
                'status' => 'pending',
                'paypal_order_id' => '',
                'paypal_capture_id' => '',
                'payer_email' => '',
                'payer_id' => '',
                'meta' => '',
            );
            $data = wp_parse_args($data, $defaults);
            $existing = $wpdb->get_var($wpdb->prepare("SELECT payment_id FROM $table WHERE paypal_order_id = %s", $data['paypal_order_id']));
            if ($existing) {
                $wpdb->update(
                    $table,
                    array(
                        'status' => $data['status'],
                        'paypal_capture_id' => $data['paypal_capture_id'],
                        'payer_email' => $data['payer_email'],
                        'payer_id' => $data['payer_id'],
                        'meta' => $data['meta'],
                    ),
                    array('payment_id' => $existing),
                    array('%s', '%s', '%s', '%s', '%s'),
                    array('%d')
                );
                return;
            }
            $wpdb->insert(
                $table,
                array(
                    'post_id' => $data['post_id'],
                    'form_alias' => $data['form_alias'],
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'status' => $data['status'],
                    'paypal_order_id' => $data['paypal_order_id'],
                    'paypal_capture_id' => $data['paypal_capture_id'],
                    'payer_email' => $data['payer_email'],
                    'payer_id' => $data['payer_id'],
                    'meta' => $data['meta'],
                ),
                array('%d', '%s', '%f', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
            );
        }
    }

    $GLOBALS['fpsm_paypal_obj'] = new FPSM_PayPal();
}
