<?php

namespace Monadic_Addons_Service_Card;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Monadic Service Card Widgets
 */
class Monadic_Service_Card extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 */
	public function get_name()
	{
		return 'monadic-service-card';
	}

	/**
	 * Get widget title.
	 */
	public function get_title()
	{
		return esc_html__('Service Card', 'monadic-addons');
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-menu-card';
	}

	/**
	 * Get custom help URL.
	 */
	public function get_custom_help_url()
	{
		return '';
	}

	/**
	 * Scripts Styles
	 */
	public function get_style_depends()
	{
		return ['monadic-service-card'];
	}

	/**
	 * Scripts Depends
	 */
	public function get_script_depends()
	{
		return [''];
	}

	/**
	 * Widgets Category
	 */
	public function get_categories()
	{
		return ['monadic-addons'];
	}

	public function get_keywords()
	{
		return ['Service', 'lists', 'ordered', 'unordered', 'Card'];
	}

	/**
	 * Addons Control Controls
	 */

	protected function register_controls()
	{
		/**
		 * Content Control
		 */
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'monadic-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'monadic-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Enter Title', 'monadic-addons'),
				'placeholder' => esc_html__('Enter Title', 'monadic-addons'),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'monadic-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Default description', 'monadic-addons'),
				'placeholder' => esc_html__('Type your description here', 'monadic-addons'),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'monadic-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('See More', 'monadic-addons'),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__('Button Text', 'monadic-addons'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'monadic-addons'),
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);



		$this->end_controls_section();

		/**
		 * Style Control
		 */

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Style', 'monadic-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'card_box',
			[
				'label' => esc_html__('Card Box', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_box_bg',
			[
				'label' => esc_html__('Background', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'padding',
			[
				'label' => esc_html__('Padding', 'monadic-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hover_box_shadow',
			[
				'label' => esc_html__('Hover Box Shadow', 'monadic-addons'),
				'type' => Controls_Manager::BOX_SHADOW,
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				],
			]
		);

		$this->add_control(
			'icon_style',
			[
				'label' => esc_html__('Icon', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box_size',
			[
				'label' => esc_html__('Box Size', 'monadic-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 70
				],
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'monadic-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 30
				],
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__('Icon BG Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_style',
			[
				'label' => esc_html__('Heading', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-service-card-content h3',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-content h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'description_style',
			[
				'label' => esc_html__('Description', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-service-card-content p',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-content p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => esc_html__('Button', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-service-card-btn',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-service-card-btn',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Hover Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Hover Bg Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .monadic-service-card-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}




	public function render()
	{
		$settings = $this->get_settings_for_display();

		$icon = $settings['icon'];
		$title = $settings['title'];
		$description = $settings['description'];
		$button_text = $settings['button_text'];
		$button_url = $settings['button_url'];

		if (!empty($button_url['url'])) {
			$this->add_link_attributes('button_url', $button_url);
		}
?>

		<div class="monadic-service-card-wrapper">

			<?php if (!empty($icon)) : ?>
				<div class="monadic-service-card-icon">
					<?php Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?>
				</div>
			<?php endif; ?>

			<div class="monadic-service-card-content">
				<?php if (!empty($title)) : ?>
					<h3><?php echo esc_html($title); ?></h3>
				<?php endif; ?>

				<?php if (!empty($description)) : ?>
					<p><?php echo esc_html($description); ?></p>
				<?php endif; ?>

			</div>

			<?php if (!empty($button_text)) : ?>
				<a class="monadic-service-card-btn" <?php echo $this->get_render_attribute_string('button_url'); ?>><?php echo esc_html($button_text); ?></a>
			<?php endif; ?>
		</div>

<?php
	}
}
