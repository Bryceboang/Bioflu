<div class="related-articles">
  <label class="related-text">RELATED ARTICLES</label>
  <div class="related-con"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
var q = "<?php echo $_GET['q'];?>";
var alias = q.replace(/-/g," ");
get_article(alias);
	function get_article(alias){
		$.ajax({
		type: 'post',
		url: 'templates/bioflu/controller_tek.php?query=get_Article',
		data:{alias:alias}
	}).done(function(data){
		var obj = JSON.parse(data);
		var htm = '';
		$.each(obj, function(x,y){
			get_related(y.tags);
		});
	});
	}

	function get_related(tags){
		var limit = '3';
		$.ajax({
			type: 'post',
			url: 'templates/bioflu/controller_tek.php?query=get_RelatedArticles',
			data:{tags:tags,limit:limit}
		}).done(function(data){
			var obj = JSON.parse(data);
			var htm = '';
			$.each(obj, function(x,y){
				var desc = $(y.intro_text).text();
				htm += '<div class="col-md-4 col-xs-4 col-sm-4 related-con-right">';
				htm += '<div class="col-md-12 pad-0 r-border" data-id="'+y.id+'" data-title="'+y.article_title+'">';
				htm += '<img class="related-thumb" src="'+y.image+'" width="100%">';
				htm += '<div class="rtext">';
				htm += '<div class="related-title">'+y.article_title+'</div>';
				htm += '<div class="related-intro">'+desc.substr(0,120)+'...</div>';
				htm += '</div>';
				htm += '</div>';
				htm += '</div>';
			});

			$('.related-con').html(htm);
		});
	}


	$(document).on('click','.r-border',function(){
		var rid = $(this).attr('data-title');
		var alias = rid.replace(/ /g,"-")
		window.location = 'article?q='+alias;
	});
});
</script>