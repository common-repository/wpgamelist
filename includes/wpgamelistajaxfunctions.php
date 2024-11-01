<?php



// Function for adding a game 
function wpgamelist_dashboard_add_game_action_javascript() { 
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	// Translations
	$trans1 = __('Success!', 'wpgamelist');
	$trans2 = __("You've just added a new game to your library! Remember, to display your library, simply place this shortcode on a page or post:", 'wpgamelist');
	$trans3 = __("Click Here to View Your New Game", 'wpgamelist');
	$trans4 = __("Click Here to View This Game's Post", 'wpgamelist');
	$trans5 = __("Click Here to View This Game's Page", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans10 = __("Whoops! Looks like there was an error trying to add your game! Please check the information you provided (especially that ISBN number), and try again.", 'wpgamelist');




	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		// For the game cover image upload
		var file_frame;
		var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
		var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

		jQuery('#wpgamelist-addgame-upload_image_button, #wpgamelist-storefront-img-button-1, #wpgamelist-storefront-img-button-2, #wpgamelist-branding-img-button-1, #wpgamelist-branding-img-button-2').on('click', function( event ){
			var buttonid = $(this).attr('id');
			$(this).attr('data-active', true);
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				// Set the post ID to what we want
				file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				// Open frame
				file_frame.open();
				return;
			} else {
				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = set_to_post_id;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Select a image to upload',
				button: {
				text: 'Use this image',
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here

				// Add preview image to dom
				if($('#wpgamelist-addgame-upload_image_button').attr('data-active') == 'true'){
					$( '#wpgamelist-add-game-text-input-2' ).val(attachment.url);
				}

				// Add preview image to dom for branding extension
				if($('#wpgamelist-branding-img-button-1').attr('data-active') == 'true'){
					$( '#wpgamelist-branding-image-url-1' ).val(attachment.url);
					$( '#wpgamelist-branding-preview-img-1' ).attr('src', attachment.url);
					$('#wpgamelist-branding-img-button-1').attr('data-active', false);
				}

				// Add second preview image to dom for branding extension
				if($('#wpgamelist-branding-img-button-2').attr('data-active') == 'true'){
					$( '#wpgamelist-branding-image-url-2' ).val(attachment.url);
					$( '#wpgamelist-branding-preview-img-2' ).attr('src', attachment.url);
					$('#wpgamelist-branding-img-button-2').attr('data-active', false);
				}


				// Add preview image to dom for storefront extension
				if($('#wpgamelist-storefront-img-button-1').attr('data-active') == 'true'){
					$( '#wpgamelist-branding-image-url-2' ).val(attachment.url);
					$( '#wpgamelist-storefront-preview-img-1' ).attr('src', attachment.url);
					$('#wpgamelist-storefront-img-button-1').attr('data-active', false);
				}

				// Add second preview image to dom for storefront extension
				if($('#wpgamelist-storefront-img-button-2').attr('data-active') == 'true'){
					$( '#wpgamelist-storefront-preview-img-2' ).attr('src', attachment.url);
					$('#wpgamelist-storefront-img-button-2').attr('data-active', false);
				}

				// Restore the main post ID
				wp.media.model.settings.post.id = wp_media_post_id;
			});
				// Finally, open the modal
				file_frame.open();
		});

		// Restore the main ID when the add media button is pressed
		jQuery( 'a.add_media' ).on( 'click', function() {
			wp.media.model.settings.post.id = wp_media_post_id;
		});


		// When a searched cover image gets clicked
		$(document).on("click",".wpgamelist-add-game-search-column", function(event){

			// Get all info from dom 
			var perspectives = $(this).attr('data-perspectives');
			var gamemodes = $(this).attr('data-gamemodes');
			var criticrating = $(this).attr('data-criticrating');
			var rating = $(this).attr('data-rating');
			var publishers = $(this).attr('data-publishers');
			var developers = $(this).attr('data-developers');
			var platforms = $(this).attr('data-platforms');
			var genre = $(this).attr('data-genre');
			var firstreleasedate = $(this).attr('data-firstreleasedate');
			var coverlink = $(this).attr('data-coverlink');
			var title = $(this).attr('data-title');
			var themes = $(this).attr('data-themes');
			var series = $(this).attr('data-collection');
			var franchise = $(this).attr('data-franchise');
			var igdblink = $(this).attr('data-igdblink');
			var summary = $(this).attr('data-summary');
			var esrb = $(this).attr('data-esrbstring');
			var pegi = $(this).attr('data-pegistring');

			// Hidden values
			var altnames = $(this).attr('data-alternativenamesstring');
			var screenshots = $(this).attr('data-screenshotstring');
			var websites = $(this).attr('data-websitestring');
			var videos = $(this).attr('data-videostring');


			if(pegi == 1){
				pegi = 'Age 3+';
			}

			if(pegi == 2){
				pegi = 'Age 7+';
			}

			if(pegi == 3){
				pegi = 'Age 12+';
			}

			if(pegi == 4){
				pegi = 'Age 16+';
			}

			if(pegi == 5){
				pegi = 'Age 18+';
			}

			if(pegi == 6){
				pegi = 'Parental Guidance Recommended';
			}


			if(esrb == 1){
				esrb = 'Rating Pending';
			}

			if(esrb == 2){
				esrb = 'Early Childhood';
			}

			if(esrb == 3){
				esrb = 'Everyone';
			}

			if(esrb == 4){
				esrb = 'Everyone 10+';
			}

			if(esrb == 5){
				esrb = 'Teen';
			}

			if(esrb == 6){
				esrb = 'Mature';
			}

			if(esrb == 7){
				esrb = 'Adults Only';
			}

			// Translating date
			var date = new Date(firstreleasedate*1000);
			var year = date.getFullYear();
			var month = String(date.getMonth()+1);
			var day = String(date.getDate()+1);
			if(day.length == 1){
				day = '0'+day;
			}
			if(month.length == 1){
				month = '0'+month;
			}
			firstreleasedate = year+'-'+month+'-'+day;

			$('#wpgamelist-add-game-text-input-1').val(title);
			$('#wpgamelist-add-game-text-input-2').val(coverlink);
			$('#wpgamelist-add-game-date-input-1').val(firstreleasedate);
			$('#wpgamelist-add-game-text-input-3').val(platforms);
			$('#wpgamelist-add-game-text-input-4').val(genre);
			$('#wpgamelist-add-game-text-input-5').val(developers);
			$('#wpgamelist-add-game-text-input-6').val(publishers);
			$('#wpgamelist-add-game-text-input-7').val(rating);
			$('#wpgamelist-add-game-text-input-8').val(criticrating);
			$('#wpgamelist-add-game-text-input-9').val(perspectives);
			$('#wpgamelist-add-game-text-input-10').val(gamemodes);
			$('#wpgamelist-add-game-text-input-11').val(themes);
			$('#wpgamelist-add-game-text-input-12').val(series);
			$('#wpgamelist-add-game-text-input-13').val(franchise);
			$('#wpgamelist-add-game-text-input-14').val(igdblink);
			$('#wpgamelist-add-game-textarea-input-1').val(summary);
			$('#wpgamelist-add-game-select-input-1').val(esrb);
			$('#wpgamelist-add-game-select-input-2').val(pegi);

			// Hidden values
			$('#wpgamelist-add-game-hidden-text-input-1').val(videos);
			$('#wpgamelist-add-game-hidden-text-input-2').val(websites);
			$('#wpgamelist-add-game-hidden-text-input-3').val(screenshots);
			$('#wpgamelist-add-game-hidden-text-input-4').val(altnames);

			$('html,body').animate({
		    	scrollTop: $("#wpgamelist-add-game-form-div").offset().top-50
		    }, 1000);

			$('#wpgamelist-add-game-bottom-instruction-div').animate({'opacity':1})

			

		});

















		// When the Add A Game button gets clicked
	  	$("#wpgamelist-add-game-button-actual").click(function(event){
	  		var successDiv = $('#wpgamelist-add-game-response-div');
	  		successDiv.html('');
			$('#wpgamelist-success-view-post').animate({'opacity':'0'}, 500);

	  		event.preventDefault(event);

    		var woocommerce = 'No';
    		var woofile = '';

			// Text inputs
			var title = $("#wpgamelist-add-game-text-input-1").val();
			var image = $("#wpgamelist-add-game-text-input-2").val();
			var platforms = $("#wpgamelist-add-game-text-input-3").val();
			var genres = $("#wpgamelist-add-game-text-input-4").val();
			var developer = $("#wpgamelist-add-game-text-input-5").val();
			var publisher = $("#wpgamelist-add-game-text-input-6").val();
			var rating = $("#wpgamelist-add-game-text-input-7").val();
			var criticrating = $("#wpgamelist-add-game-text-input-8").val();
			var perspective = $("#wpgamelist-add-game-text-input-9").val();
			var gamemodes = $("#wpgamelist-add-game-text-input-10").val();
			var themes = $("#wpgamelist-add-game-text-input-11").val();
			var series = $("#wpgamelist-add-game-text-input-12").val();
			var franchise = $("#wpgamelist-add-game-text-input-13").val();
			var igdblink = $("#wpgamelist-add-game-text-input-14").val();
			var price = $("#wpgamelist-addgame-price").val();
			var purchaselink = $("#wpgamelist-addgame-sale-author-link").val();

			// Date inputs
			var releasedate = $('#wpgamelist-add-game-date-input-1').val()
			var finishedate = $('#wpgamelist-add-game-date-input-2').val()

			// Select inputs
			var esrb = $('#wpgamelist-add-game-select-input-1').val()
			var pegi = $('#wpgamelist-add-game-select-input-2').val()
			var owned = $('#wpgamelist-add-game-select-input-3').val()
			var gamecondition = $('#wpgamelist-add-game-select-input-4').val()
			var finished = $('#wpgamelist-add-game-select-input-5').val()
			var myrating = $('#wpgamelist-add-game-select-input-6').val()
			var library = $('#wpgamelist-addgame-select-library').val();
			var page = $('#wpgamelist-add-game-select-input-7').val();
			var post = $('#wpgamelist-add-game-select-input-8').val();

			// Textarea inputs
			var summary = $('#wpgamelist-add-game-textarea-input-1').val()
			var notes = $('#wpgamelist-add-game-textarea-input-2').val()

			// Hidden values
			var videos = $('#wpgamelist-add-game-hidden-text-input-1').val();
			var websites = $('#wpgamelist-add-game-hidden-text-input-2').val();
			var screenshots = $('#wpgamelist-add-game-hidden-text-input-3').val();
			var altnames = $('#wpgamelist-add-game-hidden-text-input-4').val();

			// WooCommerce values
			var woocommerce = $("#wpgamelist-add-game-select-input-9").val()
			var salePrice = $( "#wpgamelist-add-game-storefront-woo-text-input-2" ).val();
			var regularPrice = $( "#wpgamelist-add-game-storefront-woo-text-input-1" ).val();
			var stock = $( "#wpgamelist-add-game-storefront-woo-num-input-5" ).val();
			var length = $( "#wpgamelist-add-game-storefront-woo-num-input-4" ).val();
			var width = $( "#wpgamelist-add-game-storefront-woo-num-input-1" ).val();
			var height = $( "#wpgamelist-add-game-storefront-woo-num-input-2" ).val();
			var weight = $( "#wpgamelist-add-game-storefront-woo-num-input-3" ).val();
			var sku = $("#wpgamelist-addgame-woo-sku" ).val();
			var virtual = $("#wpgamelist-add-game-storefront-woo-select-input-2").val();
			var download = $("#wpgamelist-add-game-storefront-woo-select-input-3").val();
			var woofile = $('#wpgamelist-storefront-preview-img-1').attr('data-id');
			var salebegin = $('#wpgamelist-add-game-storefront-woo-date-input-1').val();
			var saleend = $('#wpgamelist-add-game-storefront-woo-date-input-2').val();
			var purchasenote = $('#wpgamelist-add-game-storefront-woo-textarea-input-1').val();
			var productcategory = $('#wpgamelist-add-game-storefront-woo-select-input-1').val();
			var reviews = $('#wpgamelist-woocommerce-review-yes').prop('checked');
			var upsells = $('#select2-upsells').val();
			var crosssells = $('#select2-crosssells').val();

			var upsellString = '';
			var crosssellString = '';

			// Making checks to see if Storefront extension is active
			if(upsells != undefined){
				for (var i = 0; i < upsells.length; i++) {
					upsellString = upsellString+','+upsells[i];
				};
			}

			if(crosssells != undefined){
				for (var i = 0; i < crosssells.length; i++) {
					crosssellString = crosssellString+','+crosssells[i];
				};
			}

			if(salebegin != undefined && saleend != undefined){
				// Flipping the sale date start
				if(salebegin.indexOf('-')){
					var finishedtemp = salebegin.split('-');
					salebegin = finishedtemp[0]+'-'+finishedtemp[1]+'-'+finishedtemp[2]
				}

				// Flipping the sale date end
				if(saleend.indexOf('-')){
					var finishedtemp = saleend.split('-');
					saleend = finishedtemp[0]+'-'+finishedtemp[1]+'-'+finishedtemp[2]
				}	
			}

			// Show working spinner and hide reveiw message
			$('#wpgamelist-add-game-bottom-instruction-div').animate({'opacity':'0'}, 500);
			$('#wpgamelist-spinner-2').animate({'opacity':'1'}, 500);
			
    		var data = {
				'action': 'wpgamelist_dashboard_add_game_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_dashboard_add_game_action_callback" ); ?>',
				'title':title,
				'image':image,
				'platforms':platforms,
				'genres':genres,
				'developer':developer,
				'publisher':publisher,
				'rating':rating,
				'criticrating':criticrating,
				'perspective':perspective,
				'gamemodes':gamemodes,
				'themes':themes,
				'series':series,
				'franchise':franchise,
				'igdblink':igdblink,
				'price':price,
				'purchaselink':purchaselink,
				'releasedate':releasedate,
				'finishedate':finishedate,
				'esrb':esrb,
				'pegi':pegi,
				'owned':owned,
				'gamecondition':gamecondition,
				'finished':finished,
				'myrating':myrating,
				'library':library,
				'summary':summary,
				'notes':notes,
				'videos':videos,
				'websites':websites,
				'screenshots':screenshots,
				'altnames':altnames,
				'woocommerce':woocommerce,
				'saleprice':salePrice,
				'regularprice':regularPrice,
				'stock':stock,
				'length':length,
				'width':width,
				'height':height,
				'weight':weight,
				'sku':sku,
				'virtual':virtual,
				'download':download,
				'woofile':woofile,
				'salebegin':salebegin,
				'saleend':saleend,
				'purchasenote':purchasenote,
				'productcategory':productcategory,
				'reviews':reviews,
				'upsells':upsellString,
				'crosssells':crosssellString,
				'page':page,
				'post':post
			};

			console.log('This is the data that is about to be sent to the server for saving in the database');
			console.log(data)

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {


			   
			    	console.log(response);
			    	response = response.split('sep');

			    	console.log('This is the data that was sent to the server after the POST filters:');
					console.log(JSON.parse(response[7]))

			    	if(response[0] == 1){

			    		var addGameSuccess1 = "<p><span id='wpgamelist-add-game-success-span'><?php echo $trans1; ?></span><br/> <?php echo $trans2; ?> <span id='wpgamelist-addgame-success-shortcode'>"; 

			    		if(library.includes('wpgamelist_jre_saved_game_log')){
			    			var shortcode = '[wpgamelist_shortcode]'
			    		} else {
			    			library = library.split('_');
			    			library = library[library.length-1];
			    			var shortcode = '[wpgamelist_shortcode table="'+library+'"]'
			    		}
			    		
			    		var addGameSuccess2 = shortcode+'</span></p><a id="wpgamelist-success-1" class="wpgamelist-show-game-colorbox"><?php echo $trans3; ?></a>';

			    		var addGameSuccess3 = '';

			    		// If game addition was succesful and user chose to create a post
			    		if(response[4] == 'true' && response[3] == 'false'){
			    			var addGameSuccess3 = "<p id='wpgamelist-addgame-success-post-p'><a href='"+response[6]+"'><?php echo $trans4; ?></a></p></div>";
			    			$('#wpgamelist-addgame-signed-first-table').animate({'margin-bottom':'70px'}, 500);
			    			$('#wpgamelist-success-view-post').animate({'opacity':'1'}, 500);
			    		} 

			    		// If game addition was succesful and user chose to create a page
			    		if(response[3] == 'true' && response[4] == 'false'){
			    			var addGameSuccess3 = "<p id='wpgamelist-addgame-success-page-p'><a href='"+response[5]+"'><?php echo $trans5; ?></a></p></div>";
			    			$('#wpgamelist-addgame-signed-first-table').animate({'margin-bottom':'70px'}, 500);
			    			$('#wpgamelist-success-view-page').animate({'opacity':'1'}, 500);
			    		} 

			    		// If game addition was succesful and user chose to create a post and a page
			    		if(response[3] == 'true' && response[4] == 'true'){
			    			var addGameSuccess3 = "<p id='wpgamelist-addgame-success-page-p'><a href='"+response[5]+"'><?php echo $trans5; ?></a></p><p id='wpgamelist-addgame-success-post-p'><a href='"+response[6]+"'><?php echo $trans4; ?></a></p></div>";
			    			$('#wpgamelist-addgame-signed-first-table').animate({'margin-bottom':'100px'}, 500);
			    			$('#wpgamelist-success-view-page').animate({'opacity':'1'}, 500);
			    			$('#wpgamelist-success-view-post').animate({'opacity':'1'}, 500);
			    		} 

			    		// Add response message to DOM
			    		var endMessage = '<div id="wpgamelist-addgame-success-thanks"><?php echo $trans6; ?> <a href="http://wpgamelist.com/index.php/extensions/">&nbsp;<?php echo $trans7; ?></a><br/><br/><?php echo $trans8; ?> <a id="wpgamelist-addgame-success-review-link" href="https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5" ><?php echo $trans9; ?></a><img id="wpgamelist-smile-icon-1" src="<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png"></div>';
			    		successDiv.html(addGameSuccess1+addGameSuccess2+addGameSuccess3+endMessage);

			    		$('#wpgamelist-spinner-2').animate({'opacity':'0'}, 500);
			    		$('#wpgamelist-success-1').animate({'opacity':'1'}, 500);
			    		$('#wpgamelist-success-1').attr('data-gameid', response[1]);
			    		$('#wpgamelist-success-1').attr('data-gametable', response[2]);
			    	} else {
			    		$('#wpgamelist-addgame-signed-first-table').animate({'margin-bottom':'65px'}, 500);
			    		$('#wpgamelist-success-1').html('<?php echo $trans10; ?>');
			    		$('#wpgamelist-spinner-2').animate({'opacity':'0'}, 500);
			    		$('#wpgamelist-success-1').animate({'opacity':'1'}, 500);
			    	}

			    	
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					$('#wpgamelist-success-1').html('<?php echo $trans10; ?>');
		    		$('#wpgamelist-spinner-1').animate({'opacity':'0'}, 500);
		    		$('#wpgamelist-success-1').animate({'opacity':'1'}, 500);
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
		            // TODO: Log the console errors here
				}
			});

	     	event.preventDefault ? event.preventDefault() : event.returnValue = false;

	  	});
	});
	</script>
	<?php
}

// Callback function for adding a game 
function wpgamelist_dashboard_add_game_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_dashboard_add_game_action_callback', 'security' );
	$title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
	$image = filter_var($_POST['image'],FILTER_SANITIZE_URL);
	$platforms = filter_var($_POST['platforms'],FILTER_SANITIZE_STRING);
	$genres = filter_var($_POST['genres'],FILTER_SANITIZE_STRING);
	$developer = filter_var($_POST['developer'],FILTER_SANITIZE_STRING);
	$publisher = filter_var($_POST['publisher'],FILTER_SANITIZE_STRING);
	$rating = filter_var($_POST['rating'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$criticrating = filter_var($_POST['criticrating'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$perspective = filter_var($_POST['perspective'],FILTER_SANITIZE_STRING);
	$gamemodes = filter_var($_POST['gamemodes'],FILTER_SANITIZE_STRING);
	$themes = filter_var($_POST['themes'],FILTER_SANITIZE_STRING);
	$series = filter_var($_POST['series'],FILTER_SANITIZE_STRING);
	$franchise = filter_var($_POST['franchise'],FILTER_SANITIZE_STRING);
	$igdblink = filter_var($_POST['igdblink'],FILTER_SANITIZE_URL);
	$price = filter_var($_POST['price'],FILTER_SANITIZE_STRING);
	$purchaselink = filter_var($_POST['purchaselink'],FILTER_SANITIZE_URL);
	$releasedate = filter_var($_POST['releasedate'],FILTER_SANITIZE_STRING);
	$finishedate = filter_var($_POST['finishedate'],FILTER_SANITIZE_STRING);
	$esrb = filter_var($_POST['esrb'],FILTER_SANITIZE_STRING);
	$pegi = filter_var($_POST['pegi'],FILTER_SANITIZE_STRING);
	$owned = filter_var($_POST['owned'],FILTER_SANITIZE_STRING);
	$gamecondition = filter_var($_POST['gamecondition'],FILTER_SANITIZE_STRING);
	$finished = filter_var($_POST['finished'],FILTER_SANITIZE_STRING);
	$myrating = filter_var($_POST['myrating'],FILTER_SANITIZE_STRING);
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
	$summary = filter_var($_POST['summary'],FILTER_SANITIZE_STRING);
	$notes = filter_var($_POST['notes'],FILTER_SANITIZE_STRING);
	$videos = filter_var($_POST['videos'],FILTER_SANITIZE_STRING);
	$websites = filter_var($_POST['websites'],FILTER_SANITIZE_STRING);
	$screenshots = filter_var($_POST['screenshots'],FILTER_SANITIZE_STRING);
	$altnames = filter_var($_POST['altnames'],FILTER_SANITIZE_STRING);
	$woocommerce = filter_var($_POST['woocommerce'],FILTER_SANITIZE_STRING);
	$saleprice = filter_var($_POST['saleprice'],FILTER_SANITIZE_STRING);
	$regularprice = filter_var($_POST['regularprice'],FILTER_SANITIZE_STRING);
	$stock = filter_var($_POST['stock'],FILTER_SANITIZE_STRING);
	$length = filter_var($_POST['length'],FILTER_SANITIZE_STRING);
	$width = filter_var($_POST['width'],FILTER_SANITIZE_STRING);
	$height = filter_var($_POST['height'],FILTER_SANITIZE_STRING);
	$weight = filter_var($_POST['weight'],FILTER_SANITIZE_STRING);
	$sku = filter_var($_POST['sku'],FILTER_SANITIZE_STRING);
	$virtual = filter_var($_POST['virtual'],FILTER_SANITIZE_STRING);
	$download = filter_var($_POST['download'],FILTER_SANITIZE_STRING);
	$woofile = filter_var($_POST['woofile'],FILTER_SANITIZE_STRING);
	$salebegin = filter_var($_POST['salebegin'],FILTER_SANITIZE_STRING);
	$saleend = filter_var($_POST['saleend'],FILTER_SANITIZE_STRING);
	$purchasenote = filter_var($_POST['purchasenote'],FILTER_SANITIZE_STRING);
	$productcategory = filter_var($_POST['productcategory'],FILTER_SANITIZE_STRING);
	$reviews = filter_var($_POST['reviews'],FILTER_SANITIZE_STRING);
	$crosssells = filter_var($_POST['crosssells'],FILTER_SANITIZE_STRING);
	$upsells = filter_var($_POST['upsells'],FILTER_SANITIZE_STRING);
	$page = filter_var($_POST['page'],FILTER_SANITIZE_STRING);
	$post = filter_var($_POST['post'],FILTER_SANITIZE_STRING);


	$game_array = array(
		'title' => $title,
		'image' => $image,
		'platforms' => $platforms,
		'genres' => $genres,
		'developer' => $developer,
		'publisher' => $publisher,
		'rating' => $rating,
		'criticrating' => $criticrating,
		'perspective' => $perspective,
		'gamemodes' => $gamemodes,
		'themes' => $themes,
		'series' => $series,
		'franchise' => $franchise,
		'igdblink' => $igdblink,
		'price' => $price,
		'purchaselink' => $purchaselink,
		'releasedate' => $releasedate,
		'finishedate' => $finishedate,
		'esrb' => $esrb,
		'pegi' => $pegi,
		'owned' => $owned,
		'gamecondition' => $gamecondition,
		'finished' => $finished,
		'myrating' => $myrating,
		'library' => $library,
		'summary' => $summary,
		'notes' => $notes,
		'videos' => $videos,
		'websites' => $websites,
		'screenshots' => $screenshots,
		'altnames' => $altnames,
		'woocommerce' => $woocommerce,
		'saleprice' => $saleprice,
		'regularprice' => $regularprice,
		'stock' => $stock,
		'length' => $length,
		'width' => $width,
		'height' => $height,
		'weight' => $weight,
		'sku' => $sku,
		'virtual' => $virtual,
		'download' => $download,
		'woofile' => $woofile,
		'salebegin' => $salebegin,
		'saleend' => $saleend,
		'purchasenote' => $purchasenote,
		'productcategory' => $productcategory,
		'reviews' => $reviews,
		'crosssells' => $crosssells,
		'upsells' => $upsells,
		'page' => $page,
		'post' => $post,
	);

	


	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$game_class = new WPGameList_Game('add', $game_array, null, null);
	$addgameresult = explode(',',$game_class->addgameresult);



	// If game added succesfully, get the ID of the game we just inserted, and return the result and that ID
	if($addgameresult[0] == 1){
		$game_table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
  		$id_result = $addgameresult[1];
  		$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $library WHERE ID = %d", $id_result));

  		// Get saved page URL
		$table_name = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';
  		$page_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE game_uid = %s AND type = 'page'" , $row->game_uid));

  		// Get saved post URL
		$table_name = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';
  		$post_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE game_uid = %s AND type = 'post'", $row->game_uid));

  		echo $addgameresult[0].'sep'.$id_result.'sep'.$library.'sep'.$page.'sep'.$post.'sep'.$page_results->post_url.'sep'.$post_results->post_url.'sep'.json_encode($game_array);
	}

	wp_die();
}


// Function for displaying a game in the colorbox window
function wpgamelist_show_game_in_colorbox_action_javascript() { 

	$trans1 = __('Loading, Please wait', 'wpgamelist');

	?>
  	<script type="text/javascript">
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click",".wpgamelist-show-game-colorbox", function(event){
  			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  		var gameId = $(this).attr('data-gameid');
	  		var gameTable = $(this).attr('data-gametable');

	  		var brandingtext1 = $('#wpgamelist-branding-text-1').attr('data-value');
	  		if(brandingtext1 == undefined){
	  			brandingtext1 = '';
	  		}
	  		var brandingtext2 = $('#wpgamelist-branding-text-2').attr('data-value');
	  		if(brandingtext2 == undefined){
	  			brandingtext2 = '';
	  		}
	  		var brandinglogo1 = $('#wpgamelist-branding-logo-1').attr('data-value');
	  		if(brandinglogo1 == undefined){
	  			brandinglogo1 = '';
	  		}
	  		var brandinglogo2 = $('#wpgamelist-branding-logo-2').attr('data-value');
	  		if(brandinglogo2 == undefined){
	  			brandinglogo2 = '';
	  		}

		  	var data = {
				'action': 'wpgamelist_show_game_in_colorbox_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_show_game_in_colorbox_action_callback" ); ?>',
				'gameId':gameId,
				'gameTable':gameTable
			};
			console.log(data);

			$.colorbox({
		        iframe:true,
		        title: "<?php echo $trans1; ?>", 
		        width: "50%", 
		        height: "80%", 
		        html: "&nbsp;", 
		        fastIframe:false,
		        onComplete:function(){
		        	if(brandinglogo1 != ''){
		        		$('#wpgamelist-branding-img-1-id').remove();
		        		$('#cboxLoadingGraphic').css({'background':'none'})
		        		$('#cboxLoadingGraphic').append('<img style="margin-left: auto;margin-right: auto;display: block;width: 20%;margin-top: 15%;" id="wpgamelist-branding-img-1-id" src="'+brandinglogo1+'" />')
		        		
		        	}

		        	if(brandingtext1 != ''){
		        		$('#wpgamelist-branding-text-1-id').remove();
		        		$('#cboxLoadingGraphic').css({'background':'none'})
		        		$('#cboxLoadingGraphic').append('<p style="text-align: center;font-style: italic;font-size: 17px;font-weight: bold;" id="wpgamelist-branding-text-1-id">'+brandingtext1+'</p>')
		        	}

		        	$('#cboxLoadingGraphic').show();
		            $('#cboxLoadingGraphic').css({'display':'block'})
		        }
		    });

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {

			    	response = response.split('---sep---');
			    	console.log(response[1]);
			    	
			    	$.colorbox({
						open: true,
						preloading: true,
						scrolling: true,
						width:'70%',
						height:'70%',
						html: response[0],
						onClosed:function(){
						  //Do something on close.
						},
						onComplete:function(){

							if(brandinglogo2 != '' && brandingtext2 == ''){
								$('#cboxTitle').css({'border':'solid 1px #e1e1e1','height':'100px','background-color':'white', 'bottom':'-95px'})
								$('#cboxWrapper').css({'overflow':'visible'})
								$('#colorbox').css({'height':($('#colorbox').height()+100)+'px'})
								$('#cboxTitle').append('<img id="wpgamelist-branding-logo-2-id" style="width:50px; margin-top:20px;" src="'+brandinglogo2+'" />')
							}

							if(brandingtext2 != '' && brandinglogo2 == ''){
								$('#cboxTitle').css({'border':'solid 1px #e1e1e1','height':'100px','background-color':'white', 'bottom':'-95px'})
								$('#cboxWrapper').css({'overflow':'visible'})
								$('#colorbox').css({'height':($('#colorbox').height()+100)+'px'})
								$('#cboxTitle').append('<p style="text-align: center;font-style: italic;font-size: 17px;font-weight: bold;" id="wpgamelist-branding-text-2-id">'+brandingtext2+'</p>')
							}

							if(brandingtext2 != '' && brandinglogo2 != ''){
								$('#cboxTitle').css({'border':'solid 1px #e1e1e1','height':'100px','background-color':'white', 'bottom':'-95px'})
								$('#cboxWrapper').css({'overflow':'visible'})
								$('#colorbox').css({'height':($('#colorbox').height()+100)+'px'})
								$('#cboxTitle').append('<img id="wpgamelist-branding-logo-2-id" style="display:inline-block; margin-right:10px; margin-top:20px; width:50px;" src="'+brandinglogo2+'" /><p style="display:inline-block; text-align: center; margin: 0; bottom: 20px; position: relative; font-style: italic;font-size: 17px;font-weight: bold;" id="wpgamelist-branding-text-2-id">'+brandingtext2+'</p>')
							}

							
							// Hide blank 'Similar Titles' images
							$('.wpgamelist-similar-image').load(function() {
								var image = new Image();
								image.src = $(this).attr("src");
								if(image.naturalHeight == '1'){
									$(this).parent().parent().css({'display':'none'})
								}
							});

							addthis.toolbox(
				              $(".addthis_sharing_toolbox").get()
				            );
				            addthis.toolbox(
				              $(".addthis_sharing_toolbox").get()
				            );
				            addthis.counter(
				              $(".addthis_counter").get()
				            );
						}
					});


			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});
	  	});
	});

	</script>
	<?php
}

