<div id="edit-field-publication-type-value-wrapper" class="views-exposed-widget views-widget-filter-topic">
    <label for="edit-field-publication-type-value">
        Topic 
    </label>
    <div class="views-widget">
        <div id="edit-field-publication-type-value" class="form-radios bef-select-as-radios">
            <div>
                <input <?php echo (isset($this->request->data["date"]["topic"]) && $this->request->data["date"]["topic"] == "") ? 'checked="checked"' : ''; ?>  class="bef-select-as-radios" type="radio" id="edit-field-publication-type-value-all" name="date[topic]" value="" autocomplete="off">
                <label class="option" for="edit-field-publication-type-value-all">- Any - </label>
            </div>
            <?php
            foreach ($topics as $key => $value) {
                $checked = '';
                if (isset($this->request->data["date"]["topic"]) && $this->request->data["date"]["topic"] == $key) {
                    $checked = 'checked="checked"';
                }
                ?>
                <div>
                    <input <?php echo $checked; ?> class="bef-select-as-radios" type="radio" id="edit-field-topic-type-value-<?php echo $key; ?>"  name="date[topic]" value="<?php echo $key; ?>"  autocomplete="off"> 
                    <label class="option" value="<?php echo $key; ?>" for="edit-field-topic-type-value-<?php echo $key; ?>"><?php echo $value; ?></label>
                </div>
            <?php } ?>
        </div> 
    </div>
</div>