<?php 
  namespace Monadic_Addons;

  if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
  }

  final class Plugin {

    /**
     * Monadic Addons Version
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

    /**
     * Minimum PHP Version
     */
    const MINIMUM_PHP_VERSION = '5.4';

    /**
     * Instance
    */
    private static $_instance = null;


    /**
     * Instance
     */
    public static function instance() {

      if ( is_null( self::$_instance ) ) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    /**
     * Constructor
     */
     public function __construct() {
      if ( $this->is_compatible() ) {
        add_action( 'elementor/init', [ $this, 'init' ] );
      }
     }

    /**
	  * Compatibility Checks
	  */
    public function is_compatible() {
      // Check if Elementor installed and activated
      if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', [ $this, 'monadic_admin_notice_missing_main_plugin' ] );
        return false;
      }

      // Check for required Elementor version
      if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
        add_action( 'admin_notices', [ $this, 'monadic_admin_notice_minimum_elementor_version' ] );
        return false;
      }

      // Check for required PHP version
      if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
        add_action( 'admin_notices', [ $this, 'monadic_admin_notice_minimum_php_version' ] );
        return false;
      }

      return true;

    }

    /**
     * Main Plugin is missing
     */

     public function monadic_admin_notice_missing_main_plugin() {
      if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
          $notice_title = __( 'Activate Elementor', 'monadic-addons' );
          $notice_url = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
      }else{
          $notice_title = __( 'Install Elementor', 'monadic-addons' );
          $notice_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
      }

  

      $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Elementor installation Link */
        esc_html__( '%1$s %2$s', 'monadic-addons' ),
        '<p>' . esc_html__( 'Ops! Monadic Plugin is not Work Because you need Elementor Plugins install', 'monadic-addons' ) . '</p>',
        '<p><a class="button-primary block" href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a></p>'
      );
  
      printf( '<div class="notice error is-dismissible"><p>%1$s</p></div>', $message );


     }

     /**
      * Minimum Elementor Version
      */
     public function monadic_admin_notice_minimum_elementor_version() {
      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

      $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'monadic-addons' ),
        '<strong>' . esc_html__( 'Monadic Addons', 'monadic-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'monadic-addons' ) . '</strong>',
        self::MINIMUM_ELEMENTOR_VERSION
      );

      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
     * Minimum PHP Version
     */

    public function monadic_admin_notice_minimum_php_version() {

      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
  
      $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'monadic-addons' ),
        '<strong>' . esc_html__( 'Monadic Addons', 'monadic-addons' ) . '</strong>',
        '<strong>' . esc_html__( 'PHP', 'monadic-addons' ) . '</strong>',
         self::MINIMUM_PHP_VERSION
      );
  
      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  
    }


     /**
      * Init Methos
      */
    public function init() {
      add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
      add_action( 'elementor/elements/categories_registered', [ $this, 'monadic_elementor_widget_categories' ] );
      add_action( 'elementor/frontend/after_register_scripts', [ $this, 'monadic_enqueue_scripts' ] );
      add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'monadic_enqueue_styles' ] );
    }

    /**
     * Elementor Category Register
     */
    public function monadic_elementor_widget_categories($elements_manager) {
      $elements_manager->add_category(
        'monadic-addons',
        [
          'title' => esc_html__( 'Monadic Addons', 'monadic-addons' ),
          'icon' => 'fa fa-plug',
        ]
      );
    }

  /**
   * Enqueue Script
   */
    public function monadic_enqueue_scripts() {
      /**
       * Lib files
       */
      wp_register_script( 'isotope', MONADIC_ADDONS_ASSETS .'lib/js/isotope.pkgd.min.js', ['jquery', 'elementor-frontend'], MONADIC_ADDONS_VERSION, true );
      wp_register_script( 'lightbox', MONADIC_ADDONS_ASSETS .'lib/js/lightbox.min.js', ['jquery', 'elementor-frontend'], MONADIC_ADDONS_VERSION, true );
      wp_register_script( 'waypoints', MONADIC_ADDONS_ASSETS .'lib/js/waypoints.min.js', ['jquery'], MONADIC_ADDONS_VERSION, true );
      wp_register_script( 'counterup', MONADIC_ADDONS_ASSETS .'lib/js/jquery.counterup.min.js', ['jquery'], MONADIC_ADDONS_VERSION, true );
      

      /**
       * Custom Files
       */
      wp_register_script( 'monadic-testimonial', MONADIC_ADDONS_ASSETS .'js/monadic-testimonial.js', ['elementor-frontend'], MONADIC_ADDONS_VERSION, true );
      wp_register_script( 'monadic-teams', MONADIC_ADDONS_ASSETS .'js/monadic-teams.js',  ['elementor-frontend'], MONADIC_ADDONS_VERSION, true );
      wp_register_script( 'monadic-image-gallery', MONADIC_ADDONS_ASSETS .'js/monadic-image-gallery.js' , ['elementor-frontend'], MONADIC_ADDONS_VERSION, true);
      wp_register_script( 'monadic-counter', MONADIC_ADDONS_ASSETS .'js/monadic-counter.js' , ['jquery', 'elementor-frontend'], MONADIC_ADDONS_VERSION, true);
    }

    /**
     * Addons Style
     */
    public function monadic_enqueue_styles() {
      /**
       * Lib CSS
       */
      wp_register_style('lightbox', MONADIC_ADDONS_ASSETS .'lib/css/lightbox.min.css' );

      /**
       * Custom CSS
       */
      wp_register_style('monadic-testimonial', MONADIC_ADDONS_ASSETS . 'css/monadic-testimonial.css' );
      wp_register_style('monadic-teams', MONADIC_ADDONS_ASSETS . 'css/monadic-teams.css' );
      wp_register_style('monadic-image-gallery', MONADIC_ADDONS_ASSETS . 'css/monadic-image-gallery.css' );
      wp_register_style('monadic-service-card', MONADIC_ADDONS_ASSETS . 'css/monadic-service-card.css' );
      wp_register_style('monadic-counter', MONADIC_ADDONS_ASSETS . 'css/monadic-counter.css' );

    }

    /**
     * Elementor Control
     */
    public function register_widgets( $widgets_manager ) {

      /**
       * Widgets Files
       */
      require_once( __DIR__ . '/widgets/monadic-testimonial.php' );
      require_once( __DIR__ . '/widgets/monadic-teams.php' );
      require_once( __DIR__ . '/widgets/monadic-image-gallery.php' );
      require_once( __DIR__ . '/widgets/monadic-service-card.php' );
      require_once( __DIR__ . '/widgets/monadic-counter.php' );
  
      /**
       * Widgets Classes
       */
      $widgets_manager->register( new \Monadic_Addons_Testimonial\Monadic_Testimonial() );
      $widgets_manager->register( new \Monadic_Addons_Teams\Monadic_Teams() );
      $widgets_manager->register( new \Monadic_Addons_Image_Galley\Monadic_Image_Gallery() );
      $widgets_manager->register( new \Monadic_Addons_Service_Card\Monadic_Service_Card() );
      $widgets_manager->register( new \Monadic_Addons_Counter\Monadic_Counter() );
    }

  }