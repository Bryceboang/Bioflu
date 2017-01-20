<div class="widget" style="display:none">
	<div>
		<img class="bg" src="images/assets/widget-bg.png" height="120px">

		<div class="flu-widget-con">

			<p class="sml-txt">Dalawang sintomas pa lang, Flu na yan!</p>

			<a class="wid-close">CLOSE ❌</a>

			<p class="flu-text-bold">May Flu ka ba?</p>

			<div class="widget-btn">

				<button class="wid-btn" id="flu-yes" datax="">YES</button>

				<button class="wid-btn" id="flu-no" datax="">NO</button>

				<img class="nfm-icon" src="images/assets/nfm-icon.png">
				<input type="hidden" class="yes">
				<input type="hidden" class="no">
			</div>

		</div>
	</div></div>



<script type="text/javascript">

$(document).ready(function(){
// $('.widget').show();
$.ajax({
	type: 'post',
	url: 'templates/bioflu/controller_tek.php?query=get_widget',
}).done(function(data){
	var obj = JSON.parse(data);
	var htm = '';
	$.each(obj, function(x,y){
		var yes = y.yes_link;
		var no = y.no_link;
		$('.flu-text-bold').html(y.title);
		$('.sml-txt').html(y.subtext);
		$('.yes').html(y.yes_link);
		$('.no').html(y.no_link);

		$('#flu-no').click(function(){
			$('.widget').hide();
			window.location = no;	

		});

		$('#flu-yes').click(function(){
			$('.widget').hide();
			window.location = yes;	

		});


		$('.wid-btn').click(function(){
			$('.widget').hide();
			sessionStorage['visit'] = "yes";

		});



		$('.wid-close').click(function(){
			$('.widget').hide();
			sessionStorage['visit'] = "yes";
		});


	});
});

var yeslink = $('.yes').val();
var nolink = $('.no').val();




var yetVisited = sessionStorage['visit'];
if (!yetVisited) {
    $('.widget').show();
}else{
	$('.widget').hide();
}




});

</script>