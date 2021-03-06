<section class="page-content-level column page-content-main " id="page-content-main">
    <header class="page-content-container main-title" id="main-title">
        <h1> Our Experts</h1>
    </header>
    <section class="page-content-container main-content" id="main-content">
        <div class="view view-experts-section-index view-id-experts_section_index view-display-id-page people view-dom-id-de6131921be5d181c04ae501fc740379">
            <div class="view-filters">
                <div class="filter-container"> 
                    <h2 class="toggle"><a href="#views-exposed-form-in-the-news-in-the-news-listing" class="show-filters">Show filters</a></h2></div>
                        <?php
                        echo $this->Form->create(
                                'Comments', array(
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

                            <div class="views-exposed-widget views-submit-button">
                                <input type="submit" id="edit-submit-experts-section-index" name="" value="Filter" autocomplete="off">
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
                <ul class="experts listing"> 
                    <?php foreach ($experts as $key => $value) { ?>
                    <li class="views-row views-row-1 views-row-odd views-row-first">
                        <div onclick="location.href = '/ourexperts/expert/<?php echo $value['Expert']['id']; ?>'" class="ds-1col node node-person view-mode-listing clearfix">
                            <div class="field field-name-field-person-photo">
                                <img src="/system/experts/<?php echo $value['Expert']['photo']; ?>" width="100" height="100">
                            </div>
                            <span class="label job-title"><?php echo $value['Expert']['job_title']; ?></span>
                                <div class="field field-name-title"><h2><?php echo $value['Expert']['first_name'].' '.$value['Expert']['last_name']; ?></h2></div>
                                <p><?php echo $value['Expert']['summary']; ?></p>
                                <p><?php echo $value['Expert']['email']; ?></p>
                                <p><?php echo $value['Expert']['phone_number']; ?></p>
                        </div>
                    </li>
                     <?php } ?>
                </ul>
            </div>
            <h2 class="element-invisible">Pages</h2>
            <?php echo $this->element('paginate'); ?>
        </div>
    </section>
</section>