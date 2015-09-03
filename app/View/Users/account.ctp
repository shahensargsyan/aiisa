
<div class="row">
    <header class="page-content-level page-content-header">
        <div class="tabs"></div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1><?php echo $user['first_name'].' '.$user['last_name']; ?> </h1>
        </header>
        <section class="page-content-container main-content" id="main-content">
            <div class="block block-quicktabs block-quicktabs-expert-node-tabbed-content ">
                <div id="quicktabs-expert_node_tabbed_content" class="quicktabs-wrapper quicktabs-style-nostyle jquery-once-3-processed">
                    <div class="item-list" id="tabs">
        
                        <ul class="quicktabs-tabs quicktabs-style-nostyle">
                          <li><a href="#profile">Profile</a></li>
                          <li><a href="#publications">Subscribed Topics</a></li>
                          <li><a href="#expert_comment">Subscribed Regions</a></li>
                          <li><a href="#payment">Account Payment</a></li>
                        </ul>
                        <div id="profile">
                            <div id="quicktabs-container-expert_node_tabbed_content" class="quicktabs_main quicktabs-style-nostyle">
                                <div id="quicktabs-tabpage-expert_node_tabbed_content-0" class="quicktabs-tabpage">
                                    <div class="view view-expert-quicktabs-content view-id-expert_quicktabs_content view-display-id-block_4 view-dom-id-c2ae9f2e3e1e65a81094fcb60dc26747">
                                        <div class="views-row views-row-1 views-row-odd views-row-first views-row-last item-list-simple publications-rich-text">
                                        <?php if($user){ ?>
                                         <h1>Profile</h1><a href="/users/edit_profile">Edit Profile</a>
                                        <ul>
                                            <li>Name: <?php echo $user['first_name'].' '.$user['last_name']; ?></li>
                                            <li>Email: <?php echo $user['email']; ?></li>
                                            <li>Gender: <?php echo $user['gender']; ?></li>
                                            <li>Company: <?php echo $user['company']; ?></li>
                                            <li>Address: <?php echo $user['address']; ?></li>
                                            <li>City: <?php echo $user['city']; ?></li>
                                            <li>State: <?php echo $user['state']; ?></li>
                                            <li>Country: <?php echo $user['country']; ?></li>
                                            <li>Phone number: <?php echo $user['phone_number']; ?></li>
                                            <li>Mobile phone: <?php echo $user['mobile_phone']; ?></li>
                                            <li>Postal: <?php echo $user['postal']; ?></li>
                                        </ul>
                                        <?php } ?>
                                    </div>
                                </div>
                                </div>
                              </div>
                        </div>
                        <div id="payment">
                            <div id="quicktabs-container-expert_node_tabbed_content" class="quicktabs_main quicktabs-style-nostyle">
                                <div id="quicktabs-tabpage-expert_node_tabbed_content-0" class="quicktabs-tabpage">
                                    <div class="view view-expert-quicktabs-content view-id-expert_quicktabs_content view-display-id-block_4 view-dom-id-c2ae9f2e3e1e65a81094fcb60dc26747">
                                        <?php if(!$user['paid']){ ?>
                                           <form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
                                                <input type='hidden' name='sid' value='<?php echo $sid; ?>' />
                                                <input type='hidden' name='mode' value='2CO' />
                                                <input type='hidden' name='li_0_type' value='product' />
                                                <input type='hidden' name='li_0_name' value='Monthly Subscription' />
                                                <input type='hidden' name='li_0_price' value='1.00' />
                                                <input type='hidden' name='li_0_quantity' value='1' >
                                                <input type='hidden' name='li_0_tangible' value='N' >
                                                <input type='hidden' name='currency_code' value='USD' >
                                                <?php if($mode == 'demo'){ ?>
                                                    <input type='hidden' name='demo' value='Y' />
                                                <?php } ?>
                                                    <input name='submit' type='submit' class="btn" value='Pay Account' />
                                            </form>
                                        <?php }else{ ?>
                                            <h1>Your account successfully payed!</h1>
                                        <?php } ?>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div id="publications">
                            <div id="quicktabs-container-expert_node_tabbed_content" class="quicktabs_main quicktabs-style-nostyle">
                                <div id="quicktabs-tabpage-expert_node_tabbed_content-0" class="quicktabs-tabpage">
                                    <div class="view view-expert-quicktabs-content view-id-expert_quicktabs_content view-display-id-block_4 view-dom-id-c2ae9f2e3e1e65a81094fcb60dc26747">
                                        <div class="views-row views-row-1 views-row-odd views-row-first views-row-last item-list-simple publications-rich-text">
                                            <?php if(!empty($userTopics)){ ?>
                                            <h1><a href="/account/view/topic">Subscribed Topics</a></h1><a href="/users/subscribedTopics">Edit Subscribed Topics</a>
                                             <ul>
                                                 <?php if(!empty($userTopics)){ ?>
                                                     <?php foreach ($userTopics as $key => $value) { ?>
                                                     <li>
                                                        <?php echo $value['Topic']['name']; ?>
                                                     </li>
                                                     <?php } ?>
                                                 <?php } ?>
                                             </ul>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div id="expert_comment">
                              <div id="quicktabs-container-expert_node_tabbed_content" class="quicktabs_main quicktabs-style-nostyle">
                                <div id="quicktabs-tabpage-expert_node_tabbed_content-0" class="quicktabs-tabpage">
                                    <div class="view view-expert-quicktabs-content view-id-expert_quicktabs_content view-display-id-block_4 view-dom-id-c2ae9f2e3e1e65a81094fcb60dc26747">
                                        <div class="views-row views-row-1 views-row-odd views-row-first views-row-last item-list-simple publications-rich-text">
                                            <?php if(!empty($userRegions)){ ?>
                                            <h1><a href="/account/view/region">Subscribed Regions</a></h1><a href="/users/subscribedRegions">Edit Subscribed Regions</a>
                                                <ul>
                                                    <?php if(!empty($userRegions)){ ?>
                                                        <?php foreach ($userRegions as $key => $value) { ?>
                                                        <li>
                                                           <?php echo $value['Region']['name']; ?>
                                                        </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                </div>
            <div class="ds-1col node node-person view-mode-full clearfix">
                
                
            </div>
        </section>
    </section>
</div>
 <script>
    jQuery(function() {
        jQuery( "#tabs" ).tabs();
    });
</script>