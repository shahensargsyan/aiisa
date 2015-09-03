<div class="wrapper">
    <div class="row">
        <section class="page-content-level column page-content-main " id="page-content-main">
            <header class="page-content-container main-title" id="main-title">
                <h1><?php echo $comment['ExpertComment']['title'] ?></h1>
            </header>
            <section class="page-content-container main-content" id="main-content">
                <div class="ds-1col node node-publication view-mode-publication_rp clearfix">
                    <div class="event-meta">
                        <p><i class="fa fa-file-text fa-fw fa-lg"></i>
                            <time datetime="<?php echo $comment['ExpertComment']['date']; ?>"><?php echo date("d F Y",  strtotime($comment['ExpertComment']['date']));?></time>
                        </p>
                    </div>
                    <div class="required-fields group-author-info-wrapper field-group-html-element">
                        <div class="contact expert-author">
                            <div class="individual expert">
                                <div class="field field-name-field-person-photo">
                                    <img src="/system/experts/<?php echo $comment['Expert']['photo']; ?>" width="100" height="100" alt="<?php echo $comment['ExpertComment']['photo_by'];?>">
                                </div>
                                <span class="group-expert-title">
                                    <div class="field field-name-title">
                                        <span class="expert-name">
                                            <a href="/ourexperts/expert/<?php echo $comment['ExpertComment']['expert_id']; ?>"><?php echo $comment['Expert']['first_name'].' '.$comment['Expert']['last_name']; ?></a>
                                        </span>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="field field-name-field-intro">
                        <p>
                           <?php echo $comment['ExpertComment']['intro_text'];?>
                        </p>
                    </div>
                    <div class="field field-name-field-image-main">
                        <div class="file-image">
                            <img src="/system/expertComments/<?php echo $comment['ExpertComment']['photo']; ?>" width="800" height="460" alt="<?php echo $comment['ExpertComment']['photo_title']; ?>">
                            <span class="caption">
                               <?php echo $comment['ExpertComment']['photo_title']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="field field-name-field-body">
                        <?php echo $comment['ExpertComment']['content']; ?>
                    </div>
                </div>
            </section>
        </section>
    </div>
</div>