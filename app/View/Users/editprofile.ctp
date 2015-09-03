
	
	
	
			<?php if(!empty($location_coordinates)):?>
			<script type="text/javascript">
				function initialize2() {
					//var latLng = new google.maps.LatLng(33.431441,9.477537);
					var latLng = new google.maps.LatLng(<?php echo $location_coordinates; ?>);
					var map = new google.maps.Map(document.getElementById('mapCanvas'), {
						zoom: 12,
						center: latLng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					placeMarker(latLng, newmarker);
					google.maps.event.addListener(map, "rightclick", function(event) {
						if(markers==''){
							var newmarker;
						} else {
							var newmarker = markers;
						}
						placeMarker(event.latLng, newmarker);
					});
				
					function placeMarker(location, newmarker) {
						if (newmarker) {
							//if marker already was created change positon
							newmarker.setPosition(location);
						} else {
							//create a marker
							newmarker = new google.maps.Marker({
								position: location,
								map: map,
								draggable: true
							});
						}
						markers = newmarker;
						var lat2 = newmarker.position.lat();
						var lng2 = newmarker.position.lng();
						var latLng2 = new google.maps.LatLng(lat2,lng2);
						geocodePosition(newmarker.getPosition(latLng2));
						
						google.maps.event.addListener(newmarker, 'click', function() {});
						google.maps.event.addListener(newmarker, 'dragend', function() {
							geocodePosition(newmarker.getPosition());
						});
					}
				}
				//Onload handler to fire off the app.
				google.maps.event.addDomListener(window, 'load', initialize2);
			</script>
			<?php else:?>
			<script type="text/javascript">
				//Onload handler to fire off the app.
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
			<?php endif;?>
			<div id="mapCanvas" style="height:400px; border:1px solid #333333; margin:10px 0px;"></div>
	

	


