<?php
namespace Monadic_Addons_Testimonial;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Teams Widget.
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
		return 'eicon-posts-group';
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
		return ['monadic-image-gallery'];
	}

	/**
	 * Get Custom Js Files
	 */
	public function get_script_depends() {
		return ['m-isotope','monadic-image-gallery'];
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
		return [ 'gallery', 'image' ];
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
				'label' => esc_html__( 'Slider Options', 'monadic-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'slider_per_view', [
				'label' => esc_html__('Slider Per View (1-5)', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->add_responsive_control(
			'slider_per_group', [
				'label' => esc_html__('Slider Per Group (1-5)', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->add_control(
			'autoplay', [
				'label' => esc_html__('Autoplay?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'monadic-addons' ),
				'label_off' => esc_html__( 'False', 'monadic-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoplay_speed', [
				'label' => esc_html__('Autoplay Speed', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinity_loop', [
				'label' => esc_html__('Infinite Loop?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'monadic-addons' ),
				'label_off' => esc_html__( 'No', 'monadic-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'animation_speed', [
				'label' => esc_html__('Animation Speed', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Slider Styles', 'monadic-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'space_between', [
				'label' => esc_html__('Space Between (1-50)', 'monadic-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 50,
				'step' => 1,
				'default' => 30,
			]
		);

		$this->add_control(
			'heading_style_pagination', [
				'label' => esc_html__('Pagination', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->add_control(
			'show_pagination', [
				'label' => esc_html__('Show Pagination?', 'monadic-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'monadic-addons' ),
				'label_off' => esc_html__( 'Hide', 'monadic-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pagination_color', [
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
				'label' => esc_html__( 'Styles', 'monadic-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			's_team_image', [
				'label' => esc_html__('Team Image', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'team_image_height', [
				'label' => esc_html__('Image Height', 'monadic-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
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
			's_team_name', [
				'label' => esc_html__('Team Name', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'team_name_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-item-content h3',
			]
		);

		$this->add_control(
			'team_name_color', [
				'label' => esc_html__('Color', 'monadic-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#3C2C7D',
				'selectors' => [
					'{{WRAPPER}} .monadic-item-content h3' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			's_team_designation', [
				'label' => esc_html__('Team Designation', 'monadic-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'team_designation_typography',
				'label' => esc_html__('Typography', 'monadic-addons'),
				'selector' => '{{WRAPPER}} .monadic-item-content',
			]
		);

		$this->add_control(
			'team_designation_color', [
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
				<div class="monadic-image-gallery-item">
						<img src="<?php echo esc_attr($image['url']);?>">
				</div>
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