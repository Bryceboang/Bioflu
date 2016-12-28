<div class="row">
<div class="col-md-12 list-data">
	<div class="table-responsive">
	<table class = "table listdata" style="margin-bottom:0px;">
	<thead>
	<tr>
	<th style = "width:10px;"><input class = "selectall" type = "checkbox"></th>
	<th>Name</th>
  <th>Username</th>
  <th>Email Address</th>
  <th>User Type</th>
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


  $(document).on('change','.s-page-number', function() {
    var page_number = parseInt($(this).val());
      $('.listdata tbody').html('');
      get_list(limit,page_number);
  });

  $(document).on('click','.s-next-page', function() {
    var page_number = parseInt($('.s-page-number').val());
    var next = page_number +1;
    if(page_number!=last()){
      get_list(limit,next);
      $('.s-page-number').val(next);
    }
  });

  $(document).on('click','.s-last-page', function() {
    var page_number = parseInt($('.s-page-number').val());
    if(page_number!=last()){
      get_list(limit,last());
      $('.s-page-number').val($('.s-page-number option:last').val());
    }
  });

  $(document).on('click','.s-prev-page', function() {
    var page_number = parseInt($('.s-page-number').val());
    var prev = page_number -1;
    if(page_number!=first()){
      get_list(limit,prev);
      $('.s-page-number').val(prev);
    }
  });

  $(document).on('click','.s-first-page', function() {
    var page_number = parseInt($('.s-page-number').val());
    if(page_number!=first()){
      get_list(limit,first());
      $('.s-page-number').val($('.s-page-number option:first').val());
    }
  });

  function first(){
    return parseInt($('.s-page-number option:first').val());
  }

  function last(){
    return parseInt($('.s-page-number option:last').val());
  }

	function get_list(limit,offset){
    $('.delete').hide();
    $('.inactive').hide();
    $('.selectall').attr('checked', false);
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_user',
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
              htm+="<td><p style='color:#3071a9'>"+row.name+"</p></td>";
              htm+="<td><p style='color:#3071a9'>"+row.username+"</p></td>";
              htm+="<td><p style='color:#3071a9'>"+row.email+"</p></td>";
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
        url: 'dashboard.php?function=get_user_count',
        data:{limit:limit},
      }).done( function(data){
          var htm = '';
          htm += '<span class = "glyphicon glyphicon-step-backward s-first-page"></span><span class = "glyphicon glyphicon-triangle-left s-prev-page"></span><select class="s-page-number"> ';
          for(var x =1; x<=data; x++){
            htm += "<option value='"+x+"'>"+x+"</option>";
          }
          htm += '</select><span class = "glyphicon glyphicon-triangle-right s-next-page"></span><span class = "glyphicon glyphicon-step-forward s-last-page"></span>';

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
        url: 'dashboard.php?function=edit_user',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
          	  htm+="<div class = 'col-md-12 pad-10'>";
              htm+="<label>Edit User</label>";
              htm+="</div>";	

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Name:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'name inputs'  type ='text' value = '"+row.name+"'>";
              htm+="<span class = 'er-msg msg-symptom'> * Name is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Username:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'username inputs'  type ='text' value = '"+row.username+"'>";
              htm+="<span class = 'er-msg '> * Username is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>New Password:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'new-password'  type ='password' value = ''>";
              htm+="<span class = 'er-msg new-msg '> * New Password is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Confirm Password:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'confirm-password'  type ='password' value = ''>";
              htm+="<span class = 'er-msg confirm-msg'> * Confirm Password is empty...</span>";
              htm+="<span class = 'er-msg password-checker'></span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Email Address:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'email inputs'  type ='text' value = '"+row.email+"'>";
              htm+="<span class = 'er-msg '> * Email Address is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>User Type:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";

               htm+="<select class = 'usergroup inputs'>";
              htm+="<option value = '"+row.group_id+"'>"+row.title+"</option>";
              htm+="</select>";

              htm+="<span class = 'er-msg '> * Symptoms is empty...</span>";
              htm+="</div>";
              htm+="</div>";
              get_user_group();
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
              htm+="<select class = 'status'>";
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
	var name = $('.name').val();
  var username = $('.username').val();
  var email = $('.email').val();
  var password = $('.confirm-password').val();
  var usergroup = $('.usergroup').val();
	var status = $('.status').val();
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
        url: 'dashboard.php?function=update_user',
        data:{id:id, name: name, username:username, email: email, password:password, status: status,usergroup: usergroup},
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
                  url: 'dashboard.php?function=update_user_status',
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
              htm+="<label>Add User</label>";
              htm+="</div>";  

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Name:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add-name inputs'  type ='text' value = ''>";
              htm+="<span class = 'er-msg '> * Name is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Username:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add-username inputs'  type ='text' value = ''>";
              htm+="<span class = 'er-msg '> * Username is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>New Password:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add-new-password inputs'  type ='password' value = ''>";
              htm+="<span class = 'er-msg new-msg'> * New Password is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Confirm Password:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add-confirm-password inputs'  type ='password' value = ''>";
              htm+="<span class = 'er-msg confirm-msg'> * Confirm Password is empty...</span>";
              htm+="<span class = 'er-msg password-checker'></span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>Email Address:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<input class = 'add-email inputs'  type ='text' value = ''>";
              htm+="<span class = 'er-msg '> * Email Address is empty...</span>";
              htm+="</div>";
              htm+="</div>";

              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2 '>";
              htm+="<label>User Type:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";

               htm+="<select class = 'add-usergroup'>";
              htm+="</select>";

              htm+="<span class = 'er-msg '> * Symptoms is empty...</span>";
              htm+="</div>";
              htm+="</div>";
              get_user_group('0');
              htm+="<div class = 'col-md-12 pad-5'>";
              htm+="<div class = 'col-md-2'>";
              htm+="<label>Status:</label>";
              htm+="</div>";
              htm+="<div class = 'col-md-10'>";
              htm+="<select class = 'add-status'>";
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

  var name = $('.add-name').val();
  var username = $('.add-username').val();
  var email = $('.add-email').val();
  var password = $('.add-confirm-password').val();
  var usergroup = $('.add-usergroup').val();
  var status = $('.add-status').val();

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
        url: 'dashboard.php?function=saved_user',
        data:{name: name, username:username, email: email, password:password, status: status,usergroup: usergroup},
      }).done( function(data){
      	$(this).attr('disabled', true);
      	$('.msg').html('Successfully Saved...');
      	$('#success-modal').modal('show');
      	get_list(limit,offset);
  		get_pagination('1',limit);
      	});

  }
});

