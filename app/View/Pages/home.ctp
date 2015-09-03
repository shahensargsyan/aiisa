<div class="left">
    <?php echo $this->element('slider'); ?>
</div>
<div class="item item-sidekick right">

    <div class="spot spot-subbrands" >

        <ul class="navigation-quinary">
        
        	<li class="odd">
                <a  href="/ourexperts/databases/aiisa_database">
                    AIISA Databases
                </a>
            </li>

            <li class="even">
                <a title="Survival: Global Politics and Strategy" href="/ourexperts/databases/aiisa_newsletter">
                    AIISA Conflict Charts
                </a>
            </li>

            <li class="odd">
                <a title="The Military Balance" href="/ourexperts/databases/aiisa_yearbook">
                    AIISA Security Risk Assessment
                </a>
            </li>
    </div>
</div>

<section class="page-content-level column page-content-main " id="page-content-main">
    <header class="page-content-container main-title" id="main-title">
    </header>
    <section class="page-content-container drupal-messages" id="drupal-messages">
    </section>
    <section class="page-content-container main-content" id="main-content">
        <div class="ds-1col node node-homepage view-mode-full clearfix">
            <section class="featured-listing">
                <?php $y = 0;?>
                <?php if(isset($expertComments[0])){
                    $value = $expertComments[0];?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/comment/<?php echo $value['ExpertComment']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/expertComments/<?php echo $value['ExpertComment']['photo']; ?>" width="800" height="460" alt="<?php echo $value['ExpertComment']['photo_title']; ?>" title="<?php echo $value['ExpertComment']['photo_title']; ?>">
                        </div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--3" class="link-text">
                            <p class="label">Expert Comment</p>
                            <h2><?php echo $value['ExpertComment']['title']; ?></h2>
                            <div class="body-text">
                                <p<?php echo $value['ExpertComment']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php } ?>
                <?php if(isset($briefingPaper[0])){
                    $value = $briefingPaper[0];
                }elseif(isset($punlocations[$y])){
                    $value = $punlocations[$y];
                    $y++;
                }
                if(isset($value)){
                ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="800" height="460"></div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--6" class="link-text">
                            <p class="label">Briefing Paper</p>
                            <h2><?php echo $value['Publication']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Publication']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php }?>
                <?php if(isset($researchPaper[0])){
                    $value = $researchPaper[0];
                }elseif(isset($punlocations[$y])){
                    $value = $punlocations[$y];
                    $y++;
                }
                if(isset($value)){ ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="800" height="460"></div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--6" class="link-text">
                            <p class="label">Research Paper</p>
                            <h2><?php echo $value['Publication']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Publication']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php }?>
            </section>

            <section class="forthcoming-events">
                <?php if(!empty($events)){ ?>
                <h2 class="label-above underlined">Forthcoming events</h2>
                <div class="view view-events view-id-events view-display-id-block_4 event-block featured-listing view-dom-id-a8d024f81f8f7ba0362cd8951f5f4d4d">
                    
                    <?php foreach ($events as $key => $value) {  ?>
                    <div class="views-row views-row-1 views-row-odd views-row-first features three-listing">
                        <div class="views-field views-field-nothing">
                            <span class="field-content">
                                <a class="block-link" href="/events/event/<?php echo $value['Event']['id']; ?>">
                                    <div class="date-calendardate date-calendardate-date-square">
                                        <p class="date-calendardate-day"><?php echo date("d",strtotime($value['Event']['event_date']));?></p>
                                        <p class="date-calendardate-month"><?php echo date("M",strtotime($value['Event']['event_date']));?></p>
                                    </div>
                                    <div class="event-text">
                                        <span class="label"><?php echo $value['EventTipe']['name']; ?></span>
                                        <p class="white"><?php echo $value['Event']['title']; ?></p>
                                        <span class="label meta">
                                            <i class="fa fa-map-marker fa-fw fa-lg"></i><p><?php echo $value['Event']['location']; ?></p>
                                        </span>
                                        <span class="label meta listed-speakers">
                                            <i class="fa fa-microphone fa-fw fa-lg"></i>
                                            <span>
                                                <strong><?php echo $value['Event']['participants']; ?></strong>
                                                <?php echo $value['Event']['participant_job_title']; ?>
                                            </span>
                                        </span>
                                    </div>
                                </a>
                            </span> 
                        </div> 
                    </div>
                    <?php } ?>
                </div>
                    <?php } ?>
            </section>
            <section class="featured-listing">
                
                
                <?php if(isset($researchPaper[1])){
                    $value = $researchPaper[1];
                }elseif(isset($punlocations[$y])){
                    $value = $punlocations[$y];
                    $y++;
                }
                if(isset($value)){
                ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="800" height="460"></div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--6" class="link-text">
                            <p class="label">Briefing Paper</p>
                            <h2><?php echo $value['Publication']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Publication']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php }?>
                
                <?php if(isset($academies)){
                    $value = $academie; ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/academy/<?php echo preg_replace('/\s+/', '_', strtolower($value['Academie']['name'])) ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/academy/<?php echo $value['Academie']['photo']; ?>" width="800" height="460" alt="<?php echo $value['Academie']['photo_title']; ?>" title="<?php echo $value['Academie']['photo_title']; ?>">
                        </div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--3" class="link-text">
                            <p class="label">Leadership Academy</p>
                            <h2><?php echo $value['Academie']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Academie']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php } ?>
                <?php if(isset($briefingPaper[1])){
                    $value = $briefingPaper[1];
                }elseif(isset($punlocations[$y])){
                    $value = $punlocations[$y];
                    $y++;
                }
                if(isset($value)){ ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="800" height="460"></div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--6" class="link-text">
                            <p class="label">Research Paper</p>
                            <h2><?php echo $value['Publication']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Publication']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php }?>
            </section>
            <section class="featured-listing">
                <?php if(isset($briefingPaper[2])){
                    $value = $briefingPaper[2];
                }elseif(isset($punlocations[$y])){
                    $value = $punlocations[$y];
                    $y++;
                }
                if(isset($value)){ ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="800" height="460"></div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--6" class="link-text">
                            <p class="label">Research Paper</p>
                            <h2><?php echo $value['Publication']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Publication']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php }?>
                
                <?php if(isset($researchPaper[2])){
                    $value = $researchPaper[2];
                }elseif(isset($punlocations[$y])){
                    $value = $punlocations[$y];
                    $y++;
                }
                if(isset($value)){
                ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="800" height="460"></div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--6" class="link-text">
                            <p class="label">Aiisa report</p>
                            <h2><?php echo $value['Publication']['title']; ?></h2>
                            <div class="body-text">
                                <p><?php echo $value['Publication']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php }?>
                
                <?php if(isset($expertComments[1])){
                    $value = $expertComments[1]; ?>
                <article class="contextual-links-region features featured-highlight three-listing">
                    <div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/ourexperts/comment/<?php echo $value['ExpertComment']['id']; ?>'">
                        <div class="field field-name-field-image-highlight">
                            <img src="/system/expertComments/<?php echo $value['ExpertComment']['photo']; ?>" width="800" height="460" alt="<?php echo $value['ExpertComment']['photo_title']; ?>" title="<?php echo $value['ExpertComment']['photo_title']; ?>">
                        </div>
                        <div id="node-section-highlight-featured-teaser-group-featured-link-text--3" class="link-text">
                            <p class="label">Expert Comment</p>
                            <h2><?php echo $value['ExpertComment']['title']; ?></h2>
                            <div class="body-text">
                                <p<?php echo $value['ExpertComment']['intro_text']; ?></p>
                            </div>
                        </div>
                    </div>
                </article>
                <?php } ?>
            </section>
        </div>
    </section>
</section>