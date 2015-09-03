<div class="steps-area">
    <h1><?php echo __('FAQ'); $counter = 0;  ?></h1>
    <?php
        $category = reset($data);
        ?>
        <div class="catName">
        <?php
        echo $category['FaqCategorie']['category']; //CATEGORY name
        ?>
        </div>
    
    
        <?php
        foreach ($data as $key => $question) {
            if ($question['FaqCategorie']['category'] == $category['FaqCategorie']['category']) {?>
            <div class="panel-group questGroup">
                <div class="panel panel-default"> 
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo($question['Question']['id']); ?>">
                                <?php echo __($question['Question']['question']); ?>?
                            </a>
                        </h4>
                    </div>
                    <div id="<?php echo($question['Question']['id']);  ?>" class="panel-collapse collapse <?php //echo ($counter == 1) ? ' in':''  ?>">
                        <div class="panel-body">
                            <?php echo __($question['Question']['answer']); ?>
                        </div>
                    </div>                    
                </div>
            </div>
            <?php } 
                else { ?>
                <div class="catName">
                    <?php
                        echo $question['FaqCategorie']['category']; //CATEGORY name 
                        $category['FaqCategorie']['category'] = $question['FaqCategorie']['category'];
                    ?>
                </div>
                <div class="panel-group questGroup">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo($question['Question']['id']); ?>">
                                    <?php echo __($question['Question']['question']); ?>?
                                </a>
                            </h4>
                        </div>
                        <div id="<?php echo($question['Question']['id']);  ?>" class="panel-collapse collapse <?php //echo ($counter == 1) ? ' in':''  ?>">
                            <div class="panel-body">
                                <?php echo __($question['Question']['answer']); ?>
                            </div>
                        </div>
                    </div>
                </div>           
            <?php }
         } 
    ?>
        
        
        
    <?php
//        $category = reset($data);
//        echo $category['FaqCategorie']['category']; //CATEGORY name
//        foreach ($data as $key => $question) {
//            if ($question['FaqCategorie']['category'] == $category['FaqCategorie']['category']) {?>
<!--                <div class="panel-body">
                    <p><?php //echo __($question['Question']['question']); ?>?</p>
                    <p><?php //echo __($question['Question']['answer']); ?></p>
                </div>-->
            <?php // } 
//                else { 
//                    echo $question['FaqCategorie']['category']; //CATEGORY name
//                    $category['FaqCategorie']['category'] = $question['FaqCategorie']['category'];
                ?>
<!--                <div class="panel-body">
                    <p><?php //echo __($question['Question']['question']); ?>?</p>
                    <p><?php //echo __($question['Question']['answer']); ?></p>
                </div>           -->
            <?php // }
//         } 
    ?>
</div>









<!--
<div class="steps-area">
    <h1><?php //echo __('FAQ'); $counter = 0;  ?></h1>
    <div class="panel-group questGroup">
<?php // foreach($data as $question){  $counter ++;  ?>       
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#<?php //echo($question['Question']['id']); ?>">
<?php
//                            if($question['FaqCategorie']['category']){
//                                echo __($question['FaqCategorie']['category']);
//                            }
?>
                        </a>
                    </h4>
                </div>
                <div id="<?php //echo($question['Question']['id']);  ?>" class="panel-collapse collapse <?php //echo ($counter == 1) ? ' in':''  ?>">
                    <div class="panel-body">
                        <p><?php //echo __($question['Question']['question']);  ?>?</p>
                        <p><?php //echo __($question['Question']['answer']);  ?></p>
                    </div>    
                </div>
            </div>    
<?php //} ?>   
<?php
//        $count = $this->Paginator->params();
//        if($count['pageCount'] > '1'){
?>
            <div class="pagination">
                <ul>
                    <li class="disabled"><?php //echo $this->Paginator->prev('Prev', null, null);  ?></li>
                    <li><?php //echo $this->Paginator->numbers(array("separator" => false));  ?></li>
                    <li ><?php //echo $this->Paginator->next('Next', null, null); ?></li>
                </ul>
            </div>  
<?php //}  ?>  
    </div>
</div>
-->