function get_user_group(type){

  var x = '0'; 
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_user_group',
        data:{limit:limit, offset:offset},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 
              htm+="<option value = '"+row.id+"'>"+row.title+"</option>";
            });

          if (x == type) {
            $('.add-usergroup').html('');
          $('.add-usergroup').html(htm);
          }else{
            $('.usergroup option:first').after('');
          $('.usergroup option:first').after(htm);
          }
          

           
     }); 
  }

  


  $(document).on('change','.add-confirm-password', function(){
    var newpassword = $('.add-new-password').val();
    var confirmpassword = $('.add-confirm-password').val();  

    if (newpassword !='') {
    if (newpassword != confirmpassword) {
      $('.btn-saved').attr('disabled', true);
      $('.password-checker').html(' * Password Not Match').show();
      hide_msg();
    }else{
      hide_msg();
       $('.btn-saved').attr('disabled', false);
      $('.password-checker').html('').hide();
    }
    }

  

  });

   $(document).on('change','.add-new-password', function(){
    var newpassword = $('.add-new-password').val();
    var confirmpassword = $('.add-confirm-password').val();  

    if (confirmpassword !='') {
    if (newpassword != confirmpassword) {
      $('.btn-saved').attr('disabled', true);
      hide_msg();
      $('.password-checker').html('* Password Not Match').show();
    }else{
      hide_msg();
      $('.btn-saved').attr('disabled', false);
      $('.password-checker').html('').hide();
    }
    }


  });


  $(document).on('change','.confirm-password', function(){
    var newpassword = $('.new-password').val();
    var confirmpassword = $('.confirm-password').val();  

    if (newpassword !='') {
    if (newpassword != confirmpassword) {
      $('.btn-update').attr('disabled', true);
      $('.password-checker').html('* Password Not Match').show();
      hide_msg();
    }else{
      hide_msg();
       $('.btn-update').attr('disabled', false);
      $('.password-checker').html('').hide();
    }
    }

      if (confirmpassword.length == 0) {
        hide_msg();
    $('.btn-update').attr('disabled', false);
  }

  });

   $(document).on('change','.new-password', function(){
    var newpassword = $('.new-password').val();
    var confirmpassword = $('.confirm-password').val();  

    if (confirmpassword !='') {
    if (newpassword != confirmpassword) {
      $('.btn-update').attr('disabled', true);
      hide_msg();
      $('.password-checker').html('* Password Not Match').show();
    }else{
      hide_msg();
      $('.btn-update').attr('disabled', false);
      $('.password-checker').html('').hide();
    }
    }

       if (newpassword.length == 0) {
        hide_msg();
    $('.btn-update').attr('disabled', false);
  }
  });


function hide_msg(){
  $('.new-msg').hide();
  $('.confirm-msg').hide();
}

</script>