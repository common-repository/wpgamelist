jQuery( function ( $ ) { 
  "use strict";
  var amazonAuthYes = $("input[name='authorize-amazon-yes']");
  var amazonAuthNo = $("input[name='authorize-amazon-no']");
  var title = $( "input[name='game-title']" );
  var finishedYes = $("input[name='game-finished-yes']");
  var finishedNo = $("input[name='game-finished-no']");
  var signedYes = $("input[name='game-signed-yes']");
  var signedNo = $("input[name='game-signed-no']");
  var firstEditionYes = $("input[name='game-firstedition-yes']");
  var firstEditionNo = $("input[name='game-firstedition-no']");
  var useAmazonYes = $("input[name='use-amazon-yes']");
  var useAmazonNo = $("input[name='use-amazon-no']");
  var isbn = $( "input[name='game-isbn']" );
  var amazonAuthQuestion = $("#auth-amazon-question-label");
  var useAmazonYesLabel = $("label[for='use-amazon-yes']");
  var useAmazonNoLabel = $("label[for='use-amazon-no']");
  var useAmazonQuestion = $("#use-amazon-question-label");
  var titleLabel = $('#wpgamelist-addgame-label-gametitle');
  var isbnLabel = $("label[for='isbn']");
  var finishedYesLabel = $('#game-date-finished-label');
  var finishedYesInput = $('#wpgamelist-addgame-date-finished');
  var pubDate = $("input[name='game-pubdate']");
  var pageYes = $("#wpgamelist-addgame-page-yes");
  var pageNo = $("#wpgamelist-addgame-page-no");
  var postYes = $("#wpgamelist-addgame-post-yes");
  var postNo = $("#wpgamelist-addgame-post-no");
   
  // Initial check for Amazon Authorization
  if(amazonAuthYes.prop('checked') === true){
    amazonAuthYes.css({'opacity':'0.5', 'pointer-events':'none'});
    amazonAuthNo.css({'opacity':'0.5', 'pointer-events':'none'});
    $("label[for='authorize-amazon-no']").css({'opacity':'0.5', 'pointer-events':'none'});
    $("label[for='authorize-amazon-yes']").css({'opacity':'0.5', 'pointer-events':'none'});
    $('#wpgamelist-authorize-amazon-container p').css({'opacity':'0.5'});
  }

  // Reset Game Title color and font-weight
  title.click(function(){
    titleLabel.css({'color':'black', 'font-weight':'normal'});
    if(title.val() == 'Title Required!'){
      title.val('');
    }
  })

  // Toggle behavior for amazon authorization
  amazonAuthYes.click(function(e){
    amazonAuthQuestion.css({'color':'black', 'font-weight':'normal'});
    if($(this).prop('checked') === true){
      amazonAuthNo.prop('checked', false);
    }
  });
  amazonAuthNo.click(function(e){
    amazonAuthQuestion.css({'color':'black', 'font-weight':'normal'});
    if($(this).prop('checked') === true){
      isbnLabel.css({'color':'black', 'font-weight':'normal'});
      amazonAuthYes.prop('checked', false);
    }
  });

  // Toggle behavior for post
  $(document).on("click", '#wpgamelist-addgame-post-yes, #wpgamelist-editgame-post-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-post-no').prop('checked', false);
      $('#wpgamelist-editgame-post-no').prop('checked', false);
    }
  });
  $(document).on("click", '#wpgamelist-addgame-post-no, #wpgamelist-editgame-post-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-post-yes').prop('checked', false);
      $('#wpgamelist-editgame-post-yes').prop('checked', false);
    }
  });

  // Toggle behavior for page
  $(document).on("click", '#wpgamelist-addgame-page-yes, #wpgamelist-editgame-page-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-page-no').prop('checked', false);
      $('#wpgamelist-editgame-page-no').prop('checked', false);
    }
  });
  $(document).on("click", '#wpgamelist-addgame-page-no, #wpgamelist-editgame-page-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-page-yes').prop('checked', false);
      $('#wpgamelist-editgame-page-yes').prop('checked', false);
    }
  });

  // Toggle behavior for finished
$(document).on("click", '#wpgamelist-addgame-finished-yes, #wpgamelist-editgame-finished-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-finished-no').prop('checked', false);
      $('#wpgamelist-editgame-finished-no').prop('checked', false);
      $('#game-date-finished-label').animate({'opacity':1}, 500);
      $('#wpgamelist-addgame-date-finished').animate({'opacity':1}, 500);
      $('#wpgamelist-editgame-date-finished').animate({'opacity':1}, 500);
    }
  });
