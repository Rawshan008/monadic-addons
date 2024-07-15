<?php

namespace Monadic_Addons_Testimonial;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Monadic Testimonial Widgets
 */
class Monadic_Testimonial extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 */
	public function get_name()
	{
		return 'monadic-testimonial';
	}

	/**
	 * Get widget title.
	 */
	public function get_title()
	{
		return esc_html__('Testimonial', 'monadic-addons');
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-testimonial-carousel';
	}

	/**
	 * Get custom help URL.
	 */
	public function get_custom_help_url()
	{
		return '';
	}

	/**
	 * Get Custom CSS Files
	 */
	public function get_style_depends()
	{
		return ['monadic-testimonial'];
	}

	/**
	 * Get Custom Js Files
	 */
	public function get_script_depends()
	{
		return ['monadic-testimonial'];
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories()
	{
		return ['monadic-addons'];
	}

	/**
	 * Get widget keywords.
	 */
	public function get_keywords()
	{
		return ['testimonial', 'slider', 'client', 'reviews'];
	}

	/**
	 * Register Testimonial widget controls.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'monadic-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'client_name',
			[
				'label' => esc_html__('Client Name', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Dianne Russell', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'client_designation',
			[
				'label' => esc_html__('Client Designation', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('CTO at XYZ Ltd.', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'client_review',
			[
				'label' => esc_html__('Client Review', 'monadic-addons'),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__('Lorem ipsum dolor sit amet,', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'client_icon',
			[
				'label' => esc_html__('Select Icon', 'monadic-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-left',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label' => esc_html__('Testimonials', 'monadic-addons'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'client_name' => esc_html__('Dianne Russell', 'monadic-addons'),
						'client_designation' => esc_html__('CTO at XYZ Ltd.', 'monadic-addons'),
						'client_review' => esc_html__('Lorem ipsum dolor sit amet, consectetur adip iscing elit. Sed sit libero', 'monadic-addons'),
					]
				],
				'title_field' => '{{{ client_name }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'options_section',
			[
				'label' => esc_html__('Slider Options', 'monadic-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__('Autoplay?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('True', 'monadic-addons'),
				'label_off' => esc_html__('False', 'monadic-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__('Autoplay Speed', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinity_loop',
			[
				'label' => esc_html__('Infinite Loop?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'monadic-addons'),
				'label_off' => esc_html__('No', 'monadic-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label' => esc_html__('Animation Speed', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__('Slider Styles', 'monadic-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_style_arrow',
			[
				'label' => esc_html__('Arrow', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_arrow',
			[
				'label' => esc_html__('Show?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'monadic-addons'),
				'label_off' => esc_html__('Hide', 'monadic-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'arrow_left_icon',
			[
				'label' => esc_html__('Left Icon', 'monadic-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-left',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_right_icon',
			[
				'label' => esc_html__('Right Icon', 'monadic-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_size',
			[
				'label' => esc_html__('Background Size', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 15,
				'max' => 60,
				'setp' => 1,
				'default' => 40,
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-button-next, {{WRAPPER}} .monadic-testimonial-button-prev' => 'height: {{VALUE}}px; width: {{VALUE}}px',
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_size',
			[
				'label' => esc_html__('Size', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 15,
				'max' => 40,
				'setp' => 1,
				'default' => 20,
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-button-next svg, {{WRAPPER}} .monadic-testimonial-button-prev svg' => 'height: {{VALUE}}px;',
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-button-next svg, {{WRAPPER}} .monadic-testimonial-button-prev svg' => 'color: {{VALUE}}; fill:{{VALUE}}'
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_color',
			[
				'label' => esc_html__('Background Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#7958FC',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-button-next, {{WRAPPER}} .monadic-testimonial-button-prev' => 'background-color: {{VALUE}}'
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_style_pagination',
			[
				'label' => esc_html__('Pagination', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__('Show Pagination?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'monadic-addons'),
				'label_off' => esc_html__('Hide', 'monadic-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'condition' => [
					'show_pagination' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Style 
		 */
		$this->start_controls_section(
			'style',
			[
				'label' => esc_html__('Styles', 'monadic-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'quote_icon',
			[
				'label' => esc_html__('Quote Icon', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quote_icon_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-icons svg' => 'color: {{VALUE}}; fill: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'quote_icon_size',
			[
				'label' => esc_html__('Icon Size', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 15,
				'max' => 40,
				'setp' => 1,
				'default' => 30,
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-icons svg' => 'height: {{VALUE}}px',
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'quote_icon_background_size',
			[
				'label' => esc_html__('Iconn Background Size', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 15,
				'max' => 64,
				'setp' => 1,
				'default' => 64,
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-icons' => 'height: {{VALUE}}px;width: {{VALUE}}px',
				],
				'condition' => [
					'show_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'quote_icon_bg_color',
			[
				'label' => esc_html__('Background', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#7958FC',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-icons' => 'background-color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			's_client_name',
			[
				'label' => esc_html__('Client Name', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'client_name_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-testimonial-item h2',
			]
		);

		$this->add_control(
			'client_name_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-item h2' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			's_client_designation',
			[
				'label' => esc_html__('Client Designation', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'client_designation_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-testimonial-item h4',
			]
		);

		$this->add_control(
			'client_designation_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-item h4' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			's_client_review',
			[
				'label' => esc_html__('Client Review', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'client_review_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-testimonial-item p',
			]
		);

		$this->add_control(
			'client_review_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'selectors' => [
					'{{WRAPPER}} .monadic-testimonial-item p' => 'color: {{VALUE}}'
				],
			]
		);


		$this->end_controls_section();
	}



	/**
	 * Render Testimonial Header 
	 */
	protected function render_header()
	{
		$settings = $this->get_settings_for_display();
		$id  = 'monadic-testimonial-' . $this->get_id();
		$this->add_render_attribute('monadic-testimonial', 'id', $id);
		$this->add_render_attribute('monadic-testimonial', 'class', 'monadic-testimonial-wrapper');
		$this->add_render_attribute('monadic-testimonial-slider', 'class', ['monadic-testimonial-slider', 'swiper']);

		$this->add_render_attribute([
			'monadic-testimonial' => [
				'data-settings' =>  [
					wp_json_encode(array_filter([
						"loop" => ("yes" == $settings['infinity_loop']) ? true : false,
						"autoplay" => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
						"speed"  => $settings["animation_speed"],
						"navigation" => [
							"nextEl" => ".monadic-testimonial-button-next",
							"prevEl" => ".monadic-testimonial-button-prev",
						],
						"pagination" => [
							"el" => "#" . $id . " .swiper-pagination",
							"clickable" => true,
						],
					]))
				],
			]
		]);

?>
		<div <?php $this->print_render_attribute_string('monadic-testimonial'); ?>>
			<div <?php $this->print_render_attribute_string('monadic-testimonial-slider'); ?>>
				<div class="swiper-wrapper">

				<?php

			}

			/**
			 * Render Testimonial Arrow
			 */
			protected function render_arrow()
			{
				$settings = $this->get_settings_for_display();
				?>
					<div class="monadic-testimonial-button-next">
						<?php Icons_Manager::render_icon($settings['arrow_left_icon'], ['aria-hidden' => 'true']); ?>
					</div>
					<div class="monadic-testimonial-button-prev">
						<?php Icons_Manager::render_icon($settings['arrow_right_icon'], ['aria-hidden' => 'true']); ?>
					</div>
				<?php
			}

			/**
			 * Render Testimonial Pagination
			 */
			protected function render_pagination()
			{
				?>
					<div class="swiper-pagination"></div>
				<?php
			}

			/**
			 * Render Testimonial Footer
			 */
			protected function render_footer()
			{
				$settings = $this->get_settings_for_display();
				?>
				</div>
				<?php
				if ('yes' === $settings['show_arrow']) {
					$this->render_arrow();
				}

				if ('yes' === $settings['show_pagination']) {
					$this->render_pagination();
				}
				?>

			</div>
		</div>
		<?php
			}

			/**
			 * Render Testimonial Items
			 */
			protected function render_tesimonial_items()
			{
				$this->add_render_attribute('testimonial-item', 'class', 'monadic-testimonial-item swiper-slide', true);

				$settings = $this->get_settings_for_display();

				$testmonials = $settings['testimonials'];

				$allow_html = [
					'a' => [
						'href' => [],
						'title' => [],
					],
					'br' => [],
					'strong' => [],
					'em' => []
				];

				foreach ($testmonials as $testmonial) {
		?>
			<div <?php $this->print_render_attribute_string('testimonial-item'); ?>>
				<div class="monadic-testimonial-icons">
					<?php Icons_Manager::render_icon($testmonial['client_icon'], ['aria-hidden' => 'true']); ?>
				</div>
				<p><?php echo wp_kses($testmonial['client_review'], $allow_html); ?></p>
				<h2><?php echo esc_html($testmonial['client_name']); ?></h2>
				<h4><?php echo esc_html($testmonial['client_designation']); ?></h4>
			</div>
		<?php
				}
			}

			/**
			 * Render Testimonial widget Output.
			 */
			protected function render()
			{
				$settings = $this->get_settings_for_display();
				$this->add_render_attribute('monadic-testimonial-container', 'class', 'monadic-testimonial-container');
		?>
		<div <?php $this->print_render_attribute_string('monadic-testimonial-container'); ?>>
			<?php
				$this->render_header();
				$this->render_tesimonial_items();
				$this->render_footer();
			?>
		</div>
<?php
			}
		}
