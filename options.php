<?php
$redux_url = '';
if( class_exists('ReduxFramework') ){
	$redux_url = ReduxFramework::$_url;
}

$logo_url 					= get_template_directory_uri() . '/images/logo.png'; 
$favicon_url 				= get_template_directory_uri() . '/images/favicon.ico';

$color_image_folder = get_template_directory_uri() . '/admin/assets/images/colors/';
$list_colors = array('default');
$preset_colors_options = array();
foreach( $list_colors as $color ){
	$preset_colors_options[$color] = array(
					'alt'      => $color
					,'img'     => $color_image_folder . $color . '.jpg'
					,'presets' => miti_get_preset_color_options( $color )
	);
}

$family_fonts = array(
	"Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif"
	,"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif"
	,"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif"
	,"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive"
	,"Courier, monospace"                                   => "Courier, monospace"
	,"Garamond, serif"                                      => "Garamond, serif"
	,"Georgia, serif"                                       => "Georgia, serif"
	,"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif"
	,"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace"
	,"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"
	,"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif"
	,"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif"
	,"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif"
	,"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif"
	,"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif"
	,"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif"
	,"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif"
	,"CustomFont"                          					=> "CustomFont"
);

$header_layout_options = array();
$header_image_folder = get_template_directory_uri() . '/admin/assets/images/headers/';
for( $i = 1; $i <= 2; $i++ ){
	$header_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Header Layout %s', 'miti'), $i)
		,'img' => $header_image_folder . 'header_v'.$i.'.jpg'
	);
}

$loading_screen_options = array();
$loading_image_folder = get_template_directory_uri() . '/images/loading/';
for( $i = 1; $i <= 10; $i++ ){
	$loading_screen_options[$i] = array(
		'alt'  => sprintf(esc_html__('Loading Image %s', 'miti'), $i)
		,'img' => $loading_image_folder . 'loading_'.$i.'.svg'
	);
}

$footer_block_options = miti_get_footer_block_options();

$breadcrumb_layout_options = array();
$breadcrumb_image_folder = get_template_directory_uri() . '/admin/assets/images/breadcrumbs/';
for( $i = 1; $i <= 3; $i++ ){
	$breadcrumb_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'miti'), $i)
		,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
	);
}

$sidebar_options = array();
$default_sidebars = miti_get_list_sidebars();
if( is_array($default_sidebars) ){
	foreach( $default_sidebars as $key => $_sidebar ){
		$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
	}
}

$product_loading_image = get_template_directory_uri() . '/images/prod_loading.gif';

$option_fields = array();

/*** General Tab ***/
$option_fields['general'] = array(
	array(
		'id'        => 'section-logo-favicon'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Logo - Favicon', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_logo'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Logo', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select an image file for the main logo', 'miti' )
		,'readonly' => false
		,'default'  => array( 'url' => $logo_url )
	)
	,array(
		'id'        => 'ts_logo_mobile'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Mobile Logo', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on mobile', 'miti' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_sticky'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Sticky Logo', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on sticky header', 'miti' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'miti' )
		,'default'  => '100'
	)
	,array(
		'id'        => 'ts_device_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width on Device', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'miti' )
		,'default'  => '100'
	)
	,array(
		'id'        => 'ts_favicon'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Favicon', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a PNG, GIF or ICO image', 'miti' )
		,'readonly' => false
		,'default'  => array( 'url' => $favicon_url )
	)
	,array(
		'id'        => 'ts_text_logo'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Text Logo', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Miti'
	)
	
	,array(
		'id'        => 'section-layout-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Layout Style', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_header_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_main_content_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Main Content Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_footer_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Footer Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_layout_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout Style', 'miti' )
		,'subtitle' => esc_html__( 'You can override this option for the individual page', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'wide' 		=> 'Wide'
			,'boxed' 	=> 'Boxed'
		)
		,'default'  => 'wide'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '0' )
	)
	
	,array(
		'id'        => 'section-rtl'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Right To Left', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_rtl'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Right To Left', 'miti' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-smooth-scroll'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Smooth Scroll', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_smooth_scroll'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Smooth Scroll', 'miti' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-back-to-top-button'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Back To Top Button', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_back_to_top_button'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_back_to_top_button_on_mobile'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button On Mobile', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'section-page-not-found'
		,'type'     => 'section'
		,'title'    => esc_html__( '404 Page', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_image_not_found'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( '404 Image', 'miti' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_404_new_arrival_products'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Latest Products', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_device_hide_image'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Hide 404 Image On Device', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-loading-screen'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Loading Screen', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_loading_screen'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Loading Screen', 'miti' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_loading_image'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Loading Image', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $loading_screen_options
		,'default'  => '1'
	)
	,array(
		'id'        => 'ts_custom_loading_image'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Custom Loading Image', 'miti' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'       	=> 'ts_display_loading_screen_in'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Display Loading Screen In', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'all-pages' 		=> esc_html__( 'All Pages', 'miti' )
			,'homepage-only' 	=> esc_html__( 'Homepage Only', 'miti' )
			,'specific-pages' 	=> esc_html__( 'Specific Pages', 'miti' )
		)
		,'default'  => 'all-pages'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_loading_screen_exclude_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Exclude Pages', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'all-pages' )
	)
	,array(
		'id'       	=> 'ts_loading_screen_specific_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Specific Pages', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'specific-pages' )
	)
);

