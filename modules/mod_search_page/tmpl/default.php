<div class="search-container">
<?php 
echo "<label>Search Result for <span class='search-term'><i>".$_GET['query']."</i></span></label>";
?>
<div class="search-result row">

</div>
<div class="pagination">
	<label>Page: </label><ul class="s-pagination"></ul>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
var search_term = $('.search-term').text();
var url = '<?php echo JURI::root(); ?>';
var limit = '5';
var offset = '1';
get_pagination('1',limit,search_term);
get_all(search_term,limit,offset);

function get_all(search_term,limit,offset){
	$.ajax({
		type: 'post',
		url: 'templates/bioflu/controller_tek.php?query=getSearch',
		data: {search_term:search_term, limit:limit, offset:offset}
	}).done(function(data){
		var obj = JSON.parse(data);
		var htm = '';
		if (obj != ''){
			$.each(obj, function(x,y){
				var alias = y.article_title;
				var alias2 = alias.replace(/ /g,"-");
				htm += '<div class="col-md-12 col-sm-12 pad-0 search-result-container">';
				htm += '<div class="col-md-2 col-sm-3">';
				htm += '<img class="search-result-image" src="'+y.image+'">';
				htm += '</div>';
				htm += '<div class="col-md-10 col-sm-9">';
				htm += '<label><a class="search-article-title" href="'+url+'article?q='+alias2+'">'+y.article_title+'</a></label>';
				htm += '<p>'+$(y.intro_text).text().substr(0,300)+' ...</p>';
				htm += '<p class="search-tags">Tags: '+y.tags+'</p>';
				htm += '</div>';
				htm += '</div>';
			});		
		}else{
			htm += '<p>No result found for this search item.</p>';
		}
		$('.search-result').append(htm);
	});
}

function get_pagination(page_num,limit,search_term){
    $.ajax({
        type: 'Post',
        url: 'templates/bioflu/controller_tek.php?query=getSearch_count',
        data:{limit:limit, search_term:search_term},
      }).done( function(data){
          var htm = '';
          var i = '';
          
          for(var x =1; x<=data; x++){
            htm += '<li class="page-number page'+x+'" data-text="'+i+'" data-id="'+x+'">'+x+'</li>';
          }
          if (data!=1) {
          $('.s-pagination').html(htm);
          }else{
            $('.pagination').html('');
          }
         $('.page-number').first().addClass('active-page');

     }); 
  }

$(document).on('click','.page-number',function(){
	$('.page-number').removeClass('active-page');
	$(this).addClass('active-page');
});

$(document).on('click','.page-number', function() {
  var page_number = $(this).attr('data-id');;
  $(".search-result").html('');
  get_all(search_term,limit,page_number);
});


});
</script>