<div class="row">
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> Publications</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="view view-publications-section-index view-id-publications_section_index view-display-id-page view-dom-id-0cd1aa4e51c0fa9ec4eaa9e9e6ebe2e7">

                <div class="view-filters">
                <?php
                echo $this->Form->create(
                        'Publication', array(
                            'url' => array(
                                    'controller' => 'ourexperts', 
                                    'action' => 'publications'
                                ),
                            'inputDefaults' => array(
                                'label' => false
                            ),
                            'id' => "user-login"
                        )
                    );
                ?>
                    <div class="filter-container"> 
                        <h2 class="toggle"><a href="#views-exposed-form-in-the-news-in-the-news-listing" class="show-filters">Show filters</a></h2></div>
                        <div class="views-exposed-form">
                            <div class="views-exposed-widgets clearfix">
                                
                                <?php echo $this->element('sort_publication_type'); ?>
                                <?php echo $this->element('sort_date'); ?>
                                <?php echo $this->element('sort_topic'); ?>
                                <?php echo $this->element('sort_region'); ?>

                                <div class="views-exposed-widget views-submit-button">
                                    <input type="submit" id="edit-submit-publications-section-index" name="" value="Filter" autocomplete="off"> 
                                </div>
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
                    <?php if(!empty($publications)){ ?>
                    <ul class="publications listing">
                        <?php foreach ($publications as $key => $value) { ?>
                                
                        <li class="views-row views-row-1 views-row-odd views-row-first">
                            <div class="listing-item" onclick="location.href = '/ourexperts/publication/<?php echo $value['Publication']['id']; ?>'">
                                <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="240" height="340" alt="<?php echo $value['Publication']['photo_by']; ?>" title="<?php echo $value['Publication']['photo_by']; ?>">
                                <span class="label"><?php echo $value['Topic']['name']; ?></span>
                                <div id="node-publication-listing-group-text-listing" class="text-listing">
                                    <h2><?php echo $value['Publication']['title']; ?></h2>
                                    <div class="small-body-text">
                                        <div class="search-body field-name-field-body ds-code-intro">
                                            <p><?php echo $value['Publication']['intro_text']; ?></p>
                                        </div></div><span class="file-icon">
                                            <time datetime="<?php echo $value['Publication']['date']; ?>"><?php echo date("F Y",  strtotime($value['Publication']['date']));?></time></span>
                                    <span class="publication-author external">
                                        <p><?php echo $value['Expert']['first_name'].' '.$value['Expert']['last_name']; ?>,&nbsp;
                                           <?php echo $value['Expert']['job_title']; ?>
                                        </p>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <?php  } ?>
                        
                    </ul>
                    <?php } ?>
                </div>
                <h2 class="element-invisible">Pages</h2>
                <?php echo $this->element('paginate'); ?>
            </div>
        </section>
    </section>
</div>