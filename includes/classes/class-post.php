<?php
/**
 * WPGameList Post Class
 * Handles functions for:
 * - Creating an individual post for an added game
 * 
 * @author   Jake Evans
 * @category Root Product
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Post', false ) ) :
/**
 * WPGameList_Game Class.
 * Use a default custom post template for each game
 */
class WPGameList_Post {

	// Game data
	public $title;
	public $image;
	public $platforms;
	public $genres;
	public $developer;
	public $publisher;
	public $rating;
	public $criticrating;
	public $perspective;
	public $gamemodes;
	public $themes;
	public $series;
	public $franchise;
	public $igdblink;
	public $releasedate;
	public $finisheddate;
	public $esrb;
	public $pegi;
	public $owned;
	public $gamecondition;
	public $finished;
	public $myrating;
	public $library;
	public $summary;
	public $notes;
	public $videos;
	public $websites;
	public $screenshots;
	public $altnames;
	public $woocommerce;
	public $saleprice;
	public $regularprice;
	public $stock;
	public $length;
	public $width;
	public $height;
	public $weight;
	public $sku;
	public $virtual;
	public $download;
	public $woofile;
	public $salebegin;
	public $saleend;
	public $purchasenote;
	public $productcategory;
	public $reviews;
	public $crosssells;
	public $upsells;
	public $page;
	public $post;
	public $amazonbuylink;
	public $amazonreviewiframe;
	public $similaramazonproducts;
	public $gamestopurl;
	public $bestbuyurl;
	public $steamurl;
	public $ebayurl;

	public function __construct($game_array) {

		$this->title = $game_array['title'];
		$this->image = $game_array['image'];
		$this->platforms = $game_array['platforms'];
		$this->genres = $game_array['genres'];
		$this->developer = $game_array['developer'];
		$this->publisher = $game_array['publisher'];
		$this->rating = $game_array['rating'];
		$this->criticrating = $game_array['criticrating'];
		$this->perspective = $game_array['perspective'];
		$this->gamemodes = $game_array['gamemodes'];
		$this->themes = $game_array['themes'];
		$this->series = $game_array['series'];
		$this->franchise = $game_array['franchise'];
		$this->igdblink = $game_array['igdblink'];
		$this->releasedate = $game_array['releasedate'];
		$this->finishdate = $game_array['finishdate'];
		$this->esrb = $game_array['esrb'];
		$this->pegi = $game_array['pegi'];
		$this->owned = $game_array['owned'];
		$this->gamecondition = $game_array['gamecondition'];
		$this->finished = $game_array['finished'];
		$this->myrating = $game_array['myrating'];
		$this->library = $game_array['library'];
		$this->summary = $game_array['summary'];
		$this->notes = $game_array['notes'];
		$this->videos = $game_array['videos'];
		$this->websites = $game_array['websites'];
		$this->screenshots = $game_array['screenshots'];
		$this->altnames = $game_array['altnames'];
		$this->woocommerce = $game_array['woocommerce'];
		$this->saleprice = $game_array['saleprice'];
		$this->regularprice = $game_array['regularprice'];
		$this->stock = $game_array['stock'];
		$this->length = $game_array['length'];
		$this->width = $game_array['width'];
		$this->height = $game_array['height'];
		$this->weight = $game_array['weight'];
		$this->sku = $game_array['sku'];
		$this->virtual = $game_array['virtual'];
		$this->download = $game_array['download'];
		$this->woofile = $game_array['woofile'];
		$this->salebegin = $game_array['salebegin'];
		$this->saleend = $game_array['saleend'];
		$this->purchasenote = $game_array['purchasenote'];
		$this->productcategory = $game_array['productcategory'];
		$this->reviews = $game_array['reviews'];
		$this->crosssells = $game_array['crosssells'];
		$this->upsells = $game_array['upsells'];
		$this->page = $game_array['page'];
		$this->post = $game_array['post'];
		$this->game_uid = $game_array['game_uid'];

		// Get author id
		$this->page_author_id = get_current_user_id();

		// Create the WPGameList Post Category
		$cat_id = $this->create_post_category();
		$this->create_game_post();
		$this-> add_to_db();


	}

