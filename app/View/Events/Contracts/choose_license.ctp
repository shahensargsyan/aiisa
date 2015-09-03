<!--<a class="chooseTextColorBtn fancybox" href="#payment_type" id="buyButton">Buy</a>-->
<section class="steps-area">
    <h1><?php echo __($contract['name']); ?></h1>
    <?php echo $this->element('document_menu'); ?>

    <div class="block paymentBox">
        <div class="text-block">       
            <div class="textbox">     
                <div class="text">
                    <span class="ico-help">?</span>
                    <h2>Choose License</h2>
                </div>
                <div class="payOptionsBox">
                    <?php
                    if(!is_null($memberships)){
                        foreach ($memberships as $key => $value) { ?> 
                            <div class="col-md-5 col-sm-5 col-lg-5">
                                <div class="licenseBox">
                                    <div class="licenseTop">
                                        <?php if($value["Membership"]['type'] == 'package'){  ?>
                                            <h4><?php echo $value ["Membership"]["name"]; ?></h4>
                                            <div class="priceMonthFlds">
                                                <?php if((int)$value["Membership"]["month_price"] != 0){?>
                                                <span class="showPrice">$<?php echo $value ["Membership"]["month_price"]; ?></span>
                                                <span class="showMonth"><?php // echo $value ["Membership"]["month_count"]; ?>/ per month</span>
                                                <?php }else{ ?>
                                                    <span class="showPrice">FREE</span>
                                                <?php } ?>
                                            </div>

                                        <?php }else{ ?>
                                            <h4><?php echo $value ["Membership"]["name"]; ?></h4>
                                            <div class="priceMonthFlds">
                                                <?php if((int)$value["Membership"]["individual_price"] != 0){?>
                                                <span class="showPrice">$<?php echo $value ["Membership"]["individual_price"]; ?></span>
                                                <?php }else{ ?>
                                                   <span class="showPrice">FREE</span>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                            <a class="btn" href="/contracts/pay/<?php echo $id; ?>/<?php echo $value["Membership"]['id']; ?>">Select</a> 
                                    </div>
                                    <?php if($value ["Membership"]["description"]){?>
                                        <div class="licenseText">                        
                                            <?php echo $value ["Membership"]["description"]; ?>                                       
                                        </div>
                                    <?php } ?>
                                    <?php if($value ["Membership"]["description"]){?>
                                        <div class="licenseText">                        
                                            <?php echo $value ["Membership"]["description2"]; ?>                          
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>        
                </div>
            </div>
        </div>
    </div>
</section>