$(document).on("click", '#wpgamelist-addgame-finished-no, #wpgamelist-editgame-finished-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-finished-yes').prop('checked', false);
      $('#wpgamelist-editgame-finished-yes').prop('checked', false);
      $('#game-date-finished-label').animate({'opacity':0}, 500);
      $('#wpgamelist-addgame-date-finished').animate({'opacity':0}, 500);
      $('#wpgamelist-editgame-date-finished').animate({'opacity':0}, 500);
    }
  });


// Toggle behavior for lendable
$(document).on("click", '#wpgamelist-addgame-signed-yes, #wpgamelist-editgame-signed-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-signed-no').prop('checked', false);
      $('#wpgamelist-editgame-signed-no').prop('checked', false);
    }
  });
$(document).on("click", '#wpgamelist-addgame-signed-no, #wpgamelist-editgame-signed-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-signed-yes').prop('checked', false);
      $('#wpgamelist-editgame-signed-yes').prop('checked', false);
    }
  });


// Toggle behavior for lendable
$(document).on("click", '#wpgamelist-addgame-gameswapper-yes, #wpgamelist-editgame-gameswapper-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-gameswapper-no').prop('checked', false);
      $('#wpgamelist-editgame-gameswapper-no').prop('checked', false);
    }
  });
$(document).on("click", '#wpgamelist-addgame-gameswapper-no, #wpgamelist-editgame-gameswapper-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-gameswapper-yes').prop('checked', false);
      $('#wpgamelist-editgame-gameswapper-yes').prop('checked', false);
    }
  });


  // Toggle behavior for first edition
 $(document).on("click", '#wpgamelist-editgame-firstedition-yes, #wpgamelist-addgame-firstedition-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-firstedition-no').prop('checked', false);
      $('#wpgamelist-editgame-firstedition-no').prop('checked', false);
    }
  });
 $(document).on("click", '#wpgamelist-editgame-firstedition-no, #wpgamelist-addgame-firstedition-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-firstedition-yes').prop('checked', false);
      $('#wpgamelist-editgame-firstedition-yes').prop('checked', false);    
    }
  });

  // Toggle behavior for using Amazon
  $(document).on("click", 'input[name="use-amazon-yes"]', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-addgame-label-gametitle').css({'font-weight':'normal','color':'black'});
      $('#wpgamelist-editgame-label-gametitle').css({'font-weight':'normal','color':'black'});
      if($('#wpgamelist-editgame-label-gametitle').val() == 'Title Required!' ){
        $('#wpgamelist-editgame-label-gametitle').val('');
      }

      if($('#wpgamelist-addgame-label-gametitle').val() == 'Title Required!' ){
        $('#wpgamelist-addgame-label-gametitle').val('');
      }

      $('#use-amazon-question-label').css({'font-weight':'normal','color':'black'});
      $("input[name='use-amazon-no']").prop('checked', false);
    }
  });
  $(document).on("click", 'input[name="use-amazon-no"]', function(event){
    if($(this).prop('checked') === true){
      $("label[for='isbn']").css({'font-weight':'normal','color':'black'});
      if($("label[for='isbn']").val() == 'ISBN Required!' ){
        $("label[for='isbn']").val('');
      }
      $("#use-amazon-question-label").css({'font-weight':'normal','color':'black'});
      $("input[name='use-amazon-yes']").prop('checked', false);
    }
  });

  $(document).on("click", '#wpgamelist-editgame-isbn, #wpgamelist-addgame-isbn', function(event){
    if($('#wpgamelist-editgame-isbn').val() == 'ISBN Required!'){
      $('#wpgamelist-editgame-isbn').val('');
    }

    if($('#wpgamelist-addgame-isbn').val() == 'ISBN Required!'){
      $('#wpgamelist-addgame-isbn').val('');
    }

    $("label[for='isbn']").css({'color':'black', 'font-weight':'normal'});
  });

  // Toggle behavior for Amazon Authorization
  $(document).on("click", 'input[name="authorize-amazon-no"]', function(event){
    if($(this).prop('checked') === true){
      $('input[name="authorize-amazon-yes"]').prop('checked', false);
      $("#use-amazon-question-label").css({'font-weight':'normal','color':'black'});
      $("input[name='use-amazon-no']").css({'opacity':'0.5', 'pointer-events':'none'});
      $("input[name='use-amazon-yes']").css({'opacity':'0.5', 'pointer-events':'none'});
      $("label[for='use-amazon-yes']").css({'opacity':'0.5', 'pointer-events':'none'});
      $("label[for='use-amazon-no']").css({'opacity':'0.5', 'pointer-events':'none'});
      $("#use-amazon-question-label").css({'opacity':'0.5', 'pointer-events':'none'});
    }
  });

  // Toggle behavior for Amazon Authorization
  $(document).on("click", 'input[name="authorize-amazon-yes"]', function(event){
    if($(this).prop('checked') === true){
      $('input[name="authorize-amazon-no"]').prop('checked', false);
      $("input[name='use-amazon-no']").css({'opacity':'1', 'pointer-events':'all'});
      $("input[name='use-amazon-yes']").css({'opacity':'1', 'pointer-events':'all'});
      $("label[for='use-amazon-yes']").css({'opacity':'1', 'pointer-events':'all'});
      $("label[for='use-amazon-no']").css({'opacity':'1', 'pointer-events':'all'});
      $("#use-amazon-question-label").css({'opacity':'1', 'pointer-events':'all'});
    }
  });

  // Toggle behavior for WooCommerce Product checkboxes
  $(document).on("click", '#wpgamelist-woocommerce-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-no').prop('checked', false);
    }
  });
  $(document).on("click", '#wpgamelist-woocommerce-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-yes').prop('checked', false);
    }
  });

   // Toggle behavior for WooCommerce Virtual Product checkboxes
  $(document).on("click", '#wpgamelist-woocommerce-vert-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-vert-no').prop('checked', false);
    }
  });
  $(document).on("click", '#wpgamelist-woocommerce-vert-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-vert-yes').prop('checked', false);
    }
  });

     // Toggle behavior for WooCommerce Download Product checkboxes
  $(document).on("click", '#wpgamelist-woocommerce-download-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-download-no').prop('checked', false);
    }
  });
  $(document).on("click", '#wpgamelist-woocommerce-download-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-download-yes').prop('checked', false);
    }
  });

     // Toggle behavior for WooCommerce review checkboxes
  $(document).on("click", '#wpgamelist-woocommerce-review-yes', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-review-no').prop('checked', false);
    }
  });
  $(document).on("click", '#wpgamelist-woocommerce-review-no', function(event){
    if($(this).prop('checked') === true){
      $('#wpgamelist-woocommerce-review-yes').prop('checked', false);
    }
  });


  // Toggle effects for displaying WooCommerce fields
  $(document).on("click", '#wpgamelist-woocommerce-yes', function(event){
    if($(this).prop('checked') === true){
      $('.wpgamelist-woo-row').css({'display':'table-row'})
      $('.wpgamelist-woo-row').animate({'opacity':'1'})
      var price = $('#wpgamelist-addgame-price').val();
      $('#wpgamelist-addgame-woo-regular-price').val(price);
    } else {
      $('.wpgamelist-woo-row').animate({'opacity':'0'})
      $('.wpgamelist-woo-row').css({'display':'none'})
      $('#wpgamelist-addgame-woo-regular-price').val('');
    }
  });
  $(document).on("click", '#wpgamelist-woocommerce-no', function(event){
    if($(this).prop('checked') === true){
      $('.wpgamelist-woo-row').animate({'opacity':'0'})
      $('.wpgamelist-woo-row').css({'display':'none'})
      $('#wpgamelist-addgame-woo-regular-price').val('');
    }
  });

  // Toggle effects for displaying WooCommerce fields
  $(document).on("click", '#wpgamelist-woocommerce-download-yes, #wpgamelist-woocommerce-vert-yes', function(event){
    if($(this).prop('checked') === true){
      $('.wpgamelist-woo-row-upload').animate({'opacity':'1'})
      $('.wpgamelist-woo-row-upload').css({'display':'table-row'})
      $('#wpgamelist-addgame-woo-width').prop('disabled',true);
      $('#wpgamelist-addgame-woo-height').prop('disabled',true);
      $('#wpgamelist-addgame-woo-weight').prop('disabled',true);
      $('#wpgamelist-addgame-woo-length').prop('disabled',true);
      $('.game-woocommerce-label-dim').css({'opacity':'0.3'});
    } else {
      $('.wpgamelist-woo-row-upload').animate({'opacity':'0'})
      $('.wpgamelist-woo-row-upload').css({'display':'none'})
      $('#wpgamelist-addgame-woo-width').prop('disabled',false);
      $('#wpgamelist-addgame-woo-height').prop('disabled',false);
      $('#wpgamelist-addgame-woo-weight').prop('disabled',false);
      $('#wpgamelist-addgame-woo-length').prop('disabled',false);
      $('.game-woocommerce-label-dim').css({'opacity':'1'});
    }
  });

  // Toggle effects for displaying WooCommerce fields
  $(document).on("click", '#wpgamelist-woocommerce-download-no, #wpgamelist-woocommerce-vert-no', function(event){
    if($(this).prop('checked') === true){
      $('.wpgamelist-woo-row-upload').animate({'opacity':'0'})
      $('.wpgamelist-woo-row-upload').css({'display':'none'})
      $('#wpgamelist-addgame-woo-width').prop('disabled',false);
      $('#wpgamelist-addgame-woo-height').prop('disabled',false);
      $('#wpgamelist-addgame-woo-weight').prop('disabled',false);
      $('#wpgamelist-addgame-woo-length').prop('disabled',false);
      $('.game-woocommerce-label-dim').css({'opacity':'1'});
    } else {
    
    }
  });



  // Masks for various inputs, utililizing the jQuery Masked Input plugin
  $("input[name='game-pubdate']").mask("9999");
});