// Callback function for showing games in the colorbox window
function wpgamelist_show_game_in_colorbox_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_show_game_in_colorbox_action_callback', 'security' );
	$game_id = filter_var($_POST['gameId'],FILTER_SANITIZE_NUMBER_INT);
	$game_table = filter_var($_POST['gameTable'],FILTER_SANITIZE_STRING);

	// Double-check that Amazon review isn't expired
	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$game = new WPGameList_Game($game_id, $game_table);
	$game->refresh_amazon_review($game_id, $game_table);

	// Instantiate the class that shows the game in colorbox
	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-show-game-in-colorbox.php');
	$colorbox = new WPGameList_Show_Game_In_Colorbox($game_id, $game_table);

	echo $colorbox->output.'---sep---'.$colorbox->isbn;
	wp_die();
}


function wpgamelist_new_lib_shortcode_action_javascript() { ?>
 <script type="text/javascript">
 "use strict";
  jQuery(document).ready(function($) {
    $("#wpgamelist-dynamic-shortcode-button").click(function(event){
      var currentVal;
      currentVal = ($("#wpgamelist-dynamic-input-library").val()).toLowerCase();
      var data = {
        'action': 'wpgamelist_new_lib_shortcode_action',
        'currentval': currentVal,
        'security': '<?php echo wp_create_nonce( "wpgamelist-jre-ajax-nonce-newlib" ); ?>'
      };


      $.post(ajaxurl, data, function(response) {
        document.location.reload(true);
      });
    });

    $(document).on("click",".wpgamelist_delete_custom_lib", function(event){
      var table = $(this).attr('id');
      var data = {
        'action': 'wpgamelist_new_lib_shortcode_action',
        'table': table,
        'security': '<?php echo wp_create_nonce( "wpgamelist-jre-ajax-nonce-newlib" ); ?>'
      };
      $.post(ajaxurl, data, function(response) {
        document.location.reload(true);
      });
    });
  });
  </script> <?php
}

function wpgamelist_new_lib_shortcode_action_callback() {
  // Grabbing the existing options from DB
  global $wpdb;
  global $charset_collate;
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  check_ajax_referer( 'wpgamelist-jre-ajax-nonce-newlib', 'security' );
  $table_name_dynamic = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
  $db_name;

  function wpgamelist_clean($string) {
      $string = str_replace(' ', '_', $string); // Replaces all spaces with underscores.
      $string = str_replace('-', '_', $string);
      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
  }
 
  // Create a new custom table
  if(isset($_POST['currentval'])){
      $db_name = sanitize_text_field($_POST['currentval']);
      $db_name = wpgamelist_clean($db_name);
  }

  // Delete the table
  if(isset($_POST['table'])){ 
      $table = $wpdb->prefix."wpgamelist_jre_".sanitize_text_field($_POST['table']);
      $pos = strripos($table,"_");
      $table = substr($table, 0, $pos);
      echo $table;
      $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table", $table));

      $delete_from_list = sanitize_text_field($_POST['table']);
      $pos2 = strripos($delete_from_list,"_");
      $delete_id = substr($delete_from_list, ($pos2+1));
      $wpdb->delete( $table_name_dynamic, array( 'ID' => $delete_id ), array( '%d' ) );
         
      // Dropping primary key in database to alter the IDs and the AUTO_INCREMENT value
      $table_name_dynamic = str_replace('\'', '`', $table_name_dynamic);
      $wpdb->query($wpdb->prepare("ALTER TABLE %s MODIFY ID bigint(190) NOT NULL" , $table_name_dynamic));

      $query2 = $wpdb->prepare( "ALTER TABLE %s DROP PRIMARY KEY", $table_name_dynamic);
      $query2 = str_replace('\'', '`', $query2);
      $wpdb->query($query2);

      // Adjusting ID values of remaining entries in database
      $my_query = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name_dynamic", $table_name_dynamic ));
      $title_count = $wpdb->num_rows;

      for ($x = $delete_id ; $x <= $title_count; $x++) {
        $data = array(
            'ID' => $delete_id 
        );
        $format = array( '%s'); 
        $delete_id ++;  
        $where = array( 'ID' => ($delete_id ) );
        $where_format = array( '%d' );
        $wpdb->update( $table_name_dynamic, $data, $where, $format, $where_format );
      }  
        
      // Adding primary key back to database 
      $query3 = $wpdb->prepare( "ALTER TABLE %s ADD PRIMARY KEY (`ID`)", $table_name_dynamic);
      $query3 = str_replace('\'', '`', $query3);
      $wpdb->query($query3);    

      $query4 = $wpdb->prepare( "ALTER TABLE %s MODIFY ID bigint(190) AUTO_INCREMENT", $table_name_dynamic);
      $query4 = str_replace('\'', '`', $query4);
      $wpdb->query($query4);

      // Setting the AUTO_INCREMENT value based on number of remaining entries
      $title_count++;
      $query5 = $wpdb->prepare( "ALTER TABLE %s AUTO_INCREMENT=%d", $table_name_dynamic,$title_count);
      $query5 = str_replace('\'', '`', $query5);
      $wpdb->query($query5);
      
  }

  if(isset($db_name)){
      if(($db_name != "")  ||  ($db_name != null)){
          $wpdb->wpgamelist_jre_dynamic_db_name = "{$wpdb->prefix}wpgamelist_jre_{$db_name}";
          $wpdb->wpgamelist_jre_dynamic_db_name_settings = "{$wpdb->prefix}wpgamelist_jre_settings_{$db_name}";
          $wpdb->wpgamelist_jre_list_dynamic_db_names = "{$wpdb->prefix}wpgamelist_jre_list_dynamic_db_names";
          $sql_create_table = "CREATE TABLE {$wpdb->wpgamelist_jre_dynamic_db_name} 
          (
				ID bigint(190) auto_increment,
				title varchar(255), 
				image varchar(255), 
				releasedate varchar(255), 
				platforms varchar(255),
				genres varchar(255), 
				developer varchar(255), 
				publisher varchar(255), 
				rating FLOAT, 
				criticrating FLOAT, 
				perspective varchar(255), 
				gamemodes varchar(255), 
				themes varchar(255), 
				series varchar(255),
				franchise varchar(255), 
				igdblink varchar(255), 
				esrb varchar(255), 
				pegi varchar(255), 
				owned varchar(255),
				gamecondition varchar(255),
				finished varchar(255), 
				finishdate varchar(255), 
				altnames MEDIUMTEXT,
				screenshots MEDIUMTEXT, 
				websites MEDIUMTEXT, 
				videos MEDIUMTEXT,
				summary MEDIUMTEXT,
				notes MEDIUMTEXT,
				myrating bigint(255),
				price varchar(255), 
				purchaselink varchar(255),
				page varchar(255), 
				post varchar(255), 
				woocommerce varchar(255), 
				game_uid varchar(255), 
				gamestopurl varchar(255),
				bestbuyurl varchar(255),
				steamurl varchar(255),
				ebayurl varchar(255),
				amazonbuylink varchar(255),
				amazonreviewiframe varchar(255),
				similaramazonproducts MEDIUMTEXT,
              PRIMARY KEY  (ID),
                KEY title (title)
          ) $charset_collate; ";
          dbDelta( $sql_create_table );


          $sql_create_table2 = "CREATE TABLE {$wpdb->wpgamelist_jre_dynamic_db_name_settings} 
		  (
	        ID bigint(190) auto_increment,
	       	username varchar(190),
	        version varchar(255) NOT NULL DEFAULT '3.3',
	        amazonaff varchar(255) NOT NULL DEFAULT 'wpbooklistid-20',
	        amazonauth varchar(255),
	        enablepurchase bigint(255),
	        amazonapipublic varchar(255),
	        hidetitlelibrary bigint(255),
	        hidetitlegame bigint(255),
	        hidesearch bigint(255),
	        hidesort bigint(255),
	        hidestats bigint(255),
	        hidequote bigint(255),
	        hidestarsgame bigint(255),
	        hidestarslibrary bigint(255),
	        hidefacebookshare bigint(255),
	        hidefacebookmessenger bigint(255),
	        hidegoogleplus bigint(255),
	        hidepinterest bigint(255),
	        hideemail bigint(255),
	        hidetwitter bigint(255),
	        hidegamepost bigint(255),
	        hidegamepage bigint(255),
	        hidefinished bigint(255),
	        hidecoverimage bigint(255),
	        hidepublisher bigint(255),
	        hidedeveloper bigint(255),
	        hidegenre bigint(255),
	        hidereleasedate bigint(255),
	        hideseries bigint(255),
	        hidecriticrating bigint(255),
	        hideigdblink bigint(255),
	        hideplatforms bigint(255),
	        hidealtnames bigint(255),
	        hideamazonreviews bigint(255),
	        hidenotes bigint(255),
	        hidedescription bigint(255),
	        hidesteampurchase bigint(255),
	        hideebaypurchase bigint(255),
	        hidegamestoppurchase bigint(255),
	        hidebestbuypurchase bigint(255),
	        hideamazonpurchase bigint(255),
	        hidesimilartitles bigint(255),
	        hidefrontendbuyimg bigint(255),
	        hidefrontendbuyprice bigint(255),
	        hidecolorboxbuyimg bigint(255),
	        hidecolorboxbuyprice bigint(255),
	        sortoption varchar(255),
	        gamesonpage bigint(255) NOT NULL DEFAULT 12,
	        amazoncountryinfo varchar(255) NOT NULL DEFAULT 'US',
	        stylepak varchar(255) NOT NULL DEFAULT 'Default',
	        admindismiss bigint(255) NOT NULL DEFAULT 1,
	        activeposttemplate varchar(255),
	        activepagetemplate varchar(255),
	        adminmessage varchar(10000) NOT NULL DEFAULT '".GAMELIST_GAMELIST_GAMELIST_ADMIN_MESSAGE."',
	        PRIMARY KEY  (ID),
          	KEY username (username)
		  ) $charset_collate; ";
		  dbDelta( $sql_create_table2 );

		  	$table_name = $wpdb->wpgamelist_jre_dynamic_db_name_settings;
  			$wpdb->insert( $table_name, array('ID' => 1));

          $wpdb->insert( $table_name_dynamic, array('user_table_name' => $db_name ));
      }
  }
      
  wp_die();
}

