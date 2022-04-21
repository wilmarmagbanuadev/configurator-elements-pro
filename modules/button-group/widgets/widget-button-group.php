<?php
namespace BlankElementsPro\Modules\ButtonGroup\Widgets;

// You can add to or remove from this list - it's not conclusive! Chop & change to fit your needs.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Button_Group extends Widget_Base {

	/* Uncomment the line below if you do not wish to use the function _content_template() - leave that section empty if this is uncommented! */
	//protected $_has_template_content = false; 

	public function get_name() {
		return 'blank-widget-button-group';
	}

	public function get_title() {
		return __( 'Buttons', 'configurator-template-kits-blocks-pro' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'configurator-template-kits-blocks-pro-widgets'];
	}
	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'configurator-template-kits-blocks-pro' ),
			'sm' => __( 'Small', 'configurator-template-kits-blocks-pro' ),
			'md' => __( 'Medium', 'configurator-template-kits-blocks-pro' ),
			'lg' => __( 'Large', 'configurator-template-kits-blocks-pro' ),
			'xl' => __( 'Extra Large', 'configurator-template-kits-blocks-pro' ),
		];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Buttons', 'configurator-template-kits-blocks-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new Repeater();
		$repeater->start_controls_tabs('content_layout_style_tab');
			// start content tab
			$repeater->start_controls_tab('content_tab',['label' => esc_html__( 'Content', 'configurator-template-kits-blocks-pro'),]);
				$repeater->add_control(
					'btn_text',
					[
						'label' => __( 'Text', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Click here', 'configurator-template-kits-blocks-pro' ),
						'placeholder' => __( 'Click here', 'configurator-template-kits-blocks-pro' ),
					]
				);
				$repeater->add_control(
					'link',
					[
						'label' => __( 'Link', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'https://your-link.com', 'configurator-template-kits-blocks-pro' ),
						'default' => [
							'url' => '#',
						],
					]
				);
				$repeater->add_control(
					'icon',
					[
						'label' => __( 'Icon', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
						'default' => '',
					]
				);
				$repeater->add_control(
					'css_id',
					[
						'label' => esc_html__( 'CSS ID', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::TEXT,
					]
				);
				$repeater->add_control(
					'css_class',
					[
						'label' => esc_html__( 'CSS Classes', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::TEXT,
					]
				);
			$repeater->end_controls_tab();
			// End Layout tab
			// Start Style tab	
			$repeater->start_controls_tab('layout_tab',['label' => esc_html__( 'Layout', 'configurator-template-kits-blocks-pro'),]);
				$repeater->add_control(
					'btn_icon_pos',
					[
						'label' => __( 'Icon Position', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left'    => [
								'title' => __( 'Left', 'configurator-template-kits-blocks-pro' ),
								'icon' => 'fa fa-align-left',
							],
							'right' => [
								'title' => __( 'Right', 'configurator-template-kits-blocks-pro' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'left',
					]
				);
				$repeater->add_control(
					'icon_space',
					[
						'label' => esc_html__( 'Icon Space', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						],

					]
				);
				
				
			$repeater->end_controls_tab();
			// End Layout tab
			// Start Style tab	
			$repeater->start_controls_tab('style_tab',['label' => esc_html__( 'Style', 'configurator-template-kits-blocks-pro'),]);
				$repeater->add_control(
					'btn_size',
					[
						'label' => __( 'Button Size', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'sm',
						'options' => self::get_button_sizes(),
						'style_transfer' => true,
					]
				);
				$repeater->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::COLOR,
					]
				);
				
				$repeater->add_control(
					'button_bg',
					[
						'label' => __( 'Background Type', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'color'=>esc_html__( 'Color', 'configurator-template-kits-blocks-pro' ),
							'gradient'=>esc_html__( 'Gradient', 'configurator-template-kits-blocks-pro' ),
							'image'=>esc_html__( 'Image', 'configurator-template-kits-blocks-pro' ),
							
						],
						'default' => 'color',
						'style_transfer' => true,
					]
				);
				$repeater->add_control(
					'bg_img',
					[
						'label' => esc_html__( 'Background Image', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
						'condition'   => [
							'button_bg'  => 'image',
						],
					]
				);
		
				$repeater->add_control(
					'button_gradient_type',
					[
						'label' => __( 'Gradient Type', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'linear'=>esc_html__( 'Linear', 'configurator-template-kits-blocks-pro' ),
							'radial'=>esc_html__( 'Radial', 'configurator-template-kits-blocks-pro' ),
							
						],
						'default' => 'linear',
						'style_transfer' => true,
						'condition'   => [
							'button_bg'  => 'gradient',
						],
					]
				);
				$repeater->add_control(
					'btn_color_normal',
					[
						'label' => __( 'Background Color', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::COLOR,
						'condition'             => [
							'button_bg'  => ['color','gradient'],
						],
						
					]
					
				);
				$repeater->add_control(
					'btn_color_normal_size',
					[
						'label' => esc_html__( 'Background Color Size', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
							
						],
						'default' => [
							'size' => 0,
						],
						'condition'   => [
							'button_bg'  => 'gradient',
							'button_gradient_type' => 'radial',
						],
					]
				);
				$repeater->add_control(
					'btn_color_normal_second',
					[
						'label' => __( 'Second Background Color', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::COLOR,
						'condition'             => [
							'button_bg'  => 'gradient',
						],
						
					]
					
				);
				$repeater->add_control(
					'btn_color_normal_size_second',
					[
						'label' => esc_html__( 'Second Background Color Size', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
							
						],
						'default' => [
							'size' => 0,
						],
						'condition'   => [
							'button_bg'  => 'gradient',
							'button_gradient_type' => 'radial',
						],
					]
				);
				
				$repeater->add_control(
					'btn_bg_gradient_angle',
					[
						'label' => esc_html__( 'Gradient Angle', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 360,
							'step' => 1,
							
						],
						'default' => [
							'size' => 0,
						],
						'condition'   => [
							'button_bg'  => 'gradient',
							'button_gradient_type' => 'linear',
						],
					]
				);
				$repeater->add_control(
					'hr',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				// start Hover
				$repeater->add_control(
					'icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color [Hover]', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::COLOR,
					]
				);
				$repeater->add_control(
					'btn_color_hover',
					[
						'label' => __( 'Background Color [Hover]', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::COLOR,
						'condition'   => [
							'button_bg'  => ['color','gradient'],
						],
						
					]
				);
				$repeater->add_control(
					'btn_color_normal_size_hover',
					[
						'label' => esc_html__( 'Background Color Size [Hover]', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
							
						],
						'default' => [
							'size' => 0,
						],
						'condition'   => [
							'button_bg'  => 'gradient',
							'button_gradient_type' => 'radial',
						],
					]
				);
				$repeater->add_control(
					'btn_color_normal_second_hover',
					[
						'label' => __( 'Second Background Color [Hover]', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::COLOR,
						'condition'             => [
							'button_bg'  => 'gradient',
						],
						
					]
					
				);
				$repeater->add_control(
					'btn_color_normal_size_second_hover',
					[
						'label' => esc_html__( 'Second Background Color Size [Hover]', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
							
						],
						'default' => [
							'size' => 0,
						],
						'condition'   => [
							'button_bg'  => 'gradient',
							'button_gradient_type' => 'radial',
						],
					]
				);
				
				$repeater->add_control(
					'btn_bg_gradient_angle_hover',
					[
						'label' => esc_html__( 'Gradient Angle [Hover]', 'configurator-template-kits-blocks-pro' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 360,
							'step' => 1,
							
						],
						'default' => [
							'size' => 0,
						],
						'condition'   => [
							'button_bg'  => 'gradient',
							'button_gradient_type' => 'linear',
						],
					]
				);
				$repeater->add_control(
					'hr',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$repeater->add_control(
					'btn_border_type',
					[
						'label' => __( 'Border Type', 'configurator-elements-pro' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'none'=>esc_html__( 'None', 'configurator-elements-pro' ),
							'solid'=>esc_html__( 'Solid', 'configurator-elements-pro' ),
							'double'=>esc_html__( 'Double', 'configurator-elements-pro' ),
							'dotted'=>esc_html__( 'Dotted', 'configurator-elements-pro' ),
							'dashed'=>esc_html__( 'Dashed', 'configurator-elements-pro' ),
							'groove'=>esc_html__( 'Groove', 'configurator-elements-pro' ),
							
						],
						'default' => 'none',
						'style_transfer' => true,
					]
				);
				$repeater->add_control(
					'btn_border_color',
					[
						'label' => esc_html__( 'Border Color', 'configurator-elements-pro' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition'   => [
							'btn_border_type'  =>  [ 'solid','double','dotted','dashed','groove' ],
						],
					]
				);
				$repeater->add_control(
					'btn_border',
					[
						'label' => esc_html__( 'Border', 'configurator-elements-pro' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px','em' ],
						'condition'   => [
							'btn_border_type'  =>  [ 'solid','double','dotted','dashed','groove' ],
						],
					]
				);
				$repeater->add_control(
					'hr',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				// $repeater->add_control(
				// 	'label_only',
				// 	[
				// 		'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
				// 		'type' => \Elementor\Controls_Manager::HEADING,
				// 	]
				// );
				$repeater->add_control(
					'show_box_shadow',
					[
						'label' => esc_html__( 'Shadow', 'configurator-elements-pro' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Yes', 'configurator-elements-pro' ),
						'label_off' => esc_html__( 'No', 'configurator-elements-pro' ),
						'return_value' => 'yes',
						'default' => 'no',
					]
				);
				$repeater->add_control(
					'btn_box_shadow',
					[
						'type' => Controls_Manager::BOX_SHADOW,
						'condition' => [
							'show_box_shadow' => 'yes',
						],
					]
				);
			
				
			$repeater->end_controls_tab();
			// End Style tab
			// Start Transitions tab	
			$repeater->start_controls_tab('trans_tab',['label' => esc_html__( 'Transition', 'configurator-template-kits-blocks-pro'),]);
				$repeater->add_control(
					'have_trans',
					[
						'label' => esc_html__( 'Transition', 'configurator-elements-pro' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => esc_html__( 'Yes', 'your-plugin' ),
						'label_off' => esc_html__( 'No', 'your-plugin' ),
						'return_value' => 'mo',
						'default' => 'no',
					]
				);
			$repeater->end_controls_tab();
			// End Transitions tab	
		$repeater->end_controls_tabs();
		
		
		

		$this->add_control(
			'button_lists',
			[
				'label' => esc_html__( 'Buttons', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Click here', 'configurator-template-kits-blocks-pro' ),
					]
				],
				'title_field' => '{{{ btn_text }}}',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Buttons', 'configurator-template-kits-blocks-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'configurator-template-kits-blocks-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'configurator-template-kits-blocks-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'configurator-template-kits-blocks-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				//'scheme' => Scheme_Typography::TYPOGRAPHY_4,//cause the bug after update3.6
				'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'configurator-template-kits-blocks-pro' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'button_bg',
                'label'                 => __( 'Background', 'configurator-template-kits-blocks-pro' ),
                'types'                 => [ 'none','classic','gradient' ],
                'selector'              => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
            ]
        );

        
        $this->add_control(
			'button_line_color',
			[
				'label' => __( 'Line Color', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blank-button .blank-button-line, {{WRAPPER}} .blank-button .blank-button-line' => 'background: {{VALUE}};',
				],
                'condition'             => [
                    'button_line!'  => 'default',
                ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'configurator-template-kits-blocks-pro' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'button_bg_hover',
                'label'                 => __( 'Background', 'configurator-template-kits-blocks-pro' ),
                'types'                 => [ 'none','classic','gradient' ],
                'selector'              => '{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover',
            ]
        );
        
        $this->add_control(
			'button_line_color_hover',
			[
				'label' => __( 'Line Color', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blank-button a:hover .blank-button-line, {{WRAPPER}} .blank-button a:hover .blank-button-line' => 'background: {{VALUE}};',
				],
                'condition'             => [
                    'button_line!'  => 'default',
                ],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
        
        $this->add_responsive_control(
            'button_line_height',
            [
                'label'                 => __( 'Line Height', 'configurator-template-kits-blocks-pro' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 10,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em' ],
                'selectors'             => [
                    '{{WRAPPER}} .blank-button-line' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'button_line!'  => 'default',
                ],
                'separator' => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'button_line_width',
            [
                'label'                 => __( 'Line Width', 'configurator-template-kits-blocks-pro' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 50,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em' ],
                'selectors'             => [
                    '{{WRAPPER}} .blank-button-line' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'button_line!'  => 'default',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_line_spacing',
            [
                'label'                 => __( 'Line Spacing', 'configurator-template-kits-blocks-pro' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 50,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em' ],
                'selectors'             => [
                    '{{WRAPPER}}.blank-button-line-right .blank-button-line' => 'margin-left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.blank-button-line-left .blank-button-line' => 'margin-right: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'button_line!'  => 'default',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => __( 'Padding', 'configurator-template-kits-blocks-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}
		
	protected function render() {	
		$settings = $this->get_settings_for_display();	
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper configurator-button-group' );
		if ( $settings['button_lists'] ) {
			//echo '<dl>';
			$btn_counter = 1;
			
			foreach (  $settings['button_lists'] as $item ) {
			$new_tab = ($item['link']['is_external'])?' target="_blank "':null;
			$follow = ($item['link']['nofollow'])?' rel="nofollow "':null;
			$btn_id = ($item['css_id'])?' id="'.$item['css_id'].'"':null;
			$btn_class = ($item['css_class'])?$item['css_class']:null;
			$btn_size = 'elementor-size-'.$item['btn_size'];
			$attr = $new_tab.' '.$follow.' '.$btn_id.' ';
			$icon_space = ($item['btn_icon_pos']=='left')?'margin-right:'.$item['icon_space']['size'].'px':'margin-left:'.$item['icon_space']['size'].'px';
			//'margin-'($item['btn_icon_pos']=='left')?'left:'.$item['icon_space'].'px;':'right'.$item['icon_space'].'px;'
			$btn_hash= md5(uniqid(rand(), true));
			$style_bg = "background-color:".$item['btn_color_normal'].";";


			$n_color = ($item['btn_color_normal'])?$item['btn_color_normal']:'#fff';
			$n_color_size = ($item['btn_color_normal_size']['size'])?$item['btn_color_normal_size']['size'].'%':'0%';
			
			$n2_color = ($item['btn_color_normal_second'])?$item['btn_color_normal_second']:'#fff';
			$n_color_size_second = ($item['btn_color_normal_size_second']['size'])?$item['btn_color_normal_size_second']['size'].'%':'0%';
			
			$grad_angle = ($item['btn_bg_gradient_angle']['size'])?$item['btn_bg_gradient_angle']['size'].'deg':'0'.'deg';
			$grad_type = ($item['button_gradient_type'])?$item['button_gradient_type']:'linear';


			// hover
			$n_color_h = ($item['btn_color_hover'])?$item['btn_color_hover']:'#fff';
			$n_color_size_h = ($item['btn_color_normal_size_hover']['size'])?$item['btn_color_normal_size_hover']['size'].'%':'0%';

			$n2_color_h = ($item['btn_color_normal_second_hover'])?$item['btn_color_normal_second_hover']:'#fff';
			$n_color_size_second_h = ($item['btn_color_normal_size_second_hover']['size'])?$item['btn_color_normal_size_second_hover']['size'].'%':'0%';

			$grad_angle_h = ($item['btn_bg_gradient_angle_hover']['size'])?$item['btn_bg_gradient_angle_hover']['size'].'deg':'0'.'deg';
			

			// border
			var_dump( $item['btn_box_shadow']);
			$unit = ($item['btn_border']['unit'])?$item['btn_border']['unit']:null;
			$border_t = ($item['btn_border']['top'])?$item['btn_border']['top'].$unit:'0'.$unit;
			$border_r = ($item['btn_border']['right'])?$item['btn_border']['right'].$unit:'0'.$unit;
			$border_b = ($item['btn_border']['bottom'])?$item['btn_border']['bottom'].$unit:'0'.$unit;
			$border_l = ($item['btn_border']['left'])?$item['btn_border']['left'].$unit:'0'.$unit;
			if($item['btn_border']['top']==null && $item['btn_border']['right']==null && $item['btn_border']['bottom']==null && $item['btn_border']['left']==null ){
				$borders = null;
			}else{
				$borders = 'border-width:'.$border_t.' '.$border_r.' '.$border_b.' '.$border_l.';';
			}
			$box_shadow = 'box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) !important;';
			
			
			$transition = 'transition: all ease 0.8s;-moz-transition: all ease 0.8s;-webkit-transition: all ease 0.8s;-ms-transition: all ease 0.8s;-o-transition: all ease 0.8s;';
			$trans = ($item['have_trans']) ? $transition:'';
			?>	
			<style>
				<?php 
				echo '.btn-group-'.$btn_hash.' i{';
				echo 'color:'.$item['icon_color'].';}';

				echo '.btn-group-'.$btn_hash.':hover i{';
				echo $trans;
				echo  'color:'.$item['icon_color_hover'].';}';


				echo '.btn-group-'.$btn_hash.'{';
					echo $borders;
					echo ($item['btn_border_type'])?'border-style:'.$item['btn_border_type'].';':null;
					echo ($item['btn_border_color'])?'border-color:'.$item['btn_border_color'].';':null;
					echo $box_shadow;
					switch ($item['button_bg']) {
						case 'color':
							echo 'background-color:'.$item['btn_color_normal'].';';
						break;
						case 'gradient':
							switch ($grad_type) {
								case 'linear':
									echo 'background-image: '.$grad_type.'-gradient('.$grad_angle.', '.$n_color.', '.$n2_color.');';
								break;
								case 'radial':
									echo 'background-image: '.$grad_type.'-gradient( circle,'.$n_color.' '.$n_color_size.', '.$n2_color.' '.$n_color_size_second.');';
								break;
								default:
								echo 'background-image: '.$grad_type.'-gradient('.$grad_angle.', '.$n_color.', '.$n2_color.');';
								break;
							}
						break;
						case 'image':
							echo 'background-image:url('.$item['bg_img']['url'].');';
							echo 'background-position:center;background-size: cover;background-repeat: no-repeat;';
						break;
						default:
						'color';
							echo 'background-color:'.$item['btn_color_normal'].';';
						break;
					}
				echo '}';

				echo '.btn-group-'.$btn_hash.':hover{';
					echo $trans;
					switch ($item['button_bg']) {
						case 'color':
							echo 'background-color:'.$item['btn_color_hover'].';';
						break;
						case 'gradient':
							switch ($grad_type) {
								case 'linear':
									echo 'background-image: '.$grad_type.'-gradient('.$grad_angle_h.', '.$n_color_h.', '.$n2_color_h.');';
								break;
								case 'radial':
									echo 'background-image: '.$grad_type.'-gradient( circle,'.$n_color_h.' '.$n_color_size_h.', '.$n2_color_h.' '.$n_color_size_second_h.');';
								break;
								default:
									echo 'background-image: '.$grad_type.'-gradient('.$grad_angle_h.', '.$n_color_h.', '.$n2_color_h.');';
								break;
							}
						break;
						default:
							echo 'background-color:'.$item['btn_color_hover'].';';
						break;
					}
				echo '}';	

	
				?>
				
			</style>		
			<a href="<?php echo ( $item['link']['url'])?$item['link']['url']:'#';?>" <?php echo $attr;?> class="elementor-button-link btn-group-<?php echo $btn_hash.' '.$btn_counter++;?> elementor-button <?php echo ' '.$btn_class.' '.$btn_size.' btn_grp-';?>"  role="button"> 
				<span class="elementor-button-content-wrapper">
					<!-- <span class="blank-button-line"></span>	 -->
					<?php if ( ! empty( $item['icon'] ) ) : ?>
					<!-- icon -->
						<span class="elementor-align-icon-<?php echo $item['btn_icon_pos']; ?>" style="<?php echo $icon_space;?>">
							<i class="<?php echo esc_attr( $item['icon'] ); ?> btn_icon"   aria-hidden="true"></i>
						</span>
					<?php endif; ?>
					<span class="elementor-button-text"><?php echo $item['btn_text']; ?></span>
				</span>
			</a>
			<?php }
			//echo '</dl>';
		}
	}

	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text() {
	}
    
	protected function _content_template() {}
	
}