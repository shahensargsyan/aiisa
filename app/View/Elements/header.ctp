<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <!-- page logo -->
                <strong class="logo"><a href="/"><img src="/img/logo.png" alt="Contracts.pw"></a></strong>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 header-content">
                <?php if($info['Info']['top_info'] == true){?>
                <?php if($this->request->isMobile){ ?>
                <span class="tel"><a href="tel:8001234567">(800) 123-4567</a></span>
                <?php }else{ ?>
                <span class="tel"><a>(800) 123-4567</a></span>
                <?php }?>
                <?php }?>
                <!-- language area style -->

                <?php
//                echo $this->Html->link('English', array('language' => 'eng'));
//
//                echo $this->Html->link('Armenian', array('language' => 'arm'));
                ?>

                <div class="languages ">  </div>
                <!--                <div class="language-area">
                                    <form action="#">
                                        <fieldset>
                                            <select>
                <?php foreach ($languages as $key => $value) { ?>
                                                        <option><?php echo $value["Language"]["name"]; ?></option>
                <?php } ?>
                                            </select>
                                        </fieldset>
                                    </form>
                                </div>-->
                <!-- btn signup style -->

                <?php
                if (!isset($u_id)) {

                    echo $this->Html->link(__('Create New Account'), array(
                        'controller' => 'users', 'action' => 'registration'
                            ), array(
                        "class" => "btn btn-sighup"
                    ));
                }
                ?>
            </div>
        </div>
        <!-- main navigation of the page -->
        <div class="nav-panel">
            <div class="col-lg-8 col-md-8 col-sm-9">
                <nav class="navigation">
                    <button type="button" class="navbar-toggle menu-opener collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul id="nav">
                            <?php foreach ($footers['top'] as $footer) { ?>
                                <li>
                                    <?php
                                    if ($footer['Footer']['type'] == 'static') {
                                        if ($footer['Footer']['url'] && $footer['Footer']['url'] != '#') {
                                            $actions = explode('/', $footer['Footer']['url']);
                                            if ($actions[1] && $actions[2]) {
                                                echo $this->Html->link(__($footer['Footer']['name']), array(
                                                    'controller' => $actions[1],
                                                    'action' => $actions[2]
                                                ));
                                            }
                                        } else {
                                            echo $this->Html->link(__($footer['Footer']['name']), array());
                                        }
                                    } else {
                                        ?>
                                        <a href="/pages/<?php
                                    echo preg_replace('/\s+/', '_', strtolower($footer['Footer']['name'])) ?>">
                                           <?php echo __($footer['Footer']['name']); ?>
                                    </a>
                                    <?php } ?>
                                </li>
                            <?php } ?>

                            <!--                            <li><a href="#">Home</a></li>
                                                        <li><a href="#">About Us</a></li>
                                                        <li class="has-dropdown">
                                                            <a class="dropdown-toggle" href="#" id="dropdownMenu1" data-toggle="dropdown">Legal Documents</a>
                                                             dropdown menu 
                                                            <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                                <ul>
                                                                    <li><a href="#">Residential Lease</a></li>
                                                                    <li><a href="#">Commercial Lease</a></li>
                                                                    <li><a href="#">Eviction Notice</a></li>
                                                                    <li><a href="#">Rent Increase Notice</a></li>
                                                                    <li><a href="#">Lease Amendment</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li class="has-dropdown"><a href="#">Law Library</a></li>
                                                        <li><a href="#">Services</a></li>-->


                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-3">
                <!-- addnav style -->
                <ul class="addnav usersOptions">
                    <?php if (isset($u_id)) { ?>
                        <li class="has-dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdownMenu1" data-toggle="dropdown"><?php echo __($userDb['User']['first_name']); ?></a>
                            <!-- dropdown menu -->
                            <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                <ul>
                                    <!--                                        <li>
                                                                                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'all_contracts')); ?>">
                                    <?php echo __('Contracts'); ?>
                                                                                </a>
                                                                            </li>-->
                                    <li>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'orders')); ?>">
                                            <?php echo __('Open orders'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'completed_orders')); ?>">
                                            <?php echo __('Completed orders'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit_profile')); ?>">
                                            <?php echo __('Edit profile'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">
                                            <?php echo __('Logout'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--                            <li>
                                                        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'all_contracts')); ?>">
                        <?php echo __('Contracts'); ?>
                                                        </a>
                                                    </li>                        -->
                            <!--                        <li class="<?php echo ($this->here == $this->Html->url(array('controller' => 'users', 'action' => 'edit_profile'))) ? 'active' : ''; ?>">
                                                        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit_profile')); ?>">
                                                            Edit Profile
                                                        </a>
                                                    </li>-->
                    <?php } ?> 
                    <?php if (!isset($u_id)) { ?>   
                        <li class="signin">
                            <?php
                            echo $this->Html->link(__('Sign In'), array(
                                'controller' => 'users', 'action' => 'login'
                            ))
                            ?>
                        </li>
                    <?php } ?>
                    <li class="help">
                        <a href="/pages/Help">
                            <?php echo __('Help'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    var ddData = <?php echo $languages; ?>;

    $('.languages').ddslick({
        data: ddData,
        width: 170,
        selectText: "Select your preferred social network",
        imagePosition: "right",
        truncateDescription: false,
        onSelected: function(selectedData){
            console.log(selectedData.selectedData.url)
            //callback function: do something with selectedData;
        }
    });
    
    $('.dd-container').addClass('language-area languageBox');
</script>