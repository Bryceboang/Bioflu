<?php  error_reporting(0); require_once dirname(__FILE__) . '/login/session.php'; ?>

<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="row">

		<?php  require_once dirname(__FILE__) . '/menu.php'; ?>

		<div class="col-md-9 home-body">
		<div class="row">
		<div class="col-md-12"><a href="">Dashboard</a></div>
		<div class="col-md-12">
			<h3>Welcome</h3>
			<p>Content Management System (CMS) a web application that allows publishing, 
editing and modifying content, organizing, deleting as well as maintenance from a central interface.
Such systems of content management provide procedures to manage workflow in a collaborative environment. </p>
		</div>

		<div class="col-md-12">
			<h3>Admin Tools</h3>
		</div>

		<div class="col-md-12 icon home-menu">
		</div>

		</div>
		</div>

		<!-- sidebar -->
		<?php  require_once dirname(__FILE__) . '/sidebar.php'; ?>
		<!-- end sidebar -->
		
	</div>

</div>

<?php  require_once dirname(__FILE__) . '/layout/footer.php'; ?>


<script type="text/javascript">
$(document).ready(function(){


var usertype = "<?php echo $_SESSION['access_id']; ?>";
$.ajax({
      type: 'Post',
      url: 'dashboard.php?function=menu',
      data:{},
    }).done( function(data){
     	  var obj = JSON.parse(data);
          var htm = '';
         htm+="<ul class='nav navbar-nav'>";
      $.each(obj, function(index, row){ 

      	if (usertype == '8') {
      		
      		htm+="<li class='dropdown'>";
      		 if (row.menu_id != null) {
      		htm+="<a class='dropdown-toggle mainmenu' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true' href="+row.url+"><div class='col-md-2 pad-5'><div style = 'padding-top: 16px' class = 'col-md-12'><img height='58px' width = '100%' src="+row.icons+"></div><div class = 'col-md-12 pad-0'>"+row.menu+"</div></div></a>";
      		htm+="<ul aria-labelledby='dropdownMenu1' data-subid = '"+row.menu_id+"' class = 'listsubmenu_"+row.id+" dropdown-menu'></ul>";
      		}else{
      			htm+="<a href="+row.url+"><div class='col-md-2 pad-5'><div style = 'padding-top: 16px' class = 'col-md-12'><img height='58px' width = '100%' src="+row.icons+"></div><div class = 'col-md-12 pad-0'>"+row.menu+"</div></div></a>";
      		}
      		htm+="</li>";
      		
      	}else{

      	 if (row.is_active !='0') {
          htm+="<li class='dropdown'>";
      		 if (row.menu_id != null) {
      		htm+="<a class='dropdown-toggle mainmenu' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true' href="+row.url+"><div class='col-md-2 pad-5'><div style = 'padding-top: 16px' class = 'col-md-12'><img height='58px' width = '100%' src="+row.icons+"></div><div class = 'col-md-12 pad-0'>"+row.menu+"</div></div></a>";
      		htm+="<ul aria-labelledby='dropdownMenu1' data-subid = '"+row.menu_id+"' class = 'listsubmenu_"+row.id+" dropdown-menu'></ul>";
      		}else{
      			htm+="<a href="+row.url+"><div class='col-md-2 pad-5'><div style = 'padding-top: 16px' class = 'col-md-12'><img height='58px' width = '100%' src="+row.icons+"></div><div class = 'col-md-12 pad-0'>"+row.menu+"</div></div></a>";
      		}
      		htm+="</li>";
          }
      }

       getsubmenu(row.id);
        });
      htm+="</ul>";
      $('.home-menu').html('');
      $('.home-menu').html(htm);
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

});
// 			$(function(){
// 	$(document).on("click",".dropdown-menu > li > a.trigger",function(e){
// 		var current=$(this).next();
// 		var grandparent=$(this).parent().parent();
// 		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
// 			$(this).toggleClass('right-caret left-caret');
// 		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
// 		grandparent.find(".sub-menu:visible").not(current).hide();
// 		current.toggle();
// 		e.stopPropagation();
// 	});
// 	$(document).on("click",".dropdown-menu > li > a:not(.trigger)",function(){
// 		var root=$(this).closest('.dropdown');
// 		root.find('.left-caret').toggleClass('right-caret left-caret');
// 		root.find('.sub-menu:visible').hide();
// 	});
// });


</script>