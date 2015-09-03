<?php if (count($videos)>0) { ?> 
<div class="item-list">
    <ul> 
        <?php
        $first = TRUE;
        foreach ($videos as $k => $e) {?> 
            <li class="views-row views-row-1 views-row-odd <?php  echo (count($videos)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                <aside onclick="location.href = '/research/video/<?php echo $e['Video']['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                    <div class="field-name-field-image-listing">
                        <img src="/img/video.png" height="108" width="168">
                    </div>
                    <span class="label"><?php echo $e['Topic']['name']; ?></span>
                    <h3 class="secondary-link">
                        <a href="/research/video/<?php echo $e['Video']['id']; ?>">
                            <?php 
                            echo  substr($e['Video']['title'], 0,80);
                            echo (strlen($e['Video']['title'])>80)?'...':'';
                            ?>
                        </a>
                    </h3>
                </aside>
            </li>
            

        <?php 
         $first = FALSE;
        } ?> 
    </ul>
</div>
<?php 
echo $this->element('paginate_ajax'); 
}