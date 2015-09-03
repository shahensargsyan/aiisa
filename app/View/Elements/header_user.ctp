<header class="page-level page-header">
    <div class="logo">
        <a href="/" title="Home" id="site-name">AIISA</a>
    </div>
    <div class="languages">
    	<a href="#"><img src="http://aiisa.am/css/chatem/images/arm.jpg" width="20" height="13"></a>
        <a href="#"><img src="http://aiisa.am/css/chatem/images/british-flag.jpg" width="20" height="13"></a>
        <a href="#"><img src="http://aiisa.am/css/chatem/images/RussianFlag.gif" width="20" height="13"></a>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="primary-navigation sticky">
            	
                <ul class="">

                    <div class="block block-block block-block-16 ">
                        <li class="top-link">
                            <a href="#" class="main-nav-link">Top <i class="fa fa-angle-up"></i></a>
                        </li>

                    </div>

                    <div class="block block-block block-block-17 ">
                        <ul>
                            <li>
                                <a class="main-nav-link">Research <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown">
                                    <div class="dropdown-inner dropdown-research">

                                        <div>
                                            <h2>Topics</h2>

                                            <ul class="dropdown-list">
                                                <?php foreach ($allTopics as $key => $value) { ?>
                                                    <li>
                                                        <a href="/research/view/topic/<?php echo $key; ?>"><?php echo $value; ?></a>
                                                    </li>

                                                <?php } ?>


                                            </ul>
                                        </div>
                                        <div>
                                            <h2>Regions</h2>
                                            <ul class="dropdown-list">
                                                <?php foreach ($allRegions as $key => $value) { ?>
                                                    <li>
                                                        <a href="/research/view/region/<?php echo $key ?>"><?php echo $value; ?></a>
                                                    </li>

                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div>
                                            <h2>Publications</h2>
                                            <ul class="dropdown-list">
                                                <li>
                                                    <a href="/ourexperts/publications">View all publications</a>
                                                </li>
                                                <?php if(!empty($footers['publication'])){  ?>
                                                    <?php foreach ($footers['publication'] as $footer) { ?>
                                                        <li><a href="/pages/<?php
                                                            echo preg_replace('/\s+/', '_', strtolower($footer['Footer']['name'])) ?>">
                                                           <?php echo __($footer['Footer']['name']); ?>
                                                    </a></li>
                                                    <?php } ?>
                                                <?php } ?>
<!--                                                <li>
                                                    <a href="/publications/twt">The World Today </a>
                                                </li>
                                                <li>
                                                    <a href="/publications/ia">International Affairs</a>
                                                </li>-->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="block block-block block-block-18 ">
                        <li class="">
                            <a href="/ourexperts/" class="main-nav-link">Experts <i class="fa fa-angle-down"></i></a>

                            <div class="dropdown" style="margin-left: 0px;">
                                <div class="dropdown-inner dropdown-wide">
                                    <ul class="dropdown-list">	
                                        <li><a href="/ourexperts/comments">Expert comment</a></li>
                                        <li><a href="/ourexperts/InTheNews">In the news</a></li>
                                        <li><a href="/ourexperts/index">Our experts</a></li>
                                    </ul>	
                                    <?php if (!empty($lastExCom)){ ?>
                                 
                                    <a href="/ourexperts/comment/<?php echo $lastExCom['ExpertComment']['id']; ?>" class="expert-comment mobile-menu-hide">
                                        <div class="expert-comment-text">
                                            <p class="label">Expert comment | <?php echo $lastExCom['Expert']['first_name'].' '.$lastExCom['Expert']['last_name']; ?> </p>
                                            <p class=""><?php echo $lastExCom['ExpertComment']['title']; ?></p>
                                            <p class="small-body-text"><?php echo substr($lastExCom['ExpertComment']['intro_text'], 0,150); ?></p>
                                            <span class="date"><?php echo date("D d M",  strtotime($lastExCom['ExpertComment']['created']));?>Fri 20 Feb</span>
                                        </div>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>

                        </li>
                    </div>

                    <div class="block block-block block-block-19 ">
                        <li>
                            <a href="/events/" class="main-nav-link">Events <i class="fa fa-angle-down"></i></a>

                            <div class="dropdown">
                                <div class="dropdown-inner dropdown-wide">
                                    <?php if(!empty($eventTypes)){ ?>
                                    <ul class="dropdown-list">	
                                        <?php foreach ($eventTypes as $key => $value) { ?>

                                        <li>
                                            <a href="/events/index/<?php echo $key; ?>">
                                                <?php echo $value; ?>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>	
                                    <?php } ?>
                                    <?php if(!empty($lastEvent)){ ?>
                                    <div class="view view-events view-id-events view-display-id-block_3 event-block livestream mobile-menu-hide view-dom-id-4800027c1b9b116a15cbf2b838fbe701">
                                        <div class="views-row views-row-1 views-row-odd views-row-first views-row-last">
                                            <div onclick="location.href = 'events/event/'" class="ds-2col node node-event livestream view-mode-header_block_teaser clearfix">
                                                <div class="group-left">
                                                    <div class="field field-name-field-event-date">
                                                        <div class="date-calendardate date-calendardate-date-square">
                                                            <p class="date-calendardate-day"><?php echo date("d",strtotime($lastEvent['Event']['event_date']));?></p>
                                                            <p class="date-calendardate-month"><?php echo date("M",strtotime($lastEvent['Event']['event_date']));?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-right">
                                                    <p class="label"> 
                                                        <i class="fa fa-play-circle-o fa-lg"></i> Next Livestream</p>
                                                    <div class="field field-name-title">
                                                        <p class="title">
                                                            <?php echo $lastEvent['Event']['title']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="date">
                                                        <time datetime="<?php echo date("d M Y",  strtotime($lastEvent['Event']['event_date']));?>">
                                                            <?php echo date("d M Y",  strtotime($lastEvent['Event']['event_date']));?> - 
                                                            <span class="date-display-start"><?php echo $lastEvent['Event']['from_time']; ?></span> to 
                                                            <span class="date-display-end"><?php echo $lastEvent['Event']['to_time']; ?></span>
                                                        </time>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php } ?>
                                </div>
                            </div>

                        </li>
                    </div>
                    <?php if(!isset($userDb)){ ?>
<!--                    <li class="membership">
                        <a href="#http://www.chathamhouse.org/become-member" class="main-nav-link">Membership <i class="fa fa-angle-down"></i></a>
                        <div class="dropdown">
                            <div class="dropdown-inner dropdown-wide-or-narrow dropdown-wide">
                                <div class="login mobile-menu-hide">
                                    <h2>Members login</h2>
                                    <p class="small-body-text">If you have already registered...</p>
                                    <div class="block block-ch-members block-ch-members-ch-members-membership-dropdown ">

                                        <form action="https://www.chathamhouse.org/about-us/directory/70658?destination=node/3648" method="post" id="user-login-form" accept-charset="UTF-8" role="form">
                                            <?php
                                            echo $this->Form->create(
                                                    'User', array(
                                                        'inputDefaults' => array(
                                                            'label' => false
                                                        ),
                                                        'url' => array('controller' => 'users','action' => 'login'),
                                                        'id' => "user-login"
                                                    )
                                                );
                                            ?>
                                            <div class="form-required">
                                                <input  type="text" id="edit-name" name="name" required="" autocomplete="off">
                                                <?php
                                                echo $this->Form->input(
                                                        'email', array(
                                                            'label' => FALSE,
                                                            'div' => false,
                                                            'class' => 'form-control',
                                                            'size' => "30",
                                                            'maxlength' => "60",
                                                            'autocomplete' => "off",
                                                            'placeholder' => __("Enter your email address"),
                                                            'required' => TRUE
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="form-required">
                                                <input placeholder="Enter your password" type="password" id="edit-pass" name="pass" size="30" maxlength="128" autocomplete="off">
                                                <?php
                                                echo $this->Form->input(
                                                        'password', array(
                                                            'type' => 'password',
                                                            'label' => __('Password') . '*',
                                                            'div' => false,
                                                            'size' => "30",
                                                            'maxlength' => "128",
                                                            'autocomplete' => "off"
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <input type="hidden" name="form_build_id" value="form-osVGlWwp0LRWVMNiMe90ZHGHq4LBQzgqNOm2SwG0SYQ" autocomplete="off">
                                            <input type="hidden" name="form_id" value="user_login_block" autocomplete="off">
                                            <div class="form-actions form-wrapper" id="edit-actions">
                                                <input class="button" type="submit" id="edit-submit" name="op" value="Login" autocomplete="off">
                                                <?php
                                                echo $this->Form->input(
                                                        __('Login'), array(
                                                            'type' => 'submit',
                                                            'div' => false,
                                                            'id' => "edit-submit"
                                                        )
                                                );
                                                ?>


                                            </div>
                                        <?php
                                            echo $this->Form->end();
                                        ?>
                                    </div>
                                </div>
                                <a href="/users/registration" class="join mobile-menu-hide"><p>
                                    <i class="fa fa-user fa-3x"></i></p>
                                    <h2>Want to become a member? <i class="fa fa-angle-right fa-lg"></i></h2>
                                    <p class="small-body-text">Find out more about joining AIISA.</p>
                                    <input class="button" type="submit" value="Join now!" autocomplete="off">
                                </a>
                            </div>
                        </div>
                    </li>-->
                    <?php } ?>
                    <div class="block block-block block-block-21 ">
                        <li>
                            <a href="#" class="main-nav-link">Leadership Academy<i class="fa fa-angle-down"></i></a>	

                            <div class="dropdown">
                                <div class="dropdown-inner dropdown-narrow">
                                    <ul class="dropdown-list">
                                        <?php if(!empty($academies)){  ?>
                                            <?php foreach ($academies as $a) { ?>
                                                <li><a href="/academy/<?php
                                                    echo preg_replace('/\s+/', '_', strtolower($a['Academy']['name'])) ?>">
                                                   <?php echo __($a['Academy']['name']); ?>
                                            </a></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>	
                                </div>
                            </div>

                        </li>
                    </div>
                    <div class="block block-block block-block-21 ">
                        <li>
                            <a href="#" class="main-nav-link">Projects <i class="fa fa-angle-down"></i></a>	

                            <div class="dropdown">
                                <div class="dropdown-inner dropdown-narrow">
                                    <?php if(!empty($projecrs)){ ?>
                                        <ul class="dropdown-list">
                                            <?php foreach ($projecrs as $key => $value) { ?>
                                            <li><a href="/research/view/project/<?php echo $key; ?>"><?php echo $value; ?></a></li>
                                        <?php } ?>
                                        </ul>	
                                    <?php }?>
                                </div>
                            </div>

                        </li>
                    </div>
                    <div class="block block-block block-block-21 ">
                        <li>
                            <a href="#" class="main-nav-link">Multimedia <i class="fa fa-angle-down"></i></a>
                            <div class="dropdown" style="margin-left: 0px;">
                                <div class="dropdown-inner dropdown-wide">
                                    <ul class="dropdown-list">	
                                        <li class=""><a href="/research/multimedia">Video Gallery</a></li>
                                        <li class=""><a href="/research/gallery">Photo Albums</a></li>
                                    </ul>	
                                    <h2>Latest video: <?php echo $lastVideo['Video']['content']; ?></h2>
                                    <iframe width="320" height="215" src="<?php echo $lastVideo['Video']['link'] ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>        

            <div class="block block-block secondary-navigation block-block-2 ">
            	<h2 class="top_title">
                	The Armenian Institute of International and Security Affairs<br>
                	<span><strong>Security through knowledge of power and power of knowledge</strong></span>
                </h2>
                <ul>
                    <?php if(!empty($footers['top'])){  ?>
                        <?php foreach ($footers['top'] as $footer) { ?>
                            <li><a href="/pages/<?php
                                echo preg_replace('/\s+/', '_', strtolower($footer['Footer']['name'])) ?>">
                               <?php echo __($footer['Footer']['name']); ?>
                        </a></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if(isset($userDb)){ ?>
                        <li><a href="/users/account">Account</a></li>
                    <?php } ?>
                    <li>
                        <?php if(!isset($userDb)){ ?>
                            <a href="/users/login"><i class="fa fa-user"></i>Members login</a>
                        <?php }else{ ?>
                            <a href="/users/logout"><i class="fa fa-user"></i>Logout</a>
                        <?php } ?>
                    </li>
                    <li>
                    	<div class="mobile-languages">
                        	<a href="#"><img src="http://aiisa.am/css/chatem/images/arm.jpg" width="20" height="13"></a>
                            <a href="#"><img src="http://aiisa.am/css/chatem/images/british-flag.jpg" width="20" height="13"></a>
                            <a href="#"><img src="http://aiisa.am/css/chatem/images/RussianFlag.gif" width="20" height="13"></a>
                    	</div>
                    </li>
                </ul>
            </div>

            <div class="block block-search search block-search-form sticky" role="search">


                    <?php
                    echo $this->Form->Create(
                        'Search', array(
                            'url' => array(
                                'controller' => 'contents',
                                'action' => 'search'
                            ),
                            'inputDefaults' => array(
                                'div' => false
                            ),
                        'class' => 'recPassForm',
                        'id' => "search-block-form"
                        )
                    );
                    ?>
                    <h2 class="element-invisible">Search form</h2>

                    <div>
                        <label class="element-invisible" for="edit-search-block-form--2">Search</label>
                        <?php
                        echo $this->Form->input(
                            'term', array(
                                'type' => 'text',
                                'label' => FALSE,
                                'class' => 'apachesolr-autocomplete unprocessed form-autocomplete',
                                'placeholder' => "Search AIISA",
                                'title' => "Enter the terms you wish to search for.",
                                'size' => "30",
                                'maxlength' => "128",
                                'autocomplete' => "off"
                            )
                        );
                        ?>
                    </div>
                    <div class="form-actions form-wrapper" id="edit-actions--2">
                        <?php
                            echo $this->Form->input(
                                'Search', array(
                                    'type' => 'submit',
                                    'label' => false,
                                    'div' => false,
                                    'class' => 'btn'
                                ));
                        ?>       
                    </div>
                 <?php echo $this->Form->end(); ?>       
            </div>
        </div>
    </div>
</header>
