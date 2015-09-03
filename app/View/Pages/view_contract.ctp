<script src="/js/jquery.mCustomScrollbar.js"></script>
<link type="text/css" rel="stylesheet" href="/css/jquery.mCustomScrollbar.css"/>
<script>
    (function($) {
        $(window).load(function() {
            $(".oneContract").mCustomScrollbar();
        });
    })(jQuery);
</script>

<section class="visual">
    <div class="visual-holder">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7 content-box">                
                <!-- tab content style -->
                <div class="tab-content">
                    <div id="tab1" class="tab">
                        <header> <?php echo $data['Contract']['name'] ?></header>
                        <div class="tab-holder oneContract">
                            <div class="frame">
<!--                                <div class="icon">
                                    <div class="box">
                                        <div class="holder">
                                            <?php echo $this->Html->image('/system/contracts/' . $data['Contract']['contract_image']) ?>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="textbox">
                                    <!--<p>-->
                                        <a data-toggle="modal" data-target="#viewContract">
                                            <img src="/system/contracts/<?php echo $data['Contract']['contract_image']?>" title="View the contract" />
                                            <img src="/img/zoom_in_.png" class="zoomIcon" />
                                        </a>
                                        <?php echo $data['Contract']['description'] ?>
                                    <!--</p>-->
                                </div>
                            </div>
<!--z                            <div class="footer">
                                <span class="price">
                                    Only <strong>AED
                                        <em>
                                            <?php
//                                            $price = explode('.', $data['Contract']['price']);
//                                            echo $price[0];
//                                            ?><sup><?php //echo '.' . $price[1]; ?></sup>
                                        </em>
                                    </strong>(one time) fee
                                </span>                                
                            </div>-->
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-3">
                <div class="contractDescsBox panel panel-default">
                    <div class="panel-heading">Start Customizing Your <?php echo $data['Contract']['name'] ?></div>
                    <div class="panel-body">
                        <div class="rightContHeight">
                            <ul>
                            <?php if(!empty($data['Contract']["highlights"])){ ?>
                                <?php foreach(explode(',', $data['Contract']["highlights"]) as $key => $value){ ?>
                                    <li><?php echo $value; ?></li>
                                <?php } ?>
                            <?php } ?>
                            </ul>
                            <?php if($contract_price){?>
                            <div class="footer">
                                <span class="price">
                                    <?php if($contract_price['Membership']['individual_price'] != 0.00){?>
                                    Only <strong>AED
                                        <em>
                                            <?php $price = explode('.', $contract_price['Membership']['individual_price']);
                                                echo $price[0];
                                            ?><sup><?php echo '.' . $price[1]; ?></sup>
                                        </em>
                                    </strong>(one time) fee
                                </span>                                
                            </div>
                            <?php }else{?>
                            <span class="freePrice">Free</span>
                            <?php }} ?>
                        </div>
                        <?php echo $this->Html->link(__('Start Customization'), array(
                            'controller' => 'contracts',
                            'action' => 'fill_information',
                            preg_replace('/\s+/', '_', strtolower($data['Contract']['name']))
                                ), array(
                            "class" => "btn"
                        ));
                        ?>
                    </div>                                    
                </div>
            </div>
        </div>
</section>
<!-- procedure style -->
<section class="procedure">
    <h1>How it works</h1>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <ul>
                <li>
                    <span class="arrow">arrow</span>
                    <p>
                        <strong>1</strong>
                        <span>Complete our simple questionnaire</span>
                    </p>
                    <div class="icon">
                        <div class="box">
                            <div class="holder">
                                <img src="/img/icon12.png" alt="image description">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <span class="arrow">arrow</span>
                    <p>
                        <strong>2</strong>
                        <span>Preview your Agreement and select your package</span>
                    </p>
                    <div class="icon">
                        <div class="box">
                            <div class="holder">
                                <img src="/img/icon13.png" alt="image description">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="add">
                    <p>
                        <strong>3</strong>
                        <span>Download save and print your ready agreement</span>
                    </p>
                    <div class="icon">
                        <div class="box">
                            <div class="holder">
                                <img src="/img/icon14.png" alt="image description">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="textbox">
                <p>How it works pleasure working with <strong>contracts.pw</strong> Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
            </div>
            <div class="textbox">
                <p>Aenean sollicitudin, lorem quis <strong>bibendum auctor</strong>, nisi elit consequat ipsum, nec sagittis sem nibh id elit. </p>
            </div>
            <div class="textbox">
                <p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. <strong>Morbi accumsan</strong> ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. </p>
            </div>
        </div>
    </div>
