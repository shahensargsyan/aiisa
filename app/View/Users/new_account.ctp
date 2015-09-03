
<div id="banner">
    <div id="taglines">
        <h2 class="taglineTop">Meditate With Others Around the Globe.</h2>
        <h3 class="taglineBot">Using Our Free Meditiaton Timer</h3>
    </div>
    <div class="popup dashboardPopup" id="pp">
        <?php echo $this->element('account_menu'); ?> 

        <div id="popup_right">

            <div class="popupHeader">

                <h2 class="popupH">My Account</h2>
                <div class="sepAU"></div>
                <button class="cls_button">X</button>
            </div>
            <div id="dashContent">
                <div class="maProfileStatus">
                    <h3 class="dashSubhead">Profile Status</h3>
<!--                    <div class="section-content" id="profileBox">
			<div class="profileInner">
						
                        </div>
                    </div>-->
                    <!--<form class="maMyAccoutForm">-->
                        <!--<textarea placeholder="Enter Profile Message..." class="mInput mTextarea ta maMessage"></textarea>-->
                        <?php
                            echo $this->Form->create('User',array('class' => 'maMyAccoutForm','id' => 'profileBox'));
                            echo $this->Form->textarea('Message',array('label' => false,'class'=>'mInput mTextarea ta maMessage','id'=>'enterMessage','placeholder' => 'Enter Profile Message'));
                            echo $this->Js->submit('Submit',array(
                                'id'   	 => 'messageButton',
                                'update'    => '#profileBox',
                              // 'complete'	  => 'commentSubmit();',	
                                'complete'	  =>  'blankText();',
                                'class' 	  => 'dButton fr',
                                'url'       => array('controller'=>'users', 'action' => 'profileMessage')
                            ));
                            echo $this->Form->end();
                            echo $this->Js->writeBuffer();
                        ?>
                    <!--</form>-->

                    <!--<input type="submit" value="SEND" class="dButton fr">-->
                    <div class="clearfix"></div>
                </div>

                <div class="sepAU"></div>

                <div id="mChangePassword" class="leftControls">
                    <h3 class="dashSubhead">Change Password</h3>
                    <p> <strong><a href="/users/changepassword" class="green">Click Here</a></strong> to change your password</p>
                </div>



                <div id="mNewsletter" class="rightControls">
                    <h3 class="dashSubhead">Newsletter Subscription</h3>
                <?php
		//1 for unsubscribe and 0 for subscribe
		if($status['User']['email_subscription'] == 1){
                    echo '<p>You are not Subscribe to weekly newsletter. Please <strong>'.$this->Html->link('Click Here',array('action' => 'newsletter'),array('class' => 'green')).'</strong>&nbsp;to Subscribe.</p>';
		}else{
                    echo '<p>You are Subscribe to weekly newsletter. Please <strong>'.$this->Html->link('Click Here',array('action' => 'newsletter'),array('class' => 'green')).'</strong>&nbsp;to Unsubscribe.</p>';
		}?>
                    <!--You are Subscribed to weekly newsletter. Please <strong><a href="#" class="green">Click Here</a></strong> to Unsubscribe.</p>-->
                </div>


                <div class="clearfix"></div>



                <div class="sepAU"></div>

                <div id="mStats">
                    <h3 class="dashSubhead hCenter">My Statistics</h3>
                    <div id="chart_div" style="width: 100%;height: 450px;margin: 0 auto;float:left;margin:10px 0px 0px 0px;"></div>
                    <div id="chart_div1" style="width: 100%;height: 450px;margin: 0 auto;float:left;margin:10px 0px 10px 0px;"></div>

                </div>


            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script src='https://www.google.com/jsapi'></script>
