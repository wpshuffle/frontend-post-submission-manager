<?php
defined('ABSPATH') or die('No script kiddies please!!');

$add_form_url = admin_url('admin.php?page=fpsm-add-new-form');
$docs_url = 'https://wpshuffle.com/wordpress-documentations/frontend-post-submission-manager/';
$demo_url = 'https://demo.wpshuffle.com/frontend-post-submission-manager/';
?>
<section class="fpsm-quick-start" aria-labelledby="fpsm-quick-start-title">
    <form class="fpsm-quick-start__dismiss-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <input type="hidden" name="action" value="fpsm_dismiss_quick_start" />
        <?php wp_nonce_field('fpsm_dismiss_quick_start'); ?>
        <button class="fpsm-quick-start__dismiss" type="submit">
            <span class="dashicons dashicons-no-alt" aria-hidden="true"></span>
            <span class="screen-reader-text"><?php esc_html_e('Dismiss Quick Start', 'frontend-post-submission-manager'); ?></span>
        </button>
    </form>

    <div class="fpsm-quick-start__intro">
        <span class="fpsm-quick-start__eyebrow"><?php esc_html_e('Quick Start', 'frontend-post-submission-manager'); ?></span>
        <h2 id="fpsm-quick-start-title"><?php esc_html_e('Publish your first frontend submission form', 'frontend-post-submission-manager'); ?></h2>
        <p><?php esc_html_e('Follow these four steps to create a form, place it on a page, and verify the complete submission experience.', 'frontend-post-submission-manager'); ?></p>
    </div>

    <ol class="fpsm-quick-start__steps">
        <li>
            <span class="fpsm-quick-start__step-number" aria-hidden="true">1</span>
            <div>
                <h3><?php esc_html_e('Create Form', 'frontend-post-submission-manager'); ?></h3>
                <p><?php esc_html_e('Choose the post type and whether visitors must log in.', 'frontend-post-submission-manager'); ?></p>
            </div>
        </li>
        <li>
            <span class="fpsm-quick-start__step-number" aria-hidden="true">2</span>
            <div>
                <h3><?php esc_html_e('Add Fields', 'frontend-post-submission-manager'); ?></h3>
                <p><?php esc_html_e('Add and arrange the fields needed for your submission workflow.', 'frontend-post-submission-manager'); ?></p>
            </div>
        </li>
        <li>
            <span class="fpsm-quick-start__step-number" aria-hidden="true">3</span>
            <div>
                <h3><?php esc_html_e('Publish Shortcode', 'frontend-post-submission-manager'); ?></h3>
                <p><?php esc_html_e('Copy the generated shortcode into the page where the form should appear.', 'frontend-post-submission-manager'); ?></p>
            </div>
        </li>
        <li>
            <span class="fpsm-quick-start__step-number" aria-hidden="true">4</span>
            <div>
                <h3><?php esc_html_e('Test Submission', 'frontend-post-submission-manager'); ?></h3>
                <p><?php esc_html_e('Submit one test entry and confirm the expected post status and notifications.', 'frontend-post-submission-manager'); ?></p>
            </div>
        </li>
    </ol>

    <div class="fpsm-quick-start__actions">
        <a class="button button-primary button-hero" href="<?php echo esc_url($add_form_url); ?>">
            <?php esc_html_e('Add New Form', 'frontend-post-submission-manager'); ?>
        </a>
        <a class="button button-secondary" href="<?php echo esc_url($docs_url); ?>" target="_blank" rel="noopener noreferrer">
            <?php esc_html_e('Read Documentation', 'frontend-post-submission-manager'); ?>
        </a>
        <a class="fpsm-quick-start__demo" href="<?php echo esc_url($demo_url); ?>" target="_blank" rel="noopener noreferrer">
            <?php esc_html_e('View Demo', 'frontend-post-submission-manager'); ?>
            <span class="dashicons dashicons-external" aria-hidden="true"></span>
        </a>
    </div>
</section>
