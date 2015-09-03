<div id="edit-field-publication-type-value-wrapper" class="views-exposed-widget views-widget-filter-region">
    <label for="edit-field-publication-type-value">
        Region
    </label>
    <div class="views-widget">
        <div id="edit-field-publication-type-value" class="form-radios bef-select-as-radios">
            <div>
                <input <?php echo (isset($this->request->data["date"]["region"]) && $this->request->data["date"]["region"] == "All") ? 'checked="checked"' : ''; ?> class="bef-select-as-radios" type="radio" id="edit-field-publication-type-value-all" name="date[region]" value="" autocomplete="off">
                <label class="option" for="edit-field-publication-type-value-all">- Any - </label>
            </div>
            <?php
            foreach ($regions as $key => $value) {
                $checked = '';
                if (isset($this->request->data["date"]["region"]) && $this->request->data["date"]["region"] == $key) {
                    $checked = 'checked="checked"';
                }
                ?>
                <div>
                    <input  <?php echo $checked; ?> class="bef-select-as-radios" type="radio" id="edit-field-region-type-value-<?php echo $key; ?>"  name="date[region]" value="<?php echo $key; ?>"  autocomplete="off"> 
                    <label class="option" value="<?php echo $key; ?>" for="edit-field-region-type-value-<?php echo $key; ?>"><?php echo $value; ?></label>
                </div>
                <?php } ?>
        </div> 
    </div>
</div>