/*** Color Scheme Tab ***/
$option_fields['color-scheme'] = array(
	array(
		'id'          => 'ts_color_scheme'
		,'type'       => 'image_select'
		,'presets'    => true
		,'full_width' => false
		,'title'      => esc_html__( 'Select Color Scheme of Theme', 'miti' )
		,'subtitle'   => ''
		,'desc'       => ''
		,'options'    => $preset_colors_options
		,'default'    => 'default'
		,'class'      => 'hidden'
	)
	,array(
		'id'        => 'section-general-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'General Colors', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-primary-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Primary Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_primary_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Primary Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#FF6E00'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color_in_bg_primary'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color In Background Primary Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-main-content-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Main Content Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_main_content_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Main Content Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_bold_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Bold Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_gray_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Gray Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#808080'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Heading Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#FF6E00'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color Hover', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#FF6E00'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_blockquote_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Blockquote Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_blockquote_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Blockquote Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#d9d9d9'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Border Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e6e6e6'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-input-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Input Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_input_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f2f2f2'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Border Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f2f2f2'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Button Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_button_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Border Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color Hover', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_background_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Hover', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> 'transparent'
			,'alpha'	=> 0
			,'rgba'		=> 'rgba(25,25,25,0)'
		)
	)
	,array(
		'id'       => 'ts_button_border_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Border Color Hover', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-breadcrumb-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Breadcrumb Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_breadcrumb_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Link Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#808080'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-header-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Colors', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_notice_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Store Notice Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_notice_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Store Notice Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#FF6E00'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Border Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#242424'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_middle_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Middle Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_middle_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Middle Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_bottom_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Bottom Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_bottom_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Bottom Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_icon_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Icon Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_icon_count_bg_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Icon Count Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_icon_count_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Icon Count Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-product-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Colors', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_product_name_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Name Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Rating Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#E6E6E6'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_fill_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Rating Fill Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_detail_reviews_separate_background'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Detail Reviews Separate Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f5f5f5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_counter_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Count Down Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#FF6E00'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_counter_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Count Down Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-product-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Buttons on Thumbnail Color', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color Hover', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_background_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Hover', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_tooltip_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Tooltip Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_tooltip_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Tooltip Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-product-label-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Label Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_sale_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#FF6E00'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#9a9a9a'
			,'alpha'	=> 1
		)
	)	
	,array(
		'id'      => 'info-mobile-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Tablet/Mobile Colors', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_button_mobile_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile/Tablet Add to cart/Wistlist/Compare Button Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_mobile_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile/Tablet Add to cart/Wistlist/Compare Button Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f3f3f3'
			,'alpha'	=> 1
		)
	)	
	,array(
		'id'       => 'ts_product_group_button_fixed_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile Fixed Bottom Bar Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_group_button_fixed_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile Fixed Bottom Bar Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_group_button_fixed_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile Fixed Bottom Bar Border Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#d9d9d9'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Background Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Text Color', 'miti' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
);

