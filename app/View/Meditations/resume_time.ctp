<div id="sessionIdDuplicate" class="hidden"><?php echo $meditation_id; ?></div>
<div id="map1" class="banner-date-map" style="width: 100%; height: 303px; float:left;"></div>
<script>
	/*$(document).ready(function(){});*/
		var palette = ['#57767E'];
		generateColors = function(){
		  var colors = {},key;
		  for (key in map1.regions) {
			colors[key] = palette[Math.floor(Math.random()*palette.length)];
		  }
		  return colors;
		},map1;
			
		map1 = new jvm.WorldMap({
			map: 'world_mill_en',
			container: $('#map1'),
			series: {
				regions: [{
				  attribute: 'fill'
				}]
			},
			scaleColors: ['#C8EEFF', '#0071A4'],
			normalizeFunction: 'polynomial',
			hoverOpacity: 0.7,
			hoverColor: false,
			backgroundColor: false,
			zoom:false,
			markerStyle: {
			  initial: {
				fill: '#FFFFFF',
				stroke: '#383f47',

			  }
			},
			markers: [
			<?php
				foreach($result_loc_array as $locat){
					$lats	=	$locat['latitude'];
					$longs	=	$locat['longitude'];
					$cities = 	$locat['city'];
					$remote_addr = $locat['remote_addr'];
			?>
					{latLng: [<?php echo $lats;?>,<?php echo $longs;?>], name: '<?php echo $cities; ?>'},
			<?php
				}
			?>				
			]
		});	
		map1.series.regions[0].setValues(generateColors());
	
</script>
