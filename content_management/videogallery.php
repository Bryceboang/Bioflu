<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">

			<div class="row">

				<div class="col-md-12 pad-0">

					<div class="col-md-12 title-header"><p> Video Gallery </p></div>
					<div class="col-md-7 btn-navigation">
					<button class="update btn-min btn btn-success"><span class = "glyphicon glyphicon-floppy-saved"></span>Update</button> 
					<button class="save btn-min btn btn-success"><span class = "glyphicon glyphicon-floppy-saved"></span>Save</button>
					<button class="img_add btn-min btn btn-primary"><span class = "glyphicon glyphicon-plus-sign"></span>Add new</button> 
					<!-- <button class="preview btn-min btn btn-default"><span class = "glyphicon glyphicon-search"></span>Preview</button>  -->
					<!-- <button class="btn-filemanager btn-min btn btn-default"><span class = "glyphicon glyphicon-picture"></span>Image Manager</button> -->
					<!-- <button class="btn-videomanager btn-min btn btn-default"><span class = "glyphicon glyphicon-film"></span>Video Manager</button>   -->
					<button class="article_list btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Close</button>
					<button data-type = "Trash" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-trash"></span>Trash</button> 
					<button data-type = "Active" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-ok"></span>Publish</button>
					<button data-type = "Inactive" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Unpublish</button>
					</div>
					<div class="col-md-5 pagination"></div>
				</div>

			</div>

			<div class="content-container">

				<?php  require_once dirname(__FILE__) . '/videogallery/list.php'; ?>				

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

	

	$('.img_add').click(function() {

		$('.delete').hide();
                $('.inactive').hide();

		$('.article_list').show();

		$(this).hide();

		$('.content-container').load('videogallery/add.php');

	});



	$('.article_list').click(function() {

		$('.img_add').show();

		$(this).hide();

		$('.content-container').load('videogallery/list.php');

	});

	$(document).on('click','.edit',function(){
		var id = $(this).attr('id');
		var catid = $(this).attr('data-catid');
		var state = $(this).attr('data-status');
		$('.img_add').show();
		$('.article_list').show();

		$('.content-container').load('videogallery/edit.php?id='+id);
	});

	$(document).on('change','.status', function() {
		// alert('s');
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


$(document).on('click', '.image-file',  function(){
	var image = $(this).attr('src');
	var id = $('.id-image').html();
	var data_id = $(this).attr('data-id');
	$('.img_'+id).attr('src',image);
	var imgtrim ='';
	imgtrim = image.replace('../','');
	imgtrim = imgtrim.replace(/[\/]/g,'\\/');
	$('.img_'+id).val(imgtrim);
	$('.check').hide();
	$('.check_'+data_id).show();
	$('.c-copy').show();
	$('.img_'+id).show();
});





// $('.btn-filemanager').click(function(){
// 	$('.c-copy').hide();
// filemanager();
// $('#select-image-modal').modal('show');

// });




// function filemanager(){
//    $.ajax({
//         type: 'Post',
//         url: 'dashboard.php?function=getimages',
//         data:{},
//       }).done( function(data){
//         $('.file-manager').html(data);
//       }); 
// }



// $('.btn-videomanager').click(function(){
// $('.pathtocopy').hide();
// $('.btn-insert-video').hide();
// videomanager();
// $('#select-video-modal').modal('show');

// });




// function videomanager(){
//    $.ajax({
//         type: 'Post',
//         url: 'dashboard.php?function=getmodalvideos',
//         data:{},
//       }).done( function(data){
//         $('.video-manager').html(data);
//       }); 
// }




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
	                    $('.filename').html('');
	               }, 4000);
                	
                }
     });

}
});


$('.upload-vid').on('click', function() {
    var file_data = $('#videofiles').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data); 

    if ($('#videofiles').val() == '' ) {

    }else{
    	$('.loader').show();
    	$('.uploadlabel').html('Uploading ');
    $.ajax({
                url: 'dashboard.php?function=uploadvideo', // point to server-side PHP script 
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
	                   videomanager();
	                   $('#videofiles').val('');
	                   $('.filename').html('');
	               }, 4000);
                	
                }
     });

}
});




});	

</script>
