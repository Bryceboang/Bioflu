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
        url: 'dashboard.php?function=get_facility',
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
              htm+="<td><p style='color:#3071a9'>"+row.facility_name+"</p></td>";
              htm+="<td>"+status+"</td>";
              htm+="<td><a class='edit' data-status='"+row.is_active+"' id='"+row.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }

  function get_pagination(page_num,limit){
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_facility_count',
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
        url: 'dashboard.php?function=edit_hospital',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
              htm+="<div class = 'col-md-12 pad-10'>";
              htm+="<label>Edit Facility</label>";
              htm+="</div>";    

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Facility Code:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'edit_code_text inputs' type = 'text' value = '"+row.facility_code+"'>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Facility name:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_facility_text inputs'  data-id = '"+row.id+"'>";
              htm+=row.facility_name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Facility is empty...</span>";
              htm+="</div>";
              htm+="</div>";

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
              htm+="<label>Street:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_street_text inputs'>";
              htm+=row.street_name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Street is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Region:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_region_text inputs'>";
              htm+=row.region_name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Region is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>City:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_city_text inputs'>";
              htm+=row.city_name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * City is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Province:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_province_text inputs'>";
              htm+=row.province_name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Province is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Barangay:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'edit_barangay_text inputs'>";
              htm+=row.barangay_name;
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Description is empty...</span>";
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
              htm+="<button style = 'margin-right:5px;' class = 'btn btn-primary btn-min btn-update-hospital'  data-id = '"+row.id+"'>Update</button>";
              htm+="<button class = 'btn btn-default btn-min btn-cancel'  data-id = '"+row.id+"'>Cancel</button>";
              htm+="</div>";
              htm+="</div>";
           
            });
          $('.single-data').html('');
          $('.single-data').html(htm);
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


$(document).on('click', '.btn-update-hospital', function(){
  var edit_facility_text = $('.edit_facility_text').val();
   var edit_code_text = $('.edit_code_text').val();
  var edit_latitude_text = $('.edit_latitude_text').val();
  var edit_longitude_text = $('.edit_longitude_text').val();
  var edit_street_text = $('.edit_street_text').val();
  var edit_region_text = $('.edit_region_text').val();
  var edit_city_text = $('.edit_city_text').val();
  var edit_province_text = $('.edit_province_text').val();
  var edit_barangay_text = $('.edit_barangay_text').val();
  var status = $('.status').val();
  var id = $(this).attr('data-id');
  
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
        url: 'dashboard.php?function=update_facility',
        data:{id:id, facility_name: edit_facility_text, latitude:edit_latitude_text, longitude:edit_longitude_text, street_name:edit_street_text, region_name:edit_region_text, city_name:edit_city_text, province_name:edit_province_text, barangay_name:edit_barangay_text, status: status, facility_code: edit_code_text},
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
                  url: 'dashboard.php?function=update_facility_status',
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
              htm+="<label>Add Facility</label>";
              htm+="</div>";    

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Facility Code:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add_code_text inputs' type = 'text' value = ''>";
              htm+="<span class = 'er-msg msg-prompt'> * Latitude is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Facility name:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_facility_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Facility is empty...</span>";
              htm+="</div>";
              htm+="</div>";

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
              htm+="<label>Street:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_street_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Street is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Region:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_region_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Region is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>City:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_city_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * City is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Province:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_province_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Province is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Barangay:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<textarea class = 'add_barangay_text inputs'>";
              htm+="</textarea>";
              htm+="<span class = 'er-msg msg-prompt'> * Description is empty...</span>";
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
              htm+="<button style = 'margin-right:5px;' class = 'btn btn-primary btn-min btn-saved-hospital'>Save</button>";
              htm+="<button class = 'btn btn-default btn-min btn-cancel'>Cancel</button>";
              htm+="</div>";
              htm+="</div>";
            $('.addnew-data').html(htm);
});

$(document).on('click', '.btn-saved-hospital', function(){

  var add_facility_text = $('.add_facility_text').val();
  var add_code_text = $('.add_code_text').val();
  var add_latitude_text = $('.add_latitude_text').val();
  var add_longitude_text = $('.add_longitude_text').val();
  var add_street_text = $('.add_street_text').val();
  var add_region_text = $('.add_region_text').val();
  var add_city_text = $('.add_city_text').val();
  var add_province_text = $('.add_province_text').val();
  var add_barangay_text = $('.add_barangay_text').val();
  var add_status = $('.add_status').val();

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
        url: 'dashboard.php?function=saved_facility',
         data:{facility_name: add_facility_text, latitude:add_latitude_text, longitude:add_longitude_text, street_name:add_street_text, region_name:add_region_text, city_name:add_city_text, province_name:add_province_text, barangay_name:add_barangay_text, status: add_status, facility_code: add_code_text},
      }).done( function(data){
        $(this).attr('disabled', true);
        $('.msg').html('Successfully Saved...');
        $('#success-modal').modal('show');
        get_list(limit,offset);
        get_pagination('1',limit);
        });
    }
});

</script>