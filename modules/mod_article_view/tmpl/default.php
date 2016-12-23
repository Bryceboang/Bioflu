<div class="content">
	<input type="hidden" id="article_id" class="article_id" value="">
	
	<div class="aticle-published-date"></div>
	<div class="article-content"></div>
	<div class="col-md-12 tap-cover">
		<div class="col-md-12 border-top">
			<span>Tap to read more...</span>
		</div>
	</div>

	<div class="sharer">
		<p>SHARE</p>
		<a href="" class="fb-share"><img src="images/assets/fb.png"></a>
		<a href="" class="twitter-share"><img src="images/assets/twitter.png"></a>
		<a href="" class="pinterest-share"><img src="images/assets/pinterest.png"></a>
	</div>
	<div class="article-tags">
		<p>TAGS</p>
		<div class="tags"></div>
	</div>
	<div class="col-md-6 pad-0 txt-right resp-social">
		<div class="col-md-12 col-xs-12 col-sm-12">
		<div id="hid_fb_but" style="position:absolute; z-index:-999999;right:999999px;">
			<div class="fb-login-button fbloginbtn fb_login" data-max-rows="6" data-size="medium" data-show-faces="false" data-auto-logout-link="true">Login with Facebook</div>
		</div>
		</div>
		<input type="hidden" id="fb_name" value="">
		<input type="hidden" id="fb_id" value="">
		<input type="hidden" id="fb_photo" value="">
		<div style="hidden" id="hidden_comment_val"></div>
		<input type="hidden" id="datetime_now" value="<?php date_default_timezone_set("Asia/Taipei"); echo date('Y-m-d H:i:s', time());?>">
	</div>

	<div class="col-md-12 pad-0 comments">

	</div>	

	<!-- <a class="login-twitter">sign in with twitter</a> -->
</div>



<script type="text/javascript">
$(document).ready(function(){
var q = "<?php echo $_GET['q'];?>";
var alias = q.replace(/-/g," ");
var sort = 'DESC';
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
			var mystring = y.tags;
			var tags = mystring.replace(/,/g , ", ");
			// $('.art-banner').html('<img src="'+y.image+'" width="100%">');
			$('.article-title').text(y.article_title);
			$('.article-published-date').text(y.created);
			$('.article-content').html(y.intro_text);
			$('.tags').text(tags);
			$('#article_id').val(y.id);
		});

	});
	}




function statusChangeCallback(response) {
/*    console.log('statusChangeCallback');
    console.log(response);
    console.log('aaa');*/

    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
    	//alert('b');
    	//console.log('bbb');
    	/*$('.fb-login-button').hide();
    	$('.submit-comment').show();*/
    	var token = response.authResponse.accessToken;
    	fb_name(token);
    	profile_pic(token);
      
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status').innerHTML = 'Please log ' +
       // 'into this app.';
  //       if($('.item-page div').html().trim()=='' || itemid==104 ){
		// }
		// else{
			var image_fb = 'images/assets/anonymous.jpg';
			append_comment_box(image_fb,sort);
		// }
        //console.log('zzzz2');
        //window.location = "<?php echo JURI::base() ?>";
    } else {

      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status').innerHTML = 'Please log ' +
       // 'into Facebook.';
      // alert('a');
  //       if($('.item-page div').html().trim()=='' || itemid==104 ){
		// }
		// else{
			var image_fb = 'images/assets/anonymous.jpg';
			append_comment_box(image_fb,sort);
		// }
        //window.location = "<?php echo JURI::base() ?>";
        //console.log('zzzz');

    }
  }

function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }



  window.fbAsyncInit = function() {
   FB.init({
      appId      : '1010042909113577',
      channelUrl : 'http://bioflu2.ecomqa.com/',
      xfbml      : true,
      version    : 'v2.7'
    });

     FB.Event.subscribe('auth.login', function(resp) {
        //window.location = "<?php echo JURI::base() ?>";
        location.reload();
    });

      FB.Event.subscribe('auth.logout', function(resp) {
        //window.location = "<?php echo JURI::base() ?>";
    });



  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);

  });

  };