/*** Typography Tab ***/
$option_fields['typography'] = array(
	array(
		'id'        => 'section-fonts'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Fonts', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       			=> 'ts_body_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font', 'miti' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Jost'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '15px'
			,'line-height' 		=> '22px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_medium'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font Medium', 'miti' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'font-size'  		=> false
		,'letter-spacing' 	=> true
		,'color'   			=> false
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Jost'
			,'font-weight' 		=> '500'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_bold'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font Bold', 'miti' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'font-size'  		=> false
		,'letter-spacing' 	=> true
		,'color'   			=> false
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Jost'
			,'font-weight' 		=> '600'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_heading_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading Font', 'miti' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'font-size'  		=> false
		,'letter-spacing' 	=> true
		,'color'   			=> false
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Jost'
			,'font-weight' 		=> '500'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Menu Font', 'miti' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Jost'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '16px'
			,'line-height' 		=> '22px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'        => 'section-custom-font'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Custom Font', 'miti' )
		,'subtitle' => esc_html__( 'If you get the error message \'Sorry, this file type is not permitted for security reasons\', you can add this line define(\'ALLOW_UNFILTERED_UPLOADS\', true); to the wp-config.php file', 'miti' )
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_custom_font_ttf'
		,'type'     => 'media'
		,'url'      => true
		,'preview'  => false
		,'title'    => esc_html__( 'Custom Font ttf', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Upload the .ttf font file. To use it, you select CustomFont in the Standard Fonts group', 'miti' )
		,'default'  => array( 'url' => '' )
		,'mode'		=> 'application'
	)
	
	,array(
		'id'        => 'section-font-sizes'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Font Sizes', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-font-size-pc'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on PC', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_big_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Big Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '70px'
			,'line-height' => '76px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h1_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '60px'
			,'line-height' => '66px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '40px'
			,'line-height' => '44px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h3_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '30px'
			,'line-height' => '34px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h4_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '25px'
			,'line-height' => '36px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h5_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H5 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  		=> ''
			,'font-weight'		=> ''
			,'font-size'   		=> '20px'
			,'line-height' 		=> '24px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h6_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H6 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '16px'
			,'line-height' => '22px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_button_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Button Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => true
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '16px'
			,'line-height' => '24px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_input_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Input Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => true
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '15px'
			,'line-height' => '22px'
			,'google'	   => false
		)
	)
	,array(
		'id'      => 'info-font-size-ipad'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on device', 'miti' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_big_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Big Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '45px'
			,'line-height' => '50px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h1_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '45px'
			,'line-height' => '50px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '30px'
			,'line-height' => '34px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h3_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '25px'
			,'line-height' => '30px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h4_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '20px'
			,'line-height' => '24px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h5_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H5 Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '18px'
			,'line-height' => '22px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_menu_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Menu Font Size', 'miti' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => true
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '15px'
			,'line-height' => '20px'
			,'google'	   => false
		)
	)
);

