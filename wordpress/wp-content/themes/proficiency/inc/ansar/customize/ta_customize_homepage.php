<?php
function proficiency_homepage_setting( $wp_customize ) {
	
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
	class proficiency_Customize_slider_Color_Control extends WP_Customize_Control {
		public $type = 'alphacolor';
        //public $palette = '#3FADD7,#555555,#666666, #F5f5f5,#333333,#404040,#2B4267';
        public $palette = true;
        public $default = '#3FADD7';

        protected function render() {
            $id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
            $class = 'customize-control customize-control-' . $this->type; ?>

        	<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
          		<?php $this->render_content(); ?>
        	</li>
<?php 	}

        public function render_content() { ?>
        <label> 
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<input type="text" data-palette="<?php echo $this->palette; ?>" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="pluto-color-control" <?php $this->link(); ?>  />
		</label>
<?php 	}
    }


    //callout settings
    class proficiency_Customize_contact_color_Control extends WP_Customize_Control {

        public $type = 'alphacolor';
        //public $palette = '#3FADD7,#555555,#666666, #F5f5f5,#333333,#404040,#2B4267';
        public $palette = true;
        public $default = '#3FADD7';

        protected function render() {
            $id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
            $class = 'customize-control customize-control-' . $this->type; ?>
	        <li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
	        	<?php $this->render_content(); ?>
	        </li>
        <?php }

        public function render_content() { ?>
	        <label> 
	        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        	<input type="text" data-palette="<?php echo $this->palette; ?>" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="pluto-color-control" <?php $this->link(); ?>  />
	        </label>
        <?php }
        }

    //menu prize settings
        class proficiency_Customize_Color_Control extends WP_Customize_Control {

            public $type = 'alphacolor';
        //public $palette = '#3FADD7,#555555,#666666, #F5f5f5,#333333,#404040,#2B4267';
            public $palette = true;
            public $default = '#3FADD7';

            protected function render() {
                $id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
                $class = 'customize-control customize-control-' . $this->type; ?>
		        <li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
		            <?php $this->render_content(); ?>
		        </li>
        <?php }

        public function render_content() { ?>
	        <label> 
	        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	          	<input type="text" data-palette="<?php echo $this->palette; ?>" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="pluto-color-control" <?php $this->link(); ?>  />
	        </label>
        <?php }
            }

            
            $wp_customize->add_panel( 'slider_setting', array(
                'priority'       => 50,
                'capability'     => 'edit_theme_options',
                'title'      => __('Slider Section', 'proficiency'),
            ) );

            /* --------------------------------------
            =========================================
            Slider Section
            =========================================
            -----------------------------------------*/ 
            $wp_customize->add_section(
                'proficiency_slider_section_settings', array(
                'title' => __('Slider Setting','proficiency'),
                'description' => '',
                'panel'  => 'slider_setting',
            ) );
			
			//Enable slider
			$wp_customize->add_setting(
		    	'proficiency_slider_enable', array(
		        'capability'     => 'edit_theme_options',
		        'default' => true,
		        'sanitize_callback' => 'proficiency_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_slider_enable', array(
		    	'label'   => __('Enable Slider Section','proficiency'),
		    	'section' => 'proficiency_slider_section_settings',
		    	'type' => 'checkbox',
		    ) );
			
			/* --------------------------------------
		    =========================================
		    Service Section
		    =========================================
		    -----------------------------------------*/  
		    
		     $wp_customize->add_panel( 'service_setting', array(
                'priority'       => 51,
                'capability'     => 'edit_theme_options',
                'title'      => __('Service Section', 'proficiency'),
            ) );
		    
		    // add section to manage Services
		    $wp_customize->add_section(
		        'proficiency_service_section_settings', array(
		        'title' => __('Service Setting','proficiency'),
		        'description' => '',
		        'panel'  => 'service_setting',
		    ) );

			
			$wp_customize->add_setting(
		    	'proficiency_service_enable', array(
		        'capability'     => 'edit_theme_options',
		        'default' => true,
		        'sanitize_callback' => 'proficiency_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_service_enable', array(
		    	'label'   => __('Enable Service Section','proficiency'),
		    	'section' => 'proficiency_service_section_settings',
		    	'type' => 'checkbox',
		    ) );
			
			

            //Service Overlay Image
            $wp_customize->add_setting( 
		    	'proficiency_service_background_color', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
                'proficiency_service_background_color', array(
                'label'    => 'Overlay Color',
                'palette' => true,
                'section'  => 'proficiency_service_section_settings')
            ) );

            //Service Title setting
		   	$wp_customize->add_setting(
                'proficiency_service_title', array(
                'default' => __('Our <span>Services</span>','proficiency'),
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'proficiency_title_sanitize_text',
            ) );	
            $wp_customize->add_control( 
            	'proficiency_service_title',array(
                'label'   => '',
                'section' => 'proficiency_service_section_settings',
                'type' => 'text',
            ) );

            //Service SubTitle setting
            $wp_customize->add_setting(
                'proficiency_service_subtitle', array(
                'default' =>__('we offer totally integrated service beyond the web','proficiency'),
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'proficiency_title_sanitize_text',
            ) );  
            $wp_customize->add_control( 'proficiency_service_subtitle', array(
                'label'   => __('Service Subtitle','proficiency'),
                'section' => 'proficiency_service_section_settings',
                'type' => 'textarea',
            ) );

            
			

		    /* --------------------------------------
		    =========================================
		    Callout Section
		    =========================================
		    -----------------------------------------*/
		    
		     $wp_customize->add_panel( 'callout_setting', array(
                'priority'       => 52,
                'capability'     => 'edit_theme_options',
                'title'      => __('Callout Section', 'proficiency'),
            ) );
		    
		    // add section to manage Callout
		    $wp_customize->add_section(
		    	'proficiency_callout_section_settings', array(
		        'title' => __('Callout Setting','proficiency'),
		        'description' => '',
		        'panel'  => 'callout_setting',
		    ) );
			
			//Callout Enable / Disable setting
			$wp_customize->add_setting(
		    	'proficiency_callout_enable', array(
		        'capability'     => 'edit_theme_options',
		        'default' => true,
		        'sanitize_callback' => 'proficiency_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_enable', array(
		    	'label'   => __('Enable Callout section','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );
			

		    //Callout Background image
		    $wp_customize->add_setting( 
		    	'proficiency_callout_background', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );

		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
		    	'proficiency_callout_background', array(
		    	'label'    => __( 'Choose Background Image', 'proficiency' ),
		    	'section'  => 'proficiency_callout_section_settings',
		    	'settings' => 'proficiency_callout_background',) 
		    ) );

		    //Callout align Setting
            $wp_customize->add_setting(
                'proficiency_callout_text_align', array(
                'default'        => 'center',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'proficiency_title_sanitize_text',
            ) );  
            $wp_customize->add_control( 
                'proficiency_callout_text_align',array(
                'label'   => __('Callout Text Align','proficiency'),
                'section' => 'proficiency_callout_section_settings',
                'type' => 'radio',
                'choices'=>array('left'=>'text-left','center'=>'text-center','right'=>'text-right'),
            ) );

		    // Callout Title Setting
		    $wp_customize->add_setting(
		    	'proficiency_callout_title', array(
		        'default' => __('Why Choose Us','proficiency'),
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_title', array(
		    	'label'   => __('Callout Title','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'text',
		    ) );	

			// Callout Description Setting	    
		    $wp_customize->add_setting(
		    	'proficiency_callout_description', array(
		        'default' => __('laoreet ipsum eu laoreet. ugiignissimat Vivamus dignissim feugiat erat sit amet convallis.','proficiency'),
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_description', array(
		    	'label'   => __('Callout Description','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'textarea',
		    ) );	

		    // Callout Button One Label Setting	 
		    $wp_customize->add_setting(
		    	'proficiency_callout_button_one_label', array(
		        'default' => __('','proficiency'),
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_button_one_label', array(
		    	'label'   => __('Button One Title','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button One Link Setting	
		    $wp_customize->add_setting(
		    	'proficiency_callout_button_one_link', array(
		        'default' => __('#','proficiency'),
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_button_one_link',array(
		    	'label'   => __('Button One URL','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button One Target Setting	
		    $wp_customize->add_setting(
		    	'proficiency_callout_button_one_target', array(
		        'default' => 'true',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_button_one_target',array(
		    	'label'   => __('Open Link New window','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );

		    //Callout Button Two Label Setting	
		    $wp_customize->add_setting(
		    	'proficiency_callout_button_two_label', array(
		        'default' => '',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_button_two_label', array(
		    	'label'   => __('Button Two Title','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button Two Link Setting
		    $wp_customize->add_setting(
		    	'proficiency_callout_button_two_link', array(
		        'default' => '#',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_button_two_link', array(
		    	'label'   => __('Button Two URL','proficiency'),
		    	'type' => 'text',
		    	'section' => 'proficiency_callout_section_settings',
		    ) );	

		    //Callout Button Two Target Setting
		    $wp_customize->add_setting(
		    	'proficiency_callout_button_two_target', array(
		        'default' => 'true',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_callout_button_two_target', array(
		    	'label'   => __('Open Link New window','proficiency'),
		    	'section' => 'proficiency_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );
			
			
			
			
		    /* --------------------------------------
		    =========================================
		    Latest News Section
		    =========================================
		    -----------------------------------------*/
		    // add section to manage Latest News
		    
		    $wp_customize->add_panel( 'news_setting', array(
                'priority'       => 53,
                'capability'     => 'edit_theme_options',
                'title'      => __('News Section', 'proficiency'),
            ) );
		    
		    
		    $wp_customize->add_section(
		    	'news_section_settings', array(
		        'title' => __('News & Events Setting','proficiency'),
		        'description' => '',
		        'panel'  => 'news_setting'
		    ) );
			
			//Latest News Enable / Disable setting
			$wp_customize->add_setting(
		    	'proficiency_news_enable', array(
		        'capability'     => 'edit_theme_options',
		        'default' => true,
		        'sanitize_callback' => 'proficiency_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_news_enable', array(
		    	'label'   => __('Enable Latest News section','proficiency'),
		    	'section' => 'news_section_settings',
		    	'type' => 'checkbox',
		    ) );
			

		    //Latest News Background Image
		    $wp_customize->add_setting( 
		    	'news_background', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
		    	'news_background', array(
		    	'label'    => __( 'Choose Background Image', 'proficiency' ),
		    	'section'  => 'news_section_settings',
		    	'settings' => 'news_background', ) 
		    ) );

			// Latest News Title Setting
		    $wp_customize->add_setting(
		    	'proficiency_news_title', array(
		        'default' => 'Latest <span>News</span>',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_news_title',array(
		    	'label'   => __('Latest News Title','proficiency'),
		    	'section' => 'news_section_settings',
		    	'type' => 'text',
		    ) );

		    // Latest News Subtitle Setting
		    $wp_customize->add_setting(
		    	'proficiency_news_subtitle', array(
		        'default' => 'laoreet ipsum eu laoreet. ugiignissimat Vivamus dignissim feugiat erat sit amet convallis.',
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );  
		    $wp_customize->add_control( 
		    	'proficiency_news_subtitle',array(
		    	'label'   => __('Latest News Subtitle','proficiency'),
		    	'section' => 'news_section_settings',
		    	'type' => 'textarea',
		    ) );	

		   /* --------------------------------------
		    =========================================
		    Contact Section
		    =========================================
		    -----------------------------------------*/
		    $wp_customize->add_panel( 'contact_setting', array(
                'priority'       => 54,
                'capability'     => 'edit_theme_options',
                'title'      => __('Contact Section', 'proficiency'),
            ) );
		    
		    
		    //Contact settings
		    $wp_customize->add_section(
		    	'proficiency_contact_section_settings', array(
		        'title' => __('Contact Setting','proficiency'),
		        'panel'  => 'contact_setting',
		    ) );
			
			//Contact Enable / Disable setting
			$wp_customize->add_setting(
		    	'proficiency_contact_enable', array(
		        'capability'     => 'edit_theme_options',
		        'default' => true,
		        'sanitize_callback' => 'proficiency_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'proficiency_contact_enable', array(
		    	'label'   => __('Enable Contact section','proficiency'),
		    	'section' => 'proficiency_contact_section_settings',
		    	'type' => 'checkbox',
		    ) );
			
			

			//Contact Background Image
		    $wp_customize->add_setting( 
		    	'proficiency_contact_background', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );

		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
		    	'proficiency_contact_background', array(
		    	'label' => __('Choose Background Image','proficiency' ),
		    	'section' => 'proficiency_contact_section_settings',
		    	'settings' => 'proficiency_contact_background', ) 
		    ) );

		    //Contact Title setting
		    $wp_customize ->add_setting (
		    	'proficiency_contact_title', array( 
		       	'default' => __('Get in <span>touch</span>','proficiency'),
		       	'capability'     => 'edit_theme_options',
		       	'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );
		    $wp_customize->add_control(
		    	'proficiency_contact_title', array(  
		       'label' => __('Contact Title','proficiency'),
		       'section' => 'proficiency_contact_section_settings',
		       'type' => 'text',
		    ) );

		    //Contact Subtitle Setting
		    $wp_customize->add_setting(
		    	'proficiency_contact_subtitle', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'proficiency_title_sanitize_text',
		    ) );  
		    $wp_customize->add_control( 
		    	'proficiency_contact_subtitle', array(
		    	'label' => __('Contact Subtitle','proficiency'),
		    	'section' => 'proficiency_contact_section_settings',
		    	'type' => 'textarea',
		    ) );

			
			function proficiency_title_sanitize_text( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

			}


			function proficiency_homepage_sanitize_checkbox( $input ) {
			// Boolean check 
			return ( ( isset( $input ) && true == $input ) ? true : false );
			}
}

add_action( 'customize_register', 'proficiency_homepage_setting' );
?>