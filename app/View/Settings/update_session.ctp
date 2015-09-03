<?php if(isset($message)):?>
		<div class = "valid_box"><?php echo $message;
		endif;?></div>
		<script></script>
<?php if(isset($error)):?>
		<div class = "error_box"><?php echo $error;
		endif;
		?>
		<script>
			$('.valid_box').fadeOut(2000);
			$('.error_box').fadeOut(2000);
		</script>
		</div>

