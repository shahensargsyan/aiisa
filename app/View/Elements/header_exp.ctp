<div  class="navbar  navbar-static-top navbar-inverse" >
    <div class="navbar-inner">
        <div class="container">
            <!--<div class="navbar-inner">-->
                <?php  if(!isset($expert_id)){ ?>
                    <a class="brand" href="/">Expert</a>
                <?php }else{ ?>
                    <a class="brand" href="/experts/home">Expert</a>
                <?php } ?>
                <ul class="nav pull-right" id="parents">
                    <?php if(!isset($expert_id)){ ?>
                        <li class="<?php echo ($this->here == $this->Html->url(array('controller' => 'experts', 'action' => 'login'))) ? 'active' : ''; ?>">
                            <a href="<?php echo $this->Html->url(array('controller' => 'experts', 'action' => 'login')); ?>">
                                Sign in
                            </a>
                        </li>        
                        <?php
                    }else{
                        ?>
<!--                        <li <?php if(isset($active_menu)){if($active_menu=='SummaryPage'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'SummaryPage'));?>"> Summary Page</a>
                        </li>                    -->
                        <?php 
                        $active_class = '';
                        if(isset($active_menu)){ 
                            if($active_menu=='users' || $active_menu=='blockedIp' || $active_menu=='blockedEmails'){
                                $active_class = 'adminActiveItem';
                             }
                        }
                        
                             ?>
                        
                        <li <?php if(isset($active_menu)){if($active_menu=='home'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'home'));?>"> Home</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='edit'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'edit'));?>">Edit</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='publications'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'publications'));?>"> Publications</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='expertComments'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'expertComments'));?>"> Expert Comments</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='expertises'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'expertises'));?>">Expertises</a>
                        </li>  
                        <li <?php if(isset($active_menu)){if($active_menu=='experiences'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'experts','action'=>'experiences'));?>">Experiences</a>
                        </li>  
                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='all_contract' || $active_menu=='all_forms'){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>

                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='orders'){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>                        

                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='memberships'){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>                          

                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='categories' || $active_menu=='subcategories' || $active_menu=='pages' || $active_menu=='all_questions'
                                     || $active_menu=='law_library' || $active_menu=='all_reviews' || $active_menu=='subscription_email' || $active_menu=='user_inquires' || $active_menu == 'customPages'){
                                    
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>                            
                        
                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='languages' || $active_menu=='payemnts'
                                       || $active_menu=='logs' || $active_menu=='Info'
                                       || $active_menu=='SocialSettings' || $active_menu=='IndividualDay' ){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>     
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'experts', 'action' => 'logout')); ?>">
                                Logout
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <!--</div>-->
        </div>
    </div>
</div>