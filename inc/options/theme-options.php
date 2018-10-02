<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/*
/* Last element's ID = 30
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'nhp-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}

/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');


/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
$args['intro_text'] = __('<p>There are settings for your theme.</p>', 'nhp-opts');

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'TheScholarshipHub';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'nhp-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('The Scholarship Hub Options', 'nhp-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
                                'id' => 'nhp-opts-1',
                                'title' => __('Theme Information 1', 'nhp-opts'),
                                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
                            );
$args['help_tabs'][] = array(
                                'id' => 'nhp-opts-2',
                                'title' => __('Theme Information 2', 'nhp-opts'),
                                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
                            );

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'nhp-opts');

$sections = array();

$sections[] = array(
				'title' => __('Homepage', 'nhp-opts'),
				'desc' => __('<p class="description">Settings for the homepage.</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
//				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array(
                                                array(
                                                    'id' => '1', //must be unique
                                                    'type' => 'text', //builtin fields include:
    //text|textarea|editor|checkbox|multi_checkbox|radio|radio_img|button_set|select|multi_select|color|date|divide|info|upload
                                                    'title' => __('Slider#1 Header', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std' => __('Find UK Scholarship Today!', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '2',
                                                    'type' => 'textarea',
                                                    'title' => __('Slider#1 Text', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '3',
                                                    'type' => 'text',
                                                    'title' => __('Slider#1 Button title', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std'=> 'Get started today'
						),
                                                array(
                                                    'id' => '14',
                                                    'type' => 'text',
                                                    'title' => __('Slider#1 Button link', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std'=> ''
						),
                                                array(
                                                    'id' => '4',
                                                    'type' => 'upload',
                                                    'title' => __('Slider#1 Image', 'nhp-opts'),
						),
                                    
                                                array(
                                                    'id' => '5',
                                                    'type' => 'text',
                                                    'title' => __('Slider#2 Header', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std' => __('Find UK Scholarship Today!', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '6',
                                                    'type' => 'textarea',
                                                    'title' => __('Slider#2 Text', 'nhp-opts'),
                                                    'desc' => '',
						),
                                                array(
                                                    'id' => '7',
                                                    'type' => 'text',
                                                    'title' => __('Slider#2 Button title', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std'=> 'Get started today'
						),
                                                array(
                                                    'id' => '15',
                                                    'type' => 'text',
                                                    'title' => __('Slider#2 Button link', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std'=> ''
						),
                                                array(
                                                    'id' => '8',
                                                    'type' => 'upload',
                                                    'title' => __('Slider#2 Image', 'nhp-opts'),
						),
                                    
                                    
                                                array(
                                                    'id' => '16',
                                                    'type' => 'text',
                                                    'title' => __('Button title for Post section', 'nhp-opts'),
                                                    'desc' => '',
                                                    'std'=> __('>> Read more', 'nhp-opts')
						),
                                    
                                                
                                                array(
                                                    'id' => '9',
                                                    'type' => 'text',
                                                    'title' => __('Header for section#2', 'nhp-opts'),
                                                    'std'=> 'University Funding'
						),
                                    
                                                array(
                                                    'id' => '10',
                                                    'type' => 'text',
                                                    'title' => __('Header for section#3', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '12',
                                                    'type' => 'upload',
                                                    'title' => __('Image for section#3', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '13',
                                                    'type' => 'pages_select',
                                                    'title' => __('Page Link for section#3', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '17',
                                                    'type' => 'text',
                                                    'title' => __('Button title for section#3', 'nhp-opts'),
						),
                                    
                                                array(
                                                    'id' => '11',
                                                    'type' => 'text',
                                                    'title' => __('Header for section#4', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '18',
                                                    'type' => 'upload',
                                                    'title' => __('Image for section#4', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '19',
                                                    'type' => 'text',
                                                    'title' => __('Link for section#3', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '29',
                                                    'type' => 'textarea',
                                                    'title' => __('Text for section#3', 'nhp-opts'),
						),
                                        )
				);


$sections[] = array(
				'title' => __('Footer', 'nhp-opts'),
//				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_062_attach.png',
				'fields' => array(                                 
                                                array(
                                                    'id' => '20',
                                                    'type' => 'info',
                                                    'desc' => __('<h3 id="extra_degree_funding">Extra degree funding</h3>', 'nhp-opts')
						),
                                                array(
                                                    'id' => '21',
                                                    'type' => 'text',
                                                    'title' => __('Header', 'nhp-opts'),
                                                    'std' => __('', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '22',
                                                    'type' => 'textarea',
                                                    'title' => __('Text', 'nhp-opts'),
                                                    'std' => __('', 'nhp-opts'),
						), 
                                                array(
                                                    'id' => '23',
                                                    'type' => 'text',
                                                    'title' => __('Button title', 'nhp-opts'),
                                                    'std' => __('', 'nhp-opts'),
						),                                
                                                array(
                                                    'id' => '28',
                                                    'type' => 'info',
                                                    'desc' => __('<h3>Social accounts</h3>', 'nhp-opts')
						),
                                                array(
                                                    'id' => '25',
                                                    'type' => 'text',
                                                    'title' => __('Facebook', 'nhp-opts'),
                                                    'std' => __('', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '26',
                                                    'type' => 'text',
                                                    'title' => __('Twitter', 'nhp-opts'),
                                                    'std' => __('', 'nhp-opts'),
						),
                                                array(
                                                    'id' => '27',
                                                    'type' => 'text',
                                                    'title' => __('Google+', 'nhp-opts'),
                                                    'std' => __('', 'nhp-opts'),
						),
                                        )
				);

$sections[] = array(
        'title' => __('Calculator', 'nhp-opts'),
                'fields' => array(
                        array(
                            'id' => '30',
                            'type' => 'text',
                            'title' => __('For example', 'nhp-opts'),
                            'std' => __('', 'nhp-opts'),
                        ),
        )
);

$tabs = array();


if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
        $tabs['theme_docs'] = array(
                                        'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
                                        'title' => __('Documentation', 'nhp-opts'),
                                        'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
                                        );
}//if

global $NHP_Options;
$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;

        if( $value == false ){
		$value = $value;
		$error = true;
                if( empty($field['msg']) ){
                    $field['msg'] = 'Error';
                }
	}
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}

function validate_paypal_sandbox($field, $value, $existing_value){
        $error = false;

	if( $value == false ){
		$value = $value;
		$error = true;
                if( empty($field['msg']) ){
                    $field['msg'] = 'Error';
                }
	}
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
}