<script>
        //Function to create Days Chart
        $(document).ready(function(){
                $('#chartButton').click(function(){
                        drawChart();
                        $('#chartButton').fadeOut();	
                });
        });
        baseUrl = $('#baseurl').html();		
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function daysChart(response){
                var obj = response;
                var weeksArray = ['First','Second','Third','Fourth','Fifth','Sixth','Seventh'];
                //alert(weekArray);
                var i=0;
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Days');
                data.addColumn('number','Meditation');
                for(i=0; i < obj.length; ++i){
                        for(var ind in obj[i]) {
                                //document.write("hello");
                                //document.write(['"'+weekArray[i]+'"',obj[i][ind],''],); 
                                data.addRow([weeksArray[i], parseInt(obj[i][ind])]);
                        }
                }
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data,{title: 'Meditation',
                        hAxis: {title: 'Days', slantedText:true,  slantedTextAngle:90,titleTextStyle: {color: 'rgb(76,101,107)',fontSize: 16 }},
                        vAxis: {title: 'Minutes', titleTextStyle: {color: 'rgb(76,101,107)',fontSize: 16 }},
                        backgroundColor: '#EDEFF4',
                        legend: { position: 'right', maxLines: 3, textStyle: {color: 'rgb(76,101,107)', fontSize: 16 } },
});
                // Selects a set point on chart.
                // chart.setSelection([{row:0,column:1}]) 
                // Renders chart as PNG image 
                // chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        }
        // Function to create Weeek Charts
        // google.load("visualization", "1", {packages:["corechart"]});
        // google.setOnLoadCallback(drawChart);
        function weekChart(response,month) {
                $('#chartButton').fadeIn();
                var month = month+1;
                var obj = response;
                var weeksArray = new Array();
                var weeksArray = ['First','Second','Third','Fourth','Fifth'];
                var i=0;
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Days');
                data.addColumn('number','Meditation');
                for(i=0; i < obj.length; ++i){
                        for(var ind in obj[i]) {
                                data.addRow([weeksArray[i], parseInt(obj[i][ind])]);
                        }
                }
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data,{title: 'Meditation',
                                hAxis: {title: 'Week', titleTextStyle: {color: 'rgb(76,101,107)',fontSize: 16}},
                                vAxis: {title: 'Minutes', titleTextStyle: {color: 'rgb(76,101,107)',fontSize: 16}},
                                backgroundColor: '#EDEFF4',
                                legend: { position: 'right', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } },
});
                // Every time the table fires the "select" event, it should call your
                // selectHandler() function.
                google.visualization.events.addListener(chart, 'select', selectHandler);
                function selectHandler(e) {
                        $(".lightModalOverlay").show();
                        $(".progress_updation_my_meditation").show();
                        var selection = chart.getSelection();
                        var message = '';
                        for (var i = 0; i < selection.length; i++) {
                                var item = selection[i];
                                if (item.row != null && item.column != null) {
                                        var str = data.getFormattedValue(item.row, item.column);
                                        $.ajax({
                                                type: 'POST',
                                                url : baseUrl+'users/getDaySession',
                                                data: '{ "month" : "'+month+'","week" : "'+item.row+'" }',
                                                contentType: 'application/json; charset=utf-8',
                                                dataType: 'json',
                                                async:false,
                                                success: function (response){
                                                         $(".lightModalOverlay").hide();
                                                        $(".progress_updation_my_meditation").hide();
                                                        daysChart(response);
                                                },
                                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                        alert(errorThrown);
                                                }
                                        });
                                        message += '{row:' + item.row + ',column:' + item.column + '} = ' + str + '\n';
                                } else if (item.row != null) {
                                        var str = data.getFormattedValue(item.row, 0);
                                        message += '{row:' + item.row + ', column:none}; value (col 0) = ' + str + '\n';
                                } else if (item.column != null) {
                                        var str = data.getFormattedValue(0, item.column);
                                        message += '{row:none, column:' + item.column + '}; value (row 0) = ' + str + '\n';
                                }
                        }
                        if (message == '') {
                                message = 'nothing';
                        }
                }
        }
    // Function to create Month Chart
        // google.load("visualization", "1", {packages:["corechart"]});
        //google.setOnLoadCallback(drawChart);
        function drawChart() {
                var data = google.visualization.arrayToDataTable([
                        ['API Category', 'Meditation',{ role: 'annotation' } ],
                        <?php 
                        $i = 1;
                        foreach($monthlySession as $sess):	
                                $monthSession = (int) $sess['MonthlySession'.$i];
                                ?>
                                [<?php echo "'".$month[$i]."',".$monthSession;?>,''],
                                <?php 
                                $i++;	
                        endforeach;?>	
                ]);

                var options = {
                        width: 712,
                        height: 450,
                        title: 'Meditation Statistics',
                        vAxis: {title: 'Minutes', titleTextStyle: {color: 'rgb(76,101,107)',fontSize: 16}},
                        hAxis: {title: 'Year',slantedText:true,  slantedTextAngle:90,titleTextStyle: {color: 'rgb(76,101,107)',fontSize: 16}},
                        legend: {position: 'right', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } },
                        isStacked: true,
                        backgroundColor: '#EDEFF4',
                        opacity: 1,
                        is3D: true,
                        // Displays tooltip on selection.
                        // tooltip: { trigger: 'selection' }, 
        };
