<div class="row">
<div class="col-md-12 list-data">
    <div class="table-responsive">
    <table class = "table listdata" style="margin-bottom:0px;">
    <thead>
    <tr>
    <th>Name</th>
    <th>Email Address</th>
    <th>Contact Number</th>
    <th style="text-align: center">View</th>
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

<style type="text/css">

.btn-min{
  margin-right: 5px;
}

</style>

<script type="text/javascript">
                 
                    
button();

 function button(){
    var htm = '';
    htm+='<button class="btn-export btn-min btn btn-success"><span class = "glyphicon glyphicon-list-alt"></span>Export to Excel</button>';
    htm+='<button data-type = "Trash" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-trash"></span>Trash</button>';
    htm+='<button data-type = "Active" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-ok"></span>Active</button>';
    htm+='<button data-type = "Inactive" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Inactive</button>';
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
        url: 'dashboard.php?function=get_flu_reports',
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
              htm+="<td><p>"+row.user_name+"</p></td>";
              htm+="<td><p>"+row.user_email+"</p></td>";
              htm+="<td><p>"+row.user_contact+"</p></td>";
              htm+="<td style='text-align: center'><a class='edit' data-status='"+row.is_active+"' id='"+row.user_id+"' title='edit'><span class='glyphicon glyphicon-search'></span></td>";
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }

  function get_pagination(page_num,limit){
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_flu_reports_count',
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
    $('.btn-export').hide();
    $('.btn-list').hide();
    var id = $(this).attr('id');
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_flureports',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
          htm+="<div class = 'col-md-12 pad-10'>";
          htm+="<label>User Profile</label>";
          htm+="</div>";    

          htm+="<div class = 'col-md-12 pad-5'>";
          htm+="<div class = 'col-md-2 '>";
          htm+="<label>Name:</label>";
          htm+="</div>";
          htm+="<div class = 'col-md-10 pad-0'>";
          htm+="<p>"+row.user_name+"</p>";
          htm+="</div>";
          htm+="</div>";

          htm+="<div class = 'col-md-12 pad-5'>";
          htm+="<div class = 'col-md-2 '>";
          htm+="<label>Email Address:</label>";
          htm+="</div>";
          htm+="<div class = 'col-md-10 pad-0'>";
          htm+="<p>"+row.user_email+"</p>";
          htm+="</div>";
          htm+="</div>";

          htm+="<div class = 'col-md-12 pad-5'>";
          htm+="<div class = 'col-md-2 '>";
          htm+="<label>Contact Number:</label>";
          htm+="</div>";
          htm+="<div class = 'col-md-10 pad-0'>";
          htm+="<p>"+row.user_contact+"</p>";
          htm+="</div>";
          htm+="</div>";

          htm+="<div class = 'col-md-12 pad-5'>";
          htm+="<div class = 'col-md-2 '>";
          htm+="<label>Symptoms:</label>";
          htm+="</div>";
          htm+="<div class = 'col-md-10 user-symptoms pad-0'>";
          htm+="</div>";
          htm+="</div>";

          htm+="<div class = 'col-md-12 pad-5'>";
          htm+="<div class = 'col-md-2 '>";
          htm+="<label>Location:</label>";
          htm+="</div>";
          htm+="<div class = 'col-md-10 user-location pad-0'>";
          htm+="</div>";
          htm+="</div>";

          htm+="<div class = 'col-md-12 pad-5'>";
          htm+="<div class = 'col-md-2'>";
          htm+="<label></label>";
          htm+="</div>";
          htm+="<div class = 'col-md-10 pad-0'>";
          htm+="<button class = 'btn btn-default btn-min btn-cancel'  data-id = '"+row.hospital_id+"'>Back</button>";
          htm+="</div>";
          htm+="</div>";

          get_usersymptoms(row.user_id);
          get_location(row.territory_id);
           
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
    $('.btn-export').show();
    $('.btn-list').show();
});


$(document).on('click', '.btn-update-hospital', function(){
  var edit_hospital_text = $('.edit_hospital_text').val();
  var edit_latitude_text = $('.edit_latitude_text').val();
  var edit_longitude_text = $('.edit_longitude_text').val();
  var edit_address_text = $('.edit_address_text').val();
  var edit_description_text = $('.edit_description_text').val();
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
        url: 'dashboard.php?function=update_hospital',
        data:{id:id, hospital: edit_hospital_text, latitude:edit_latitude_text, longitude:edit_longitude_text, address:edit_address_text, description: edit_description_text, status: status},
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
            $('.msg').html('<p>Are you sure you want to '+data_type+' this record? <button data-type = "'+data_type+'" class = "btn-remove-hospital"> Yes </button><button class = "btn-close2"> No </button></p>');
            $('#success-modal').modal('show');

          }

      });
   });

    $(document).on('click', '.btn-remove-hospital', function(){
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
                  url: 'dashboard.php?function=update_hospital_status',
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
  htm+="<div class = 'col-md-12 pad-10'>";
  htm+="<label>Add Hospital</label>";
  htm+="</div>";    

  htm+="<div class = 'col-md-12 pad-5'>";
  htm+="<div class = 'col-md-2 '>";
  htm+="<label>Hospital name:</label>";
  htm+="</div>";
  htm+="<div class = 'col-md-10'>";
  htm+="<textarea class = 'add_hospital_text inputs'>";
  htm+="</textarea>";
  htm+="<span class = 'er-msg msg-prompt'> * Hospital is empty...</span>";
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
  htm+="<label>Address:</label>";
  htm+="</div>";
  htm+="<div class = 'col-md-10'>";
  htm+="<textarea class = 'add_address_text inputs'>";
  htm+="</textarea>";
  htm+="<span class = 'er-msg msg-prompt'> * Address is empty...</span>";
  htm+="</div>";
  htm+="</div>";

  htm+="<div class = 'col-md-12 pad-5'>";
  htm+="<div class = 'col-md-2 '>";
  htm+="<label>Description:</label>";
  htm+="</div>";
  htm+="<div class = 'col-md-10'>";
  htm+="<textarea class = 'add_description_text inputs'>";
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

  var add_hospital_text = $('.add_hospital_text').val();
  var add_latitude_text = $('.add_latitude_text').val();
  var add_longitude_text = $('.add_longitude_text').val();
  var add_address_text = $('.add_address_text').val();
  var add_description_text = $('.add_description_text').val();
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
        url: 'dashboard.php?function=saved_hospital',
        data:{hospital: add_hospital_text, latitude:add_latitude_text, longitude:add_longitude_text, address:add_address_text, description: add_description_text, status: add_status},
      }).done( function(data){
        $(this).attr('disabled', true);
        $('.msg').html('Successfully Saved...');
        $('#success-modal').modal('show');
        get_list(limit,offset);
        get_pagination('1',limit);
        });
    }
});

function get_usersymptoms(id){
      $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_usersymptoms',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
              htm+="<ul>";
          $.each(obj, function(index, row){ 
              htm+="<li>"+row.flu_symptoms+"</li>";
            });
             htm+="</ul>";
            $('.user-symptoms').html('');
            $('.user-symptoms').html(htm);
           });
        }

function get_location(id){
      $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_location',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
              htm+="<p>"+row.territory_name+", "+row.province_name+"</p>";
            });
            $('.user-location').html('');
            $('.user-location').html(htm);
           });
        }     



 $(document).on('click', '.btn-export', function(){
  window.location="dashboard.php?function=export_report";
});          

</script>