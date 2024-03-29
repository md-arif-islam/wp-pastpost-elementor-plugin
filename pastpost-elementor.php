<?php
/*
Plugin Name: PastPost Elementor Plugin
Plugin URI:
Description:
<<<<<<< HEAD
Version: 3.1
=======
Version: 2.0
>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
Author: Arif Islam
Author URI: https://arifislam.vercel.app
License: GPLv2 or later
Text Domain: pastpostelementor
Domain Path: /languages/
*/


use \Elementor\Plugin as Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	die( __( "Direct Access is not allowed", 'pastpostelementor' ) );
}

final class ElementorCustomExtension {

	const VERSION = "1.0.0";
	const MINIMUM_ELEMENTOR_VERSION = "2.0.0";
	const MINIMUM_PHP_VERSION = "7.0";

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		load_plugin_textdomain( 'pastpostelementor' );

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );

			return;
		}

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( "elementor/frontend/after_enqueue_styles", [ $this, 'widget_styles' ] );
		add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'all_widgets_assets' ] );

	}

    function all_widgets_assets() {
        $plugin_version = "3.1";

        wp_enqueue_style('bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
        wp_enqueue_style('owl-carousel-css', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
        wp_enqueue_style('owl-carousel-theme-css', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
        wp_enqueue_style('fontawesome-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css');
        wp_enqueue_style('custom-elementor-css', plugins_url("/assets/css/style.css", __FILE__), null, $plugin_version);

        wp_enqueue_script('bootstrap-js', "//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js", ['jquery'], $plugin_version, true);
        wp_enqueue_script('owl-carousel-js', "//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js", ['jquery'], $plugin_version, true);
        wp_enqueue_script('custom-elementor-js', plugins_url("/assets/js/app.js", __FILE__), ['jquery'], $plugin_version, true);
    }


	function widget_styles() {
	}


	public function init_widgets() {
<<<<<<< HEAD

		require_once( __DIR__ . '/widgets/slider-new.php' );
=======
		require_once( __DIR__ . '/widgets/blog.php' );
		require_once( __DIR__ . '/widgets/blog-new.php' );
		require_once( __DIR__ . '/widgets/slider.php' );
		require_once( __DIR__ . '/widgets/all-blogs.php' );
		require_once( __DIR__ . '/widgets/blog-archive.php' );
		require_once( __DIR__ . '/widgets/slider-new.php' );


>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
		require_once( __DIR__ . '/widgets/post-all.php' );
		require_once( __DIR__ . '/widgets/post-first.php' );
		require_once( __DIR__ . '/widgets/post-last.php' );
		require_once( __DIR__ . '/widgets/post-middle.php' );

<<<<<<< HEAD

		// Register widget

		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Slider_New_PastPost_Widget() );
=======


		// Register widget
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_New_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Slider_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_All_Blogs_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_Archive_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Slider_New_PastPost_Widget() );


>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post__All_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_First_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_Last_PastPost_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_Middle_PastPost_Widget() );

	}


	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pastpostelementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'pastpostelementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pastpostelementor' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pastpostelementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'pastpostelementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pastpostelementor' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pastpostelementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'pastpostelementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pastpostelementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );


	}

	public function includes() {
	}

}

ElementorCustomExtension::instance();

