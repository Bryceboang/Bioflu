<?php

$app    = JFactory::getApplication();
$itemid   = $app->input->getCmd('Itemid', '');
?>  
<div class="col-md-12 flumonitor-sidebar-form">
  
<div class="col-md-12 sidebar-container">

<div class="col-md-12 txt-center">
<label><h2>DO YOU THINK YOU HAVE THE FLU?</h2></label>
<span><h4>Report All Your Flu Symptoms</h4></span>
<span><h4>Check All Applicable Boxes</h4></span>
</div>

<div class="col-md-12 list-symptoms"></div>
<div class="col-md-12 txt-center">
<span class = "er-msg symptoms">Select atleast two symptoms * </span>
</div>

<div class="col-md-12 txt-left pad-5 black ">
  <span class = "white ">Name</span>
  <input type = "text" name = "fullname" class = "fullwidth fullname" placeholder = "Name">
  <span class = "er-msg">Name is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Email Address *</span>
  <input type = "text" name = "email" class = "fullwidth inputs email" placeholder = "Email Address">
  <span class = "er-msg valid-email">Email Address is required * </span>
  <span class = "er-msg existing-email">Email is already registered * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Mobile Number</span>
  <input type = "text" name = "contactnumber" class = "fullwidth contactnumber" placeholder = "Mobile Number">
  <span class = "er-msg">Mobile Number is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Provinces *</span>
  <select class = "fullwidth inputs province">
    
  </select>
  <span class = "er-msg">Provinces is required </span>
</div>

<div class="col-md-12 txt-left pad-5 black hide-city">
  <span class = "white">City *</span>
  <select class = "fullwidth inputs city black">
    <option value = ''>Select</option>
  </select>
  <span class = "er-msg">City is required * </span>
</div>
<div class="col-md-12 txt-left pad-5 black hide-barangay">
  <span class = "white">Barangay *</span>
  <select class = "fullwidth inputs barangay black">
    <option value = ''>Select</option>
  </select>
  <span class = "er-msg">Barangay is required * </span>
</div>

<div class="col-md-12 txt-center pad-5">
  <button class = "btn btn-danger btn-submitflu">SUBMIT <img class = "loader" src="images/bioflu/loader.gif"></button>
</div>

<div class="col-md-12 error-clone pad-0"></div>

</div>
</div>


<style type="text/css">

.error-clone .flu-danger-con{
  border: 4px solid #ca4a48;
  border-radius: 10px;
  background: #fff;
  color: #000;
}

.error-clone .title-error{
  color: #ca4a48;
  font-weight: bold;
 
}
.error-clone p{
   margin: 0px;
}

.error-clone{
  margin-bottom: 20px; box-shadow: 0 5px 7px #7e7e7e;
}
.error-clone .glyphicon-remove-sign{
   color: #ca4a48;
   font-size: 20px;

}
.title-error{
  margin-top: 5px;
}
.glyphicon-remove-sign{
  cursor: pointer;
}
.loader{
  display: none;
}
</style>


<!-- Modal -->
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
        Successfully saved.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary modal-close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

$('.email').on('change', function(){

var email = $('.email').val();
  //  $.ajax({
  //   type: 'Post',
  //   url: 'modules/mod_flu_sidebar/controller.php?function=checkmail',
  //   data:{email: email},
  // }).done( function(data){
  //   if (data == 0) {
  //      // $('.existing-email').hide();
  //   }else{
  //      $('.error-clone').html('<div class = "col-md-12 pad-0"><div class = "col-md-10 pad-0"><p class = "title-error">ERROR!</p><p>Email is already registered *</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');

  //   }
  //   });



function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
  } 


});

