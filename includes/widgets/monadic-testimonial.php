<?php
namespace Monadic_Addons_Testimonial;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use \Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Testimonial Widget.
 */
class Monadic_Testimonial extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'monadic_testimonial';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testimonial', 'monadic-addons' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial-carousel';
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
		return ['monadic-testimonial'];
	}

	/**
	 * Get Custom Js Files
	 */
	public function get_script_depends() {
		return ['monadic-testimonial'];
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
		return [ 'testimonial', 'slider', 'client', 'reviews' ];
	}

	/**
	 * Register Testimonial widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'monadic-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'client_name', [
				'label' => esc_html__('Client Name', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Dianne Russell', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'client_designation', [
				'label' => esc_html__('Client Designation', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('CTO at XYZ Ltd.', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'client_review', [
				'label' => esc_html__('Client Review', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Lorem ipsum dolor sit amet,', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'client_icon', [
				'label' => esc_html__('Select Icon', 'monadic-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-left',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'testimonials', [
				'label' => esc_html__('Testimonials', 'monadic-addons'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ client_name }}}',
			]
		);



		$this->end_controls_section();

	}



	/**
	 * Render Testimonial Header 
	 */
	protected function render_header() {
		$settings = $this->get_settings_for_display();
		$id  = 'monadic-testimonial-' . $this->get_id();
		$this->add_render_attribute( 'monadic-testimonial', 'id', $id );
		$this->add_render_attribute( 'monadic-testimonial', 'class', ['monadic-testimonial-wrapper', 'elementor-swiper'] );

		$this->add_render_attribute([
      'monadic-testimonial' => [
        'data-settings' =>  [
          wp_json_encode(array_filter([
						"loop" => false,
						"navigation" => [
							"nextEl" => ".swiper-button-next",
							"prevEl" => ".swiper-button-prev",
						],
						"pagination" => [
							"el" => ".swiper-pagination",
						],
          ]))
				],
      ]
    ]);

		?>
		<div <?php $this->print_render_attribute_string( 'monadic-testimonial' ); ?>>
				<div class="monadic-testimonial-slider">
						<div class="swiper-wrapper">

		<?php

	}

	/**
	 * Render Testimonial Footer
	 */
	protected function render_footer() {
		?>
					</div>

				<div class="navigation-wrap">
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
				</div>

				<div class="swiper-pagination"></div>

			</div>
		</div>
		<?php
	}

	/**
	 * Render Testimonial Items
	 */
	protected function render_tesimonial_items() {
		$this->add_render_attribute('testimonial-item', 'class', 'testimonial-item swiper-slide', true);

		$settings = $this->get_settings_for_display();

		$testmonials = $settings['testimonials'];

		foreach($testmonials as $testmonial) {
			?>
			<div <?php $this->print_render_attribute_string('testimonial-item'); ?>>
				<div class="icons">
					<?php Icons_Manager::render_icon( $testmonial['client_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
				<h2><?php echo esc_html($testmonial['client_name']); ?></h2>
				<h4><?php echo esc_html($testmonial['client_designation']); ?></h4>
				<p><?php echo esc_html($testmonial['client_review']); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Render Testimonial widget Output.
	 */
	protected function render() {
		?>
		<div class="monadic-testimonial-container">
			<?php 
				$this->render_header();
				$this->render_tesimonial_items();
				$this->render_footer();
			?>
		</div>
		<?php
	}

}