	private function create_post_category(){
		// Create default WPGameList Game Post Category if it doesn't already exist
		$create_cat = true;
		$cat_id = 0;
		foreach((get_categories()) as $category) {
			if($category->cat_name == 'WPGameList Game Post'){
				$cat_id = get_cat_ID('WPGameList Game Post');
				$create_cat = false;
			}
		}

		if($create_cat == false){
			return $cat_id;
			
		} else {
			$result = wp_insert_term(
				'WPGameList Game Post',
				'category',
				array(
				  'description'	=> 'This is a category created by WPGameList to display a game in it\'s very own individual post',
				  'slug' 		=> 'wpgamelist-game-post-cat'
				)
			);

			if(is_object($result)){
				//TODO: Log messages here. This part here will fire if the category already exists, and apparently $result will be a wp error object
				$this->cat_create_result = $result;
			} else {
				$this->cat_create_result = $result['term_id'];
			}
		}
	}

	private function create_game_post(){
		// Initialize the page ID to -1. This indicates no action has been taken.
		$this->post_id = -1;

		$excerpt = $this->description;

		if($excerpt == '' || $excerpt == null){
			$excerpt = $this->title;
		}

		if($excerpt == '' || $excerpt == null){
			$excerpt = 'No excerpt available';
		}

			// Set the post ID so that we know the post was created successfully
			$this->post_id = wp_insert_post(
				array(
					'comment_status'	=>	'open',
					'ping_status'		=>	'closed',
					'post_author'		=>	get_current_user_id(),
					'post_name'			=>	$this->title.' (post)',
					'post_title'		=>	wp_strip_all_tags($this->title),
					'post_status'		=>	'publish',
					'post_type'			=>	'post',
					'post_content' 		=>  '<div class="wpgamelist-page-content">DO NOT DELETE</div>',
					'post_excerpt'      =>  $excerpt
				)
			);

			// Assign the category to our new post
			$get_cat_id = get_cat_ID( 'WPGameList Game Post' );
			$cat_slug = 'wpgamelist-game-post-cat';
			if ($this->post_id > 0){

				$this->create_post_image($this->image, $this->post_id);
				// TODO: log creation of post or error
				wp_set_post_terms($this->post_id, array($get_cat_id), 'category');
			}

			//TODO: Add image to the post
			//set_post_thumbnail( $post, $thumbnail_id );
	}

	private function create_post_image( $image_url, $post_id  ){
	    $upload_dir = wp_upload_dir();
	    $image_data = file_get_contents($image_url);

		$image_url = str_replace('%', '', $image_url);

	    $filename = basename($image_url);
	    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
	    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
	    file_put_contents($file, $image_data);

	    $wp_filetype = wp_check_filetype($filename, null );
	    $attachment = array(
	        'post_mime_type' => $wp_filetype['type'],
	        'post_title' => sanitize_file_name($filename),
	        'post_content' => '',
	        'post_status' => 'inherit'
	    );
	    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
	    require_once(ABSPATH . 'wp-admin/includes/image.php');
	    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
	    $res2= set_post_thumbnail( $post_id, $attach_id );
	}

	private function add_to_db(){
		global $wpdb;

		$table_name = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';

		$insert_array = array(
			'game_uid' => $this->game_uid, 
			'game_title' => $this->title,
			'post_id' => $this->post_id,
			'type'=> 'post',
			'post_url' => get_permalink($this->post_id),
			'author' => $this->page_author_id,
			'active_template' => 'default'
		);
		// TODO: log database save
		return $wpdb->insert( $table_name, $insert_array);
	}



}

endif;