<?php
if(isset($note)){
    ?>
    <script type="text/javascript" >
        $(document).ready(function($){
            $.jGrowl("<?php echo addslashes($note); ?>", {theme: '<?php echo $theme ?>', position: 'center'});
        })
    </script>    
    <?php
}