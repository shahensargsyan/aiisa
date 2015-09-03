<div class="popup_2_container StartPopup" id="" style="display:none;">
<?php if(!empty($userMeta['Usersmeta']['setsessions'])){     ?>

        <div class="popupHeader">
            <h2 class="popupH timerH">How Long Would You Like To Meditate For?</h2>
            <p class="center"><a href="/users/mymeditation" class="green aboutUsLink">... Or create a new custom time </a></p>
            <button id="back_to_popup1"  class="cls_button"></button>
        </div>
        <?php
        $userSession = explode(',',str_replace('{','',str_replace('}','',$userMeta['Usersmeta']['setsessions']))); 
        $totalUserSession = count($userSession);
        if($totalUserSession >=1){
            $bigCount = 0;
            for($i=0;$i<$totalUserSession;$i++){
                $explode_session = explode(':',str_replace("'",'',$userSession[$i]));
                $userSessionValue = $explode_session[1].':'.$explode_session[2].':'.$explode_session[3];
                $convertMinutes   = $explode_session[1]*60 + $explode_session[2] + floor($explode_session[3]/60);
                $setSpan		  = ($convertMinutes == 0)?'secs':'mins';	
                $convertMinutes	  = ($convertMinutes == 0)?$explode_session[3]:$convertMinutes;
               if(strlen($convertMinutes)>=4){
                   $bigCount++;
               }
            }
        }
        ?>
        <div class="sepAU"></div>
        <div id="stTiles" class="custom-timers">
            <div id="content_container">
                <div id="content">
                    <?php 
                    
                    if($totalUserSession >=1){
                        for($i=0;$i<$totalUserSession;$i++){
                            $explode_session = explode(':',str_replace("'",'',$userSession[$i]));
                            $userSessionValue = $explode_session[1].':'.$explode_session[2].':'.$explode_session[3];
                            $convertMinutes   = $explode_session[1]*60 + $explode_session[2] + floor($explode_session[3]/60);
                            $setSpan		  = ($convertMinutes == 0)?'secs':'mins';	
                            $convertMinutes	  = ($convertMinutes == 0)?$explode_session[3]:$convertMinutes;?>
                                    
                            <a href="#" class="setSession smTile"  data-medmin="<?php echo $convertMinutes; ?>" value="<?php echo $userSessionValue?>">
                                <div class="smMin <?php echo ($bigCount>=2)?'smMinBig':''; ?>"><?php echo $convertMinutes;?></span>
                                    <div class="smTit">MIN</span>
                                    </div>
                                </div>
                            </a>
                        <?php }
                    }?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
<?php } else { ?>

            <div class="popupHeader">
                <h2 class="popupH timerH">How Long Would You Like To Meditate For?</h2>
                <button  id="back_to_popup1" class="cls_button">X</button>
            </div>
            <div class="sepAU"></div>
            <div id="stTilesDefault">


                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[0]?>"  data-medmin="<?php echo $userDefaultSession[0]?>" value="<?php echo $defaultSession[0]?>"> 
                    <div class="smTile">
                        <div class="smMin"><?php echo $userDefaultSession[0];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[1]?>"  data-medmin="<?php echo $userDefaultSession[1]?>" value="<?php echo $defaultSession[1]?>"> 
                    <div class="smTile">
                        <div class="smMin"><?php echo $userDefaultSession[1];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[2]?>"  data-medmin="<?php echo $userDefaultSession[2]?>" value="<?php echo $defaultSession[2]?>"> 
                    <div class="smTile">
                        <div class="smMin"><?php echo $userDefaultSession[2];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[3]?>"  data-medmin="<?php echo $userDefaultSession[3]?>" value="<?php echo $defaultSession[3]?>"> 
                    <div class="smTile">
                        <div class="smMin"><?php echo $userDefaultSession[3];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[4]?>"  data-medmin="<?php echo $userDefaultSession[4]?>" value="<?php echo $defaultSession[4]?>"> 
                    <div class="smTile">
                        <div class="smMin"><?php echo $userDefaultSession[4];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[5]?>"  data-medmin="<?php echo $userDefaultSession[5]?>" value="<?php echo $defaultSession[5]?>"> 
                    <div class="smTile">
                        <div class="smMin"><?php echo $userDefaultSession[5];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="setSession setFBMIN<?php echo $userDefaultSession[6]?>"  data-medmin="<?php echo $userDefaultSession[6]?>" value="<?php echo $defaultSession[6]?>"> 
                    <div class="smTileLast">
                        <div class="smMin"><?php echo $userDefaultSession[6];?></span>
                            <div class="smTit">MIN</span>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="clear"></div>
        </div>
<?php }?>
</div>
