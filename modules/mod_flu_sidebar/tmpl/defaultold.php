<?php

$app    = JFactory::getApplication();
$itemid   = $app->input->getCmd('Itemid', '');
if ($itemid == '115') {
  $col_md = "col-md-4";
}else{
  $col_md = "col-md-12 pad-0";
}
// echo $itemid;
?>  


<?php if ($itemid != '114'){ ?>
<style type="text/css">
.sidebar-container{
  margin-top: 95px;
}
</style>  

<div class="col-md-4 flumonitor-sidebar-form">
   <!--  <div class="col-md-12 txt-right bottom-line pad-0">
    <button class="btn btn-primary btn-sharepost">SHARE THIS POST</button>
  </div> -->
  
  <div class="col-md-12 sidebar-container">

<div class="col-md-12 txt-center">
<label><h2>DO YOU THINK YOU HAVE THE FLU?</h2></label>
<label><h4>Report Your Flu Symptoms</h4></label>
</div>

<div class="col-md-12 list-symptoms">
  <div class="col-md-6 txt-right"><input  type="checkbox" name = "" class = "inputs2 fever"></div>
  <div class="col-md-6 pad-0 ">Fever</div>
</div>

<!-- <div class="col-md-12">
  <div class="col-md-6 txt-right"><input  type="checkbox" name = "" class = "inputs2 cold"></div>
  <div class="col-md-6 pad-0">Colds</div>
</div>

<div class="col-md-12">
  <div class="col-md-6 txt-right"><input  type="checkbox" name = "" class = "inputs2 ache"></div>
  <div class="col-md-6 pad-0">Body Ache</div>
</div>

<div class="col-md-12">
  <div class="col-md-6 txt-right"><input  type="checkbox" name = "" class = "inputs2 cough"></div>
  <div class="col-md-6 pad-0">Cough</div>
</div> -->

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

<?php } else { ?>

<!-- 
  
<div class="col-md-12 form-con">
<div class="col-md-2"></div>
<div class="col-md-8 bottombar-container">

<div class="col-md-12 txt-center bottombar-title">
  <h4><label>DO YOU THINK YOU HAVE THE FLU? REPORT YOUR SYMPTOMS</label></h4>
</div>

<div class="col-md-12 bottombar-input pad-0">

<div class="col-md-12 pad-0">
  <div class="col-md-2 pad-0">
    <div class="col-md-1 pad-0">
      <input type="checkbox" name = "" class = "inputs2 fever">
    </div>
      <div class="col-md-6 ">Fever</div>
  </div>

  <div class="col-md-2 pad-0">
    <div class="col-md-1 pad-0">
      <input type="checkbox" name = "" class = "inputs2 cold">
    </div>
    <div class="col-md-6 ">Colds</div>
  </div>

  <div class="col-md-2 pad-0">
    <div class="col-md-1 pad-0">
      <input type="checkbox" name = "" class = "inputs2 ache">
    </div>
    <div class="col-md-11 ">Body Ache</div>
  </div>

  <div class="col-md-2 pad-0">
    <div class="col-md-1 pad-0">
      <input type="checkbox" name = "" class = "inputs2 cough">
    </div>
    <div class="col-md-6 ">Cough</div>
  </div>

  <div class="txt-center">
    <span class = "er-msg symptoms">Select atleast two symptoms * </span>
  </div>

  </div>

  <div class="col-md-12 pad-0">

 <div class="col-md-6 txt-left pad-5 black ">
  <span class = "white ">Name</span>
  <input type = "text" name = "fullname" class = "fullwidth inputs fullname" placeholder = "Name">
  <span class = "er-msg">Name is required * </span>
</div>

<div class="col-md-6 txt-left pad-5 black">
  <span class = "white">Email Address</span>
  <input type = "text" name = "email" class = "fullwidth inputs email" placeholder = "Email Address">
  <span class = "er-msg valid-email">Email Address is required * </span>
</div>

</div>

<div class="col-md-12 pad-0">

<div class="col-md-6 txt-left pad-5 black">
  <span class = "white">Contact Number</span>
  <input type = "text" name = "contactnumber" class = "fullwidth inputs contactnumber" placeholder = "Contact Number">
  <span class = "er-msg">Contact Number is required * </span>
</div>

<div class="col-md-6 txt-left pad-5 black">
  <span class = "white">Province</span>
  <select class = "fullwidth inputs province">
  </select>
  <span class = "er-msg">Province is required * </span>
</div>

</div>

<div class="col-md-12 pad-0">

<div class="col-md-12 txt-left pad-5 black hide-city">
  <span class = "white">City</span>
  <select class = "fullwidth inputs city black">
    <option value = ''>Select Your City</option>
  </select>
  <span class = "er-msg">City is required * </span>
</div>

</div>

<div class="col-md-12 txt-center pad-5">
  <button class = "btn btn-danger btn-submitflu">SUBMIT <img class = "loader" src="images/bioflu/loader.gif"></button>
</div>

</div>
</div>
<div class="col-md-2"></div>
</div> -->


<?php } ?>


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

  if ($('.fever:checked').length != 0 ) {
    var fever = 1;
  }else{
    var fever = 0;
  }

  if ($('.cold:checked').length != 0) {
    var cold = 1;
  }else{
    var cold = 0;
  }
  
  if ($('.ache:checked').length != 0) {
    var ache = 1;
  }else{
    var ache = 0;
  }
    
  if ($('.cough:checked').length != 0 ) {
    var cough = 1;
  }else{
    var cough = 0;
  }
    
      
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
                  data:{'fullname': fullname, 'email': email, 'contactnumber': contactnumber, 'province': province, 'city':city, 'fever':fever, 'cold':cold, 'ache':ache, 'cough':cough, 'number_of_symptoms': number_of_symptoms},
                }).done( function(data){
                  setTimeout(function(){
                  $('.loader').hide();
                   $('#success-modal').modal();
                    }, 4000);
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
          htm+='<div class="col-md-6 pad-0"><div class="col-md-2 pad-0"><input  type="checkbox" name = "" class = "inputs2 '+row.flu_symptoms+'"></div>';
          htm+='<div class="col-md-10 pad-0 ">'+row.flu_symptoms+'</div></div>';                    
         });
      
          $('.list-symptoms').html('');
          $('.list-symptoms').html(htm);
    });        
}
     


$('.modal-close').click(function(){
  location.reload();
});        

</script>
