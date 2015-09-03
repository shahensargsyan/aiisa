<div id="sessionIdDuplicate" class="hidden"><?php echo $meditation_id; ?></div>
<div id="map1" style="width:100%; height: 500px; margin-top: -30px;"></div>
<div id ="totalcount"  style="display: none" class="hidden"><?php echo $total_count ;?><?php echo $modType;?> </div>
<?php
   foreach($show_default_loc_array as  $key => $locat){
       $ll = explode(',',$locat['latLong']);
        foreach($result_loc_array as $loc){
            if($ll[0] == $loc['latitude'] && $ll[1] == $loc['longitude']){
                $show_default_loc_array[$key]["latLong"] = '0,0';
            }

        }
   }
?>
<!--//#292929 grey-->
<script>
	 //jQuery.noConflict();
		 jQuery(function(){
      	//var $ = jQuery;
			var palette = ['#DBE8A5'];//57767E//85B6DE#68B9DE
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
					?>{latLng: [<?php echo $latLong ;?>]},
					<?php
				}
				//SHOW WHO DOING MEDITATING
				foreach($result_loc_array as $locat){
					$lats	=	$locat['latitude'];
					$longs	=	$locat['longitude'];
					$cities = 	$locat['city'];
					$remote_addr = $locat['remote_addr'];
					
					?>{latLng: [<?php echo $lats;?>,<?php echo $longs;?>]},
					<?php
				}
				?>		
		
								
			],
        values3 = {
			
            <?php 
            if($modType == 'play'){
                for($i=0;$i<=49;$i++){ 
                        echo "{$i}".':'.'"medfinish"'.',' ;

                }
                for($i=50;$i<$total_count;$i++){
                        if($i==$total_count-1):
                                echo "{$i}".':'.'"current"'.',' ;
                        else:
                                echo "{$i}".':'.'"mednow"'.',' ;
                        endif;
                        //echo "{$i}".':'.'"mednow"'.',' ;
                }
                }
                if($modType == 'pause' || $modType == 'stop'){
                        for($i=0;$i<=50;$i++){ 
                                echo "{$i}".':'.'"medfinish"'.',' ;
                        }
                        for($i=50;$i<=$total_count;$i++){
                                echo "{$i}".':'.'"mednow"'.',' ;
                        }
                }
                ?>
			
			
			
          };
        var map1 =new jvm.Map({

                        map: 'world_mill_en',
                        container: $('#map1'),
                        markers: markers,
                        series: {
                                        markers: [{
                                        attribute: 'image',
                                        scale: {
                                                 mednow: '/img/dots/green/0.png',
                                                medfinish:'/img/dots/blue/0.png',
                                                current: 'img/dots/green/0.png'

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
                        onMarkerTipShow : function(e, code) {
                            return false;
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

        setTimeout(function(){
             $('.jvectormap-marker').each(function(k,v){
                if(v.href.animVal == '/img/dots/green/0.png'){
                    v.classList.add("green");
                }else{
                    v.classList.add("blue");
                }
             });
        },1000);
                      
});
</script>