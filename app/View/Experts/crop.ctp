<div class="example">

		<!--
			NOTE: To change the aspect ratio, look in crop.css
			The class 'default' links the div to the innit(); function
		-->
		<div class="default">
			<div class="cropMain"></div>
			<div class="cropSlider"></div>
			<button class="cropButton">Crop</button>
		</div>

	</div>

	<script>

		// create new object crop
		// you may change the "one" variable to anything
		var one = new CROP();

		// link the .default class to the crop function
		one.init('.default');

		// load image into crop
		one.loadImg('/temp/5cb79bde9c6f2cba82520e8ca5abf9d1.jpg');

		// send coordinates for processing
		// you may call the coordinates with the function coordinates(one);
		$(document).on('click', 'button', function() {

			$.ajax({
				type: "post",
				dataType: "json",
				url: "save.php",
				data: $.param(coordinates(one))
			})
			.done(function(data) {

				$('.example .output').remove();
				$('.example').append('<img src="'+data.url+'" class="output" />')
				$('.example .output').delay('4000').fadeOut('slow');

			});

		});

	</script>