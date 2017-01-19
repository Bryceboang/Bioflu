<div class="row">
<div class="col-md-12 list-data">
    <div class="table-responsive">
    <table class = "table listdata" style="margin-bottom:0px;">
    <thead>
    <tr>
    <th style = "width:10px;"><input class = "selectall" type = "checkbox"></th>
    <th>Image</th>
     <th>Title</th>
    <th>Status</th>
    <th>Edit</th>
    </tr>  
    </thead>
    <tbody>
    </tbody>
    </table>
    </div>
</div>

<div class = "col-md-12 single-data"></div>

<div class = "col-md-12 addnew-data"></div>

</div>

<script type="text/javascript">
                   
button();

 function button(){
    var htm = '';
    htm+='<button class="btn-addnew btn-min btn btn-primary"><span class = "glyphicon glyphicon-plus-sign"></span>Add new</button>';
    htm+='<button data-type = "Trash" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-trash"></span>Trash</button>';
    htm+='<button data-type = "Active" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-ok"></span>Active</button>';
    htm+='<button data-type = "Inactive" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Inactive</button>';
    // htm+='<button class="btn-list btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Close</button>';
    $('.btn-navigation').html(htm);
 }                      


  
  var limit = '10';
  var offset = '1';

  get_list(limit,offset);
  get_pagination('1',limit);


  $(document).on('change','.page-number', function() {
    var page_number = parseInt($(this).val());
      $('.listdata tbody').html('');
      get_list(limit,page_number);
  });

  $(document).on('click','.next-page', function() {
    var page_number = parseInt($('.page-number').val());
    var next = page_number +1;
    if(page_number!=last()){
      get_list(limit,next);
      $('.page-number').val(next);
    }
  });

  $(document).on('click','.last-page', function() {
    var page_number = parseInt($('.page-number').val());
    if(page_number!=last()){
      get_list(limit,last());
      $('.page-number').val($('.page-number option:last').val());
    }
  });

  $(document).on('click','.prev-page', function() {
    var page_number = parseInt($('.page-number').val());
    var prev = page_number -1;
    if(page_number!=first()){
      get_list(limit,prev);
      $('.page-number').val(prev);
    }
  });

  $(document).on('click','.first-page', function() {
    var page_number = parseInt($('.page-number').val());
    if(page_number!=first()){
      get_list(limit,first());
      $('.page-number').val($('.page-number option:first').val());
    }
  });

  function first(){
    return parseInt($('.page-number option:first').val());
  }

  function last(){
    return parseInt($('.page-number option:last').val());
  }

    function get_list(limit,offset){
    $('.delete').hide();
    $('.inactive').hide();
    $('.selectall').attr('checked', false);
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_article_more',
        data:{limit:limit, offset:offset},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 
            if(row.state==1){
              var status = 'Active';
            }
            else{
              var status = 'Inactive';
            }
              htm+="<tr>";
              htm+="<td><input class = 'select'  data-id = '"+row.id+"' type ='checkbox'></td>";
              htm+="<td><img style = 'width:60px;' src ='../"+row.image_path+"'/></td>";
              htm+="<td><p style='color:#3071a9'>"+row.title+"</p></td>";
              htm+="<td>"+status+"</td>";
              htm+="<td><a class='edit' data-status='"+row.state+"' id='"+row.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }

  function get_pagination(page_num,limit){
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_article_more_count',
        data:{limit:limit},
      }).done( function(data){
          var htm = '';
          htm += '<span class = "glyphicon glyphicon-step-backward first-page"></span><span class = "glyphicon glyphicon-triangle-left prev-page"></span><select class="page-number"> ';
          for(var x =1; x<=data; x++){
            htm += "<option value='"+x+"'>"+x+"</option>";
          }
          htm += '</select><span class = "glyphicon glyphicon-triangle-right next-page"></span><span class = "glyphicon glyphicon-step-forward last-page"></span>';

          $('.pagination').html('');
          $('.pagination').html(htm);
     }); 
  }

  $(document).on('click', '.edit',function(){
    $('.selectall').attr('checked',false);
    $('.select').attr('checked',false);
    $('.inactive').hide();
    $('.single-data').show();
    $('.list-data').hide();
    $('.pagination').hide();
    $('.btn-addnew').hide();
    $('.btn-list').hide();
    var id = $(this).attr('id');

    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_article_more',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
              htm+="<div class = 'col-md-12 pad-10'>";
              htm+="<label>Edit Featured Article</label>";
              htm+="</div>";    

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Image:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<div class = 'col-md-12 pad-0 btn-select-container'>";
              htm+="<button class = 'btn-select-thumb-image'>SELECT IMAGE</button>";
              // htm+="<button class = 'btn-del-img'>DELETE</button>";
              htm+="</div>";
              htm+="<img class = 'thumbimage' style = 'width:100%;' src ='../"+row.image_path+"'/>";
              htm+="<input class = 'thumbnailimage inputs' type = 'hidden' value = '"+row.image_path+"'>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Title:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'edit_title_id_text inputs' type = 'hidden' value = '"+row.article_id+"'>";
              htm+="<input class = 'edit_title_text inputs' type = 'text' value = '"+row.title+"'>";
              htm+="<button class = 'btn-select-article'>SELECT</button>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label>Status:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
                if(row.state==1){
                  var status = 'Active';
                }
                else{
                  var status = 'Inactive';
                }
              htm+="<select class = 'status inputs'>";
              htm+="<option value = '"+row.state+"'>"+status+"</option>";
              htm+="<option value = '1'>Active</option>";
              htm+="<option value = '0'>Inactive</option>";
              htm+="<option value = '-2'>Trash</option>";
              htm+="</select>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label></label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<button style = 'margin-right:5px;' class = 'btn btn-primary btn-min btn-update'  data-id = '"+row.id+"'>Update</button>";
              htm+="<button class = 'btn btn-default btn-min btn-cancel'  data-id = '"+row.id+"'>Cancel</button>";
              htm+="</div>";
              htm+="</div>";
           
            });
          $('.single-data').html('');
          $('.single-data').html(htm);
          // promotion_list();
     }); 

  });

