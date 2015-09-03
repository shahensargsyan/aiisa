<div id="banner">
<?php 
$userData = $this->Session->check('userId');					
?>	
<script type="text/javascript">
$(document).ready(function(){

	$('.demo1').TrackpadScrollEmulator();
	$('.demo2').TrackpadScrollEmulator();
	 
});
</script>

<?php 
//check if shared meditation is numric or not .pop up should be appear for numeric value
//echo"<pre>";print_r($_REQUEST);
if(!empty($_REQUEST['mn'])){
	$mn = $_GET['mn'];
	if($mn == '11328618a16d4e24b3fabe30587c4714'){ 
	//show timer?>
	<script type="text/javascript">
	$(document).ready(function(){
            $(".popup_0_container" ).fadeOut("slow",function(){
                //$(".blank_wrapper1").attr("id","popup");
                $(".popup_2_container").fadeIn("slow");	
                //$(".popup_0_container").fadeOut("slow");	
            });	
	
	});
	</script>
    <?php }
    else{
    //nothing here
    }
}



if(is_numeric($fbshareMinutes)){
    $value = $fbshareMinutes;
}
else{
    $value = " ";
}?>
					
<div id="fbshareMins" style="display:none;"><?php  echo $value;?></div>						
<?php echo $this->element('timer'); ?> 
<!-- TIMER CLOSE -->
    
  
<!--    <div class="popup_0_container">
		<a  href="javascript:void(0);">
		<div class="start_popup">
			<div class="start_link">START</div>
		</div>
		</a>
	</div>-->
<!--    <div id="map">
        <img src="/img/map.png" />
    </div>-->
    <div class="" id="popupContainer">
        <div id=""  class="popup_0_container ">
            <div id="taglines">
                <h2 class="taglineTop">Meditate with us and help end world hunger.</h2>
                <h3 class="taglineBot">Using our Free Meditation Timer</h3>
            </div>
            <div id=""  class="">
                <div id="buttonborder">
                    <a href="javascript:void(0);" class="mainButton start_link">START MEDITATING</a>
                </div>
            </div>
        </div>
<!--        <div id="map">
            <img src="img/map.png" />
        </div>-->
            <!--------- POP_UP-1 ------------->
            <?php echo $this->element('location'); ?> 
            <?php echo $this->element('meditate_now'); ?> 
            <!--------- END @ POP_UP-1 ------->
            <!---------- POP_UP-2 ------------>
            <?php echo $this->element('meditation_session'); ?> 
            <!--------- END @ POP_UP-2 ------->
            <!----------BANNER_DATE_HOLDER --->
            <?php echo $this->element('feedback'); ?> 
            <?php echo $this->element('meditation_timer'); ?><!--design isn't created yet, wil be shown when it will be ready -->
              
            <div class="popup_3_container" style="display:none;">
              
                <?php echo $this->element('time_frame'); ?> 
            </div>

            <!-- location notification -->
        <div id="popup_1" class="blank_wrapper1 popup_1">
            <div class="map" id="map_container">
                <div id="map1" style="width:100%; height: 500px;"></div>
            </div>
            <div class="lightModalOverlay">&nbsp;</div>
        </div>
    </div>
