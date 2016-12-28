<?php date_default_timezone_set('Asia/Manila'); ?>

<style type="text/css">

.table-bordered{

  font-size: 11px !important;

  

}

.sub-twitterdata{

  font-size: 11px;

  height: 100% !important;

  width: 100%;

}

.sub-twitterdata th, td{

border: 1px solid #ccc;

}



.listdata th{

  text-align: center;

  padding: 10px;

  background: #2e6da4;

  color: #fff;

}



.listdata td{

  padding: 5px;

}

.listdata{

  margin-top: 10px;

}

.er-msg{

  color: red;

}

</style>





<div class="col-md-12 ">

  <div class="table-responsive listdata">

  </div>

</div>





<script type="text/javascript">













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



    $.ajax({

        type: 'Post',

        url: "dashboard.php?function=get_twitter_reports",

         data:{limit:limit, offset:offset, data_get:'list'},

      }).done( function(data){

          $('.listdata').html('');

          $('.listdata').html(data);

     }); 

  }



  function get_pagination(page_num,limit){

    $.ajax({

        type: 'Post',

        url: 'dashboard.php?function=get_twitter_reports_count',

        data:{limit:limit, data_get:'list'},

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







</script>



