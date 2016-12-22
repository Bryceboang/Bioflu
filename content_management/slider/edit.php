<style type="text/css">
.cleditorMain{
 height:300px !important;
}
.imgsize{
  max-width: 100%;
}
.btn{
  padding: 0 5px;
  border-radius: 3px;
  margin-right: 5px;
}

.my-options{
  display: none !important;
}

.slider-settings{
  display: inline !important;
}
.preview{
  display: none !important;
}
</style>
<?php for ($i=1; $i < 22; $i++) { ?>

<div class="row row_<?php echo $i; ?> pad-5">



<div class="col-md-12 pad-5" >
<div class="col-md-2">Image <?php echo $i; ?></div>

<div class="col-md-10 pad-0" >
  <div class="col-md-12 pad-5" style = "position:absolute; text-align:right; z-index:1000">
<button data-id="<?php echo $i; ?>" class = "btn btn-primary editdata edit_<?php echo $i; ?>"><span  style = "margin-right:5px" class = " glyphicon glyphicon-pencil "></span>Edit Image</button>
<button data-id="<?php echo $i; ?>" class = "btn btn-danger removedata remove_<?php echo $i; ?>"><span  style = "margin-right:5px"class = " glyphicon glyphicon-remove "></span>Delete Image</button>
</div>
<div class="col-md-12 pad-5" style = "position:absolute; text-align:center; z-index:1000">
<button data-id="<?php echo $i; ?>" class = "btn btn-success adddata add_<?php echo $i; ?>"><span  style = "margin-right:5px" class = "glyphicon glyphicon-plus "></span>Select Image</button>
</div>

  <div class="col-md-12 pad-5" style = "border:2px dashed #ccc; text-align:center; min-height:35px;">
  <img class = "image<?php echo $i; ?> imgsize" src="">
  </div>
</div>
</div>

<div class="col-md-12 pad-5">
<div class="col-md-2">Image Title <?php echo $i; ?></div>
<div class="col-md-10 pad-0"><input type = "text" class = "image<?php echo $i; ?>alt fullwidth" value = ""></div>
</div>
<div class="col-md-12 pad-5">
<div class="col-md-2">Image Caption <?php echo $i; ?></div>
<div class="col-md-10 pad-0"><textarea class = "editor<?php echo $i; ?> image<?php echo $i; ?>cap fullwidth"></textarea></div>
</div>
<div class="col-md-12 pad-5" style = "border-bottom: 1px solid #ccc;">
<div class="col-md-2">Url Link <?php echo $i; ?></div>
<div class="col-md-10 pad-0"><input type = "text" class = "image<?php echo $i; ?>customlink fullwidth" value = ""></div>
</div>
</div>


<?php } ?>
<!-- <div data-numload = "4" class="col-md-12 pad-0 btn btn-primary loadmore" style = "text-align:center; margin-bottom:10px;">Load more</div> -->

<script type="text/javascript">
var x = 1;
while(x<22){
$(".editor"+x).cleditor(); 
x++;
}

// $(document).on('click', '.loadmore', function(){
//   var loadnum = $(this).attr('data-numload');
//   var loadmore = loadnum;
//   var ofset = parseInt(loadnum) + 3;
//   $(this).attr('data-numload', ofset);
//   while(loadmore<ofset){
//   $(".row_"+loadmore).show(); 
//  loadmore++;
// }
// });


// loadmore('4');
// function loadmore(loadmore){
// while(loadmore<22){
// $(".row_"+loadmore).hide(); 
// loadmore++;
// }
// }