</div>
<!--------- END @ BANNER_DATE_HOLDER ------->

 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript">
         //jQuery.noConflict();
         jQuery(function(){
            //var $ = jQuery;
                var palette = ['#C1D895'];//57767E//85B6DE#68B9DE
                generateColors = function(){
                   // alert("hi");
                        var colors = {},key;
                        for (key in map1.regions) {
                                colors[key] = palette[Math.floor(Math.random()*palette.length)];
                        }
                        return colors;
                },map1;
                var markers =  [
                        <?php 
                                //FOR LAST 10 MEDITATING USER 
                                foreach($show_default_loc_array as $locat){ 
                                $latLong = 	$locat['latLong'];
                                $cities = 	$locat['city'];
                                ?>{latLng: [<?php echo $latLong ;?>], name: '<?php echo $cities; ?>'},
                                <?php
                        }
                        //SHOW WHO DOING MEDITATING
                        foreach($result_loc_array as $locat){
                                $lats	=	$locat['latitude'];
                                $longs	=	$locat['longitude'];
                                $cities = 	$locat['city'];
                                $remote_addr = $locat['remote_addr'];

                                ?>{latLng: [<?php echo $lats;?>,<?php echo $longs;?>], name: '<?php echo $cities; ?>'},
                                <?php
                        }
                        ?>		


                ],
                values3 = {
                   // 0: 'current',
                   <?php 
                   for($i=0;$i<=99;$i++){ 
                       echo "{$i}".':'.'"medfinish"'.',' ;
                   }
                   for($i=100;$i<=$total_count;$i++){
                       echo "{$i}".':'.'"mednow"'.',' ;
                   }
                   ?>

                 };
                   var map1 =new jvm.Map({

                       map: 'world_mill_en',
                       container: $('#map1'),
                       markers: markers,
                       series: {
                           markers: [{
                            hover: {
                            cursor: 'pointer'
                          },
                           attribute: 'image',
                           scale: {
                                   mednow: '/img/dots/green/0.png',
                                   medfinish:'/img/dots/blue/0.png',
                                   current: 'http://satorio.org/img/map/current.gif'
                           },
                           values: values3,
                           /*legend: {
                                   horizontal: true,
                                   cssClass: 'jvectormap-legend-icons',
                                   title: 'Business type'
                           }*/
                           }],
                            regions: [{
                               attribute: 'fill'
                           }]

                       },
                          onRegionOver: function(e, code) {
                                if (regionResults.hasOwnProperty(code)) {
                                    // the hovered region is part of the regionResults, show hand cursor
                                    document.body.style.cursor = 'default';
                                }
                            },
                            onRegionOut: function(e, code) {
                                // return to normal cursor
                                document.body.style.cursor = 'default';
                            },
                            onMarkerOver : function(e, code) {
                                document.body.style.cursor = 'default';
                            },

                           scaleColors: ['#C8EEFF', '#0071A4'],
                           normalizeFunction: 'polynomial',
                           hoverOpacity: 0.7,
                           hoverColor: false,
                           backgroundColor: false,
                           zoom:true,
                           zoomOnScroll:false,
                           focusOn:{ x: 0.6,
                                             y: 0.5,
                                             scale: 1
                           },
                           regionStyle:{
                                   hover: {
                                           fill: '#D5E4B8',
                                           "fill-opacity": 1
                                   }
                           },		
                       });
                       map1.series.regions[0].setValues(generateColors());
                       var i=0;
                       var src;
                       var bool = true;
                        setInterval(function(){
                           
                            //console.log(i)
                            if($('.jvectormap-marker').length){
                                if ($('.jvectormap-marker').attr('href').indexOf("0") >= 0){
                                    $('.jvectormap-marker').attr('href', $('.jvectormap-marker').attr('href').replace('0', '1'));
                                }else{
                                    $('.jvectormap-marker').attr('width',"35px");
                                    //console.log($('.jvectormap-marker').attr('href').replace(i, i+1));
                                    $('.jvectormap-marker').attr('href', $('.jvectormap-marker').attr('href').replace(i, i+1));
                                    i++;
                                    if(i>16){
                                        src = $('.jvectormap-marker').attr('href').replace(i, 1);
                                        $('.jvectormap-marker').attr('href', src);
                                        i=1;
                                    }
                                }
                            }
                        }, 80);

            });
</script>

<!-- FLASH MESSAGE-->
<?php if( $this->Session->check('Message.flash') ): ?>
    <div id="registration_message">
        <div class="flash-message"><?php echo $this->Session->flash(); ?></div>
    </div>		 
<?php endif; ?>
<script type="text/javascript">hideFlash('registration_message');</script>
<!-- END @ FLASH MESSAGE-->
<?php //echo"</br>";echo"<br>";echo $total_count;?>
<!-- blank wrapper 1-->
