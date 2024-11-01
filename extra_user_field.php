<?php
/*
  Plugin Name: Extra User Field
  Plugin URI: transworld.net
  Description: Add extra use field in user meta table .
  Author: Gaurav Kumar
  Version: 1
  Author URI:http://www.linkedin.com/in/gkumar25
*/
 
     define('MARFOLDER', dirname(plugin_basename(__FILE__)));
     include_once(ABSPATH . "wp-content/plugins/extra_user_field/extra_user_field_options.php");
     include_once(ABSPATH . "wp-content/plugins/extra_user_field/extra_user_field_class.php");  
        ### Load WP-Config File If This File Is Called Directly

      if (!function_exists('add_action')) {
                require_once('../../../wp-config.php');
          } 

       add_action( 'show_user_profile', 'extra_user_profile_fields' );
       add_action( 'edit_user_profile', 'extra_user_profile_fields' );

       add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
       add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

       add_action('admin_menu', 'set_extra_user_field_option_page');


       function set_extra_user_field_option_page(){
             add_management_page('Extra User Field', 'Extra UserField', 8, __FILE__, 'display_extra_user_field_options');
             add_menu_page('Extra User Field', 'Extra User Field', 8, __FILE__, 'display_extra_user_field_options');
          }

        function display_extra_user_field_options(){
             global $user_extra_field;
             $user_extra_field -> extra_user_field_options_page();
             $user_extra_field -> extra_user_field_table_page();       
 
        }
?>
