<style type="text/css">
.c-copy {
  display: none !important;
}  

.cleditorMain{
  height: 240px !important;
  overflow: hidden;
}
.slider-settings{
  display: none !important;
}
</style>

<div class="row">

<div class="col-md-12 slider-images">

</div>

	<div class="col-md-12 list-modules">

    

		<div class="table-responsive ">

			<table class = "table listdata">
          <thead>
            <tr>
               <th style = "width:10px;"><input class = "selectall" type = "checkbox"></th>
            <th>Title</th>
            <th>Status</th>
            <th>Edit</th>
          </tr>  
          </thead>
          <tbody>
            
          </tbody>
        

			</table>
		</div>
    <div class="pagination">
      
    </div>

	</div>

</div>



<script>
 
$(document).ready(function() {



  function get_pagination(page_num,limit){
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_articles_count',
        data:{limit:limit},
      }).done( function(data){
          var htm = '';
          htm += '<button class="first-page"><<</button><button class="prev-page"><</button><select class="page-number">';
          for(var x =1; x<=data; x++){
            htm += "<option value='"+x+"'>"+x+"</option>";
          }
          htm += '</select><button class="next-page">></button><button class="last-page">>></button>';

          $('.pagination').html('');
          $('.pagination').html(htm);
     }); 
  }

get_slider();
  function get_slider(){
    $('.inactive').hide();
     $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_slider',
        data:{},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 
            if(row.published==1){
              var status = 'Published';
            }
            else{
              var status = 'Unpublished';
            }
              htm+="<tr>";
              htm+="<td><input class = 'select' data-id = '"+row.id+"' type ='checkbox'></td>";
              htm+="<td>"+row.title+"</td>";
              htm+="<td>"+status+"</td>";
              htm+="<td><a class='edit' data-id='"+row.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }




  $('.btn-close').click(function() {

    $('.article_add').show();

    $(this).hide();


    $('.content-container').load('slider/list.php');

  });

// $(document).on('click', '.btn-save',  function(){
//   var x = 1;
//   var feature = '';

//   // alert($('.imagecap_1').val());

//   var otherfields = $('.otherfields').val();

//   while(x<=21){
//   feature += '"' + 'image'+x+'alt":"' +  $('.imagealt_'+x).val() +'",';


//   feature += '"' + 'image'+x+'cap":"' + $('.imagecap_'+x).val()+'",';
//   if ($('.image_'+x).val() == undefined) {
//     feature += '"' + 'image'+x+'":"",';
//   }else{
//     feature += '"' + 'image'+x+'":"' + $('.image_'+x).val()+'",';
//   }
  
//   feature += '"' + 'image'+x+'customlink":"' + $('.imagecustomlink_'+x).val()+'",';
//   x++;
// }

// // alert('{'+feature+otherfields+'}');

// var params = '{'+feature+otherfields+'}';
// var id = $('.btn-save').attr('data-sliderid');

// params = params.replace(/\..\//g,'');
//    $.ajax({
//         type: 'Post',
//         url: 'dashboard.php?function=insertslider',
//         data:{id: id, params: params},
//       }).done( function(data){
//         $('.msg').html('<p>Successfully saved...</p>');
//          $('#success-modal').modal('show');
//         });
// });


$(document).on('click', '.delete-image', function(){
  var id = $(this).attr('id');
  $('.msg').html('<p>Are you sure you want to remove the image? <button id ="'+id+'" class = "btn-remove"> Yes </button><button class = ""> No </button></p>');
   $('#success-modal').modal('show');
});

$(document).on('click','.btn-remove',function(){
  var id = $(this).attr('id');
  $('.img_'+id).val('');
  $('.img_'+id).hide();
  $('.btn-cap_'+id).html('Select Image');
  $('#success-modal').modal('hide');
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
            $('.msg').html('<p>Are you sure you want to '+data_type+' this record? <button data-type = "'+data_type+'" class = "btn-remove2"> Yes </button><button class = "btn-close2"> No </button></p>');
            $('#success-modal').modal('show');

          }

      });
   });

    $(document).on('click', '.btn-remove2', function(){
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
                  url: 'dashboard.php?function=inactive_module_update',
                  data:{id:id, type:type},
                }).done( function(data){
                  
                    get_slider();
                    $('#success-modal').modal('hide');
                  });

             x++;
          } 

        

      });
   });

    $(document).on('click', '.btn-close2', function(){
      get_slider();
      $('.inactive').hide();
      $('.selectall').attr('checked', false);
        $('#success-modal').modal('hide');    
     });


    var base_path = window.location.href;
    base_path = base_path.replace('content_management/slider.php','');
    $(document).on('click','.preview',function(){
      id = $(this).attr('id');
      var url_path ='';
      if(id=='100'){
        url_path = 'bioflu-information';
      }
      else{
        url_path = 'featured-articles';
      }
        $('.msg').html('<iframe name="iframe2" src="'+base_path+url_path+'" style="width:100%; height:80%;"></iframe>');
        $('#preview').modal('show');

     });





});

</script>

