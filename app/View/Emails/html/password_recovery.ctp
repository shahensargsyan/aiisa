<p>Hello <?php echo $contentForEmail['first_name']; ?></p>

<p>To recover Your password visit this 
<a href="<?php echo FULL_BASE_URL_MINE; ?>users/recoverPass/<?php echo $contentForEmail['recovery']; ?>">link</a></p>

<p>Or just copy and paste this URL in Your browser's address bar 
<?php echo FULL_BASE_URL_MINE; ?>users/recoverPass/<?php echo $contentForEmail['recovery']; ?></p>

<p>Thanks</p>
