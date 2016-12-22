<?php 
  $table = "maps_default";
  $order_by = "id";
?>


<link rel="stylesheet" type="text/css" href="./css/list.css">
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class = "table listdata" style="margin-bottom:0px;">
          <thead>
            <tr>
            <th style = "width:10px;"><input class = "selectall" type = "checkbox"></th>
            <th>Place</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>State</th>
            <th>Edit</th>
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
  var limit = '10';
  var offset = '1';
  get_list(limit,offset);
  get_pagination('1',limit);
  $(document).on('click', '.btn-close2', function(){
      get_list(limit,offset);
        get_pagination('1',limit);
      $('.inactive').hide();
      $('.selectall').attr('checked', false);
        $('#success-modal').modal('hide');    
     });
  $(document).on('change','.page-number', function() {
    var page_number = parseInt($(this).val());
      $('.listdata tbody').html('');
      get_list(limit,page_number);
  });
  $(document).on('click','.next-page', function() {
    var page_number = parseInt($('.page-number').val());
    var next = page_number +1;
    if(page_number!=last()){
      get_list(limit,next);
      $('.page-number').val(next);
    }
  });
  $(document).on('click','.last-page', function() {
    var page_number = parseInt($('.page-number').val());
    if(page_number!=last()){
      get_list(limit,last());
      $('.page-number').val($('.page-number option:last').val());
    }
  });
  $(document).on('click','.prev-page', function() {
    var page_number = parseInt($('.page-number').val());
    var prev = page_number -1;
    if(page_number!=first()){
      get_list(limit,prev);
      $('.page-number').val(prev);
    }
  });
  $(document).on('click','.first-page', function() {
    var page_number = parseInt($('.page-number').val());
    if(page_number!=first()){
      get_list(limit,first());
      $('.page-number').val($('.page-number option:first').val());
    }
  });
  function first(){
    return parseInt($('.page-number option:first').val());
  }
  function last(){
    return parseInt($('.page-number option:last').val());
  }
  function get_list(limit,offset){
    $('.delete').hide();
    $('.inactive').hide();
    $('.selectall').attr('checked', false);
    var table = "<?=$table;?>";
    var order_by = "<?=$order_by;?>";
    
    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getlist_global',
        data:{limit:limit, offset:offset, table:table, order_by:order_by},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm = '';
            
          $.each(obj, function(index, row){ 
            if(row.state==1){
              var state = 'Active';
            }
            else{
              var state = 'Inactive';
            }
            
              htm+="<tr>";
              htm+="<td><input class = 'select' data-id = '"+row.id+"' type ='checkbox'></td>";
              htm+="<td><d style='color:#3071a9'>"+row.name+"</d></td>";
              htm+="<td>"+row.default_long+"</td>";
              htm+="<td>"+row.default_lat+"</td>";
              htm+="<td>"+state+"</td>";
              htm+="<td><a class='edit' data-status='"+row.state+"' id='"+row.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
              htm+="</tr>";
            });
          $('.listdata tbody').html('');
          $('.listdata tbody').html(htm);
     }); 
  }
  function get_pagination(page_num,limit){
    var table = "<?=$table;?>";
    var order_by = "<?=$order_by;?>";

    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=getcount_global',
        data:{limit:limit, table:table, order_by: order_by},
      }).done( function(data){
          var htm = '';
          htm += '<span class = "glyphicon glyphicon-step-backward first-page"></span><span class = "glyphicon glyphicon-triangle-left prev-page"></span><select class="page-number"> ';
          for(var x =1; x<=data; x++){
            htm += "<option value='"+x+"'>"+x+"</option>";
          }
          htm += '</select><span class = "glyphicon glyphicon-triangle-right next-page"></span><span class = "glyphicon glyphicon-step-forward last-page"></span>';
          $('.pagination').html('');
          $('.pagination').html(htm);
     }); 
  }
  $('.selectall').click(function(){
     if(this.checked) { 
            $('.select').each(function() { 
                this.checked = true;  
                $('.delete').show();
                $('.inactive').show();           
            });
        }else{
            $('.select').each(function() { 
              $('.delete').hide();
                $('.inactive').hide();
                this.checked = false;                 
            });         
        }
  });
   $(document).on('click', '.select', function(){
    var x = 0;

          $('.select').each(function() {                
                if (this.checked==true) {
                  x++;
                } 
          
                if (x > 0 ) {
                   $('.delete').show();
                   $('.inactive').show(); 
                }
              else{
                $('.delete').hide();
                $('.inactive').hide();
                $('.selectall').attr('checked', true);
              }
            });
  });
   $(document).on('click', '.inactive', function(){
    var x = 0;
    var data_type = $(this).attr('data-type');
      $('.select').each(function() {                
          if (this.checked==true) {
             x++;
          } 
          if (x > 0 ) {
            $('.modal-footer .btn-close').hide();
            $('.msg').html('<p>Are you sure you want to '+data_type+' this record? <button data-type = "'+data_type+'" class = "btn-remove"> Yes </button><button class = "btn-close2"> No </button></p>');
            $('#success-modal').modal('show');
          }
      });
   });
    $(document).on('click', '.btn-remove', function(){
    var x = 0;
    var type = $(this).attr('data-type');
    if (type == 'Trash') {
      var type = '-2';
    }
    if (type == 'Inactive') {
      var type = '0';
    }
    if (type == 'Active') {
      var type = '1';
    }
      $('.select').each(function() {                
          if (this.checked==true) {
            
            var table = "<?=$table;?>";
            var order_by = "<?=$order_by;?>";

            var id = $(this).attr('data-id');
                         
              $.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=inactive_global_update',
                  data:{id:id, type:type, table:table, order_by: order_by},
                }).done( function(data){
                  $('#success-modal').modal('hide');
                    get_list(limit,offset);
                    get_pagination('1',limit);
                  });
             x++;
          } 
        
      });
   });
     $('.btn-navigation').addClass('col-md-7');
     $('.btn-navigation').removeClass('col-md-12');
});
</script>