$('.btn-submitflu').on('click', function(){
  var counter = 0;
  var count_symptoms = 0;
  var email = $('.email').val();
  var province = $('.province').val();
   $('.error-clone').show();

       $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              if (email.length == 0 || province.length == 0) {
                  $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>Required fields</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
              }
                 counter++;
            }
        });

        $('.inputs2:checked').each(function(){
          var id = $(this).attr('data-id');
            if ($('.inputs2:checked').length != 0){
              count_symptoms++;
            }
        });

        if(count_symptoms == 2){
          var number_of_symptoms = 1;
        }
        if(count_symptoms == 3){
          var number_of_symptoms = 2;
        }
        if(count_symptoms == 4){
          var number_of_symptoms = 3;
        }

        if(email.length != 0){     
            var val = validateEmail(email); 
            if (val == false)
            {
              $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>The email you have entered is invalid</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
            }
                
          }

      function validateEmail(email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test(email);
        } 

   $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=checkmail',
    data:{email: email},
  }).done( function(data){
    if (data == 0) {

       if (count_symptoms <= 1) {
         $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>Please click atleast to two symptoms</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
         }else{
          if (counter == 0) {
            
            var fullname = $('.fullname').val();
            var email = $('.email').val();
            var contactnumber = $('.contactnumber').val();
            var province = $('.province').val();
            var barangay = $('.barangay').val();
           
            if(email.length != 0){     
            var val = validateEmail(email); 
            if (val == true)
            {
               $('.loader').show();
               $('.btn-submitflu').attr('disabled', true);
               $('.error-clone').html('');
           $.ajax({
                  type: 'Post',
                  url: 'modules/mod_flu_sidebar/controller.php?function=insert',
                  data:{'fullname': fullname, 'email': email, 'contactnumber': contactnumber, 'barangay':barangay, 'number_of_symptoms': number_of_symptoms},
                }).done( function(data){
                  
                   $('.inputs2:checked').each(function(){
                      var symptoms_id = $(this).attr('data-id');
                        if ($('.inputs2:checked').length != 0){
                            $.ajax({
                                  type: 'Post',
                                  url: 'modules/mod_flu_sidebar/controller.php?function=insert_symptoms',
                                  data:{'symptoms_id': symptoms_id, 'user_id': data},
                                }).done( function(data){
                                  setTimeout(function(){
                                    $('.loader').hide();
                                      $('.inputs2').attr('checked', false);
                                      $('.inputs').val('');
                                      $('.fullname').val('');
                                      $('.contactnumber').val('');
                                      $('.hide-city').hide();
                                      $('.hide-barangay').hide();
                                     $('.error-clone').html('<div style = "border:4px solid #039700; border-radius:10px; background:#fff;" class = "col-md-12 flu-success-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error" style = "color:#000">Thank you for reporting your flu symptoms.</p><p style = "color:#333">Visit the <a href = "bioflu-information">Information Page</a> and learn how to relieve your flu symptoms immediately or head to the nearest <a href = "bioflu-information">drugstore</a> with available Bioflu.</p></div><div class = "col-md-2 pad"><span style = "color: #039700; font-size:20px;" class = "glyphicon glyphicon-remove-sign close-success"></span></div></div>');
                                      }, 4000);
                                   });
                              }});});}else{
                 $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>The email you have entered is invalid</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
              }}}}}else{
       $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>Sorry, you have exceeded the number of submissions allowed.</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
       }});});


getprovince();
$('.hide-city').hide();
$('.hide-barangay').hide();
$(document).on('change', '.province', function(){
  var province_id = $('.province').val();
  getcity(province_id);

  if (province_id.length == 0 ) {
    $('.hide-city').hide();
  }else{
    $('.hide-city').show();
  }
});
$(document).on('change', '.city', function(){
  var city_id = $('.city').val();
  getbarangay(city_id);

  if (city_id.length == 0 ) {
    $('.hide-barangay').hide();
  }else{
    $('.hide-barangay').show();
  }
});



function getprovince(){
  $.ajax({
      type: 'Post',
      url: 'modules/mod_flu_sidebar/controller.php?function=province',
      data:{},
    }).done( function(data){
            var obj = JSON.parse(data);
            var htm = '';
             if (obj.length == 0) {
             
            }else{
            htm+="<option value = ''>Select</option>";
        $.each(obj, function(index, row){
            htm+="<option value = "+row.province_id+">"+row.province_name+"</option>";                    
           });
        }
            $('.province').html('');
            $('.province').html(htm);
     }); 
}


function getcity(province_id){
  $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=city',
    data:{province_id: province_id},
  }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';
           if (obj.length == 0) {
           
          }else{
          htm+="<option value = ''>Select</option>";
      $.each(obj, function(index, row){
          htm+="<option value = "+row.territory_id+">"+row.territory_name+"</option>";                    
         });
      }
          $('.city').html('');
          $('.city').html(htm);
    });        
}
function getbarangay(city_id){
  $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=barangay',
    data:{city_id: city_id},
  }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';
           if (obj.length == 0) {
           
          }else{
          htm+="<option value = ''>Select</option>";
      $.each(obj, function(index, row){
          htm+="<option value = "+row.barangay_id+">"+row.barangay_name+"</option>";                    
         });
      }
          $('.barangay').html('');
          $('.barangay').html(htm);
    });        
}

getsymptoms();

function getsymptoms(){
  $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=getsymptoms',
    data:{},
  }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';

      $.each(obj, function(index, row){
          htm+='<div class="col-md-6 pad-0"><div class="col-md-2 pad-0"><input  type="checkbox" name = "" class = "inputs2 '+row.flu_symptoms+'" data-id = "'+row.id+'"></div>';
          htm+='<div class="col-md-10 pad-0 ">'+row.flu_symptoms+'</div></div>';                    
         });
      
          $('.list-symptoms').html('');
          $('.list-symptoms').html(htm);
    });        
}
     


$('.modal-close').click(function(){
  location.reload();
});        

$(document).on('click', '.error-clone .close-err',function(){
  $('.error-clone').fadeOut();
});

$(document).on('click', '.error-clone .close-success',function(){
  location.reload();
});

</script>
