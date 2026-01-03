{$ueditor|raw}
<script type="text/plain" id="{$name}" style="width:<?php echo $width;?>;">{$val|raw}</script>
<script type="text/javascript">
    UE.getEditor('{$name}',{
        textarea:'{$name}',
        toolbars:[<?php echo $toolbar;?>],
        initialFrameHeight:<?php echo $height;?>
    });
</script>


