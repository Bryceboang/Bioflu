<style type="text/css">
  .update{
    display: inline;
  }
  .save{
    display: none;
  }
   .pagination{
    display: none;
  }
   .inactive{
    display: none !important;
  }
   .btn-videomanager{
    display: inline !important;
  }
  .my-options{
    display: none !important;
  }
  .other-content{
    display:block !important;
  }
  .cat-set,.start-pub,.end-pub,.hit{
    display: none !important;
  }
  .article_add,.btn-videomanager,.btn-filemanager{
    display: none !important;
  }
</style>
<!-- "<?php echo $_GET['id'];?>"; -->
<script>
    $(document).ready(function () {

     var base_path = window.location.href;
      base_path = base_path.replace('content_management/widgets.php','');
      $('.trash').hide();
     var id = "1";
      $('.edit-id').attr('data-edit-id',id);
	$.ajax({
        type: 'Post',
        url: 'dashboard.php?function=edit_ads',
        data:{id:id},
      }).done( function(data){
          var obj = JSON.parse(data);
          $.each(obj, function(index, row){
          		$('.titles').val(row.title);
          		// var content = row.subtitle;
          		// content = content.replace(/\images/g,'../images');
          		$('.subtitle').val(row.subtext);
              $('.yeslink').val(row.yes_link);
              $('.nolink').val(row.no_link);
              $('.status option[value="'+row.status+'"]').attr('selected','selected');
      		});
     });      

     $('.update').click(function() {

      if(validateFields() == 0){
      $('.msg').html('Successfully Update...');
       var title = $('.titles').val();
       var subtitle = $('.subtitle').val();
       var yeslink =  $('.yeslink').val();
       var nolink =   $('.nolink').val();
       var status = $(".status option:selected").val();

       
     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=update_ads',
	        data:{id:id, title:title, subtitle:subtitle, yeslink:yeslink,nolink:nolink,status:status},
	      }).done( function(data){

               $('#success-modal').modal('show');
	     }); 
      }
     });

     $('.preview').click(function() {
        $('.msg').html('<iframe name="iframe2" src="'+base_path+'avoid-these-flu-prone-areas-during-the-rainy-season'+'" style="width:100%; height:80%;"></iframe>');
        $('#preview').modal('show');

     });

$('.btn-navigation').addClass('col-md-12');
     $('.btn-navigation').removeClass('col-md-6');

     $('.btn-copy').click(function(){
        var path = '<img src="'+$('.pathtocopy').val()+'">';
        var htm = $('.ads-edit').val() + path;
        $('.ads-edit').val(htm).blur();
     });

     $('.btn-insert-video').click(function(){
        var path = '<div><video width="400px" controls ><source title="'+$('.pathtocopy').val()+'" src="'+$('.pathtocopy').val()+'"  type="video/mp4"></video>';
        var htm = $('.ads-edit').val() + path;
        $('.ads-edit').val(htm).blur();
     });

     $(document).on('click', '.image-file', function(){
        var img = $(this).attr('src');
        $('.pathtocopy').val(img);
        $('.pathtocopy').show();
        $('.btn-insert-video').show();
     });

      function validateFields() {

            var counter = 0;

            $('.inputs').each(function(){
                var input = $(this).val();
                if (input.length == 0) {
                  $(this).next().show();
                  counter++;
                }else{
                  $(this).next().hide();
                }
            });

          return counter;
      }

 });

</script>
<div class="edit-id" data-edit-id = ""></div>
<form id="edit_article">
<div class="row">
	<div class="col-md-12">
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-2">Title : </label>	
				<div class="col-md-10">
					<input type="text" name="title" class="form-control titles inputs"><span class = "er-msg">Title should not be empty *</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="control-label col-md-2">sub-text : </label>  
        <div class="col-md-10">
          <input type="text" name="subtitle" class="form-control subtitle inputs"><span class = "er-msg">Sub-text should not be empty *</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="control-label col-md-2">Yes Link: </label>  
        <div class="col-md-10">
          <input type="text" name="yeslink" class="form-control yeslink inputs"><span class = "er-msg">Yes link should not be empty *</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="control-label col-md-2">No Link: </label>  
        <div class="col-md-10">
          <input type="text" name="nolink" class="form-control nolink inputs"><span class = "er-msg">No link should not be empty *</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <div class="row">
	<div class="col-md-12">
		<textarea class="ads-edit"></textarea>
	</div>
</div> -->
<!-- <div class="row">
	<div class="col-md-12">
		<input type="button" class="update" value="Save">		
	</div>
</div> -->
</form>
