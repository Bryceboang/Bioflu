<style type="text/css">

.save {

  display: none;

}

.pagination{

  display: none;

}

.img_add{

  display: inline !important;

}

.inactive{

  display: none !important;

}

.other-content{

  display: block !important;

}

.start-pub,.end-pub,.hit,.cat-set{

  display: none;

}

.feat{

  display: block !important;

}

</style>

<div class="col-md-12">



<div class="col-md-12 pad-5">

    <div class="col-md-2">Title: </div>

    <div class = "col-md-10"><input type = "text" class = "titles fullwidth inputs"><span class = "er-msg">Title should not be empty *</span></div>

</div>



<div class="col-md-12 pad-5">

    <div class="col-md-2">Short Description: </div>

    <div class = "col-md-10"><input type = "text" class = "description fullwidth"><span class = "er-msg">Description should not be empty *</span></div>

</div>



<div class="col-md-12 pad-5">

    <div class="col-md-2">Thumbnail</div>

    <div class = "col-md-10">

      <button class = "btn btn-success btn-standard btn-select-image"><span class = "glyphicon glyphicon-pencil  right-5"></span>Edit Image</button>

      <div class="col-md-12 pad-0 selected-image">

        <input style = "" class = "imgsrc inputs" value=""/><span class = "er-msg">Image should not be empty *</span></div>

    </div>

</div>



<div class="col-md-12 pad-5">

    <div class="col-md-2">Video</div>

    <div class = "col-md-10">

      <button class = "btn btn-success btn-standard btn-select-video"><span class = "glyphicon glyphicon-pencil  right-5"></span>Edit Video</button><span> Recommended file size: 6 Megabytes</span>

      <div class="col-md-12 pad-0 selected-video">

        <input style = "" class = "vidsrc inputs" value=""/><span class = "er-msg">Video should not be empty *</span></div>

    </div>

</div>







<!-- <div class="col-md-12 pad-5">

    <div class="col-md-2">Url:  (Optional)</div>

    <div class = "col-md-10"><input type = "text" class = "url fullwidth"></div>

</div> -->



</div>



<script type="text/javascript">

var id = "<?php echo $_GET['id'];?>";



 on_load(id);





      function on_load(id){

        $.ajax({

        type: 'Post',

        url: 'dashboard.php?function=edit_videogallery',

        data:{id:id},

      }).done( function(data){

          var obj = JSON.parse(data);

          $.each(obj, function(index, row){

              $('.selected-image').html(' <img src="../images/bioflu/'+row.thumbnail+'"><input style = "display:none" class = "imgsrc inputs" value="'+row.thumbnail+'"/>');

              $('.selected-video').html(' <video width="100%" controls autoplay><source src="../images/videos/'+row.path+'" type="video/mp4"></video><input style = "display:none" class = "vidsrc inputs" value="'+row.path+'"/>');

              $('.titles').val(row.title);

              $('.status option[value="'+row.status+'"]').attr('selected','selected');

              if(row.status != 0){

                $('.featured').prop('disabled',false);

              }else{

                $('.featured').prop('disabled',true);

              }

              $('.featured option[value="'+row.is_featured+'"]').attr('selected','selected');

              $('.description').val(row.description);

              // $('.url').val(row.url);

          });

     });      

      }







$('.btn-select-image').click(function(){

  $('.c-copy').hide();

filemanager();

$('#select-image-modal').modal('show');

});







$('.btn-select-video').click(function(){

  $('.c-copy').hide();

videomanager();

$('#select-video-modal').modal('show');

});





function filemanager(){

   $.ajax({

        type: 'Post',

        url: 'dashboard.php?function=getimages',

        data:{},

      }).done( function(data){

        $('.file-manager').html(data);

      }); 

}





function videomanager(){

   $.ajax({

        type: 'Post',

        url: 'dashboard.php?function=getmodalvideos',

        data:{},

      }).done( function(data){

        $('.video-manager').html(data);

      }); 

}



 $(document).on('click', '.image-file', function(){

        var img = $(this).attr('src');

        $('.pathtocopy').val(img);

        $('.pathtocopy').show();

        $('.btn-insert-video').show();



     });



 // $(document).on('click', '.btn-copy', function(){

 //  var pathtocopy = $('.pathtocopy').val();

 //  $('.selected-image' ).html('<img class = "imgsrc" src="'+pathtocopy+'"/><input style = "display:none" class = "imgsrc inputs" value="'+pathtocopy+'"/>');

 // });



 $(document).on('click', '.update', function(){

  var feat = $('.featured').val();

  var desc = $('.description').val();

  var video = $('.vidsrc').val();

  var image = $('.imgsrc').val();

  var title = $('.titles').val();

  var status = $('.status').val();

  // var url = $('.url').val();

  var counter = 0; 

$('.inputs').each(function(){

            var input = $(this).val();

            if (input.length == 0) {

              $(this).next().show();

              counter++;

            }else{

              $(this).next().hide();

            }

        });



if(counter == 0){



  $.ajax({

          type: 'Post',

          url: 'dashboard.php?function=update_videogallery',

          data:{video:video, image:image, title:title, status: status, id: id, desc:desc,feat:feat},

        }).done( function(data){

             $('#success-modal').modal('show');

       }); 



      }

 });

$(document).on('click','.btn-copy', function(){

  var pathtocopy = $('.pathtocopy').val();

  var imgsrc = pathtocopy.split('/').pop();

  $('.selected-image').html('<img src="'+pathtocopy+'"><input style = "display:none" class = "imgsrc inputs" value="'+imgsrc+'"/>');

  $('#select-image-modal').modal('hide');

});



$(document).on('click', '.btn-insert-video', function(){

  var pathtocopy = $('.pathtocopy').val();

  var vidsrc = pathtocopy.split('/').pop();

  $('.selected-video').html('<video width="100%" controls autoplay><source src="'+pathtocopy+'" type="video/mp4"></video><input style = "display:none" class = "vidsrc inputs" value="'+vidsrc+'"/>');

  $('#select-video-modal').modal('hide');

 });

$(document).on('click','.btc2', function(){

location.reload();

});



$(document).on('change','.status', function(){

var status = $(this).val();



if(status == 0 || status == -2){

  $('.featured').prop('disabled',true);

}else{

  $('.featured').prop('disabled',false);

}



});

</script>



    





      