var id = "<?php echo $_GET['id'];?>";
fetch_slider(id);
  function fetch_slider(id){
   
     $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_data_slider',
        data:{id: id},
      }).done( function(data){
       
          $('.list-modules').hide();
          $('.slider-images').show();
          $('.navigation').show();
          $('.navigation').html('<button style = "margin-right:5px" data-sliderid="'+id+'" class = "btn btn-min btn-success btn-save"><span class = "glyphicon glyphicon-edit"></span>Save</button><button class="preview btn-min btn btn-default" id="'+id+'"><span class = "glyphicon glyphicon-search"></span>Preview</button> <button class = "btn btn-min btn-default btn-close"><span class = "glyphicon glyphicon-remove-circle"></span>Close</button>');
          $('.slider-images').html('');
          $('.inactive').hide();
          $('.selectall').attr('checked', false);
          $('.select').attr('checked', false);

         var obj = JSON.parse(data);
         
         var htm = '';
          $.each(obj, function(index, row){ 
            if (row.image1 != '') {
              $('.remove_1').show();
              $('.edit_1').show();
              $('.add_1').hide();
            }
             else{ 
              $('.remove_1').hide();
              $('.edit_1').hide();
              $('.add_1').show();
              $('.image1').hide();
            }
            $('.image1').attr('src','../'+row.image1);
            $('.image1alt').val(row.image1alt);
            $('.image1cap').val(row.image1cap.replace(/\\images/g,'../images')).blur();
            $('.image1customlink').val(row.image1customlink);


            if (row.image2 != '') {
              $('.remove_2').show();
              $('.edit_2').show();
              $('.add_2').hide();
            }else{
            
              $('.remove_2').hide();
              $('.edit_2').hide();
              $('.add_2').show();
              $('.image2').hide();
            }
            $('.image2').attr('src','../'+row.image2);
            $('.image2alt').val(row.image2alt);
            $('.image2cap').val(row.image2cap.replace(/\\images/g,'../images')).blur();
            $('.image2customlink').val(row.image2customlink);


            if (row.image3 != '') {
              $('.remove_3').show();
              $('.edit_3').show();
              $('.add_3').hide();
            }else{
              $('.image3').hide();
              $('.remove_3').hide();
              $('.edit_3').hide();
              $('.add_3').show();
            }
            $('.image3').attr('src','../'+row.image3);
            $('.image3alt').val(row.image3alt);
            $('.image3cap').val(row.image3cap.replace(/\\images/g,'../images')).blur();
            $('.image3customlink').val(row.image3customlink);


            if (row.image4 != '') {
              $('.remove_4').show();
              $('.edit_4').show();
              $('.add_4').hide();
            }else{
              $('.image4').hide();
              $('.remove_4').hide();
              $('.edit_4').hide();
              $('.add_4').show();
            }
            $('.image4').attr('src','../'+row.image4);
            $('.image4alt').val(row.image4alt);
            $('.image4cap').val(row.image4cap.replace(/\\images/g,'../images')).blur();
            $('.image4customlink').val(row.image4customlink);

            if (row.image5 != '') {
              $('.remove_5').show();
              $('.edit_5').show();
              $('.add_5').hide();
            }else{
              $('.image5').hide();
              $('.remove_5').hide();
              $('.edit_5').hide();
              $('.add_5').show();
            }
            $('.image5').attr('src','../'+row.image5);
            $('.image5alt').val(row.image5alt);
            $('.image5cap').val(row.image5cap.replace(/\\images/g,'../images')).blur();
            $('.image5customlink').val(row.image5customlink);


             if (row.image6 != '') {
              $('.remove_6').show();
              $('.edit_6').show();
              $('.add_6').hide();
            }else{
              $('.image6').hide();
              $('.remove_6').hide();
              $('.edit_6').hide();
              $('.add_6').show();
            }
            $('.image6').attr('src','../'+row.image6);
            $('.image6alt').val(row.image6alt);
            $('.image6cap').val(row.image6cap.replace(/\\images/g,'../images')).blur();
            $('.image6customlink').val(row.image6customlink);

            if (row.image7 != '') {
              $('.remove_7').show();
              $('.edit_7').show();
              $('.add_7').hide();
            }else{
              $('.image7').hide();
              $('.remove_7').hide();
              $('.edit_7').hide();
              $('.add_7').show();
            }
            $('.image7').attr('src','../'+row.image7);
            $('.image7alt').val(row.image7alt);
            $('.image7cap').val(row.image7cap.replace(/\\images/g,'../images')).blur();
            $('.image7customlink').val(row.image7customlink);


            if (row.image8 != '') {
              $('.remove_8').show();
              $('.edit_8').show();
              $('.add_8').hide();
            }else{
              $('.image8').hide();
              $('.remove_8').hide();
              $('.edit_8').hide();
              $('.add_8').show();
            }
            $('.image8').attr('src','../'+row.image8);
            $('.image8alt').val(row.image8alt);
            $('.image8cap').val(row.image8cap.replace(/\\images/g,'../images')).blur();
            $('.image8customlink').val(row.image8customlink);


            if (row.image9 != '') {
              $('.remove_9').show();
              $('.edit_9').show();
              $('.add_9').hide();
            }else{
              $('.image9').hide();
              $('.remove_9').hide();
              $('.edit_9').hide();
              $('.add_9').show();
            }
            $('.image9').attr('src','../'+row.image9);
            $('.image9alt').val(row.image9alt);
            $('.image9cap').val(row.image9cap.replace(/\\images/g,'../images')).blur();
            $('.image9customlink').val(row.image9customlink);


            if (row.image10 != '') {
              $('.remove_10').show();
              $('.edit_10').show();
              $('.add_10').hide();
            }else{
              $('.image10').hide();
              $('.remove_10').hide();
              $('.edit_10').hide();
              $('.add_10').show();
            }
            $('.image10').attr('src','../'+row.image10);
            $('.image10alt').val(row.image10alt);
            $('.image10cap').val(row.image10cap.replace(/\\images/g,'../images')).blur();
            $('.image10customlink').val(row.image10customlink);
    
          
            // if (row.image11 != '') {
            //   $('.remove_11').show();
            //   $('.edit_11').show();
            //   $('.add_11').hide();
            // }
            //  else{ 
            //   $('.remove_11').hide();
            //   $('.edit_11').hide();
            //   $('.add_11').show();
            //   $('.image11').hide();
            // }
            // $('.image11').attr('src','../'+row.image11);
            // $('.image11alt').val(row.image11alt);
            // $('.image11cap').val(row.image11cap.replace(/\\images/g,'../images')).blur();
            // $('.image11customlink').val(row.image11customlink);


            // if (row.image12 != '') {
            //   $('.remove_12').show();
            //   $('.edit_12').show();
            //   $('.add_12').hide();
            // }else{
            
            //   $('.remove_12').hide();
            //   $('.edit_12').hide();
            //   $('.add_12').show();
            //   $('.image12').hide();
            // }
            // $('.image12').attr('src','../'+row.image12);
            // $('.image12alt').val(row.image12alt);
            // $('.image12cap').val(row.image12cap.replace(/\\images/g,'../images')).blur();
            // $('.image12customlink').val(row.image12customlink);


            // if (row.image13 != '') {
            //   $('.remove_13').show();
            //   $('.edit_13').show();
            //   $('.add_13').hide();
            // }else{
            //   $('.image13').hide();
            //   $('.remove_13').hide();
            //   $('.edit_13').hide();
            //   $('.add_13').show();
            // }
            // $('.image13').attr('src','../'+row.image13);
            // $('.image13alt').val(row.image13alt);
            // $('.image13cap').val(row.image13cap.replace(/\\images/g,'../images')).blur();
            // $('.image13customlink').val(row.image13customlink);


            // if (row.image14 != '') {
            //   $('.remove_14').show();
            //   $('.edit_14').show();
            //   $('.add_14').hide();
            // }else{
            //   $('.image14').hide();
            //   $('.remove_14').hide();
            //   $('.edit_14').hide();
            //   $('.add_14').show();
            // }
            // $('.image14').attr('src','../'+row.image14);
            // $('.image14alt').val(row.image14alt);
            // $('.image14cap').val(row.image14cap.replace(/\\images/g,'../images')).blur();
            // $('.image14customlink').val(row.image14customlink);

            // if (row.image15 != '') {
            //   $('.remove_15').show();
            //   $('.edit_15').show();
            //   $('.add_15').hide();
            // }else{
            //   $('.image15').hide();
            //   $('.remove_15').hide();
            //   $('.edit_15').hide();
            //   $('.add_15').show();
            // }
            // $('.image15').attr('src','../'+row.image15);
            // $('.image15alt').val(row.image15alt);
            // $('.image15cap').val(row.image15cap.replace(/\\images/g,'../images')).blur();
            // $('.image15customlink').val(row.image15customlink);


            //  if (row.image16 != '') {
            //   $('.remove_16').show();
            //   $('.edit_16').show();
            //   $('.add_16').hide();
            // }else{
            //   $('.image16').hide();
            //   $('.remove_16').hide();
            //   $('.edit_16').hide();
            //   $('.add_16').show();
            // }
            // $('.image16').attr('src','../'+row.image16);
            // $('.image16alt').val(row.image16alt);
            // $('.image16cap').val(row.image16cap.replace(/\\images/g,'../images')).blur();
            // $('.image16customlink').val(row.image16customlink);

            // if (row.image17 != '') {
            //   $('.remove_17').show();
            //   $('.edit_17').show();
            //   $('.add_17').hide();
            // }else{
            //   $('.image17').hide();
            //   $('.remove_17').hide();
            //   $('.edit_17').hide();
            //   $('.add_17').show();
            // }
            // $('.image17').attr('src','../'+row.image17);
            // $('.image17alt').val(row.image17alt);
            // $('.image17cap').val(row.image17cap.replace(/\\images/g,'../images')).blur();
            // $('.image17customlink').val(row.image17customlink);


            // if (row.image18 != '') {
            //   $('.remove_18').show();
            //   $('.edit_18').show();
            //   $('.add_18').hide();
            // }else{
            //   $('.image18').hide();
            //   $('.remove_18').hide();
            //   $('.edit_18').hide();
            //   $('.add_18').show();
            // }
            // $('.image18').attr('src','../'+row.image18);
            // $('.image18alt').val(row.image18alt);
            // $('.image18cap').val(row.image18cap.replace(/\\images/g,'../images')).blur();
            // $('.image18customlink').val(row.image18customlink);


            // if (row.image19 != '') {
            //   $('.remove_19').show();
            //   $('.edit_19').show();
            //   $('.add_19').hide();
            // }else{
            //   $('.image19').hide();
            //   $('.remove_19').hide();
            //   $('.edit_19').hide();
            //   $('.add_19').show();
            // }
            // $('.image19').attr('src','../'+row.image19);
            // $('.image19alt').val(row.image19alt);
            // $('.image19cap').val(row.image19cap.replace(/\\images/g,'../images')).blur();
            // $('.image19customlink').val(row.image19customlink);


            // if (row.image20 != '') {
            //   $('.remove_20').show();
            //   $('.edit_20').show();
            //   $('.add_20').hide();
            // }else{
            //   $('.image20').hide();
            //   $('.remove_20').hide();
            //   $('.edit_20').hide();
            //   $('.add_20').show();
            // }
            // $('.image20').attr('src','../'+row.image20);
            // $('.image20alt').val(row.image20alt);
            // $('.image20cap').val(row.image20cap.replace(/\\images/g,'../images')).blur();
            // $('.image20customlink').val(row.image20customlink);


            // if (row.image21 != '') {
            //   $('.remove_21').show();
            //   $('.edit_21').show();
            //   $('.add_21').hide();
            // }else{
            //   $('.image21').hide();
            //   $('.remove_21').hide();
            //   $('.edit_21').hide();
            //   $('.add_21').show();
            // }
            // $('.image21').attr('src','../'+row.image21);
            // $('.image21alt').val(row.image21alt);
            // $('.image21cap').val(row.image21cap.replace(/\\images/g,'../images')).blur();
            // $('.image21customlink').val(row.image21customlink);

            if (row.transition == 'fade') {
              $('.s-fade').attr('checked', true);
               $('.s-slide').attr('checked', false);
            }else{
              $('.s-fade').attr('checked', false);
               $('.s-slide').attr('checked', true);
            }

            if (row.direction == 'horizontal') {
              $('.horizontal').attr('checked', true);
               $('.vertical').attr('checked', false);
            }else{
              $('.horizontal').attr('checked', false);
               $('.vertical').attr('checked', true);
            }

            if (row.pauseOnHover == 'true') {
              $('.s-yes').attr('checked', true);
               $('.s-no').attr('checked', false);
            }else{
              $('.s-yes').attr('checked', false);
               $('.s-no').attr('checked', true);
            }

            if (row.load_jquery == ''){
              var jquery = 0;
            }else{
                  jquery = row.load_jquery;
            }

            $('.animSpeed').val(row.animSpeed);

            $('.pauseTime').val(row.pauseTime);

$('.transition').val(row.transition);
$('.direction').val(row.direction);
$('.pauseOnHover').val(row.pauseOnHover);

$('.load_jquery').val(jquery);
$('.initDelay').val(row.initDelay);
$('.randomize').val(row.randomize);
$('.target').val(row.target);
$('.enable_minheight').val(row.enable_minheight);
$('.min_height').val(row.min_height);
$('.slide_theme').val(row.slide_theme);
$('.bg_color').val(row.bg_color);
$('.theme_shadow').val(row.theme_shadow);
$('.theme_border').val(row.theme_border);
$('.theme_border_radius').val(row.theme_border_radius);
$('.directionNav').val(row.directionNav);
$('.controlNav').val(row.controlNav);
$('.positionNav').val(row.positionNav);
$('.colorNav').val(row.colorNav);
$('.colorNavActive').val(row.colorNavActive);
$('.bg_caption').val(row.bg_caption);
$('.transparency_caption').val(row.transparency_caption);
$('.position_caption').val(row.position_caption);
$('.text_align').val(row.text_align);
$('.color_caption').val(row.color_caption);
$('.imagefolder').val(row.imagefolder);
$('.moduleclass_sfx').val(row.moduleclass_sfx);
$('.cache').val(row.cache);
$('.cache_time').val(row.cache_time);
$('.cachemode').val(row.cachemode);
$('.module_tag').val(row.module_tag);
$('.bootstrap_size').val(row.bootstrap_size);
$('.header_tag').val(row.header_tag);
$('.header_class').val(row.header_class);
$('.style').val(row.style);

          }); 

     });  
  }


  $(document).on('click', '.editdata', function(){
    var data_id= $(this).data('id');
    filemanager();
     $('#select-image-modal').modal('show');
     $('.id-image').html(data_id);
  });


 $(document).on('click', '.adddata', function(){
    var data_id= $(this).data('id');
    filemanager();
     $('#select-image-modal').modal('show');
     $('.id-image').html(data_id);

  });

  $(document).on('click', '.removedata', function(){
    var data_id= $(this).data('id');
     $('.image'+data_id).attr('src','');
     $(this).hide();
     $('.edit_'+data_id).hide();
     $('.add_'+data_id).show();
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

$(document).on('click', '.image-file',  function(){
  var image = $(this).attr('src');
  var id = $('.id-image').html();
  var data_id = $(this).attr('data-id');
  $('.image'+id).attr('src',image);
  // var imgtrim ='';
  // imgtrim = image.replace('../','');
  // imgtrim = imgtrim.replace(/[\/]/g,'\\/');
  // $('.img_'+id).val(imgtrim);
  $('.check').hide();
  $('.check_'+data_id).show();
  $('.btn-insert').show();
  $('.image'+id).show();
  $('.edit_'+id).show();
  $('.remove_'+id).show();
  $('.add_'+id).hide();
});



$(document).on('click', '.btn-save',  function(){
var id = $('.btn-save').attr('data-sliderid');
alert($('.transition').val());
var x = 1;
var params = '';
var caption = '';
params+='{';
params+= '"load_jquery":"'+$('.load_jquery').val('0')+'",';
params+= '"pauseOnHover":"'+$('.pauseOnHover').val()+'",';
params+= '"initDelay":"'+$('.initDelay').val()+'",';
params+= '"randomize":"'+$('.randomize').val()+'",';
params+= '"target":"'+$('.target').val()+'",';
params+= '"enable_minheight":"'+$('.enable_minheight').val()+'",';
params+= '"min_height":"'+$('.min_height').val()+'",';
params+= '"slide_theme":"'+$('.slide_theme').val()+'",';
params+= '"bg_color":"'+$('.bg_color').val()+'",';
params+= '"theme_shadow":"'+$('.theme_shadow').val()+'",';
params+= '"theme_border":"'+$('.theme_border').val()+'",';
params+= '"theme_border_radius":"'+$('.theme_border_radius').val()+'",';
params+= '"directionNav":"'+$('.directionNav').val()+'",';
params+= '"controlNav":"'+$('.controlNav').val()+'",';
params+= '"positionNav":"'+$('.positionNav').val()+'",';
params+= '"colorNav":"'+$('.colorNav').val()+'",';
params+= '"colorNavActive":"'+$('.colorNavActive').val()+'",';
params+= '"transition":"'+$('.transition').val()+'",';
params+= '"direction":"'+$('.direction').val()+'",';
params+= '"animSpeed":"'+$('.animSpeed').val()+'",';
params+= '"pauseTime":"'+$('.pauseTime').val()+'",';
params+= '"bg_caption":"'+$('.bg_caption').val()+'",';
params+= '"transparency_caption":"'+$('.transparency_caption').val()+'",';
params+= '"position_caption":"'+$('.position_caption').val()+'",';
params+= '"text_align":"'+$('.text_align').val()+'",';
params+= '"color_caption":"'+$('.color_caption').val()+'",';
params+= '"imagefolder":"'+$('.imagefolder').val()+'",';
params+= '"moduleclass_sfx":"'+$('.moduleclass_sfx').val()+'",';
params+= '"cache":"'+$('.cache').val()+'",';
params+= '"cache_time":"'+$('.cache_time').val()+'",';
params+= '"cachemode":"'+$('.cachemode').val()+'",';
params+= '"module_tag":"'+$('.module_tag').val()+'",';
params+= '"bootstrap_size":"'+$('.bootstrap_size').val()+'",';
params+= '"header_tag":"'+$('.header_tag').val()+'",';
params+= '"header_class":"'+$('.header_class').val()+'",';


while(x<11){

var image = $('.image'+x).attr('src');
if (image == '../') {
  image = '';
}else{
  image = $('.image'+x).attr('src');
}

//Image
params += '"'+'image'+x+'":"'+  image.replace(/\//g,"\\/") +'",';

params += '"'+'image'+x+'alt":"'+  $('.image'+x+'alt').val() +'",';

caption = $('.image'+x+'cap').val();

params += '"'+'image'+x+'cap":"'+  caption.replace(/"/g, "\\\"").replace(/\n/g,"\\r\\n").replace(/\//g,"\\/") +'",';

params += '"'+'image'+x+'customlink":"'+  $('.image'+x+'customlink').val() +'",';

x++;
}
params+= '"style":"'+$('.style').val()+'"';
params+='}';
params = params.replace(/\...\//g,"");


   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=insertslider',
        data:{id: id, params: params},
      }).done( function(data){
        $('.msg').html('<p>Successfully saved...</p>');
         $('#success-modal').modal('show');
        });
});

$(document).on('click', '.btn-transition', function(){
  var value = $(this).attr('value');
  $('.transition').val(value);
});

$(document).on('click', '.btn-direction', function(){
  var value = $(this).attr('value');
  $('.direction').val(value);
});

$(document).on('click', '.btn-hover', function(){
  var value = $(this).attr('value');
  $('.pauseOnHover').val(value);
});

$(document).on('click','.btc2', function(){
  location.reload();
});

</script>