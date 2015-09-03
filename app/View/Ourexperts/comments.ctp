<div class="row">
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> Expert comment</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="view view-blog view-id-blog view-display-id-page view-dom-id-08fb0c066bb8e10bfdcb724d5a87fc38">

                <div class="view-filters">
                    <div class="filter-container"> 
                        <h2 class="toggle">
                            <a href="#views-exposed-form-in-the-news-in-the-news-listing" class="show-filters">Show filters</a></h2>
                    </div>
                        <?php
                        echo $this->Form->create(
                                'Comments', array(
                                    'url' => array(
                                        'controller' => 'ourexperts', 
                                        'action' => 'comments'
                                    ),
                                    'inputDefaults' => array(
                                        'label' => false
                                    ),
                                    'id' => "user-login"
                                )
                            );
                        ?>
                        <div class="views-exposed-form">
                            <div class="views-exposed-widgets clearfix">
                                <?php echo $this->element('sort_expert_name'); ?>
                                <?php echo $this->element('sort_date'); ?>
                                <?php echo $this->element('sort_topic'); ?>
                                <?php echo $this->element('sort_region'); ?>
                                
                                <div class="views-exposed-widget views-submit-button">
                                <input type="submit" id="edit-submit-blog" name="" value="Filter" autocomplete="off"> </div>
                                <div class="views-exposed-widget views-reset-button">
                                    <input type="submit" id="edit-reset" name="op" value="Clear" autocomplete="off"> 
                                </div>
                            </div>
                        </div>
                    <?php
                    echo $this->Form->end();
                    ?>  
                </div>
                <div class="item-list"> 
                    <?php if(!empty($ecpertComments)){ ?>
                    <ul class="expert-comments listing"> 
                        <?php foreach ($ecpertComments as $key => $value) { ?>
                        <li class="views-row views-row-1 views-row-odd views-row-first">
                            <a href="/ourexperts/comment/<?php echo $value['ExpertComment']['id']; ?>" class="listing-item">
                                <img src="/system/experts/<?php echo $value['Expert']['photo']; ?>" width="100" height="100" alt="<?php echo $value['Expert']['first_name'].' '.$value['Expert']['last_name']; ?>">
                                <div class="text-listing">
                                    <p class="label"><?php echo $value['Expert']['first_name'].' '.$value['Expert']['last_name']; ?></p>
                                    <h2><?php echo $value['Expert']['job_title'];?></h2>
                                    <p class="small-body-text"><?php echo strip_tags ($value['ExpertComment']['intro_text']);?></p>
                                    <span class="date"><?php echo date("d F Y",  strtotime($value['ExpertComment']['created']));?></span>
                                </div>
                            </a> 
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
                <h2 class="element-invisible">Pages</h2>
                <?php echo $this->element('paginate'); ?>
            </div>
        </section>
    </section>
</div>