<!--<div class="message" style="float:left;padding:10px 50px;"><?php echo $message?></div>-->
<?php 
$userSession = explode(',',str_replace('{','',str_replace('}','',$session_data['usermeta']['setsessions'])));
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
        <div class="packet_right msButton submit">
                <?php echo $this->Js->submit( 'Save', array(
                    'before'	=> 'return  submitSessionValidate();',
                    //'success' 	=> 'submitSessionSuccess();',
                    'complete'  => 'submitCompleteSession();',
                    'async'     => false,													
                    'update'    => '#updateSession',
                    'id'		=> 'submitSession',
                    'class' 	=> 'green_btn',
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


	