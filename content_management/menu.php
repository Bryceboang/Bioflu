

<style type="text/css">
.menu-link a{
	text-decoration: none;
}
.dropdown-menu>li
{	position:relative;
	-webkit-user-select: none; /* Chrome/Safari */        
	-moz-user-select: none; /* Firefox */
	-ms-user-select: none; /* IE10+ */
	/* Rules below not implemented in browsers yet */
	-o-user-select: none;
	user-select: none;
	cursor:pointer;
}
.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    display:none;
    margin-top: -1px;
	border-top-left-radius:0;
	border-bottom-left-radius:0;
	border-left-color:#fff;
	box-shadow:none;
}
.right-caret:after,.left-caret:after
 {	content:"";
    border-bottom: 5px solid transparent;
    border-top: 5px solid transparent;
    display: inline-block;
    height: 0;
    vertical-align: middle;
    width: 0;
	margin-left:5px;
}
.right-caret:after
{	border-left: 5px solid #337ab7;
}
.left-caret:after
{	border-right: 5px solid #337ab7;
}
.sub-menu-sibebar{
	display: none;
}
a{
	cursor: pointer !important;
}

.sidebar-menu li {
list-style-image: url(assets/img/bullet.png);
} 
</style>

<div class="col-md-12 header pad-0">

<div class="col-md-12">
	<div class="row">
<div class="col-md-7">
	<h1><a class = "title" href="home.php">Content Management</a></h1>
</div>	
<div class="col-md-5 txt-right pad-0">
<div class="col-md-12 top-nav-container ">
  <div class="navbar-header top-nav">
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li>
				<a href="home.php">
						Home
				</a>
			</li>
			<?php if ($_SESSION['access_id'] == '8'): ?>
			<li>
				<a href="user.php">
						User
				</a>
			</li>
			<?php endif ?>
			<li>
				<a href="logs.php">
						Logs
				</a>
			</li>
			<?php if ($_SESSION['access_id'] == '8'): ?>
				<li>
				<a href="settings.php">
						Settings
				</a>
			</li>
			<?php endif ?>
			

			<li>
				<a href="login/logout.php">
						Log out
				</a>
			</li>
			</ul>
		</div>
	</div>
	</div>
	<div class="col-md-12" style = "padding-top:20px;">
		<a>Welcome, <?php  echo $_SESSION['name']; ?></a>
	</div>
</div>

</div>
</div>

