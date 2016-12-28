<?php 
session_start();
if (isset($_POST['submit'])) {
 $_SESSION['session_id'] = $_POST['session'];
 header('location:home.php');
 } 



 ?>



<style type="text/css">
.header-bg{
	background: #10223e !important;
	width: 100% !important;
	height: 10% !important;
	right: 0px;
	top: 0px;

}
a{
	cursor: pointer !important;
}
</style>

<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">
<?php  //require_once dirname(__FILE__) . '/menu.php'; ?>
		

		<div class="col-md-12">
		<div class="row">
		<!-- <div class="col-md-12"><h3  ><a style = "color:#fff; text-decoration:none" href="home.php">Content Management</a></h3></div> -->
		<div class="col-md-4"></div>
		<div class="col-md-4 login-container">

			<div class="row">
				
			<div class="col-md-12 login-form text-left">Content Management - Log In</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-3">
					<p>Username</p>
				</div>
				<div class="col-md-9">
					<input type = "text" class = "username fullwidth" placeholder="Username">
				</div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-3">
					<p>Password</p>
				</div>
				<div class="col-md-9">
					<input type = "password" class = "password fullwidth" placeholder="Password">
				</div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-9 text-left">
					<a class = "reset-password">Forgot password</a>
				</div>
				<div class="col-md-3 text-right">
					<button class = "btn btn-primary btn-login">Log in</button>
				</div>
			</div>

			<div class="col-md-12 session-msg" style = "display:none">Invalid Username or Password.</div>
			</div>

		</div>
		<div class="col-md-4"></div>

		</div>
		</div>

	
		
	</div>


</div>

<form style = "display:none" method = "post" >
<input type = "text" name = "session" class = "session" value = "">
<input type = "submit" class = "submit" name = "submit">
</form>

<div class="modal fade" id="modal-reset-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close btn-prev-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 style = "text-align:left" class="modal-title" id="myModalLabel">Reset Password</h4>
      </div>
      <div class="modal-body"> 

    	Email Address<input type = "text" name = "email" class = "email  form-control">
    	<span style = "font-size:11px;">Note: Please enter a valid email address.</span>
    	<p class = "error-email" style = "display:none; color:red; font-size:11px;" >The email address you have entered is invalid.</p>
      </div>
      <div class="modal-footer" style = "border:0px">
      	<button class = "btn btn-primary btn-send">Send</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="success-send-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body"> 
       <d> Successfully sent. Please check your email to reset your password.</d>   
      </div>
      <div class="modal-footer" style = "border:0px">
      		<button class = "btn btn-primary btn-x" data-dismiss="modal" style = "padding:2px 10px;" >Close</button>
  
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

$('.btn-login').on('click', function(){
	var username = $('.username').val();
	var password = $('.password').val();

			$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=login_controller',
                  data:{username:username, password:password},
                  dataType:'json',
                }).done( function(data){
                  
                  if (data.status == 'success'){
                  	$('.session').val(data.id)
                  	$('.submit').click();
                  }else{
                  	$('.session-msg').show();
                  }
                   
                  });
	
});

$('.submit').click(function(){});

$('.password').keyup(function(e){
if(e.keyCode == 13)
{
  $('.btn-login').click();
}
});

$('.reset-password').click(function(){
	$('#modal-reset-password').modal('show');
});

$('.btn-send').click(function(){
	var email = $('.email').val();
	$('.btn-send').html('Sending ...');
	$.ajax({
          type: 'Post',
          url: 'dashboard.php?function=checkemail',
          data:{email:email},
          dataType:'json',
        }).done( function(data){
           
           if (data == 0) {
           	$('.error-email').show();
           }else{
           	$('.error-email').hide();

           	$.ajax({
                type: 'Post',
                url: 'mailer/sendemail.php',
                data:{email:email},
              }).done( function(res){
              	$('#success-send-modal').modal('show');
              	$('#modal-reset-password').modal('hide');
              	$('.btn-send').html('Send');
             });
           }                     

        });

         
});

$('.btn-x').click(function(){
location.reload();
});

</script>


