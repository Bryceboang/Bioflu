<?php

$app    = JFactory::getApplication();
$itemid   = $app->input->getCmd('Itemid', '');
?>  

<style type="text/css">
.sidebar-container{
  margin-top: 95px;
}
</style>  

<div class="col-md-4 flumonitor-sidebar-form">
  
<div class="col-md-12 sidebar-container">

<div class="col-md-12 txt-center">
<label><h2>DO YOU THINK YOU HAVE THE FLU?</h2></label>
<label><h4>Report Your Flu Symptoms</h4></label>
</div>

<div class="col-md-12 list-symptoms"></div>
<div class="col-md-12 txt-center">
<span class = "er-msg symptoms">Select atleast two symptoms * </span>
</div>

<div class="col-md-12 txt-left pad-5 black ">
  <span class = "white ">Name</span>
  <input type = "text" name = "fullname" class = "fullwidth inputs fullname" placeholder = "Name">
  <span class = "er-msg">Name is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Email Address</span>
  <input type = "text" name = "email" class = "fullwidth inputs email" placeholder = "Email Address">
  <span class = "er-msg valid-email">Email Address is required * </span>
  <span class = "er-msg existing-email">Email is already registered * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Contact Number</span>
  <input type = "text" name = "contactnumber" class = "fullwidth inputs contactnumber" placeholder = "Contact Number">
  <span class = "er-msg">Contact Number is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Province</span>
  <select class = "fullwidth inputs province">
    
  </select>
  <span class = "er-msg">Province is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black hide-city">
  <span class = "white">City</span>
  <select class = "fullwidth inputs city black">
    <option value = ''>Select Your City</option>
  </select>
  <span class = "er-msg">City is required * </span>
</div>

<div class="col-md-12 txt-center pad-5">
  <button class = "btn btn-danger btn-submitflu">SUBMIT <img class = "loader" src="images/bioflu/loader.gif"></button>
</div>

</div>
</div>





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

  
var email = $('.email').val();
   $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=checkmail',
    data:{email: email},
  }).done( function(data){
    if (data == 0) {
       $('.existing-email').hide();
    }else{
        $('.existing-email').show();
    }
    });


  if(email.length != 0){     
      var val = validateEmail(email); 
      if (val == false)
      {
        $('.valid-email').show();
        $('.valid-email').html('The email you have entered is invalid'); 
      }
      else
      {
         $('.valid-email').hide();
        $('.valid-email').html('Email address is required ');
      }       
    }

function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
  } 


});

$('.btn-submitflu').on('click', function(){
  var counter = 0;
  var count_symptoms = 0;
  var email = $('.email').val();
      
       $('.inputs').each(function(){
            var input = $(this).val();

            if (input.length == 0) {
              $(this).next().show();
              counter++;
            }else{
              $(this).next().hide();
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
            if (val == true)
            {
              $('.valid-email').hide();
              $('.valid-email').html('Email address is required ');
            }
            else
            {
              $('.valid-email').show();
              $('.valid-email').html('The email you have entered is invalid'); 
              return false;
            }       
          }

      function validateEmail(email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test(email);
        } 

       if (count_symptoms <= 1) {
          $('.symptoms').show()
         }else{
           $('.symptoms').hide()
          if (counter == 0) {
            
            var fullname = $('.fullname').val();
            var email = $('.email').val();
            var contactnumber = $('.contactnumber').val();
            var province = $('.province').val();
            var city = $('.city').val();
            $('.loader').show();
            $('.btn-submitflu').attr('disabled', true);
           $.ajax({
                  type: 'Post',
                  url: 'modules/mod_flu_sidebar/controller.php?function=insert',
                  data:{'fullname': fullname, 'email': email, 'contactnumber': contactnumber, 'city':city, 'number_of_symptoms': number_of_symptoms},
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
                                     $('#success-modal').modal();
                                      }, 4000);
                                   });
                              }
                      });
                 
                });

         }
       }       
});


getprovince();
$('.hide-city').hide();
$(document).on('change', '.province', function(){
  var province_id = $('.province').val();
  getcity(province_id);

  if (province_id.length == 0 ) {
    $('.hide-city').hide();
  }else{
    $('.hide-city').show();
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
            htm+="<option value = ''>Select Your Province</option>";
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
          htm+="<option value = ''>Select Your City</option>";
      $.each(obj, function(index, row){
          htm+="<option value = "+row.territory_id+">"+row.territory_name+"</option>";                    
         });
      }
          $('.city').html('');
          $('.city').html(htm);
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

$(document).on('change', '.email', function(){

});

</script>