// function for saving library display options
function wpgamelist_dashboard_save_library_display_options_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$("#wpgamelist-save-backend").click(function(event){

	  		var enablepurchase = $("input[name='enable-purchase-link']" ).prop('checked');
			var hidetitlelibrary = $("input[name='wpgamelist-input-4']" ).prop('checked');
			var hidetitlegame = $("input[name='wpgamelist-input-5']" ).prop('checked');
			var hidesearch = $("input[name='wpgamelist-input-1']" ).prop('checked');
			var hidesort = $("input[name='wpgamelist-input-2']" ).prop('checked');
			var hidestats = $("input[name='wpgamelist-input-3']" ).prop('checked');
			var hidequote = $("input[name='wpgamelist-input-36']" ).prop('checked');
			var hidestarsgame = $("input[name='wpgamelist-input-7']" ).prop('checked');
			var hidestarslibrary = $("input[name='wpgamelist-input-6']" ).prop('checked');
			var hidefacebookshare = $("input[name='wpgamelist-input-8']" ).prop('checked');
			var hidefacebookmessenger = $("input[name='wpgamelist-input-9']" ).prop('checked');
			var hidegoogleplus = $("input[name='wpgamelist-input-11']" ).prop('checked');
			var hidepinterest = $("input[name='wpgamelist-input-12']" ).prop('checked');
			var hideemail = $("input[name='wpgamelist-input-13']" ).prop('checked');
			var hidetwitter = $("input[name='wpgamelist-input-10']" ).prop('checked');
			var hidegamepost = $("input[name='wpgamelist-input-15']" ).prop('checked');
			var hidegamepage = $("input[name='wpgamelist-input-14']" ).prop('checked');
			var hidefinished = $("input[name='wpgamelist-input-16']" ).prop('checked');
			var hidecoverimage = $("input[name='wpgamelist-input-17']" ).prop('checked');
			var hidepublisher = $("input[name='wpgamelist-input-18']" ).prop('checked');
			var hidedeveloper = $("input[name='wpgamelist-input-19']" ).prop('checked');
			var hidegenre = $("input[name='wpgamelist-input-20']" ).prop('checked');
			var hidereleasedate = $("input[name='wpgamelist-input-21']" ).prop('checked');
			var hideseries = $("input[name='wpgamelist-input-22']" ).prop('checked');
			var hidecriticrating = $("input[name='wpgamelist-input-23']" ).prop('checked');
			var hideigdblink = $("input[name='wpgamelist-input-24']" ).prop('checked');
			var hideplatforms = $("input[name='wpgamelist-input-25']" ).prop('checked');
			var hidealtnames = $("input[name='wpgamelist-input-26']" ).prop('checked');
			var hideamazonreviews = $("input[name='wpgamelist-input-27']" ).prop('checked');
			var hidenotes = $("input[name='wpgamelist-input-28']" ).prop('checked');
			var hidedescription = $("input[name='wpgamelist-input-29']" ).prop('checked');
			var hidesteampurchase = $("input[name='wpgamelist-input-30']" ).prop('checked');
			var hideebaypurchase = $("input[name='wpgamelist-input-31']" ).prop('checked');
			var hidegamestoppurchase = $("input[name='wpgamelist-input-32']" ).prop('checked');
			var hidebestbuypurchase = $("input[name='wpgamelist-input-33']" ).prop('checked');
			var hideamazonpurchase = $("input[name='wpgamelist-input-34']" ).prop('checked');
			var hidesimilartitles = $("input[name='wpgamelist-input-35']" ).prop('checked');

			/*
			var hidefrontendbuyimg = $("input[name='wpgamelist-input-37']" ).prop('checked');
			var hidefrontendbuyprice = $("input[name='wpgamelist-input-38']" ).prop('checked');
			var hidecolorboxbuyimg = $("input[name='wpgamelist-input-39']" ).prop('checked');
			var hidecolorboxbuyprice  = $("input[name='wpgamelist-input-40']" ).prop('checked');
			*/
			var sortoption = $("#wpgamelist-jre-sorting-select" ).val();
			var gamesonpage = $("input[name='wpgamelist-input-40']").val();
			var library = $("#wpgamelist-library-settings-select").val();

		  	var data = {
				'action': 'wpgamelist_dashboard_save_library_display_options_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_dashboard_save_library_display_options_action_callback" ); ?>',
				'enablepurchase' : enablepurchase,
				'hidetitlelibrary' : hidetitlelibrary,
				'hidetitlegame' : hidetitlegame,
				'hidesearch' : hidesearch,
				'hidesort' : hidesort,
				'hidestats' : hidestats,
				'hidequote' : hidequote,
				'hidestarsgame' : hidestarsgame,
				'hidestarslibrary' : hidestarslibrary,
				'hidefacebookshare' : hidefacebookshare,
				'hidefacebookmessenger' : hidefacebookmessenger,
				'hidegoogleplus' : hidegoogleplus,
				'hidepinterest' : hidepinterest,
				'hideemail' : hideemail,
				'hidetwitter' : hidetwitter,
				'hidegamepost' : hidegamepost,
				'hidegamepage' : hidegamepage,
				'hidefinished' : hidefinished,
				'hidecoverimage' : hidecoverimage,
				'hidepublisher' : hidepublisher,
				'hidedeveloper' : hidedeveloper,
				'hidegenre' : hidegenre,
				'hidereleasedate' : hidereleasedate,
				'hideseries' : hideseries,
				'hidecriticrating' : hidecriticrating,
				'hideigdblink' : hideigdblink,
				'hideplatforms' : hideplatforms,
				'hidealtnames' : hidealtnames,
				'hideamazonreviews' : hideamazonreviews,
				'hidenotes' : hidenotes,
				'hidedescription' : hidedescription,
				'hidesteampurchase' : hidesteampurchase,
				'hideebaypurchase' : hideebaypurchase,
				'hidegamestoppurchase' : hidegamestoppurchase,
				'hidebestbuypurchase' : hidebestbuypurchase,
				'hideamazonpurchase' : hideamazonpurchase,
				'hidesimilartitles' : hidesimilartitles,
				/*
				'hidefrontendbuyimg' : hidefrontendbuyimg,
				'hidefrontendbuyprice' : hidefrontendbuyprice,
				'hidecolorboxbuyimg' : hidecolorboxbuyimg,
				'hidecolorboxbuyprice' : hidecolorboxbuyprice,
				*/
				'sortoption' : sortoption,
				'gamesonpage' : gamesonpage,
				'library': library
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload(true);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for saving library display options
function wpgamelist_dashboard_save_library_display_options_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_dashboard_save_library_display_options_action_callback', 'security' );

	$enablepurchase = filter_var($_POST['enablepurchase'],FILTER_SANITIZE_STRING);
	$hidetitlelibrary = filter_var($_POST['hidetitlelibrary'], FILTER_SANITIZE_STRING);
	$hidetitlegame = filter_var($_POST['hidetitlegame'], FILTER_SANITIZE_STRING);
	$hidesearch = filter_var($_POST['hidesearch'], FILTER_SANITIZE_STRING);
	$hidesort = filter_var($_POST['hidesort'], FILTER_SANITIZE_STRING);
	$hidestats = filter_var($_POST['hidestats'], FILTER_SANITIZE_STRING);
	$hidequote = filter_var($_POST['hidequote'], FILTER_SANITIZE_STRING);
	$hidestarsgame = filter_var($_POST['hidestarsgame'], FILTER_SANITIZE_STRING);
	$hidestarslibrary = filter_var($_POST['hidestarslibrary'], FILTER_SANITIZE_STRING);
	$hidefacebookshare = filter_var($_POST['hidefacebookshare'], FILTER_SANITIZE_STRING);
	$hidefacebookmessenger = filter_var($_POST['hidefacebookmessenger'], FILTER_SANITIZE_STRING);
	$hidegoogleplus = filter_var($_POST['hidegoogleplus'], FILTER_SANITIZE_STRING);
	$hidepinterest = filter_var($_POST['hidepinterest'], FILTER_SANITIZE_STRING);
	$hideemail = filter_var($_POST['hideemail'], FILTER_SANITIZE_STRING);
	$hidetwitter = filter_var($_POST['hidetwitter'], FILTER_SANITIZE_STRING);
	$hidegamepost = filter_var($_POST['hidegamepost'], FILTER_SANITIZE_STRING);
	$hidegamepage = filter_var($_POST['hidegamepage'], FILTER_SANITIZE_STRING);
	$hidefinished = filter_var($_POST['hidefinished'], FILTER_SANITIZE_STRING);
	$hidecoverimage = filter_var($_POST['hidecoverimage'], FILTER_SANITIZE_STRING);
	$hidepublisher = filter_var($_POST['hidepublisher'], FILTER_SANITIZE_STRING);
	$hidedeveloper = filter_var($_POST['hidedeveloper'], FILTER_SANITIZE_STRING);
	$hidegenre = filter_var($_POST['hidegenre'], FILTER_SANITIZE_STRING);
	$hidereleasedate = filter_var($_POST['hidereleasedate'], FILTER_SANITIZE_STRING);
	$hideseries = filter_var($_POST['hideseries'], FILTER_SANITIZE_STRING);
	$hidecriticrating = filter_var($_POST['hidecriticrating'], FILTER_SANITIZE_STRING);
	$hideigdblink = filter_var($_POST['hideigdblink'], FILTER_SANITIZE_STRING);
	$hideplatforms = filter_var($_POST['hideplatforms'], FILTER_SANITIZE_STRING);
	$hidealtnames = filter_var($_POST['hidealtnames'], FILTER_SANITIZE_STRING);
	$hideamazonreviews = filter_var($_POST['hideamazonreviews'], FILTER_SANITIZE_STRING);
	$hidenotes = filter_var($_POST['hidenotes'], FILTER_SANITIZE_STRING);
	$hidedescription = filter_var($_POST['hidedescription'], FILTER_SANITIZE_STRING);
	$hidesteampurchase = filter_var($_POST['hidesteampurchase'], FILTER_SANITIZE_STRING);
	$hideebaypurchase = filter_var($_POST['hideebaypurchase'], FILTER_SANITIZE_STRING);
	$hidegamestoppurchase = filter_var($_POST['hidegamestoppurchase'], FILTER_SANITIZE_STRING);
	$hidebestbuypurchase = filter_var($_POST['hidebestbuypurchase'], FILTER_SANITIZE_STRING);
	$hideamazonpurchase = filter_var($_POST['hideamazonpurchase'], FILTER_SANITIZE_STRING);
	$hidesimilartitles = filter_var($_POST['hidesimilartitles'], FILTER_SANITIZE_STRING);
	/*
	$hidefrontendbuyimg = filter_var(POST['hidefrontendbuyimg'], FILTER_SANITIZE_STRING);
	$hidefrontendbuyprice = filter_var(POST['hidefrontendbuyprice'], FILTER_SANITIZE_STRING);
	$hidecolorboxbuyimg = filter_var(POST['hidecolorboxbuyimg'], FILTER_SANITIZE_STRING);
	$hidecolorboxbuyprice = filter_var(POST['hidecolorboxbuyprice'], FILTER_SANITIZE_STRING);
	*/
	$sortoption = filter_var($_POST['sortoption'],FILTER_SANITIZE_STRING);
	$gamesonpage = filter_var($_POST['gamesonpage'], FILTER_SANITIZE_NUMBER_INT);
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);

	$settings_array = array(
		'enablepurchase' => $enablepurchase,
		'hidetitlelibrary' => $hidetitlelibrary,
		'hidetitlegame' => $hidetitlegame,
		'hidesearch' => $hidesearch,
		'hidesort' => $hidesort,
		'hidestats' => $hidestats,
		'hidequote' => $hidequote,
		'hidestarsgame' => $hidestarsgame,
		'hidestarslibrary' => $hidestarslibrary,
		'hidefacebookshare' => $hidefacebookshare,
		'hidefacebookmessenger' => $hidefacebookmessenger,
		'hidegoogleplus' => $hidegoogleplus,
		'hidepinterest' => $hidepinterest,
		'hideemail' => $hideemail,
		'hidetwitter' => $hidetwitter,
		'hidegamepost' => $hidegamepost,
		'hidegamepage' => $hidegamepage,
		'hidefinished' => $hidefinished,
		'hidecoverimage' => $hidecoverimage,
		'hidepublisher' => $hidepublisher,
		'hidedeveloper' => $hidedeveloper,
		'hidegenre' => $hidegenre,
		'hidereleasedate' => $hidereleasedate,
		'hideseries' => $hideseries,
		'hidecriticrating' => $hidecriticrating,
		'hideigdblink' => $hideigdblink,
		'hideplatforms' => $hideplatforms,
		'hidealtnames' => $hidealtnames,
		'hideamazonreviews' => $hideamazonreviews,
		'hidenotes' => $hidenotes,
		'hidedescription' => $hidedescription,
		'hidesteampurchase' => $hidesteampurchase,
		'hideebaypurchase' => $hideebaypurchase,
		'hidegamestoppurchase' => $hidegamestoppurchase,
		'hidebestbuypurchase' => $hidebestbuypurchase,
		'hideamazonpurchase' => $hideamazonpurchase,
		'hidesimilartitles' => $hidesimilartitles,
		/*
		'hidefrontendbuyimg' => $hidefrontendbuyimg,
		'hidefrontendbuyprice' => $hidefrontendbuyprice,
		'hidecolorboxbuyimg' => $hidecolorboxbuyimg,
		'hidecolorboxbuyprice' => $hidecolorboxbuyprice,
		*/
		'sortoption' => $sortoption,
		'gamesonpage' => $gamesonpage
	);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-display-options.php');
	$settings_class = new WPGameList_Display_Options();
	$settings_class->save_library_settings($library, $settings_array);
	wp_die();
}

// function for saving post display options
function wpgamelist_dashboard_save_post_display_options_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$("#wpgamelist-save-post-backend").click(function(event){

	  		var enablepurchase = $("input[name='enable-purchase-link']" ).prop('checked');
			var hidetitlegame = $("input[name='wpgamelist-input-1']" ).prop('checked');
			var hidequote = $("input[name='wpgamelist-input-31']" ).prop('checked');
			var hidestarsgame = $("input[name='wpgamelist-input-2']" ).prop('checked');
			var hidefacebookshare = $("input[name='wpgamelist-input-3']" ).prop('checked');
			var hidefacebookmessenger = $("input[name='wpgamelist-input-4']" ).prop('checked');
			var hidegoogleplus = $("input[name='wpgamelist-input-6']" ).prop('checked');
			var hidepinterest = $("input[name='wpgamelist-input-7']" ).prop('checked');
			var hideemail = $("input[name='wpgamelist-input-8']" ).prop('checked');
			var hidetwitter = $("input[name='wpgamelist-input-5']" ).prop('checked');
			var hidegamepost = $("input[name='wpgamelist-input-10']" ).prop('checked');
			var hidegamepage = $("input[name='wpgamelist-input-9']" ).prop('checked');
			var hidefinished = $("input[name='wpgamelist-input-11']" ).prop('checked');
			var hidecoverimage = $("input[name='wpgamelist-input-12']" ).prop('checked');
			var hidepublisher = $("input[name='wpgamelist-input-13']" ).prop('checked');
			var hidedeveloper = $("input[name='wpgamelist-input-14']" ).prop('checked');
			var hidegenre = $("input[name='wpgamelist-input-15']" ).prop('checked');
			var hidereleasedate = $("input[name='wpgamelist-input-16']" ).prop('checked');
			var hideseries = $("input[name='wpgamelist-input-17']" ).prop('checked');
			var hidecriticrating = $("input[name='wpgamelist-input-18']" ).prop('checked');
			var hideigdblink = $("input[name='wpgamelist-input-19']" ).prop('checked');
			var hideplatforms = $("input[name='wpgamelist-input-20']" ).prop('checked');
			var hidealtnames = $("input[name='wpgamelist-input-21']" ).prop('checked');
			var hideamazonreviews = $("input[name='wpgamelist-input-22']" ).prop('checked');
			var hidenotes = $("input[name='wpgamelist-input-23']" ).prop('checked');
			var hidedescription = $("input[name='wpgamelist-input-24']" ).prop('checked');
			var hidesteampurchase = $("input[name='wpgamelist-input-25']" ).prop('checked');
			var hideebaypurchase = $("input[name='wpgamelist-input-26']" ).prop('checked');
			var hidegamestoppurchase = $("input[name='wpgamelist-input-27']" ).prop('checked');
			var hidebestbuypurchase = $("input[name='wpgamelist-input-28']" ).prop('checked');
			var hideamazonpurchase = $("input[name='wpgamelist-input-29']" ).prop('checked');
			var hidesimilartitles = $("input[name='wpgamelist-input-30']" ).prop('checked');

			/*
			var hidefrontendbuyimg = $("input[name='wpgamelist-input-37']" ).prop('checked');
			var hidefrontendbuyprice = $("input[name='wpgamelist-input-38']" ).prop('checked');
			var hidecolorboxbuyimg = $("input[name='wpgamelist-input-39']" ).prop('checked');
			var hidecolorboxbuyprice  = $("input[name='wpgamelist-input-40']" ).prop('checked');
			*/




		  	var data = {
				'action': 'wpgamelist_dashboard_save_post_display_options_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_dashboard_save_post_display_options_action_callback" ); ?>',
				'enablepurchase' : enablepurchase,
				'hidetitlegame' : hidetitlegame,
				'hidequote' : hidequote,
				'hidestarsgame' : hidestarsgame,
				'hidefacebookshare' : hidefacebookshare,
				'hidefacebookmessenger' : hidefacebookmessenger,
				'hidegoogleplus' : hidegoogleplus,
				'hidepinterest' : hidepinterest,
				'hideemail' : hideemail,
				'hidetwitter' : hidetwitter,
				'hidegamepost' : hidegamepost,
				'hidegamepage' : hidegamepage,
				'hidefinished' : hidefinished,
				'hidecoverimage' : hidecoverimage,
				'hidepublisher' : hidepublisher,
				'hidedeveloper' : hidedeveloper,
				'hidegenre' : hidegenre,
				'hidereleasedate' : hidereleasedate,
				'hideseries' : hideseries,
				'hidecriticrating' : hidecriticrating,
				'hideigdblink' : hideigdblink,
				'hideplatforms' : hideplatforms,
				'hidealtnames' : hidealtnames,
				'hideamazonreviews' : hideamazonreviews,
				'hidenotes' : hidenotes,
				'hidedescription' : hidedescription,
				'hidesteampurchase' : hidesteampurchase,
				'hideebaypurchase' : hideebaypurchase,
				'hidegamestoppurchase' : hidegamestoppurchase,
				'hidebestbuypurchase' : hidebestbuypurchase,
				'hideamazonpurchase' : hideamazonpurchase,
				'hidesimilartitles' : hidesimilartitles,
				/*
				'hidefrontendbuyimg' : hidefrontendbuyimg,
				'hidefrontendbuyprice' : hidefrontendbuyprice,
				'hidecolorboxbuyimg' : hidecolorboxbuyimg,
				'hidecolorboxbuyprice' : hidecolorboxbuyprice,
				*/
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload(true);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for saving post display options
function wpgamelist_dashboard_save_post_display_options_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_dashboard_save_post_display_options_action_callback', 'security' );

	$enablepurchase = filter_var($_POST['enablepurchase'],FILTER_SANITIZE_STRING);
	$hidetitlegame = filter_var($_POST['hidetitlegame'], FILTER_SANITIZE_STRING);
	$hidequote = filter_var($_POST['hidequote'], FILTER_SANITIZE_STRING);
	$hidestarsgame = filter_var($_POST['hidestarsgame'], FILTER_SANITIZE_STRING);
	$hidefacebookshare = filter_var($_POST['hidefacebookshare'], FILTER_SANITIZE_STRING);
	$hidefacebookmessenger = filter_var($_POST['hidefacebookmessenger'], FILTER_SANITIZE_STRING);
	$hidegoogleplus = filter_var($_POST['hidegoogleplus'], FILTER_SANITIZE_STRING);
	$hidepinterest = filter_var($_POST['hidepinterest'], FILTER_SANITIZE_STRING);
	$hideemail = filter_var($_POST['hideemail'], FILTER_SANITIZE_STRING);
	$hidetwitter = filter_var($_POST['hidetwitter'], FILTER_SANITIZE_STRING);
	$hidegamepost = filter_var($_POST['hidegamepost'], FILTER_SANITIZE_STRING);
	$hidegamepage = filter_var($_POST['hidegamepage'], FILTER_SANITIZE_STRING);
	$hidefinished = filter_var($_POST['hidefinished'], FILTER_SANITIZE_STRING);
	$hidecoverimage = filter_var($_POST['hidecoverimage'], FILTER_SANITIZE_STRING);
	$hidepublisher = filter_var($_POST['hidepublisher'], FILTER_SANITIZE_STRING);
	$hidedeveloper = filter_var($_POST['hidedeveloper'], FILTER_SANITIZE_STRING);
	$hidegenre = filter_var($_POST['hidegenre'], FILTER_SANITIZE_STRING);
	$hidereleasedate = filter_var($_POST['hidereleasedate'], FILTER_SANITIZE_STRING);
	$hideseries = filter_var($_POST['hideseries'], FILTER_SANITIZE_STRING);
	$hidecriticrating = filter_var($_POST['hidecriticrating'], FILTER_SANITIZE_STRING);
	$hideigdblink = filter_var($_POST['hideigdblink'], FILTER_SANITIZE_STRING);
	$hideplatforms = filter_var($_POST['hideplatforms'], FILTER_SANITIZE_STRING);
	$hidealtnames = filter_var($_POST['hidealtnames'], FILTER_SANITIZE_STRING);
	$hideamazonreviews = filter_var($_POST['hideamazonreviews'], FILTER_SANITIZE_STRING);
	$hidenotes = filter_var($_POST['hidenotes'], FILTER_SANITIZE_STRING);
	$hidedescription = filter_var($_POST['hidedescription'], FILTER_SANITIZE_STRING);
	$hidesteampurchase = filter_var($_POST['hidesteampurchase'], FILTER_SANITIZE_STRING);
	$hideebaypurchase = filter_var($_POST['hideebaypurchase'], FILTER_SANITIZE_STRING);
	$hidegamestoppurchase = filter_var($_POST['hidegamestoppurchase'], FILTER_SANITIZE_STRING);
	$hidebestbuypurchase = filter_var($_POST['hidebestbuypurchase'], FILTER_SANITIZE_STRING);
	$hideamazonpurchase = filter_var($_POST['hideamazonpurchase'], FILTER_SANITIZE_STRING);
	$hidesimilartitles = filter_var($_POST['hidesimilartitles'], FILTER_SANITIZE_STRING);
	/*
	$hidefrontendbuyimg = filter_var(POST['hidefrontendbuyimg'], FILTER_SANITIZE_STRING);
	$hidefrontendbuyprice = filter_var(POST['hidefrontendbuyprice'], FILTER_SANITIZE_STRING);
	$hidecolorboxbuyimg = filter_var(POST['hidecolorboxbuyimg'], FILTER_SANITIZE_STRING);
	$hidecolorboxbuyprice = filter_var(POST['hidecolorboxbuyprice'], FILTER_SANITIZE_STRING);
	*/

	$settings_array = array(
		'enablepurchase' => $enablepurchase,
		'hidetitlegame' => $hidetitlegame,
		'hidestarsgame' => $hidestarsgame,
		'hidefacebookshare' => $hidefacebookshare,
		'hidefacebookmessenger' => $hidefacebookmessenger,
		'hidegoogleplus' => $hidegoogleplus,
		'hidepinterest' => $hidepinterest,
		'hideemail' => $hideemail,
		'hidetwitter' => $hidetwitter,
		'hidegamepost' => $hidegamepost,
		'hidegamepage' => $hidegamepage,
		'hidefinished' => $hidefinished,
		'hidecoverimage' => $hidecoverimage,
		'hidepublisher' => $hidepublisher,
		'hidedeveloper' => $hidedeveloper,
		'hidegenre' => $hidegenre,
		'hidereleasedate' => $hidereleasedate,
		'hideseries' => $hideseries,
		'hidecriticrating' => $hidecriticrating,
		'hideigdblink' => $hideigdblink,
		'hideplatforms' => $hideplatforms,
		'hidealtnames' => $hidealtnames,
		'hideamazonreviews' => $hideamazonreviews,
		'hidenotes' => $hidenotes,
		'hidequote' => $hidequote,
		'hidedescription' => $hidedescription,
		'hidesteampurchase' => $hidesteampurchase,
		'hideebaypurchase' => $hideebaypurchase,
		'hidegamestoppurchase' => $hidegamestoppurchase,
		'hidebestbuypurchase' => $hidebestbuypurchase,
		'hideamazonpurchase' => $hideamazonpurchase,
		'hidesimilartitles' => $hidesimilartitles,
		/*
		'hidefrontendbuyimg' => $hidefrontendbuyimg,
		'hidefrontendbuyprice' => $hidefrontendbuyprice,
		'hidecolorboxbuyimg' => $hidecolorboxbuyimg,
		'hidecolorboxbuyprice' => $hidecolorboxbuyprice,
		*/
	);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-display-options.php');
	$settings_class = new WPGameList_Display_Options();
	$settings_class->save_post_settings($settings_array);
	wp_die();
}


// function for saving page display options
function wpgamelist_dashboard_save_page_display_options_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$("#wpgamelist-save-page-backend").click(function(event){

	  		var enablepurchase = $("input[name='enable-purchase-link']" ).prop('checked');
			var hidetitlegame = $("input[name='wpgamelist-input-1']" ).prop('checked');
			var hidequote = $("input[name='wpgamelist-input-31']" ).prop('checked');
			var hidestarsgame = $("input[name='wpgamelist-input-2']" ).prop('checked');
			var hidefacebookshare = $("input[name='wpgamelist-input-3']" ).prop('checked');
			var hidefacebookmessenger = $("input[name='wpgamelist-input-4']" ).prop('checked');
			var hidegoogleplus = $("input[name='wpgamelist-input-6']" ).prop('checked');
			var hidepinterest = $("input[name='wpgamelist-input-7']" ).prop('checked');
			var hideemail = $("input[name='wpgamelist-input-8']" ).prop('checked');
			var hidetwitter = $("input[name='wpgamelist-input-5']" ).prop('checked');
			var hidegamepost = $("input[name='wpgamelist-input-10']" ).prop('checked');
			var hidegamepage = $("input[name='wpgamelist-input-9']" ).prop('checked');
			var hidefinished = $("input[name='wpgamelist-input-11']" ).prop('checked');
			var hidecoverimage = $("input[name='wpgamelist-input-12']" ).prop('checked');
			var hidepublisher = $("input[name='wpgamelist-input-13']" ).prop('checked');
			var hidedeveloper = $("input[name='wpgamelist-input-14']" ).prop('checked');
			var hidegenre = $("input[name='wpgamelist-input-15']" ).prop('checked');
			var hidereleasedate = $("input[name='wpgamelist-input-16']" ).prop('checked');
			var hideseries = $("input[name='wpgamelist-input-17']" ).prop('checked');
			var hidecriticrating = $("input[name='wpgamelist-input-18']" ).prop('checked');
			var hideigdblink = $("input[name='wpgamelist-input-19']" ).prop('checked');
			var hideplatforms = $("input[name='wpgamelist-input-20']" ).prop('checked');
			var hidealtnames = $("input[name='wpgamelist-input-21']" ).prop('checked');
			var hideamazonreviews = $("input[name='wpgamelist-input-22']" ).prop('checked');
			var hidenotes = $("input[name='wpgamelist-input-23']" ).prop('checked');
			var hidedescription = $("input[name='wpgamelist-input-24']" ).prop('checked');
			var hidesteampurchase = $("input[name='wpgamelist-input-25']" ).prop('checked');
			var hideebaypurchase = $("input[name='wpgamelist-input-26']" ).prop('checked');
			var hidegamestoppurchase = $("input[name='wpgamelist-input-27']" ).prop('checked');
			var hidebestbuypurchase = $("input[name='wpgamelist-input-28']" ).prop('checked');
			var hideamazonpurchase = $("input[name='wpgamelist-input-29']" ).prop('checked');
			var hidesimilartitles = $("input[name='wpgamelist-input-30']" ).prop('checked');

			/*
			var hidefrontendbuyimg = $("input[name='wpgamelist-input-37']" ).prop('checked');
			var hidefrontendbuyprice = $("input[name='wpgamelist-input-38']" ).prop('checked');
			var hidecolorboxbuyimg = $("input[name='wpgamelist-input-39']" ).prop('checked');
			var hidecolorboxbuyprice  = $("input[name='wpgamelist-input-40']" ).prop('checked');
			*/




		  	var data = {
				'action': 'wpgamelist_dashboard_save_page_display_options_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_dashboard_save_page_display_options_action_callback" ); ?>',
				'enablepurchase' : enablepurchase,
				'hidetitlegame' : hidetitlegame,
				'hidequote' : hidequote,
				'hidestarsgame' : hidestarsgame,
				'hidefacebookshare' : hidefacebookshare,
				'hidefacebookmessenger' : hidefacebookmessenger,
				'hidegoogleplus' : hidegoogleplus,
				'hidepinterest' : hidepinterest,
				'hideemail' : hideemail,
				'hidetwitter' : hidetwitter,
				'hidegamepost' : hidegamepost,
				'hidegamepage' : hidegamepage,
				'hidefinished' : hidefinished,
				'hidecoverimage' : hidecoverimage,
				'hidepublisher' : hidepublisher,
				'hidedeveloper' : hidedeveloper,
				'hidegenre' : hidegenre,
				'hidereleasedate' : hidereleasedate,
				'hideseries' : hideseries,
				'hidecriticrating' : hidecriticrating,
				'hideigdblink' : hideigdblink,
				'hideplatforms' : hideplatforms,
				'hidealtnames' : hidealtnames,
				'hideamazonreviews' : hideamazonreviews,
				'hidenotes' : hidenotes,
				'hidedescription' : hidedescription,
				'hidesteampurchase' : hidesteampurchase,
				'hideebaypurchase' : hideebaypurchase,
				'hidegamestoppurchase' : hidegamestoppurchase,
				'hidebestbuypurchase' : hidebestbuypurchase,
				'hideamazonpurchase' : hideamazonpurchase,
				'hidesimilartitles' : hidesimilartitles,
				/*
				'hidefrontendbuyimg' : hidefrontendbuyimg,
				'hidefrontendbuyprice' : hidefrontendbuyprice,
				'hidecolorboxbuyimg' : hidecolorboxbuyimg,
				'hidecolorboxbuyprice' : hidecolorboxbuyprice,
				*/
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload(true);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for saving page display options
function wpgamelist_dashboard_save_page_display_options_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_dashboard_save_page_display_options_action_callback', 'security' );

	$enablepurchase = filter_var($_POST['enablepurchase'],FILTER_SANITIZE_STRING);
	$hidetitlegame = filter_var($_POST['hidetitlegame'], FILTER_SANITIZE_STRING);
	$hidequote = filter_var($_POST['hidequote'], FILTER_SANITIZE_STRING);
	$hidestarsgame = filter_var($_POST['hidestarsgame'], FILTER_SANITIZE_STRING);
	$hidefacebookshare = filter_var($_POST['hidefacebookshare'], FILTER_SANITIZE_STRING);
	$hidefacebookmessenger = filter_var($_POST['hidefacebookmessenger'], FILTER_SANITIZE_STRING);
	$hidegoogleplus = filter_var($_POST['hidegoogleplus'], FILTER_SANITIZE_STRING);
	$hidepinterest = filter_var($_POST['hidepinterest'], FILTER_SANITIZE_STRING);
	$hideemail = filter_var($_POST['hideemail'], FILTER_SANITIZE_STRING);
	$hidetwitter = filter_var($_POST['hidetwitter'], FILTER_SANITIZE_STRING);
	$hidegamepost = filter_var($_POST['hidegamepost'], FILTER_SANITIZE_STRING);
	$hidegamepage = filter_var($_POST['hidegamepage'], FILTER_SANITIZE_STRING);
	$hidefinished = filter_var($_POST['hidefinished'], FILTER_SANITIZE_STRING);
	$hidecoverimage = filter_var($_POST['hidecoverimage'], FILTER_SANITIZE_STRING);
	$hidepublisher = filter_var($_POST['hidepublisher'], FILTER_SANITIZE_STRING);
	$hidedeveloper = filter_var($_POST['hidedeveloper'], FILTER_SANITIZE_STRING);
	$hidegenre = filter_var($_POST['hidegenre'], FILTER_SANITIZE_STRING);
	$hidereleasedate = filter_var($_POST['hidereleasedate'], FILTER_SANITIZE_STRING);
	$hideseries = filter_var($_POST['hideseries'], FILTER_SANITIZE_STRING);
	$hidecriticrating = filter_var($_POST['hidecriticrating'], FILTER_SANITIZE_STRING);
	$hideigdblink = filter_var($_POST['hideigdblink'], FILTER_SANITIZE_STRING);
	$hideplatforms = filter_var($_POST['hideplatforms'], FILTER_SANITIZE_STRING);
	$hidealtnames = filter_var($_POST['hidealtnames'], FILTER_SANITIZE_STRING);
	$hideamazonreviews = filter_var($_POST['hideamazonreviews'], FILTER_SANITIZE_STRING);
	$hidenotes = filter_var($_POST['hidenotes'], FILTER_SANITIZE_STRING);
	$hidedescription = filter_var($_POST['hidedescription'], FILTER_SANITIZE_STRING);
	$hidesteampurchase = filter_var($_POST['hidesteampurchase'], FILTER_SANITIZE_STRING);
	$hideebaypurchase = filter_var($_POST['hideebaypurchase'], FILTER_SANITIZE_STRING);
	$hidegamestoppurchase = filter_var($_POST['hidegamestoppurchase'], FILTER_SANITIZE_STRING);
	$hidebestbuypurchase = filter_var($_POST['hidebestbuypurchase'], FILTER_SANITIZE_STRING);
	$hideamazonpurchase = filter_var($_POST['hideamazonpurchase'], FILTER_SANITIZE_STRING);
	$hidesimilartitles = filter_var($_POST['hidesimilartitles'], FILTER_SANITIZE_STRING);
	/*
	$hidefrontendbuyimg = filter_var(POST['hidefrontendbuyimg'], FILTER_SANITIZE_STRING);
	$hidefrontendbuyprice = filter_var(POST['hidefrontendbuyprice'], FILTER_SANITIZE_STRING);
	$hidecolorboxbuyimg = filter_var(POST['hidecolorboxbuyimg'], FILTER_SANITIZE_STRING);
	$hidecolorboxbuyprice = filter_var(POST['hidecolorboxbuyprice'], FILTER_SANITIZE_STRING);
	*/

	$settings_array = array(
		'enablepurchase' => $enablepurchase,
		'hidetitlegame' => $hidetitlegame,
		'hidestarsgame' => $hidestarsgame,
		'hidefacebookshare' => $hidefacebookshare,
		'hidefacebookmessenger' => $hidefacebookmessenger,
		'hidegoogleplus' => $hidegoogleplus,
		'hidepinterest' => $hidepinterest,
		'hideemail' => $hideemail,
		'hidetwitter' => $hidetwitter,
		'hidegamepost' => $hidegamepost,
		'hidegamepage' => $hidegamepage,
		'hidefinished' => $hidefinished,
		'hidecoverimage' => $hidecoverimage,
		'hidepublisher' => $hidepublisher,
		'hidedeveloper' => $hidedeveloper,
		'hidegenre' => $hidegenre,
		'hidereleasedate' => $hidereleasedate,
		'hideseries' => $hideseries,
		'hidecriticrating' => $hidecriticrating,
		'hideigdblink' => $hideigdblink,
		'hideplatforms' => $hideplatforms,
		'hidealtnames' => $hidealtnames,
		'hideamazonreviews' => $hideamazonreviews,
		'hidenotes' => $hidenotes,
		'hidequote' => $hidequote,
		'hidedescription' => $hidedescription,
		'hidesteampurchase' => $hidesteampurchase,
		'hideebaypurchase' => $hideebaypurchase,
		'hidegamestoppurchase' => $hidegamestoppurchase,
		'hidebestbuypurchase' => $hidebestbuypurchase,
		'hideamazonpurchase' => $hideamazonpurchase,
		'hidesimilartitles' => $hidesimilartitles,
		/*
		'hidefrontendbuyimg' => $hidefrontendbuyimg,
		'hidefrontendbuyprice' => $hidefrontendbuyprice,
		'hidecolorboxbuyimg' => $hidecolorboxbuyimg,
		'hidecolorboxbuyprice' => $hidecolorboxbuyprice,
		*/
	);
	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-display-options.php');
	$settings_class = new WPGameList_Display_Options();
	$settings_class->save_page_settings($settings_array);
	wp_die();
}

function wpgamelist_update_display_options_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$("#wpgamelist-library-settings-select").on('change', function(event){

	  		var optionsTable = $('#wpgamelist-jre-backend-options-table');
	  		var lowerTable = $('#wpgamelist-library-options-lower-table');
	  		var lowerTableInput = $('#wpgamelist-library-options-lower-table input');
	  		var optionsTableInput = $('#wpgamelist-jre-backend-options-table input');
	  		var spinner = $('#wpgamelist-spinner-2');
	  		var library = $('#wpgamelist-library-settings-select').val();
	  		var saveChanges = $('#wpgamelist-save-backend');
	  		spinner.animate({'opacity':'1'}, 200);
	  		optionsTable.animate({'opacity':'0.3'}, 500);
	  		lowerTable.animate({'opacity':'0.3'}, 500);
	  		lowerTable.animate({'opacity':'0.3'}, 500);
	  		saveChanges.animate({'opacity':'0.3'}, 500);
	  		saveChanges.attr('disabled', true);
	  		lowerTableInput.attr('disabled', true);

	  		var settingsArray = {
				'enablepurchase' : 'enable-purchase-link',
				'hidesearch' : 'hide-search',
				'hidefacebook' : 'hide-facebook',
				'hidetwitter' : 'hide-twitter',
				'hidegoogleplus' : 'hide-googleplus',
				'hidemessenger' : 'hide-messenger',
				'hidepinterest' : 'hide-pinterest',
				'hideemail' : 'hide-email',
				'hidestats' : 'hide-stats',
				'hidefilter' : 'hide-filter',
				'hidegoodreadswidget' : 'hide-goodreads',
				'hideamazonreview' : 'hide-amazon-review',
				'hidedescription' : 'hide-description',
				'hidesimilar' : 'hide-similar',
				'hidegametitle' : 'hide-game-title',
				'hidegameimage'  : 'hide-game-image',
				'hidefinished' : 'hide-finished',
				'hidelibrarytitle' : 'hide-library-title',
				'hideauthor' : 'hide-author',
				'hidecategory' : 'hide-category',
				'hidepages' : 'hide-pages',
				'hidegamepage' : 'hide-game-page',
				'hidegamepost' : 'hide-game-post',
				'hidepublisher' : 'hide-publisher',
				'hidepubdate' : 'hide-pub-date',
				'hidesigned' : 'hide-signed',
				'hidesubject' : 'hide-subject',
				'hidecountry' : 'hide-country',
				'hidefinishedsort' : 'hide-finished-sort',
				'hidesignedsort' : 'hide-signed-sort',
				'hidefirstsort' : 'hide-first-sort',
				'hidesubjectsort' : 'hide-subject-sort',
				'hidefirstedition' : 'hide-first-edition',
				'hidefeaturedtitles' : 'hide-featured-titles',
				'hidenotes' : 'hide-notes',
				'hidebottompurchase' : 'hide-bottom-purchase',
				'hidequotegame' : 'hide-quote-game',
				'hidequote' : 'hide-quote',
				'hideratinggame' : 'hide-rating-game',
				'hiderating' : 'hide-rating',
				'hidegooglepurchase' : 'hide-google-purchase',
				'hideamazonpurchase' : 'hide-amazon-purchase',
				'hidebnpurchase' : 'hide-bn-purchase',
				'hideitunespurchase' : 'hide-itunes-purchase',
				'hidefrontendbuyimg' : 'hide-frontend-buy-img',
				'hidecolorboxbuyimg' : 'hide-colorbox-buy-img',
				'hidecolorboxbuyprice' : 'hide-colorbox-buy-price',
				'hidefrontendbuyprice' : 'hide-frontend-buy-price',
				'hidekindleprev' : 'hide-frontend-kindle-preview',
				'hidegoogleprev' : 'hide-frontend-google-preview',
				'hidebampurchase' : 'hide-bam-purchase',
				'hidekobopurchase' : 'hide-kobo-purchase',
				'sortoption' : 'sortoption',
				'gamesonpage' : 'gamesonpage',
				'library': 'library',
				'gamesonpage': 'games-per-page'
			};

			console.log(settingsArray);

		  	var data = {
				'action': 'wpgamelist_update_display_options_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_update_display_options_action_callback" ); ?>',
				'library':library
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	response = JSON.parse(response);
			    	console.log(response)
			    	optionsTable.animate({'opacity':'1'}, 500);
			    	lowerTable.animate({'opacity':'1'}, 500);
			    	saveChanges.animate({'opacity':'1'}, 500);
	  				saveChanges.attr('disabled', false);
			    	optionsTableInput.attr('disabled', false);
			    	lowerTableInput.attr('disabled', false);
			    	spinner.animate({'opacity':'0'}, 200);
			    	for (var key in response) {
					  if (response.hasOwnProperty(key)) {
					  	if(response[key] == 1){
					  		var obj = $( "input[name='"+settingsArray[key]+"']" ).prop('checked', true);
					  	}

					  	if(response[key] == 0 || response[key] == null){
					  		var obj = $( "input[name='"+settingsArray[key]+"']" ).prop('checked', false);
					  	}

					  	if(key == 'gamesonpage'){
					  		var obj = $( "input[name='games-per-page']" ).val(response[key]);
					  	}

					  	if(key == 'sortoption'){
					  		var obj = $( "#wpgamelist-jre-sorting-select" ).val(response[key]);
					  	}

					  }
					}
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for saving library display options
function wpgamelist_update_display_options_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_update_display_options_action_callback', 'security' );
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
	$table_name = '';
	if($library == $wpdb->prefix.'wpgamelist_jre_saved_game_log'){
		$table_name = $wpdb->prefix.'wpgamelist_jre_user_options';
	} else {
		$library = explode('_', $library);
		$library = array_pop($library);
		$table_name = $wpdb->prefix.'wpgamelist_jre_settings_'.$library;
	}
	//$var2 = filter_var($_POST['var'],FILTER_SANITIZE_NUMBER_INT);
	$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d", 1));
	echo $jsonData = json_encode($row); 
	wp_die();
}

// Function for showing the Edit Game form
function wpgamelist_edit_game_show_form_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click",".wpgamelist-edit-actions-edit-button", function(event){



	  		// Gather info needed to return game data
	  		var gameId = $(this).attr('data-game-id');
	  		var table = $(this).attr('data-table');
	  		var key = $(this).attr('data-key');

	  		// Clear any edit game forms that may already be in dom
			$('.wpgamelist-edit-form-div').html('');

			// Show spinner
			$('#wpgamelist-spinner-'+key).animate({'opacity':'1'})

		  	var data = {
				'action': 'wpgamelist_edit_game_show_form_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_edit_game_show_form_action_callback" ); ?>',
				'gameId':gameId,
				'table':table
			};

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {

			    	
			    	// Parse out the response
			    	response = response.split('–sep-seperator-sep–');

			    	console.log('This is All the data that was returned from the server for populating the edit fields, after being \'split\'');
			    	console.log(response);

			    	var gameInfo = JSON.parse(response[0]);
			    	console.log(gameInfo)
			    	var editForm = response[1];

			    	console.log('This is the data that was returned from the server for populating the edit fields, after being \'JSON.parsed\'');
			    	console.log(gameInfo);
			    	
			    	// Add the edit game form into dom and show
			    	$('#wpgamelist-edit-form-div-'+key).html(editForm);
			    	$('#wpgamelist-edit-form-div-'+key).animate({'opacity':'1'});
			    	$('#wpgamelist-admin-cancel-button').attr('data-key', key);

			    	// Hide spinner
					$('#wpgamelist-spinner-'+key).animate({'opacity':'0'})

					$('#wpgamelist-add-game-text-input-1').val(gameInfo.title);
					$('#wpgamelist-add-game-text-input-2').val(gameInfo.image);
					$('#wpgamelist-add-game-date-input-1').val(gameInfo.firstreleasedate);
					$('#wpgamelist-add-game-text-input-3').val(gameInfo.platforms);
					$('#wpgamelist-add-game-text-input-4').val(gameInfo.genres);
					$('#wpgamelist-add-game-text-input-5').val(gameInfo.developer);
					$('#wpgamelist-add-game-text-input-6').val(gameInfo.publisher);
					$('#wpgamelist-add-game-text-input-7').val(gameInfo.rating);
					$('#wpgamelist-add-game-text-input-8').val(gameInfo.criticrating);
					$('#wpgamelist-add-game-text-input-9').val(gameInfo.perspective);
					$('#wpgamelist-add-game-text-input-10').val(gameInfo.gamemodes);
					$('#wpgamelist-add-game-text-input-11').val(gameInfo.themes);
					$('#wpgamelist-add-game-text-input-12').val(gameInfo.series);
					$('#wpgamelist-add-game-text-input-13').val(gameInfo.franchise);
					$('#wpgamelist-add-game-text-input-14').val(gameInfo.igdblink);
					$('#wpgamelist-add-game-textarea-input-1').val(gameInfo.summary);
					$('#wpgamelist-add-game-select-input-1').val(gameInfo.esrb);
					$('#wpgamelist-add-game-select-input-2').val(gameInfo.pegi);
					$('#wpgamelist-add-game-select-input-3').val(gameInfo.owned);
					$('#wpgamelist-add-game-select-input-5').val(gameInfo.finished);

					// Hidden values
					$('#wpgamelist-add-game-hidden-text-input-1').val(gameInfo.videos);
					$('#wpgamelist-add-game-hidden-text-input-2').val(gameInfo.websites);
					$('#wpgamelist-add-game-hidden-text-input-3').val(gameInfo.screenshots);
					$('#wpgamelist-add-game-hidden-text-input-4').val(gameInfo.altnames);

			    	// Populate the purchase links/URLs section
			    	$('#wpgamelist-editgame-games-a-million-buy-link').val(gameInfo.bam_link)
			    	$('#wpgamelist-editgame-amazon-buy-link').val(gameInfo.amazon_detail_page)
			    	$('#wpgamelist-editgame-bn-link').val(gameInfo.bn_link)
			    	$('#wpgamelist-editgame-google-play-buy-link').val(gameInfo.google_preview)
			    	$('#wpgamelist-editgame-itunes-link').val(gameInfo.itunes_page)
			    	$('#wpgamelist-editgame-kobo-link').val(gameInfo.kobo_link)

			    	if(gameInfo.gamecondition != 'N/A'){
			    		$('#wpgamelist-add-game-select-input-4').val(gameInfo.gamecondition);
			    	}

			    	if(gameInfo.myrating == 5){
			    		$('#wpgamelist-add-game-select-input-6').val('5 Stars')
			    	}
			    	if(gameInfo.myrating == 4){
			    		$('#wpgamelist-add-game-select-input-6').val('4 Stars')
			    	}
			    	if(gameInfo.myrating == 3){
			    		$('#wpgamelist-add-game-select-input-6').val('3 Stars')
			    	}
			    	if(gameInfo.myrating == 2){
			    		$('#wpgamelist-add-game-select-input-6').val('2 Stars')
			    	}
			    	if(gameInfo.myrating == 1){
			    		$('#wpgamelist-add-game-select-input-6').val('1 Star')
			    	}


			    	if(gameInfo.page != 'false' || gameInfo.page != null || gameInfo.page != undefined){
			    		$('#wpgamelist-add-game-select-input-7').val('Yes');
			    		$('#wpgamelist-add-game-select-input-7').append('<option value="Already Created">Already Created</option>')
			    		$('#wpgamelist-add-game-select-input-7').val('Already Created')
			    		$('#wpgamelist-add-game-select-input-7').attr('disabled', true)
			    	}

			    	if(gameInfo.post != 'false' || gameInfo.post != null || gameInfo.post != undefined){
			    		$('#wpgamelist-add-game-select-input-8').val('Yes');
			    		$('#wpgamelist-add-game-select-input-8').append('<option value="Already Created">Already Created</option>')
			    		$('#wpgamelist-add-game-select-input-8').val('Already Created')
			    		$('#wpgamelist-add-game-select-input-8').attr('disabled', true)
			    		
			    	}

			    	

					var decoded = $('<textarea/>').html(gameInfo.description).text();
					var decoded2 = $('<textarea/>').html(decoded).text();
					decoded2 = decoded2.replace(/\\/g, "");

			    	$('#wpgamelist-editgame-description').val(decoded2);

			    	var decoded = $('<textarea/>').html(gameInfo.notes).text();
					var decoded2 = $('<textarea/>').html(decoded).text();
					decoded2 = decoded2.replace(/\\/g, "");

			    	$('#wpgamelist-editgame-notes').val(decoded2);

			    	if(gameInfo.rating != null && gameInfo.rating != 0){
			    		$('#wpgamelist-editgame-rating').val(gameInfo.rating)
			    	}

			    	$('#wpgamelist-editgame-image').val(gameInfo.image);
			    	$('#wpgamelist-editgame-preview-img').attr('src', gameInfo.image)

			    	$('#wpgamelist-admin-editgame-button').attr('data-game-id', gameId);
			    	$('#wpgamelist-admin-editgame-button').attr('data-game-uid', gameInfo.game_uid);

			    	if(gameInfo.lendable == 'true'){
			    		$('#wpgamelist-addgame-gameswapper-yes').prop('checked', true);
			    	} else {
			    		$('#wpgamelist-addgame-gameswapper-no').prop('checked', true);
			    	}

			    	$('#wpgamelist-gameswapper-copies').val(gameInfo.copies);


			    	if(gameInfo.finished == 'true'){
			    		$('#wpgamelist-editgame-finished-yes').prop('checked', true);

			    		var dateFinished = gameInfo.date_finished.split('-');
			    		dateFinished = dateFinished[2]+'-'+dateFinished[0]+'-'+dateFinished[1];

			    		$('#wpgamelist-editgame-date-finished').val(dateFinished)
			    		$('#wpgamelist-editgame-date-finished').css({'opacity':'1'});
			    	} else {
			    		$('#wpgamelist-editgame-finished-no').prop('checked', true);
			    	}

			    	if(gameInfo.signed == 'true'){
			    		$('#wpgamelist-editgame-signed-yes').prop('checked', true);
			    	} else {
			    		$('#wpgamelist-editgame-signed-no').prop('checked', true);
			    	}

			    	if(gameInfo.first_edition == 'true'){
			    		$('#wpgamelist-editgame-firstedition-yes').prop('checked', true);
			    	} else {
			    		$('#wpgamelist-editgame-firstedition-no').prop('checked', true);
			    	}

			    	// Populate all WooCommerce fields
			    	if(response[2] != 'null'){

			    		var crosssellsids = '';
			    		var crosssellstitles = '';
			    		var upsellsids = '';
			    		var upsellstitles = '';
			    		var cat = '';
			    		var filename = '';

			    		if(response[3] != 'null'){
					    	var storefront = response[3];
					    	// Activate the select2 code if the storefront extension is active
					    	if(storefront == 'true'){
					    		$('.select2-input').select2();
					    	}

					    	// Fill in some Storefront fields
					    	$("#wpgamelist-addgame-sale-author-link").val(gameInfo.purchaselink)
					    	$("#wpgamelist-addgame-price").val(gameInfo.price)
					    	if(gameInfo.woocommerce != '' && gameInfo.woocommerce != null){
					    		$("#wpgamelist-add-game-select-input-9").val('Yes');
					    		$("#wpgamelist-add-game-select-input-9").trigger('change')
					    	}
					    	
					    }

					    if(response[4] != 'null'){
					    	crosssellsids = response[4];
					    }

					    if(response[5] != 'null'){
					    	crosssellstitles = response[5];

					    	crosssellstitles = response[5];
					    	if(crosssellstitles.includes(',')){
					    		var crosssellArray = crosssellstitles.split(',');
					    	} else {
					    		var crosssellArray = crosssellstitles;
					    	}

					    	$("#select2-crosssells").val(crosssellArray).trigger('change');
					    }

					    if(response[6] != 'null'){
					    	upsellsids = response[6];
					    }

					    if(response[7] != 'null'){
					    	upsellstitles = response[7];
					    	if(upsellstitles.includes(',')){
					    		var upsellArray = upsellstitles.split(',');
					    	} else {
					    		var upsellArray = upsellstitles;
					    	}

					    	$("#select2-upsells").val(upsellArray).trigger('change');
				    	}

				    	if(response[8] != 'null'){
					    	cat = response[8];
				    	}

				    	if(response[9] != 'null'){
					    	filename = response[9];
				    	}

			    		var productInfo = JSON.parse(response[2]);
			    		console.log('productInfo');
			    		console.log(productInfo);
			    		// Populate all WooCommerce fields
			    		if(gameInfo.woocommerce != '' && gameInfo.woocommerce != null){
			    			$('#wpgamelist-woocommerce-yes').prop('checked', true);
			    			$('.wpgamelist-woo-row').css({'opacity':'1', 'display':'table-row'})

			    			$('#wpgamelist-add-game-storefront-woo-text-input-1').val(productInfo._regular_price)
			    			$('#wpgamelist-add-game-storefront-woo-text-input-2').val(productInfo._sale_price)
			    			$('#wpgamelist-add-game-storefront-woo-date-input-1').val(productInfo._sale_price_dates_from)
			    			$('#wpgamelist-add-game-storefront-woo-date-input-2').val(productInfo._sale_price_dates_to)
			    			$('#wpgamelist-add-game-storefront-woo-num-input-1').val(productInfo._width)
			    			$('#wpgamelist-add-game-storefront-woo-num-input-2').val(productInfo._height)
			    			$('#wpgamelist-add-game-storefront-woo-num-input-3').val(productInfo._length)
			    			$('#wpgamelist-add-game-storefront-woo-num-input-4').val(productInfo._weight)
			    			$('#wpgamelist-addgame-woo-sku').val(productInfo._sku)
			    			$('#wpgamelist-add-game-storefront-woo-num-input-5').val(productInfo._stock)
			    			$('#wpgamelist-add-game-storefront-woo-textarea-input-1').val(productInfo._purchase_note)
			    			$('#wpgamelist-add-game-storefront-woo-textarea-input-1').val(productInfo._purchase_note)
										    			

			    			$('#wpgamelist-add-game-storefront-woo-select-input-2').val(productInfo._virtual);

			    			$('#wpgamelist-add-game-storefront-woo-select-input-3').val(productInfo._downloadable);

			    			
			    			if(filename != '' && filename != null && filename != undefined){
			    				$('#wpgamelist-storefront-uploaded-files-title').html(filename)
			    			}

			    			if(response[10] != '' && response[10]  != null && response[10]  != undefined){
			    				$('#wpgamelist-storefront-preview-img-1').attr('data-id', response[10]);
			    			}
			    		}
			    	}

			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});

		// If the 'Cancel' button is clicked, reset all UI/Dom elements
		$(document).on("click","#wpgamelist-admin-cancel-button", function(event){

			var key = $(this).attr('data-key');
			var scrollTop = $("#wpgamelist-edit-game-indiv-div-id-"+key).offset().top-50

			// Clear any edit game forms that may already be in dom and hide edit form
			$('.wpgamelist-edit-form-div').animate({'opacity':'0'})
			$('.wpgamelist-edit-game-indiv-div-class').animate({'height':'100'},500)

			$('.wpgamelist-edit-game-indiv-div-class').animate({
			    'height':'100'
			}, {
			    queue: false,
			    duration: 500,
			    complete: function() {
			    	$('.wpgamelist-edit-form-div').html('');
					$('.wpgamelist-edit-game-indiv-div-class').css({'height':'auto'})

					// Scrolls back to the top of the title 
				    if(scrollTop != 0){
				      $('html, body').animate({
				        scrollTop: scrollTop
				      }, 500);
				      scrollTop = 0;
				    }


			    }
			});
		});
	});
	</script>
	<?php
}

// Callback Function for showing the Edit Game form
function wpgamelist_edit_game_show_form_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_edit_game_show_form_action_callback', 'security' );
	$game_id = filter_var($_POST['gameId'],FILTER_SANITIZE_NUMBER_INT);
	$table = filter_var($_POST['table'],FILTER_SANITIZE_STRING);
	$game_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE ID = %d",$game_id));
	$crosssell_ids = '';
	$crosssell_titles = '';
	$upsell_ids = '';
	$upsell_titles = '';
	$product = 'null';
	$image_thumb = array();
	$id = null;
	$image_url["file"] = '';
	$image_url["name"] = '';
	$attachment = array();

	// Get Woocommerce product, if one exists
	// $product = array();
	if($game_data->woocommerce != null){
		//$product = wc_get_product( $game_data->woocommerce );
		$product = get_post_meta($game_data->woocommerce); 

		// Get all downloadable files associated with product
		$df = json_encode(current(unserialize($product["_downloadable_files"][0])));
		$image_url = current(unserialize($product["_downloadable_files"][0]));
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url["file"] ));
		$image_thumb = wp_get_attachment_image_src($attachment[0], 'thumbnail');
		//$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		//$image_url = $attachment[0]

		// Get crosssell IDs and titles
		$cs = unserialize($product["_crosssell_ids"][0]);
		foreach ($cs as $key => $value) {
		    $crosssell_ids = $crosssell_ids.','.$value;
		}

		// Get upsell IDs and titles
		$us = unserialize($product["_upsell_ids"][0]);
		foreach ($us as $key => $value) {
		    $upsell_ids = $upsell_ids.','.$value;
		}

		// Get product category
		$cat = get_the_terms ( $game_data->woocommerce, 'product_cat' );
		$cat = $cat[0]->name;

		$product = json_encode($product);
	}

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$form = new WPGameList_Game;
	$edit_form = $form->display_edit_game_form();

	// Convert html entites back to normal as needed
	$game_data->title = stripslashes(html_entity_decode($game_data->title, ENT_QUOTES | ENT_XML1, 'UTF-8'));

	// Encode all game data for return trip
	$game_data = json_encode($game_data);

	// Check to see if Storefront extension is active
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(is_plugin_active('wpgamelist-storefront/wpgamelist-storefront.php')){
		$storefront = 'true';
	} else {
		$storefront = 'false';
	}

	echo $game_data.'–sep-seperator-sep–'.$edit_form.'–sep-seperator-sep–'.$product.'–sep-seperator-sep–'.$storefront.'–sep-seperator-sep–'.$crosssell_ids.'–sep-seperator-sep–'.$crosssell_ids.'–sep-seperator-sep–'.$upsell_ids.'–sep-seperator-sep–'.$upsell_ids.'–sep-seperator-sep–'.$cat.'–sep-seperator-sep–'.basename($image_url["file"]).'–sep-seperator-sep–'.$attachment[0];

	wp_die();
}