function fb_name(token) {
	var my_count = '';
	
	$.get('https://graph.facebook.com/me?fields=name,location,work&access_token='+token+'&callback=?', function(data) {
	    console.log(data);

		$('#fb_name').val(data.name);
		$('#fb_id').val(data.id);
  }, 'json');
 }

// function fb_work(token) {
// 	var my_count = '';
	
// 	$.get('https://graph.facebook.com/{work-experience-id}&access_token='+token+'&callback=?', function(data) {
// 	    console.log(data);

// 		// $('#fb_location').val(data.location);
//   }, 'json');
//  }


 function profile_pic(token) {

	var my_count = '';
	$.get('https://graph.facebook.com/me?fields=picture&access_token='+token+'&callback=?', function(data) {
      $('#fb_photo').val(data.picture.data.url);
		$('#hidden_trigger').attr('src',data.picture.data.url);
		
		// if($('.item-page div').html().trim()=='' || itemid==104 ){
		// }
		// else{
			var image_fb = data.picture.data.url;
			append_comment_box(image_fb,sort);
		// }
  }, 'json');
	/*$.ajax({
		type: 'get',
		url: 'https://graph.facebook.com/me?fields=picture&access_token='+token,
	}).done(function(data) {
		alert('a');
		$('#fb_photo').val(data.picture.data.url);
		$('#hidden_trigger').attr('src',data.picture.data.url);
		
		if($('.item-page div').html().trim()=='' || itemid==104 ){
		}
		else{
			var image_fb = data.picture.data.url;
			append_comment_box(image_fb);
		}
	}); 	*/
 }


function append_comment_box(image_fb,sort) {
var id = $('.article_id').val();
var x = '';
	x += '<div class="comment-container">';
	x += '<div class="comment-count-box">';
	x += '<label class="comment-count">';
	x += '';
	x += '</label>';
	x += '<label class="comment-sort">Sort By: ';
	x += '<button class="dropdown-toggle" type="button" data-toggle="dropdown"><span class="stext">Top </span> ';
  	x += '<span class="caret"></span></button>';
    x += '<ul class="dropdown-menu">';
	x += '<li><a class="sort" datax="DESC">Top</a></li>';
	x += '<li><a class="sort" datax="ASC">Bottom</a></li>';
	x += '</ul>';
	x += '</label>';
	x += '</div>';
	x += '<div class="comment-content-box">';
	x += '<div class="comment-sender">';
	x += '<div class="sender-image">';
	x += '<img width="100%" class="fb-sender-image" src="'+image_fb+'">';
	x += '</div>';
	x += '<div class="sender-message">';
	x += '<textarea id="article_comment_text"  placeholder="Add Comment..." style="width:100%; height: 58px; resize:none; padding:5px;"></textarea>';

	if(image_fb=='images/assets/anonymous.jpg'){
		x += $('#hid_fb_but').html();
		$('#hid_fb_but').hide();
	}
	else{
		$('#hid_fb_but').hide();
		x += '<a class="submit-comment">Submit Comment <img id="commentLoading" width="30px" src="./images/bioflu/loader.gif"></a></div>';
	}	
	x += '</div>';
	x += '<div class="comment-message com_num_0">';
	

	load_comments(1,0,id,sort);
	x += '</div>';
	x += '</div>';
	x += '</div>';

	$('.comments').append(x);
}


