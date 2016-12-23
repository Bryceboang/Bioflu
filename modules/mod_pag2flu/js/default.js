$(document).ready(function(){
var active = 0;
var base_url = jQuery('body').attr('data-baseurl')+'/';

get_data();
get_symptoms();

function get_data(){

    var table = "pag2flu";
    var order_by = "id";
    
    $.ajax({
        type: 'Post',
        url:  base_url+'templates/bioflu/controller.php?query=get_data',
        data:{table:table, order_by:order_by},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm ='', htm1 = '', htm2 = '';
              
           
          $.each(obj, function(index, row){ 

          	htm 	+=	'<div class="col-md-12 col-sm-12 col-xs-12 full-width"><img class="img-responsive pag2flu-img" src="'+row.banner+'" /></div>';
			htm 	+=	'<div class="col-md-12 col-sm-12 col-xs-12 pag2flu-vid">';
			htm 	+=	'<div class="col-md-6 pag2flu-video">';
			htm 	+=	'<video class="pag2flu-thumb"poster="'+row.thumbnail+'" name="media" width="100%" height="auto" preload="" controls="" ><source src="'+row.video+'" type="video/mp4"></video>';
			htm 	+=	'</div>';
			htm 	+=	'<div class="col-md-6 pag2flu-vid-desc">';
			htm 	+=	'<p class="blue-text header-title">'+row.video_title+'</p>';
			htm 	+=	'<p class="p2">'+row.video_desc+'</p>';
			htm 	+=	'</div>';
			htm 	+=	'</div>';

			htm1 	+=	'<div class="col-md-12 col-sm-12 col-xs-12 text-center"><label class="blue-text pag2flu-title">'+row.campaign_title+'</label></div>';
			htm1 	+=	'<div class="col-md-12 col-sm-12 col-xs-12 pag2flu-content">';
			htm1 	+=	'<div class="col-md-6  pag2flu-left">'+row.campaign_desc_left+'</div>';
			htm1 	+=	'<div class="col-md-6  pag2flu-right p2">'+row.campaign_desc_right+'</div>';
			htm1 	+=	'</div>';


			htm2	+=	'<div class="col-md-12 col-sm-12 col-xs-12 border-top">';
			htm2	+=	'<div class="pag2flu-symptoms">';
			htm2	+=	'<div class="p1">'+row.symptoms_title+'</div></div></div>';
			// htm2	+= 	'<p class="p1">'+row.symptoms_title+'</p>';
			htm2	+= 	'<p class="p2 pag2flu-header-desc">'+row.symptoms_desc+'</p>';

            });

	          $('#pag2flu-container').html('');
	          $('#pag2flu-container').html(htm);

	          $('#flu-campaign').html('');
	          $('#flu-campaign').html(htm1);

	          $('#pag2flu-symp-desc').html('');
	          $('#pag2flu-symp-desc').html(htm2);
     }); 
}



function get_symptoms(){

    var table = "pag2flu_symptoms";
    var order_by = "id";
    
    $.ajax({
        type: 'Post',
        url:  base_url+'templates/bioflu/controller.php?query=get_data',
        data:{table:table, order_by:order_by},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm ='', i = 1;             
           
          $.each(obj, function(index, row){ 
			htm 	+=	'		<div class="col-md-3 col-sm-3 col-xs-3 pag2flu-icon">';
			htm 	+=	'			<img data-id="'+i+'" data-alias="'+row.alias+'" data-src="'+row.icon_inactive+'" data-src-orig ="'+row.icon_active+'" class="pag2flu-symp-icon1 pag2flu-img img-responsive icon-flu'+i+'" src="'+row.icon_active+'">';
			htm 	+=	'			<p class="p_upper p2">'+row.name+'</p>';
			htm 	+=	'		</div>';
			i++;
            });

	          $('#pag2flu-symp-icon').html('');
	          $('#pag2flu-symp-icon').html(htm);
     }); 
}


$(document).on('click', '.pag2flu-symp-icon1', function(){

	var id = $(this).attr('data-id');
	var img_src = $(this).attr('data-src');
	var img_src_orig = $(this).attr('data-src-orig');

	var cnt = 0;
	var alias = [];

		if($('.icon-flu'+id).hasClass("active")){
				$('.icon-flu'+id).removeClass("active");
				$('.icon-flu'+id).attr('src', img_src_orig);
		} else {
				$('.icon-flu'+id).addClass("active");
				$('.icon-flu'+id).attr('src',img_src);
		}

	var active = $('.active').length; 

			if(active > 2){
					$( ".pag2flu-symp-icon1" ).each(function() {
						if($( this ).hasClass("active")){
							cnt++;
							var id = $(this).attr('data-id');
							alias[cnt] = $(this).attr('data-alias');
							
						} else {							
							$(this).css("opacity",".5");
							$(this).css("cursor","default");
							$(this).prop('disabled', true);	
						}
					 });
					var flu_one = alias[1];
					var flu_two = alias[2];

				    $.ajax({
				        type: 'Post',
				        url:  base_url+'templates/bioflu/controller.php?query=get_search_data',
				        data:{flu_one:flu_one,flu_two:flu_two},
				      }).done( function(data){
							var obj = JSON.parse(data);

				      				$('.symptoms-img').attr('src',obj);
									$('.symptoms-img').show();
				     }); 

			} else {
					$( ".pag2flu-symp-icon1" ).each(function() {
						$(this).css("opacity","1");	
						$(this).bind( "click");	
						$(this).css("cursor","pointer");
						$(this).prop('disabled', false);			
					});
					$('.symptoms-img').hide();
			}
});

$(document).on('click', 'video', function(){
    if (this.paused) {        
            this.play();
    } else {          
        this.pause();
    }
});




});