<?php
/**
 * WPGameList AddAGame Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/UI/Admin
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_AddAGame_Tab', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_AddAGame_Tab {

    public function __construct() {
    	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-admin-ui-template.php');
    	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-stylepaks-form.php');
    	// Instantiate the class
		$this->template = new WPGameList_Admin_UI_Template;
		$this->form = new WPGameList_Add_Game_Form;
		$this->output_open_admin_container();
		$this->output_tab_content();
		$this->output_close_admin_container();
		$this->output_admin_template_advert();
    }

    private function output_open_admin_container(){
        $icon_url = GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'game-controller.svg';
        $title = __('StylePaks','wpgamelist');
    	echo $this->template->output_open_admin_container($title, $icon_url);
    }

    private function output_tab_content(){
    	echo $this->form->output_add_game_form();
    }

    #TODO: Replace that 'Game Added Succesfully!' line above with a link to open the title in colorbox, once that functionality is complete

    private function output_close_admin_container(){
    	echo $this->template->output_close_admin_container();
    }

    private function output_admin_template_advert(){
    	echo $this->template->output_template_advert();
    }

}

endif;


// Instantiate the class
$am = new WPGameList_AddAGame_Tab;