function load_comments(is_parent,comment_id,id,sort) {
	//var set_data = '';
	$.ajax({
		
		type: 'post',
		
		url: 'templates/bioflu/controller_tek.php?query=get_comment',
		
		data: { 'is_parent' : is_parent, 'comment_id' : comment_id, 'article_id' : id, 'sort' : sort},
		
		}).done(function(result) {
		
		var obj = JSON.parse(result);
		if(comment_id==0){
			$('.comment-count').html(obj.length+ ' Comment/s');	
			$('#hidden-comment-count').val(obj.length);
		}
		

		var htm = '';
		$.each(obj, function(index, row){ 
			var fb_id = $('#fb_id').val();
			var com_id = row.id;
			check_lie_status(fb_id,com_id)
			htm  = '';
			htm += '<div class="comment-message-box com-close_'+comment_id+'">';

			htm += '<div class="comment-message-photo" >';
			htm += '<img width="100%" class="fb-sender-image2" src="'+row.fb_photo+'">';
			htm += '</div>';

			htm += '<div class="comment-message-text com_id_'+row.id+' ">';

			htm += '<div class="comment_fb_name_days">';
			htm += '<label class="com-fb_name">';
			htm += row.fb_name;
			htm += '</label>';

			var lapse = '';

			var datetime_now = $('#datetime_now').val();
			var datetime_now = datetime_now.split(' ');
			var date_now = datetime_now[0];
			var time_now = datetime_now[1];

			var datetime_com = row.date;
			datetime_com = datetime_com.split(' ');
			var date_com = datetime_com[0];
			var time_com = datetime_com[1];

			var date_now1 = new Date(date_now);
			var date_com1 = new Date(date_com);

			var diff = new Date(date_now1 - date_com1);
			var days = diff/1000/60/60/24;

			if(days>0){
				lapse = days +' day/s ago';
			}
			else{
				time_now = time_now.split(':');
				hour_now = time_now[0];
				minute_now = time_now[1];
				sec_now = time_now[2];

				time_com = time_com.split(':');
				hour_com = time_com[0];
				minute_com = time_com[1];
				sec_com = time_com[2];

				hour_dif = parseInt(hour_now) - parseInt(hour_com); 
				min_dif = parseInt(minute_now) - parseInt(minute_com); 

				if(hour_dif>0){
					lapse = hour_dif + ' hour/s ago';	
				}
				else{
					lapse = min_dif + ' minute/s ago';
				}

				if(min_dif <=0){
					lapse ='';
				}

				
			}

			htm += '<li class="dot-separator"></li>';

			htm += '<label class="com-lapse">';
			// htm += 'user location';
			htm += '</label>';
			htm += '</div>';

			htm += '<div class="comment-content">';
			htm += '<p class="comment-p">'+row.comment+'</p>';
			htm += '</div>'

//			

			htm += '<div class="comment-content">';
			htm += '<p class="message-count-reply">';
			htm += '<span class="reply_num_'+row.id+'"></span>';
			htm += '<span class="glyphicon glyphicon-menu-up hide_reply" com_id="'+row.id+'" aria-hidden="true"></span>';
			htm += '<span>|</span><span class="glyphicon glyphicon-menu-down show_reply" view="close" com_id="'+row.id+'" aria-hidden="true"></span>';
			htm += '</p>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<span class="like_event" view="close" comment-id="'+comment_id+'" com_id="'+row.id+'" count="'+row.like_count+'">Like</span>';
			htm += '</p>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<span class="reply_event" view="close" com_id="'+row.id+'">Reply</span>';
			htm += '</p>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<img src="images/assets/Facebook_like_thumb.png" width="12px">';
			htm += '<span class="like-count c_id_'+comment_id+'">'+row.like_count+'</span>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<span class="like-date"> '+row.date+'</span>';
			htm += '</p>';


			htm += '</div>'


			htm += '</div>';


			htm += '</div>';
			if(is_parent!=1){
				$('.loading-comments').remove();
				$('.com_id_'+comment_id).append(htm);
				$('.close-reply').remove();
				$('.reply_event').attr('view','close');

			}
			else{
				$('.loading-comments').remove();
				$('.com_num_'+comment_id).append(htm);
			}

			count_comment(row.id,id);

		});
		


		});
//		return set_data;
		//return $('#hidden_comment_val').html();
}

function check_lie_status(fb_id,com_id){

	if(fb_id != ''){
		$.ajax({		
		type: 'post',		
		url: 'templates/bioflu/controller_tek.php?query=checkLike',		
		data: {fb:fb_id,com:com_id},		
		}).done(function(data){	
			var obj = JSON.parse(data);
			if(obj != ''){
				$('.com_id_'+com_id+' .like_event').html('Unlike');
			}else{
				$('.com_id_'+com_id+' .like_event').html('Like');
			}
		});
	}

	
}

