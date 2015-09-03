Hello <?php echo $viewData['first_name']; ?>
<br />
<br />
Thank you for registering at <?php echo Configure::read('TeamName'); ?>.
<br />
<br />
To activate your account click on the link below:<br />
<br />
Link <a href="<?php echo FULL_BASE_URL_MINE.'users/activate/'.$viewData['token'];?>">[here]</a><br />
<br />
The data you entered so far is:<br />
Surname: <?php echo $viewData['last_name']; ?><br />
Name: <?php echo $viewData['first_name']; ?><br />
Email: <?php echo $viewData['email']; ?><br />
