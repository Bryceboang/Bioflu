<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">
			<div class="col-md-12 pad-0">
					<div class="row">
						<div class="col-md-12 title-header"><p> Flu Monitor - Reports</p></div>
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


	$('.content-container').load('flumonitor/reports.php');




});

</script>