<?php
    define( '_JEXEC', 1 );
    define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../../' ));  
    require_once ( JPATH_BASE .'/includes/defines.php' );
    require_once ( JPATH_BASE .'/includes/framework.php' );

    $mainframe = JFactory::getApplication('site');

    require_once ( JPATH_BASE .'/includes/defines.php' );
?>

<link rel="stylesheet" type="text/css" href="./css/add.css">
<script type="text/javascript" src="./js/cms.js"></script>

<div class="col-md-12">

  <div class="col-md-12 pad-5">
    <div class="col-md-2">Image: </div>
    <div class = "col-md-10"><button class = "btn btn-success btn-standard btn-select-image-2"><span class = "glyphicon glyphicon-plus right-5"></span>Select Image</button></div>
  </div>
  <div class="col-md-12 pad-5">
      <div class="col-md-2"></div>
      <div class = "col-md-10 selected-image-2"><input style = "display:none" class = "image2 inputs" value=""/><span class = "er-msg">Image should not be empty *</span></div>
  </div>



 <div class="col-md-12 pad-5">
    <div class="col-md-2">Title: </div>
     <div class = "col-md-10"><input type = "text" class = "mytitle fullwidth inputs"><span class = "er-msg">Title should not be empty *</span></div>
  </div>


  <div class="col-md-12 pad-5">
    <div class="col-md-2">Description: </div>
    <div class = "col-md-10"><textarea name="text" type = "text" class = "mytext fullwidth"></textarea><span class = "er-msg-desc">Text should not be empty *</span></div>
  </div>


  <div class="col-md-12 pad-5">
    <div class="col-md-2">Tags: </div>
     <div class = "col-md-10"><input type = "text" class = "mytags fullwidth inputs"><span class = "er-msg">Title should not be empty *</span></div>
  </div>

<div class="col-md-12 pad-5">
    <div class="col-md-2">Date Published: </div>
    <div class = "col-md-10"><input id="datepicker" type = "text" class = "b_published fullwidth inputs"><span class = "er-msg">Date Published should not be empty *</span></div>
    
</div>


</div>

<script type="text/javascript">
$(".mytext").cleditor();

  $(document).ready(function () {
      $("#datepicker").datepicker({
          yearRange: '-50:-10',
          changeMonth: true,
          changeYear: true,
          minDate:"-50Y",
          showOtherMonths: true,
          maxDate:"-10Y" 
      });
  });


  $(document).on('click', '.btn-remove-video', function(){
    $('.selected-image-1').html('');
    $('.image1').val('');
  });


  $(document).on('click', '.btn-remove-image', function(){
    $('.selected-image-2').html('');
    $('.image2').val('');
  });

  $(document).on('click', '.btn-remove-image1', function(){
    $('.selected-image-3').html('');
    $('.image3').val('');
  });



  $(document).on('click', '.btn-select-image-1', function(){
    $('.c-insert').hide();
    videomanager();
    $('#select-video-modal').modal('show');
  });



  $(document).on('click', '.video-file', function(){
      var id = $('.id-image').html();
      var data_id = $(this).attr('data-id');
      var img = $(this).attr('src');
        $('.pathtocopy').val(img);
        $('.c-copy').show();
        $('.check').hide();
        $('.check_'+data_id).show();
        $('.btn-insert-video').show();
  });

$(document).on('click', '.btn-insert-video', function(){
  var data_val = $('.btn-insert-video').val();
  var pathtocopy = $('.pathtocopy').val();
  $('.selected-image-1').html('<span class = "glyphicon glyphicon-remove btn-remove-video"></span><video width="100%" controls><source src="'+pathtocopy+'" type="video/mp4"></video><input style = "display:none" class = "image1 inputs" value="'+pathtocopy+'"/>');
  $('#select-video-modal').modal('hide');
 });

function videomanager(){
   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getmodalvideos',
        data:{},
      }).done( function(data){
        $('.video-manager').html(data);
      }); 
}




function selectImg(selector1, selector2) {
      $('.c-copy').hide();
      filemanager();
      $('#select-image-modal').modal('show');
      $('.btn-copy').addClass(selector1);
      $('.btn-copy').removeClass(selector2);
}

function insertImg(selector1, selector2 ,imgclass) {
   var pathtocopy = $('.pathtocopy').val();
   $('.'+selector2).html('<img class="'+imgclass+'" src="'+pathtocopy+'"/><input style = "display:none" class = "'+imgclass+' inputs" value="'+pathtocopy+'"/>');
   $('#select-image-modal').modal('hide');
   $('.btn-copy').removeClass(selector1);
}

/*connected*/
// $('.btn-select-image-1').click(function(){
//       selectImg('image1_click', 'image2_click');
// });
 $(document).on('click', '.image1_click', function(){
      insertImg('image1_click', 'selected-image-1', 'image1');
});
/**/

$('.btn-select-image-2').click(function(){
      selectImg('image2_click', 'image1_click');
});

$('.btn-select-image-3').click(function(){
      selectImg('image3_click', 'image1_click');
});

$(document).on('click', '.image2_click', function(){
      insertImg('image2_click', 'selected-image-2', 'image2');
});


$(document).on('click', '.image3_click', function(){
      insertImg('image3_click', 'selected-image-3', 'image3');
});




function validateFields() {

      var counter = 0;

      if($('.mytext').val() == ''){
                $('.er-msg-desc').show();
                counter++;
      } else{
          $('.er-msg-desc').hide();
      }

      $('.inputs').each(function(){
          var input = $(this).val();
          if (input.length == 0) {
            $(this).next().show();
            counter++;
          }else{
            $(this).next().hide();
          }
      });

    return counter;
}


 $(document).on('click', '.save', function(){

  var mytitle = $('.mytitle').val();
  var mytext = $('.mytext').val();
  var image2 = $('.image2').attr('src');
  var mytags = $('.mytags').val();
  var date_published = $('#datepicker').val();
  var cat_type = 1;

  
  if(validateFields() == 0){

      $.ajax({
              type: 'Post',
              url: 'dashboard.php?function=pag2flu_articles',
              data:{cat_type:cat_type,mytitle:mytitle, mytext:mytext, image2:image2, mytags:mytags, date_published:date_published ,  action: 'save'},
            }).done( function(data){
              
                $('#success-modal').modal('show');
              //  location.reload();
      }); 
  }

 });

</script>
