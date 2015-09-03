<h3>Top Navigation</h3>
<ul id="top_table" class="tbl1 span5">
    <?php $i=0; foreach ($top_navigation as $footer){ ?>
        <li class="top" id="top<?php echo $i;?>">
            <?php echo $footer['Footer']['name'];$i++;?>
        </li>
    <?php }?>
</ul>
  <h3 class="top20">Bottom Navigation</h3>      
<ul id="bottom_table" class="tbl1 span5">
    <?php $i=0; foreach ($bottom_navigation as $footer){ ?>
        <li class="bottom" id="bottom<?php echo $i;?>">
            <?php echo $footer['Footer']['name'];$i++;?>
        </li>
    <?php }?>
</ul>
  <a href="/admins/pages" class="btn btn-danger">Back</a>
<script type="text/javascript">
    $(function(){
        $('#top_table').sortable({
            update  : function(event, ui) {
                var i = 0;
                var text = [];
                while($("#top"+i).text()){
                      text[i] = $(".top:eq("+i+")").text();
                      i++;
                }
                $.post("/admins/save_change",
                    { str: text, navigation: 'top' }
                );
            }
        });
    });
    $(function(){
        $('#bottom_table').sortable({
            update  : function(event, ui) {
                var i = 0;
                var text = [];
                while($("#bottom"+i).text()){
                      text[i] = $(".bottom:eq("+i+")").text();
                      i++;
                }                
                $.post("/admins/save_change",
                    { str: text ,navigation: 'bottom'}
                );
            }
        });
    });
</script>
