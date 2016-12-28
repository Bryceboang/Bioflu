<div class="col-md-3">
	<div class="row">
		<div class="col-md-12 sidebar pad-top-0 my-options">
			<div class="col-md-12 bg-sidebar"><p>My Options</p></div>
			<div style="width:100%; float:left;">
				<ul class = "sidebar-menu">
				</ul>
			</div>
		</div>
			<div class="col-md-12 sidebar pad-top-0 other-content" style="display:none">
			<div class="col-md-12 bg-sidebar"><p>Settings</p></div>
			<div class="col-md-12">
				
				<div class="col-md-12 pad-5">
					<span>Status</span>
					<select class="status std-text form-control">
						<option value="1" class="publish">Published</option>
						<option value="0" class="unpublish">Unpublished</option>
						<option value="-2" class="trash">Trashed</option>
					</select>
				</div>
				
				<div class="col-md-12 cat-set pad-5">
					<span>Category</span>
					<select class="category std-text form-control">
					</select>
				</div>
				<div class="col-md-12 feat pad-5" style="display:none;">
					<span>Featured</span>
					<select class="featured std-text form-control">
						<option value="1" class="featured">Yes</option>
						<option value="0" class="unfeatured">No</option>
					</select>
				</div>
				<div class="col-md-12 start-pub pad-5">
					<span>Start Publish</span>
					<div class="col-md-12 pad-0">
					
					<input type = "text" class = "std-text form-control start">
					</div>
					<div class="pad-5 calendar" style = "position: absolute; right: 5">
					<span class = "glyphicon glyphicon-calendar"></span>
					</div>
				</div>
				<div class="col-md-12 end-pub pad-5">
					<span>Finish Publish</span>
					<div class="col-md-12 pad-0" >
					
					<input type = "text" class = "std-text form-control finish">
					</div>
					<div class="pad-5 calendar" style = "position: absolute; right: 5">
					<span class = "glyphicon glyphicon-calendar"></span>
					</div>
				</div>

				<div class="col-md-12 hit pad-5">
					<span>Hits</span>
					<input type = "text" class = "std-text form-control hits"  disabled>
				</div>
				

			</div>
		</div>


		<div class="col-md-12 sidebar slider-settings pad-top-0">
			<div class="col-md-12 bg-sidebar"><p>Settings</p></div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4">Transition:</div>
				<div class="col-md-8">
				<div class="col-md-12"><input class = "left-5 s-slide btn-transition" type = "radio" name = "transition" value = "slide">Slide</div>
				<div class="col-md-12"><input class = "left-5 s-fade btn-transition"  type = "radio" name = "transition" value = "fade">Fade</div>
				<div class="col-md-12"><input style = "display:none" class = "left-5 transition" type = "text" name = "transition" value = "Fade"></div>
				</div>
			</div>

			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">Direction of slide transition:</div>
				<div class="col-md-8">
				<div class="col-md-12"><input class = "left-5 horizontal btn-direction" type = "radio" name = "direction" value = "horizontal">Horizontal</div>
				<div class="col-md-12"><input class = "left-5 vertical btn-direction" type = "radio" name = "direction" value = "vertical">Vertical</div>
				<div class="col-md-12"><input style = "display:none" class = "left-5 direction " type = "text" name = "direction" value = "Fade"></div>
				</div>
			</div>

			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">Pause on hover:</div>
				<div class="col-md-8">
				<div class="col-md-12"><input class = "left-5 s-yes btn-hover" type = "radio" name = "hover" value = "true">Yes</div>
				<div class="col-md-12"><input class = "left-5 s-no btn-hover" type = "radio" name = "hover" value = "false">No</div>
				<div class="col-md-12"><input style = "display:none" class = "left-5 pauseOnHover" type = "text" name = "pauseOnHover" value = "Fade"></div>
				</div>
			</div>



			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">Animation speed (ms):</div>
				<div class="col-md-8"><input class = "animSpeed form-control" type = "text" name = "animspeed" value = ""></div>
			</div>

			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">Pause time (ms):</div>
				<div class="col-md-8"><input class = "pauseTime form-control" type = "text" name = "pauseTime"></div>
			</div>

			<div class="none" style = "display:none">

			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">load_jquery</div>
				<div class="col-md-8"><input class = "load_jquery" type = "text" name = "load_jquery"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">initDelay</div>
				<div class="col-md-8"><input class = "initDelay" type = "text" name = "initDelay"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">randomize</div>
				<div class="col-md-8"><input class = "randomize" type = "text" name = "randomize"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">target</div>
				<div class="col-md-8"><input class = "target" type = "text" name = "target"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">enable_minheight</div>
				<div class="col-md-8"><input class = "enable_minheight" type = "text" name = "enable_minheight"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">min_height</div>
				<div class="col-md-8"><input class = "min_height" type = "text" name = "min_height"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">slide_theme</div>
				<div class="col-md-8"><input class = "slide_theme" type = "text" name = "slide_theme"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">bg_color</div>
				<div class="col-md-8"><input class = "bg_color" type = "text" name = "bg_color"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">theme_shadow</div>
				<div class="col-md-8"><input class = "theme_shadow" type = "text" name = "theme_shadow"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">theme_border</div>
				<div class="col-md-8"><input class = "theme_border" type = "text" name = "theme_border"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">theme_border_radius</div>
				<div class="col-md-8"><input class = "theme_border_radius" type = "text" name = "theme_border_radius"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">directionNav</div>
				<div class="col-md-8"><input class = "directionNav" type = "text" name = "directionNav"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">controlNav</div>
				<div class="col-md-8"><input class = "controlNav" type = "text" name = "controlNav"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">positionNav</div>
				<div class="col-md-8"><input class = "positionNav" type = "text" name = "positionNav"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">colorNav</div>
				<div class="col-md-8"><input class = "colorNav" type = "text" name = "colorNav"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">colorNavActive</div>
				<div class="col-md-8"><input class = "colorNavActive" type = "text" name = "colorNavActive"></div>
			</div>


			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">bg_caption</div>
				<div class="col-md-8"><input class = "bg_caption" type = "text" name = "bg_caption"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">transparency_caption</div>
				<div class="col-md-8"><input class = "transparency_caption" type = "text" name = "transparency_caption"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">position_caption</div>
				<div class="col-md-8"><input class = "position_caption" type = "text" name = "position_caption"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">text_align</div>
				<div class="col-md-8"><input class = "text_align" type = "text" name = "text_align"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">color_caption</div>
				<div class="col-md-8"><input class = "color_caption" type = "text" name = "color_caption"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">imagefolder</div>
				<div class="col-md-8"><input class = "imagefolder" type = "text" name = "imagefolder"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">moduleclass_sfx</div>
				<div class="col-md-8"><input class = "moduleclass_sfx" type = "text" name = "moduleclass_sfx"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">cache</div>
				<div class="col-md-8"><input class = "cache" type = "text" name = "cache"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">cache_time</div>
				<div class="col-md-8"><input class = "cache_time" type = "text" name = "cache_time"></div>
			</div>


			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">cachemode</div>
				<div class="col-md-8"><input class = "cachemode" type = "text" name = "cachemode"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">module_tag</div>
				<div class="col-md-8"><input class = "module_tag" type = "text" name = "module_tag"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">bootstrap_size</div>
				<div class="col-md-8"><input class = "bootstrap_size" type = "text" name = "bootstrap_size"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">header_tag</div>
				<div class="col-md-8"><input class = "header_tag" type = "text" name = "header_tag"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">header_class</div>
				<div class="col-md-8"><input class = "header_class" type = "text" name = "header_class"></div>
			</div>
			<div class="col-md-12 pad-5">
				<div class="col-md-4 ">style</div>
				<div class="col-md-8"><input class = "style" type = "text" name = "style"></div>
			</div>
	




</div>


		</div>






		<div class="col-md-12 sidebar " style = "display:none">
			<label>Language to use when editing</label>
			<p>Select a language Below</p>
			<div class="col-md-10 pad-0">
			<select class = "fullwidth">
				<option>English</option>
				<option>Filipino</option>
				<option>Chinese</option>
			</select>
			</div>
			<div class="col-md-1 "><button class = "btn btn-primary btn-go">Go</button></div>
		</div>
	</div>
</div>


<script type="text/javascript">

    $(function() {
               $(".start").datepicker({ dateFormat: "dd-mm-yy" }).val()
               $(".finish").datepicker({ dateFormat: "dd-mm-yy" }).val()
       });
</script>