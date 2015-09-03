<div class="row">
    <header class="page-content-level page-content-header">
        <div class="breadcrumb"><span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first"><a href="/">Home</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd breadcrumb-last">In the news</span></div>
        <div class="tabs">
        </div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> In the news</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="view view-in-the-news view-id-in_the_news view-display-id-in_the_news_listing view-in-the-news-listing view-dom-id-69c6c7d4861a031b7ada445edf30731a">
                <div class="view-filters">
                    <div class="filter-container">
                        <h2 class="toggle"><a href="#views-exposed-form-in-the-news-in-the-news-listing" class="show-filters">Show filters</a></h2>
                    </div>
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
                                <?php echo $this->element('sort_date'); ?>
                                <div class="views-exposed-widget views-submit-button">
                                    <input type="submit" id="edit-submit-in-the-news" name="" value="Filter" autocomplete="off"> </div>
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
                    <?php if(!empty($news)){ ?>
                    <ul class="in-the-news listing">
                        <?php foreach ($news as $key => $value) { ?>
                        <li class="views-row views-row-1 views-row-odd views-row-first in-the-news-item">
                            <a href="<?php echo $value['News']['link'] ?>">
                                <div class="text-listing">
                                    <p class="label">Quote</p>
                                    <p class="title"><?php echo $value['News']['title']; ?><i class="fa fa-external-link"></i></p>
                                    <div class="quote"><p>'<?php echo $value['News']['quote'] ?>'</p></div>
                                    <p class="author"><i class="fa fa-user fa-fw"></i> <?php echo $value['Expert']['first_name'].' '.$value['Expert']['last_name'].' '.$value['Expert']['job_title'] ?></p>
                                    <p class="secondary-link"><i class="fa fa-file-text fa-fw"></i> <?php echo $value['News']['secondary_link']; ?></p>
                                    <p class="date"><i class="fa fa-calendar fa-fw"></i> <time datetime="2015-04-20T00:00:00+01:00"><?php echo date("d M Y",  strtotime($value['News']['created']));?></time></p>
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