<?php 
$sessionId=$this->Session->read('userId');
//for creating select box 
$hours 		= array();
$minutes 	= array();
$seconds 	= array();

$hours['HH'] 	= '-- HH --';
$minutes['MM'] 	= '-- MM --';
$seconds['SS'] 	= '-- SS --';

for($i=0;$i<=23;$i++){
	if(strlen($i) == 1):
		$hours[] = "0".$i;
	else:
		$hours[]= $i;
	endif;
}

for($i=0;$i<=59;$i++){ 
	if(strlen($i) == 1):
		$minutes[] = "0".$i;
	else:
		$minutes[]= $i;
	endif;
}

for($i=0;$i<=59;$i++){
	if(strlen($i) == 1):
		$seconds[] = "0".$i;
	else:
		$seconds[] = $i;
	endif;
}
// fetching the value of edited session
$para=$this->request->params['pass'][0];
$hour=$this->request->params['pass'][1];
$minute=$this->request->params['pass'][2];
$second=$this->request->params['pass'][3];
$passSession = $hour.":".$minute.":".$second;
// creating the editing form
echo $this->Form->create('UsersMetas',array('url'      => array('controller'=>'usersmetas','action' => 'editSession')));
?>	

<div class="dashbord">
   <?php echo $this->element('dashbord-menu'); ?>
    <div class="dashbord-content">
        <div class="dashbord-header zoom">
            <div class="dashbord-header-content">
                <div class="dashbord-header-content-left">
                    <div class="dashbord-title">Edit Session</div>
                    <div class="dashbord-header-right">
                        <!--<a href="#" class=""></a>-->
                        <?php echo $this->Html->link("START MEDITATION", "/meditations/index?mn={$hash}", array('class' => 'start-meditation')); ?>
                    </div>
                </div>
                <div class="user">
                    <div class="user-content">
                        <div class="profile-image">
                            <img src="/<?php echo $profile_picture ?>" height="44px" width="44px">
                        </div>
                        <div class="username"><?php echo $first_name; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashbord-section-midle">
            <div id="dashContent">

                <!--<h3 class="subhead subleft">Edit Session</h3>-->
                <div class="page_container">
                    <div id="msTimeSelect">
                        <div class="DateSelect">
                            <div class="YearSelect">
                                <?php echo $this->Form->input('hours',array('type'=>'select','options'=>$hours, 'label'=>false, 'id' => 'hours','default' => $hour, 'class'=>'sel selRegister'));?>
                            </div>
                            <div class="YearSelect">
                                <?php echo $this->Form->input('minutes',array('type'=>'select','options'=>$minutes,'label'=>false,'id' => 'minutes', 'default' => $minute,'class'=>'sel selRegister')); ?>
                            </div>
                            <div class="YearSelect">
                                <?php echo $this->Form->input('seconds',array('type'=>'select','options'=>$seconds,'label'=>false,'id' => 'seconds','default' => $second, 'class'=>'sel selRegister')); ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->hidden('UsersMetas.indexValue', array('value'=> $para));
                    echo $this->Form->hidden('UsersMetas.passSession', array('value'=> $passSession));?>
                    <div class="packet_right msButton">
                    <?php
                    echo $this->Form->submit('Submit', array('id' => 'editSession',
                            'div'  	=> false,
                            'class' 	=> 'white_btn',
                   ));
                    ?></div><?php
                    //end
                    echo $this->Form->end(); 
                    ?>
                    <div id="editError" style="margin-top:10px;"><em>(Please Select the valid Session.)</em></div>

                </div>
            </div>
        </div>
    </div>
</div>