function count_comment(comment_id,id){
	$.ajax({
		
		type: 'post',
		
		url: 'templates/bioflu/controller_tek.php?query=get_comment',
		
		data: { 'is_parent' : '0', 'comment_id' : comment_id, 'article_id' : id},
		
		}).done(function(result) {
		
		var obj = JSON.parse(result);
		$('.reply_num_'+comment_id).html(obj.length);
	});


	
}

$(document).on('click', '.hide_reply', function() {
	comment_id = $(this).attr('com_id');
	$('.com-close_'+comment_id).remove();
	$('.show_reply[com_id='+comment_id+']').attr('view','close');

})

$(document).on('click', '#article_comment_text', function() {
	FB.login();
});

$(document).on('click','.like_event', function(){
	FB.login();
});

$(document).on('click', '.reply_event', function() {
	var view = $(this).attr('view');

	if(view =='close'){
		var comment_id = $(this).attr('com_id');

		var check_fb = $('#hidden_trigger').attr('src');
		if(check_fb!='images/bioflu/anonymous.jpg'){
			htm2 = '';
			htm2 += '<div class="sender-message close-reply" >';
			htm2 += '<textarea class="comment_reply_'+comment_id+'" placeholder="Write your reply here..." style="width:100%; border-radius:5px; height: 58px; resize:none; padding:5px;"></textarea>';
			htm2 += '<a class="submit-reply" com-id="'+comment_id+'">Submit Reply <img id="Loading" width="30px" src="./images/bioflu/loader.gif"></a></div>';
			htm2 += '</div>';
			$('.com_id_'+comment_id).append(htm2);
			$(this).attr('view','open');
		}
		else{
			alert('Please login with Facebook to continue.');
		}
		
	}

	
});

$(document).on('click', '.show_reply', function() {
	var view = $(this).attr('view');
	var id = $('.article_id').val();
	if(view =='close'){
		$(this).attr('view','open');
		comment_id = $(this).attr('com_id');
		//alert(comment_id);
		load_comments('0',comment_id,id);
	}
	
})

$(document).on('click','.submit-comment',function() {
	var comment = $('#article_comment_text').val();
	var fb_name = $('#fb_name').val();
	var fb_id = $('#fb_id').val();
	var fb_photo = $('#fb_photo').val();
	var artid = $('.article_id').val();
	
	if(comment==''){
		alert('Please fill up comment field');
	}
	else{
		$.ajax({
		    type: 'Post',
		    url: 'templates/bioflu/controller_tek.php?query=submit_comment',
		    data:{article_id:artid, comment:comment, fb_name:fb_name, fb_id:fb_id, fb_photo:fb_photo},
		  }).done( function(data){
		  	var comment_count = $('#hidden-comment-count').val();
		  	comment_count = parseInt(comment_count)+1;

		  	// $('.comment-count').html(comment_count+ ' Comment/s');	

		  	
		  	$('#commentLoading').show();
				setTimeout(function(){
				// append_comment(data,fb_photo,fb_name,comment,'0','0');
				$("#commentLoading").hide();
				$('#article_comment_text').val('');
				alert('Comment was Successfully saved but needs to be confirm first!');
			},1000); 	


		  	// $('.modal-alert-body').html('Comment Successfully Sent');

		  	// $('#modal-alert').modal('show');
//		  	location.reload();
		});

	}


});


