<div class="row">
<div class="col-md-12 list-data">
    <div class="table-responsive">
    <table class = "table listdata" style="margin-bottom:0px;">
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
        url: 'dashboard.php?function=get_drugstore',
        data:{limit:limit, offset:offset},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 
            if(row.is_active==1){
              var status = 'Active';
            }
            else{
              var status = 'Inactive';
            }
              htm+="<tr>";
              htm+="<td><input class = 'select'  data-id = '"+row.id+"' type ='checkbox'></td>";
              htm+="<td><p style='color:#3071a9'>"+row.name+"</p></td>";
              htm+="<td>"+status+"</td>";
              htm+="<td><a class='edit-drugstore' data-status='"+row.is_active+"' id='"+row.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }

  function get_pagination(page_num,limit){
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_drugstore_count',
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

  $(document).on('click', '.edit-drugstore',function(){
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
        url: 'dashboard.php?function=edit_drugstore',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
              htm+="<div class = 'col-md-12 pad-10'>";
              htm+="<label>Edit Drugstore</label>";
              htm+="</div>";    

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Drugstore Name:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_name_text inputs'  data-id = '"+row.id+"'>";
              htm+=row.name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Drugstore name is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Contact Number:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'edit_contact_number_text inputs' type = 'text' value = '"+row.contact_number+"'>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              // htm+="<div class = 'col-md-12 pad-5'>";
              // htm+="<div class = 'col-md-2 '>";
              // htm+="<label>Promotion:</label>";
              // htm+="</div>";
              // htm+="<div class = 'col-md-10'>";
              // htm+="<select class = 'inputs promotion-list edit_promotion_id'>";
              // htm+="<option value ='"+row.promotion_id+"'>"+row.promotion_name+"</option>";
              // htm+="</select>";
              // htm+="<span class = 'er-msg msg-prompt'> * Promotion is empty...</span>";
              // htm+="</div>";
              // htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Latitude:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'edit_latitude_text inputs' type = 'text' value = '"+row.latitude+"'>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Longitude:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'edit_longitude_text inputs' type = 'text' value = '"+row.longitude+"'>";
              htm+="<span class = 'er-msg msg-prompt'> * Longitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Address 1:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_address1_text inputs'>";
              htm+=row.address1;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Address 1 is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Address 2:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_address2_text inputs'>";
              htm+=row.address2;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Address 2 is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Complete Address:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_complete_address_text inputs'>";
              htm+=row.complete_address;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Complete Address is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Zip Code:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'edit_zipcode_text inputs' type = 'text' value = '"+row.zip_code+"'>";
              htm+="<span class = 'er-msg msg-prompt'> * Zip code is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label>Status:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
                if(row.is_active==1){
                  var status = 'Active';
                }
                else{
                  var status = 'Inactive';
                }
              htm+="<select class = 'status inputs'>";
              htm+="<option value = '"+row.is_active+"'>"+status+"</option>";
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
              htm+="<button style = 'margin-right:5px;' class = 'btn btn-primary btn-min btn-update-drugstore'  data-id = '"+row.id+"'>Update</button>";
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


$(document).on('click', '.btn-update-drugstore', function(){
  var edit_name_text = $('.edit_name_text').val();
  var edit_contact_number_text = $('.edit_contact_number_text').val();
  var edit_latitude_text = $('.edit_latitude_text').val();
  var edit_longitude_text = $('.edit_longitude_text').val();
  var edit_address1_text = $('.edit_address1_text').val();
  var edit_address2_text = $('.edit_address2_text').val();
  var edit_complete_address_text = $('.edit_complete_address_text').val();
  var edit_zipcode_text = $('.edit_zipcode_text').val();
  var status = $('.status').val();
  var id = $(this).attr('data-id');
  var edit_promotion_id = $('.edit_promotion_id').val();
  
    var counter = 0;
    $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              $(this).siblings().show();
              counter++;
            }else{
              $(this).siblings().hide();
            }
        });

  if(counter == 0){
     $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=update_drugstore',
        data:{id:id, name: edit_name_text, contact_number: edit_contact_number_text, latitude:edit_latitude_text, longitude:edit_longitude_text, address1:edit_address1_text , address2:edit_address2_text, complete_address: edit_complete_address_text, status: status, zip_code: edit_zipcode_text},
      }).done( function(data){
        $('.msg').html('Successfully Updated...');
        $('#success-modal').modal('show');
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
            $('.msg').html('<p>Are you sure you want to '+data_type+' this record? <button data-type = "'+data_type+'" class = "btn-remove-drugstore"> Yes </button><button class = "btn-close2"> No </button></p>');
            $('#success-modal').modal('show');

          }

      });
   });

    $(document).on('click', '.btn-remove-drugstore', function(){
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
                  url: 'dashboard.php?function=update_drugstore_status',
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
              htm+="<label>Add Drugstore</label>";
              htm+="</div>";    

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Drugstore Name:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_name_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Drugstore name is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Contact Number:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add_contact_number_text inputs' type = 'text' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              // htm+="<div class = 'col-md-12 pad-5'>";
              // htm+="<div class = 'col-md-2 '>";
              // htm+="<label>Promotion:</label>";
              // htm+="</div>";
              // htm+="<div class = 'col-md-10'>";
              // htm+="<select class = 'inputs promotion-list add_promotion_id'>";
              // htm+="<option value =''>SELECT PROMO</option>";
              // htm+="</select>";
              // htm+="<span class = 'er-msg msg-prompt'> * Promotion is empty...</span>";
              // htm+="</div>";
              // htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Latitude:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add_latitude_text inputs' type = 'text' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Longitude:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add_longitude_text inputs' type = 'text' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Longitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Address 1:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_address1_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Address 1 is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Address 2:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_address2_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Address 2 is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Complete Address:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_complete_address_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Complete Address is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Zip Code:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add_zipcode_text inputs' type = 'text' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Zip code is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label>Status:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<select class = 'add_status inputs'>";
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
              htm+="<button style = 'margin-right:5px;' class = 'btn btn-primary btn-min btn-saved-drugstore'>Save</button>";
              htm+="<button class = 'btn btn-default btn-min btn-cancel'>Cancel</button>";
              htm+="</div>";
              htm+="</div>";
              // promotion_list()
            $('.addnew-data').html(htm);

});

$(document).on('click', '.btn-saved-drugstore', function(){

  var add_name_text = $('.add_name_text').val();
  var add_contact_number_text = $('.add_contact_number_text').val();
  var add_latitude_text = $('.add_latitude_text').val();
  var add_longitude_text = $('.add_longitude_text').val();
  var add_address1_text = $('.add_address1_text').val();
  var add_address2_text = $('.add_address2_text').val();
  var add_complete_address_text = $('.add_complete_address_text').val();
  var add_zipcode_text = $('.add_zipcode_text').val();
  var add_status = $('.add_status').val();
  var add_promotion_id = $('.add_promotion_id').val();

   var counter = 0;
    $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              $(this).siblings().show();
              counter++;
            }else{
              $(this).siblings().hide();
            }
        });

  if(counter == 0){
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=saved_drugstore',
       data:{name: add_name_text, contact_number: add_contact_number_text, latitude:add_latitude_text, longitude:add_longitude_text, address1:add_address1_text , address2:add_address2_text, complete_address: add_complete_address_text, status: add_status, zip_code: add_zipcode_text},
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

</script>