</section>




<!--questions section-->
<section class="conractQuestBox">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="whyChooseCont">
                <h5>Why Choose Contracts.pw?</h5>
                <ul>
                    <li>Professional lease agreement </li>
                    <li>Fully compliant with laws </li>
                    <li>Takes just minutes to create</li>
                </ul>
            </div>
<!--            <div class="reviewsBox top10">
                <?php
//                if(isset($reviews)){
//                    foreach($reviews as $key => $value){
                        ?>
                        <div>
                            <p>
                                <?php
//                                if(strlen($value['Review']['review']) > 55){
//                                    echo substr($value['Review']['review'], 0, 100);
//                                }else{
//                                    echo $value['Review']['review'];
//                                }
                                ?>
                            </p>
                            <p>~ <?php // echo $value['Review']['first_name'] . ' ' . $value['Review']['last_name']; ?></p>
                        </div> 
                        <?php
//                    }
//                }
                ?>
            </div>-->
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 commonQuestRight">
            <div class="commonQuestions">
                <h5> <?php echo __('Common Questions'); ?></h5>
                <?php
                if(isset($questions) && $questions){
                    foreach($questions as $key => $value){
                        ?>
                        <div>
                            <a data-toggle="modal" data-target="#questionModal<?php echo $value['Question']['id']; ?>">
                            <?php echo $value['Question']['question']; ?>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="testimonials padTop40">
    <h1><strong><span>arrow</span>SEE WHAT OUR CUSTOMERS ARE SAYING</strong></h1>
    <div class="row"> <!--reviewsBox-->
        <?php
        if(isset($reviews)){
            foreach($reviews as $key => $value){
                ?>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <blockquote>
                        <q>
                            <?php
                            if(strlen($value['Review']['review']) > 55){
                                echo substr($value['Review']['review'], 0, 100);
                            }else{
                                echo $value['Review']['review'];
                            }
                            ?>
                        </q>
                        <cite>
                            <span class="name">
                                <?php echo $value['Review']['first_name'] . ' ' . $value['Review']['last_name']; ?>
                            </span>                            
                        </cite>
                    </blockquote>
                </div> 
                <?php
            }
        }
        ?>
    </div>
</section>
<?php
if(isset($questions) && $questions){
    foreach($questions as $key => $value){
        ?>
        <div class="modal fade questionAnswerBox" id="questionModal<?php echo $value['Question']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><!--<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>--></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $value['Question']['question']; ?></h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <?php echo $value['Question']['answer']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<!-- documents style -->
<section class="documents">
    <h1>LEGAL DOCUMENTS - <span>COMING SOON...</span></h1>
    <div class="row">
        <?php foreach ($category_contract as $category){?>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="box">
                <header><?php echo __($category['Category']['name']); ?></header>
                <ul>
                    <?php
                        $contract_name = explode(',', $category[0]['name']);
                        $contract_id = explode(',', $category[0]['id']);
                        $i = 0;
                        while (isset($contract_name[$i])) {
                    ?> 
                    <li>
                        <a href="<?php echo $this->Html->url(array(
                                'controller' =>'pages',
                                'action' => 'view_contract',
                                $contract_id[$i]
                            )); ?>"> <?php echo __($contract_name[$i]) ?>
                        </a>                        
                    </li><?php $i++;}?>                  
                </ul>
            </div>
        </div>
        <?php }?>
    </div>
    <strong class="subhead">Do you have any questions?</strong>
    <strong class="text">Contact our <a href="#">Live Support!</a></strong>
</section>

<div class="modal fade viewContractPopup" id="viewContract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="contractImgBox">
                    <img src="/system/contracts/<?php echo $data['Contract']['contract_image']?>">
                </div>
            </div>
        </div>
    </div>
</div>