<body style="margin:0; padding:0; list-style:none; text-decoration:none; font-family:Arial; border:none;">
	<?php 
	$hourConsume = $total_med_session;
	$toatalHour  = $maxHour;  
	list($hours, $minutes, $seconds) = explode(':', $hourConsume);
    $secondsConsumes= $hours*3600 + $minutes*60 + $seconds;
	
	
	list($hours, $minutes, $seconds) = explode(':', $toatalHour);
	$secondsTotal = $hours*3600 + $minutes*60 + $seconds;
	
	$progress = ($secondsConsumes/$secondsTotal)*100;
	?>
	
	<div style="padding:30px;">
		<div style="width:560px; border: 10px solid #4585b1; margin:auto;">
			<div class="container" style="width:auto; min-height:500px; padding: 20px 25px;background:#DAE7FO">
				 <div id="progressbar" style="background-color:red;"></div>
				<div style="margin-bottom: 0px;">
					<a href="http://meditationmusic.net/" style="margin:0px;"><img src="http://meditationmusic.net/img/mail-logo.JPG" style="width:510px"/></a>
				</div>  <!-- logo_wrapper -->
				
				<div style="padding:10px; background:#dae7f0; margin-bottom: 15px;">
					<div style="border-bottom:1px solid #cdcdcd; padding-bottom:10px; margin-bottom: 15px;">
						<div style="width:110px; height:95px; padding:5px; float:left; border:1px solid red; border:1px solid #bcc2c6;">
							<img style="width:110px;height:95px;"src="<?php echo $profilePic ;?>" />
						</div>
						<div style="width:362px; float:right;">
							<div style="color:#4087b0; font-size:25px; margin-bottom: 4px;padding-left:23px;"> <?php echo $userName ?></div>
							<div style="font-size:12px;padding-bottom:6px;padding-left:23px;">
								<div style="float:left; margin-right: 7px;"><img src="http://meditationmusic.net/img/cal.jpg"></div>
								<div style="float:left; margin-bottom: 6px;"><?php echo $weekStartDate;?>  <b>TO</b> <?php echo $weekEndDate;?></div>
								<div style="clear:both;"></div>
							</div>
							<div style="width:auto;text-align:center">
								<div style="width:33%; float:left;">
									<div style="font-size:14px; color:#010101; text-transform:uppercase;">This Week</div>
									<div style="font-size:32px; color:#434242; font-weight:bold;"><?php echo $thisWeek;?> </div>
									<span style="font-size:12px;color:#434242;font-weight:bold;padding-left:4px;">Minutes</span>
								</div>
								<div style="width:33%; float:left;text-align:center">
									<div style="font-size:14px; color:#010101; text-transform:uppercase;">Average Daily</div>
									<div style="font-size:32px; color:#434242; font-weight:bold;"><?php echo $averageDaily;?> </div>
									<span style="font-size:12px;color:#434242;font-weight:bold;padding-left:4px;">Minutes</span>
								</div>
								<div style="width:33%; float:left;text-align:center">
									<div style="font-size:14px; color:#010101; text-transform:uppercase;">To Date</div>
									<div style="font-size:32px; color:#434242; font-weight:bold;"><?php echo $total_med_minutes;?> </div>
									<span style="font-size:12px;color:#434242;font-weight:bold;padding-left:4px;">Minutes</span>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div> <!-- profile_content -->
						<div style="clear:both;"></div>
					</div>  <!-- user_profile -->
					
					<div>
						<div style="background:#8de391; min-height:60px; border:1px solid #ffffff; width:48.5%; float:left; text-align:center; padding: 8px 0;">
							<div style="width:auto; margin-bottom:3px;"><img src="http://meditationmusic.net/img/smily.png" /></div>
							<div style="font-size:13px; color:#292929;">
							
							Best Day (<?php echo $mostActiveDaySession ?> <?php echo $amins ?>)</div>
							<div style="font-size:16px; color:#292929;"><?php echo $mostActiveWeekDay;?></div>
						</div>
						<div style="background:#fa83a5; min-height:60px; border:1px solid #ffffff; width:48.5%; float:right; text-align:center; padding: 8px 0;">
							<div style="width:auto; margin-bottom:3px;"><img src="http://meditationmusic.net/img/sad.png" /></div>
							<div style="font-size:13px; color:#292929;">
							
							 Worst Day (<?php echo $WrostDaySession ?> <?php echo $mins ?>)</div>
							<div style="font-size:16px; color:#292929;"><?php echo $WrostDay; ?></div>
						</div>
						<div style="clear:both;"></div>
					</div> <!-- day_wrapper  -->
				</div>  <!-- profile_wrapper -->
				
				<div>
					<div style="width:306px; float:left;">
						<div style="margin-bottom: 25px;">
						  
							
							<div style="background: none repeat scroll 0 0 #e6e6e6; min-height: 35px; margin-bottom:6px;">
								<h1 style="padding:6px 10px;font-size:12px; margin:6px 0 0 10px; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:left; font-weight:normal; width:72%;">Hours of Meditation</h1>
								
								<h2 style="font-size:16px; margin:6px 0px 0px; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:left;"><?php echo $total_med_session1 ?></h2>
								<span style="top:100;position:absolute;width: <?php echo $progress?>%;background-color: #34c2e3;display:block; height: 35px; box-shadow: 0 1px 0 rgba(255, 255, 255, .5) inset;transition: width .4s ease-in-out;background-size: 30px 30px;background-image: linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);animation: animate-stripes 3s linear infinite;">
								</span>
								<div style="clear:both;"></div>
								
								
							</div>
							<!--<div style="background: none repeat scroll 0 0 #e6e6e6; min-height: 25px; padding: 6px 10px; margin-bottom:6px;">-->
						<div style="background: none repeat scroll 0 0 #e6e6e6; min-height: 35px; margin-bottom:6px;">
								<h1 style="padding:6px 10px;font-size:12px; margin:6px 0 0 10px; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:left; font-weight:normal; width:72%;">Hours Until Next LeveL</h1>
								<h2 style="font-size:16px; margin:6px 0px 0px; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:left;"><?php echo $remainTime ;?></h2>                          
								 <span style="top:100;position:absolute;width: <?php echo $progress?>%;background-color: #34c2e3;display:block; height: 35px; box-shadow: 0 1px 0 rgba(255, 255, 255, .5) inset;transition: width .4s ease-in-out;background-size: 30px 30px;background-image: linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);animation: animate-stripes 3s linear infinite;">
								</span>
								<div style="clear:both;"></div>
							</div>
							<div style="background: none repeat scroll 0 0 #e6e6e6; min-height: 25px; padding: 6px 10px; margin-bottom:6px;">
								<h1 style="font-size:12px; margin:0; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:left; font-weight:normal;">Total Number of Meditation Sessions</h1>
								<h2 style="font-size:16px; margin:0; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:right;"><?php echo $total_site_session ?></h2>
								<div class="clear" style="clear:both;"></div>
							</div>
							
							<div style="background: none repeat scroll 0 0 #e6e6e6; min-height: 25px; padding: 6px 10px; margin-bottom:6px;">
								<h1 style="font-size:12px; margin:0; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:left; font-weight:normal;">Total Meditation Minutes</h1>
								<h2 style="font-size:16px; margin:0; padding:0; line-height:25px; color:#292929; text-transform:uppercase; float:right;"><?php echo $total_med_minutes;?></h2>
								<div style="clear:both;"></div>
							</div>
						</div>	 <!-- meditation_post_wrapper -->
						<div style="width:auto;">
							<div style="font-size:14px; color:#292929; text-transform:uppercase; margin-bottom: 5px;">Featured Album</div>
							<div style="padding:10px; min-height:100px; background:#e6e6e6;">
								<div style="width:88px; min-height:88px; float:left;">
									<a href="https://itunes.apple.com/album/id775242245"  style="font-size:14px; margin:0; padding:0; color:#3c7298; margin-bottom: 6px; text-transform:uppercase;"><img src="http://meditationmusic.net/img/post_image.png" /></a>
								</div>
								<div style="width:182px; min-height:88px; float:right;">
									<h2 style="font-size:14px; margin:0; padding:0; color:#3c7298; margin-bottom: 6px; text-transform:uppercase;"><a href="https://itunes.apple.com/album/id775242245"  style="font-size:14px; margin:0; padding:0; color:#3c7298; margin-bottom: 6px; text-transform:uppercase;">Yoga Music</a></h2>
									<p style="font-size:12px; color:#323333; margin:0; padding:0; ">
									Awake from shavasana feeling healed of your everyday stresses with our latest yoga music album. Enjoy the relaxing sounds during and away from your yoga mat.
									</p>
								</div>
								<div style="clear:both;"></div>
							</div>
						</div> <!-- meditation_album_wrapper -->
					</div>  <!-- page_contnet -->
					
					<div style="width:188px; float:right;">
					
						<div style="margin-bottom: 30px;">
						<div style="font-size:14px; color:#292929; text-transform:uppercase; margin-bottom: 5px; margin-bottom:15px;">Leaderboard</div>
				         <?php
						 //first three weekly winner
						 //echo"<pre>";print_r($winnerdata);
						 $arrCount = count($winnerdata);
						 
						 for($c=0;$c<=$arrCount-1;$c++):
						 if($c==0):
						 	$medal ="gold.png";
						 elseif($c==1):
						 	$medal ="silver.png";
						 elseif($c==2):
						 	$medal ="brown.png";
						 endif;
						 
						 $winnerSum = $winnerdata[$c]['sum'];
						 if($winnerSum==0){
						 	//break;
						 }
						 ?>
						 
						 <div style="margin-bottom:20px;">
							<div style="width:31px; height:31px; float:left; margin-right:5px; background:#eee; text-align:center; line-height: 30px; font-size:20px; color:#272626; background:url('http://meditationmusic.net/img/<?php echo $medal ?>');"><?php echo $c+1 ?></div>
							<div style="width:50px; min-height:52px; float:left;">
							
							<?php if(!empty($winnerdata[$c]['profile_picture'])):?>
								<a href="#">
								<img style="width:50px;height:52px" src="<?php echo $profilePicFolderPath.$winnerdata[$c]['profile_picture']?>" />
								</a>
							<?php else :?>
								<img style="width:50px;height:52px" src="<?php echo $profilePicFolderPath.'default-profile.jpeg'?>" />
							<?php endif;?>
							
							</div>
							<div style="width:95px; padding-top: 8px; float:right;">
								<h2 style="font-size:17px; color:#256d9e; font-weight:normal; margin:0; padding:0;"><?php echo $winnerdata[$c]['first_name'];?></h2>
								<p style="font-size:14px; color:#292929; margin:0; padding:0;"><?php echo $winnerdata[$c]['sum']; ?> Mins</p>
							</div>
							<div style="clear:both;"></div>
						</div>  <!-- winner_wrapper -->
						<?php endfor;?>
						
						</div> <!--content_level -->
						
						<div class="social_level">
							<div class="share_wrapper">
								<div style="text-align:center; text-transform:uppercase; margin-bottom:7px;">Find us On</div>
								<div style="margin: auto; width: 118px;">
									<ul style="width:auto; list-style:none; margin:0; padding:0;">
										<li style="float:left; width:20%; text-align:center;"><a href="#"><img src="http://meditationmusic.net/img/facebook.png" /></a></li>
										<li style="float:left; width:20%; text-align:center;"><a href="#"><img src="http://meditationmusic.net/img/twit-mail.png" /></a></li>
										<li style="float:left; width:20%; text-align:center;"><a href="#"><img src="http://meditationmusic.net/img/gmail.png" /></a></li>
										<div class="clear" style="clear:both;"></div>
									</ul>
								</div>
							</div>
						</div> <!-- content_level -->
						
						
					</div>  <!-- sidebar -->
					<div style="clear:both;"></div>
				</div>  <!-- content_wrapper -->

			</div>  <!-- container -->
			
			<div style="background:#e6e6e6; min-height:45px; padding: 0px 25px; display:flex;">
				<div style="width:64px; margin-top: 11px; float:left; margin-right:12px;"><a href="#"><img src="http://meditationmusic.net/img/footer_logo.png" /></a></div>
				<div style="width:425px; float:right;padding:24px 0px;">
					<!--<p style="font-size:11px; color:#4b4b4b; margin-bottom: 6px;">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
					</p>
					<h3 style="font-size:11px; color:#2e759e;">Lorem Ipsum is simply dummy text </h3>-->
					
					<p style="font-size:14px; color:#4b4b4b; margin-bottom: 6px;">
					<?php 
					$enc = base64_encode ($userId);
					?>
					<center> <a href="http://satorio.org/meditations/unsubscribe/<?php echo $enc;?>" style="color:#B80000;">Unsubscribe</a> to this weekly alerts instantly.</center>
					</p>
					
				</div>
				<div style="clear:both;"></div>
			</div> <!-- footer_wrapper -->
		
		</div>  
	</div>





