<div class="home-container">
	<div class="col-md-5 col-sm-5 home-video-con">
		<div id="player">

		</div>
	</div>
	<div class="col-md-7 col-sm-7 home-pag2flu-link-con">
		<div class="col-md-12 pad-0 border">
			<p class="know-your-flu-symptoms">Know Your FLU Symptoms</p>
			<p>May flu ka ba? Click here.</p>
		</div>
		<div class="col-md-12 pad-0 home-icon-pag2flu">
			<!-- <div class="col-md-3 col-sm-3 col-xs-3">
				<img src="images/assets/fever.png">
				<p>Lagnat</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<img src="images/assets/bp.png">
				<p>Body pain</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<img src="images/assets/nose.png">
				<p>Sipon</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3">
				<img src="images/assets/cough.png">
				<p>Ubo</p>
			</div> -->
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('div.home-icon-pag2flu').click(function(){
		window.location = 'pag2flu';
	});

	$.ajax({
		type: 'post',
		url: 'templates/bioflu/controller_tek.php?query=get_homeVideo'
	}).done(function(data){
		var obj = JSON.parse(data);
		var htm = '';
		$.each(obj, function(x,y){
			htm += '<video data-id="1" poster="images/bioflu/'+y.thumbnail+'" width="100%" style="margin-top:20px;cursor:pointer;" height="auto" preload="" controls="">';
			htm += '<source src="images/videos/'+y.path+'" type="video/mp4">';
			htm += '</video>';
			htm += '<p>'+y.description+'</p>';
		});
		$('#player').html(htm);
	});

	$(document).on('click', 'video', function(){
	    if (this.paused) {        
	            this.play();
	    } else {          
	        this.pause();
	    }
	});

	$.ajax({
		type: 'post',
		url: 'templates/bioflu/controller_tek.php?query=get_home_symptoms'
	}).done(function(data){
		var obj = JSON.parse(data);
		var htm = '';
		$.each(obj, function(x,y){
			htm += '<div class="col-md-3 col-sm-3 col-xs-3">';
			htm += '<img src="'+y.icon_active+'">';
			htm += '<p>'+y.name+'</p>';
			htm += '</div>';
		});
		$('.home-icon-pag2flu').html(htm);
	});

});
</script>