var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
chart.draw(data, options);
        // Every time the table fires the "select" event, it should call your
        // selectHandler() function.
        google.visualization.events.addListener(chart, 'select', selectHandler);
        function selectHandler(e) {
                $(".lightModalOverlay").show();
                $(".progress_updation_my_meditation").show();
                var selection = chart.getSelection();
                var message = '';
                for (var i = 0; i < selection.length; i++) {
                        var item = selection[i];
                        if (item.row != null && item.column != null) {
                                var str = data.getFormattedValue(item.row, item.column);
                                $.ajax({
                                        type: 'POST',
                                        url : baseUrl+'users/getWeekSession',
                                        data: '{ "month" : "'+item.row+'" }',
                                        contentType: 'application/json; charset=utf-8',
                                        dataType: 'Json',
                                        async:false,
                                        success: function (response){
                                                var month = item.row;
                                                var obj = response;
                                                $(".lightModalOverlay").hide();
                                                $(".progress_updation_my_meditation").hide();
                                                weekChart(response,month);
                                                //Change Chart upto Here 
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                alert(errorThrown);
                                        }
                                });
                                message += '{row:' + item.row + ',column:' + item.column + '} = ' + str + '\n';
                        } else if (item.row != null) {
                                var str = data.getFormattedValue(item.row, 0);
                                message += '{row:' + item.row + ', column:none}; value (col 0) = ' + str + '\n';
                        } else if (item.column != null) {
                                var str = data.getFormattedValue(0, item.column);
                                message += '{row:none, column:' + item.column + '}; value (row 0) = ' + str + '\n';
                        }
                }
                if (message == '') {
                        message = 'nothing';
                }
        }
}
</script>
	


