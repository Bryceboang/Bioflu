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
   .my-options{
    display: none !important;
  }
  .other-content{
    display:block !important;
  }
  .cat-set,.start-pub,.end-pub,.hit{
    display: none !important;
  }
</style>
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
		<input type="button" class="save" value="Save">		
	</div>
</div> -->



<script>
    $(document).ready(function () {
     $(".ads-new").cleditor(); 

     $('.save').click(function() {
      if(validateFields() == 0){
     	$('.msg').html('Successfully Saved...');
       var title = $('.titles').val();
       var subtitle = $('.subtitle').val();
       var yeslink =  $('.yeslink').val();
       var nolink =   $('.nolink').val();

     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=add_ads',
	        data:{title:title, subtitle:subtitle, yeslink:yeslink,nolink:nolink},
	      }).done( function(data){
             $('#success-modal').modal('show');
	     }); 

      }
     });

$('.btn-navigation').addClass('col-md-12');
     $('.btn-navigation').removeClass('col-md-6');

     $('.btn-copy').click(function(){
        var path = '<img src="'+$('.pathtocopy').val()+'">';
        var htm = $('.ads-new').val() + path;
        $('.ads-new').val(htm).blur();
     });

     $('.btn-insert-video').click(function(){
        var path = '<video width="400px" controls ><source title="'+$('.pathtocopy').val()+'" src="'+$('.pathtocopy').val()+'"  type="video/mp4"></video>';
        var htm = $('.ads-new').val() + path;
        $('.ads-new').val(htm).blur();
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