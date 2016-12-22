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
  	display: none;
  }
  .preview{
  	display: none;
  }

  .other-content{
  	display: inline !important;
  }
  .my-options{
  	display: none !important;
  }
  .search-container, .er-msg-desc{
    display: none;
  }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-horizontal">


      <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:20px;">
        <label class="col-md-2" style = "text-align:center; background-color:#fff; margin-top:-15px">Combination : </label> 
        <div class="col-md-12">
            <div class="col-md-6">
                <select id="groups" class="flu_one inputs">
<!--                     <option value='lagnat'>Lagnat</option>
                    <option value='bp'>Body Pain</option>
                    <option value='sipon'>Sipon</option>
                    <option value='ubo'>Ubo</option> -->
                <select><span class = "er-msg">Symptom should not be empty *</span>
            </div>
            <div class="col-md-6">
                <select id="sub_groups" class="flu_two inputs">
<!--                     <option data-group='lagnat' value='lagnat'>Lagnat</option>
                    <option data-group='bp' value='bp'>Body Pain</option>
                    <option data-group='sipon' value='sipon'>Sipon</option>
                    <option data-group='ubo' value='ubo'>Ubo</option> -->

                <select><span class = "er-msg">Symptom should not be empty *</span>
            </div>
        </div>
      </div>


           <div class="col-md-12 pad-5" style = "border:1px solid #ccc; margin-top:30px;">
        <label class="col-md-4" style = "text-align:center; background-color:#fff; margin-top:-15px">Thumbnail (image size: 70x70px) : </label>  
        <div class="col-md-12">
          <div class="col-md-2">
            <a class = "btn btn-success btn-select-thumb-image" style = "padding:1px 5px"> Select Image</a>
          </div>
          <div class="col-md-2 thumbimage txt-right">
        </div>
        <input type = "hidden" name = "thumbnailimage" class = "thumbnailimage inputs"><span class = "er-msg">Thumbnail should not be empty *</span>
        </div>
      </div>
		</div>
	</div>
</div>




<script>
    $(document).ready(function () {
     $(".article-new").cleditor();


     $('.save').click(function() {
     	 $('.msg').html('Successfully Save...');

      var flu_one = $("#groups option:selected").val();
      var flu_two = $("#sub_groups option:selected").val();
      var flu_one_text = $("#groups option:selected").text();
      var flu_two_text = $("#sub_groups option:selected").text();
      var title = flu_one_text+" and "+flu_two_text;
      var thumbnailimage = $('.thumbnailimage').val();

if(validateFields() == 0){
     	$.ajax({
	        type: 'Post',
	        url: 'dashboard.php?function=save_combination',
	        data:{title:title, thumbnailimage:thumbnailimage, flu_one:flu_one, flu_two:flu_two},
	      }).done( function(data){

          var obj = JSON.parse(data);
          if(obj.status == 'success'){
             $('#success-modal').modal('show');
           } else {
              alert(obj.status);
           }
	     }); 
}

     });

     $(document).on('click', '.image-file', function(){
        var img = $(this).attr('src');
        $('.pathtocopy').val(img);
        $('.pathtocopy').show();
        $('.btn-insert-video').show();

     });



      $('.btn-navigation').addClass('col-md-12');
     $('.btn-navigation').removeClass('col-md-7');

     $('.btn-copy').click(function(){
        var path = '<img src="'+$('.pathtocopy').val()+'">';
        var htm = $('.article-new').val() + path;
        $('.article-new').val(htm).blur();
     });

     $('.btn-insert-video').click(function(){
        var path = '<video width="400px" controls ><source title="'+$('.pathtocopy').val()+'" src="'+$('.pathtocopy').val()+'"  type="video/mp4"></video>';
        var htm = $('.article-new').val() + path;
        $('.article-new').val(htm).blur();
     });

     $('.btn-select-thumb-image').click(function(){
    $('.c-copy').hide();
    thumb_filemanager();
    $('#select-thumbnail-modal').modal('show');

});

function thumb_filemanager(){
   $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getimages',
        data:{},
      }).done( function(data){
        $('.file-manager').html(data);
      }); 
  }

function validateFields() {

      var counter = 0;

      if($('.mytext').val() == ''){
                $('.er-msg-desc').show();
                counter++;
      } else{
          $('.er-msg-desc').hide();
      }

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


  $('.btn-insert-thumbnail').click(function(){
    var path = $('.pathtocopy').val();
    $('.thumbimage').html('<span class = "glyphicon glyphicon-remove btn-remove-thumbnail"></span><img width="100%" src = "'+path+'">');
    $('.thumbnailimage').val(path);
  });
   
   $(document).on('click', '.btn-remove-thumbnail', function(){
    $('.thumbimage').html('');
    $('.thumbnailimage').val('');
   });



get_combination_alias();
  function get_combination_alias(){
  var limit = '999999';
  var offset = '1';
  var table = "pag2flu_symptoms";
  var order_by = "id";
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getlist_global',
        data:{limit:limit, offset:offset,table:table,order_by:order_by},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '', htm1 = '';
              htm1 += "<option value=''>Select symptoms</option>";
              htm += "<option value=''>Select symptoms</option>";
          $.each(obj, function(index, row){ 
              // alert(row.alias);
              htm += "<option value='"+row.alias+"'>"+row.name+"</option>";
              htm1 += "<option data-group='"+row.alias+"' value='"+row.alias+"'>"+row.name+"</option>";
            });
            $('#groups').html('');
            $('#groups').html(htm);
            $('#sub_groups').html('');
            $('#sub_groups').html(htm1);
     }); 
}


 });

</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#groups').on('change', function(){
        var val = $(this).val();
        var sub = $('#sub_groups');
        $('option', sub).filter(function(){
            if (
                 $(this).attr('data-group') !== val 
            ) {
              if ($(this).parent('span').length) {
                $(this).unwrap();
              }
            } else {
              if (!$(this).parent('span').length) {
                $(this).wrap( "<span>" ).parent().hide();
                $('#sub_groups option[value='+val+']').attr('selected',false);
              }
            }
        });
    });
    $('#groups').trigger('change');
});
</script>