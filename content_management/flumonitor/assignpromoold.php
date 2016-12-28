<style type="text/css">

.list-drugstore{
	height: 300px;
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
	height: 300px;
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
	height: 300px;
}
</style>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
		<div class="col-md-12 pad-0">
			<div class="col-md-2"><label>Choose Promotion</label></div>
			<div class="col-md-10"><select name = "list-promo" class = "list-promo"></select></div>
			
		</div>
		<div class="col-md-12 pad-0">
			<div class="col-md-5 pad-0">
				<div class="col-md-12"><label>Drugstore</label></div>
				<div class="col-md-12">
					<div class="list-drugstore">
			
					</div>
				</div>
			</div>
			<div class="col-md-1 btns">
				<button class = "btn btn-default btn-right">
					<span class = "glyphicon glyphicon-chevron-right "></span>
				</button>
				<br>
				<button class = "btn btn-default btn-left">
					<span class = "glyphicon glyphicon-chevron-left "></span>
				</button>
			 </div>
			<div class="col-md-5">
				<div class="col-md-12"><label>Promo</label></div>
				<div class="col-md-12 list-assign-promotion"></div>
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

              
             htm+="<p data-id = '"+row.id+"' class = 'chk-drugstore is_active_"+row.id+"'>";
             htm+="<input class = 'select chk-drugstore_"+row.id+"' data-id = '"+row.id+"' type ='checkbox'>";
             htm+=row.name;
             htm+="</p>";
           
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

              
             htm+="<p data-id-2 = '"+row.id+"' class = 'chk-drugstore-2 is_active-2_"+row.id+"'>";
             htm+="<input class = 'select-2 chk-drugstore-2_"+row.id+"' data-id-2 = '"+row.id+"' type ='checkbox'>";
             htm+=row.name;
             htm+="</p>";
           
            });
          $('.list-assign-promotion').html('');
          $('.list-assign-promotion').html(htm);
     }); 
  }


  $(document).on('click','.chk-drugstore', function(){
  	var id = $(this).attr('data-id');
  	$('.chk-drugstore_'+id).click();
  	$('.is_active_'+id).addClass('active');
  	$('.is_active_'+id).removeClass('chk-drugstore');
  	$('.is_active_'+id).addClass('unchk-drugstore');
  });

   $(document).on('click','.unchk-drugstore', function(){
   	var id = $(this).attr('data-id');
  	$('.chk-drugstore_'+id).click();
  	$('.is_active_'+id).removeClass('active');
  	$('.is_active_'+id).removeClass('unchk-drugstore');
  	$('.is_active_'+id).addClass('chk-drugstore');
   	});


  $(document).on('click','.chk-drugstore-2', function(){
  	var id = $(this).attr('data-id-2');
  	$('.chk-drugstore-2_'+id).click();
  	$('.is_active-2_'+id).addClass('active-2');
  	$('.is_active-2_'+id).removeClass('chk-drugstore-2');
  	$('.is_active-2_'+id).addClass('unchk-drugstore-2');
  });

   $(document).on('click','.unchk-drugstore-2', function(){
   	var id = $(this).attr('data-id-2');
  	$('.chk-drugstore-2_'+id).click();
  	$('.is_active-2_'+id).removeClass('active-2');
  	$('.is_active-2_'+id).removeClass('unchk-drugstore-2');
  	$('.is_active-2_'+id).addClass('chk-drugstore-2');
   	});

   $('.btn-right').click(function(){

     $('.select').each(function() {  
     var drugstore_id = $(this).attr('data-id');
     var promo_id = $('.list-promo').val();    
        
          if (this.checked==true) {
          		assiged_promo(drugstore_id, promo_id);
          }

      });
   });

   $('.btn-left').click(function(){

     $('.select-2').each(function() {  
     var id = $(this).attr('data-id-2');
     var promo_id = $('.list-promo').val();    
        
          if (this.checked==true) {
          		remove_promo(id)
          }

      });
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
        var id_promo = $('.list-promo').val();
      	get_list_promotion(id_promo);
      	get_list();
     }); 
  }

     function remove_promo(id){
   
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=remove_promo',
        data:{id:id},
      }).done( function(data){
        var id_promo = $('.list-promo').val();
      	get_list_promotion(id_promo);
      	get_list();

     }); 
  }


$(document).on('change', '.list-promo', function(){
  var id = $('.list-promo').val();
  get_list_promotion(id);
});

</script>