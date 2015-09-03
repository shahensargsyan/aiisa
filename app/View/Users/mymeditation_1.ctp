<?php
echo $this->Html->script('fileuploader');
if( $this->Session->check('Message.flash') ): ?>
	<div class="session-msg-holder" id="profile_message">
		<div class="banner-date-cont">
			<h1 id="instruction"><?php echo $this->Session->flash(); ?></h1>
		</div>
	</div>
<?php endif; ?>
<script type="text/javascript">hideFlash('profile_message');</script>
<?php function meditition_end_time($hour ,$starttime){
	$times     = explode(':', $hour);
	$timestamp = strtotime($starttime) + ($times[0] * 3600 + $times[1] * 60 + $times[2]);
	$endtime   = date('H:i', $timestamp);
	echo $endtime; 
}
?>
<div id="banner">
    <?php echo $this->element('top'); ?> 
    <div class="popup dashboardPopup" id="pp">

        <?php echo $this->element('account_menu'); ?> 

        <div id="popup_right">
            <div class="popupHeader">
                <h2 class="popupH">My Profile</h2>
                <div class="sepAU"></div>
                <a href="/" class="cls_button">X</a>
            </div>
            <div id="dashContent">
                <div id="meButtons">
                    <a href="#" class="outline_btn btnGreen selected" id="meditating_now_tab">MY MEDITATION</a>
                    <a href="#" class="outline_btn" id="meditating_near_me_tab">SET MEDITATION</a>
                </div>
                <div class="sepAU"></div>
                <div id="meditating_now_list" class="meditationStats">

                    <ul>
                        <li>
                            <p class="meStatLeft">Nirvana Status:</p>
                            <p class="meStatRight">Level <?php echo $userLevel; ?></p>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <p class="meStatLeft">Hours left to reach next level:</p>
                            <p class="meStatRight"><?php 
                            $time = explode(":",$remainTime);
                            $hh 	= (strlen($time[0])>1)?$time[0]:'0'.$time[0];
                            $mm 	= (strlen($time[1])>1)?$time[1]:'0'.$time[1];
                            $ss 	= (strlen($time[2])>1)?$time[2]:'0'.$time[2];
                            echo $hh.':'.$mm.':'.$ss;	
                            ?></p>
                            <div class="clearfix"></div>
                        </li>

                    </ul>
                    <div class="sepAU"></div>


                    <ul>
                        <li>
                            <p class="meStatLeft">Total Number of Meditation Session:</p>
                            <p class="meStatRight"><?php echo $session_data['total_site_session'];?></p>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <p class="meStatLeft">Total Number of Countries Meditated:</p>
                            <p class="meStatRight"><?php echo $session_data['numberCountries']; ?></p>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <p class="meStatLeft">Total Completed Meditation Session:</p>
                            <p class="meStatRight"><?php echo $total_med_session;?> (HH:MM:SS)</p>
                            <div class="clearfix"></div>
                        </li>
                    </ul>


                    <div class="sepAU"></div>

                    <ul>
                        <li>
                            <p class="meStatLeft">Longest Meditation Session:</p>
                            <p class="meStatRight"><?php 
                            if(!empty($session_data['long_session'])){
                                echo $session_data['long_session'];
                            }else{
                                echo '00:00:00';
                            }?> (HH:MM:SS)</p>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <p class="meStatLeft">Average Meditating Session:</p>
                            <p class="meStatRight">
                            <?php if(!empty($session_data['average'])){
                                    echo $session_data['average'];;
                            } else {
                                    echo '00:00:00';
                            }
                            ?> (HH:MM:SS)</p>
                            <div class="clearfix"></div>
                        </li>

                    </ul>


                    <div class="sepAU"></div>


                    <ul>
                        <li>
                            <p class="meStatLeft">Consecutive Meditating Session Days:</p>
                            <p class="meStatRight">
                                <?php
                                $total = ($session_data['total']!='')?$session_data['total']:'0';
                                echo $total;
                                ?>
                            </p>
                            <div class="clearfix"></div>
                        </li>


                    </ul>

                    <div class="sepAU"></div>
                    <div id="meLastSessions">
                        <h3 class="subhead">Last Meditating Sessions</h3>
                        <?php 
                        if(!empty($condays)){?>
                            <div id="meTable">
                            <table>
                                <thead>
                                <?php 
                                foreach($condays as $days){
                                        $dates = explode(" ",$days['Meditation']['submitdate']);
                                        $country =($days['Meditationsmeta']['cityName']!='')?$days['Meditationsmeta']['cityName']:'N/A';
                                        ?>
                                        <tr>
                                            <td> <?php echo $dates[0];?></td>
                                            <td>Barcelona</td>
                                            <td><?php echo $country; ?></td>
                                            <td>
                                                <!--<img src="img/smileys/happy1.png">-->
                                            <?php 
                                                $rating =($days['Feedback']['rating']!='')?$days['Feedback']['rating']:'N/A';
                                                if($rating==5){
                                                        $img ='<img src="../img/smile_big.gif" width="19" height="19" id="rating" title="'.$rating.'">';  
                                                }
                                                else if($rating==4){
                                                        $img = '<img src="../img/smile_normal.gif" width="19" height="19" id="rating" title="'.$rating.'">';  
                                                }
                                                else if($rating==3){
                                                        $img ='<img src="../img/smile_indifferent.gif" width="19" height="19" id="rating" title="'.$rating.'">';  
                                                }
                                                else if($rating==2){
                                                        $img= '<img src="../img/smile_confused.gif" width="19" height="19" id="rating" title="'.$rating.'">';
                                                }
                                                else {
                                                        $img = '<img src="../img/smile_frown.gif" width="19" height="19" id="rating" title="'.$rating.'">';  
                                                }

                                                if(is_numeric($rating)){
                                                        echo $img;
                                                } else{
                                                        echo $rating;
                                                }
                                                ?>
                                        </tr>

                        <?php } ?>
                                    </thead>
                                </table>
                                 <?php
                                $this->Paginator->options(
                                array(
                                    'update' => '#meLastSessions',
                                    'evalScripts' => true,
                                    'url'=> array('controller' => 'users','action' => 'lastmeditationPagination'),
                                    'before' => $this->Js->get('#paging-indicator')->effect('fadeIn', array('buffer' => false)),
                                    'complete' => $this->Js->get('#paging-indicator')->effect('fadeOut', array('buffer' => false)),
                                )
                            );
                            echo $this->Paginator->numbers();
                            ?>
                            <!--Pagination End-->
                            </div>
                        <?php } else {
                            echo "You have 0 Meditations"; 
                        }
                        ?>


                    </div>

                    <div class="clearfix"></div>
                </div>


                <div class="hidden" id="meditating_near_me_list">
                    <div  id="updateSession">

                        <?php 
                        $totalUserSession = count($userSession);
                        if($totalUserSession<7) {	//If Sessions listing is less than '7', Display form to submit session ?>
                            <div id="msSetMeditation">
                            <h3 class="subhead subleft">Set your meditation session (HH:MM:SS)</h3>

                                <?php echo $this->Form->create('Usersmetas');?>
                                <div id="msTimeSelect">
                                    <div class="DateSelect">
                                        <div class="YearSelect">
                                            <?php echo $this->Form->input('hours',array('type'=>'select','options'=>$hours, 'label'=>false, 'id' => 'hours', 'class'=>'sel selRegister'));?>
                                        </div>
                                        <div class="YearSelect">
                                            <?php echo $this->Form->input('minutes',array('type'=>'select','options'=>$minutes,'label'=>false,'id' => 'minutes', 'class'=>'sel selRegister')); ?>
                                        </div>
                                        <div class="YearSelect">
                                            <?php echo $this->Form->input('seconds',array('type'=>'select','options'=>$seconds,'label'=>false,'id' => 'seconds', 'class'=>'sel selRegister')); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="packet_right msButton">
                                        <?php echo $this->Js->submit( 'Submit', array(
                                            'before'	=> 'return  submitSessionValidate();',
                                            //'success' 	=> 'submitSessionSuccess();',
                                            'complete'  => 'submitCompleteSession();',
                                            'async'     => false,													
                                            'update'    => '#updateSession',
                                            'id'		=> 'submitSession',
                                            'class' 	=> 'white_btn',
                                            'url'       => array('controller'=>'usersmetas', 'action' => 'submitsessionNew')
                                        ));
                                        echo $this->Js->writeBuffer();
                                        ?>
                                </div>	
                                <?php echo $this->Form->end(); ?>	 
                                <!--<div class="message"><?php echo $message; ?></div>-->

<!--                                                <div id="msButton">
                                    <a href="#" class="white_btn">SUBMIT</a>
                                </div>-->
                                <div class="clearfix"></div>
                            </div>
                        <?php } ?>


                            <div id="meLastSessions">
                                <h3 class="subhead subleft">Your Preset Meditation Session (HH:MM:SS)</h3>
                                <div id="msLastTable">

                                        <!--<div class="section-head">Your Preset Meditation Session<span class="note-white" style="margin-left: 6px;">(HH:MM:SS)</span></div>-->

                                        <?php
                                        $count=1;
                                        if(!empty($totalUserSession)){
                                            // Print the User sessions
                                            $userSession = explode(',',str_replace('{','',str_replace('}','',$session_data['usermeta']['setsessions'])));
                                            //echo '<pre>'; print_r($userSession);
                                            $totalUserSession = count($userSession);
                                            if($totalUserSession >=1){
                                                for($i=0;$i<$totalUserSession;$i++){
                                                    $explode_session = explode(':',str_replace("'",'',$userSession[$i]));
                                                    echo $this->Form->create('Usersmetas', array('url' => array('controller' => 'usersmetas'),'id'=>'UserMetaSessionForm'.'_'.$explode_session[0]));
                                                    //echo '<form action="/usersmetas/mymeditationNew" id="UserMetaSessionForm_'.$explode_session[0].'" method="post" accept-charset="utf-8">';
                                                    echo $this->Form->hidden('Usersmetas.delsession', array('value'=> $explode_session[0]));
                                                    echo '  <table><tr>';
                                                   // echo'<div class="packet_left">';
                                                    echo ' <td>Session '.$count.'</td>';    
                                                    if(isset($explode_session[1])&& isset($explode_session[2])&& isset($explode_session[3])){
                                                        echo ' <td>'.$explode_session[1].':'.$explode_session[2].':'.$explode_session[3].'</td>';    
                                                    }else{
                                                        echo ' <td></td>';
                                                    }
                                                    //echo'</div>';
                                                    //echo'<div class="packet_right">';              
                                                    //echo '<div style="float:left;">';
                                                    echo '<td>';
                                                    echo $this->Html->link("Edit",array('controller' => 'usersmetas', 'action' => 'editsessionNew',$explode_session[0],$explode_session[1],$explode_session[2],$explode_session[3]),array('class' => 'outline_btn')).'&nbsp;&nbsp;';
                                                    //echo '<span class="outline_btn">';
                                                    //echo $this->Form->input('setSession', array('label' => false,'maxlength' => '200', 'div' => false, 'id' => 'setSession', 'type' => 'hidden')); 
                                                    // echo $this->Form->error('setSession');
                                                    echo $this->Js->submit( 'Delete', array(
                                                            'before'	=> 'return showConfirm();',
                                                            'update'    => '#updateSession',
                                                            'complete'  =>  'completeSession();',
                                                            'id'        =>  $explode_session[0],
                                                            'class'     => 'deleteSession my_med_btn button outline_btn',
                                                            'url'       => array('controller'=>'usersmetas','action' => 'deletesessionNew'),
                                                            array('confirm' => 'Are you sure?'),
                                                    ));
                                                     echo '</td>';

                                                    $count++;
                                                   // echo'</div>';
                                                    echo '</tr></table>';
                                                    echo $this->Js->writeBuffer();
                                                    echo $this->Form->end();	
                                                }
                                            }
                                        } else {
                                            echo '<div class="myMed">Please Set your Session&nbsp;<em>(You can save upto 7 sessions.)</em></div>';
                                        }
                                        ?>

                                </div>
                            </div>
                        </div>

                        <div id="msBellSound" class=leftControls>
                            <h3 class="subhead subleft">Bell Sound</h3>
                            <?php
                            $filepath = ($session_data['usermeta']['filepath']!='')?$session_data['usermeta']['filepath']:'ring.mp3';
                            ?>
                            <p>Your Bell Sound: <strong><?php echo $filepath;?></strong>
                            </p>
                        </div>


                        <div id="msBellSound" class=leftControls>
                            <h3 class="subhead subleft">Set new bell sound:</h3>
                            <div id="file-uploader" class="chsFileBtn outline_btn"></div>
                            <?php
                            /*echo $this->Form->create('Usersmetas', array(
                                'url'=>array('controller' => 'usersmetas','action' => 'uploadbell'), 'type' => 'file')
                            );*/
                            //echo $this->Form->file('File',array('id' => 'upload','class' =>''));
                            //echo $this->Form->submit('Upload', array('class' => "white_btn", 'id' => 'uploadButton'));
                            //echo $this->Form->error('upload');
                            //echo $this->Form->end();
                            ?>

                            <!--<a href="#" class="white_btn">UPLOAD</a>-->
                        </div>

                        <div class="clearfix"></div>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
    $(document).ready(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById("file-uploader"),
            'action': '/users/uploadbell',
            'debug': false,
            multiple: false,
            sizeLimit: 10 * 1024 * 1024, // max size   
            minSizeLimit: 0, // min size
            allowedExtensions: ['mp3'],
            onSubmit: function(id, fileName){
                //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, responseJSON){
            },
            onComplete: function(id, fileName, responseJSON){
                console.log(responseJSON);
                
            },
            onCancel: function(id, fileName){$('.qq-upload-button').removeClass('.qq-upload-button-visited')},
            messages: {
                sizeError: "Please upload images not bigger than 2MB",
                typeError: "File Not Permitted,!",
            },
            showMessage: function(message){
            }
        });

       
    });
</script>