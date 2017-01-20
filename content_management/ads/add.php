<style type="text/css">
  .update{
    display: none;
  }
  .save{
    display: inline;
  }
   .pagination{
    display: none;
  }
   .inactive{
    display: none !important;
  }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-2">Title : </label>	
				<div class="col-md-10">
					<input type="text" name="title" class="form-control titles">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<textarea class="ads-new"></textarea>		
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-12">
		<input type="button" class="save" value="Save">		
	</div>
</div> -->



<script>
    $(document).ready(function () {
     $(".ads-new").cleditor(); 

     $('.save').click(function() {
     	$('.msg').html('Successfully Saved...');
     	var content = $('.ads-new').val();
     	var title = $('.titles').val();


     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=add_ads',
	        data:{title:title, content:content},
	      }).done( function(data){
             $('#success-modal').modal('show');
	     }); 


     });


 });

</script>