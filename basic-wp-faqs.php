<?php
/*
Plugin Name: Basic WP FAQs
Plugin URI:  https://github.com/jakejackson1/basic-wp-faqs
Description: A basic FAQs plugin for WordPress. This plugin was written for the June 2017 WP Port Macquarie Meetup.
Version:     0.1
Author:      Jake Jackson
Author URI:  https://github.com/jakejackson1
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: basic-wp-faqs
*/

/**
 * Register our FAQ Custom Post Type
 *
 * @since 0.1
 */
function bwpfaqs_register_cpt() {
    register_post_type( 'bwpfaqs', array(
        'label'    => __( 'FAQs', 'basic-wp-faqs' ),
        'show_ui'  => true,
        'supports' => array( 'title', 'editor' ),
    ) );
}

add_action( 'init', 'bwpfaqs_register_cpt' );

/**
 * Register our FAQ Shortcode
 *
 * @since 0.1
 */
function bwpfaqs_register_shortcode() {
    add_shortcode( 'bwpfaqs', 'bwpfaqs_render_shortcode' );
}

add_action( 'init', 'bwpfaqs_register_shortcode' );

/**
 * Generate our FAQs markup
 *
 * @since 0.1
 *
 * @Internal Shortcodes must ALWAYS return their output. Use output buffering to make this easy.
 *
 * @return string
 */
function bwpfaqs_render_shortcode() {

    /* Query the database for our FAQ posts */
    $faqs = new WP_Query( array(
        'post_type'      => 'bwpfaqs',
        'posts_per_page' => -1,
    ) );

    /* Enable output buffering to prevent any output being generated */
    ob_start();

    /* If any FAQ poss are found... */
    if ( $faqs->have_posts() ) { ?>

        <section class="bwpfaqs-container">

            <!-- Loop through our FAQ posts -->
            <?php while ( $faqs->have_posts() ) : $faqs->the_post(); ?>
                <article id="bwpfaqs-post-<?php echo get_the_ID(); ?>">

                    <!-- Display the FAQ Title -->
                    <h2 class="bwpfaqs-title"><?php the_title(); ?></h2>

                    <!-- Display the FAQ Content -->
                    <div class="bwpfaqs-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>

        </section>

        <?php
        /* Reset the original loop which was overridden when we used "the_post()" */
        wp_reset_postdata();
    }

    /* Get our output buffer and return the results */
    return ob_get_clean();
}
