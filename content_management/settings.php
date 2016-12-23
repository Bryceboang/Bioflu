<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">

			<div class="row">


				<div class="col-md-12 pad-0">

					<div class="col-md-12 title-header"><p> Settings </p></div>
					<div class="col-md-12"><button class="btn-save btn-min btn btn-success"><span class = "glyphicon glyphicon-floppy-saved" style = "margin-right:5px"></span>Save</button></div>
				</div>

			</div>

			<div class="content-container">

				<?php  require_once dirname(__FILE__) . '/settings/list.php'; ?>				

			</div>




		</div>

		<!-- sidebar -->
		<?php  require_once dirname(__FILE__) . '/sidebar.php'; ?>
		<!-- end sidebar -->

	</div>

</div>




<?php  require_once dirname(__FILE__) . '/layout/footer.php'; ?>


