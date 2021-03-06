<div class="steps-area col-md-10">    
    <?php
    echo $this->Form->create(array('class' => 'searchForm col-md-6 padLeft0'));
    echo $this->Form->input('search', array(
        'label' => false,
        'placeholder' => 'Search...'
    ));
    echo $this->Form->submit('', array('div' => false));
    echo $this->Form->end();
    ?>        
    <h1><?php echo __('Law Library'); ?></h1>  

    
    <?php if(!empty($data)){ ?>
        <table class="table table-striped lawLib">
            <tbody>
                <?php foreach($data as $library){ ?>
                    <tr>
                        <td class="col-md-11"><?php echo $library['Librarie']['title']; ?></td>
                        <td class="text-center col-md-1">
                            <?php echo $this->Html->link('', array('controller' => 'contracts', 'action' => 'download_file', $library['Librarie']['id'])/* ,array('class' => 'btn') */); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        $count = $this->Paginator->params();
        if($count['pageCount'] > '1'){
            ?>
            <div class="pagination">
                <ul>
                    <li class="disabled"><?php echo $this->Paginator->prev('Prev', null, null); ?></li>
                    <li><?php echo $this->Paginator->numbers(array("separator" => false)); ?></li>
                    <li ><?php echo $this->Paginator->next('Next', null, null); ?></li>

                </ul>
            </div>  
        <?php } ?>  
    <?php }else{ ?>
        <p><i><?php echo __('Law library not exist'); ?></i></p>
    <?php } ?>
</div>
