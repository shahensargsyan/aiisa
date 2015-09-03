
<h3 class="subhead">Last Meditating Sessions</h3>
<?php 
if(!empty($meditation)){?>
    <div id="meTable">
    <table>
        <thead>
        <?php 
        foreach($meditation as $days){
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
    echo $this->Js->writeBuffer();
    ?>
    <!--Pagination End-->
    </div>
<?php } else {
    echo "You have 0 Meditations"; 
}



