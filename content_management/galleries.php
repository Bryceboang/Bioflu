<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>
<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 container-content">



				<div class="col-md-12 pad-0">
					<div class="row">
						<div class="col-md-12 title-header"><p> Stock Images </p></div>
						<div class="col-md-12 btn-navigation">
						
						<input style = "display:none" id = 'imgfiles' type = "file">
						<button class="btn-upload btn-min btn btn-primary"><span class = "glyphicon glyphicon-plus-sign"></span>Add Image</button> <d class = "filename"></d>
						<button class = "upload  btn-min btn btn-success"><span class = "glyphicon glyphicon-floppy-saved"></span><d class="uploadlabel"> Upload </d><img class = "loader" src="assets/img/loader.gif"></button>
						</div>
						
					
					<div class="file-manager">
						
					</div>
				</div>

			</div>



		</div>

		<!-- sidebar -->
		<?php  require_once dirname(__FILE__) . '/sidebar.php'; ?>
		<!-- end sidebar -->

	</div>


</div>

<?php  require_once dirname(__FILE__) . '/layout/footer.php'; ?>

<style type="text/css">
.file-manager .size{
	height: 400px !important;
	border-top: 1px solid #ccc;
}
.size-img{
	height: 80px !important;
}
.upload{
	display: none;
}

</style>


<script type="text/javascript">

filemanager();


function filemanager(){
	 $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getimages',
        data:{},
      }).done( function(data){
      	$('.file-manager').html(data);
      });	
}	

function gallery(){
	 $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=gallery',
        data:{},
      }).done( function(data){
      	$('.content-slider').html(data);
      });	
}	

$('.btn-upload').click(function(){
	$('#imgfiles').click();
	
});

$(document).on('change', '#imgfiles', function(){
	$('.filename').html($('#imgfiles').val());
	$('.upload').show();
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
	                    $('.filename').html('');
	               }, 4000);
                	
                }
     });

}
});


$(document).on('click','.image-file',function(){

	var img = $(this).attr('src');
	var id = $(this).attr('data-id');

	$('.content-slider').html('<img data-id = "'+id+'" style = "max-width:600px" src="'+img+'" alt="" />');
	$('.next').attr('src',img);
	$('.next').attr('data-id',id);
	$('.prev').attr('src',img);
	$('.prev').attr('data-id',id);
	$('#modal-slider').modal('show');
});

$(document).on('click', '.next',function(){
	$('.prev').show();
	var img = $(this).attr('src');
	var thisid = $(this).attr('data-id');
	var id = parseInt($(this).attr('data-id')) + parseInt(1);
	var imgid = $(this).attr('data-id');
	var img = $('.img-file_'+imgid).attr('src');
	var imgsourceid = $('.image-file:last').attr('data-id');
	$('.prev').attr('data-id',id);
	$(this).attr('data-id',id);

	if (imgsourceid == thisid) {
		$('.next').hide();
		
	}
	
	$('.content-slider').html('<img data-id = "'+id+'" style = "max-width:600px" src="'+img+'" alt="" />');
});

$(document).on('click', '.prev',function(){
	$('.next').show();
	var img = $(this).attr('src');
	var thisid = $(this).attr('data-id');
	var id = parseInt($(this).attr('data-id')) - parseInt(1);
	var imgid = $(this).attr('data-id');
	var img = $('.img-file_'+imgid).attr('src');
	var imgsourceid = $('.image-file:first').attr('data-id');
	$('.next').attr('data-id',id);
	$(this).attr('data-id',id);

	if (imgsourceid == thisid) {
		$('.prev').hide();
		
	}
		
		$('.content-slider').html('<img data-id = "'+id+'" style = "max-width:600px" src="'+img+'" alt="" />');



	
});


</script>