<?php
namespace Monadic_Addons_Counter;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Monadic Counter Widgets.
 */
class Monadic_Counter extends \Elementor\Widget_Base{

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'monadic-counter';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'Counter', 'monadic-addons' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	/**
	 * Get custom help URL.
	 */
	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Scripts Styles
	 */
	public function get_style_depends() {
		return ['monadic-counter'];
	}

	/**
	 * Scripts Depends
	 */
	public function get_script_depends() {
		return ['waypoints', 'counterup', 'monadic-counter'];
	}

	/**
	 * Widgets Category
	 */
	public function get_categories() {
		return [ 'monadic-addons' ];
	}

	public function get_keywords() {
		return [ 'counter', 'service', 'lists', 'ordered', 'unordered', 'Card' ];
	}

/**
 * Addons Control Controls
 */

protected function register_controls() {
	/**
	 * Content Control
	 */
	$this->start_controls_section(
		'content_section',
		[
			'label' => esc_html__( 'Content', 'monadic-addons' ),
			'tab' => Controls_Manager::TAB_CONTENT,
		]
	);

	$this->add_control(
		'icon',
		[
			'label' => esc_html__( 'Icon', 'monadic-addons' ),
			'type' => Controls_Manager::ICONS,
			'default' => [
				'value' => 'fas fa-star',
				'library' => 'solid',
			],
		]
	);

	$this->add_control(
		'number',
		[
			'label' => esc_html__( 'Number', 'monadic-addons' ),
			'type' => Controls_Manager::NUMBER,
			'default' => 100,
		]
	);

	$this->add_control(
		'description',
		[
			'label' => esc_html__( 'Description', 'monadic-addons' ),
			'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__('Client', 'monadic-addons'),
			'placeholder' => esc_html__('Type your Project', 'monadic-addons'),
		]
	);

	$this->add_control(
		'number_post_fix',
		[
			'label' => esc_html__( 'Number Post Fix', 'monadic-addons' ),
			'type' => Controls_Manager::TEXT,
			'placeholder' => esc_html__('+', 'monadic-addons'),
		]
	);

	$this->end_controls_section();

	/**
	 * Style Control
	 */

	$this->start_controls_section(
		'content_style',
		[
			'label' => esc_html__( 'Style', 'monadic-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);


	$this->add_control(
		'icon_style',
		[
			'label' => esc_html__( 'Icon', 'monadic-addons' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
		]
	);

	$this->add_control(
		'Icon Color',
		[
			'label' => esc_html__( 'Color', 'monadic-addons' ),
			'type' => Controls_Manager::COLOR,
			'default' => '#333',
			'selectors' => [
				'{{WRAPPER}} .monadic-counter-icon' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_control(
		'icon_size',
		[
			'label' => esc_html__( 'Size', 'monadic-addons' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => ['px'],
			'range' => [
				'px' => [
					'min' => 15,
					'max' => 100,
					'step' => 1,
				]
			 ],
		 'default' =>[
			'unit' => 'px',
			'size' =>30
		 ],
			'selectors' => [
				'{{WRAPPER}} .monadic-counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);


	$this->add_control(
		'number_style',
		[
			'label' => esc_html__( 'Number', 'monadic-addons' ),
			'type' => Controls_Manager::HEADING,
			'separator' => 'before',
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'number_typography',
			'label' => esc_html__('Typography', 'monadic-addons'),
			'selector' => '{{WRAPPER}} .monadic-counter-content p',
		]
	);

	$this->add_control(
		'number_color',
		[
			'label' => esc_html__( 'Color', 'monadic-addons' ),
			'type' => Controls_Manager::COLOR,
			'default' => '#333',
			'selectors' => [
				'{{WRAPPER}} .monadic-counter-content p' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_control(
		'description_style',
		[
			'label' => esc_html__( 'Description', 'monadic-addons' ),
			'type' =>Controls_Manager::HEADING,
			'separator' => 'before',
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'description_typography',
			'label' => esc_html__('Typography', 'monadic-addons'),
			'selector' => '{{WRAPPER}} .monadic-counter-content h3',
		]
	);

	$this->add_control(
		'description_color',
		[
			'label' => esc_html__( 'Color', 'monadic-addons' ),
			'type' => Controls_Manager::COLOR,
			'default' => '#333',
			'selectors' => [
				'{{WRAPPER}} .monadic-counter-content h3' => 'color: {{VALUE}}',
			],
		]
	);

	$this->end_controls_section();
}




public function render() {
	$settings = $this->get_settings_for_display();

	$icon = $settings['icon'];
	$number = $settings['number'];
	$number_post_fix = $settings['number_post_fix'];
	$description = $settings['description'];
	
	?>
	<div class="monadic-counter-wrapper">
		
		<?php if(!empty($icon)): ?>
			<div class="monadic-counter-icon">
				<?php Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
			</div>
		<?php endif; ?>

		<div class="monadic-counter-content">
			<?php if(!empty($number)): ?>
				<p><span><?php echo esc_html($number); ?></span><?php echo esc_html($number_post_fix);?></p>
			<?php endif; ?>

			<?php if(!empty($description)): ?>
				<h3><?php echo esc_html($description); ?></h3>
			<?php endif; ?>

		</div>
	</div>

	<?php 
}

}