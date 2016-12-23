<div class="row">

<div class="col-md-12 list-data">

	<div class="table-responsive">

	<table class = "table listdata" style="margin-bottom:0px;">

	<thead>

	<tr>

	<th style = "width:10px;"><input class = "selectall" type = "checkbox"></th>

	<th>Name</th>

	<th>Comment</th>

  <th>Article</th>

  <th>Type</th>

  <th>Status</th>   

	</tr>  

	</thead>

	<tbody>

	</tbody>

	</table>

	</div>

</div>

</div>



<script type="text/javascript">

		

button();



 function button(){

 	var htm = '';

 	htm+='<button data-type = "Active" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-ok"></span>Active</button>';

 	htm+='<button data-type = "Inactive" class="inactive btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Inactive</button>';

 	// htm+='<button class="btn-list btn-min btn btn-default"><span class = "glyphicon glyphicon-remove-circle"></span>Close</button>';

 	$('.btn-navigation').html(htm);

 }						





  

  var limit = '10';

  var offset = '1';



  get_list(limit,offset);

  get_pagination('1',limit);





  $(document).on('change','.s-page-number', function() {

    var page_number = parseInt($(this).val());

      $('.listdata tbody').html('');

      get_list(limit,page_number);

  });



  $(document).on('click','.s-next-page', function() {

    var page_number = parseInt($('.s-page-number').val());

    var next = page_number +1;

    if(page_number!=last()){

      get_list(limit,next);

      $('.s-page-number').val(next);

    }

  });



  $(document).on('click','.s-last-page', function() {

    var page_number = parseInt($('.s-page-number').val());

    if(page_number!=last()){

      get_list(limit,last());

      $('.s-page-number').val($('.s-page-number option:last').val());

    }

  });



  $(document).on('click','.s-prev-page', function() {

    var page_number = parseInt($('.s-page-number').val());

    var prev = page_number -1;

    if(page_number!=first()){

      get_list(limit,prev);

      $('.s-page-number').val(prev);

    }

  });



  $(document).on('click','.s-first-page', function() {

    var page_number = parseInt($('.s-page-number').val());

    if(page_number!=first()){

      get_list(limit,first());

      $('.s-page-number').val($('.s-page-number option:first').val());

    }

  });



  function first(){

    return parseInt($('.s-page-number option:first').val());

  }



  function last(){

    return parseInt($('.s-page-number option:last').val());

  }



	function get_list(limit,offset){

    $('.delete').hide();

    $('.inactive').hide();

    $('.selectall').attr('checked', false);

    

    $.ajax({

        type: 'Post',

        url: 'dashboard.php?function=get_comments',

        data:{limit:limit, offset:offset},

      }).done( function(data){

              var obj = JSON.parse(data);

              var htm = '';

            

          $.each(obj, function(index, row){ 

            if(row.is_active==1){

              var status = 'Active';

            }

            else{

              var status = 'Inactive';

            }

            if(row.is_parent==1){

              var type_com = 'Comment';

            }

            else{

              var type_com = 'Reply';

            }

              htm+="<tr>";

              htm+="<td><input class = 'select'  data-id = '"+row.id+"' type ='checkbox'></td>";

              htm+="<td><p style='color:#3071a9'>"+row.fb_name+"</p></td>";


              htm+="<td><p style='color:#3071a9'>"+row.comment+"</p></td>";

              htm+="<td><p style='color:#3071a9'>"+row.article_title+"</p></td>";

              htm+="<td><p style='color:#3071a9'>"+type_com+"</p></td>";

              htm+="<td>"+status+"</td>";

              htm+="</tr>";

            });

          $('.listdata tbody').html('');

          $('.listdata tbody').html(htm);

     }); 

  }



  function get_pagination(page_num,limit){

    $.ajax({

        type: 'Post',

        url: 'dashboard.php?function=get_comments_count',

        data:{limit:limit},

      }).done( function(data){

          var htm = '';

          htm += '<span class = "glyphicon glyphicon-step-backward s-first-page"></span><span class = "glyphicon glyphicon-triangle-left s-prev-page"></span><select class="s-page-number"> ';

          for(var x =1; x<=data; x++){

            htm += "<option value='"+x+"'>"+x+"</option>";

          }

          htm += '</select><span class = "glyphicon glyphicon-triangle-right s-next-page"></span><span class = "glyphicon glyphicon-step-forward s-last-page"></span>';



          $('.pagination').html('');

          $('.pagination').html(htm);

     }); 

  }






$(document).on('click', '.btn-cancel', function(){

	$('.single-data').hide();


	$('.list-data').show();

  	$('.pagination').show();


  	$('.btn-list').show();

});





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


    if (type == 'Inactive') {

      var type = '0';

    }



    if (type == 'Active') {

      var type = '1';

    }

      $('.select').each(function() {                

          if (this.checked==true) {

            

             var id = $(this).attr('data-id');

              $.ajax({

                  type: 'Post',

                  url: 'dashboard.php?function=update_comments',

                  data:{id:id, status:type},

                }).done( function(data){

                  $('#success-modal').modal('hide');

                    get_list(limit,offset);

                    get_pagination('1',limit);

                  });



             x++;

          } 



        



      });

   });

</script>
