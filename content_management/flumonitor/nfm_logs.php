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

.pagination{

	display: none;

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




get_list();

	function get_list(){

    $.ajax({

        type: 'Post',

        url: "dashboard.php?function=get_logs",

        data:{},

      }).done( function(data){

          $('.listdata').html('');

          $('.listdata').html(data);

     }); 

  }






</script>



