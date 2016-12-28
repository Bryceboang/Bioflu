<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">

			<div class="row">

				<div class="col-md-12 pad-0">

					<div class="col-md-12 title-header"><p> Ads </p></div>
					<div class="col-md-6 btn-navigation">
					<button class="update btn-min btn btn-success"><span class = "glyphicon glyphicon-floppy-saved"></span>Update</button> 
					<button class="save btn-min btn btn-success"><span class = "glyphicon glyphicon-floppy-saved"></span>Save</button> 
					<button class="article_add btn-min btn btn-primary"><span class = "glyphicon glyphicon-plus-sign"></span>Add new</button> 
					<button class="preview btn-min btn btn-default"><span class = "glyphicon glyphicon-search"></span>Preview</button> 
					<button class="article_list btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Close</button>
					<button data-type = "Trash" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-trash"></span>Trash</button> 
					<button data-type = "Active" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-ok"></span>Active</button>
					<button data-type = "Inactive" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Inactive</button>
					</div>
					<div class="col-md-6 pagination"></div>
				</div>

			</div>

			<div class="content-container">

				<?php  require_once dirname(__FILE__) . '/ads/list.php'; ?>				

			</div>

		</div>

		<!-- sidebar -->
		<?php  require_once dirname(__FILE__) . '/sidebar.php'; ?>
		<!-- end sidebar -->

	</div>

</div>

<?php  require_once dirname(__FILE__) . '/layout/footer.php'; ?>

<script type="text/javascript">

$(document).ready(function() {

	$('#menu-article').addClass('menu-active');

	$('.article_list').hide();

	

	$('.article_add').click(function() {

		$('.article_list').show();

		$(this).hide();
		$('.content-container').load('ads/add.php');

	});



	$('.article_list').click(function() {

		$('.article_add').show();

		$(this).hide();

		$('.content-container').load('ads/list.php');
	});

	$(document).on('click','.edit',function(){
		var id = $(this).attr('id');
		$('.article_add').show();
		$('.article_list').show();

		$('.content-container').load('ads/edit.php?id='+id);
	});


	// var isDirty = false;

	// $('#edit_article input').each(function() {
	//   $(this).data('original', $(this).val());
	//  });

	// $(window).bind('beforeunload', function(){
	//    //to update the dirty flag when there is a different form values 
	//    $('#edit_article input').each(function() {
	//    if ($(this).data('original') != $(this).val()) {
	//     isDirty = true;
	//    }
	//   });
	//   if (isDirty) {
	//    return 'You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?';
	//    }
	 
	//   });



});	

</script>
