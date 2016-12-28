<style type="text/css">
  .update{
    display: none;
  }
  .save{
    display: none;
  }
  .preview{
    display: none;
  }
  
  .iPhoneCheckContainer span{
    width: 12px !important;
  }
 /* .iPhoneCheckHandleRight{
    width: 50% !important;
  }*/
</style>


<div class="row">

	<div class="col-md-12">

		<div class="table-responsive">

			<table class = "table listdata">
          <thead>
            <tr>
            
            <th>Menu</th>
            <th>Status</th>

          </tr>  
          </thead>
          <tbody>
            
          </tbody>
        

			</table>
		</div>
	</div>

</div>

<script>

$(document).ready(function() {

  
get_menu();
	function get_menu(){
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=menu',
        data:{},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 

             if(row.is_active==1){
              var status = '<td><input data-id = "'+row.id+'" class = "check" type="checkbox" checked="checked" id="1"/></td>';
            }
            else{
              var status = '<td><input data-id = "'+row.id+'" class = "check" type="checkbox" id="0"  /></td>';
            }
              htm+="<tr >";
              htm+="<td>"+row.menu+"</td>";
              htm+=status;
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }

$(document).on('click', '.btn-save', function(){
    $('.check').each(function() {   
        var id = $(this).attr('data-id');
        var status = $(this).attr('id');

        $.ajax({
          type: 'Post',
          url: 'dashboard.php?function=updatesetting_controller',
          data:{id: id, status: status},
        }).done( function(data){
          $('.msg').html('Successfully saved...');
           $('#success-modal').modal('show');
           get_menu();
         });

    });

});

$(document).on('click', '.check', function(){
  if (this.checked==true) {
  $(this).attr('id', '1');
}else{
  $(this).attr('id', '0');
}
});

});

</script>


