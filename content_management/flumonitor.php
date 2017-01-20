<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">
			<div class="col-md-12 pad-0">
					<div class="row">
						<div class="col-md-12 title-header"><p> Flu Monitor </p></div>
						<div class="col-md-6 btn-navigation">
						</div>
						<div class="col-md-6 pagination"></div>
					<div class="col-md-12 content-container"></div>
				</div>
			</div>
		</div>
		<!-- sidebar -->
		<?php  require_once dirname(__FILE__) . '/sidebar.php'; ?>
		<!-- end sidebar -->

	</div>


</div>
<input type="hidden" id="hidden_type" value=""> 

<script type="text/javascript">
$(document).ready(function(){

$(document).on('click', '.symptoms', function(){
	$('.pagination').show();
	$('.content-container').load('flumonitor/symptoms.php');
});


$(document).on('click', '.hospital', function(){
	$('.pagination').show();
	$('.content-container').load('flumonitor/hospital.php');
});

$(document).on('click', '.drugstore', function(){
	$('.pagination').show();
	$('.content-container').load('flumonitor/drugstore.php');
});

 function flumonitorhome(){
 	var htm = '';
 	htm+='<div class="table-responsive"><table class = "table listdata">';
 	htm+='<thead><tr><th>Title</th><th>View</th></tr></thead><tbody>';
 	htm+='<tr><td>Symptoms</td><td><span class = "glyphicon glyphicon-search symptoms"></span></td></tr>';
 	htm+='<tr><td>Hospital</td><td><span class = "glyphicon glyphicon-search hospital"></span></td></tr>';
 	htm+='<tr><td>Drugstore</td><td><span class = "glyphicon glyphicon-search drugstore"></span></td></tr>';
 	htm+='<tr><td>Promo</td><td><span class = "glyphicon glyphicon-search promo"></span></td></tr>';
 	htm+='</tbody></table></div>';
 	$('.content-container').html(htm);
 }	

flumonitorhome();
$(document).on('click', '.btn-list', function() {
	$('.btn-navigation').html('');
	$('.pagination').hide();
$(this).hide();
flumonitorhome();
});



});

</script>