$(document).on('click', '.btn-cancel', function(){
    $('.single-data').hide();
    $('.addnew-data').hide();
    $('.list-data').show();
    $('.pagination').show();
    $('.btn-addnew').show();
    $('.btn-list').show();
});


$(document).on('click', '.btn-update', function(){
  var id = $(this).attr('data-id');
  var image_path = $('.thumbnailimage').val();
  image_path = image_path.replace(/\..\/images/g,'images');
  var article_id = $('.edit_title_id_text').val();
  var state = $('.status').val();

    var counter = 0;
    $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              $(this).siblings().show();
              counter++;
            }else{
              // $(this).siblings().hide();
            }
        });

  if(counter == 0){
     $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=update_article_more',
        data:{id:id, image_path: image_path, article_id: article_id, state: state},
      }).done( function(data){
        $('.msg').html('Successfully Updated...');
        $('#success-modal').modal('show');
        // $('.thumbimage').show();
        get_list(limit,offset);
        get_pagination('1',limit);
        });
   }
});

  $('.selectall').click(function(){

     if(this.checked) { 
            $('.select').each(function() { 
                this.checked = true;  
                $('.delete').show();
                $('.inactive').show();           
            });
        }else{
            $('.select').each(function() { 
              $('.delete').hide();
                $('.inactive').hide();
                this.checked = false;                 
            });         
        }

  });

   $(document).on('click', '.select', function(){
    var x = 0;
   
    
          $('.select').each(function() {                
                if (this.checked==true) {

                  x++;
                } 
          
                if (x > 0 ) {
                   $('.delete').show();
                   $('.inactive').show(); 
                }
              else{
                $('.delete').hide();
                $('.inactive').hide();
                $('.selectall').attr('checked', true);
              }
            });

  });

    $(document).on('click', '.inactive', function(){
    var x = 0;
    var data_type = $(this).attr('data-type');
      $('.select').each(function() {                
          if (this.checked==true) {
             x++;
          } 

          if (x > 0 ) {
            $('.modal-footer .btn-close').hide();
            $('.msg').html('<p>Are you sure you want to '+data_type+' this record? <button data-type = "'+data_type+'" class = "btn-remove"> Yes </button><button class = "btn-close2"> No </button></p>');
            $('#success-modal').modal('show');

          }

      });
   });

    $(document).on('click', '.btn-remove', function(){
    var x = 0;
    var type = $(this).attr('data-type');
    if (type == 'Trash') {
      var type = '-2';
    }
    if (type == 'Inactive') {
      var type = '0';
    }

    if (type == 'Active') {
      var type = '1';
    }
      $('.select').each(function() {                
          if (this.checked==true) {
            
             var id = $(this).attr('data-id');

             
              $.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=update_article_more_status',
                  data:{id:id, status:type},
                }).done( function(data){
                  $('#success-modal').modal('hide');
                    get_list(limit,offset);
                    get_pagination('1',limit);
                  });

             x++;
          } 

        

      });
   });


