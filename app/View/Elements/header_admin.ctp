<div  class="navbar  navbar-static-top navbar-inverse" >
    <div class="navbar-inner">
        <div class="container">
            <!--<div class="navbar-inner">-->
                <?php if(!isset($admin_id)){ ?>
                    <a class="brand" href="/">Admin Login</a>
                <?php }else{ ?>
                    <!--<a class="brand" href="/admins/users">Admin Panel</a>-->
                <?php } ?>
                <ul class="nav pull-right" id="parents">  
                    <?php if(!isset($admin_id)){ ?>
                        <li class="<?php echo ($this->here == $this->Html->url(array('controller' => 'admins', 'action' => 'login'))) ? 'active' : ''; ?>">
                            <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'login')); ?>">
                                Sign in
                            </a>
                        </li>        
                        <?php
                    }else{
                        ?>
<!--                        <li <?php if(isset($active_menu)){if($active_menu=='SummaryPage'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'SummaryPage'));?>"> Summary Page</a>
                        </li>                    -->
                        <?php 
                        $active_class = '';
                        if(isset($active_menu)){ 
                            if($active_menu=='users' || $active_menu=='blockedIp' || $active_menu=='blockedEmails'){
                                $active_class = 'adminActiveItem';
                             }
                        }
                        
                             ?>
                        <li class="subMenu <?php echo $active_class; ?>"><span>Users</span>
                            <ul class="firstMenu">
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'users')); ?>">
                                        Manage Users
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'experts')); ?>">
                                        Manage Experts
                                    </a>
                                </li>
<!--                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'blockedIp')); ?>">
                                        Block IP
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'blockedEmails')); ?>">
                                        Block Email
                                    </a>
                                </li>                                    -->
                            </ul>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='regions'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'regions'));?>">Regions</a>
                        </li>  
                        <li <?php if(isset($active_menu)){if($active_menu=='databases'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'databases'));?>">Databases</a>
                        </li>  
                        
                        <li <?php if(isset($active_menu)){if($active_menu=='topics'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'topics'));?>">Topics</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='types'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'types'));?>">Publication types</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='projects'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'projects'));?>">Projects</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='eventTypes'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'eventTypes'));?>"> Event Types</a>
                        </li>  
                        <li <?php if(isset($active_menu)){if($active_menu=='events'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'events'));?>">Events</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='news'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'news'));?>">In The News</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='videos'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'videos'));?>">Videos</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='subscription_email'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'subscription_email'));?>">Subscription emails</a>
                        </li> 
                        <li <?php if(isset($active_menu)){if($active_menu=='pages'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'pages'));?>">Pages</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='sliders'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'sliders'));?>">Sliders</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='gallery'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'gallery'));?>">Gallery</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='academies'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'academies'));?>">Academies Pages</a>
                        </li>
                        <li <?php if(isset($active_menu)){if($active_menu=='libraries'){?>class="adminActiveItem"<?php }}?>>
                            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'libraries'));?>">Libraries</a>
                        </li>

                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='all_contract' || $active_menu=='all_forms'){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>
<!--                        <li class="subMenu <?php echo $active_class;?>"><span>Documents</span>
                            <ul class="firstMenu" >
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'all_contract'));?>">Manage Documents</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'all_forms'));?>">Form</a>
                                </li>                                                              
                            </ul>
                        </li>
                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='orders'){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>                        
                        <li class="<?php echo $active_class;?>">
                            <a  href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'orders')); ?>">
                                Orders
                            </a>
                        </li>
                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='memberships'){
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>                          
                        <li class="subMenu <?php echo $active_class;?>"><span>Licenses</span>
                            <ul class="firstMenu">
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'memberships')); ?>">
                                        Manage
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                            $active_class = '';
                            if(isset($active_menu)){ 
                                if($active_menu=='categories' || $active_menu=='subcategories' || $active_menu=='pages' || $active_menu=='all_questions'
                                     || $active_menu=='law_library' || $active_menu=='all_reviews' || $active_menu=='subscription_email' || $active_menu=='user_inquires' || $active_menu == 'customPages'){
                                    
                                    $active_class = 'adminActiveItem';
                                 }
                            }                        
                        ?>                            
                        <li class="subMenu <?php echo $active_class;?>"><span>Content</span>
                            <ul class="firstMenu">
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'categories')); ?>">
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'subcategories')); ?>">
                                        Sub-Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'pages')); ?>">
                                        Pages
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'all_questions')); ?>">
                                        Manage FAQ
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'law_library')); ?>">
                                        Law Library
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'all_reviews')); ?>">
                                        Reviews
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'subscription_email')); ?>">
                                        Subscription Email
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'user_inquires')); ?>">
                                        User Iinquires
                                    </a>
                                </li>                                     
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'customPages')); ?>">
                                        Custom Pages
                                    </a>
                                </li>                                     
                            </ul>
                        </li>
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
                        <li class="subMenu <?php echo $active_class;?>"><span>Settings</span>
                            <ul class="firstMenu">                                
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'languages')); ?>">
                                        Languages
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'payments')); ?>">
                                        Payments
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'logs')); ?>">
                                        Logs
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'TransactionLogs')); ?>">
                                       Transaction Logs
                                    </a>
                                </li>                                
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'Info')); ?>">
                                        Phone Settings
                                    </a>
                                </li>                                
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'SocialSettings')); ?>">
                                        Social Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'IndividualDay')); ?>">
                                        Define days
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'Chat')); ?>">
                                        Live chat
                                    </a>
                                </li>                               
                                <li>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'site_map')); ?>">
                                        Site Map
                                    </a>
                                </li>                               
                            </ul>
                        </li>                        -->
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'logout')); ?>">
                                Logout
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <!--</div>-->
        </div>
    </div>
</div>