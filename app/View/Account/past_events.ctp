<?php if (count($events)>0) { ?> 
<div class="item-list">
    <ul> 
        <?php
        $first = TRUE;
        foreach ($events as $k => $e) {?> 
            <li class="views-row views-row-1 views-row-odd <?php  echo (count($events)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                <aside onclick="location.href = '/events/event/<?php echo $e['Event']['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                    <div class="field-name-field-image-listing">
                        <img src="/system/events/<?php echo ($e['Event']['photo'])?$e['Event']['photo']:'default_event.png'; ?>" width="300" height="200" alt="<?php echo $e['Event']['photo_by']; ?>">
                    </div>
                    <span class="label"><?php echo $e['Topic']['name']; ?></span>
                    <h3 class="secondary-link">
                        <a href="/events/event/<?php echo $e['Event']['id']; ?>">
                            <?php 
                            echo  substr($e['Event']['title'], 0,80);
                            echo (strlen($e['Event']['title'])>80)?'...':'';
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