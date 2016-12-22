<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">

			<div class="">

				<div class="col-md-12 pad-0">
					<div class="row">
					<!-- <button class="article_add">Add new Images</button><button class="article_list">List of Images</button> -->
					<div class="col-md-12 title-header"><p> Slider </p></div>
					<div class="col-md-12 btn-navigation">
					<button data-type = "Trash" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-trash"></span>Trash</button> 
					<button data-type = "Active" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-ok"></span>Publish</button>
					<button data-type = "Inactive" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Unpublish</button>
					<div class="navigation">
						
					</div>
					</div>
					

					</div>
				</div>

			</div>

			<div class="content-container">

				<?php  require_once dirname(__FILE__) . '/slider/list.php'; ?>				

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

		$('.content-container').load('slider/slider_add.php');

	});



	$(document).on('click', '.btn-close', function(){

		$('.navigation').hide();

		$(this).hide();


		$('.content-container').load('slider/list.php');

	});

	$(document).on('click','.edit',function(){
		var id = $(this).attr('data-id');
		$('.article_add').show();
		$('.article_list').show();
		$('.content-container').load('slider/edit.php?id='+id);
	});


	var isDirty = false;

	$('#edit_article input').each(function() {
	  $(this).data('original', $(this).val());
	 });

	$(window).bind('beforeunload', function(){
	   //to update the dirty flag when there is a different form values 
	   $('#edit_article input').each(function() {
	   if ($(this).data('original') != $(this).val()) {
	    isDirty = true;
	   }
	  });
	  if (isDirty) {
	   return 'You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?';
	   }
	 
	  });


// filemanager();

// function filemanager(){
// 	 $.ajax({
//         type: 'Post',
//         url: 'dashboard.php?function=getimages',
//         data:{},
//       }).done( function(data){
//       	$('.file-manager').html(data);
//       });	
// }	



$(document).on('click', '.select-image', function(){
	var id = $(this).attr('id');
	var src = $(this).attr('src');
	$('.id-image').html(id);

		$('.check').hide();
		$('#imgfiles').val('');
});


$('.upload').on('click', function() {
    var file_data = $('#imgfiles').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data); 
   


   

    if ($('#imgfiles').val() == '' ) {

    }else{
    	$('.loader').show();
    	$('.uploadlabel').html('Uploading ');
    $.ajax({
                url: 'dashboard.php?function=uploadfile', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                	setTimeout(function(){
                		$('.loader').hide();
	                	$('.uploadlabel').html('Upload');
	                   filemanager();
	                   $('#imgfiles').val('');
	               }, 4000);
                	
                }
     });

}
});

$('.btn-insert').on('click', function(){
	$('.btn-insert').hide();
});


});	


</script>

<script>
        
        // Jquery draggable
        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });
</script>  
