<?php

namespace Monadic_Addons_Teams;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Monadic Teams Widgets
 */
class Monadic_Teams extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 */
	public function get_name()
	{
		return 'monadic-teams';
	}

	/**
	 * Get widget title.
	 */
	public function get_title()
	{
		return esc_html__('Teams', 'monadic-addons');
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-group';
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
		return ['swiper','monadic-teams'];
	}

	/**
	 * Get Custom Js Files
	 */
	public function get_script_depends()
	{
		return ['swiper','monadic-teams'];
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
		return ['testimonial', 'slider', 'client', 'teams'];
	}

	/**
	 * Register Teams widget controls.
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
			'team_name',
			[
				'label' => esc_html__('Team Name', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Jenny Wilson', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'team_designation',
			[
				'label' => esc_html__('Team Designation', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Digital Marketer', 'monadic-addons')
			]
		);

		$repeater->add_control(
			'team_image',
			[
				'label' => esc_html__('Team Image', 'monadic-addons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'teams',
			[
				'label' => esc_html__('Teams', 'monadic-addons'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'team_name' => esc_html__('Jenny Wilson', 'monadic-addons'),
						'team_designation' => esc_html__('Digital Marketer', 'monadic-addons'),
						'team_image' => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
					[
						'team_name' => esc_html__('Mike Jason', 'monadic-addons'),
						'team_designation' => esc_html__('Software Engineer', 'monadic-addons'),
						'team_image' => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
					[
						'team_name' => esc_html__('Isabella Croline', 'monadic-addons'),
						'team_designation' => esc_html__('UI UX Designer', 'monadic-addons'),
						'team_image' => [
							'url' => Utils::get_placeholder_image_src(),
						]
					]
				],
				'title_field' => '{{{ team_name }}}',
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

		$this->add_responsive_control(
			'slider_per_view',
			[
				'label' => esc_html__('Slider Per View (1-5)', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
			]
		);

		$this->add_responsive_control(
			'slider_per_group',
			[
				'label' => esc_html__('Slider Per Group (1-5)', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
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
				'default' => 'no',
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
				'default' => 'no',
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
			'space_between',
			[
				'label' => esc_html__('Space Between (1-50)', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 50,
				'step' => 1,
				'default' => 30,
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
			's_team_image',
			[
				'label' => esc_html__('Team Image', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'team_image_height',
			[
				'label' => esc_html__('Image Height', 'monadic-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 300,
						'step' => 1,
						'max' => 1200,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 380
				],
				'selectors' => [
					'{{WRAPPER}} .monadic-team-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			's_team_name',
			[
				'label' => esc_html__('Team Name', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'team_name_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-item-content h3',
			]
		);

		$this->add_control(
			'team_name_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'selectors' => [
					'{{WRAPPER}} .monadic-item-content h3' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			's_team_designation',
			[
				'label' => esc_html__('Team Designation', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'team_designation_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-item-content',
			]
		);

		$this->add_control(
			'team_designation_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'selectors' => [
					'{{WRAPPER}} .monadic-item-content' => 'color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_section();
	}



	/**
	 * Render Team Header 
	 */
	protected function render_header()
	{
		$settings = $this->get_settings_for_display();

		$id  = 'monadic-team-' . $this->get_id();
		$this->add_render_attribute('monadic-team', 'id', $id);
		$this->add_render_attribute('monadic-team', 'class', 'monadic-team-wrapper');

		if ('yes' === $settings['show_pagination']) {
			$this->add_render_attribute('monadic-team-slider', 'class', 'monadic-team-slider-active-pagination');
		}

		$this->add_render_attribute('monadic-team-slider', 'class', ['monadic-team-slider', 'swiper']);

		$this->add_render_attribute([
			'monadic-team' => [
				'data-settings' =>  [
					wp_json_encode(array_filter([
						"loop" => ("yes" == $settings['infinity_loop']) ? true : false,
						"autoplay" => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
						"speed"  => $settings["animation_speed"],
						"slidesPerView" => isset($settings['slider_per_view_mobile']) ? $settings['slider_per_view_mobile'] : 1,
						"slidesPerGroup" => isset($settings['slider_per_group_mobile']) ? $settings['slider_per_group_mobile'] : 1,
						"spaceBetween" => isset($settings['space_between']) ? $settings['space_between'] : 30,
						"breakpoints" => [
							767 => [
								"slidesPerView" => isset($settings['slider_per_view_tablet']) ? $settings['slider_per_view_tablet'] : 2,
								"slidesPerGroup" => isset($settings['slider_per_group_tablet']) ? $settings['slider_per_group_tablet'] : 2
							],
							1023 => [
								"slidesPerView" => isset($settings['slider_per_view']) ? $settings['slider_per_view'] : 3,
								"slidesPerGroup" => isset($settings['slider_per_group']) ? $settings['slider_per_group'] : 3,
							],
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
		<div <?php $this->print_render_attribute_string('monadic-team'); ?>>
			<div <?php $this->print_render_attribute_string('monadic-team-slider'); ?>>
				<div class="swiper-wrapper">

				<?php

			}

			/**
			 * Render Team Pagination
			 */
			protected function render_pagination()
			{
				?>
					<div class="swiper-pagination"></div>
				<?php
			}

			/**
			 * Render Team Footer
			 */
			protected function render_footer()
			{
				$settings = $this->get_settings_for_display();
				?>
				</div>
				<?php
				if ('yes' === $settings['show_pagination']) {
					$this->render_pagination();
				}
				?>

			</div>
		</div>
		<?php
			}

			/**
			 * Render Team Items
			 */
			protected function render_team_items()
			{
				$settings = $this->get_settings_for_display();
				$this->add_render_attribute('team-item', 'class', 'monadic-team-item swiper-slide', true);

				$teams = $settings['teams'];

				foreach ($teams as $team) {
		?>
			<div <?php $this->print_render_attribute_string('team-item'); ?>>
				<div class="monadic-team-image">
					<img src="<?php echo esc_url($team['team_image']['url']) ?>" alt="<?php echo esc_attr($team['team_name']); ?>">
				</div>

				<div class="monadic-item-content">
					<h3><?php echo esc_html($team['team_name']); ?></h3>
					<p><?php echo esc_html($team['team_designation']); ?></p>
				</div>
			</div>
		<?php
				}
			}

			/**
			 * Render Team widget Output.
			 */
			protected function render()
			{
				$settings = $this->get_settings_for_display();
				$this->add_render_attribute('monadic-team-container', 'class', 'monadic-team-container');
		?>
		<div <?php $this->print_render_attribute_string('monadic-team-container'); ?>>
			<?php
				$this->render_header();
				$this->render_team_items();
				$this->render_footer();
			?>
		</div>
<?php
			}
		}
