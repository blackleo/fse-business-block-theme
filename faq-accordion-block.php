<?php
/**
 * Plugin Name:       FAQ Accordion (Interactivity API)
 * Description:       An accessible FAQ accordion block built with the WordPress Interactivity API, with FAQPage schema for SEO.
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            Your Name
 * License:           MIT
 * Text Domain:       faq-accordion-block
 *
 * @package FaqAccordionBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block from the compiled block.json in /build.
 */
function faq_register_block() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'faq_register_block' );
