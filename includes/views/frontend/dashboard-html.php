<?php
defined('ABSPATH') or die('No script kiddies please!!');
$current_user_id = get_current_user_id();
if (!empty($current_user_id)) {
    ?>
    <div class="fpsm-dashboard-wrap">
        <div class="fpsm-dashboard-header">
            <div class="fpsm-dashboard-row">
                <div class="fpsm-dashboard-column"><?php esc_html_e('SN', 'frontend-post-submission-manager'); ?></div>
                <div class="fpsm-dashboard-column"><?php esc_html_e('Post Title', 'frontend-post-submission-manager'); ?></div>
                <div class="fpsm-dashboard-column"><?php esc_html_e('Post Status', 'frontend-post-submission-manager'); ?></div>
                <div class="fpsm-dashboard-column"><?php esc_html_e('Last Modified', 'frontend-post-submission-manager'); ?></div>
                <div class="fpsm-dashboard-column"><?php esc_html_e('Action', 'frontend-post-submission-manager'); ?></div>
            </div>
        </div>
        <?php
        $dashboard_posts_args = array(
            'posts_per_page' => 20,
            'orderby' => 'date',
            'order' => 'desc',
            'author' => $current_user_id,
            'post_status' => array('publish', 'pending', 'draft'),
            'meta_key' => '_fpsm_form_alias',
            'meta_value' => $alias
        );
        $dashboard_posts_query = new WP_Query($dashboard_posts_args);

        if ($dashboard_posts_query->have_posts()) {
            $sn = 1;
            while ($dashboard_posts_query->have_posts()) {
                $dashboard_posts_query->the_post();
                ?>
                <div class="fpsm-dashboard-row">
                    <div class="fpsm-dashboard-column"><?php esc_html($sn); ?></div>
                    <div class="fpsm-dashboard-column"><?php the_title(); ?></div>
                    <div class="fpsm-dashboard-column"><?php echo get_post_status(); ?></div>
                    <div class="fpsm-dashboard-column"><?php echo get_the_modified_date('d-m-Y g:i a'); ?></div>
                    <div class="fpsm-dashboard-column">
                        <?php
                        $current_page_url = $fpsm_library_obj->get_current_page_url();
                        $post_id = get_the_ID();
                        $post_edit_url = $fpsm_library_obj->get_post_edit_url($post_id);
                        ?>
                        <a href="<?php echo esc_url($post_edit_url); ?>" title="<?php esc_html_e('Edit', 'frontend-post-submission-manager'); ?>"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);" title="<?php esc_html_e('Delete', 'frontend-post-submission-manager'); ?>"><i class="far fa-trash-alt"></i></a>
                        <a href="<?php the_permalink(); ?>" title="<?php esc_html_e('View', 'frontend-post-submission-manager'); ?>"><i class="far fa-eye"></i></a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
<?php } ?>
