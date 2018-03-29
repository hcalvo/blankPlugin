<?php
/*
Plugin Name: Nanotek Plugin para mail distrito 10
Plugin URI: http://portable.cl/
Description: Funciones de administración de mail distrito 10
Version: 0.1
Author: Hernán Calvo
Author Email: hernan@portable.cl
License:
Copyright 2011 Hernán Calvo (hernan@portable.cl)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

##    ##    ###    ##    ##  #######  ######## ######## ##    ## 
###   ##   ## ##   ###   ## ##     ##    ##    ##       ##   ##  
####  ##  ##   ##  ####  ## ##     ##    ##    ##       ##  ##   
## ## ## ##     ## ## ## ## ##     ##    ##    ######   #####    
##  #### ######### ##  #### ##     ##    ##    ##       ##  ##   
##   ### ##     ## ##   ### ##     ##    ##    ##       ##   ##  
##    ## ##     ## ##    ##  #######     ##    ######## ##    ## 
*/
//###################################################################
global $wp;
global $wpLogSession; // session de logeo de WP
$wpLogSession = false;
// general hooks

if (!is_admin()) { // Front hooks 
} //!is_admin()
else {
    // ..* BackEND hooks *.. //


  /**
   * Eliminar elementos del menú que no usaremos
   */
  function portablewp_plugin_remove_menus() {
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'edit-comments.php' );          //Comments
  }
  add_action( 'admin_menu', 'portablewp_plugin_remove_menus' );

###------------------------------------
}##FIN // ..* BackEND hooks *.. //

//*********************************************   
// archivos incluidos   
//*********************************************
include_once(__DIR__ . '/inc/CT_def.php'); // funciones de definicion de CT
include_once(__DIR__ . '/inc/ACF_forms.php'); // funciones de definicion de formularios ACF
include_once(__DIR__ . '/inc/TAX_def.php'); //funciones de definicion de Taxonomias
//*********************************************
class nanotek_portable_admin_plugin {
    /*--------------------------------------------*
     * Constants
     *--------------------------------------------*/
    const name = 'nanotek_portable_admin_plugin';
    const slug = 'nanotek_portable_admin_plugin';
    /**
     * Constructor
     */
    function __construct() {
        //Hook up to the init action
        add_action('init', array(
            &$this,
            'init_nanotek_portable_admin_plugin'
        ));
    }
    /**
     * Runs when the plugin is activated
     */
    function install_nanotek_portable_admin_plugin() {
        // do not generate any output here
    }
    /**
     * Runs when the plugin is initialized
     */
    function init_nanotek_portable_admin_plugin() {
        // Load JavaScript and stylesheets
        $this->register_scripts_and_styles();
        if (is_admin()) {
             //this will run when on the backend
        } //is_admin()
        else {
            //this will run when on the frontend
        }
    }
    /**
     * Registers and enqueues stylesheets for the administration panel and the
     * public  site.  
     */
    private function register_scripts_and_styles() {
        if (is_admin()) {
            $this->load_file(self::slug . '-admin-style', '/css/admin.css');
                $this->load_file( self::slug . '-moment-js', '/js/moment-with-locales.min.js',true );
            
            
        } //is_admin()
        else {
        } // end if/else
    } // end register_scripts_and_styles
    private function load_file($name, $file_path, $is_script = false) {
        $url  = plugins_url($file_path, __FILE__);
        $file = plugin_dir_path(__FILE__) . $file_path;
        if (file_exists($file)) {
            if ($is_script) {
                wp_register_script($name, $url, array(
                    'jquery'
                )); //depends on jquery
                wp_enqueue_script($name);
            } //$is_script
            else {
                wp_register_style($name, $url);
                wp_enqueue_style($name);
            } // end if
        } // end if
    } // end load_file
} // end class
new nanotek_portable_admin_plugin();
##// nuevo plug();