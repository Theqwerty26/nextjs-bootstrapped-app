<?php
/**
 * Elementor Super Banner Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ALM_Banner_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'alm_super_banner';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return __( 'Super Banner', 'affiliate-listings' );
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-banner';
    }

    /**
     * Get widget categories
     */
    public function get_categories() {
        return [ 'affiliate-listings' ];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return [ 'banner', 'super', 'affiliate', 'recommended' ];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Banner Content', 'affiliate-listings' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner_type',
            [
                'label' => __( 'Banner Type', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => [
                    'auto' => __( 'Auto (Super Recommended Listing)', 'affiliate-listings' ),
                    'custom' => __( 'Custom Content', 'affiliate-listings' ),
                ],
            ]
        );

        // Get super recommended listings
        $super_listings = get_posts( array(
            'post_type' => 'affiliate_listing',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => '_alm_super_recommended',
                    'value' => '1',
                    'compare' => '='
                )
            )
        ) );

        $listing_options = array( '' => __( 'Select a listing', 'affiliate-listings' ) );
        foreach ( $super_listings as $listing ) {
            $listing_options[ $listing->ID ] = $listing->post_title;
        }

        $this->add_control(
            'selected_listing',
            [
                'label' => __( 'Select Listing', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => $listing_options,
                'condition' => [
                    'banner_type' => 'auto',
                ],
            ]
        );

        $this->add_control(
            'custom_title',
            [
                'label' => __( 'Custom Title', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Special Offer', 'affiliate-listings' ),
                'condition' => [
                    'banner_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'custom_subtitle',
            [
                'label' => __( 'Custom Subtitle', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Limited time bonus offer', 'affiliate-listings' ),
                'condition' => [
                    'banner_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'custom_button_text',
            [
                'label' => __( 'Button Text', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Get Bonus', 'affiliate-listings' ),
                'condition' => [
                    'banner_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'custom_button_url',
            [
                'label' => __( 'Button URL', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    'banner_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'show_close_button',
            [
                'label' => __( 'Show Close Button', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Position Section
        $this->start_controls_section(
            'position_section',
            [
                'label' => __( 'Position & Behavior', 'affiliate-listings' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner_position',
            [
                'label' => __( 'Position', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom-center',
                'options' => [
                    'bottom-center' => __( 'Bottom Center', 'affiliate-listings' ),
                    'top-center' => __( 'Top Center', 'affiliate-listings' ),
                    'bottom-left' => __( 'Bottom Left', 'affiliate-listings' ),
                    'bottom-right' => __( 'Bottom Right', 'affiliate-listings' ),
                ],
            ]
        );

        $this->add_control(
            'auto_hide',
            [
                'label' => __( 'Auto Hide (seconds)', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'min' => 0,
                'max' => 60,
                'description' => __( 'Set to 0 to disable auto hide', 'affiliate-listings' ),
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label' => __( 'Animation', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'slideUp',
                'options' => [
                    'slideUp' => __( 'Slide Up', 'affiliate-listings' ),
                    'slideDown' => __( 'Slide Down', 'affiliate-listings' ),
                    'fadeIn' => __( 'Fade In', 'affiliate-listings' ),
                    'bounceIn' => __( 'Bounce In', 'affiliate-listings' ),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Banner Style', 'affiliate-listings' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'banner_width',
            [
                'label' => __( 'Width', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 50,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'banner_padding',
            [
                'label' => __( 'Padding', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 16,
                    'right' => 24,
                    'bottom' => 16,
                    'left' => 24,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'banner_background',
            [
                'label' => __( 'Background', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#667eea',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'banner_gradient',
                'label' => __( 'Gradient Background', 'affiliate-listings' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .alm-super-banner',
            ]
        );

        $this->add_control(
            'banner_border_radius',
            [
                'label' => __( 'Border Radius', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'banner_shadow',
                'label' => __( 'Box Shadow', 'affiliate-listings' ),
                'selector' => '{{WRAPPER}} .alm-super-banner',
            ]
        );

        $this->end_controls_section();

        // Typography Section
        $this->start_controls_section(
            'typography_section',
            [
                'label' => __( 'Typography', 'affiliate-listings' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Title Typography', 'affiliate-listings' ),
                'selector' => '{{WRAPPER}} .alm-super-banner-title',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Subtitle Color', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __( 'Subtitle Typography', 'affiliate-listings' ),
                'selector' => '{{WRAPPER}} .alm-super-banner-subtitle',
            ]
        );

        $this->end_controls_section();

        // Button Style Section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => __( 'Button Style', 'affiliate-listings' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'banner_button_style_tabs' );

        $this->start_controls_tab(
            'banner_button_normal_tab',
            [
                'label' => __( 'Normal', 'affiliate-listings' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#667eea',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'banner_button_hover_tab',
            [
                'label' => __( 'Hover', 'affiliate-listings' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#667eea',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Background Color', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f8f9fa',
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'affiliate-listings' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alm-super-banner-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'affiliate-listings' ),
                'selector' => '{{WRAPPER}} .alm-super-banner-button',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if ( $settings['banner_type'] === 'auto' ) {
            // Auto mode - get super recommended listing
            if ( ! empty( $settings['selected_listing'] ) ) {
                $post = get_post( $settings['selected_listing'] );
            } else {
                $post = alm_get_super_recommended_listing();
            }
            
            if ( $post ) {
                $this->render_auto_banner( $post, $settings );
            }
        } else {
            // Custom mode
            $this->render_custom_banner( $settings );
        }
    }

    /**
     * Render auto banner
     */
    private function render_auto_banner( $post, $settings ) {
        $affiliate_url = get_post_meta( $post->ID, '_alm_affiliate_url', true );
        $button_text = get_post_meta( $post->ID, '_alm_button_text', true );
        $bonus_amount = get_post_meta( $post->ID, '_alm_bonus_amount', true );
        
        if ( ! $button_text ) {
            $button_text = __( 'Bonus Al', 'affiliate-listings' );
        }
        
        $this->render_banner_html(
            $post->post_title,
            $bonus_amount ? sprintf( __( 'Special Bonus: %s', 'affiliate-listings' ), $bonus_amount ) : '',
            $button_text,
            $affiliate_url,
            $settings,
            $post->ID
        );
    }

    /**
     * Render custom banner
     */
    private function render_custom_banner( $settings ) {
        $this->render_banner_html(
            $settings['custom_title'],
            $settings['custom_subtitle'],
            $settings['custom_button_text'],
            $settings['custom_button_url']['url'] ?? '',
            $settings
        );
    }

    /**
     * Render banner HTML
     */
    private function render_banner_html( $title, $subtitle, $button_text, $button_url, $settings, $post_id = null ) {
        $banner_classes = array( 'alm-super-banner', 'alm-elementor-banner' );
        $banner_classes[] = 'alm-position-' . $settings['banner_position'];
        $banner_classes[] = 'alm-animation-' . $settings['animation_type'];
        
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $banner_classes ) ); ?>" 
             data-auto-hide="<?php echo esc_attr( $settings['auto_hide'] ); ?>"
             data-animation="<?php echo esc_attr( $settings['animation_type'] ); ?>">
            
            <?php if ( $settings['show_close_button'] === 'yes' ) : ?>
            <button class="alm-super-banner-close" aria-label="<?php _e( 'Close banner', 'affiliate-listings' ); ?>">
                ×
            </button>
            <?php endif; ?>
            
            <div class="alm-super-banner-content">
                <div class="alm-super-banner-text">
                    <?php if ( $title ) : ?>
                    <h3 class="alm-super-banner-title">
                        <?php echo esc_html( $title ); ?>
                    </h3>
                    <?php endif; ?>
                    
                    <?php if ( $subtitle ) : ?>
                    <p class="alm-super-banner-subtitle">
                        <?php echo esc_html( $subtitle ); ?>
                    </p>
                    <?php endif; ?>
                </div>
                
                <?php if ( $button_url && $button_text ) : ?>
                <a href="<?php echo esc_url( $button_url ); ?>" 
                   class="alm-super-banner-button" 
                   target="_blank" 
                   rel="nofollow noopener"
                   <?php if ( $post_id ) : ?>
                   data-post-id="<?php echo esc_attr( $post_id ); ?>"
                   onclick="almTrackClick(<?php echo esc_js( $post_id ); ?>)"
                   <?php endif; ?>>
                    <?php echo esc_html( $button_text ); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            var $banner = $('.alm-elementor-banner');
            var autoHide = parseInt($banner.data('auto-hide'));
            var animation = $banner.data('animation');
            
            // Apply animation
            $banner.addClass('alm-animate-' + animation);
            
            // Auto hide functionality
            if (autoHide > 0) {
                setTimeout(function() {
                    if (!$banner.hasClass('interacted')) {
                        $banner.fadeOut();
                    }
                }, autoHide * 1000);
                
                $banner.on('mouseenter', function() {
                    $(this).addClass('interacted');
                });
            }
            
            // Close button
            $('.alm-super-banner-close').on('click', function(e) {
                e.preventDefault();
                $banner.fadeOut();
            });
        });
        </script>
        
        <style>
        .alm-elementor-banner {
            position: fixed;
            z-index: 9999;
            max-width: 90vw;
        }
        
        .alm-position-bottom-center {
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .alm-position-top-center {
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .alm-position-bottom-left {
            bottom: 20px;
            left: 20px;
        }
        
        .alm-position-bottom-right {
            bottom: 20px;
            right: 20px;
        }
        
        .alm-animate-slideUp {
            animation: almSlideUp 0.5s ease-out;
        }
        
        .alm-animate-slideDown {
            animation: almSlideDown 0.5s ease-out;
        }
        
        .alm-animate-fadeIn {
            animation: almFadeIn 0.5s ease-out;
        }
        
        .alm-animate-bounceIn {
            animation: almBounceIn 0.6s ease-out;
        }
        
        @keyframes almSlideUp {
            from { transform: translateX(-50%) translateY(100%); }
            to { transform: translateX(-50%) translateY(0); }
        }
        
        @keyframes almSlideDown {
            from { transform: translateX(-50%) translateY(-100%); }
            to { transform: translateX(-50%) translateY(0); }
        }
        
        @keyframes almFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes almBounceIn {
            0% { transform: translateX(-50%) scale(0.3); opacity: 0; }
            50% { transform: translateX(-50%) scale(1.05); }
            70% { transform: translateX(-50%) scale(0.9); }
            100% { transform: translateX(-50%) scale(1); opacity: 1; }
        }
        </style>
        <?php
    }

    /**
     * Render widget output in the editor
     */
    protected function content_template() {
        ?>
        <div class="alm-elementor-preview">
            <h3><?php _e( 'Super Banner Widget', 'affiliate-listings' ); ?></h3>
            <p><?php _e( 'This widget displays a fixed super banner for recommended listings.', 'affiliate-listings' ); ?></p>
            
            <div class="alm-preview-banner">
                <div class="alm-preview-banner-content">
                    <div class="alm-preview-banner-text">
                        <# if ( settings.banner_type === 'custom' ) { #>
                        <h4>{{ settings.custom_title }}</h4>
                        <p>{{ settings.custom_subtitle }}</p>
                        <# } else { #>
                        <h4><?php _e( 'Super Recommended Listing', 'affiliate-listings' ); ?></h4>
                        <p><?php _e( 'Special bonus offer available', 'affiliate-listings' ); ?></p>
                        <# } #>
                    </div>
                    <button class="alm-preview-banner-button">
                        <# if ( settings.banner_type === 'custom' ) { #>
                        {{ settings.custom_button_text }}
                        <# } else { #>
                        <?php _e( 'Get Bonus', 'affiliate-listings' ); ?>
                        <# } #>
                    </button>
                </div>
                <# if ( settings.show_close_button === 'yes' ) { #>
                <button class="alm-preview-close">×</button>
                <# } #>
            </div>
        </div>
        
        <style>
        .alm-elementor-preview {
            padding: 20px;
            text-align: center;
            background: #f9f9f9;
            border: 2px dashed #ddd;
            border-radius: 8px;
        }
        .alm-preview-banner {
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 12px 12px 0 0;
            margin: 20px auto;
            max-width: 400px;
        }
        .alm-preview-banner-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .alm-preview-banner-text {
            flex: 1;
            text-align: left;
        }
        .alm-preview-banner-text h4 {
            margin: 0 0 4px 0;
            font-size: 16px;
        }
        .alm-preview-banner-text p {
            margin: 0;
            font-size: 12px;
            opacity: 0.9;
        }
        .alm-preview-banner-button {
            padding: 10px 20px;
            background: white;
            color: #667eea;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        .alm-preview-close {
            position: absolute;
            top: 8px;
            right: 8px;
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            opacity: 0.7;
        }
        </style>
        <?php
    }
}
