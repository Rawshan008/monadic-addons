<?php
namespace Monadic_Addons_Image_Galley;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Monadic Image Gallery
 */
class Monadic_Image_Gallery extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'monadic-image-gallery';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'Image Gallery', 'monadic-addons' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-masonry';
	}

	/**
	 * Get custom help URL.
	 */
	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Get Custom CSS Files
	 */
	public function get_style_depends() {
		return ['magnific-popup', 'monadic-image-gallery'];
	}

	/**
	 * Get Custom Js Files
	 */
	public function get_script_depends() {
		return ['isotope', 'magnific-popup', 'monadic-image-gallery'];
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'monadic-addons' ];
	}

	/**
	 * Get widget keywords.
	 */
	public function get_keywords() {
		return [ 'gallery', 'image', 'justified', 'isoteope', 'masenary' ];
	}

	/**
	 * Register Teams widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'monadic-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'images', [
				'label' => esc_html__('Upload Images', 'monadic-addons'),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'options_section',
			[
				'label' => esc_html__( 'Options', 'monadic-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_responsive_control(
			'columns', [
				'label' => esc_html__('Column', 'monadic-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					1 => esc_html__('1 Column', 'monadic-addons'),
					2 => esc_html__('2 Column', 'monadic-addons'),
					3 => esc_html__('3 Column', 'monadic-addons'),
					4 => esc_html__('4 Column', 'monadic-addons'),
					5 => esc_html__('5 Column', 'monadic-addons'),
					6 => esc_html__('6 Column', 'monadic-addons'),
				],
				'default' => 3,
				'selectors' => [
					'{{WRAPPER}} .monadic-image-gallery-item' => '--image-grid-column: {{VALUE}};',
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'layout', [
				'label' => esc_html__('Layout', 'monadic-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fitRows' => esc_html__('FitRows', 'monadic-addons'),
					'masonry' => esc_html__('Masonry', 'monadic-addons'),
				],
				'default' => 'masonry',
				'render' => 'none',
				'frontend_available' => true,
				'style_transfer' => true,
			],
		);

		$this->add_responsive_control(
			'image_height', [
				'label' => esc_html__('Image height', 'monadic-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000
					]
				],
				'selectors' => [
					'{{WRAPPER}} .monadic-image-gallery-item img' => '--monadic-image-gallery-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'layout' => 'fitRows',
				],
			]
		);


		$this->end_controls_section();
	}



	

	/**
	 * Render Team widget Output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="monadic-image-gallery-wrapper monadic-image-gallery-wrapper-<?php echo $this->get_id(); ?>">
			<?php 
				if (!empty($settings['images'])):
					foreach($settings['images'] as $image):
			?>
				<a href="<?php echo esc_attr($image['url']);?>" class="monadic-image-gallery-item">
						<img src="<?php echo esc_attr($image['url']);?>">
				</a>
			<?php 
					endforeach;
				endif;			
			?>
		</div>
		<?php
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) :
			printf( '<script>jQuery(".monadic-image-gallery-wrapper-%s").isotope();</script>', $this->get_id() );
		endif;
	}

}