function wpgamelist_edit_game_pagination_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

  		// Set initial offset in dom
  		$('.wpgamelist-admin-tp-top-title').attr('data-offset', 0);
		
		// Get offset value from wpgamelist.php, convert to int
		var offset = '<?php echo GAMELIST_GAMELIST_EDIT_PAGE_OFFSET; ?>';
		offset = parseInt(offset);


		$(document).on("click","#wpgamelist-edit-next-100, #wpgamelist-edit-previous-100", function(event){

			// Grabbing library
			var library =  $("#wpgamelist-editgame-select-library").val();

			// Grabbing offset from dom
			var currentOffset = parseInt($('.wpgamelist-admin-tp-top-title').attr('data-offset'));

			// Grabbing total number of games in library
			var limit = parseInt($(this).attr('data-limit'));

			// Ensuring we don't go backwards if we're already on the first set results
			if($(this).attr('id') == 'wpgamelist-edit-previous-100'){
				var direction = 'back';
			} else {
				var direction = 'forward';
			}

			// Ensuring we don't go backwards if we're already on the first set results
			if(direction == 'back' &&  (currentOffset-offset) < 0){
				console.log('returnback');
				return;
			}

			// Ensuring we don't go over the total # of games in library
			if(direction == 'forward' &&  (currentOffset+offset) > limit){
				console.log('returnforward');
				return;
			}

			// Initial UI Stuff
			$('.wpgamelist-edit-game-indiv-div-class').animate({'opacity':'0.3'}, 500);
			$('#wpgamelist-spinner-pagination').animate({'opacity':'1'},500);

			if(direction == 'forward'){
				currentOffset = currentOffset+offset;
				$('.wpgamelist-admin-tp-top-title').attr('data-offset', currentOffset);
			} else {
				currentOffset = currentOffset-offset;
				$('.wpgamelist-admin-tp-top-title').attr('data-offset', currentOffset);
			}

			var data = {
				'action': 'wpgamelist_edit_game_pagination_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_edit_game_pagination_action_callback" ); ?>',
				'currentOffset':currentOffset,
				'library':library
			};

			var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data: data,
			    timeout: 0,
			    success: function(response) {

			    	response = response.split('_Separator_');

			    	// Resetting iniail UI stuff
			    	$('.wpgamelist-edit-game-indiv-div-class').animate({'opacity':'1'}, 500);
					$('#wpgamelist-spinner-pagination').animate({'opacity':'0'},500);

			    	// Clear existing games and replace with the response
			    	$('.wpgamelist-admin-tp-inner-container').html('');
			    	$('.wpgamelist-admin-tp-inner-container').html(response[0]);

			    	// Resetting table drop-down
			    	$("#wpgamelist-editgame-select-library").val(response[1]);

			    	if(direction == 'back' &&  (currentOffset-offset) < 0){
						$('#wpgamelist-edit-previous-100').css({'pointer-events':'none', 'opacity':'0.3'});
					} else {
						$('#wpgamelist-edit-previous-100').css({'pointer-events':'all', 'opacity':'1'});
					}

					if(direction == 'forward' &&  (currentOffset+offset) > limit){
						$('#wpgamelist-edit-next-100').css({'pointer-events':'none', 'opacity':'0.3'});
					} else {
						$('#wpgamelist-edit-next-100').css({'pointer-events':'all', 'opacity':'1'});
					}

					$('html, body').animate({
				        scrollTop: $("#wpgamelist-bulk-edit-mode-on-button").offset().top-100
				    }, 1000);
			    }

			});
		});
	});
	</script>
	<?php
}

// Callback function for the Edit Game pagination 
function wpgamelist_edit_game_pagination_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_edit_game_pagination_action_callback', 'security' );
	$currentOffset = filter_var($_POST['currentOffset'],FILTER_SANITIZE_NUMBER_INT);
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-edit-game-form.php');
	$form = new WPGameList_Edit_Game_Form;
	echo $form->output_edit_game_form($library, $currentOffset).'_Separator_'.$library;
	wp_die();
}

