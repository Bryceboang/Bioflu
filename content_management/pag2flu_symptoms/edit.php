<?php 
  $table = "pag2flu_symptoms";
  $field = "id";
?>

<link rel="stylesheet" type="text/css" href="./css/edit.css">
<script type="text/javascript" src="./js/cms.js"></script>

<div class="col-md-12">


 <div class="col-md-12 pad-5">
    <div class="col-md-2">Symptoms Name: </div>
     <div class = "col-md-10"><input type = "text" class = "s_name fullwidth inputs"><span class = "er-msg">Name should not be empty *</span></div>
  </div>

  <div class="col-md-12 pad-5">
    <div class="col-md-2">Active Icon: </div>
    <div class = "col-md-10"><button class = "btn btn-success btn-standard btn-select-image-2"><span class = "glyphicon glyphicon-plus right-5"></span>Select Image</button></div>
  </div>
  <div class="col-md-12 pad-5">
      <div class="col-md-2"></div>
      <div class = "col-md-10 selected-image-2"><input style = "display:none" class = "image2 inputs" value=""/><span class = "er-msg">Image should not be empty *</span></div>
  </div>

  <div class="col-md-12 pad-5">
    <div class="col-md-2">Inactive Icon: </div>
    <div class = "col-md-10"><button class = "btn btn-success btn-standard btn-select-image-3"><span class = "glyphicon glyphicon-plus"></span>Select Thumbnail</button></div>
  </div>
  <div class="col-md-12 pad-5">
      <div class="col-md-2"></div>
      <div class = "col-md-10 selected-image-3"><input style = "display:none" class = "image3 inputs" value=""/><span class = "er-msg">Thumbnail should not be empty *</span></div>
  </div>

  <div class="col-md-12 pad-5">
    <div class="col-md-2">Alias: </div>
     <div class = "col-md-10"><input type = "text" class = "s_alias fullwidth inputs"><span class = "er-msg">Alias should not be empty *</span></div>
  </div>


</div>

<script type="text/javascript">



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


 var id = "<?php echo $_GET['id'];?>";

 on_load(id);

      function on_load(id){
        var test = id;
        var limit = 1;

        var table = "<?=$table;?>";
        var field = "<?=$field;?>";

        $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_global',
        data:{id:test,limit:limit, table:table, field:field},
      }).done( function(data){
          var obj = JSON.parse(data);
          
          $.each(obj, function(index, row){    
               // $('.selected-image-1').html('<span class = "glyphicon glyphicon-remove btn-remove-video"></span><video width="100%" controls><source src="../'+row.video+'" type="video/mp4"></video><input style = "display:none" class = "image1 inputs" value="'+row.video+'"/>');    
               // $('.selected-image-1').html('<img class = "image1" src="../'+row.video+'"><input style = "display:none" class = "image1 inputs" value="'+row.video+'"/>');  
                $('.selected-image-2').html('<span class = "glyphicon glyphicon-remove btn-remove-image"></span><img class = "image2" src="../'+row.icon_active+'"><input style = "display:none" class = "image2 inputs" value="'+row.icon_active+'"/>');
                $('.s_name').val(row.name);
                $('.s_alias').val(row.alias);
                $('.selected-image-3').html('<span class = "glyphicon glyphicon-remove btn-remove-image1"></span><img class = "image3" width="100%" src="../'+row.icon_inactive+'"><input style = "display:none" class = "image3 inputs" value="'+row.icon_inactive+'"/>');
                // $('.youtubevideoid').val(row.video_id);
                // $('.youtubelink').val(row.video_link);
          });
     });      
}

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

 $(document).on('click', '.update', function(){

  var alias = $('.s_alias').val();
  var name = $('.s_name').val();
  var active = $('.image2').attr('src');
  var inactive = $('.image3').attr('src');

  if(validateFields() == 0){

  $.ajax({
          type: 'Post',
          url: 'dashboard.php?function=pag2flu_symptoms',
          data:{alias:alias,name:name,active:active,inactive:inactive,id:id,  action: 'update'},
        }).done( function(data){
          
          $('.msg').html('<d>Successfully saved...</d>');
          $('#success-modal').modal('show');
  }); 

  }

 });


</script>


      