/*** Header Tab ***/
$option_fields['header'] = array(
	array(
		'id'        => 'section-header-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Options', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_header_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Header Layout', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $header_layout_options
		,'default'  => 'v1'
	)
	,array(
		'id'		=> 'ts_list_page_1'
		,'type'     => 'select'
		,'title'	=> esc_html__( 'List page 1', 'miti' )
		,'subtitle'	=> esc_html__( 'Show list of pages. Only available for header layout 1', 'miti' )
		,'multi'    => true
		,'sortable'	=> true
		,'desc'		=> ''
		,'data'		=> 'pages'
		,'default'  => ''
	)
	,array(
		'id'		=> 'ts_list_page_2'
		,'type'     => 'select'
		,'title'	=> esc_html__( 'List page 2', 'miti' )
		,'subtitle'	=> esc_html__( 'Show list of pages. Only available for header layout 1', 'miti' )
		,'multi'    => true
		,'sortable'	=> true
		,'desc'		=> ''
		,'data'		=> 'pages'
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_enable_sticky_header'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Sticky Header', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_enable_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Search', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_enable_tiny_wishlist'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Wishlist', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_header_currency'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Currency', 'miti' )
		,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WooCommerce Multilingual plugin, it may display demo html', 'miti' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_header_language'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Language', 'miti' )
		,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WPML plugin, it may display demo html', 'miti' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_enable_tiny_account'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'My Account', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_enable_tiny_shopping_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_shopping_cart_sidebar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart Sidebar', 'miti' )
		,'subtitle' => esc_html__( 'Show shopping cart in sidebar instead of dropdown. You need to update cart after changing', 'miti' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
		,'required'	=> array( 'ts_enable_tiny_shopping_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_show_shopping_cart_after_adding'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Shopping Cart After Adding Product To Cart', 'miti' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products', 'miti' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
		,'required'	=> array( 'ts_shopping_cart_sidebar', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_add_to_cart_effect'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Add To Cart Effect', 'miti' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products. If "Show Shopping Cart After Adding Product To Cart" is enabled, this option will be disabled', 'miti' )
		,'options'  => array(
			'0'				=> esc_html__( 'None', 'miti' )
			,'fly_to_cart'	=> esc_html__( 'Fly To Cart', 'miti' )
			,'show_popup'	=> esc_html__( 'Show Popup', 'miti' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_header_store_notice'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Header Store Notice', 'miti' )
		,'subtitle' => esc_html__( 'You can add a notice at the top of page', 'miti' )
		,'desc'     => ''
		,'validate' => 'html'
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_enable_header_social_icons'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Social Icons', 'miti' )
		,'subtitle' => esc_html__( 'Some header layouts don\'t include the social icons', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'miti' )
		,'off'		=> esc_html__( 'Disable', 'miti' )
	)
	,array(
		'id'        => 'ts_facebook_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Facebook URL', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_twitter_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Twitter URL', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_instagram_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Instagram URL', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_youtube_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Youtube URL', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_linkedin_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'LinkedIn URL', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Social URL', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_class'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Social Name', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-breadcrumb-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Breadcrumb Options', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_breadcrumb_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Breadcrumb Layout', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $breadcrumb_layout_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_enable_breadcrumb_background_image'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Image', 'miti' )
		,'subtitle' => esc_html__( 'You can set background color by going to Color Scheme tab > Breadcrumb Colors section', 'miti' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_bg_breadcrumbs'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Breadcrumbs Background Image', 'miti' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a new image to override the default background image', 'miti' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_breadcrumb_bg_parallax'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Parallax', 'miti' )
		,'subtitle' => ''
		,'default'  => false
	)
);

/*** Footer Tab ***/
$option_fields['footer'] = array(
	array(
		'id'       	=> 'ts_footer_block'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Footer Block', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $footer_block_options
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
);

/*** Menu Tab ***/
$option_fields['menu'] = array(
	array(
		'id'             => 'ts_menu_thumb_width'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Width', 'miti' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 50, step: 1, default value: 46', 'miti' )
		,'default'       => 46
		,'min'           => 5
		,'step'          => 1
		,'max'           => 50
		,'display_value' => 'text'
	)
	,array(
		'id'             => 'ts_menu_thumb_height'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Height', 'miti' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 50, step: 1, default value: 46', 'miti' )
		,'default'       => 46
		,'min'           => 5
		,'step'          => 1
		,'max'           => 50
		,'display_value' => 'text'
	)
);

/*** Blog Tab ***/
$option_fields['blog'] = array(
	array(
		'id'        => 'section-blog'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Layout', 'miti' )
		,'subtitle' => esc_html__( 'This option is available when Front page displays the latest posts', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'miti')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-1'
	)
	,array(
		'id'       	=> 'ts_blog_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Blog Columns', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			0	=> esc_html__( 'Default', 'miti' )
			,1	=> 1
			,2	=> 2
			,3	=> 3
		)
		,'default'  => '1'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_filter_bar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Filter Bar', 'miti' )
		,'subtitle' => esc_html__( 'Filter blog based on category', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_read_more'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Read More Button', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_excerpt'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Tags', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_excerpt_strip_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt Strip All Tags', 'miti' )
		,'subtitle' => esc_html__( 'Strip all html tags in Excerpt', 'miti' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_blog_excerpt_max_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Excerpt Max Words', 'miti' )
		,'subtitle' => esc_html__( 'Input -1 to show full excerpt', 'miti' )
		,'desc'     => ''
		,'default'  => '-1'
	)
	,array(
		'id'        => 'ts_show_blog_banner'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Blog Banner', 'miti' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_blog_banner'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Blog Banner Image', 'miti' )
		,'desc'     => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
		,'required'	=> array( 'ts_show_blog_banner', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_banner_link'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Banner Link', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_show_blog_banner', 'equals', '1' )
	)

	,array(
		'id'        => 'section-blog-details'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog Details', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_details_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Details Layout', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'miti')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_blog_details_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_details_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_details_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Blog Style', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'style-1' 	=> esc_html__( 'Style 1', 'miti' )
			,'style-2'	=> esc_html__ ( 'Style 2', 'miti' )
		)
		,'default'  => 'style-1'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_details_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Content', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Tags', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing - Use ShareThis', 'miti' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'miti')
		,'default'  => true
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Sharing - ShareThis Key', 'miti' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'miti' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_author_box'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author Box', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_navigation'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Navigation', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Related Posts', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_blog_details_comment_form'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment Form', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
);

/*** Portfolio Details Tab ***/
$option_fields['portfolio-details'] = array(
	array(
		'id'       	=> 'ts_portfolio_page'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Portfolio Page', 'miti' )
		,'subtitle' => esc_html__( 'Select the page which displays the list of portfolios. You also need to add our portfolio shortcode to that page', 'miti' )
		,'desc'     => ''
		,'data'     => 'pages'
		,'default'	=> ''
	)
	,array(
		'id'       	=> 'ts_portfolio_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout', 'miti' )
		,'subtitle' => esc_html__( 'Display thumbnail at the top or left of content', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'top-thumbnail'		=> esc_html__( 'Top Thumbnail', 'miti' )
			,'left-thumbnail'	=> esc_html__( 'Left Thumbnail', 'miti' )
		)
		,'default'	=> 'left-thumbnail'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_portfolio_thumbnail_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Thumbnail Style', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'slider'	=> esc_html__( 'Slider', 'miti' )
			,'gallery'	=> esc_html__( 'Gallery', 'miti' )
		)
		,'default'	=> 'gallery'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_portfolio_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Thumbnail', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Title', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Date', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_likes'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Likes', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Content', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_client'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Client', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_year'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Year', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_url'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio URL', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Categories', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Sharing', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Related Posts', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Custom Field', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Portfolio Custom Field Title', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom'
		,'required'	=> array( 'ts_portfolio_custom_field', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Portfolio Custom Field Content', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom content goes here'
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
		,'required'	=> array( 'ts_portfolio_custom_field', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_related_portfolio_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Related Portfolios Layout', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'grid' 		=> esc_html__( 'Grid', 'miti' )
			,'slider' 		=> esc_html__( 'Slider', 'miti' )
		)
		,'default'	=> 'grid'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_number_related_portfolio'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Number Of Related Portfolios', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			3	=> 3
			,4	=> 4
			,5	=> 5
			,6	=> 6
			,7	=> 7
			,8	=> 8
		)
		,'default'	=> '3'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'		=>	'ts_related_portfolios_original_image'
		,'type'		=> 	'switch'
		,'title'	=>	esc_html__( 'Related Portfolios Original Image', 'miti' )
		,'subtitle'	=>	esc_html__( 'Use original image instead of thumbnail', 'miti' )
		,'desc'		=>	''
		,'default'  => 	true
	)
);

/*** WooCommerce Tab ***/
$option_fields['woocommerce'] = array(
	array(
		'id'        => 'section-product-label'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Label', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_label_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Label Style', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'rectangle' 	=> esc_html__( 'Rectangle', 'miti' )
			,'square' 		=> esc_html__( 'Square', 'miti' )
			,'circle' 		=> esc_html__( 'Circle', 'miti' )
		)
		,'default'  => 'rectangle'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_product_show_new_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product New Label', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_product_new_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Text', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'New'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_show_new_label_time'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Time', 'miti' )
		,'subtitle' => esc_html__( 'Number of days which you want to show New label since product is published', 'miti' )
		,'desc'     => ''
		,'default'  => '30'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_sale_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sale Label Text', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sale'
	)
	,array(
		'id'        => 'ts_product_feature_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Feature Label Text', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Hot'
	)
	,array(
		'id'        => 'ts_product_out_of_stock_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Out Of Stock Label Text', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sold out'
	)
	,array(
		'id'       	=> 'ts_show_sale_label_as'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Show Sale Label As', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'text' 		=> esc_html__( 'Text', 'miti' )
			,'number' 	=> esc_html__( 'Number', 'miti' )
			,'percent' 	=> esc_html__( 'Percent', 'miti' )
		)
		,'default'  => 'percent'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-rating'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Rating', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_rating_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Rating Style', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'border' 		=> esc_html__( 'Border', 'miti' )
			,'fill' 		=> esc_html__( 'Fill', 'miti' )
		)
		,'default'  => 'fill'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)

	,array(
		'id'        => 'section-product-hover'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Hover', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_hover_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Hover Style', 'miti' )
		,'subtitle' => esc_html__( 'Select the style of buttons/icons when hovering on product', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'hover-vertical-style' 			=> esc_html__( 'Vertical Style', 'miti' )
			,'hover-vertical-style-2' 		=> esc_html__( 'Vertical Style 2', 'miti' )
		)
		,'default'  => 'hover-vertical-style-2'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_effect_product'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Back Product Image', 'miti' )
		,'subtitle' => esc_html__( 'Show another product image on hover. It will show an image from Product Gallery', 'miti' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_product_tooltip'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tooltip', 'miti' )
		,'subtitle' => esc_html__( 'Show tooltip when hovering on buttons/icons on product', 'miti' )
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-lazy-load'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Lazy Load', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_lazy_load'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Lazy Load', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_placeholder_img'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Placeholder Image', 'miti' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => $product_loading_image )
	)
	
	,array(
		'id'        => 'section-quickshop'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Quickshop', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_quickshop'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Quickshop', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-catalog-mode'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Catalog Mode', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_catalog_mode'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Catalog Mode', 'miti' )
		,'subtitle' => esc_html__( 'Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off', 'miti' )
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-ajax-search'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ajax Search', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_ajax_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Ajax Search', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_ajax_search_number_result'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number Of Results', 'miti' )
		,'subtitle' => esc_html__( 'Input -1 to show all results', 'miti' )
		,'desc'     => ''
		,'default'  => '4'
	)
);

