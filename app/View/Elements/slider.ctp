<script src="/js/chatem/jquery.flexslider-min.js"></script>

<link href="/css/chatem/styles.css" rel="stylesheet" />

<script type="text/javascript" charset="utf-8">
    var $ = jQuery.noConflict();
    $(document).ready(function() {
    $('.flexslider').flexslider({
          animation: "fade"
    });
	
	$(function() {
		$('.show_menu').click(function(){
				$('.menu').fadeIn();
				$('.show_menu').fadeOut();
				$('.hide_menu').fadeIn();
		});
		$('.hide_menu').click(function(){
				$('.menu').fadeOut();
				$('.show_menu').fadeIn();
				$('.hide_menu').fadeOut();
		});
	});
  });
</script>
<div class="container">
    <div class="slider_container">
        <div class="flexslider">
            <?php if(!empty($sliders)){ ?>
            <ul class="slides">
                <?php foreach ($sliders as $key => $value) {  ?>
                  <li>
                    <a target="_blank" href="<?php echo ($value['Slider']['link'])?$value['Slider']['link']:'#' ?>">
                        <img src="/system/slider/<?php echo $value['Slider']['photo']; ?>" alt="<?php echo $value['Slider']['title'] ?>"/>
                    </a>
                    <div class="flex-caption">
                       <div class="caption_title_line">
                           <h2><?php echo $value['Slider']['title'] ?></h2>
                           <p><?php echo $value['Slider']['description'] ?></p>
                       </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            <?php } ?>
        </div>
    </div>
</div>