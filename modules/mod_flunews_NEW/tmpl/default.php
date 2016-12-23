<div class="original-container">

</div>

<div class="curated-container">

</div>

<script type="text/javascript">
$(document).ready(function(){
var base_url = jQuery('body').attr('data-baseurl')+'/';
var offset = '1';
var cat = '1';
$.ajax({
  type: 'Post',
    url: 'templates/bioflu/controller_tek.php?query=get_article_limit',
}).done(function(data){
  var obj = JSON.parse(data);
  $.each(obj, function(x,y){
    var limit = y.limit_archive;
    get_list(cat,limit,offset);
  });
});

function get_list(cat,limit,offset){
	$.ajax({
		type: 'Post',
		url: 'templates/bioflu/controller_tek.php?query=get_articleList',
		data:{cat:cat, limit:limit, offset:offset}
	}).done(function(data){
		alert(data);
	});
}

});
</script>