// Function for switching libraries on the Edit Game tab
function wpgamelist_edit_game_switch_lib_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("change","#wpgamelist-editgame-select-library", function(event){

  			var library =  $("#wpgamelist-editgame-select-library").val();

  			if(window.location.href.includes('library=') && window.location.href.includes('tab=') && window.location.href.includes('WPGameList')){
  				var newUrl = (window.location.href.substr(0, window.location.href.lastIndexOf("&")))+'&library='+library;
  			} else {
  				var newUrl = window.location.href+'&library='+library;
  			}

  			window.history.pushState(null,null,newUrl);

  			// Reset offset
  			$('.wpgamelist-admin-tp-top-title').attr('data-offset', 0);

  			// Initial UI Stuff
  			$('#wpgamelist-search-results-info').css({'opacity':'0'});
  			$('.wpgamelist-edit-game-indiv-div-class').animate({'opacity':'0.3'}, 500);
			$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'},500);

		  	var data = {
				'action': 'wpgamelist_edit_game_switch_lib_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_edit_game_switch_lib_action_callback" ); ?>',
				'library':library
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {

			    	response = response.split('_Separator_');
			    	$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'},500);

			    	// Clear existing games and replace with the response
			    	$('.wpgamelist-admin-tp-inner-container').html('');
			    	$('.wpgamelist-admin-tp-inner-container').html(response[0]);
			    	$("#wpgamelist-editgame-select-library").val(response[1]);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback Function for switching libraries on the Edit Game tab
function wpgamelist_edit_game_switch_lib_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_edit_game_switch_lib_action_callback', 'security' );
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-edit-game-form.php');
	$form = new WPGameList_Edit_Game_Form;
	echo $form->output_edit_game_form($library, 0).'_Separator_'.$library;

	wp_die();
}

// Function for searching for a title to edit
function wpgamelist_edit_game_search_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$(document).on('click', "#wpgamelist-edit-game-search-button", function(event){

	  		// Initial UI Stuff
	  		$('#wpgamelist-search-results-info').css({'opacity':'0'});
  			$('.wpgamelist-edit-game-indiv-div-class').animate({'opacity':'0.3'}, 500);
			$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'},500);

	  		var searchTerm = $('#wpgamelist-edit-game-search-input').val();
	  		var authorCheck = $('#wpgamelist-search-author-checkbox').prop('checked');
	  		var titleCheck = $('#wpgamelist-search-title-checkbox').prop('checked');
	  		var library =  $("#wpgamelist-editgame-select-library").val();

		  	var data = {
				'action': 'wpgamelist_edit_game_search_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_edit_game_search_action_callback" ); ?>',
				'searchTerm':searchTerm,
				'authorCheck':authorCheck,
				'titleCheck':titleCheck,
				'library':library
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	response = response.split('_Separator_');
			    	$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'},500);

			    	// Clear existing games and replace with the response
			    	$('.wpgamelist-admin-tp-inner-container').html('');
			    	$('.wpgamelist-admin-tp-inner-container').html(response[0]);
			    	$("#wpgamelist-editgame-select-library").val(response[1]);

			    	// UI Stuff
			    	var library = $("#wpgamelist-editgame-select-library").children("option:selected").text();
			    	if(library == 'Default Library'){
			    		library = 'Default';
			    	}

			    	if(response[2] == 1 || response[2] == '1'){
			    		var responseText = '<span class="wpgamelist-color-orange-italic">'+response[2]+' Result</span> Found from the '+library+' Library';
			    	} else {
			    		var responseText = '<span class="wpgamelist-color-orange-italic">'+response[2]+' Results</span> Found from the '+library+' Library';
			    	}

			    	$('#wpgamelist-search-results-info').html(responseText);
			    	$('#wpgamelist-search-results-info').css({'opacity':'1'});
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback Function for searching for a title to edit
function wpgamelist_edit_game_search_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_edit_game_search_action_callback', 'security' );
	$search_term = filter_var($_POST['searchTerm'],FILTER_SANITIZE_STRING);
	$author_check = filter_var($_POST['authorCheck'],FILTER_SANITIZE_STRING);
	$title_check = filter_var($_POST['titleCheck'],FILTER_SANITIZE_STRING);
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);

	if($title_check == 'true'){
		$search_mode = 'title';
	}

	if($author_check == 'true'){
		$search_mode = 'author';
	}

	if($author_check == 'true' && $title_check == 'true'){
		$search_mode = 'both';
	}

	if($author_check != 'true' && $title_check != 'true'){
		$search_mode = 'both';
	}

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-edit-game-form.php');
	$form = new WPGameList_Edit_Game_Form;
	echo $form->output_edit_game_form($library, 0, $search_mode, $search_term).'_Separator_'.$library.'_Separator_'.$form->limit;
	wp_die();
}

function wpgamelist_edit_game_actual_action_javascript() { 
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	// Translations
	$trans1 = __('Success!', 'wpgamelist');
	$trans2 = __("You've just edited your game! Remember, to display your library, simply place this shortcode on a page or post:", 'wpgamelist');
	$trans3 = __('Click Here to View Your Edited Game', 'wpgamelist');
	$trans4 = __("Click Here to View This Game's Post", 'wpgamelist');
	$trans5 = __("Click Here to View This Game's Page", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans10 = __("Whoops! Looks like there was an error trying to add your game! Please check the information you provided (especially that ISBN number), and try again.", 'wpgamelist');


	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

  		// For the game cover image upload
		var file_frame;
		var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
		var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

		$(document).on("click","#wpgamelist-editgame-upload_image_button", function(event){
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
			  // Set the post ID to what we want
			  file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
			  // Open frame
			  file_frame.open();
			  return;
			} else {
			  // Set the wp.media post id so the uploader grabs the ID we want when initialised
			  wp.media.model.settings.post.id = set_to_post_id;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			  title: 'Select a image to upload',
			  button: {
			    text: 'Use this image',
			  },
			  multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
			  // We set multiple to false so only get one image from the uploader
			  var attachment = file_frame.state().get('selection').first().toJSON();
			  // Do something with attachment.id and/or attachment.url here
			  $( '#wpgamelist-editgame-image' ).val(attachment.url);
			  $( '#wpgamelist-editgame-preview-img' ).attr('src', attachment.url);
			  // Restore the main post ID
			  wp.media.model.settings.post.id = wp_media_post_id;
			});
			  // Finally, open the modal
			  file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
			wp.media.model.settings.post.id = wp_media_post_id;
		});




  		$(document).on("click","#wpgamelist-admin-editgame-button", function(event){
			var successDiv = $('#wpgamelist-add-game-response-div');
	  		successDiv.html('');
	  		$('#wpgamelist-editgame-signed-first-table').animate({'margin-bottom':'40px'}, 500);
			$('#wpgamelist-success-view-post').animate({'opacity':'0'}, 500);

			event.preventDefault(event);

			var woocommerce = false;
			var woofile = '';

			// Text inputs
			var title = $("#wpgamelist-add-game-text-input-1").val();
			var image = $("#wpgamelist-add-game-text-input-2").val();
			var platforms = $("#wpgamelist-add-game-text-input-3").val();
			var genres = $("#wpgamelist-add-game-text-input-4").val();
			var developer = $("#wpgamelist-add-game-text-input-5").val();
			var publisher = $("#wpgamelist-add-game-text-input-6").val();
			var rating = $("#wpgamelist-add-game-text-input-7").val();
			var criticrating = $("#wpgamelist-add-game-text-input-8").val();
			var perspective = $("#wpgamelist-add-game-text-input-9").val();
			var gamemodes = $("#wpgamelist-add-game-text-input-10").val();
			var themes = $("#wpgamelist-add-game-text-input-11").val();
			var series = $("#wpgamelist-add-game-text-input-12").val();
			var franchise = $("#wpgamelist-add-game-text-input-13").val();
			var igdblink = $("#wpgamelist-add-game-text-input-14").val();

			// Date inputs
			var releasedate = $('#wpgamelist-add-game-date-input-1').val()
			var finishedate = $('#wpgamelist-add-game-date-input-2').val()

			// Select inputs
			var esrb = $('#wpgamelist-add-game-select-input-1').val()
			var pegi = $('#wpgamelist-add-game-select-input-2').val()
			var owned = $('#wpgamelist-add-game-select-input-3').val()
			var gamecondition = $('#wpgamelist-add-game-select-input-4').val()
			var finished = $('#wpgamelist-add-game-select-input-5').val()
			var myrating = $('#wpgamelist-add-game-select-input-6').val()
			var library = $('#wpgamelist-editgame-select-library').val();
			var page = $('#wpgamelist-add-game-select-input-7').val();
			var post = $('#wpgamelist-add-game-select-input-8').val();

			// Textarea inputs
			var summary = $('#wpgamelist-add-game-textarea-input-1').val()
			var notes = $('#wpgamelist-add-game-textarea-input-2').val()

			// Hidden values
			var videos = $('#wpgamelist-add-game-hidden-text-input-1').val();
			var websites = $('#wpgamelist-add-game-hidden-text-input-2').val();
			var screenshots = $('#wpgamelist-add-game-hidden-text-input-3').val();
			var altnames = $('#wpgamelist-add-game-hidden-text-input-4').val();

			// WooCommerce values
			var woocommerce = $("input[name='game-woocommerce-yes']").prop('checked');
			var salePrice = $( "input[name='game-woo-sale-price']" ).val();
			var regularPrice = $( "input[name='game-woo-regular-price']" ).val();
			var stock = $( "input[name='game-woo-stock']" ).val();
			var length = $( "input[name='game-woo-length']" ).val();
			var width = $( "input[name='game-woo-width']" ).val();
			var height = $( "input[name='game-woo-height']" ).val();
			var weight = $( "input[name='game-woo-weight']" ).val();
			var sku = $("#wpgamelist-addgame-woo-sku" ).val();
			var virtual = $("input[name='wpgamelist-woocommerce-vert-yes']").prop('checked');
			var download = $("input[name='wpgamelist-woocommerce-download-yes']").prop('checked');
			var woofile = $('#wpgamelist-storefront-preview-img-1').attr('data-id');
			var salebegin = $('#wpgamelist-addgame-woo-salebegin').val();
			var saleend = $('#wpgamelist-addgame-woo-saleend').val();
			var purchasenote = $('#wpgamelist-addgame-woo-note').val();
			var productcategory = $('#wpgamelist-woocommerce-category-select').val();
			var reviews = $('#wpgamelist-woocommerce-review-yes').prop('checked');
			var upsells = $('#select2-upsells').val();
			var crosssells = $('#select2-crosssells').val();

			var upsellString = '';
			var crosssellString = '';

			// Making checks to see if Storefront extension is active
			if(upsells != undefined){
				for (var i = 0; i < upsells.length; i++) {
					upsellString = upsellString+','+upsells[i];
				};
			}

			if(crosssells != undefined){
				for (var i = 0; i < crosssells.length; i++) {
					crosssellString = crosssellString+','+crosssells[i];
				};
			}

			if(salebegin != undefined && saleend != undefined){
				// Flipping the sale date start
				if(salebegin.indexOf('-')){
					var finishedtemp = salebegin.split('-');
					salebegin = finishedtemp[0]+'-'+finishedtemp[1]+'-'+finishedtemp[2]
				}

				// Flipping the sale date end
				if(saleend.indexOf('-')){
					var finishedtemp = saleend.split('-');
					saleend = finishedtemp[0]+'-'+finishedtemp[1]+'-'+finishedtemp[2]
				}	
			}

			var gameid = $(this).attr('data-game-id');
			var gameuid = $(this).attr('data-game-uid');

			// Show working spinner and hide reveiw message
			$('#wpgamelist-add-game-bottom-instruction-div').animate({'opacity':'0'}, 500);
			$(this).next().animate({'opacity':'1'}, 500);

			var data = {
				'action': 'wpgamelist_edit_game_actual_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_edit_game_actual_action_callback" ); ?>',
				'title':title,
				'image':image,
				'platforms':platforms,
				'genres':genres,
				'developer':developer,
				'publisher':publisher,
				'rating':rating,
				'criticrating':criticrating,
				'perspective':perspective,
				'gamemodes':gamemodes,
				'themes':themes,
				'series':series,
				'franchise':franchise,
				'igdblink':igdblink,
				'releasedate':releasedate,
				'finishedate':finishedate,
				'esrb':esrb,
				'pegi':pegi,
				'owned':owned,
				'gamecondition':gamecondition,
				'finished':finished,
				'myrating':myrating,
				'library':library,
				'summary':summary,
				'notes':notes,
				'videos':videos,
				'websites':websites,
				'screenshots':screenshots,
				'altnames':altnames,
				'woocommerce':woocommerce,
				'saleprice':salePrice,
				'regularprice':regularPrice,
				'stock':stock,
				'length':length,
				'width':width,
				'height':height,
				'weight':weight,
				'sku':sku,
				'virtual':virtual,
				'download':download,
				'woofile':woofile,
				'salebegin':salebegin,
				'saleend':saleend,
				'purchasenote':purchasenote,
				'productcategory':productcategory,
				'reviews':reviews,
				'upsells':upsellString,
				'crosssells':crosssellString,
				'page':page,
				'post':post,
				'gameid':gameid,
				'gameuid':gameuid
			};

			console.log('This is the data that is about to be sent to the server for editing this game');
			console.log(data)

			// Show working spinner
			$('#wpgamelist-spinner-edit-indiv').animate({'opacity':'1'}, 500);
			
	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(response);
			    	response = response.split('sep');

			    	console.log('This is the data that was sent to the server after the POST filters:');
					console.log(JSON.parse(response[8]))
					
			    	if(response[0] == 1){

			    		var editgameSuccess1 = "<p><span id='wpgamelist-add-game-success-span'><?php echo $trans1; ?></span><br/>&nbsp;<?php echo $trans2 ; ?>&nbsp;<span id='wpgamelist-editgame-success-shortcode'>"; 
			    		
			    		if(library == response[7]+'wpgamelist_jre_saved_game_log'){
			    			var shortcode = '[wpgamelist_shortcode]'
			    		} else {
			    			library = library.split('_');
			    			library = library[library.length-1];
			    			var shortcode = '[wpgamelist_shortcode table="'+library+'"]'
			    		}
			    		
			    		var editgameSuccess2 = shortcode+'</span></p><a id="wpgamelist-success-1" class="wpgamelist-show-game-colorbox"><?php echo $trans3; ?></a>';

			    		var editgameSuccess3 = '';

			    		// If game addition was succesful and user chose to create a post
			    		if(response[4] == 'true' && response[3] == 'false'){
			    			var editgameSuccess3 = "<p id='wpgamelist-editgame-success-post-p'><a href='"+response[6]+"'><?php echo $trans4; ?></a></p></div>";
			    			$('#wpgamelist-editgame-signed-first-table').animate({'margin-bottom':'70px'}, 500);
			    			$('#wpgamelist-success-view-post').animate({'opacity':'1'}, 500);
			    		} 

			    		// If game addition was succesful and user chose to create a page
			    		if(response[3] == 'true' && response[4] == 'false'){
			    			var editgameSuccess3 = "<p id='wpgamelist-editgame-success-page-p'><a href='"+response[5]+"'><?php echo $trans5; ?></a></p></div>";
			    			$('#wpgamelist-editgame-signed-first-table').animate({'margin-bottom':'70px'}, 500);
			    			$('#wpgamelist-success-view-page').animate({'opacity':'1'}, 500);
			    		} 

			    		// If game addition was succesful and user chose to create a post and a page
			    		if(response[3] == 'true' && response[4] == 'true'){
			    			var editgameSuccess3 = "<p id='wpgamelist-editgame-success-page-p'><a href='"+response[5]+"'><?php echo $trans5; ?></a></p><p id='wpgamelist-editgame-success-post-p'><a href='"+response[6]+"'><?php echo $trans4; ?></a></p></div>";
			    			$('#wpgamelist-editgame-signed-first-table').animate({'margin-bottom':'100px'}, 500);
			    			$('#wpgamelist-success-view-page').animate({'opacity':'1'}, 500);
			    			$('#wpgamelist-success-view-post').animate({'opacity':'1'}, 500);
			    		} 

			    		// Add response message to DOM
			    		var endMessage = '<div id="wpgamelist-editgame-success-thanks"><?php echo $trans6; ?> <a href="http://wpgamelist.com/index.php/extensions/"><?php echo $trans7; ?></a><br/><br/> <?php echo $trans8; ?> <a id="wpgamelist-editgame-success-review-link" href="https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5" ><?php echo $trans9; ?></a><img id="wpgamelist-smile-icon-1" src="<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png"></div>';
			    		successDiv.html(editgameSuccess1+editgameSuccess2+editgameSuccess3+endMessage);

			    		$('.wpgamelist-spinner').animate({'opacity':'0'}, 500);
			    		$('#wpgamelist-success-1').animate({'opacity':'1'}, 500);
			    		$('#wpgamelist-success-1').attr('data-gameid', response[1]);
			    		$('#wpgamelist-success-1').attr('data-gametable', response[2]);
			    	} else {
			    		$('#wpgamelist-editgame-signed-first-table').animate({'margin-bottom':'65px'}, 500);
			    		$('#wpgamelist-success-1').html('<?php echo $trans10; ?>');
			    		$('.wpgamelist-spinner').animate({'opacity':'0'}, 500);
			    		$('#wpgamelist-success-1').animate({'opacity':'1'}, 500);
			    	}
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					$('#wpgamelist-success-1').html('<?php echo $trans10; ?>');
		    		$('#wpgamelist-spinner-edit-indiv').animate({'opacity':'0'}, 500);
		    		$('#wpgamelist-success-1').animate({'opacity':'1'}, 500);
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
		            // TODO: Log the console errors here
				}
			});

	  	});
	});
	</script>
	<?php
}

