<div id="edit-date-wrapper" class="views-exposed-widget views-widget-filter-field_date_publication_value">
    <label for="edit-date">
        Date </label>
    <div class="views-widget jquery-once-2-processed">
        <div id="edit-field-date-publication-value-value-wrapper" style="display: none;">
            <div id="edit-field-date-publication-value-value-inside-wrapper"><div class="container-inline-date"><div class="form-item">
                        <div id="edit-date-value" class="date-padding clearfix">
                            <div>
                                <label class="element-invisible" for="edit-date-value-year">Year </label>
                                <div class="date-year">
                                    <select class="date-year" id="edit-date-value-year" name="date[year]">
                                        <option value="" <?php echo (isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"] == "") ? 'selected="selected""' : ''; ?> >-Year</option>
                                        <?php
                                        foreach ($years as $key => $value) {
                                            $selected = '';
                                            if (isset($this->request->data["date"]["year"]) && $this->request->data["date"]["year"] == $key) {
                                                $selected = 'selected="selected"';
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>