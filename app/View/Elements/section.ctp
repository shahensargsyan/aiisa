<section class="page-content-level column page-content-sidebar-second" id="page-content-sidebar-second">
    
    <?php switch ($controller) {
     case 'pages':?>
        <div class="block block-block sub-nav block-block-27 ">
            <h2>Related Pagess </h2>
            <ul>
                <?php if(!empty($submenus)){  ?>
                    <?php foreach ($submenus as $a) { ?>
                        <li><a href="/pages/<?php
                            echo preg_replace('/\s+/', '_', strtolower($a['Footer']['name'])) ?>">
                           <?php echo __($a['Footer']['name']); ?>
                            <em class="fa fa-angle-right"> </em>
                    </a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <?php break;
     case 'academy':?>
        <div class="block block-block sub-nav block-block-27 ">
        <h2>Expert School </h2>
        <ul>
            <?php if(!empty($academies)){  ?>
                <?php foreach ($academies as $a) { ?>
                    <li><a href="/academy/<?php
                        echo preg_replace('/\s+/', '_', strtolower($a['Academy']['name'])) ?>">
                       <?php echo __($a['Academy']['name']); ?>
                        <em class="fa fa-angle-right"> </em>
                </a></li>
                <?php } ?>
            <?php } ?>
        </ul>
        </div>

        <?php break;
     case 'events':?>
        <div class="block block-block sub-nav block-block-27 ">
        <h2>Events</h2>
        <ul>
            <?php if(!empty($eventTypes)){ ?>
            <ul>	
                <?php foreach ($eventTypes as $key => $value) { ?>

                <li>
                    <a href="/events/index/<?php echo $key; ?>">
                        <?php echo $value; ?>
                         <em class="fa fa-angle-right"> </em>
                    </a>
                </li>
                <?php } ?>
            </ul>	
            <?php } ?>
        </ul>
        </div>

        <?php break;
     case 'research':?>
    <?php
    
    if(isset($this->params->params['pass'][0])){
        switch ($this->params->params['pass'][0]) {
            case 'topic':?>
                <div class="block block-block sub-nav block-block-27 ">
                    <h2>Topics</h2>
                    <ul>
                        <?php if(!empty($allTopics)){ ?>
                        <ul>	
                            <?php foreach ($allTopics as $key => $value) { ?>
                            <li>
                                <a href="/research/view/topic/<?php echo $key; ?>">
                                    <?php echo $value; ?>
                                     <em class="fa fa-angle-right"> </em>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>	
                        <?php } ?>
                    </ul>
                </div>
                <?php break;
            case 'region':?>
                <div class="block block-block sub-nav block-block-27 ">
                    <h2>Regions</h2>
                    <ul>
                        <?php if(!empty($allRegions)){ ?>
                        <ul>	
                            <?php foreach ($allRegions as $key => $value) { ?>
                            <li>
                                <a href="/research/view/region/<?php echo $key; ?>">
                                    <?php echo $value; ?>
                                     <em class="fa fa-angle-right"> </em>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>	
                        <?php } ?>
                    </ul>
                </div>
                <?php break;

          
            case 'project':?>
                <div class="block block-block sub-nav block-block-27 ">
                    <h2>Projects</h2>
                    <ul>
                        <?php if(!empty($projecrs)){ ?>
                        <ul>	
                            <?php foreach ($projecrs as $key => $value) { ?>
                            <li>
                                <a href="/research/view/project/<?php echo $key; ?>">
                                    <?php echo $value; ?>
                                     <em class="fa fa-angle-right"> </em>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>	
                        <?php } ?>
                    </ul>
                </div>
                <?php break;

            default:
                break;
    } }?>


        <?php break;
     case 'ourexperts':?>
        <div class="block block-block sub-nav block-block-37 ">
            <h2 class="title">Experts</h2>
            <ul>
                <li><a href="/ourexperts/comments">Expert Comment <i class="fa fa-angle-right"></i></a></li>
                <li><a href="/ourexperts/InTheNews">In the news <i class="fa fa-angle-right"></i></a></li>
                <li><a href="/ourexperts">Experts <i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div>

        <?php break;
    case 'publications':?>
        <div class="block block-block sub-nav block-block-56 ">
            <h2 class="title">Publications</h2>
            <ul>
                <li>
                    <a href="/ourexperts/publications">View all publications <i class="fa fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="/pages/about_our_publications"> About our publications <i class="fa fa-angle-right"> </i> </a>
                </li>
            </ul>
        </div>
    <?php 
    case '': 
        if (isset($news) ) { ?>
        <div class="block block-views block-views-in-the-news-block-1 ">
            <h2 class="title">In the news</h2>
                <div class="view view-in-the-news view-id-in_the_news view-display-id-block_1 in-the-news-block sidebar-listing view-dom-id-076ba45c81e711c72c4d7f07909f079d">
                    <div class="views-row views-row-1 views-row-odd views-row-first views-row-last in-the-news-item sidebar-listing-item">
                        <div class="Quote news-image"><a target="_blank" href="<?php echo $news['News']['link'] ?>"></a>
                            <blockquote><p>«<?php echo $news['News']['quote'] ?>»</p></blockquote>
                            <div class="right-hand-listing-image">
                                <img src="/system/experts/<?php echo $news['Expert']['photo'] ?>" width="100" height="100">
                            </div>
                            <div class="text-listing">
                                <p class="label"><?php echo $news['News']['label'] ?></p>
                                <p class="secondary-link"><a target="_blank" href="<?php echo $news['News']['link'] ?>"><?php echo $news['News']['secondary_link'] ?><i class="fa fa-external-link"></i></a></p>
                                <p class="label date"><time datetime=""><?php echo date("d M Y",  strtotime($news['News']['date']));?></time></p>
                            </div>
                            
                        </div> 
                    </div>
                </div>
        </div>
        <?php }

        if (isset($video) ) { ?>
        <div class="block block-views block-views-in-the-news-block-1 ">
            <h2 class="title">Video</h2>
            <div class="Quote"><blockquote><p><?php echo $video['Video']['content'] ?></p></blockquote></div><br>
                <iframe wmode="transparent" width="100%" height="315" src="<?php echo $video['Video']['link']; ?>" frameborder="15" allowfullscreen=""></iframe>
                <center>
                    <div class="btn" style="display: inline-block;">
                        <a href="/research/multimedia">Video Gallery</a>
                    </div>
                    <div class="btn" style="display: inline-block;">
                        <a href="/research/gallery">Photo Albums</a>
                    </div>
                </center>
        </div>
        <?php }
        break;
    default:
         break;
 } ?>
    

    <div class="block block-block block-block-14 ">

        <h2 class="title">Keep informed</h2>

        <section class="gt">
            <a href="#" style="color:#0042d1; font-weight:bold; font-size:22px;">
                AIISA Newsletter
            </a>
            <!--<p class="small-body-text">Our bi-monthly magazine presents authoritative analysis and commentary on current topics.</p>-->
            <div class="btn">
                <a href="/users/email_signup">Subscribe now</a>
            </div>
        </section>
    </div>

    <div class="block block-block block-block-15 ">
        <section class="gt">
            <a href="#" style="color:#D70000; font-weight:bold; font-size:22px;">
                Armenian Journal of Foreign and Security Affairs
            </a>
            <div class="btn">
                <a href="/users/email_signup">Subscribe now</a>
            </div>
            
<!--            <p class="small-body-text">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type 
            </p>-->
            <!--<div class="btn"><a href="/users/email_signup">Subscribe today</a></div>-->
        </section>
        <section class="gt">
        <a  class="" style="color:#EB7501; font-weight:bold; font-size:22px;">
                Library
            </a>
            <div class="btn">
                <a href="http://aiisa.am/research/library">Explore</a>
            </div>
        </section>
    </div>
</section>