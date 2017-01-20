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

<div class="col-md-12">
<a class="btn-export-excel btn-min btn btn-primary">Export to Excel</a>
<!-- <a href = "dashboard.php?function=export_tweets" class="btn-export-excel btn-min btn btn-primary">Export to Excel</a> -->
</div>
<div class="col-md-12"><label>SYMPTOMS OVERVIEW</label></div>
<div class="col-md-12">
<div class="col-md-3 pad-0">
<div class="col-md-4 pad-0"><p>Coverage:</p></div>
<div class="col-md-8 pad-0"><input type ="text" class ="start fullwidth"></div>
</div>
<div class="col-md-3">
<div class="col-md-1 pad-0"><p>to </p></div>
<div class="col-md-11 pad-0"><input type ="text" class ="end fullwidth"></div>
</div>
<div class="col-md-2 pad-0"><button class = "filter">Filter</button></div>
</div>
<div class="col-md-12"><span class = "er-msg">End Date should be greater than start date.</span></div>
<div class="col-md-12 ">
	<div class="table-responsive listdata">
	</div>
</div>

<div class="date_today" data-date="<?php echo date('Y-m-d'); ?>"></div>
<script type="text/javascript">
$('.filter').click(function(){
  var startdate = $('.start').val();
  var enddate = $('.end').val();
  if (startdate > enddate) {
    $('.er-msg').show();
  }else{
    $('.er-msg').hide();
    get_list(startdate, enddate);
  }
  
});
var today= $('.date_today').attr('data-date');
get_list('0000-00-000', today);
	function get_list(startdate, enddate){
    $.ajax({
        type: 'Post',
        url: "dashboard.php?function=export_twitterinterjection&startdate="+startdate+"&enddate="+enddate,
        data:{},
      }).done( function(data){
          $('.listdata').html('');
          $('.listdata').html(data);
     }); 
  }

$(function() {
 $(".start").datepicker({ dateFormat: "dd-mm-yy" }).val()
 $(".end").datepicker({ dateFormat: "dd-mm-yy" }).val()
});

$('.btn-export-excel').click(function(){
  var startdates = $('.start').val();
  var enddates = $('.end').val();

  if (startdates.length==0 && enddates.length==0 ) {
    var startdate = '0000-00-000';
    var enddate = today;

  }else{
   var startdate = $('.start').val();
   var enddate = $('.end').val();
  }

   window.location="dashboard.php?function=export_twitterinterjection&startdate="+startdate+"&enddate="+enddate;
  

});
</script>