$('.btn-addnew').click(function(){
    $('.selectall').attr('checked',false);
    $('.select').attr('checked',false);
    $('.inactive').hide();
    $('.single-data').hide();
    $('.list-data').hide();
    $('.pagination').hide();
    $('.btn-addnew').hide();
    $('.btn-list').hide();
    $('.addnew-data').show();

              var htm = '';
              htm+="<div class = 'col-md-12 pad-10'>";
              htm+="<label>Add Featured Article</label>";
              htm+="</div>";    

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Image:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<div class = 'col-md-12 pad-0'>";
              htm+="<button class = 'btn-select-thumb-image'>SELECT IMAGE</button>";
              // htm+="<button class = 'btn-del-img'>DELETE</button>";
              htm+="</div>";
              htm+="<img class = 'thumbimage' style = 'width:100%; display:none' src =''/>";
              htm+="<input class = 'thumbnailimage inputs' type = 'hidden' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Please select image</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Title:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              
              htm+="<input class = 'edit_title_text' type = 'text' value = ''>";
              htm+="<button class = 'btn-select-article'>SELECT</button>";
              htm+="<input class = 'edit_title_id_text inputs' type = 'hidden' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Please select artilce</span>";
              htm+="</div>";
              htm+="</div>";

              

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label>Status:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<select class = 'status inputs'>";
              htm+="<option value = '1'>Active</option>";
              htm+="<option value = '0'>Inactive</option>";
              htm+="<option value = '-2'>Trash</option>";
              htm+="</select>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label></label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<button style = 'margin-right:5px;' class = 'btn btn-primary btn-min btn-saved'>Save</button>";
              htm+="<button class = 'btn btn-default btn-min btn-cancel'>Cancel</button>";
              htm+="</div>";
              htm+="</div>";
            $('.addnew-data').html(htm);

});

$(document).on('click', '.btn-saved', function(){

  var image_path = $('.thumbnailimage').val();
  image_path = image_path.replace(/\..\/images/g,'images');
  var article_id = $('.edit_title_id_text').val();
  var state = $('.status').val();

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
        url: 'dashboard.php?function=saved_article_more',
       data:{image_path: image_path, article_id: article_id, state: state},
      }).done( function(data){
        $(this).attr('disabled', true);
        $('.msg').html('Successfully Saved...');
        $('#success-modal').modal('show');
        get_list(limit,offset);
        get_pagination('1',limit);
        });
    }
});




 function promotion_list(){
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_promolist',
        data:{},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 

              htm+="<option value = '"+row.promotion_id+"'>"+row.promotion_name+"</td>";
          
            });
          $('.promotion-list option').after('');
          $('.promotion-list option').after(htm);
     }); 
  }


$(document).on('click', '.btn-select-thumb-image', function(){
    $('.c-copy').hide();
    thumb_filemanager();
    $('#select-thumbnail-modal').modal('show');

});

function thumb_filemanager(){
   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getimages',
        data:{},
      }).done( function(data){
        $('.file-manager').html(data);
      }); 
  }

  $(document).on('click', '.image-file', function(){
        var img = $(this).attr('src');
        $('.pathtocopy').val(img);
         $('.pathtocopy').show();
        $('.btn-insert-video').show();
        $('.c-copy').attr('style','display:inline');
     });

    $('.btn-insert-thumbnail').click(function(){
    var path = $('.pathtocopy').val();
    $('.thumbimage').attr('src', path).show();
    $('.thumbnailimage').val(path);
  });

    $(document).on('click', '.image-file',  function(){
  var image = $(this).attr('src');
  var id = $('.id-image').html();
  var data_id = $(this).attr('data-id');
  $('.img_'+id).attr('src',image);
  var imgtrim ='';
  imgtrim = image.replace('../','');
  imgtrim = imgtrim.replace(/[\/]/g,'\\/');
  $('.img_'+id).val(imgtrim);
  // $('.check').hide();
  $('.check_'+data_id).show();
  $('.c-copy').show();
  $('.img_'+id).show();
});


$(document).on('click', '.btn-select-article', function(){

 $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_select_article',
        data:{},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
              htm+="<tr>";
              htm+="<td><a class = 'article-title' data-id = '"+row.id+"'>"+row.title+"</a></td>";
              htm+="<td>"+row.alias+"</td>";
              htm+="</tr>";    
              });
           $('.list-articles').html('');
          $('.list-articles').html(htm);
     }); 

      $('#modal-select-article').modal('show');
    });

$(document).on('click', '.article-title', function(){
  $('.edit_title_text').val($(this).html());
  $('.edit_title_id_text').val($(this).data('id'));
  $('#modal-select-article').modal('hide');
});
</script>