// Callback function editing a game
function wpgamelist_edit_game_actual_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_edit_game_actual_action_callback', 'security' );
	$title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
	$image = filter_var($_POST['image'],FILTER_SANITIZE_URL);
	$platforms = filter_var($_POST['platforms'],FILTER_SANITIZE_STRING);
	$genres = filter_var($_POST['genres'],FILTER_SANITIZE_STRING);
	$developer = filter_var($_POST['developer'],FILTER_SANITIZE_STRING);
	$publisher = filter_var($_POST['publisher'],FILTER_SANITIZE_STRING);
	$rating = filter_var($_POST['rating'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$criticrating = filter_var($_POST['criticrating'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$perspective = filter_var($_POST['perspective'],FILTER_SANITIZE_STRING);
	$gamemodes = filter_var($_POST['gamemodes'],FILTER_SANITIZE_STRING);
	$themes = filter_var($_POST['themes'],FILTER_SANITIZE_STRING);
	$series = filter_var($_POST['series'],FILTER_SANITIZE_STRING);
	$franchise = filter_var($_POST['franchise'],FILTER_SANITIZE_STRING);
	$igdblink = filter_var($_POST['igdblink'],FILTER_SANITIZE_URL);
	$releasedate = filter_var($_POST['releasedate'],FILTER_SANITIZE_STRING);
	$finishedate = filter_var($_POST['finishedate'],FILTER_SANITIZE_STRING);
	$esrb = filter_var($_POST['esrb'],FILTER_SANITIZE_STRING);
	$pegi = filter_var($_POST['pegi'],FILTER_SANITIZE_STRING);
	$owned = filter_var($_POST['owned'],FILTER_SANITIZE_STRING);
	$gamecondition = filter_var($_POST['gamecondition'],FILTER_SANITIZE_STRING);
	$finished = filter_var($_POST['finished'],FILTER_SANITIZE_STRING);
	$myrating = filter_var($_POST['myrating'],FILTER_SANITIZE_STRING);
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
	$summary = filter_var($_POST['summary'],FILTER_SANITIZE_STRING);
	$notes = filter_var($_POST['notes'],FILTER_SANITIZE_STRING);
	$videos = filter_var($_POST['videos'],FILTER_SANITIZE_STRING);
	$websites = filter_var($_POST['websites'],FILTER_SANITIZE_STRING);
	$screenshots = filter_var($_POST['screenshots'],FILTER_SANITIZE_STRING);
	$altnames = filter_var($_POST['altnames'],FILTER_SANITIZE_STRING);
	$woocommerce = filter_var($_POST['woocommerce'],FILTER_SANITIZE_STRING);
	$saleprice = filter_var($_POST['saleprice'],FILTER_SANITIZE_STRING);
	$regularprice = filter_var($_POST['regularprice'],FILTER_SANITIZE_STRING);
	$stock = filter_var($_POST['stock'],FILTER_SANITIZE_STRING);
	$length = filter_var($_POST['length'],FILTER_SANITIZE_STRING);
	$width = filter_var($_POST['width'],FILTER_SANITIZE_STRING);
	$height = filter_var($_POST['height'],FILTER_SANITIZE_STRING);
	$weight = filter_var($_POST['weight'],FILTER_SANITIZE_STRING);
	$sku = filter_var($_POST['sku'],FILTER_SANITIZE_STRING);
	$virtual = filter_var($_POST['virtual'],FILTER_SANITIZE_STRING);
	$download = filter_var($_POST['download'],FILTER_SANITIZE_STRING);
	$woofile = filter_var($_POST['woofile'],FILTER_SANITIZE_STRING);
	$salebegin = filter_var($_POST['salebegin'],FILTER_SANITIZE_STRING);
	$saleend = filter_var($_POST['saleend'],FILTER_SANITIZE_STRING);
	$purchasenote = filter_var($_POST['purchasenote'],FILTER_SANITIZE_STRING);
	$productcategory = filter_var($_POST['productcategory'],FILTER_SANITIZE_STRING);
	$reviews = filter_var($_POST['reviews'],FILTER_SANITIZE_STRING);
	$crosssells = filter_var($_POST['crosssells'],FILTER_SANITIZE_STRING);
	$upsells = filter_var($_POST['upsells'],FILTER_SANITIZE_STRING);
	$page = filter_var($_POST['page'],FILTER_SANITIZE_STRING);
	$post = filter_var($_POST['post'],FILTER_SANITIZE_STRING);
	$gameid = filter_var($_POST['gameid'],FILTER_SANITIZE_NUMBER_INT);
	$gameuid = filter_var($_POST['gameuid'],FILTER_SANITIZE_NUMBER_INT);


	$game_array = array(
		'title' => $title,
		'image' => $image,
		'platforms' => $platforms,
		'genres' => $genres,
		'developer' => $developer,
		'publisher' => $publisher,
		'rating' => $rating,
		'criticrating' => $criticrating,
		'perspective' => $perspective,
		'gamemodes' => $gamemodes,
		'themes' => $themes,
		'series' => $series,
		'franchise' => $franchise,
		'igdblink' => $igdblink,
		'releasedate' => $releasedate,
		'finishedate' => $finishedate,
		'esrb' => $esrb,
		'pegi' => $pegi,
		'owned' => $owned,
		'gamecondition' => $gamecondition,
		'finished' => $finished,
		'myrating' => $myrating,
		'library' => $library,
		'summary' => $summary,
		'notes' => $notes,
		'videos' => $videos,
		'websites' => $websites,
		'screenshots' => $screenshots,
		'altnames' => $altnames,
		'woocommerce' => $woocommerce,
		'saleprice' => $saleprice,
		'regularprice' => $regularprice,
		'stock' => $stock,
		'length' => $length,
		'width' => $width,
		'height' => $height,
		'weight' => $weight,
		'sku' => $sku,
		'virtual' => $virtual,
		'download' => $download,
		'woofile' => $woofile,
		'salebegin' => $salebegin,
		'saleend' => $saleend,
		'purchasenote' => $purchasenote,
		'productcategory' => $productcategory,
		'reviews' => $reviews,
		'crosssells' => $crosssells,
		'upsells' => $upsells,
		'page' => $page,
		'post' => $post,
	);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$game_class = new WPGameList_Game('edit', $game_array, null, $gameid);

	$edit_result = $game_class->editgameresult;

	// If game was succesfully edited, and return the page/post results
	if($edit_result == 1){
  		$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $library WHERE ID = %d", $gameid));

  		// Get saved page URL
		$table_name = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';
  		$page_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE game_uid = %s AND type = 'page'" , $row->gameuid));

  		// Get saved post URL
		$table_name = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';
  		$post_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE game_uid = %s AND type = 'post'", $row->gameuid));

  		echo $edit_result.'sep'.$gameid.'sep'.$library.'sep'.$page.'sep'.$post.'sep'.$page_results->post_url.'sep'.$post_results->post_url.'sep'.$wpdb->prefix.'sep'.json_encode($game_array);

  	}

	wp_die();
}

// For deleting a game
function wpgamelist_delete_game_action_javascript() { 

	// Translations
	$trans1 = __('Title was succesfully deleted!', 'wpgamelist');

	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click",".wpgamelist-edit-actions-delete-button", function(event){

  			// UI Stuff
  			var key = $(this).attr('data-key');
  			$('#wpgamelist-spinner-'+key).animate({'opacity':'1'});

  			var deleteString = '';
  			// Grabbing the post and page ID's, if they exist
  			$(this).parent().find('input').each(function(index){
  				if($(this).attr('data-id') != undefined && $(this).attr('data-id') != null){
  					deleteString = deleteString+'-'+$(this).attr('data-id');
  				}
  			});

  			var gameId = $(this).attr('data-game-id');
  			var library = $('#wpgamelist-editgame-select-library').val();

		  	var data = {
				'action': 'wpgamelist_delete_game_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_delete_game_action_callback" ); ?>',
				'deleteString':deleteString,
				'gameId':gameId,
				'library':library

			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	response = response.split('-');
			    	console.log(response);
			    	var resultString = '';
			    	if(response[0] == 1){
			    		resultString = '<span class="wpgamelist-color-orange-italic"><?php echo $trans1 ?></span><img id="wpgamelist-smile-icon-1" src="<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png"><br/>';
			    		$('#wpgamelist-spinner-'+key).animate({'opacity':'0'});

				    	$('#wpgamelist-delete-result-'+key).html(resultString);

				    	setTimeout(function(){
				    		document.location.reload(true);
				    	}, 3000)
			    	}

			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for deleting games 
function wpgamelist_delete_game_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_delete_game_action_callback', 'security' );
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
	$delete_string = filter_var($_POST['deleteString'],FILTER_SANITIZE_STRING);
	$game_id = filter_var($_POST['gameId'],FILTER_SANITIZE_NUMBER_INT);


	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$game_class = new WPGameList_Game;
	$delete_result = $game_class->delete_game($library, $game_id, $delete_string);
	echo $delete_result;
	wp_die();
}

// Function for svings user's API info
function wpgamelist_user_apis_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
	  	$("#wpgamelist-save-api-settings").click(function(event){

	  		var amazonapipublic = $('#wpgamelist-amazon-api-public').val();
	  		var amazonapisecret = $('#wpgamelist-amazon-api-secret').val();
	  		var googleapi = $('#wpgamelist-google-api').val();
	  		var appleapi = $('#wpgamelist-apple-api').val();
	  		var openlibraryapi = $('#wpgamelist-openlibrary-api').val();

		  	var data = {
		  		'amazonapipublic':amazonapipublic,
		  		'amazonapisecret':amazonapisecret,
		  		'googleapi':googleapi,
		  		'appleapi':appleapi,
		  		'openlibraryapi':openlibraryapi,
				'action': 'wpgamelist_user_apis_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_user_apis_action_callback" ); ?>',
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload(true);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for svings user's API info
function wpgamelist_user_apis_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_user_apis_action_callback', 'security' );
	$amazonapipublic = filter_var($_POST['amazonapipublic'],FILTER_SANITIZE_STRING);
	$amazonapisecret = filter_var($_POST['amazonapisecret'],FILTER_SANITIZE_STRING);
	$googleapi = filter_var($_POST['googleapi'],FILTER_SANITIZE_STRING);
	$appleapi = filter_var($_POST['appleapi'],FILTER_SANITIZE_STRING);
	$openlibraryapi = filter_var($_POST['openlibraryapi'],FILTER_SANITIZE_STRING);

	$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
	$data = array(
        'amazonapipublic' => $amazonapipublic, 
        'amazonapisecret' => $amazonapisecret, 
        'googleapi' => $googleapi, 
        'appleapi' => $appleapi, 
        'openlibraryapi' => $openlibraryapi, 
    );
    $format = array( '%s');  
    $where = array( 'ID' => ( 1 ) );
    $where_format = array( '%d' );
    $result = $wpdb->update( $table_name, $data, $where, $format, $where_format );

	echo $result;
	wp_die();
}

// Function for frontend library pagination
function wpgamelist_library_pagination_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click",".wpgamelist-pagination-page-div", function(event){

  			// Grabbing stuff from search area, if any of it is set
  			var searchTitle = $('#wpgamelist-game-title-search').prop('checked');
	  		var searchAuthor = $('#wpgamelist-author-search').prop('checked');
	  		var searchCategory = $('#wpgamelist-cat-search').prop('checked');
	  		var sortSelect = $('#wpgamelist-sort-select-box').val();
	  		var searchTerm = $('#wpgamelist-search-text').val();

	  		// Grabbing stuff from the Filter Area, if any of it is set
	  		var filterAuthor = $('#wpgamelist-filter-author-box').val();
	  		var filterCategory = $('#wpgamelist-filter-category-box').val();
	  		var filterSubject = $('#wpgamelist-filter-subject-box').val();
	  		var filterCountry = $('#wpgamelist-filter-country-box').val();

	  		// Getting the year range stuff
	  		var yearrange1 = $('#wpgamelist-year-range-1').val();
	  		var yearrange2 = $('#wpgamelist-year-range-2').val();
	  		var yearrange3 = $('#wpgamelist-year-range-3').val();
	  		var yearrange4 = $('#wpgamelist-year-range-4').val();

	  		var yearfilter1 = yearrange1+yearrange2;
	  		var yearfilter2 = yearrange3+yearrange4;




  			$('.wpgamelist-top-container').css({'pointer-events':'none'});
  			$('.wpgamelist-top-container').animate({'opacity':'0.3'}, 500);

	  		var page = $(this).attr('data-page');
	  		var perPage = $(this).attr('data-per-page');
	  		var library = $(this).attr('data-library');

		  	var data = {
				'action': 'wpgamelist_library_pagination_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_library_pagination_action_callback" ); ?>',
				'page':page,
				'perPage':perPage,
				'library':library,
				'searchTitle':searchTitle,
				'searchAuthor':searchAuthor,
				'searchCategory':searchCategory,
				'searchTerm':searchTerm,
				'sortSelect':sortSelect,
				'filterAuthor':filterAuthor,
				'filterCategory':filterCategory,
				'filterSubject':filterSubject,
				'filterCountry':filterCountry,
				'yearfilter1':yearfilter1,
				'yearfilter2':yearfilter2

			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	
			    	response = response.split('--seperator--');
			    	$('.wpgamelist-top-container').html(response[0])

			    	// Setting the sort drop-down to the active value
			    	$('#wpgamelist-sort-select-box').val(response[2]);

			    	console.log(response);
			    	var searchType = response[1].split('-');
			    	if(response[2] == '' || response[2] == null){
			    		response[2] = 'Sort By...';
			    	}
			    	if(response[3] == '' || response[3] == null){
			    		response[3] = 'Filter By Authors...';
			    	}
			    	if(response[4] == '' || response[4] == null){
			    		response[4] = 'Filter By Category...';
			    	}
			    	if(response[5] == '' || response[5] == null){
			    		response[5] = 'Filter By Subject...';
			    	}
			    	if(response[6] == '' || response[6] == null){
			    		response[6] = 'Filter By Country...';
			    	}

			    	if(response[7] != '' && response[7] != null){

			    		var year1 = response[7].substring(0, 2);
			    		var year2 = response[7].substring(2, 4);
			    		console.log('in if')
			    		console.log(year1)
			    		console.log(year2)
			    		//$('#wpgamelist-year-range-1').val(year1);
	  					//$('#wpgamelist-year-range-2').val(year2);
			    	}
			    	if(response[8] != '' && response[8] != null){

			    		var year3 = response[8].substring(0, 2);
			    		var year4 = response[8].substring(2, 4);
			    		//$('#wpgamelist-year-range-3').val(year3);
	  					//$('#wpgamelist-year-range-4').val(year4);
			    	}

			    	// set the sort drop-downs to the active value
			    	$('#wpgamelist-sort-select-box').val(response[2]);
			    	$('#wpgamelist-filter-author-box').val(response[3]);
			    	$('#wpgamelist-filter-category-box').val(response[4]);
			    	$('#wpgamelist-filter-subject-box').val(response[5]);
			    	$('#wpgamelist-filter-country-box').val(response[6]);

			    	if (!$('#wpgamelist-filter-author-box option[value="' +response[3]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-author-box').val('Filter By Authors...');
				    } else {
				    	$('#wpgamelist-filter-author-box').val(response[3]);
				    }

				    if (!$('#wpgamelist-filter-category-box option[value="' +response[4]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-category-box').val('Filter By Category...');
				    } else {
				    	$('#wpgamelist-filter-category-box').val(response[4]);
				    }

				    if (!$('#wpgamelist-filter-subject-box option[value="' +response[5]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-subject-box').val('Filter By Subject...');
				    } else {
				    	$('#wpgamelist-filter-subject-box').val(response[5]);
				    }

				    if (!$('#wpgamelist-filter-country-box option[value="' +response[6]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-country-box').val('Filter By Country...');
				    } else {
				    	$('#wpgamelist-filter-country-box').val(response[6]);
				    }

			    	console.log(searchType);

			    	// Re-add the search stuff to the dom
			    	if(searchType.includes('title')){
			    		$('#wpgamelist-game-title-search').prop('checked', true);
			    	}
			    	if(searchType.includes('author')){
			    		$('#wpgamelist-author-search').prop('checked', true);
			    	}
			    	if(searchType.includes('category')){
			    		$('#wpgamelist-cat-search').prop('checked', true);
			    	}
			    	$('#wpgamelist-search-text').val(searchTerm);
			    	$('#wpgamelist-search-sub-button').prop('disabled', false);

			    	// Highlight the pagination
  					$('#wpgamelist-pagination-page-'+page).css({'font-size':'14px', 'font-weight':'bold', 'padding':'4px;'});

  					// Show and enable the UI
			    	$('.wpgamelist-top-container').animate({'opacity':'1'}, 500);
			    	$('.wpgamelist-top-container').css({'pointer-events':'all'});
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for frontend library pagination
function wpgamelist_library_pagination_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_library_pagination_action_callback', 'security' );
	$page = filter_var($_POST['page'],FILTER_SANITIZE_NUMBER_INT);
	$per_page = filter_var($_POST['perPage'],FILTER_SANITIZE_NUMBER_INT);
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);

	// Handling the search area stuff, if anything is present
	$title = filter_var($_POST['searchTitle'],FILTER_SANITIZE_STRING);
	$author = filter_var($_POST['searchAuthor'],FILTER_SANITIZE_STRING);
	$cat = filter_var($_POST['searchCategory'],FILTER_SANITIZE_STRING);
	$searchTerm = filter_var($_POST['searchTerm'],FILTER_SANITIZE_STRING);
	$sortSelect = filter_var($_POST['sortSelect'],FILTER_SANITIZE_STRING);


	// Handling the filter stuff, if anything is present
	$filterAuthor = filter_var($_POST['filterAuthor'],FILTER_SANITIZE_STRING);
	$filterCountry = filter_var($_POST['filterCountry'],FILTER_SANITIZE_STRING);
	$filterSubject = filter_var($_POST['filterSubject'],FILTER_SANITIZE_STRING);
	$filterCategory = filter_var($_POST['filterCategory'],FILTER_SANITIZE_STRING);

	// Getting the year stuff
	$yearfilter1 = filter_var($_POST['yearfilter1'],FILTER_SANITIZE_STRING);
	$yearfilter2 = filter_var($_POST['yearfilter2'],FILTER_SANITIZE_STRING);

	$searchType = '';
	// Build search type string
	if($title == 'true'){
		$searchType = $searchType.'-title';
	}

	if($author == 'true'){
		$searchType = $searchType.'-author';
	}

	if($cat == 'true'){
		$searchType = $searchType.'-category';
	}

	include_once( GAMELIST_GAMELIST_ROOT_INCLUDES_UI . 'class-frontend-library-ui.php');

  	$front_end_library_ui = new WPGameList_Front_End_Library_UI($library ,$searchType, $searchTerm, $sortSelect, null, $filterAuthor, $filterCategory, $filterSubject, $filterCountry, $yearfilter1, $yearfilter2);

  	echo $front_end_library_ui->build_library_actual($page*$per_page).'--seperator--'.$searchType.'--seperator--'.$sortSelect.'--seperator--'.$filterAuthor.'--seperator--'.$filterCategory.'--seperator--'.$filterSubject.'--seperator--'.$filterCountry.'--seperator--'.$yearfilter1.'--seperator--'.$yearfilter2;

	wp_die();
}

function wpgamelist_library_search_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click","#wpgamelist-search-sub-button", function(event){
	  		$('.wpgamelist-top-container').css({'pointer-events':'none'});
  			$('.wpgamelist-top-container').animate({'opacity':'0.3'}, 500);

	  		var searchTitle = $('#wpgamelist-game-title-search').prop('checked');
	  		var searchAuthor = $('#wpgamelist-author-search').prop('checked');
	  		var searchCategory = $('#wpgamelist-cat-search').prop('checked');
	  		var sortSelect = $('#wpgamelist-sort-select-box').val();
	  		var searchTerm = $('#wpgamelist-search-text').val();
	  		var table = $(this).attr('data-table');

		  	var data = {
				'action': 'wpgamelist_library_search_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_library_search_action_callback" ); ?>',
				'searchTitle':searchTitle,
				'searchAuthor':searchAuthor,
				'searchCategory':searchCategory,
				'searchTerm':searchTerm,
				'table':table
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	response = response.split('--seperator--');
			    	$('.wpgamelist-top-container').html(response[0])

			    	var searchType = response[1].split('-');

			    	// Re-add the search stuff to the dom
			    	if(searchType.includes('title')){
			    		$('#wpgamelist-game-title-search').prop('checked', true);
			    	}
			    	if(searchType.includes('author')){
			    		$('#wpgamelist-author-search').prop('checked', true);
			    	}
			    	if(searchType.includes('category')){
			    		$('#wpgamelist-cat-search').prop('checked', true);
			    	}
			    	$('#wpgamelist-search-text').val(searchTerm);
			    	$('#wpgamelist-search-sub-button').prop('disabled', false);

			    	// Highlight the pagination
  					$('.wpgamelist-pagination-page-div').first().css({'font-size':'14px', 'font-weight':'bold', 'padding':'4px;'});

  					// Show and enable the UI
			    	$('.wpgamelist-top-container').animate({'opacity':'1'}, 500);
			    	$('.wpgamelist-top-container').css({'pointer-events':'all'});
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for searching the frontend library
function wpgamelist_library_search_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_library_search_action_callback', 'security' );
	$title = filter_var($_POST['searchTitle'],FILTER_SANITIZE_STRING);
	$author = filter_var($_POST['searchAuthor'],FILTER_SANITIZE_STRING);
	$cat = filter_var($_POST['searchCategory'],FILTER_SANITIZE_STRING);
	$searchTerm = filter_var($_POST['searchTerm'],FILTER_SANITIZE_STRING);
	$library = filter_var($_POST['table'],FILTER_SANITIZE_STRING);

	$searchType = '';

	// Build search type string
	if($title == 'true'){
		$searchType = $searchType.'-title';
	}

	if($author == 'true'){
		$searchType = $searchType.'-author';
	}

	if($cat == 'true'){
		$searchType = $searchType.'-category';
	}

	include_once( GAMELIST_GAMELIST_ROOT_INCLUDES_UI . 'class-frontend-library-ui.php');
  	$front_end_library_ui = new WPGameList_Front_End_Library_UI($library ,$searchType, $searchTerm);
  	echo $front_end_library_ui->build_library_actual(0).'--seperator--'.$searchType;


	wp_die();
}

function wpgamelist_library_sort_select_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("change","#wpgamelist-sort-select-box, #wpgamelist-filter-author-box, #wpgamelist-filter-category-box, #wpgamelist-filter-subject-box, #wpgamelist-filter-country-box, #wpgamelist-year-range-4", function(event){

  			$('.wpgamelist-top-container').css({'pointer-events':'none'});
  			$('.wpgamelist-top-container').animate({'opacity':'0.3'}, 500);

  			var sort = $(this).val();
  			var searchTitle = $('#wpgamelist-game-title-search').prop('checked');
	  		var searchAuthor = $('#wpgamelist-author-search').prop('checked');
	  		var searchCategory = $('#wpgamelist-cat-search').prop('checked');
	  		var sortSelect = $('#wpgamelist-sort-select-box').val();
	  		var searchTerm = $('#wpgamelist-search-text').val();
	  		var table = $('.wpgamelist-table-for-app').html();

	  		var filterAuthor = $('#wpgamelist-filter-author-box').val();
	  		var filterCategory = $('#wpgamelist-filter-category-box').val();
	  		var filterSubject = $('#wpgamelist-filter-subject-box').val();
	  		var filterCountry = $('#wpgamelist-filter-country-box').val();

	  		var yearrange1 = $('#wpgamelist-year-range-1').val();
	  		var yearrange2 = $('#wpgamelist-year-range-2').val();
	  		var yearrange3 = $('#wpgamelist-year-range-3').val();
	  		var yearrange4 = $('#wpgamelist-year-range-4').val();

	  		var yearfilter1 = yearrange1+yearrange2;
	  		var yearfilter2 = yearrange3+yearrange4;


		  	var data = {
				'action': 'wpgamelist_library_sort_select_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_library_sort_select_action_callback" ); ?>',
				'searchTitle':searchTitle,
				'searchAuthor':searchAuthor,
				'searchCategory':searchCategory,
				'searchTerm':searchTerm,
				'table':table,
				'sort':sortSelect,
				'filterAuthor':filterAuthor,
				'filterCategory':filterCategory,
				'filterSubject':filterSubject,
				'filterCountry':filterCountry,
				'yearfilter1':yearfilter1,
				'yearfilter2':yearfilter2
			};

			console.log(data);
			console.log('data');

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	
			    	response = response.split('--seperator--');
			    	$('.wpgamelist-top-container').html(response[0])

			    	console.log(response[1]);
			    	console.log('response3');
			    	console.log(response[3]);
			    	console.log(response[4]);
			    	console.log(response[5]);

			    	console.log(response[7]);
			    	console.log(response[8]);


			    	var searchType = response[1].split('-');
			    	if(response[2] == '' || response[2] == null){
			    		response[2] = 'Sort By...';
			    	}
			    	if(response[3] == '' || response[3] == null){
			    		response[3] = 'Filter By Authors...';
			    	}
			    	if(response[4] == '' || response[4] == null){
			    		response[4] = 'Filter By Category...';
			    	}
			    	if(response[5] == '' || response[5] == null){
			    		response[5] = 'Filter By Subject...';
			    	}
			    	if(response[6] == '' || response[6] == null){
			    		response[6] = 'Filter By Country...';
			    	}

			    	if(response[7] != '' && response[7] != null){

			    		var year1 = response[7].substring(0, 2);
			    		var year2 = response[7].substring(2, 4);
			    		console.log('in if')
			    		console.log(year1)
			    		console.log(year2)
			    		//$('#wpgamelist-year-range-1').val(year1);
	  					//$('#wpgamelist-year-range-2').val(year2);
			    	}
			    	if(response[8] != '' && response[8] != null){

			    		var year3 = response[8].substring(0, 2);
			    		var year4 = response[8].substring(2, 4);
			    		//$('#wpgamelist-year-range-3').val(year3);
	  					//$('#wpgamelist-year-range-4').val(year4);
			    	}


					

			    	// set the sort drop-downs to the active value
			    	$('#wpgamelist-sort-select-box').val(response[2]);
			    	$('#wpgamelist-filter-author-box').val(response[3]);
			    	$('#wpgamelist-filter-category-box').val(response[4]);
			    	$('#wpgamelist-filter-subject-box').val(response[5]);
			    	$('#wpgamelist-filter-country-box').val(response[6]);

			    	if (!$('#wpgamelist-filter-author-box option[value="' +response[3]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-author-box').val('Filter By Authors...');
				    } else {
				    	$('#wpgamelist-filter-author-box').val(response[3]);
				    }

				    if (!$('#wpgamelist-filter-category-box option[value="' +response[4]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-category-box').val('Filter By Category...');
				    } else {
				    	$('#wpgamelist-filter-category-box').val(response[4]);
				    }

				    if (!$('#wpgamelist-filter-subject-box option[value="' +response[5]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-subject-box').val('Filter By Subject...');
				    } else {
				    	$('#wpgamelist-filter-subject-box').val(response[5]);
				    }

				    if (!$('#wpgamelist-filter-country-box option[value="' +response[6]+ '"]').prop("selected", true).length) {
				        $('#wpgamelist-filter-country-box').val('Filter By Country...');
				    } else {
				    	$('#wpgamelist-filter-country-box').val(response[6]);
				    }

			    	console.log(searchType);

			    	// Re-add the search stuff to the dom
			    	if(searchType.includes('title')){
			    		$('#wpgamelist-game-title-search').prop('checked', true);
			    	}
			    	if(searchType.includes('author')){
			    		$('#wpgamelist-author-search').prop('checked', true);
			    	}
			    	if(searchType.includes('category')){
			    		$('#wpgamelist-cat-search').prop('checked', true);
			    	}
			    	$('#wpgamelist-search-text').val(searchTerm);
			    	$('#wpgamelist-search-sub-button').prop('disabled', false);

			    	// Highlight the pagination
  					$('.wpgamelist-pagination-page-div').first().css({'font-size':'14px', 'font-weight':'bold', 'padding':'4px;'});

  					// Add the filter years back to dom
  					var yearone = response[7];
  					var yeartwo = response[8];
  					var yearone1 = yearone.substring(0, 2);
  					var yearone2 = yearone.substring(2, 4);
  					var yeartwo1 = yeartwo.substring(0, 2);
  					var yeartwo2 = yeartwo.substring(2, 4);
  					$('#wpgamelist-year-range-1').val(yearone1);
	  				$('#wpgamelist-year-range-2').val(yearone2);
	  				$('#wpgamelist-year-range-3').val(yeartwo1);
	  				$('#wpgamelist-year-range-4').val(yeartwo2);


  					// Show and enable the UI
			    	$('.wpgamelist-top-container').animate({'opacity':'1'}, 500);
			    	$('.wpgamelist-top-container').css({'pointer-events':'all'});
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_library_sort_select_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_library_sort_select_action_callback', 'security' );
	$title = filter_var($_POST['searchTitle'],FILTER_SANITIZE_STRING);
	$author = filter_var($_POST['searchAuthor'],FILTER_SANITIZE_STRING);
	$cat = filter_var($_POST['searchCategory'],FILTER_SANITIZE_STRING);
	$searchTerm = filter_var($_POST['searchTerm'],FILTER_SANITIZE_STRING);
	$sort = filter_var($_POST['sort'],FILTER_SANITIZE_STRING);
	$filterAuthor = filter_var($_POST['filterAuthor'],FILTER_SANITIZE_STRING);
	$filterCategory = filter_var($_POST['filterCategory'],FILTER_SANITIZE_STRING);
	$filterSubject = filter_var($_POST['filterSubject'],FILTER_SANITIZE_STRING);
	$filterCountry = filter_var($_POST['filterCountry'],FILTER_SANITIZE_STRING);
	$yearfilter1 = filter_var($_POST['yearfilter1'],FILTER_SANITIZE_STRING);
	$yearfilter2 = filter_var($_POST['yearfilter2'],FILTER_SANITIZE_STRING);
	$library = filter_var($_POST['table'],FILTER_SANITIZE_STRING);

	$searchType = '';

	// Build search type string
	if($title == 'true'){
		$searchType = $searchType.'-title';
	}

	if($author == 'true'){
		$searchType = $searchType.'-author';
	}

	if($cat == 'true'){
		$searchType = $searchType.'-category';
	}

	include_once( GAMELIST_GAMELIST_ROOT_INCLUDES_UI . 'class-frontend-library-ui.php');
  	$front_end_library_ui = new WPGameList_Front_End_Library_UI($library ,$searchType, $searchTerm, $sort, null, $filterAuthor, $filterCategory, $filterSubject, $filterCountry, $yearfilter1, $yearfilter2);
  	echo $front_end_library_ui->build_library_actual(0).'--seperator--'.$searchType.'--seperator--'.$sort.'--seperator--'.$filterAuthor.'--seperator--'.$filterCategory.'--seperator--'.$filterSubject.'--seperator--'.$filterCountry.'--seperator--'.$yearfilter1.'--seperator--'.$yearfilter2;
	wp_die();
}

// For uploading a new StylePak after purchase
function wpgamelist_upload_new_stylepak_action_javascript() { 

	// Translations
	$trans1 = __("Success!", 'wpgamelist');
	$trans2 = __("You've added a new StylePak!", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans10 = __("Uh-Oh!", 'wpgamelist');
	$trans11 = __("Looks like there was a problem uploading your StylePak! Are you sure you selected the right file? It should end with either a '.zip' or a '.css' - you could also try unzipping the file", 'wpgamelist');
	$trans12 = __("before", 'wpgamelist');
	$trans13 = __("uploading it", 'wpgamelist');
	

	wp_enqueue_media();
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

		// Enabling the 'Apply StylePak' button when first drop-down is changed
		$(document).on("change","#wpgamelist-select-library-stylepak", function(event){
			$('#wpgamelist-addstylepak-success-div').html('');
			$('#wpgamelist-apply-library-stylepak').prop('disabled', false);
		});

		// For uploading a new StylePak
  		$(document).on("change","#wpgamelist-add-new-library-stylepak", function(event){

  			$('.wpgamelist-spinner').animate({'opacity':'1'});

			var files = event.target.files; // FileList object
		    var theFile = files[0];
		    // Open Our formData Object
		    var formData = new FormData();
		    formData.append('action', 'wpgamelist_upload_new_stylepak_action');
		    formData.append('my_uploaded_file', theFile);
		    var nonce = '<?php echo wp_create_nonce( "wpgamelist_upload_new_stylepak_action_callback" ); ?>';
		    formData.append('security', nonce);

		    // If it's a zip file or a css file, proceed with uploading the file
		    if(theFile.name.includes('.zip') || theFile.name.includes('.css')){
			    jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: formData,
					contentType:false,
					processData:false,
					success: function(response){
						console.log(response);
						response = response.split('sep');
						if(response[2] == 1){
							$('.wpgamelist-spinner').animate({'opacity':'0'});
							$('#wpgamelist-addstylepak-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans1 ?></span><br/><br/><?php echo $trans2 ?><div id='wpgamelist-addstylepak-success-thanks'><?php echo $trans6 ?>&nbsp;<a href='http://wpgamelist.com/index.php/extensions/'><?php echo $trans7 ?></a><br/><br/><?php echo $trans8 ?>&nbsp;<a id='wpgamelist-addgame-success-review-link' href='https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5'><?php echo $trans9 ?></a><img id='wpgamelist-smile-icon-1' src='<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png'></div>");

							$('html, body').animate({
						        scrollTop: $("#wpgamelist-addstylepak-success-div").offset().top-100
						    }, 1000);
						} else {

						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(errorThrown);
					    console.log(textStatus);
					    console.log(jqXHR);
					}	
			    }); 

			} else {
				// If the file isn't a zip or css file...
				$('.wpgamelist-spinner').animate({'opacity':'0'});
				$('#wpgamelist-addstylepak-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans10 ?></span><br/><br/><?php echo $trans11 ?> <em><?php echo $trans12 ?></em> <?php echo $trans13 ?>.");

				$('html, body').animate({
			        scrollTop: $("#wpgamelist-addstylepak-success-div").offset().top-100
			    }, 1000);
			}

			//event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});

		// Actually assigning a StylePak to a library
		$(document).on("click","#wpgamelist-apply-library-stylepak", function(event){
		    var stylePak = $("#wpgamelist-select-library-stylepak").val();
		    var library = $('#wpgamelist-stylepak-select-library').val();

		    var data = {
		      'action': 'wpgamelist_upload_new_stylepak_action',
		      'security': '<?php echo wp_create_nonce("wpgamelist_upload_new_stylepak_action_callback" ); ?>',
		      'stylepak': stylePak,
		      'library':library
		    };

		    console.log(data);

		    var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(response);
			    	document.location.reload();
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				    console.log(textStatus);
				    console.log(jqXHR);
				}
			});

	  	});

	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_upload_new_stylepak_action_callback(){

	global $wpdb;
	check_ajax_referer( 'wpgamelist_upload_new_stylepak_action_callback', 'security' );

	// For assigning a StylePak to a Library
	if(isset($_POST["stylepak"])){
		$stylepak = filter_var($_POST["stylepak"],FILTER_SANITIZE_STRING);
  		$library = filter_var($_POST["library"],FILTER_SANITIZE_STRING);

  		$stylepak = str_replace('.css', '', $stylepak);
  		$stylepak = str_replace('.zip', '', $stylepak);

  		// Build table name to store StylePak in
  		if(strpos($library, 'wpgamelist_jre_saved_game_log') !== false){
  			$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
	  		$data = array(
		      'stylepak' => $stylepak,
		    );
		    $format = array( '%s');   
		    $where = array( 'ID' => 1 );
		    $where_format = array( '%d' );
		    echo $wpdb->update( $table_name, $data, $where, $format, $where_format );
  		} else {
  			$table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
  			$library = substr($library, strrpos($library, '_') + 1);
  			$data = array(
		      'stylepak' => $stylepak,
		    );
		    $format = array( '%s');   
		    $where = array( 'user_table_name' => $library );
		    $where_format = array( '%s' );
		    echo $stylepak.' '.$library;
		    echo $wpdb->update( $table_name, $data, $where, $format, $where_format );
  		}

	} else {
		// Create file structure in the uploads dir 
		$mkdir1 = null;
		if (!file_exists(GAMELIST_GAMELIST_UPLOADS_BASE_DIR."wpgamelist")) {
			// TODO: create log file entry 
			$mkdir1 = mkdir(GAMELIST_GAMELIST_UPLOADS_BASE_DIR."wpgamelist", 0777, true);
		}

		// Create file structure in the uploads dir 
		$mkdir2 = null;
		if (!file_exists(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR)) {
			// TODO: create log file entry 
			$mkdir2 = mkdir(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR, 0777, true);
		}

		// TODO: create log file entry 
		$move_result = move_uploaded_file($_FILES['my_uploaded_file']['tmp_name'], GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR."{$_FILES['my_uploaded_file'] ['name']}");

		// Unzip the file if it's zipped
		if(strpos($_FILES['my_uploaded_file']['name'], '.zip') !== false){
			$zip = new ZipArchive;
			$res = $zip->open(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR.$_FILES['my_uploaded_file']['name']);
			if ($res === TRUE) {
			  $zip->extractTo(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR);
			  $zip->close();
			  unlink(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR.$_FILES['my_uploaded_file']['name']);
			}
		}

		echo $mkdir1.'sep'.$mkdir2.'sep'.$move_result;
	}
	wp_die();
}






// For uploading a new post StylePak after purchase
function wpgamelist_upload_new_post_template_action_javascript() { 

	$trans1 = __("Success!", 'wpgamelist');
	$trans2 = __("You've added a new Template!", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans10 = __("Uh-Oh!", 'wpgamelist');
	$trans11 = __("Looks like there was a problem uploading your Template! Are you sure you selected the right file? It should end with either a '.zip' or a '.php' - you could also try unzipping the file", 'wpgamelist');
	$trans12 = __("before", 'wpgamelist');
	$trans13 = __("uploading it", 'wpgamelist');


	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

		// Enabling the 'Apply StylePak' button when first drop-down is changed
		$(document).on("change","#wpgamelist-select-post-template", function(event){
			$('#wpgamelist-apply-post-template').prop('disabled', false);
		});

		// For uploading a new StylePak
  		$(document).on("change","#wpgamelist-add-new-post-template", function(event){

  			$('.wpgamelist-spinner').animate({'opacity':'1'});

			var files = event.target.files; // FileList object
		    var theFile = files[0];
		    // Open Our formData Object
		    var formData = new FormData();
		    formData.append('action', 'wpgamelist_upload_new_post_template_action');
		    formData.append('my_uploaded_file', theFile);
		    var nonce = '<?php echo wp_create_nonce( "wpgamelist_upload_new_post_template_action_callback" ); ?>';
		    formData.append('security', nonce);

		    // If it's a zip file or a css file, proceed with uploading the file
		    if(theFile.name.includes('.zip') || theFile.name.includes('.php')){
			    jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: formData,
					contentType:false,
					processData:false,
					success: function(response){
						console.log(response);
						response = response.split('sep');
						if(response[2] == 1){
							$('.wpgamelist-spinner').animate({'opacity':'0'});
							$('#wpgamelist-addtemplate-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans1 ?></span><br/><br/>&nbsp;<?php echo $trans2 ?><div id='wpgamelist-addtemplate-success-thanks'><?php echo $trans6 ?>&nbsp;<a href='http://wpgamelist.com/index.php/extensions/'><?php echo $trans7 ?></a><br/><br/>&nbsp;<?php echo $trans8 ?> &nbsp;<a id='wpgamelist-addgame-success-review-link' href='https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5'><?php echo $trans9 ?></a><img id='wpgamelist-smile-icon-1' src='<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png'></div>");

							$('html, body').animate({
						        scrollTop: $("#wpgamelist-addtemplate-success-div").offset().top-100
						    }, 1000);

						    setTimeout(function(){
					    		document.location.reload(true);
					    	}, 6000)

						} else {

						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(errorThrown);
					    console.log(textStatus);
					    console.log(jqXHR);
					}	
			    }); 

			} else {
				// If the file isn't a zip or css file...
				$('.wpgamelist-spinner').animate({'opacity':'0'});
				$('#wpgamelist-addtemplate-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans10; ?></span><br/><br/> <?php echo $trans11; ?>&nbsp;<em><?php echo $trans12; ?></em> <?php echo $trans13; ?>");

				$('html, body').animate({
			        scrollTop: $("#wpgamelist-addtemplate-success-div").offset().top-100
			    }, 1000);
			}

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});

		// Actually assigning a StylePak to a library
		$(document).on("click","#wpgamelist-apply-post-template", function(event){
		    var template = $("#wpgamelist-select-post-template").val();

		    var data = {
		      'action': 'wpgamelist_upload_new_post_template_action',
		      'security': '<?php echo wp_create_nonce("wpgamelist_upload_new_post_template_action_callback" ); ?>',
		      'template': template
		    };

		    console.log(data);

		    var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(response);
			    	document.location.reload();
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				    console.log(textStatus);
				    console.log(jqXHR);
				}
			});

	  	});

	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_upload_new_post_template_action_callback(){

	global $wpdb;
	check_ajax_referer( 'wpgamelist_upload_new_post_template_action_callback', 'security' );

	// For assigning a Template to a Library
	if(isset($_POST["template"])){
		$template = filter_var($_POST["template"],FILTER_SANITIZE_STRING);

  		$template = str_replace('.php', '', $template);
  		$template = str_replace('.zip', '', $template);

  		$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';

  		$data = array(
	      'activeposttemplate' => $template,
	    );
	    $format = array( '%s');   
	    $where = array( 'ID' => 1 );
	    $where_format = array( '%d' );
	    echo $wpdb->update( $table_name, $data, $where, $format, $where_format );

	} else {
		// Create file structure in the uploads dir 
		$mkdir1 = null;
		if (!file_exists(GAMELIST_GAMELIST_UPLOADS_BASE_DIR."wpgamelist")) {
			// TODO: create log file entry 
			$mkdir1 = mkdir(GAMELIST_GAMELIST_UPLOADS_BASE_DIR."wpgamelist", 0777, true);
		}

		// Create file structure in the uploads dir 
		$mkdir2 = null;
		if (!file_exists(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR)) {
			// TODO: create log file entry 
			$mkdir2 = mkdir(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR, 0777, true);
		}

		// TODO: create log file entry 
		$move_result = move_uploaded_file($_FILES['my_uploaded_file']['tmp_name'], GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR."{$_FILES['my_uploaded_file'] ['name']}");

		// Unzip the file if it's zipped
		if(strpos($_FILES['my_uploaded_file']['name'], '.zip') !== false){
			$zip = new ZipArchive;
			$res = $zip->open(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.$_FILES['my_uploaded_file']['name']);
			if ($res === TRUE) {
			  $zip->extractTo(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR);
			  $zip->close();
			  unlink(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.$_FILES['my_uploaded_file']['name']);
			}
		}

		echo $mkdir1.'sep'.$mkdir2.'sep'.$move_result;
	}
	wp_die();
}

// For uploading a new page Template after purchase
function wpgamelist_upload_new_page_template_action_javascript() { 

	$trans1 = __("Success!", 'wpgamelist');
	$trans2 = __("You've added a new Template!", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans10 = __("Uh-Oh!", 'wpgamelist');
	$trans11 = __("Looks like there was a problem uploading your Template! Are you sure you selected the right file? It should end with either a '.zip' or a '.php' - you could also try unzipping the file", 'wpgamelist');
	$trans12 = __("before", 'wpgamelist');
	$trans13 = __("uploading it", 'wpgamelist');

	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

		// Enabling the 'Apply Template' button when first drop-down is changed
		$(document).on("change","#wpgamelist-select-page-template", function(event){
			$('#wpgamelist-apply-page-template').prop('disabled', false);
		});

		// For uploading a new Template
  		$(document).on("change","#wpgamelist-add-new-page-template", function(event){

  			$('.wpgamelist-spinner').animate({'opacity':'1'});

			var files = event.target.files; // FileList object
		    var theFile = files[0];
		    // Open Our formData Object
		    var formData = new FormData();
		    formData.append('action', 'wpgamelist_upload_new_page_template_action');
		    formData.append('my_uploaded_file', theFile);
		    var nonce = '<?php echo wp_create_nonce( "wpgamelist_upload_new_page_template_action_callback" ); ?>';
		    formData.append('security', nonce);

		    // If it's a zip file or a css file, proceed with uploading the file
		    if(theFile.name.includes('.zip') || theFile.name.includes('.php')){
			    jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: formData,
					contentType:false,
					processData:false,
					success: function(response){
						console.log(response);
						response = response.split('sep');
						if(response[2] == 1){
							$('.wpgamelist-spinner').animate({'opacity':'0'});
							$('#wpgamelist-addtemplate-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans1 ?></span><br/><br/>&nbsp;<?php echo $trans2 ?><div id='wpgamelist-addtemplate-success-thanks'><?php echo $trans6 ?>&nbsp;<a href='http://wpgamelist.com/index.php/extensions/'><?php echo $trans7 ?></a><br/><br/>&nbsp;<?php echo $trans8 ?> &nbsp;<a id='wpgamelist-addgame-success-review-link' href='https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5'><?php echo $trans8 ?></a><img id='wpgamelist-smile-icon-1' src='<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png'></div>");

							$('html, body').animate({
						        scrollTop: $("#wpgamelist-addtemplate-success-div").offset().top-100
						    }, 1000);

						    setTimeout(function(){
					    		document.location.reload(true);
					    	}, 6000)
					    	
						} else {

						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(errorThrown);
					    console.log(textStatus);
					    console.log(jqXHR);
					}	
			    }); 

			} else {
				// If the file isn't a zip or css file...
				$('.wpgamelist-spinner').animate({'opacity':'0'});
				$('#wpgamelist-addtemplate-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans10; ?></span><br/><br/> <?php echo $trans11; ?>&nbsp;<em><?php echo $trans12; ?></em> <?php echo $trans13; ?>");

				$('html, body').animate({
			        scrollTop: $("#wpgamelist-addtemplate-success-div").offset().top-100
			    }, 1000);
			}

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});

		// Actually assigning a Template to a library
		$(document).on("click","#wpgamelist-apply-page-template", function(event){
		    var template = $("#wpgamelist-select-page-template").val();

		    var data = {
		      'action': 'wpgamelist_upload_new_page_template_action',
		      'security': '<?php echo wp_create_nonce("wpgamelist_upload_new_page_template_action_callback" ); ?>',
		      'template': template
		    };

		    console.log(data);

		    var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(response);
			    	document.location.reload();
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				    console.log(textStatus);
				    console.log(jqXHR);
				}
			});

	  	});

	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_upload_new_page_template_action_callback(){

	global $wpdb;
	check_ajax_referer( 'wpgamelist_upload_new_page_template_action_callback', 'security' );

	// For assigning a page_template
	if(isset($_POST["template"])){
		$template = filter_var($_POST["template"],FILTER_SANITIZE_STRING);

  		$template = str_replace('.php', '', $template);
  		$template = str_replace('.zip', '', $template);

  		$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';

  		$data = array(
	      'activepagetemplate' => $template,
	    );
	    $format = array( '%s');   
	    $where = array( 'ID' => 1 );
	    $where_format = array( '%d' );
	    $wpdb->update( $table_name, $data, $where, $format, $where_format );

	} else {
		// Create file structure in the uploads dir 
		$mkdir1 = null;
		if (!file_exists(GAMELIST_GAMELIST_UPLOADS_BASE_DIR."wpgamelist")) {
			// TODO: create log file entry 
			$mkdir1 = mkdir(GAMELIST_GAMELIST_UPLOADS_BASE_DIR."wpgamelist", 0777, true);
		}

		// Create file structure in the uploads dir 
		$mkdir2 = null;
		if (!file_exists(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR)) {
			// TODO: create log file entry 
			$mkdir2 = mkdir(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR, 0777, true);
		}

		// TODO: create log file entry 
		$move_result = move_uploaded_file($_FILES['my_uploaded_file']['tmp_name'], GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR."{$_FILES['my_uploaded_file'] ['name']}");

		// Unzip the file if it's zipped
		if(strpos($_FILES['my_uploaded_file']['name'], '.zip') !== false){
			$zip = new ZipArchive;
			$res = $zip->open(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.$_FILES['my_uploaded_file']['name']);
			if ($res === TRUE) {
			  $zip->extractTo(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR);
			  $zip->close();
			  unlink(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.$_FILES['my_uploaded_file']['name']);
			}
		}

		echo $mkdir1.'sep'.$mkdir2.'sep'.$move_result;
	}
	wp_die();
}

// For creating a spreasheet backup of a Library
function wpgamelist_create_db_library_backup_action_javascript() { 

	$trans1 = __("Success!", 'wpgamelist');
	$trans2 = __("You've Created a New Backup! You can", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans14 = __("download your backup here", 'wpgamelist');
	

	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

  		// Enabling the 'Backup Library' button when first drop-down is changed
		$(document).on("change","#wpgamelist-backup-select-library", function(event){
			$('#wpgamelist-apply-library-backup').prop('disabled', false);
		});

  		$(document).on("click","#wpgamelist-apply-library-backup", function(event){

  			$('#wpgamelist-spinner-backup').animate({'opacity':'1'}, 500);

  			var library = $('#wpgamelist-backup-select-library').val();

		  	var data = {
				'action': 'wpgamelist_create_db_library_backup_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_create_db_library_backup_action_callback" ); ?>',
				'library':library
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	response = response.split(',');
			    	if(response[0] == '1'){
			    		$('#wpgamelist-spinner-backup').animate({'opacity':'0'}, 500);
			    		$('#wpgamelist-addbackup-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans1 ?></span><br/><br/> <?php echo $trans2 ?> <a href='<?php echo GAMELIST_GAMELIST_LIBRARY_DB_BACKUPS_UPLOAD_URL; ?>"+response[1]+".zip'><?php echo $trans14 ?>.</a><div id='wpgamelist-addstylepak-success-thanks'><?php echo $trans6 ?> <a href='http://wpgamelist.com/index.php/extensions/'><?php echo $trans7 ?></a><br/><br/> <?php echo $trans8 ?> <a id='wpgamelist-addgame-success-review-link' href='https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5'><?php echo $trans9 ?></a><img id='wpgamelist-smile-icon-1' src='<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png'></div>");

						$('html, body').animate({
					        scrollTop: $("#wpgamelist-addbackup-success-div").offset().top-100
					    }, 1000);

			    	}
	
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating a spreasheet backup of a Library
function wpgamelist_create_db_library_backup_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_create_db_library_backup_action_callback', 'security' );
	$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-backup.php');
	$backup_class = new WPGameList_Backup('library_database_backup', $library);
	echo $backup_class->create_backup_result; 
	wp_die();
}

// For restoring a backup of a Library
function wpgamelist_restore_db_library_backup_action_javascript() { 

	$trans1 = __("Success!", 'wpgamelist');
	$trans2 = __("You've Restored Your Library!", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans14 = __("download your backup here", 'wpgamelist');

	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

	  	// Enabling the 'Select a Backup' drop-down when first drop-down is changed
		$(document).on("change","#wpgamelist-select-library-backup", function(event){
			var table = $(this).val();
			$('#wpgamelist-select-actual-backup').val('Select a Backup...')
			$('#wpgamelist-apply-library-restore').prop('disabled', true)
			$('.wpgamelist-backup-actual-option').each(function(){
				if( $(this).attr('data-table') != table){
					$(this).css({'display':'none'});
				} else {
					$(this).css({'display':'block'});
				}
			})
			$('#wpgamelist-select-actual-backup').prop('disabled', false);
		});

		// Enabling the 'Restore Library' button when 'select a backup' drop-down is changed
		$(document).on("change","#wpgamelist-select-actual-backup", function(event){
			$('#wpgamelist-apply-library-restore').prop('disabled', false);
		});


  		$(document).on("click","#wpgamelist-apply-library-restore", function(event){

  			$('#wpgamelist-spinner-restore-backup').animate({'opacity':'1'}, 500);

  			var table = $('#wpgamelist-select-library-backup').val();
  			var backup = $('#wpgamelist-select-actual-backup').val();

		  	var data = {
				'action': 'wpgamelist_restore_db_library_backup_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_restore_db_library_backup_action_callback" ); ?>',
				'table':table,
				'backup':backup
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	$('#wpgamelist-spinner-restore-backup').animate({'opacity':'0'}, 500);
			    	$('#wpgamelist-addbackup-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans1; ?></span><br/><br/> <?php echo $trans2; ?><div id='wpgamelist-addstylepak-success-thanks'><?php echo $trans6; ?> <a href='http://wpgamelist.com/index.php/extensions/'><?php echo $trans7; ?></a><br/><br/> <?php echo $trans8; ?> <a id='wpgamelist-addgame-success-review-link' href='https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5'><?php echo $trans9; ?></a><img id='wpgamelist-smile-icon-1' src='<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png'></div>");

					$('html, body').animate({
				        scrollTop: $("#wpgamelist-addbackup-success-div").offset().top-100
				    }, 1000);
		    		console.log(response);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for restoring a backup of a Library
function wpgamelist_restore_db_library_backup_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_restore_db_library_backup_action_callback', 'security' );
	$table = filter_var($_POST['table'],FILTER_SANITIZE_STRING);
	$backup = filter_var($_POST['backup'],FILTER_SANITIZE_STRING);

	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-backup.php');
	$backup_class = new WPGameList_Backup('library_database_restore', $table, $backup);

	wp_die();
}


// For creating a .csv file of ISBN/ASIN numbers
function wpgamelist_create_csv_action_javascript() { 

	$trans1 = __("Success!", 'wpgamelist');
	$trans2 = __("You've Created a CSV file of ISBN/ASIN numbers! You can", 'wpgamelist');
	$trans6 = __("Thanks for using WPGameList, and", 'wpgamelist');
	$trans7 = __("be sure to check out the WPGameList Extensions!", 'wpgamelist');
	$trans8 = __("If you happen to be thrilled with WPGameList, then by all means,", 'wpgamelist');
	$trans9 = __("Feel Free to Leave a 5-Star Review Here!", 'wpgamelist');
	$trans14 = __("download your file here", 'wpgamelist');
	$trans15 = __("Remember, your new file will come in handy when using the", 'wpgamelist');
	$trans16 = __("WPGameList Bulk-Upload Extension!", 'wpgamelist');

	

	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

  		// Enabling the 'Restore Library' button when 'select a backup' drop-down is changed
		$(document).on("change","#wpgamelist-backup-csv-select-library", function(event){
			$('#wpgamelist-apply-library-backup-csv').prop('disabled', false);
		});


  		$(document).on("click","#wpgamelist-apply-library-backup-csv", function(event){

		  	$('#wpgamelist-spinner-backup-csv').animate({'opacity':'1'}, 500);

  			var table = $('#wpgamelist-backup-csv-select-library').val();

		  	var data = {
				'action': 'wpgamelist_create_csv_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_create_csv_action_callback" ); ?>',
				'table':table
			};

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	response = response.split(',');
			    	if(response[0] == '1'){
			    		$('#wpgamelist-spinner-backup-csv').animate({'opacity':'0'}, 500);
			    		$('#wpgamelist-addbackup-success-div').html("<span id='wpgamelist-add-game-success-span'><?php echo $trans1; ?></span><br/><br/> <?php echo $trans2; ?> <a href='<?php echo GAMELIST_GAMELIST_LIBRARY_DB_BACKUPS_UPLOAD_URL; ?>"+response[1]+".zip'><?php echo $trans14; ?>.</a> <?php echo $trans15; ?> <a href='https://wpgamelist.com/index.php/downloads/bulk-upload-extension/'><?php echo $trans16; ?></a> <div id='wpgamelist-addstylepak-success-thanks'><?php echo $trans6; ?> <a href='http://wpgamelist.com/index.php/extensions/'><?php echo $trans7; ?></a><br/><br/> <?php echo $trans8; ?> <a id='wpgamelist-addgame-success-review-link' href='https://wordpress.org/support/plugin/wpgamelist/reviews/?filter=5'><?php echo $trans9; ?></a><img id='wpgamelist-smile-icon-1' src='<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>smile.png'></div>");

						$('html, body').animate({
					        scrollTop: $("#wpgamelist-addbackup-success-div").offset().top-100
					    }, 1000);
			    		console.log('success!)');
			    	}
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_create_csv_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_create_csv_action_callback', 'security' );
	$table = filter_var($_POST['table'],FILTER_SANITIZE_STRING);
	
	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-backup.php');
	$backup_class = new WPGameList_Backup('create_csv_file', $table);

	echo $backup_class->create_csv_result;
	wp_die();
}





// For setting the Amazon Localization
function wpgamelist_amazon_localization_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click","#wpgamelist-save-localization", function(event){

  			var country;
		    var boxes = jQuery(".wpgamelist-localization-checkbox");
		    for (var i=0; i<boxes.length; i++) {
			    if (boxes[i].checked) {
			    	country = boxes[i].value;
			    }
		    }

		  	var data = {
				'action': 'wpgamelist_amazon_localization_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_amazon_localization_action_callback" ); ?>',
				'country':country
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload();
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_amazon_localization_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_amazon_localization_action_callback', 'security' );
	$country = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
	$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';

	$data = array(
	    'amazoncountryinfo' => $country
	);
	$format = array( '%s');  
	$where = array( 'ID' => 1 );
	$where_format = array( '%d' );
	$wpdb->update( $table_name, $data, $where, $format, $where_format );
	wp_die();
}


function wpgamelist_delete_game_bulk_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

  		// For switching into bulk delete mode
  		$(document).on("click","#wpgamelist-bulk-edit-mode-on-button", function(event){
  			$('#wpgamelist-reorder-button').prop('disabled', true)
  			$('#wpgamelist-bulk-edit-div').animate({'height':'185px'})
  			$('.wpgamelist-edit-actions-edit-button').css({'opacity':'0.2', 'pointer-events':'none'});
  			$('.wpgamelist-edit-actions-delete-button').css({'opacity':'0.2', 'pointer-events':'none'});
  			$('.wpgamelist-edit-img-author-div').css({'opacity':'0.2', 'pointer-events':'none'});
  			$('.wpgamelist-bulk-delete-checkbox-div').css({'display':'block'})
  		});

  		// For cancelling bulk delete mode
  		$(document).on("click","#wpgamelist-bulk-edit-mode-delete-all-in-lib-cancel", function(event){
  			$('#wpgamelist-bulk-edit-div').animate({'height':'60px'})
  			$('.wpgamelist-edit-actions-div').animate({'opacity':'1'})
  			$('.wpgamelist-edit-actions-edit-button').css({'opacity':'1', 'pointer-events':'all'});
  			$('.wpgamelist-edit-actions-delete-button').css({'opacity':'1', 'pointer-events':'all'});
  			$('.wpgamelist-edit-img-author-div').css({'opacity':'1', 'pointer-events':'all'});
  			$('.wpgamelist-bulk-delete-checkbox-div').css({'display':'none'})
  			$('#wpgamelist-reorder-button').prop('disabled', false)
  		});

  		// For enabling/disabling the 'Delete Checked Games' button
  		$(document).on("change",".wpgamelist-bulk-delete-checkbox", function(event){
  			$('#wpgamelist-bulk-edit-mode-delete-checked').attr('disabled', true);
  			$('.wpgamelist-bulk-delete-checkbox').each(function(){
  				if($(this).prop('checked') == true){
  					$('#wpgamelist-bulk-edit-mode-delete-checked').removeAttr('disabled');
  				}
  			})
  		});

  		// For deleting all games in library
  		$(document).on("click","#wpgamelist-bulk-edit-mode-delete-all-in-lib", function(event){

  			$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'}, 500);

  			var library = $('#wpgamelist-editgame-select-library').val();

  			var data = {
				'action': 'wpgamelist_delete_game_bulk_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_delete_game_bulk_action_callback" ); ?>',
				'library':library,
				'deleteallgames':true
			};

			var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload();
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

  		});

  		// For deleting all games, pages, and posts in library
  		$(document).on("click","#wpgamelist-bulk-edit-mode-delete-all-plus-pp-in-lib", function(event){

  			$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'}, 500);

  			var library = $('#wpgamelist-editgame-select-library').val();

  			var data = {
				'action': 'wpgamelist_delete_game_bulk_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_delete_game_bulk_action_callback" ); ?>',
				'library':library,
				'deleteallgamesandpostandpages':true
			};

			var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload();
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

  		});
  		
  		// For deleting all titles that are checked
  		$(document).on("click","#wpgamelist-bulk-edit-mode-delete-checked", function(event){

  			$('#wpgamelist-spinner-edit-change-lib').animate({'opacity':'1'}, 500);

  			var gameId = '';
  			var library = '';
  			var deleteString = '';
  			$('.wpgamelist-bulk-delete-checkbox').each(function(){
  				if($(this).prop('checked') == true){
  					gameId = gameId+'sep'+$(this).attr('data-game-id');

  					// Grabbing the post and page ID's, if they exist
		  			$(this).parent().parent().parent().find('.wpgamelist-edit-actions-div .wpgamelist-edit-game-delete-page-post-div input').each(function(index){
		  				if($(this).prop('checked')){
		  					if($(this).attr('data-id') != undefined && $(this).attr('data-id') != null){
		  						deleteString = deleteString+'-'+$(this).attr('data-id');
		  					}
		  				}
		  			});

		  			deleteString = deleteString+'sep';

  				}
  			})

  			var library = $('#wpgamelist-editgame-select-library').val();

		  	var data = {
				'action': 'wpgamelist_delete_game_bulk_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_delete_game_bulk_action_callback" ); ?>',
				'deleteString':deleteString,
				'gameId':gameId,
				'library':library,
				'deletechecked':true
			};

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	document.location.reload();
			    	console.log(response);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_delete_game_bulk_action_callback(){
	global $wpdb;
	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$game_class = new WPGameList_Game;
	check_ajax_referer( 'wpgamelist_delete_game_bulk_action_callback', 'security' );

	if(isset($_POST['deletechecked'])){
		$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
		$delete_string = filter_var($_POST['deleteString'],FILTER_SANITIZE_STRING);
		$game_id = filter_var($_POST['gameId'],FILTER_SANITIZE_STRING);
		$delete_array = explode('sep', $game_id);

		$new_array = array();
		$counter = 0;
		foreach($delete_array as $key=>$delete){
			if($delete != '' && $delete != null){
				for($i = 0; $i < $key; $i++){
					if($delete_array[$i] < $delete){
						$counter++;
					}
				}
			}

			if($delete_array[$key] != 1){
				$delete_array[$key] = ($delete_array[$key]-$counter+1);
			} else {
				$delete_array[$key] = ($delete_array[$key]-$counter);
			}
			$counter = 0;

		}

		

		$delete_page_post_array = explode('sep', $delete_string);

		foreach($delete_array as $key=>$delete){
			if($key!=0){
				$delete_result = $game_class->delete_game($library, $delete, $delete_page_post_array[$key-1]);

			}
		}
	}

	if(isset($_POST['deleteallgames'])){

		$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
		$delete_result = $game_class->empty_table($library);
	}

	if(isset($_POST['deleteallgamesandpostandpages'])){

		$library = filter_var($_POST['library'],FILTER_SANITIZE_STRING);
		$delete_result = $game_class->empty_everything($library);
	}

	wp_die();
}

function wpgamelist_jre_dismiss_prem_notice_forever_action_javascript(){
?>
<script>

  jQuery("#wpgamelist-my-notice-dismiss-forever").click(function(){

    var data = {
      'action': 'wpgamelist_jre_dismiss_prem_notice_forever_action',
      'security': '<?php echo wp_create_nonce( "wpgamelist_jre_dismiss_prem_notice_forever_action" ); ?>',
    };

    var request = $.ajax({
	    url: ajaxurl,
	    type: "POST",
	    data:data,
	    timeout: 0,
	    success: function(response) {
	    	document.location.reload();
	    },
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
            console.log(textStatus);
            console.log(jqXHR);
		}
	});


  });

  </script> <?php
}

function wpgamelist_jre_dismiss_prem_notice_forever_action_callback(){
  global $wpdb; // this is how you get access to the database
  check_ajax_referer( 'wpgamelist_jre_dismiss_prem_notice_forever_action', 'security' );
  $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';

  $data = array(
      'admindismiss' => 0
  );
  $where = array( 'ID' => 1 );
  $format = array( '%d');  
  $where_format = array( '%d' );
  echo $wpdb->update( $table_name, $data, $where, $format, $where_format );
  wp_die();
}


function wpgamelist_reorder_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {

  		var game;
  		var origNode;
  		var mousedown = false;
  		var direction = "";
  		var oldx = 0

  		// Disable the edit & Delete buttons, change UI to reflect 'reorder mode'.
  		$(document).on("click","#wpgamelist-reorder-button", function(){
  			$('.wpgamelist-edit-actions-edit-button, .wpgamelist-edit-actions-delete-button, .wpgamelist-edit-game-title, .wpgamelist-edit-game-cover-img').css({'pointer-events':'none'})
  			$('#wpgamelist-reorder-button').prop('disabled', true)
  			$('#wpgamelist-bulk-edit-mode-on-button').animate({'top':'60px'})
  			$('#wpgamelist-cancel-reorder-button').animate({'opacity':'1'})
  			$('#wpgamelist-cancel-reorder-button').css({'z-index':'1'})
  			$('.wpgamelist-edit-actions-div').css({'opacity':'0.3'})
  			$('.wpgamelist-show-game-colorbox').css({'cursor':'move'})
  			$('.wpgamelist-edit-game-icon').css({'cursor':'move'})
  			$('.wpgamelist-search-indiv-container').css({'cursor':'move'})

  			$('.wpgamelist-search-indiv-container').each(function(){
  				$(this).addClass('wpgamelist-search-indiv-container-reorder');
  			})
  		});

  		// Enable the reorder button again immediately upon clicking 'Cancel'
  		$(document).on("mousedown","#wpgamelist-cancel-reorder-button", function(){
  			$('#wpgamelist-reorder-button').prop('disabled', false);
  		});

  		// Undo UI changes from 'reorder mode'.
  		$(document).on("click","#wpgamelist-cancel-reorder-button", function(){
  			$('.wpgamelist-edit-actions-edit-button, .wpgamelist-edit-actions-delete-button, .wpgamelist-edit-game-title, .wpgamelist-edit-game-cover-img').css({'pointer-events':'all'})
  			$('#wpgamelist-bulk-edit-mode-on-button').animate({'top':'31px'})
  			$('#wpgamelist-cancel-reorder-button').animate({'opacity':'0'})
  			$('#wpgamelist-cancel-reorder-button').css({'z-index':'-9'})
  			$('.wpgamelist-edit-actions-div').css({'opacity':'1'})
  			$('.wpgamelist-show-game-colorbox').css({'cursor':'pointer'})
  			$('.wpgamelist-edit-game-icon').css({'cursor':'auto'})
  			$('.wpgamelist-search-indiv-container').css({'cursor':'auto'})

  			$('.wpgamelist-search-indiv-container').each(function(){
  				$(this).removeClass('wpgamelist-search-indiv-container-reorder');
  			})

  		});




  		// Determining if user is scrolling
  		window.isScrolling = false;
		$(window).scroll(function() {
		    window.isScrolling = true;
		    clearTimeout($.data(this, "scrollTimer"));
		    $.data(this, "scrollTimer", setTimeout(function() {
		        // If the window didn't scroll for 250ms
		        window.isScrolling = false;
		    }, 500));
		});

	  	// disable mousewheel
  		function wpgameliststopmousewheel(){
  			if(mousedown == true){
             return false;
         	}
        }

		$(document).mousemove(wpgamelistmousemove);

  		$(document).on('mouseup', function(e){
 			// If Reorder mode is active...
  			if($('#wpgamelist-reorder-button').attr('disabled') == 'disabled'){

  				$(document).unbind("mouseenter", wpgamelistmouseenter);
	  			$(document).unbind("mousedown", wpgamelistmousedown);
	  			$(document).unbind("mousemove", wpgamelistmousemove);
	  			$(document).unbind("mousemove", wpgamelistmousemove);
	  			$(document).unbind("onmousewheel", wpgameliststopmousewheel);

  				$('#clone').remove();
  				$('#game-in-movement .wpgamelist-spinner').animate({'opacity':'1'})
	  			
	  			// Get the ids of games
	  			var idarray = [];
	  			$('.wpgamelist-edit-game-indiv-div-class .wpgamelist-edit-title-div .wpgamelist-edit-img-author-div .wpgamelist-edit-game-cover-img').each(function(){
	  				var id = $(this).attr('data-gameuid');
	  				idarray.push(id);
	  			})

	  			var idarray = JSON.stringify(idarray);
	  			var table = $("#wpgamelist-editgame-select-library").val();

	  			var data = {
					'action': 'wpgamelist_reorder_action',
					'security': '<?php echo wp_create_nonce( "wpgamelist_reorder_action_callback" ); ?>',
					'idarray':idarray,
					'table':table
				};
				console.log(data);

		     	var request = $.ajax({
				    url: ajaxurl,
				    type: "POST",
				    data:data,
				    timeout: 0,
				    success: function(response) {
				    	//if(response == 1){
				    		console.log(response);
				    		mousedown = false;
				  			$('.wpgamelist-search-indiv-container-reorder').css({'pointer-events':'all'})
				  			$('#game-in-movement .wpgamelist-spinner').animate({'opacity':'0'})
				  			$('.wpgamelist-edit-game-indiv-div-class').css({'opacity':'1'})
				  			$('.wpgamelist-edit-game-title, .wpgamelist-edit-game-cover-img, .wpgamelist-edit-game-icon, .wpgamelist-edit-game-author').css({'pointer-events':'all', 'opacity':'1'})
				  			$('.wpgamelist-edit-game-indiv-div-class').css({'border':'1px solid #e5e5e5', 'pointer-events':'all'});
				  			$('.wpgamelist-edit-actions-div').css({'opacity':'0.3'})
				  			$('#game-in-movement').removeAttr('id');

				  			// re-bind events
				  			$(document).mousemove(wpgamelistmousemove);
				  			$(document).on("mousedown",".wpgamelist-search-indiv-container-reorder", wpgamelistmousedown)
				  			$(document).mousemove(wpgamelistmousemove);
				  			$(document).on("mouseenter",".wpgamelist-search-indiv-container-reorder", wpgamelistmouseenter);
						//}
				    },
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(errorThrown);
			            console.log(textStatus);
			            console.log(jqXHR);
					}
				});

	  			}
  		});


		document.addEventListener('mousemove', wpgamelistmousemove);

  		function wpgamelistmousedown(){
	  		mousedown = true;
            document.onmousewheel = wpgameliststopmousewheel;

	  		if($('#wpgamelist-reorder-button').attr('disabled') == 'disabled'){
	  			//$('.wpgamelist-edit-game-indiv-div-class').css({'opacity':'0.2'})
	  			$('.wpgamelist-edit-game-title, .wpgamelist-edit-game-cover-img, .wpgamelist-edit-game-icon, .wpgamelist-edit-game-author, .wpgamelist-edit-actions-div').css({'pointer-events':'none'})
	  			$(this).css({'opacity':'1', 'pointer-events':'none'})

	  			game = $(this).attr('id');
	  			origNode = $(this);
	  			$(this).attr('id', 'game-in-movement');
	  			console.log(game);
	  			var clone = $(this).clone();
	  			clone.attr('id', 'clone');
	  			$(this).parent().append(clone);
	  			$('#game-in-movement img, #game-in-movement p, #game-in-movement .wpgamelist-edit-actions-div').css({'opacity':'0'})
	  			$('#game-in-movement .wpgamelist-edit-game-indiv-div-class').css({'border-color':'black', 'border':'1px dashed black'});
	  		}
		}

		function wpgamelistmousemove(e){

			if (e.pageY < oldx) {
	            direction = "up"
	        } else if (e.pageY > oldx) {
	            direction = "down"
	        }
	        oldx = e.pageY;

	        $('#clone .wpgamelist-edit-game-indiv-div-class').css({
	        	border:'none'
	       	});

		    $('#clone').css({
		       left:  e.pageX-250,
		       top:   e.pageY-250,
		       position: 'absolute',
			   float: 'left',
		       backgroundColor: 'white',
		       zIndex: '999',
		       pointerEvents: 'none',
		       border: '1px solid #e5e5e5'
		    });
		}

		function wpgamelistmouseenter(e){
			if (window.isScrolling) return;
			if($(this).attr('id') != 'game-in-movement'){
				if(mousedown){
					if(direction == 'up'){
						console.log(origNode.prev().attr('class'))
						if(origNode.prev().attr('class') == 'wpgamelist-search-indiv-container wpgamelist-search-indiv-container-reorder'){
							origNode.prev().insertAfter(origNode);
							// Scrolls back to the top of the title 
							var scrollTop = ($("#game-in-movement").offset().top + $("#game-in-movement").height() / 2) - document.documentElement.clientHeight/2;
						    if(scrollTop != 0){
						      $('html, body').animate({
						        scrollTop: scrollTop
						      }, 500);
						      scrollTop = 0;
						    }
							return;
						}
						return;
					}

					if(direction == 'down'){
						if(origNode.next().attr('class') == 'wpgamelist-search-indiv-container wpgamelist-search-indiv-container-reorder'){
							origNode.next().insertBefore(origNode);
							var scrollTop = ($("#game-in-movement").offset().top + $("#game-in-movement").height() / 2) - document.documentElement.clientHeight/2
						    if(scrollTop != 0){
						      $('html, body').animate({
						        scrollTop: scrollTop
						      }, 500);
						      scrollTop = 0;
						    }
							return;
						}
						return;
					}
					
				}
			}
		}

		// Registering the various listeners for 'Reorder' mode.
		$(document).on("mousedown",".wpgamelist-search-indiv-container-reorder", wpgamelistmousedown)
		$(document).on("mouseenter",".wpgamelist-search-indiv-container-reorder", wpgamelistmouseenter);

	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_reorder_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_reorder_action_callback', 'security' );
	$table = filter_var($_POST['table'], FILTER_SANITIZE_STRING);
	$idarray = stripslashes($_POST['idarray']);
	$idarray = json_decode($idarray);

	// Dropping primary key in database to alter the IDs and the AUTO_INCREMENT value
	$wpdb->query($wpdb->prepare( "ALTER TABLE $table MODIFY ID BIGINT(190) NOT NULL", $table));

	$wpdb->query($wpdb->prepare( "ALTER TABLE $table DROP PRIMARY KEY", $table));

	foreach ($idarray as $key => $value) {
		$data = array(
		    'ID' => $key+1
		);

		$format = array( '%d');  
		$where = array( 'game_uid' => $value );
		$where_format = array( '%s' );
		$wpdb->update( $table, $data, $where, $format, $where_format );
	}

	// Adding primary key back to database 
	echo $wpdb->query($wpdb->prepare( "ALTER TABLE $table ADD PRIMARY KEY (`ID`)", $table)); 

	// Adjusting ID values of remaining entries in database
	$my_query = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table", $table ));
	$title_count = $wpdb->num_rows;   

	$wpdb->query($wpdb->prepare( "ALTER TABLE $table MODIFY ID BIGINT(190) AUTO_INCREMENT", $table));

	// Setting the AUTO_INCREMENT value based on number of remaining entries
	$title_count++;
	$wpdb->query($wpdb->prepare( "ALTER TABLE $table AUTO_INCREMENT = %d", $title_count));

	wp_die();
}

function wpgamelist_exit_results_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click","#wpgamelist-modal-submit, #wpgamelist-modal-close", function(event){



  			var id = '';
  			if($(this).attr('id') == 'wpgamelist-modal-close' ){
  				var id = 'wpgamelist-modal-close';
  			} else {
  				var id = 'wpgamelist-modal-submit';
  			}

  			var reasonEmail = $('#wpgamelist-modal-email').val()
  			console.log(reasonEmail)
  			if(reasonEmail != ''){
  				var reasonEmailInput = document.getElementById('wpgamelist-modal-email');
	  			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			    if (!filter.test(reasonEmailInput.value)) {
			    	alert('Whoops! Looks like that might not be a valid E-mail address!');
			    	reasonEmailInput.focus;
			    	return false;
				}
			}	

  			var reason1 = $('#wpgamelist-modal-reason1').prop('checked')
  			var reason2 = $('#wpgamelist-modal-reason2').prop('checked')
  			var reason3 = $('#wpgamelist-modal-reason3').prop('checked')
  			var reason4 = $('#wpgamelist-modal-reason4').prop('checked')
  			var reason5 = $('#wpgamelist-modal-reason5').prop('checked')
  			var reason6 = $('#wpgamelist-modal-reason6').prop('checked')
  			var reason7 = $('#wpgamelist-modal-reason7').prop('checked')
  			var reason8 = $('#wpgamelist-modal-reason8').prop('checked')
  			var reason9 = $('#wpgamelist-modal-reason9').prop('checked')
  			var reasonOther = $('#wpgamelist-modal-textarea').val()
  			var reasonEmail = $('#wpgamelist-modal-email').val()
  			var featureSuggestion = $('#wpgamelist-modal-textarea-suggest-feature').val()


		  	var data = {
				'action': 'wpgamelist_exit_results_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_exit_results_action_callback" ); ?>',
				'reason1':reason1,
				'reason2':reason2,
				'reason3':reason3,
				'reason4':reason4,
				'reason5':reason5,
				'reason6':reason6,
				'reason7':reason7,
				'reason8':reason8,
				'reason9':reason9,
				'reasonOther':reasonOther,
				'reasonEmail':reasonEmail,
				'featureSuggestion':featureSuggestion,
				'id':id
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {

			    	document.location.reload(true);



			    	console.log(response);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_exit_results_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_exit_results_action_callback', 'security' );
	$reason1 = filter_var($_POST['reason1'],FILTER_SANITIZE_STRING);
	$reason2 = filter_var($_POST['reason2'],FILTER_SANITIZE_STRING);
	$reason3 = filter_var($_POST['reason3'],FILTER_SANITIZE_STRING);
	$reason4 = filter_var($_POST['reason4'],FILTER_SANITIZE_STRING);
	$reason5 = filter_var($_POST['reason5'],FILTER_SANITIZE_STRING);
	$reason6 = filter_var($_POST['reason6'],FILTER_SANITIZE_STRING);
	$reason7 = filter_var($_POST['reason7'],FILTER_SANITIZE_STRING);
	$reason8 = filter_var($_POST['reason8'],FILTER_SANITIZE_STRING);
	$reason9 = filter_var($_POST['reason9'],FILTER_SANITIZE_STRING);
	$id = filter_var($_POST['id'],FILTER_SANITIZE_STRING);
	$reasonOther = filter_var($_POST['reasonOther'],FILTER_SANITIZE_STRING);
	$featureSuggestion = filter_var($_POST['featureSuggestion'],FILTER_SANITIZE_STRING);
	$reasonEmail = filter_var($_POST['reasonEmail'],FILTER_SANITIZE_EMAIL);

	$message = $reason1.' '.$reason2.' '.$reason3.' '.$reason4.' '.$reason5.' '.$reason6.' '.$reason7.' '.$reason8.' '.$reason9.' '.$featureSuggestion.' '.$reasonOther.' '.$reasonEmail;

	if($id == 'wpgamelist-modal-submit'){
		wp_mail( 'jake@jakerevans.com', 'WPGameList Exit Survey', $message );
		wp_mail( 'jakerevans2@gmail.com', 'WPGameList Exit Survey', $message );

		if($reasonEmail != ''){
			$autoresponseMessage = 'Thanks for trying out WPGameList and providing valuable feedback that will help make WPGameList even better! I\'ll review your feedback and get back with you ASAP.  -Jake' ;
			wp_mail( $reasonEmail, 'WPGameList Deactivation Survey', $autoresponseMessage );
		}
	}

	deactivate_plugins( 'wpgamelist/wpgamelist.php');
	wp_die();
}

// For searching for a game from the admin dashboard
function wpgamelist_gamesearch_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click","#wpgamelist-add-game-search-button", function(event){

  			var gametitle = $('#wpgamelist-add-game-gamesearch-input').val()
  			$('#wpgamelist-spinner-1').animate({'opacity':1})

		  	var data = {
				'action': 'wpgamelist_gamesearch_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_gamesearch_action_callback" ); ?>',
				'gametitle':gametitle
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(JSON.parse(response));
			    	response = JSON.parse(response);
			    	
			    	var responsehtml = '<div class="wpgamelist-add-game-search-row">';
			    	var coverimage = '';
			    	var title = '';
			    	var firstreleasedate = 0;
			    	var genrestring = '';
			    	var publisherstring = '';
			    	var developerstring = '';
			    	var platformstring = '';
			    	var rating = '';
			    	var criticrating = '';
			    	var gamemodestring = '';
			    	var perspectivesstring = ''
			    	var collectionstring = '';
			    	var franchisestring = '';
			    	var igdblink = '';
			    	var themestring = '';
			    	var summary = '';
			    	var esrbstring = '';
			    	var pegistring = '';

			    	// Hidden values
			    	var alternativenamesstring = '';
			    	var screenshotstring = '';
			    	var websitestring = '';
			    	var videostring = '';


			    	for (var i = response.length - 1; i >= 0; i--) {


			    		// Handle Cover Images
			    		if(response[i][0].cover != undefined){
			    			if(response[i][0].cover.cloudinary_id != undefined){
			    				coverimage = 'https://images.igdb.com/igdb/image/upload/t_cover_big/'+response[i][0].cover.cloudinary_id+'.jpg';
			    			} else {
			    				coverimage = '';
			    			}
			    		} else {
			    			coverimage = '';
			    		}

			    		// Handle Titles
			    		if(response[i][0].name != undefined){
			    			title = response[i][0].name;
			    		} else {
			    			title = '';
			    		}

			    		// Handle First Release Date
			    		if(response[i][0].first_release_date != undefined){
			    			firstreleasedate = String(response[i][0].first_release_date);
			    			firstreleasedate = firstreleasedate.slice(0, -3);
			    		} else {
			    			firstreleasedate = '';
			    		}

			    		// Handle genres
			    		if(response[i][0].genres != undefined){
			    			for (var r = response[i][0].genres.length - 1; r >= 0; r--) {
			    				genrestring = genrestring+response[i][0].genres[r]+', ';
			    			};
			    			genrestring = genrestring.substring(0, genrestring.length - 2);
			    		}

			    		// Handle publishers
			    		if(response[i][0].publishers != undefined){
			    			for (var x = response[i][0].publishers.length - 1; x >= 0; x--) {
			    				publisherstring = publisherstring+response[i][0].publishers[x]+', ';
			    			};
			    			publisherstring = publisherstring.substring(0, publisherstring.length - 2);
			    		}

			    		// Handle developers
			    		if(response[i][0].developers != undefined){
			    			for (var y = response[i][0].developers.length - 1; y >= 0; y--) {
			    				developerstring = developerstring+response[i][0].developers[y]+', ';
			    			};
			    			developerstring = developerstring.substring(0, developerstring.length - 2);
			    		}

			    		// Handle platforms
			    		if(response[i][0].platforms != undefined){
			    			for (var z = response[i][0].platforms.length - 1; z >= 0; z--) {
			    				platformstring = platformstring+response[i][0].platforms[z]+', ';
			    			};
			    			platformstring = platformstring.substring(0, platformstring.length - 2);
			    		}

			    		// Handle Rating
			    		if(response[i][0].rating != undefined){
			    			rating = response[i][0].rating.toFixed(2)
			    		}

			    		// Handle Rating
			    		if(response[i][0].aggregated_rating != undefined){
			    			criticrating = response[i][0].aggregated_rating.toFixed(2)
			    		}

			    		// Handle game modes
			    		if(response[i][0].game_modes != undefined){
			    			for (var a = response[i][0].game_modes.length - 1; a >= 0; a--) {
			    				gamemodestring = gamemodestring+response[i][0].game_modes[a]+', ';
			    			};
			    			gamemodestring = gamemodestring.substring(0, gamemodestring.length - 2);
			    		}

			    		// Handle perspectives
			    		if(response[i][0].player_perspectives != undefined){
			    			for (var b = response[i][0].player_perspectives.length - 1; b >= 0; b--) {
			    				perspectivesstring = perspectivesstring+response[i][0].player_perspectives[b]+', ';
			    			};
			    			perspectivesstring = perspectivesstring.substring(0, perspectivesstring.length - 2);
			    		}

			    		// Handle series (collections in API)
			    		if(response[i][0].collection != undefined){
			    			collectionstring = response[i][0].collection;
			    		}

			    		// Handle franchises
			    		if(response[i][0].franchises != undefined){
			    			for (var b = response[i][0].franchises.length - 1; b >= 0; b--) {
			    				franchisestring = franchisestring+response[i][0].franchises[b]+', ';
			    			};
			    			franchisestring = franchisestring.substring(0, franchisestring.length - 2);
			    		}

			    		// Handle IGDB link
			    		if(response[i][0].collection != undefined){
			    			igdblink = response[i][0].url;
			    		}

			    		// Handle themes
			    		if(response[i][0].themes != undefined){
			    			for (var z = response[i][0].themes.length - 1; z >= 0; z--) {
			    				themestring = themestring+response[i][0].themes[z]+', ';
			    			};
			    			themestring = themestring.substring(0, themestring.length - 2);
			    		}

			    		// Handle summary
			    		if(response[i][0].summary != undefined){
			    			summary = response[i][0].summary;
			    			summary = summary.replace(/"/g, '\\"');
			    		}

			    		// Handle esrb
			    		if(response[i][0].esrb != undefined){
			    			esrbstring = response[i][0].esrb.rating
			    		}

			    		// Handle pegi
			    		if(response[i][0].pegi != undefined){
			    			pegistring = response[i][0].pegi.rating
			    		}

			    		// Handle alternate names
			    		if(response[i][0].alternative_names != undefined){
			    			for (var a = response[i][0].alternative_names.length - 1; a >= 0; a--) {
			    				alternativenamesstring = alternativenamesstring+response[i][0].alternative_names[a].name+', ';
			    			};
			    			alternativenamesstring = alternativenamesstring.substring(0, alternativenamesstring.length - 2);
			    		}

			    		// Handle screenshots
			    		if(response[i][0].screenshots != undefined){
			    			for (var b = response[i][0].screenshots.length - 1; b >= 0; b--) {
			    				screenshotstring = screenshotstring+response[i][0].screenshots[b].cloudinary_id+', ';
			    			};
			    			screenshotstring = screenshotstring.substring(0, screenshotstring.length - 2);
			    		}

			    		// Handle websites
			    		if(response[i][0].websites != undefined){
			    			for (var c = response[i][0].websites.length - 1; c >= 0; c--) {
			    				websitestring = websitestring+response[i][0].websites[c].url+', ';
			    			};
			    			websitestring = websitestring.substring(0, websitestring.length - 2);
			    		}

			    		// Handle videos
			    		if(response[i][0].videos != undefined){
			    			for (var d = response[i][0].videos.length - 1; d >= 0; d--) {
			    				videostring = videostring+response[i][0].videos[d].video_id+', ';
			    			};
			    			videostring = videostring.substring(0, videostring.length - 2);
			    		}


			    		responsehtml = responsehtml+'<div data-videostring="'+videostring+'" data-websitestring="'+websitestring+'" data-screenshotstring="'+screenshotstring+'" data-alternativenamesstring="'+alternativenamesstring+'" data-pegistring="'+pegistring+'" data-esrbstring="'+esrbstring+'" data-summary="'+summary+'" data-themes="'+themestring+'" data-igdblink="'+igdblink+'" data-franchise="'+franchisestring+'" data-collection="'+collectionstring+'" data-perspectives="'+perspectivesstring+'" data-gamemodes="'+gamemodestring+'" data-criticrating="'+criticrating+'" data-rating="'+rating+'" data-publishers="'+publisherstring+'" data-developers="'+developerstring+'" data-platforms="'+platformstring+'" data-genre="'+genrestring+'" data-firstreleasedate="'+firstreleasedate+'" data-coverlink="'+coverimage+'" data-title="'+title+'" class="wpgamelist-add-game-search-column"><img class="wpgamelist-add-game-cover-image" src="'+coverimage+'"/><span class="helper"></span><div class="wpgamelist-add-game-search-title">'+title+'</div><div class="wpgamelist-add-game-plus-div"><img class="wpgamelist-add-game-plus-icon" src="<?php echo GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL; ?>add-game-plus.svg"/><br/>Add Game</div></div>'



			    		// Reset all collective strings for next run through main loop
			    		 genrestring = '';
				    	 publisherstring = '';
				    	 developerstring = '';
				    	 platformstring = '';
				    	 rating = '';
				    	 criticrating = '';
				    	 gamemodestring = '';
				    	 perspectivesstring = '';
				    	 franchisestring = '';
				    	 igdblink = '';
				    	 themestring = '';
				    	 summary = '';
				    	 esrbstring = '';
				    	 pegistring = '';

				    	 // Hidden values
				    	 alternativenamesstring = '';
				    	 screenshotstring = '';
				    	 websitestring = '';
				    	 videostring = '';
			    	};

			    	responsehtml = responsehtml+'</div>';
			    	$('#wpgamelist-addgame-search-success-div').html(responsehtml)


			    	// The function that will determine when all the cover images have loaded.
			    	$.fn.imagesLoaded = function () {

					    // get all the images (excluding those with no src attribute)
					    var $imgs = this.find('img[src!=""]');
					    // if there's no images, just return an already resolved promise
					    if (!$imgs.length) {return $.Deferred().resolve().promise();}

					    // for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
					    var dfds = [];  
					    $imgs.each(function(){

					        var dfd = $.Deferred();
					        dfds.push(dfd);
					        var img = new Image();
					        img.onload = function(){dfd.resolve();}
					        img.onerror = function(){dfd.resolve();}
					        img.src = this.src;

					    });

					    // return a master promise object which will resolve when all the deferred objects have resolved
					    // IE - when all the images are loaded
					    return $.when.apply($,dfds);

					}

					var height = 0;
					var tempheight = 0;
					$('.wpgamelist-add-game-search-row').imagesLoaded().then(function(){
			            $('.wpgamelist-add-game-search-column').each(function(){
				    		tempheight = parseInt($(this).css('height').replace('px',''));
			            	if(tempheight > height){
			            		height = tempheight;
			            	}
				    	})

			            $('.wpgamelist-add-game-search-column').css({'height':(height+5)+'px'})
			            $('.wpgamelist-add-game-search-title').css({'position':'absolute'})
			            $('.wpgamelist-add-game-search-row').animate({'opacity':'1'})
			            $('#wpgamelist-spinner-1').animate({'opacity':0})
			        });

					
			    	

			    	$('.wpgamelist-spinner-1').animate({'opacity':0})

			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_gamesearch_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_gamesearch_action_callback', 'security' );
	$gametitle = filter_var($_POST['gametitle'],FILTER_SANITIZE_STRING);
	
	require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
	$game_class = new WPGameList_Game('mainsearch', null, $gametitle, null);

	echo json_encode($game_class->searchresult);




	wp_die();
}

/*
// For adding a game from the admin dashboard
add_action( 'admin_footer', 'wpgamelist_boilerplate_action_javascript' );
add_action( 'wp_ajax_wpgamelist_boilerplate_action', 'wpgamelist_boilerplate_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_boilerplate_action', 'wpgamelist_boilerplate_action_callback' );


function wpgamelist_boilerplate_action_javascript() { 
	?>
  	<script type="text/javascript" >
  	"use strict";
  	jQuery(document).ready(function($) {
  		$(document).on("click","#wpgamelist-select-sort-div", function(event){

		  	var data = {
				'action': 'wpgamelist_boilerplate_action',
				'security': '<?php echo wp_create_nonce( "wpgamelist_boilerplate_action_callback" ); ?>',
			};
			console.log(data);

	     	var request = $.ajax({
			    url: ajaxurl,
			    type: "POST",
			    data:data,
			    timeout: 0,
			    success: function(response) {
			    	console.log(response);
			    },
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
		            console.log(textStatus);
		            console.log(jqXHR);
				}
			});

			event.preventDefault ? event.preventDefault() : event.returnValue = false;
	  	});
	});
	</script>
	<?php
}

// Callback function for creating backups
function wpgamelist_boilerplate_action_callback(){
	global $wpdb;
	check_ajax_referer( 'wpgamelist_boilerplate_action_callback', 'security' );
	//$var1 = filter_var($_POST['var'],FILTER_SANITIZE_STRING);
	//$var2 = filter_var($_POST['var'],FILTER_SANITIZE_NUMBER_INT);
	echo 'hi';
	wp_die();
}*/




?>