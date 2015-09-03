 <div class="container">
        <?php if($gallery->getSystemMessages()): ?>
            <?php foreach($gallery->getSystemMessages() as $message): ?>
                <div class="alert alert-<?php echo $message['type']; ?>">
                    <a class="close" data-dismiss="alert">×</a>
                    <?php echo $message['text']; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Start UberGallery v<?php echo UberGallery::VERSION; ?> - Copyright (c) <?php echo date('Y'); ?> Chris Kankiewicz (http://www.ChrisKankiewicz.com) -->
        <?php if (!empty($galleryArray) && $galleryArray['stats']['total_images'] > 0): ?>
            <ul class="gallery-wrapper thumbnails">
                <?php foreach ($galleryArray['images'] as $image): ?>
                	<li class="cms design portfolio-item">
                        <a href="../<?php echo html_entity_decode($image['file_path']); ?>" title="<?php echo $image['file_title']; ?>" class="pirobox_gall thumbnail" rel="gallery">
                            <img rel="gallery" src="../<?php echo $image['thumb_path']; ?>" alt="<?php echo $image['file_title']; ?>" />
                        </a>
                    </li>                    
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <!-- End UberGallery - Distributed under the MIT license: http://www.opensource.org/licenses/mit-license.php -->




        <?php if ($galleryArray['stats']['total_pages'] > 1): ?>

            <div class="pagination pagination-centered" style="clear:both;">
                <ul id="pager">
                    <?php foreach ($galleryArray['paginator'] as $item): ?>

                        <?php

                            switch ($item['class']) {

                                case 'title':
                                    $class = 'disabled';
                                    break;

                                case 'inactive':
                                    $class = 'disabled';
                                    break;

                                case 'current':
                                    $class = 'active';
                                    break;

                                case 'active':
                                    $class = NULL;
                                    break;

                            }

                        ?>
                        

                        <li class="<?php echo $class; ?>">
                            <a href="<?php echo empty($item['href']) ? '#' : $item['href']; ?>&&folder=<?php echo $_GET['folder']; ?>"><?php echo $item['text']; ?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>

<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <!-- <script src="js/jquery-1.6.4.min.js"></script> -->
    <script type="text/javascript" src="../jsgall/pirobox_extended.js"></script>
    <script type="text/javascript" src="../jsgall/jquery-ui-1.8.2.custom.min.js"></script>
    <script src="../jsgall/bjqs-1.3.min.js"></script>
    <link href="../css_pirobox/style_1/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .bx-viewport li{
            height:190px;
        }
        .bx-viewport img{
            height:150px;
        }

.pirobox_gall p{
	color:#030B0C;

	font-weight:bold;
	letter-spacing:0px;
	font-family:Georgia, "Times New Roman", Times, serif;
	text-align:center;
	word-wrap: break-word;
	}
.gall{
	display:inline-block;
	float:left;
	margin:5px 15px 15px;

}
.gall a{
	float:left;
	margin:5px 10px 15px;
	width:200px;
}
.gall img{
	border:6px solid #333;
	box-shadow: 0 0 15px 1px #333;
}
</style>

    <!-- load jQuery and the plugin -->

    <script type="text/javascript">

/*    jQuery(document).ready(function() {
 			$("html, body").animate({ scrollTop: 1000);
 		});*/

        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 1) {
                $('#header').css({
                    "top": y
                });
            } else {
                $('#header').css({
                    "top": "0"
                });
            }
        });

        var SimpleTabs = {
            prepare: function(oTabs) {
                var oThis = this;
                this.oTabs = oTabs;
                this.oTabs.children('.tab').click(function() {
                    var oTab = jQuery(this);
                    oTab.siblings('.current').removeClass('current').end().addClass('current');
                    jQuery(oTab.attr('href')).siblings('.current').hide(300).removeClass('current').end().show(300).addClass('current');
                    return false;
                });
            }
        }

        $(document).ready(function() {
            $().piroBox_ext({
                piro_speed: 500,
                bg_alpha: 0.5,
                piro_scroll: true // pirobox always positioned at the center of the page
            });
        });

        // page scroll top  
        $(window).ready(function() {
            $('#click-to-top').click(function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
            });
        });

        // Slider script
        jQuery(document).ready(function($) {
            $('#banner-fade').bjqs({
                height: 520,
                width: 960,
                responsive: true
            });
        });

        SimpleTabs.prepare( jQuery('#my_tabs') );

    </script>