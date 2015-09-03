
<section class="steps-area">
    <h1><?php echo __($contract['name']); ?></h1>
    <?php echo $this->element('document_menu'); ?>
    <div class="block">
        <div class="text-block">
            <div class="textbox">
                <div class="text">
                    <span class="ico-help">?</span>                    
                    <h2>Download/Print</h2>
                </div>
                
                <div class="downlaodContractBox">
                    <div>Thank you. Your contract is ready. Now you can Download or Print it.</div>        
                    <a href="/contracts/download/<?php echo $orderId; ?>" class="btn">Download</a> 
                    <a href="/contracts/download/<?php echo $orderId; ?>/true" class="btn">Print</a> 
                </div>
            </div>
        </div>
    </div>
    
</section>