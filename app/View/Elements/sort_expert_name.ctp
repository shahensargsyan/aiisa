<div id="edit-expert-wrapper" class="views-exposed-widget views-widget-filter-title">
    <label for="edit-expert">
        Expert name 
    </label>
    <div class="views-widget">
        <div role="application">
            <input  value="<?php echo (isset($this->request->data["date"]["expert_name"]) && $this->request->data["date"]["expert_name"] != "") ? $this->request->data["date"]["expert_name"] : ''; ?>"  name="date[expert_name]" class="views-ac-dependent-filter form-autocomplete" placeholder="Expert name" type="text" id="edit-expert" name="expert" size="30" maxlength="128" autocomplete="off" aria-autocomplete="list">
            <!--<input type="hidden" id="edit-expert-autocomplete" value="" disabled="disabled" class="autocomplete autocomplete-processed" autocomplete="off">-->
            <span class="element-invisible" aria-live="assertive" id="edit-expert-autocomplete-aria-live"></span>
        </div>
    </div>
</div>