function append_comment(entry_id,fb_photo,fb_name,comment,comment_id,like) {
	var htm = '';
	htm += '<div class="comment-message-box com-close_'+comment_id+'">';
			htm += '<div class="comment-message-photo" >';
			htm += '<img width="100%" class="fb-sender-image2" src="'+fb_photo+'">';
			htm += '</div>';
			htm += '<div class="comment-message-text com_id_'+entry_id+'">';
			htm += '<div class="comment_fb_name_days">';
			htm += '<label class="com-fb_name">';
			htm += fb_name;
			htm += '</label>';
			htm += '<li class="dot-separator"></li>';
			htm += '<label class="com-lapse">';
			// htm += 'user location';
			htm += '</label>';
			htm += '</div>';
			htm += '<div class="comment-content">';
			htm += '<p class="comment-p">'+comment+'</p>';
			htm += '</div>'
			htm += '<div class="comment-content">';
			htm += '<p class="message-count-reply">';
			htm += '<span class="reply_num_'+entry_id+'">0</span>';
			htm += '<span class="glyphicon glyphicon-menu-up hide_reply" com_id="'+entry_id+'" aria-hidden="true"></span>';
			htm += '<span>|</span><span class="glyphicon glyphicon-menu-down show_reply view="close" com_id="'+entry_id+'" aria-hidden="true"></span>';
			htm += '</p>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<span class="like_event" view="close" com_id="'+comment_id+'" count="'+like+'">Like</span>';
			htm += '</p>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<span class="reply_event" view="close" com_id="'+entry_id+'">Reply</span>';
			htm += '</p>';
			htm += '<span><li class="dot-separator"></li></span>';
			htm += '<p class="message-count-reply">';
			htm += '<img src="images/assets/Facebook_like_thumb.png" width="12px">';
			htm += '<span class="like-count c_id_'+comment_id+'"">'+like+'</span>';
			htm += '</p>';
			htm += '</div>'
			htm += '</div>';
			htm += '</div>';

			if(comment_id==0){
				$('.com_num_'+comment_id).prepend(htm);	
			}
			else{
				$('.com_id_'+comment_id).append(htm).fadeIn(300);	
			}
			
}


$(document).on('click','.submit-reply',function() {
		comment_id = $(this).attr('com-id');
		var id = $('.article_id').val();
		var comment = $('.comment_reply_'+comment_id).val();
		var fb_name = $('#fb_name').val();
    	var fb_id = $('#fb_id').val();
    	var fb_photo = $('#fb_photo').val();

    	if(comment==''){
    		alert('Please fill up comment field');
    	}
    	else{
    		$.ajax({
			    type: 'Post',
			    url: 'templates/bioflu/controller_tek.php?query=submit_comment',
			    data:{article_id:id, comment:comment, fb_name:fb_name, fb_id:fb_id, fb_photo:fb_photo, comment_id:comment_id,is_parent:'0'},
			  }).done( function(data){
			  	
			  	//location.reload();
			  // 	$('.reply_num_'+comment_id).html(parseInt($('.reply_num_'+comment_id).html()) +1 );
			  // 	$('.modal-alert-body').html('Reply Successfully Sent');

		  	// $('#modal-alert').modal('show');	
			  	
				$('#Loading').show();
					setTimeout(function(){
					$("#Loading").hide();
					// append_comment(data,fb_photo,fb_name,comment,comment_id,'0');
					alert('Reply to this comment was Successfully saved but needs to be confirm first!');
					$('.close-reply').remove();
				},1000); 

				});

    	}


	});

$(document).on('click','.like_event', function(){
	var c_id = $(this).attr('comment-id');
	var fb_id = $('#fb_id').val();
	var com_id = $(this).attr('com_id');
	var count = $(this).attr('count');
    if ($(this).html() == "Like") {
        $(this).html('Unlike');
        $(this).attr('count',parseInt(count)+1);
        $('.com_id_'+com_id+' .c_id_'+c_id).text(parseInt(count)+1);
        var l_count = parseInt(count)+1;
        update_like(com_id,l_count);
        var func = 'save_like';
        save_delete_like(fb_id,com_id,func);
    }
    else {
        $(this).html('Like');
        $(this).attr('count',parseInt(count)-1);
        $('.com_id_'+com_id+' .c_id_'+c_id).text(parseInt(count)-1);
        var l_count = parseInt(count)-1;
        update_like(com_id,l_count);
        var func = 'delete_like';
        save_delete_like(fb_id,com_id,func);
    }
    return false;
});


function update_like(com_id,l_count){
	$.ajax({
		type: 'post',
		url: 'templates/bioflu/controller_tek.php?query=update_like',
		data:{id:com_id,count:l_count}
	}).done(function(data){
		
	});
}

