<?php
/**
 * WPGameList Edit-Game-Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Edit_Game_Form', false ) ) :
/**
 * WPGameList_Edit_Game Class.
 */
class WPGameList_Edit_Game_Form {

  public $table;
  public $limit;

  public function output_edit_game_form($table, $offset, $search_mode = null, $search_term = null){
    global $wpdb;
    wp_enqueue_media();

    $this->table = $table;
    if($this->table === 'default'){
      $this->table = $wpdb->prefix.'wpgamelist_jre_saved_game_log';
    }

    global $wpdb;
    if($search_mode != null && $search_term != null){
      if($search_mode == 'author'){
        $this->games_actual = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table WHERE author LIKE '%s'", '%'.$search_term.'%'));
      }

      if($search_mode == 'title'){
        $this->games_actual = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table WHERE title LIKE '%s'", '%'.$search_term.'%'));
      }

      if($search_mode == 'both'){
        $this->games_actual = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table WHERE title LIKE '%s' OR author LIKE '%s'", '%'.$search_term.'%', '%'.$search_term.'%'));
      }
    } else {
      $this->games_actual = $wpdb->get_results("SELECT * FROM $this->table");
    }

    // Getting number of results
    $this->limit = $wpdb->num_rows;

    // Default sorting - sorts by IDs from low to high
    function compare_ids($a, $b){
      return $a->ID - $b->ID;
    }
    usort($this->games_actual, "compare_ids");

    // Set up library drop-down
    $table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
    $db_row = $wpdb->get_results("SELECT * FROM $table_name");


      $string1 = '<div id="wpgamelist-edit-games-lib-search-div">
        <div id="wpgamelist-edit-games-lib-div">
          <p id="wpgamelist-edit-games-lib-p">'.__('Select a Library to Edit Games From','wpgamelist').'</p>
          <select class="wpgamelist-editgame-select-default" id="wpgamelist-editgame-select-library">
              <option value="'.$wpdb->prefix.'wpgamelist_jre_saved_game_log">Default Library</option>';
    $string2 = '';
    foreach($db_row as $db){
      if(($db->user_table_name != "") || ($db->user_table_name != null)){
        $string2 = $string2.'<option value="'.$wpdb->prefix.'wpgamelist_jre_'.$db->user_table_name.'">'.ucfirst($db->user_table_name).'</option>';
      }
    }

    $string3 = '</select>
        </div>
        <div class="wpgamelist-spinner" id="wpgamelist-spinner-edit-change-lib"></div>
        <div id="wpgamelist-edit-games-search-div">
          <p id="wpgamelist-edit-games-lib-p">'.__('Search for a Game to Edit','wpgamelist').'</p>
          <label>'.__('Search by Title','wpgamelist').'</label><input id="wpgamelist-search-title-checkbox" type="checkbox"/><label>'.__('Search by Publisher','wpgamelist').'</label><input id="wpgamelist-search-author-checkbox" type="checkbox"/>
          <input id="wpgamelist-edit-game-search-input" type="text" />
          <button id="wpgamelist-edit-game-search-button" type="button">Search</button>
        </div>
      </div>
      <div id="wpgamelist-bulk-edit-div">
        <button id="wpgamelist-bulk-edit-mode-on-button"';

        $string4 = '';
        if(count($this->games_actual) == 0){
          $string4 = 'disabled';
        }

        $string5 = ' type="button">Bulk Delete Mode</button>
        <div id="wpgamelist-bulk-edit-mode-on-div">
          <button disabled id="wpgamelist-bulk-edit-mode-delete-checked" type="button">Delete Checked Games</button>
          <button id="wpgamelist-bulk-edit-mode-delete-all-in-lib" type="button">'.__('Delete All Games in This Library','wpgamelist').'</button>
          <button id="wpgamelist-bulk-edit-mode-delete-all-plus-pp-in-lib" type="button">'.__('Delete All Games & Pages & Posts in This Library','wpgamelist').'</button>
          <button id="wpgamelist-bulk-edit-mode-delete-all-in-lib-cancel" type="button">'.__('Cancel','wpgamelist').'</button>
        </div>
        <button id="wpgamelist-reorder-button" type="button">'.__('Reorder Games','wpgamelist').'</button>
        <button id="wpgamelist-cancel-reorder-button" type="button">'.__('Cancel','wpgamelist').'</button>
      </div>';
    $string6 = '';
    // If there are no results from the query
    if($this->games_actual == null){
      $string6 = '<div class="wpgamelist-search-indiv-container"><div id="wpgamelist-search-results-info"></div>';
    }

    $divclose = '';
    if($this->games_actual < 1 || $this->games_actual == null){
      $divclose = '</div>';
    } else {

      // The loop that will construct each line
      foreach($this->games_actual as $key=>$game){
        error_log(print_r($game, TRUE));
        if(($key >= ($offset)) && ($key <= ($offset+GAMELIST_GAMELIST_EDIT_PAGE_OFFSET))){

        if($game->title == '' || $game->title == null){
          $game->title = 'Game Title Unavailable!';
        }

        if($game->publisher == '' || $game->publisher == null){
          $game->publisher = 'Game Author Unavailable!';
        }

        if($game->image == '' || $game->image == null){
          $game->image = GAMELIST_GAMELIST_ROOT_IMG_URL.'image_unavaliable.png';
        }

        $string6 = $string6.'<div class="wpgamelist-search-indiv-container"><div id="wpgamelist-search-results-info">

          </div>
          <div class="wpgamelist-edit-game-indiv-div-class" id="wpgamelist-edit-game-indiv-div-id-'.$key.'"">
            <div class="wpgamelist-edit-title-div">
              <div class="wpgamelist-bulk-delete-checkbox-div">
                <input data-key="'.$key.'" data-table="'.$this->table.'" data-game-id="'.$game->ID.'" data-spinner-id="'.$key.'" class="wpgamelist-bulk-delete-checkbox" type="checkbox" /><label>Delete Title</label>
              </div>
              <div class="wpgamelist-edit-img-author-div">
                <img data-gameid="'.$game->ID.'" data-gameuid="'.$game->game_uid.'" data-gametable="'.$this->table.'" class="wpgamelist-edit-game-cover-img wpgamelist-show-game-colorbox" src="'.$game->image.'"/>
                <p class="wpgamelist-edit-game-title wpgamelist-show-game-colorbox" data-gametable="'.$this->table.'" data-gameid="'.$game->ID.'">'.stripslashes($game->title).'</p><br/>
                <img class="wpgamelist-edit-game-icon wpgamelist-game-icon-author " src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'author.svg"/><p class="wpgamelist-edit-game-author">'.$game->publisher.'</p>
              </div>
            </div>
            <div class="wpgamelist-edit-actions-div">
              <div class="wpgamelist-edit-actions-edit-button" data-key="'.$key.'" data-table="'.$this->table.'" data-game-id="'.$game->ID.'"><img class="wpgamelist-edit-game-icon wpgamelist-edit-game-icon-button" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'pencil.svg"/> Edit</div>
              <div class="wpgamelist-edit-actions-delete-button" data-key="'.$key.'" data-table="'.$this->table.'" data-game-id="'.$game->ID.'"><img class="wpgamelist-edit-game-icon wpgamelist-edit-game-icon-button" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'garbage-bin.svg"/> Delete</div>
              <div class="wpgamelist-edit-game-delete-page-post-div">';
                
                if($game->page != 'No'){
                  $string6 = $string6.'<input data-id="'.$game->page.'" id="wpgamelist-delete-page-input" type="checkbox"/><label for="wpgamelist-edit-delete-page">Delete Page</label><br/>';
                }

                if($game->post != 'No'){
                  $string6 = $string6.'<input data-id="'.$game->post.'" id="wpgamelist-delete-post-input" type="checkbox"/><label for="wpgamelist-edit-delete-post">Delete Post</label>';
                }

              $string6 = $string6.'</div>
            </div>
            <div class="wpgamelist-spinner" id="wpgamelist-spinner-'.$key.'"></div>
            <div class="wpgamelist-delete-result" id="wpgamelist-delete-result-'.$key.'"></div>
            <div class="wpgamelist-edit-form-div" id="wpgamelist-edit-form-div-'.$key.'">
              
            </div>
          </div></div>';
        }
      }
    }

    $string7 = '<div id="wpgamelist-edit_games-pagination-div">
            <div ';

            $string8 = '';
            if(count($this->games_actual) == 0){
              $string8 = 'style="opacity:0.3; pointer-events:none;"';
            }

            $string9 = ' data-limit="'.$this->limit.'" id="wpgamelist-edit-next-100">Next '.GAMELIST_GAMELIST_EDIT_PAGE_OFFSET.' Results<img class="wpgamelist-edit-game-icon-next" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'next-page.svg"/></div>
            <div data-limit="'.$this->limit.'" id="wpgamelist-edit-previous-100"><img class="wpgamelist-edit-game-icon-back" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'next-page.svg"/>Previous '.GAMELIST_GAMELIST_EDIT_PAGE_OFFSET.' Results</div>
          </div>
          <div class="wpgamelist-spinner" id="wpgamelist-spinner-pagination"></div>'.$divclose;

    return $string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9;
  }


}

endif;