// Checks for missing data that is required to be answered to add game
function wpgamelist_add_game_validator(){
  "use strict";
  jQuery(document).ready(function($) {
    var isbn = $( "input[name='game-isbn']" );
    var isbnLabel = $("label[for='isbn']");
    var useAmazonQuestion = $("#use-amazon-question-label");
    var titleLabel = $('#wpgamelist-addgame-label-gametitle');
    var amazonAuthQuestion = $("#auth-amazon-question-label");
    var amazonAuthYes = $("input[name='authorize-amazon-yes']");
    var amazonAuthQuestion = $("#auth-amazon-question-label");
    var amazonAuthNo = $("input[name='authorize-amazon-no']");
    var useAmazonYes = $("input[name='use-amazon-yes']");
    var useAmazonNo = $("input[name='use-amazon-no']");
    var title = $( "input[name='game-title']" );
    var titleLabel = $('#wpgamelist-addgame-label-gametitle');
    var errorFlag = false;

    // Reset all form checks
    isbnLabel.css({'color':'black', 'font-weight':'normal'});
    useAmazonQuestion.css({'font-weight':'normal','color':'black'});
    titleLabel.css({'color':'black', 'font-weight':'normal'});
    amazonAuthQuestion.css({'color':'black', 'font-weight':'normal'});
    var scrollTop = 0;

    // Test ISBN for valid characters
    var isbnVal = isbn.val();
    isbnVal = isbnVal.replace('-','');
    isbnVal = isbnVal.replace(' ','');
    var isnum = /^\d+$/.test(isbnVal);
    if(isbnVal == ''){
      isbnLabel.css({'font-weight':'bold','color':'red'});
      scrollTop = isbnLabel.offset().top-50
    } else {
      isbn.val(isbnVal);
    }

    // Check Amazon Authorization
    if(amazonAuthYes.prop('checked') === false && amazonAuthNo.prop('checked') === false){
      amazonAuthQuestion.css({'font-weight':'bold','color':'red'});
      if(scrollTop > amazonAuthQuestion.offset().top-50){
        scrollTop = amazonAuthQuestion.offset().top-50
      }
      if(scrollTop == 0){
        scrollTop = amazonAuthQuestion.offset().top-50
      }
      errorFlag = true;
    }

    // Check Amazon Usage
    if(useAmazonYes.prop('checked') === false && useAmazonNo.prop('checked') === false && (amazonAuthYes.prop('checked') === true || amazonAuthNo.prop('checked') === true)){
      useAmazonQuestion.css({'font-weight':'bold','color':'red'});
      if(scrollTop > useAmazonQuestion.offset().top-50){
        scrollTop = useAmazonQuestion.offset().top-50
      } 
      if(scrollTop == 0){
        scrollTop = useAmazonQuestion.offset().top-50
      }
      errorFlag = true;
    }
    if(useAmazonYes.prop('checked') === true && (isbn.val() == '' || isbn.val() == undefined || isbn.val() == null)){
      isbn.val('ISBN Required!');
      isbnLabel.css({'color':'red', 'font-weight':'bold'});
      if(scrollTop > isbnLabel.offset().top-50){
        scrollTop = isbnLabel.offset().top-50
      }
      if(scrollTop == 0){
        scrollTop = isbnLabel.offset().top-50
      }
      errorFlag = true;
    }

    // Check Game Title
    if(useAmazonNo.prop('checked') === true && (title.val() == '' || title.val() == undefined)){
      titleLabel.css({'color':'red', 'font-weight':'bold'});
      title.val('Title Required!');

      if($("#wpgamelist-addgame-title").length == 0){
        scrollTop = $("#wpgamelist-editgame-title").offset().top-50;
      }

      if($("#wpgamelist-editgame-title").length == 0){
        scrollTop = $("#wpgamelist-addgame-title").offset().top-50;
      }

      console.log(scrollTop)
      errorFlag = true;
    }

    // Scroll the the highest flagged element 
    if(scrollTop != 0){
      $('html, body').animate({
        scrollTop: scrollTop
      }, 500);
      scrollTop = 0;
    }

    // DOM element that reports back on the form error state
    $('#wpgamelist-add-game-error-check').attr('data-add-game-form-error', errorFlag);

  });

}