<div class="navbar-header col-md-12 pad-0 navbarbg">
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav list-menu">
		</ul>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	$(document).on('click','#video', function(){
		$('.article_add,.article_list').hide();
		$('.content-container').load('video/video.php');
		$('#menu-video').addClass('menu-active');
		$('#menu-article,#menu-ads').removeClass('menu-active');
	});

	$(document).on('click','#ads',function(){
		$('.article_add').hide();
		$('.content-container').load('ads/ads.php');
		$('#menu-ads').addClass('menu-active');
		$('#menu-article,#menu-video').removeClass('menu-active');
	});


	var usertype = "<?php echo $_SESSION['access_id']; ?>";
	
			$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=menu',
                  data:{usertype: usertype},
                }).done( function(data){
                 	  var obj = JSON.parse(data);
		              var htm = '';
		          $.each(obj, function(index, row){ 



		          	if (usertype == '8') {

		          	  htm+="<li class='dropdown'>";

		          	  if (row.menu_id != null) {
		          	  	htm+='<a class="dropdown-toggle mainmenu" data-id = "'+row.id+'"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'+row.menu+'<span class="caret" style = "margin-left: 6px"></span></a>';
		          	  	htm+="<ul aria-labelledby='dropdownMenu1' data-subid = '"+row.menu_id+"' class = 'listsubmenu_"+row.id+" dropdown-menu'></ul>";
		          	  }else{
		          	  	htm+="<a data-id = "+row.id+" href = "+row.url+">"+row.menu+"</a>";
		          	  }

		              
			          
		              htm+="</li>";

		          	}else{

		          	 if (row.is_active !='0') {
		             htm+="<li class='dropdown'>";

		          	  if (row.menu_id != null) {
		          	  	htm+='<a class="dropdown-toggle mainmenu" data-id = "'+row.id+'"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'+row.menu+'<span class="caret" style = "margin-left: 6px"></span></a>';
		          	  	htm+="<ul aria-labelledby='dropdownMenu1' data-subid = '"+row.menu_id+"' class = 'listsubmenu_"+row.id+" dropdown-menu'></ul>";
		          	  }else{
		          	  	htm+="<a data-id = "+row.id+" href = "+row.url+">"+row.menu+"</a>";
		          	  }

		              
			          
		              htm+="</li>";
		              }
		          }

		          getsubmenu(row.id);
		            });
		          $('.list-menu').html('');
		          $('.list-menu').html(htm);
                });

			function getsubmenu(id){
				$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=submenu',
                  data:{id: id},
                }).done( function(data){
                	 var obj = JSON.parse(data);
		             var htm = '';
		          $.each(obj, function(index, row){ 
		          	htm+="<li>";
		              // htm+="<a data-id = '"+row.id+"' href = "+row.url+">"+row.sub_menu+"</a>";
		              // htm+="<ul aria-labelledby='dropdownMenu1' data-subid = '"+row.menu_id+"' class = 'listsubmenusub_"+row.id+" dropdown-menu'></ul>";

		               if (row.menu_id != null) {
		          	  	htm+='<a class="trigger right-caret" data-id = "'+row.id+'" >'+row.sub_menu+'</a>';
		          	  	htm+="<ul data-subid = '"+row.menu_id+"' class = 'listsubmenusub_"+row.id+" dropdown-menu sub-menu' ></ul>";
		          	  }else{
		          	  	htm+="<a data-id = "+row.id+" href = "+row.url+">"+row.sub_menu+"</a>";
		          	  }


		              htm+="</li>";
		               getsubmenusub(row.id);
		          	});
		          $('.listsubmenu_'+id).html('');
		          $('.listsubmenu_'+id).html(htm);
                });

			}

			function getsubmenusub(id){
				$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=submenusub',
                  data:{id: id},
                }).done( function(data){
                	 var obj = JSON.parse(data);
		             var htm = '';
		          $.each(obj, function(index, row){ 
		          	htm+="<li>";
		              htm+="<a href = "+row.url+">"+row.sub_menu+"</a>";
		              htm+="</li>";
		          	});
		          $('.listsubmenusub_'+id).html('');
		          $('.listsubmenusub_'+id).html(htm);
                });

			}


			$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=menu',
                  data:{usertype: usertype},
                }).done( function(data){
                 	  var obj = JSON.parse(data);
		              var htm = '';
		          $.each(obj, function(index, row){ 

		          	if (usertype == '8') {

		          	  htm+="<li class='dropdown'>";

		          	  if (row.menu_id != null) {
		          	  	htm+='<a class = "sidebarmenu" id = "sidebarmenu_'+row.id+'" data-id = "'+row.id+'">'+row.menu+'</a>';
		          	  	htm+="<ul data-subid = '"+row.menu_id+"' class = 'sublimenu listsidebarsubmenu_"+row.id+"' style ='margin-left:-10px;'>  ";
		          	  	htm+="</ul>";
		          	  }else{
		          	  	htm+="<a data-id = "+row.id+" href = "+row.url+">"+row.menu+"</a>";
		          	  }
		             htm+="</li>";
		          	}else{
		          		

		          	 if (row.is_active !='0') {
		          	 	  htm+="<li class='dropdown'>";
		              if (row.menu_id != null) {
		          	  	htm+='<a class = "sidebarmenu" id = "sidebarmenu_'+row.id+'" data-id = "'+row.id+'">'+row.menu+'</a>';
		          	  	htm+="<ul data-subid = '"+row.menu_id+"' class = 'sublimenu listsidebarsubmenu_"+row.id+"' style ='margin-left:-10px;'>  ";
		          	  	htm+="</ul>";
		          	  }else{
		          	  	htm+="<a data-id = "+row.id+" href = "+row.url+">"+row.menu+"</a>";
		          	  }
		          	   htm+="</li>";
		              }

		             
		          }
		            });
		          $('.sidebar-menu').html('');
		          $('.sidebar-menu').html(htm);
                });

		$(document).on('click','.sidebarmenu', function(){
			var id = $(this).attr('data-id');

				       $.ajax({
		                  type: 'Post',
		                  url: 'dashboard.php?function=submenu',
		                  data:{id: id},
		                }).done( function(data){
		                	 var obj = JSON.parse(data);
				             var htm = '';
				          $.each(obj, function(index, row){ 
				          	  htm+="<li>";
				              // htm+="<a href = "+row.url+">"+row.sub_menu+"</a>";

				              if (row.menu_id != null) {
					          	  	htm+='<a class="trig" data-id = "'+row.id+'" >'+row.sub_menu+'</a>';
					          	  	htm+="<ul data-subid = '"+row.menu_id+"' class = 'listsubmenusubsidebar_"+row.id+" sub-menu-sibebar' ></ul>";
					          	  }else{
					          	  	htm+="<a data-id = "+row.id+" href = "+row.url+">"+row.sub_menu+"</a>";
					          	  }

				              htm+="</li>";
				              getsubmenusub_sibebar(row.id);
				          	});
				            $('.listsidebarsubmenu_'+id).html('');
		          			$('.listsidebarsubmenu_'+id).html(htm);
		          			$('#sidebarmenu_'+id).addClass('selClose');

		                });


		});
	
		$(document).on('click', '.selClose', function(){
			var id = $(this).attr('data-id');
			$('.listsidebarsubmenu_'+id).toggle();
		});
				
		function getsubmenusub_sibebar(id){
				$.ajax({
                  type: 'Post',
                  url: 'dashboard.php?function=submenusub',
                  data:{id: id},
                }).done( function(data){
                	 var obj = JSON.parse(data);
		             var htm = '';
		          $.each(obj, function(index, row){ 
		          	htm+="<li>";
		              htm+="<a href = "+row.url+">"+row.sub_menu+"</a>";
		              htm+="</li>";
		          	});
		          $('.listsubmenusubsidebar_'+id).html('');
		          $('.listsubmenusubsidebar_'+id).html(htm);
                });

			}


$(document).on('click','.trig',function(){
	var id = $(this).attr('data-id');
	$('.listsubmenusubsidebar_'+id).toggle();
});

});


$(function(){
	$(document).on("click",".dropdown-menu > li > a.trigger",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(document).on("click",".dropdown-menu > li > a:not(.trigger)",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
});


</script>

