<div id="edit-field-publication-type-value-wrapper" class="views-exposed-widget views-widget-filter-publication_type">
    <label for="edit-field-publication-type-value">
        Type 
    </label>
    <div class="views-widget">
        <div id="edit-field-publication-type-value" class="form-radios bef-select-as-radios">
            <div>
                <input <?php echo (isset($this->request->data["date"]["publication_type"]) && $this->request->data["date"]["publication_type"] == "") ? 'checked="checked"' : ''; ?> class="bef-select-as-radios" type="radio" id="edit-field-publication-type-value-all" name="date[publication_type]" value="" autocomplete="off">
                <label class="option" for="edit-field-publication-type-value-all">- Any - </label>
            </div>
            <?php
            foreach ($types as $key => $value) {
                $checked = '';
                if (isset($this->request->data["date"]["publication_type"]) && $this->request->data["date"]["publication_type"] == $key) {
                    $checked = 'checked="checked"';
                }
                ?>
                <div>
                    <input <?php echo $checked; ?> class="bef-select-as-radios" type="radio" id="edit-field-publication-type-value-<?php echo $key; ?>"  name="date[publication_type]" value="<?php echo $key; ?>"  autocomplete="off"> 
                    <label class="option" value="<?php echo $key; ?>" for="edit-field-publication-type-value-<?php echo $key; ?>"><?php echo $value; ?></label>
                </div>
            <?php } ?>
        </div> 
    </div>
</div>