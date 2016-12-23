<div class="productinfo-banner">
	<img src="images/banners/productinfo-banner.jpg" width="100%">
</div>
<div class="product-container">
	<div class="col-md-12">
		<label class="prod-title">WHAT IS IN THE ALL&#8208;IN&#8208;ONE BIOFLU?</label>
	</div>
	<div class="col-md-12 prod-desc">
		
	</div>
	<div class="prod-dosage">
		<div class="col-md-12 border-top">
			<span>How often should you take Bioflu?</span>
		</div>
		<div class="usage"></div>
	</div>
	<div class="warning">
		<div class="col-md-12 border-top">
			<div class="warning-text">
				<div class="w-text">Warning</div>
				<div class="sign-text">Sign and Symptoms of Overdosage</div>
			</div>
		</div>
		<div class="col-md-12 pad-0 dosage-warning">
			
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
$.ajax({
	type: 'post',
	url: 'templates/bioflu/controller_tek.php?query=get_productInfo',
}).done(function(data){
	var obj = JSON.parse(data);
	$.each(obj, function(x,y){
		$('.prod-desc').html(y.formulation);
		$('.usage').html(y.usage);
		$('.dosage-warning').html(y.dosage);
	});
});
});
</script>