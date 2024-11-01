<?php
/**
 * WPGameList Add-Edit-Game-Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Add_Game_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Add_Game_Form {

	public static function output_add_game_form(){

		$trans1 = __('To add a game from the IGDB database, simply select a game library from the drop-down below, enter a Title to search for, and click ','wpgamelist');
		$trans2 = __("'Search for Game'",'wpgamelist');
		$trans3 = __("Alternatively, if you wish to manually enter a game, you may do so by simply filling out the form below.",'wpgamelist');
		$trans4 = __("the only required field is the ISBN/ASIN number",'wpgamelist');
		$trans5 = __("You must check the box below to authorize",'wpgamelist');
		$trans6 = __("WPGameList",'wpgamelist');
		$trans7 = __("to gather data from IGDB, otherwise, the only data that will be added for your game is what you fill out on the form below. WPGameList uses it's own Amazon Product Advertising API keys to gather game data, but if you happen to have your own API keys, you can use those instead by adding them on the",'wpgamelist');
		$trans8 = __("Amazon Settings",'wpgamelist');
		$trans9 = __("page",'wpgamelist');


		


		// Perform check for previously-saved Amazon Authorization
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
		$opt_results = $wpdb->get_row("SELECT * FROM $table_name");

		$table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
		$db_row = $wpdb->get_results("SELECT * FROM $table_name");

		// For grabbing an image from media library
		wp_enqueue_media();
	 	$string1 = "<div id='wpgamelist-addgame-container'>
				<p>".$trans1."<span class='wpgamelist-color-orange-italic'> ".$trans2." </span></span>.<br/><br/><span ";

					if($opt_results->amazonauth == 'true'){ 
						$string2 = 'style="display:none;"';
					} else {
						$string2 = '';
					}

					$string3 = " >".$trans3."</p>
          		<form id='wpgamelist-addgame-form' method='post' action=''>
		          	<div id='wpgamelist-authorize-amazon-container'>
		    			<table></table>
		    		</div>
		    		<div id='wpgamelist-addgame-select-library-label' for='wpgamelist-addgame-select-library'>".__('Select a Library to Add This Game To:','wpgamelist')."</div>
		    		<select class='wpgamelist-addgame-select-default' id='wpgamelist-addgame-select-library'>
		    			<option value='".$wpdb->prefix."wpgamelist_jre_saved_game_log'>".__('Default Library','wpgamelist')."</option> ";

		    		$string4 = '';
		    		foreach($db_row as $db){
						if(($db->user_table_name != "") || ($db->user_table_name != null)){
							$string4 = $string4.'<option value="'.$wpdb->prefix.'wpgamelist_jre_'.$db->user_table_name.'">'.ucfirst($db->user_table_name).'</option>';
						}
					}


	          		$string5 = '    
	          		</select>
	          		<div id="wpgamelist-add-game-search-div">
	          			<label id="wpgamelist-add-game-search-title">'.__('Enter a Game Title','wpgamelist').':</label><br/><input id="wpgamelist-add-game-gamesearch-input" placeholder="'.__('Enter a Game Title Here','wpgamelist').'" type="text"></input><br/><button id="wpgamelist-add-game-search-button">'.__('Search for Game','wpgamelist').'</button>
	          			<div class="wpgamelist-spinner" id="wpgamelist-spinner-1"></div>
                		<div id="wpgamelist-addgame-search-success-div">

                		</div>
	          		</div>
	          		<div id="wpgamelist-add-game-form-div">
                		<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Game Title','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<button id="wpgamelist-addgame-upload_image_button">'.__('Choose Cover Image','wpgamelist').'</button>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Release Date','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-1" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-2" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-date-input" id="wpgamelist-add-game-date-input-1" type="date"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Platforms','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Genres','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Developer','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-3" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-4" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-5" type="text"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Publishers','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('IGDB Member Rating','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Average Critic Rating','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-6" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-7" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-8" type="text"></input>
                			</div>
            			</div>	
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Perspective','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Game Modes','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Themes','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-9" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-10" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-11" type="text"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Series','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Franchise','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('IGDB Link','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-12" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-13" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-14" type="text"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('ESRB Rating','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Pegi Rating','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Owned','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-1">
                                    <option>'.__('Rating Pending','wpgamelist').'</option>
                                    <option>'.__('Early Childhood','wpgamelist').'</option>
                                    <option>'.__('Everyone','wpgamelist').'</option>
                                    <option>'.__('Everyone 10+','wpgamelist').'</option>
                                    <option>'.__('Teen','wpgamelist').'</option>
                                    <option>'.__('Mature','wpgamelist').'</option>
                                    <option>'.__('Adults Only','wpgamelist').'</option>
                                </select>
                			</div>
                			<div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                				<select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-2">
                                    <option>'.__('Parental Guidance Recommended','wpgamelist').'</option>
                                    <option>'.__('Age 3+','wpgamelist').'</option>
                                    <option>'.__('Age 7+','wpgamelist').'</option>
                                    <option>'.__('Age 12+','wpgamelist').'</option>
                                    <option>'.__('Age 16+','wpgamelist').'</option>
                                    <option>'.__('Age 18+','wpgamelist').'</option>
                                </select>
                			</div>
                			<div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                				<select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-3">
                					<option>'.__('No','wpgamelist').'</option>
                					<option>'.__('Yes','wpgamelist').'</option>
                				</select>
                			</div>
            			</div>
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Condition','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Finished','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Date Finished','wpgamelist').'</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <select disabled class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-4">
                                    <option>'.__('New (Sealed/Unopened Packaging)','wpgamelist').'</option>
                                    <option>'.__('Like New','wpgamelist').'</option>
                                    <option>'.__('Used','wpgamelist').'</option>
                                    <option>'.__('Fair','wpgamelist').'</option>
                                    <option>'.__('Poor','wpgamelist').'</option>
                                </select>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-5">
                                    <option>'.__('No','wpgamelist').'</option>
                                    <option>'.__('Yes','wpgamelist').'</option>
                                </select>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <input disabled class="wpgamelist-add-game-date-input" id="wpgamelist-add-game-date-input-2" type="date"></input>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Summary','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Notes','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('My Rating','wpgamelist').'</label>&nbsp;<img id="wpgamelist-addgame-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'5star.png">
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <textarea placeholder="'.__('Short Summary of Game','wpgamelist').'" class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-textarea-input-1"></textarea>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <textarea placeholder="'.__('My Thoughts and Opinions about this Title','wpgamelist').'" class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-textarea-input-2"></textarea>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-6">
                                    <option>'.__('5 Stars','wpgamelist').'</option>
                                    <option>'.__('4 Stars','wpgamelist').'</option>
                                    <option>'.__('3 Stars','wpgamelist').'</option>
                                    <option>'.__('2 Stars','wpgamelist').'</option>
                                    <option>'.__('1 Star','wpgamelist').'</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Videos','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Websites','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Screenshots','wpgamelist').'</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-1" type="text"></input>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-2" type="text"></input>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-3" type="text"></input>
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Alternative Names','wpgamelist').'</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-4" type="text"></input>
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                         <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Create a Page for this Game?','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Create a Post for this Game?','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-7">
                                    <option>'.__('No','wpgamelist').'</option>
                                    <option>'.__('Yes','wpgamelist').'</option>
                                </select>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-8">
                                    <option>'.__('No','wpgamelist').'</option>
                                    <option>'.__('Yes','wpgamelist').'</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>';

                        // This filter allows the addition of one or more rows of items into the 'Add A Book' form. 
                        $string6 = '';
                        if(has_filter('wpgamelist_append_to_addgame_form')) {
                            $string6 = apply_filters('wpgamelist_append_to_addgame_form', $string6);
                        }

                        $string7 = '<div id="wpgamelist-add-game-bottom-instruction-div">
                            <div>Review the information above, then click the \'Add Game\' button below when ready!</div>
                            <img id="wpgamelist-add-game-bottom-instruct-arrow" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'download-arrow.svg"/>
                        </div>
            			<div id="wpgamelist-add-game-form-submit-div">
            				<button id="wpgamelist-add-game-button-actual">Add Game</button>
            				<div class="wpgamelist-spinner" id="wpgamelist-spinner-2"></div>
            				<div id="wpgamelist-add-game-response-div">

            				</div>
            			</div>

                	</div>
	        	</form>
	        	<div id="wpgamelist-add-game-error-check" data-add-game-form-error="true" style="display:none" data-></div>
    		</div>';

    		return $string1.$string2.$string3.$string4.$string5.$string6.$string7;
	}


}

endif;