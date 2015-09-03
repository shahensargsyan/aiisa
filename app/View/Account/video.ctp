<div class="row">
    <header class="page-content-level page-content-header">
        <div class="breadcrumb">
            <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first breadcrumb-last">
                <a href="/">Home</a></span>
        </div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1><?php echo $video['Video']['content'] ?></h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages"></section>
        <section class="page-content-container main-content" id="main-content">
            <div class="ds-1col file file-audio file-audio-oembed oembed-rich oembed-embedly oembed-brightcove view-mode-full clearfix">
                <iframe wmode="transparent" width="560" height="315" src="<?php echo $video['Video']['link']; ?>" frameborder="15" allowfullscreen=""></iframe>
            </div>
        </section>
    </section>
</div>