function save_delete_like(fb_id,com_id,func){
	$.ajax({
		type: 'post',
		url: 'templates/bioflu/controller_tek.php?query='+func,
		data:{fb_id:fb_id,com_id:com_id}
	}).done(function(data){

	});
}


$(document).on('click','.comment-sort .dropdown-toggle',function(){
	$('.comment-sort .dropdown-menu').toggleClass('open');
});


$(document).on('click','.sort', function(){
	var id = $('.article_id').val();
	var sortby = $(this).attr('datax');
	var sort_text = $(this).text();
	$('.comment-sort .stext').html(sort_text+' ');
	$('.comment-message').html('<span class="loading-comments">Loading comments ...</span>');
	load_comments(1,0,id,sortby);
});

$(document).on('click', '.fb-share', function(e) {
	event.preventDefault();
	$.ajax({
    type: 'Post',
    url: 'templates/bioflu/controller_tek.php?query=get_Article',
    data:{alias:alias},
  }).done( function(data){
    	var obj = JSON.parse(data);
	    $.each(obj,function(index,row){
	      
	    $(document).on('click', '.fb-share', function() {
			var url_root = "<?php echo JURI::root(); ?>";
			var uri = "<?php echo JURI::current(); ?>";
			var alias2 = alias.replace(/ /g,"-");
			var url = uri+'?q='+alias2;
			var desc = $(row.intro_text).text().substring(0,100);
			width    = 700,
			height   = 500,
			left     = ($(window).width()  - width)  / 2,
			top      = ($(window).height() - height) / 2,
			urls      = 'https://www.facebook.com/dialog/feed?app_id=1010042909113577&link='+url+'&picture='+url_root+row.image+'&name='+row.article_title+'&caption='+url_root+'&description='+desc+' ...'+'&message='+url+'&redirect_uri='+url,
			opts     = 'status=1' +
						',width='  + width  +
						',height=' + height +
						',top='    + top    +
						',left='   + left;
			window.open(urls, 'fb', opts);
			return false;
		});

	    $(document).on('click', '.twitter-share', function() {
		var url_root = "<?php echo JURI::root(); ?>";
		var uri = "<?php echo JURI::current(); ?>";
		var alias2 = alias.replace(/ /g,"-");
		var url = uri+'?q='+alias2;
		var via = 'BiofluOfficial';
		var elem = $(this),
		
		width    = 575,
		height   = 400,
		left     = ($(window).width()  - width)  / 2,
		top      = ($(window).height() - height) / 2,
		urls      = 'https://twitter.com/intent/tweet?text='+row.article_title+'&via='+via+'&url='+url+'&original_referer='+url,
		opts     = 'status=1' +
					',width='  + width  +
					',height=' + height +
					',top='    + top    +
					',left='   + left;
    	window.open(urls, 'Twitter', opts);
    	return false;
 		});

	    $(document).on('click', '.pinterest-share', function(){
	    	var url_root = "<?php echo JURI::root(); ?>";
			var uri = "<?php echo JURI::current(); ?>";
			var desc = $(row.intro_text).text().substring(0,50);
			var alias2 = alias.replace(/ /g,"-");
			var url = uri+'?q='+alias2;
	    	var base = 'https://www.pinterest.com/pin/create/button/?url='+url+'&media='+url_root+row.image+'&description='+row.article_title;

 			$('.pinterest-share').attr('data-pin-do','buttonPin');
 			$('.pinterest-share').attr('href',base);
 			$('.pinterest-share').attr('target','_blank');
 		});

	});
  
});


});

$('.tap-cover').click(function(){
	$('.article-content').css('height','auto').css('overflow','none');
	$(this).hide();
});

$('.login-twitter').click(function(){
$.ajax({
    url: "templates/bioflu/twitterlogin.php",
    type: 'post',
    dataType: 'json',
    success: function(data, status, xhr) {
        if (data.msg == 'OK') {
            // all ok, user logged in
            console.log(data.msg);
        } else {
            // display error
            console.log(data.msg);
        }
    }
});
});

});
</script>