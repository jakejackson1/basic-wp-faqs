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
		'label'    => 'FAQs',
		'show_ui'  => true,
		'supports' => array( 'title', 'editor' ),
	) );
}

add_action( 'init', 'bwpfaqs_register_cpt' );