/*** Shop/Product Category Tab ***/
$option_fields['shop-product-category'] = array(
	array(
		'id'        => 'ts_prod_cat_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Shop/Product Category Layout', 'miti' )
		,'subtitle' => esc_html__( 'Sidebar is only available if Filter Widget Area is disabled', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'miti')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_cat_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Columns', 'miti' )
		,'subtitle' => esc_html__( 'Select the product columns which displays the style products on Shop/Product categories. In which the column \'1\' has 2 types to choose.', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'1'			=> '1'
			,'1-1'  	=> esc_html__( '1 - big thumbnail', 'miti')
			,'2'		=> '2'
			,'3'		=> '3'
			,'4'		=> '4'
			,'5'		=> '5'
			,'6'		=> '6'
		)
		,'default'  => '6'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_columns_selector'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Columns Selector', 'miti' )
		,'subtitle' => esc_html__( 'Allow users to select columns on frontend', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_quantity_input'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Quantity Input', 'miti' )
		,'subtitle' => esc_html__( 'Show the quantity input on the list view (one column)', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_availability'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Availability', 'miti' )
		,'subtitle' => 'Show the Product Availability on the list view (one column)'
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_per_page'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Products Per Page', 'miti' )
		,'subtitle' => esc_html__( 'Number of products per page', 'miti' )
		,'desc'     => ''
		,'default'  => '30'
	)
	,array(
		'id'       	=> 'ts_prod_cat_loading_type'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Loading Type', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'			=> esc_html__( 'Default', 'miti' )
			,'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'miti' )
			,'load-more-button'	=> esc_html__( 'Load More Button', 'miti' )
			,'ajax-pagination'	=> esc_html__( 'Ajax Pagination', 'miti' )
		)
		,'default'  => 'ajax-pagination'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_per_page_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products Per Page Dropdown', 'miti' )
		,'subtitle' => esc_html__( 'Allow users to select number of products per page', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_onsale_checkbox'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products On Sale Checkbox', 'miti' )
		,'subtitle' => esc_html__( 'Allow users to view only the discounted products', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_filter_widget_area'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Filter Widget Area', 'miti' )
		,'subtitle' => esc_html__( 'Display Filter Widget Area on the Shop/Product Category page. If enabled, sidebar will be removed', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_show_filter_widget_area_by_default'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Filter Widget Area By Default', 'miti' )
		,'subtitle' => esc_html__( 'Show Filter Widget Area by default and hide the Filter button on Desktop', 'miti' )
		,'default'  => false
		,'required'	=> array( 'ts_filter_widget_area', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_cat_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Short Description - Limit Words', 'miti' )
		,'subtitle' => esc_html__( 'It is also used for product shortcode', 'miti' )
		,'desc'     => ''
		,'default'  => '8'
	)
	,array(
		'id'        => 'ts_prod_cat_color_swatch'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Swatches', 'miti' )
		,'subtitle' => esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'miti' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_number_color_swatch'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Number Of Color Swatches', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			2	=> 2
			,3	=> 3
			,4	=> 4
			,5	=> 5
			,6	=> 6
		)
		,'default'  => '3'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_color_swatch', 'equals', '1' )
	)
);

