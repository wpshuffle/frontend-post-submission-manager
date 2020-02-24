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
        <div class="fpsm-dashboard-body">
            <?php
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $dashboard_posts_args = array(
                'posts_per_page' => 2,
                'orderby' => 'date',
                'order' => 'desc',
                'author' => $current_user_id,
                'post_status' => array('publish', 'pending', 'draft'),
                'meta_key' => '_fpsm_form_alias',
                'meta_value' => $alias,
                'paged' => $paged
            );
            $dashboard_posts_query = new WP_Query($dashboard_posts_args);

            if ($dashboard_posts_query->have_posts()) {
                $sn = 1;
                while ($dashboard_posts_query->have_posts()) {
                    $dashboard_posts_query->the_post();
                    ?>
                    <div class="fpsm-dashboard-row">
                        <div class="fpsm-dashboard-column"><?php echo esc_html($sn++); ?></div>
                        <div class="fpsm-dashboard-column"><?php the_title(); ?></div>
                        <div class="fpsm-dashboard-column"><?php echo get_post_status(); ?></div>
                        <div class="fpsm-dashboard-column"><?php echo get_the_modified_date('d-m-Y g:i a'); ?></div>
                        <div class="fpsm-dashboard-column">
                            <?php
                            $current_page_url = $fpsm_library_obj->get_current_page_url();
                            $post_id = get_the_ID();
                            $post_edit_url = $fpsm_library_obj->get_post_edit_url($post_id);
                            ?>
                            <a href="<?php echo esc_url($post_edit_url); ?>" title="<?php esc_html_e('Edit', 'frontend-post-submission-manager'); ?>" class="fpsm-edit-post"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0);" title="<?php esc_html_e('Delete', 'frontend-post-submission-manager'); ?>" class="fpsm-delete-post"><i class="far fa-trash-alt"></i></a>
                            <a href="<?php the_permalink(); ?>" title="<?php esc_html_e('View', 'frontend-post-submission-manager'); ?>" class="fpsm-view-post"><i class="far fa-eye"></i></a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php if ($dashboard_posts_query->max_num_pages > 1) { ?>
            <div class="fpsm-pagination-wrap">
                <?php
                $big = 999999999; // need an unlikely integer
                $translated = __('Page', 'frontend-post-submission-manager'); // Supply translatable string
                $page_num_link = explode('?', esc_url(get_pagenum_link($big)));
                if (!empty($_GET)) {
                    $page_num_link = $page_num_link[0] . '?' . http_build_query($_GET);
                } else {
                    $page_num_link = $page_num_link[0];
                }

                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', $page_num_link),
                    'format' => '?%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $dashboard_posts_query->max_num_pages,
                    'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>',
                    'prev_text' => __('Previous', 'frontend-post-submission-manager'),
                    'next_text' => __('Next', 'frontend-post-submission-manager'),
                ));
                ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
