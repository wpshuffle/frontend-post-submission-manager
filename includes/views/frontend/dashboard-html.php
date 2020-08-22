<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
$current_user_id = get_current_user_id();
$post_statuses = get_post_statuses();
if ( !empty( $current_user_id ) ) {
    ?>
    <div class="fpsm-dashboard-wrap">
        <div class="fpsm-dashboard-header">
            <div class="fpsm-dashboard-row">
                <div class="fpsm-dashboard-column"><?php echo (!empty( $form_details['dashboard']['sn_label'] )) ? esc_html( $form_details['dashboard']['sn_label'] ) : esc_html__( 'SN', 'frontend-post-submission-manager' ); ?></div>
                <div class="fpsm-dashboard-column"><?php echo (!empty( $form_details['dashboard']['post_title_label'] )) ? esc_html( $form_details['dashboard']['post_title_label'] ) : esc_html__( 'Post Title', 'frontend-post-submission-manager' ); ?></div>
                <div class="fpsm-dashboard-column"><?php echo (!empty( $form_details['dashboard']['post_status_label'] )) ? esc_html( $form_details['dashboard']['post_status_label'] ) : esc_html__( 'Post Status', 'frontend-post-submission-manager' ); ?></div>
                <div class="fpsm-dashboard-column"><?php echo (!empty( $form_details['dashboard']['last_modified_label'] )) ? esc_html( $form_details['dashboard']['last_modified_label'] ) : esc_html__( 'Last Modified', 'frontend-post-submission-manager' ); ?></div>
                <div class="fpsm-dashboard-column"><?php echo (!empty( $form_details['dashboard']['action_label'] )) ? esc_html( $form_details['dashboard']['action_label'] ) : esc_html__( 'Action', 'frontend-post-submission-manager' ); ?></div>
            </div>
        </div>
        <div class="fpsm-dashboard-body">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $posts_per_page = (!empty( $form_details['dashboard']['posts_per_page'] )) ? $form_details['dashboard']['posts_per_page'] : 20;
            $dashboard_posts_args = array(
                'posts_per_page' => $posts_per_page,
                'orderby' => 'date',
                'order' => 'desc',
                'author' => $current_user_id,
                'post_status' => array( 'publish', 'pending', 'draft' ),
                'meta_key' => '_fpsm_form_alias',
                'meta_value' => $alias,
                'paged' => $paged
            );
            $dashboard_posts_query = new WP_Query( $dashboard_posts_args );

            if ( $dashboard_posts_query->have_posts() ) {
                $sn = 1;
                while ( $dashboard_posts_query->have_posts() ) {
                    $dashboard_posts_query->the_post();
                    ?>
                    <div class="fpsm-dashboard-row">
                        <div class="fpsm-dashboard-column"><?php echo esc_html( $sn++ ); ?></div>
                        <div class="fpsm-dashboard-column"><?php the_title(); ?></div>
                        <div class="fpsm-dashboard-column"><span class="fpsm-status-<?php echo esc_attr( get_post_status() ); ?>"><?php echo esc_html( $post_statuses[get_post_status()] ); ?></span></div>
                        <div class="fpsm-dashboard-column"><?php echo esc_html( get_the_modified_date( 'd-m-Y g:i a' ) ); ?></div>
                        <div class="fpsm-dashboard-column">
                            <?php
                            $current_page_url = $fpsm_library_obj->get_current_page_url();
                            $post_id = get_the_ID();
                            $post_edit_url = $fpsm_library_obj->get_post_edit_url( $post_id );
                            $post_edit_flag = true;
                            $post_status = get_post_status();
                            if ( !empty( $form_details['dashboard']['disable_post_edit'] ) && $post_status == 'publish' ) {
                                $post_edit_flag = false;
                            }
                            if ( $post_edit_flag ) {
                                ?>
                                <a href="<?php echo esc_url( $post_edit_url ); ?>" title="<?php esc_html_e( 'Edit', 'frontend-post-submission-manager' ); ?>" class="fpsm-edit-post"><i class="fas fa-pencil-alt"></i></a>
                                <?php
                            }
                            if ( empty( $form_details['dashboard']['disable_post_delete'] ) ) {
                                $post_delete_warning_message = (!empty( $form_details['dashboard']['post_delete_warning_message'] )) ? $form_details['dashboard']['post_delete_warning_message'] : esc_html__( 'Are you sure you want to delete this post?', 'frontend-post-submission-manager' );
                                $delete_key = md5( get_the_date( 'd-m-y H:i a' ) );
                                ?>
                                <a href="javascript:void(0);" title="<?php esc_html_e( 'Delete', 'frontend-post-submission-manager' ); ?>" class="fpsm-delete-post" data-warning-message="<?php echo esc_attr( $post_delete_warning_message ); ?>" data-delete-key="<?php echo esc_attr( $delete_key ); ?>" data-post-id="<?php the_ID(); ?>"><i class="far fa-trash-alt"></i></a>
                            <?php } ?>
                            <a href="<?php the_permalink(); ?>" title="<?php esc_html_e( 'View', 'frontend-post-submission-manager' ); ?>" class="fpsm-view-post"><i class="far fa-eye"></i></a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php if ( $dashboard_posts_query->max_num_pages > 1 ) { ?>
            <div class="fpsm-pagination-wrap">
                <?php
                $big = 999999999; // need an unlikely integer
                $translated = __( 'Page', 'frontend-post-submission-manager' ); // Supply translatable string
                $page_num_link = explode( '?', esc_url( get_pagenum_link( $big ) ) );
                if ( !empty( $_GET ) ) {
                    $page_num_link = $page_num_link[0] . '?' . http_build_query( $_GET );
                } else {
                    $page_num_link = $page_num_link[0];
                }
                $previous_text = (!empty( $form_details['dashboard']['previous_page_label'] )) ? esc_html( $form_details['dashboard']['previous_page_label'] ) : esc_html__( 'Previous', 'frontend-post-submission-manager' );
                $next_text = (!empty( $form_details['dashboard']['next_page_label'] )) ? esc_html( $form_details['dashboard']['next_page_label'] ) : esc_html__( 'Next', 'frontend-post-submission-manager' );
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', $page_num_link ),
                    'format' => '?%#%',
                    'current' => max( 1, get_query_var( 'paged' ) ),
                    'total' => $dashboard_posts_query->max_num_pages,
                    'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>',
                    'prev_text' => $previous_text,
                    'next_text' => $next_text,
                ) );
                ?>
            </div>
        <?php
        }
        wp_reset_query();
        wp_reset_postdata();
        ?>
    </div>
<?php } ?>