/*** Product Details Tab ***/
$option_fields['product-details'] = array(
	array(
		'id'        => 'ts_prod_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Product Layout', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'miti')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'miti')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_layout_fullwidth'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Layout Fullwidth', 'miti' )
		,'subtitle' => esc_html__( 'Override the Layout Fullwidth option in the General tab', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'miti' )
			,'0'		=> esc_html__( 'No', 'miti' )
			,'1'		=> esc_html__( 'Yes', 'miti' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_header_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Header Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_prod_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_main_content_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Main Content Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'required'	=> array( 'ts_prod_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_footer_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Footer Layout Fullwidth', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'required'	=> array( 'ts_prod_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_breadcrumb'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Breadcrumb', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_cloudzoom'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Cloud Zoom', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_lightbox'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Lightbox', 'miti' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Attribute Dropdown', 'miti' )
		,'subtitle' => esc_html__( 'If you turn it off, the dropdown will be replaced by image or text label', 'miti' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_color_text'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Attribute Text', 'miti' )
		,'subtitle' => esc_html__( 'Show text for the Color attribute instead of color/color image', 'miti' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_attr_dropdown', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_attr_color_variation_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Attribute Variation Thumbnail', 'miti' )
		,'subtitle' => esc_html__( 'Use the variation thumbnail for the Color attribute. The Color slug has to be "color". You need to specify Color for variation (not any)', 'miti' )
		,'default'  => true
		,'required'	=> array( 'ts_prod_attr_color_text', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_next_prev_navigation'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Next/Prev Product Navigation', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_frequently_bought_together_vertical'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Frequently Bought Together Vertical', 'miti' )
		,'subtitle' => esc_html__( 'Not available if product has sidebar', 'miti' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_prod_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'       	=> 'ts_prod_gallery_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Gallery Layout', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'vertical'		=> esc_html__( 'Vertical', 'miti' )
			,'horizontal'	=> esc_html__( 'Horizontal', 'miti' )
			,'grid'			=> esc_html__( 'Grid', 'miti' )
		)
		,'default'  => 'vertical'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_thumbnails_slider_mobile'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnails Slider On Mobile', 'miti' )
		,'subtitle' => esc_html__( 'If enabled, it will change all thumbnail/gallery layouts to slider with dots navigation on mobile', 'miti' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_title_in_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title In Content', 'miti' )
		,'subtitle' => esc_html__( 'Display the product title in the page content instead of above the breadcrumbs', 'miti' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_show_rating_top'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Rating Above Product Image', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
		,'required'	=> array( 'ts_prod_rating', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_availability'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Availability', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_availability_bar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Availability Bar', 'miti' )
		,'subtitle' => esc_html__( 'Only available on the Simple product', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_sold_24h'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sold In 24 Hours', 'miti' )
		,'subtitle' => esc_html__( 'Show number of sales in last 24 hours (if greater than 0). Only available on the Simple product', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_short_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_count_down'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Count Down', 'miti' )
		,'subtitle' => esc_html__( 'You have to activate ThemeSky plugin', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_ajax_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Ajax Add To Cart', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_prod_add_to_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_buy_now'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Buy Now Button', 'miti' )
		,'subtitle' => esc_html__( 'Only support the simple and variable products', 'miti' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_tag'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tags', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_size_chart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Size Chart', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'       	=> 'ts_prod_size_chart_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Size Chart Style', 'miti' )
		,'subtitle' => esc_html__( 'Modal Popup is only available if the Show Product Tabs Content By Default option is enabled', 'miti' )
		,'desc'     => ''
		,'options'  => array(
			'popup'		=> esc_html__( 'Modal Popup', 'miti' )
			,'tab'		=> esc_html__( 'Additional Tab', 'miti' )
		)
		,'default'  => 'popup'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_size_chart', 'equals', '1' )
	)
	,array(
		'id'      => 'ts_prod_customer_reviews_style'
		,'type'    => 'select'
		,'title'   => esc_html__( 'Customer Reviews Style', 'miti' )
		,'options' => array(
			'reviews-list' => esc_html__( 'List', 'miti' )
			,'reviews-grid' => esc_html__( 'Grid', 'miti' )
		)
		,'default' => 'reviews-list'
		,'select2' => array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_contact_page'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Contact Page', 'miti' )
		,'subtitle' => esc_html__( 'If selected, it will add a link to the selected page which may allow customer to ask about product', 'miti' )
		,'desc'     => ''
		,'data'     => 'pages'
		,'default'	=> ''
	)
	,array(
		'id'        => 'ts_prod_more_less_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product More/Less Content', 'miti' )
		,'subtitle' => esc_html__( 'Show more/less content in the Description tab', 'miti' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing - Use ShareThis', 'miti' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'miti' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sharing - ShareThis Key', 'miti' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'miti' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)

	,array(
		'id'        => 'section-product-tabs'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Tabs', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_tabs'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tabs', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_separate_reviews_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Separate Reviews Tab', 'miti' )
		,'subtitle' => esc_html__( 'Remove Reviews tab in WooCommerce tabs and add it below', 'miti' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_prod_tabs_show_content_default'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Product Tabs Content By Default', 'miti' )
		,'subtitle' => esc_html__( 'Show the content of all tabs by default and hide the tab headings', 'miti' )
		,'default'  => false
	)
	,array(
		'id'       	=> 'ts_prod_tabs_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tabs Position', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'after_summary'		=> esc_html__( 'After Summary', 'miti' )
			,'inside_summary'	=> esc_html__( 'Inside Summary', 'miti' )
		)
		,'default'  => 'after_summary'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_custom_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Custom Tab', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_custom_tab_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Custom Tab Title', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom tab'
	)
	,array(
		'id'        => 'ts_prod_custom_tab_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Product Custom Tab Content', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => esc_html__( 'Your custom content goes here. You can add the content for individual product', 'miti' )
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
	)
	
	,array(
		'id'        => 'section-ads-banner'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ads Banner', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_ads_banner'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Ads Banner', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_ads_banner_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Ads Banner Content', 'miti' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
	)
	
	,array(
		'id'        => 'section-related-up-sell-products'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Related - Up-Sell - New Products', 'miti' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_upsells'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Up-Sell Products', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_related'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Related Products', 'miti' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
	,array(
		'id'        => 'ts_prod_new_arrivals'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Latest Products', 'miti' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'miti' )
		,'off'		=> esc_html__( 'Hide', 'miti' )
	)
);

/*** Custom Code Tab ***/
$option_fields['custom-code'] = array(
	array(
		'id'        => 'ts_custom_css_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom CSS Code', 'miti' )
		,'subtitle' => ''
		,'mode'     => 'css'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_custom_javascript_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom Javascript Code', 'miti' )
		,'subtitle' => ''
		,'mode'     => 'javascript'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
);