<?php 
$nullValues 	 = array('null','null','null','null','null','null','null','null','null','null','null');
$undefinedValues = array('null','undefined','undefined','undefined','undefined','undefined','undefined','undefined','undefined','undefined','undefined');
$horizontalLevel = array('null','>10','10-100','100-500','500-1000','1000-2000','2000-4000','4000-6000','6000-8000','8000-10000','10000<'); 
?>
<script>
//Creating Arrays to Use in making columns
google.load("visualization", "1.1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1);
function drawChart1() {
        chartData = new google.visualization.DataTable();
        chartData.addColumn('string', 'Hours');
        for(var i=1;i<=10;i++){
                chartData.addColumn('number', 'Level '+i);
                chartData.addColumn({type:'string', role:'annotation'});
        }
        chartData.addRows([
        <?php 
        for($i=1;$i<=10;$i++){
                $nullValues[$i] = $i; 
                if($userLevel == $i){			
                        $undefinedValues[$i] = '"My Level: '.$i.'"';?> 
                        [ <?php echo '"'.$horizontalLevel[$i].'"'.','.$nullValues[1].','.$undefinedValues[1].','.$nullValues[2].','.$undefinedValues[2].','.$nullValues[3].','.$undefinedValues[3].','.$nullValues[4].','.$undefinedValues[4].','.$nullValues[5].','.$undefinedValues[5].','.$nullValues[6].','.$undefinedValues[6].','.$nullValues[7].','.$undefinedValues[7].','.$nullValues[8].','.$undefinedValues[8].','.$nullValues[9].','.$undefinedValues[9].','.$nullValues[10].','.$undefinedValues[10];?>],
                        <?php	$undefinedValues[$i] = 'undefined';
                } else {?>
                        [<?php echo '"'.$horizontalLevel[$i].'"'.','.$nullValues[1].','.$undefinedValues[1].','.$nullValues[2].','.$undefinedValues[2].','.$nullValues[3].','.$undefinedValues[3].','.$nullValues[4].','.$undefinedValues[4].','.$nullValues[5].','.$undefinedValues[5].','.$nullValues[6].','.$undefinedValues[6].','.$nullValues[7].','.$undefinedValues[7].','.$nullValues[8].','.$undefinedValues[8].','.$nullValues[9].','.$undefinedValues[9].','.$nullValues[10].','.$undefinedValues[10];?>],
                        <?php 
                }
                $nullValues[$i]	='null';
        }?>
]);
var options = {
        title: 'Levels Statistics',
        width: 712,
        height: 450,
        backgroundColor: '#EDEFF4',
        pointSize: 10,
        allowHtml:true,
        enableInteractivity:false,
        // tooltip: {trigger: none},
        annotationText: {isHtml: true,height:150},
        annotation:{bold: true},
        vAxis: {title:'Levels' ,format:"Level",minValue: 1, maxValue: 10 },
        hAxis: {title:'Hours', slantedText:true,  slantedTextAngle:90,minValue: 0, maxValue: 10 },
        pointShape: 'circle',
};
var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart.draw(chartData, options);
}	
</script>
<!--<div class="page_heading"><h1>My Account</h1></div>
	<?php if( $this->Session->check('Message.flash') ): ?>
	<div class="session-msg-holder" id="subscribe_message">
		<div class="banner-date-cont">
			<h1 id="instruction"><?php echo $this->Session->flash(); ?></h1>
		</div>
	</div>
	<?php endif; ?>
	<script type="text/javascript">hideFlash('subscribe_message');</script>
<div class="page_container">
	<div class="profile_content_post post_border">
		<div class="hidden" id="baseurl"><?php echo Router::url('/', true); ?></div>		  
		    
		------ Profile Status ------
		<div class="section-head">Profile Status</div>
		<div class="section-content" id="profileBox">
			<div class="profileInner">
				<?php 
				echo $this->Form->create('User');
				echo $this->Form->textarea('Message',array('label' => false,'class'=>'profileText','id'=>'enterMessage','placeholder' => 'Enter Profile Message'));
				echo $this->Js->submit('Submit',array('id'   	 => 'messageButton',
													  'update'    => '#profileBox',
													// 'complete'	  => 'commentSubmit();',	
													  'complete'	  =>  'blankText();',
													  'class' 	  => 'button',
													  'url'       => array('controller'=>'users', 'action' => 'profileMessage')
													));
				echo $this->Form->end();
				echo $this->Js->writeBuffer();
				?>		
    		</div>
		</div>
		
		<?php 
		if($status['User']['fb_id'] != '-' || $status['User']['tweet_id'] != '-'):
			?>
			<div id="auto-updates" style = 'margin: 10px 0 0 12px;width:100%;'>
				<?php echo $this->Form->create('User');?>
				<div class="setUpdate" style="font-weight:bold;margin:12px 0px 11px 0px;">Set Automatic Updates</div>
				<?php 
				if($status['User']['fb_id'] != '-'):
					$boolValue =($status['User']['fbStatus'] == 1)?true:false;
					echo '<div class="" style="margin-bottom:5px;">';
					echo $this->Form->input('Facebook',array('type' => 'checkbox','label' => false, 'checked' => $boolValue,'style' =>'float:left;margin-right:20px;margin-top:4px;','class' =>'updateCheckbox'));
					echo '<span>'.$this->Form->label('fb','Turn on Automatic Updates to Facebook.').'</span>';
					echo '</div>';
				endif;
				if($status['User']['tweet_id']!='-'):
					$boolValue =($status['User']['tweetStatus'] == 1)?true:false;
					echo '<div class="" style="margin-bottom:5px;">';
					echo $this->Form->input('Twitter',array('type' => 'checkbox','label' => false,'checked' => $boolValue,'value' => $status['User']['tweetStatus'], 'style' =>'float:left;margin-right:20px;margin-top:4px;','class' =>'updateCheckbox'));
					echo '<span>'.$this->Form->label('tweet','Turn on Automatic Updates to Twitter.').'</span>';
					echo '</div>';
				endif;	?>
				<div style="margin:16px 0px 6px 2px;">
			  		<?php	
					echo $this->Js->submit('Submit',array('id'		=> 'statusButton',
														  'update'  => '#auto-updates',
														  'class' 	=> 'button',
														  'url'     => array('controller'=>'Users', 'action' => 'submitStatus')
															));
					echo $this->Js->writeBuffer();
					echo $this->Form->end();									
					echo '</div>';?>
				</div>
			</div>	
		<?php endif; ?>

		<div style="padding:20px 0 10px;" class="markline"><div class="staticcontrol"><div class="hrcenter-white"></div></div></div>
	    ------ END @ Profile Status ------
		
		------ Change Password ------
		<div class="section-head">Change Password</div>
		<div class="section-content">
			<?php echo $this->Html->link('Click Here',array('action' => 'changepassword')).'&nbsp;to change your password';?>
		</div>	
		<div style="padding:20px 0 10px;" class="markline"><div class="staticcontrol"><div class="hrcenter-white"></div></div></div>
	    ------ END @ Change Password ------
		
		------ Newsletter Subscription ------
		<div class="section-head">Newsletter Subscription</div>
		<div class="section-content">
		<?php $subscription= $status['User']['email_subscription']; 
		//1 for unsubscribe and 0 for subscribe
		if($subscription==1)
		{
		echo 'You are not Subscribe to weekly newsletter. Please '.$this->Html->link('Click Here',array('action' => 'newsletter')).'&nbsp;to Subscribe.';
		}
		else
		{
		echo 'You are Subscribe to weekly newsletter. Please '.$this->Html->link('Click Here',array('action' => 'newsletter')).'&nbsp;to Unsubscribe.';
		}
		?>
		</div>	
		<div style="padding:20px 0 10px;" class="markline"><div class="staticcontrol"><div class="hrcenter-white"></div></div></div>
	    ------ END @ Newsletter Subscription ------
			
		------ My Statistics ------
		<div class="section-head">My Statistics</div>
		<div class="link" id="chartButton"><< Back</div>
	
		-- First Chart	
		
		-- END @ Second Chart	
		
		<div class="section-content">
			
		</div>
		------ END @ My Statistics ------
	</div>
</div>-->
        