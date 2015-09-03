<?php
if(!isset($noteType))
    $noteType = 'bootstrap'; //defaut action

switch($noteType){//jGrowl , bootstrap , fancybox
    case 'jGrowl' :
        $this->Html->scriptStart(array('inline' => false));
        ?>
        $(document).ready(function($){
        $.jGrowl("<?php echo $message ?>",{theme:"<?php echo $class; ?>"});
        })
        <?php
        $this->Html->scriptEnd();
        break;
    case 'bootstrap':
        ?>

        <div class="alert alert-<?php echo $class; ?>"> <!--fade in-->
            <button type="button" class="alert-link" data-dismiss="alert" aria-hidden="true"></button> <!--close-->
            <p class="errText"><?php echo $message; ?></p>
        </div>
<!--        <div class="modal hide <?php echo $class; ?>" id="successAlert">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3>&nbsp;</h3>
            </div>
            <div class="modal-body">
                <h4>
                    <?php echo $message; ?>
                </h4>
            </div>
            <div class="modal-footer"></div>
        </div>-->
        <?php $this->Html->scriptStart(array('inline' => false)); ?>
        $(document).ready(function($){
        $(".alert").alert();
        })
        <?php
        $this->Html->scriptEnd();
        break;
    case 'fancybox':
        $this->Html->scriptStart(array('inline' => false));
        ?>
        $(document).ready(function($){
        $.fancybox({            
        'autoDimensions'    : true,
        'hideOnOverlayClick': false,
        helpers   : { 
        overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
        },
        'autoScale'         : true,
        'type'              : 'inline',
        'width'             : 300,
        'height'            : 150,
        'content'           : '<?php echo $message ?>'
        });
        })
        <?php
        $this->Html->scriptEnd();
        break;
    default :
        ?>
        <div id="myCustomFlash" class="<?php echo $class; ?>"><?php echo h($message); ?></div>
    <?php
}
?>