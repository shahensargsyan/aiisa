<div class="wrapper">
    <div class="row">
<!--        <header class="page-content-level page-content-header">
            <div class="breadcrumb">
                <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first"><a href="/">Home</a></span>
                <i class="fa fa-angle-right"></i>
                <span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd">Research</span>
                <i class="fa fa-angle-right"></i>
                <span class="breadcrumb-link breadcrumb-depth-2 breadcrumb-even breadcrumb-last">The Role of the Nation-State in Addressing Global Challenges: Japan–UK Perspectives</span>
            </div>
            <div class="tabs">
            </div>
        </header>-->
        <section class="page-content-level column page-content-main " id="page-content-main">
            <header class="page-content-container main-title" id="main-title">
                <h1><?php echo $data['Academy']['title'] ?></h1>
            </header>
            <section class="page-content-container main-content" id="main-content">
                <div class="ds-1col node node-publication view-mode-publication_rp clearfix">


                    <div class="field field-name-field-intro">
                        <p>
                           <?php echo $data['Academy']['intro_text'];?>
                        </p>
                    </div>
                    <div class="field field-name-field-image-main">
                        <div class="file-image">
                            <img src="/system/academy/<?php echo $data['Academy']['photo']; ?>" width="800" height="460" >
                            <!--<span class="caption">Photo: <?php //echo $data['Academy']['photo_by']; ?></span>-->
                        </div>
                    </div>
                    <div class="field field-name-field-body">
                        <?php echo $data['Academy']['content']; ?>
                    </div>
<!--                    <div class="field field-name-field-document">
                        <a class="file-link-wrapper" href="http://www.chathamhouse.org/sites/files/chathamhouse/field/field_document/20150317UKJapanConferenceReport.pdf" title="20150317UKJapanConferenceReport.pdf">
                            <div class="file file-document">
                                <div class="field-name-field-media-description">
                                    Conference Report: The Role of the Nation-State in Addressing Global Challenges: Japan–UK Perspectives
                                </div>
                                <div class="file-details">
                                    <span class="filetype">pdf</span> | <span class="filesize">385.36 KB</span>
                                </div>
                            </div>
                        </a>
                    </div>-->
                </div>
            </section>
        </section>
    </div>
</div>