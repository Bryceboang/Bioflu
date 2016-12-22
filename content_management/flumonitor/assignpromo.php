<style type="text/css">

.list-drugstore{
	height: 270px !important;
	overflow-y:scroll;
	font-size: 11px;
	border:1px solid #ccc;
	padding: 5px;
}
.list-drugstore .active{
	background: #ccc;
}

.chk-drugstore , .unchk-drugstore{
	color:#3071a9; cursor:pointer; margin:0;
}
.select{
	display: none;
}

.list-assign-promotion{
	height: 270px !important;
	overflow-y:scroll;
	font-size: 11px;
	border:1px solid #ccc;
	padding: 5px;
}
.list-assign-promotion .active-2{
	background: #ccc;
}

.chk-drugstore-2 , .unchk-drugstore-2{
	color:#3071a9; cursor:pointer; margin:0;
}
.select-2{
	display: none;
}

.btns{
	padding-top: 150px;
	height: 270px;
}
.nav-promo{
  padding-top: 20px;
  padding-bottom: 20px;
}
.top-5{
  margin-top: 5px;
}
</style>

<div class="col-md-12 nav-promo">
      <button class = "btn btn-primary btn-standard btn-saved" >Save</button>
      <!-- <button class = "btn btn-default btn-standard btn-cancel" >Cancel</button> -->
    </div> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
     
		<div class="col-md-12 pad-0">
			<div class="col-md-2"><label>Choose Promotion</label></div>
			<div class="col-md-10"><select name = "list-promo" class = "list-promo fullwidth" ></select></div>
			
		</div>
		<div class="col-md-12 pad-0">
			<div class="col-md-5 pad-0">
				<div class="col-md-12"><label>Drugstore</label></div>
				<div class="col-md-12">
					<select class="list-drugstore fullwidth" multiple>
			
					</select>
				</div>
			</div>
			<div class="col-md-2 btns">
        <div class="col-md-12">
        <button class = "btn btn-default btn-left">
          <span class = "glyphicon glyphicon-triangle-left "></span>
        </button>
				<button class = "btn btn-default btn-right">
					<span class = "glyphicon glyphicon-triangle-right "></span>
				</button>
				</div>

      <div class="col-md-12 top-5">
        <button class = "btn btn-default btn-left-all">
          <span class = "glyphicon glyphicon-step-backward "></span>
        </button>
        <button class = "btn btn-default btn-right-all">
          <span class = "glyphicon glyphicon-step-forward "></span>
        </button>
        </div>
			 </div>
			<div class="col-md-5">
				<div class="col-md-12"><label>Promo</label></div>
				<select class="col-md-12 list-assign-promotion fullwidth" multiple></select>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript">

get_list();
 function get_list(){
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_drugstore_assign',
        data:{},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 

              
             htm+="<option class = 'a' value = '"+row.id+"'>";
             htm+=row.name;
             htm+="</option>";
           
            });
          $('.list-drugstore').html('');
          $('.list-drugstore').html(htm);
     }); 
  }



  get_list_promotion('1');
 function get_list_promotion(id){
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_assign_promotion',
        data:{id:id},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 

              
             htm+="<option class = 'b' value = '"+row.id+"'>";
             htm+=row.name;
             htm+="</option>";
           
            });
          $('.list-assign-promotion').html('');
          $('.list-assign-promotion').html(htm);
     }); 
  }




   $('.btn-right').click(function(){
      var selectedOpts = $('.list-drugstore option:selected');
      var selected_class = $('.list-drugstore option:selected').attr("class");

      $('.list-drugstore').find('option:selected').each(function(key,value) {
        var selected_id = value.value;
        $(".list-drugstore option[value='"+selected_id+"']").remove();
      });

      if (selectedOpts.length != 0) {
        $(selectedOpts).attr('id', $('.list-promo').val());
        $('.list-assign-promotion').append($(selectedOpts).clone());  
      }

   });

   $('.btn-left').click(function(){
      var selectedOpts = $('.list-assign-promotion option:selected');
      var selected_class = $('.list-assign-promotion option:selected').attr("class");

      $('.list-assign-promotion').find('option:selected').each(function(key,value) {
        var selected_id = value.value;
        $(".list-assign-promotion option[value='"+selected_id+"']").remove();
      });

      if (selectedOpts.length != 0) {
        $(selectedOpts).attr('class', 'b');
        $('.list-drugstore').append($(selectedOpts).clone());
      }
   });

   $('.btn-right-all').click(function(){
      var selectedOpts = $('.list-drugstore option');

      if (selectedOpts.length != 0) {
        $(selectedOpts).attr('id', $('.list-promo').val());
          $('.list-assign-promotion').append($(selectedOpts).clone());
          $(selectedOpts).remove();
        }
   });

    $('.btn-left-all').click(function(){
        var selectedOpts = $('.list-assign-promotion option');

        if (selectedOpts.length != 0) {
          $(selectedOpts).attr('class', 'b');
            $('.list-drugstore').append($(selectedOpts).clone());
            $(selectedOpts).remove();
          }
   });


get_promo_list();

   function get_promo_list(){
   
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_promo',
        data:{limit:'0', offset:'0'},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 
              htm+="<option value = '"+row.promotion_id+"'>";
            
              htm+=row.promotion_description;
             
              htm+="</option>";
            });
          $('.list-promo').html('');
          $('.list-promo').html(htm);
     }); 
  }



   function assiged_promo(drugstore_id, promo_id){
   
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=assign_promotion',
        data:{drugstore_id: drugstore_id, promo_id: promo_id},
      }).done( function(data){
        setTimeout(function(){
        var id_promo = $('.list-promo').val();
        get_list_promotion(id_promo);
        get_list();
        $('.btn-saved').html('Save');
        },3000);
     }); 
  }

     function remove_promo(id){
   
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=remove_promo',
        data:{id:id},
      }).done( function(data){
        setTimeout(function(){
        var id_promo = $('.list-promo').val();
      	get_list_promotion(id_promo);
      	get_list();
         $('.btn-saved').html('Save');
          },3000);
     }); 
  }


$(document).on('change', '.list-promo', function(){
  var id = $('.list-promo').val();
  get_list_promotion(id);
});

$('.btn-saved').click(function(){
 
   $('.list-assign-promotion ').find('option[class="a"]').each(function(key,value) {
        var selected_id = value.value;
        var id = value.id;
         $('.btn-saved').html('Saving '+ '<img src="assets/img/loader.gif">');
        assiged_promo(selected_id, id)
      });

    $('.list-drugstore ').find('option[class="b"]').each(function(key,value) {
        var selected_id = value.value;
        var id = value.id;
         $('.btn-saved').html('Saving '+ '<img src="assets/img/loader.gif">');
       remove_promo(selected_id);
      });
});

</script>