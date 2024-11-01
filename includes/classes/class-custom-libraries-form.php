<?php
/**
 * WPGameList Custom Libraries Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Custom_Libraries_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Custom_Libraries_Form {

	public static function output_custom_libraries_form(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
		$db_row = $wpdb->get_results("SELECT * FROM $table_name");

		$string1 = '<div id="wpgamelist-custom-libraries-container">
				<p id="wpgamelist-use-shortcodes-p">'.__('Use these Shortcodes below to display your different libraries, or create a new Custom Library below', 'wpgamelist').'</p>';

		$string2 = '<table>
            			<tbody>
							<tr colspan="2"><td colspan="2"><p><span class="wpgamelist-jre-cover-shortcode-class">[wpgamelist_shortcode]</span> - ('.__('default shortcode for default library','wpgamelist').'</p></td>
							</tr>
							<tr>
								<td>	
									<p style="margin-left:5px; margin-top:0px;">'.__('By specifying the \'Action\' argument in the default shortcode above, you can control what happens when a user clicks on a game cover or title. For example, if you\'d rather have the visitor directed to a game\'s Amazon page, simply add the \'Action\' argument like so:','wpgamelist').' <br/><br/><span style="text-align:left;" class="wpgamelist-jre-cover-shortcode-class-orange">[wpgamelist_shortcode action="amazon"]</span>
									</p>
									<ul style="list-style: disc; margin-left: 20px;">
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('All Available Action Values:','wpgamelist').'</span>
											<ul class="wpgamelist-jre-cover-shortcode-class-sub-ul">
												<li>action="gameview"</li>
												<li>action="amazon"</li>
												<li>action="gamestop"</li>
												<li>action="bestbuy"</li>
												<li>action="steam"</li>
												<li>action="ebay"</li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
							<tr colspan="2">
								<td colspan="2" style="width: 100%;">
									<p><span class="wpgamelist-jre-cover-shortcode-class">[showgamecover]</span> - ('.__('shortcode for displaying Individual Games','wpgamelist').')</p>
									<ul style="list-style: disc; margin-left: 20px;">
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('Specify a game:', 'wpgamelist').'</span> title="The Legend of Zelda: Link\'s Awakening"</li>
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('Set Alignment:', 'wpgamelist').'</span> align="left"  <span style="font-style:italic;">or </span>align="right"</li>
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('Specify Library:', 'wpgamelist').'</span> table="nameoflibrary" ('.__('leave out to use default library', 'wpgamelist').')</li>
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('Set the Display:', 'wpgamelist').'</span> display="justimage"  <span style="font-style:italic;">or </span>display="excerpt"</li>
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('Set the Size:', 'wpgamelist').'</span> width="100"</li>
										<li><span class="wpgamelist-jre-cover-shortcode-class">'.__('Specify the Action:', 'wpgamelist').'</span>
											<ul class="wpgamelist-jre-cover-shortcode-class-sub-ul">
												<li>action="gameview"</li>
												<li>action="amazon"</li>
												<li>action="gamestop"</li>
												<li>action="bestbuy"</li>
												<li>action="steam"</li>
												<li>action="ebay"</li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
              				<tr colspan="2">
              					<td colspan="2"><p>'.__('So, for example, to display just a game\'s cover from your default library on the left side of a page or post, with a size of 100, this shortcode would do the trick:','wpgamelist').'<br/><span class="wpgamelist-jre-cover-shortcode-class-orange">[showgamecover display="justimage" title="The Legend of Zelda: Link\'s Awakening" align="left" width="100"]</p></span>
              					</td>
              				</tr>
              				<tr>
              					<td colspan="2"><p>'.__('To display a game and it\'s excerpt from a custom library, with a size of 200, this shortcode would do the trick:', 'wpgamelist').'</br><span class="wpgamelist-jre-cover-shortcode-class-orange">[showgamecover display="excerpt" table="gameboy" title="The Legend of Zelda: Link\'s Awakening" align="left" width="200"]</p></span>
              					</td>
              				</tr>
              				<tr>
              					<td colspan="2"><p>'.__('To display a game\'s cover, that links to it\'s Amazon page, from your default library, with a size of 150, this shortcode would do the trick:','wpgamelist').'</br><span class="wpgamelist-jre-cover-shortcode-class-orange">[showgamecover action="amazon" title="The Legend of Zelda: Link\'s Awakening" width="150"]</p></span>
              					</td>
              				</tr>
              				<tr>
              					<td colspan="2"><p style="text-align:center;"><a href="https://wpgamelist.com/index.php/2017/09/22/wpgamelist-shortcode-guide/">'.__('Be sure to read this detailed post on all of the different ways that the WPGameList Shortcode can be used!','wpgamelist').'</a></p></span>
              					</td>
              				</tr>
						</tbody>
              			<tbody>
              				<tr colspan="2">
              					<td colspan="2">
              						<p id="wpgamelist-use-shortcodes"></p>
              					</td>
      						</tr>';

      						$counter = 0;
              
              				$string3 = '';
							foreach($db_row as $db){
								$counter++;
								if(($db->user_table_name != "") || ($db->user_table_name != null)){
									$string3 = $string3.'<tr><td><p class="wpgamelist-jre-cover-shortcode-class">[wpgamelist_shortcode table="'.$db->user_table_name.'"]</p></td><td><button id="'.$db->user_table_name.'_'.$counter.'" class="wpgamelist_delete_custom_lib" type="button" >'.__('Delete Library','wpgamelist').'</button></td></tr>'; 
								}
							}

							$string4 = '<tr>
											<td>
												<input type="text" value="'.__('Create a new Library here...','wpgamelist').'" class= "wpgamelist-dynamic-input" id="wpgamelist-dynamic-input-library" name="wpgamelist-dynamic-input"></input>
											</td>
											<td>
												<button id="wpgamelist-dynamic-shortcode-button" type="button" disabled="true">'.__('Create New Library','wpgamelist').'</button>
											</td>
										</tr>
						            </tbody>
						        </table>
        					</div>';

		echo $string1.$string2.$string3.$string4;

	}


}

endif;