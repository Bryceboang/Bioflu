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
				
			<div class="col-md-12 login-form text-left">Content Management - Reset Password</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 pad-0 text-left">
					<p>New Password:</p>
				</div>
				<div class="col-md-8 text-left">
					<input type = "password" class = "new-password fullwidth inputs">
					<span style = "display:none; color:red">New password is empty ..</span>
				</div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 pad-0 text-left">
					<p>Confirm Password:</p>
				</div>
				<div class="col-md-8 text-left">
					<input type = "password" class = "confirm-password fullwidth inputs">
					<span style = "display:none; color:red">Confirm password is empty ..</span>
				</div>
			</div>

			<div class="col-md-12 pad-5">
				<div class="col-md-4 pad-0 text-left">
				</div>
				<div class="col-md-8 text-left">
					<span style = "display:none; color:red" class = "match">Password Not Match</span>
				</div>
			</div>

			<div class="col-md-12 pad-5">
				<div class="col-md-9 text-left">
				</div>
				<div class="col-md-3 text-right">
					<button class = "btn btn-primary btn-reset">Reset</button>
				</div>
			</div>

			<div class="col-md-12 token-msg" style = "display:none">Access token has been expired.</div>
			</div>

		</div>
		<div class="col-md-4"></div>

		</div>
		</div>

	
		
	</div>


</div>


<div class="modal fade" id="success-reset-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body"> 
       <d> Successfully reset your password. Click <a href="<?php echo JURI::root(); ?>">here</a> to redirect to login page.</d>   
      </div>
      <div class="modal-footer" style = "border:0px">
      		<button class = "btn btn-primary" data-dismiss="modal" style = "padding:2px 10px;" >Close</button>
  
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

var access_token = '<?php echo $_GET["access_token"] ?>';

$('.btn-reset').on('click', function(){
	var new_password = $('.new-password').val();
	var con_password = $('.confirm-password').val();


    var counter = 0;
    $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              $(this).siblings().show();
              $('.match').hide();
              counter++;
            }else{
              $(this).siblings().hide();
            }
        });

  if(counter == 0){


	if (new_password != con_password) {
		$('.match').show();
	}else{
		$('.match').hide();

				$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=update_reset_password',
                  data:{password:con_password, access_token:access_token},
                }).done( function(data){
                  	
                  	if (data == 'error') {
                  		$('.token-msg').show();
                  	}else{
                  		$('#success-reset-modal').modal('show');
                  	}
                   
                  });
            	}
            }
	
});



$('.confirm-password').keyup(function(e){
if(e.keyCode == 13)
{
  $('.btn-reset').click();
}
});



</script>


