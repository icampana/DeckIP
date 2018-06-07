<?php
/**
 * This is an HTML of widget management pupup. Please look at AdminController.php to see how $form variable is created.
 * Feel free to modify this file, but leave intact ID attributes and classes with 'ips' prefix.
 *
 */
?>
<div class="ip" id="ipDeckPopup">
    <div class="modal fade ipsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Plugin settings', 'Deck'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $form->render() ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Cancel', 'Ip-Admin'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php _e('Confirm', 'Ip-Admin'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $this = $('#ipDeckPopup');
    $this.find('fieldset').each(function (index, fieldset) {
        var $fieldset = $(fieldset);
        var $legend = $fieldset.find('legend');
        // if legend exist it means its option group
        if ($legend.length) {
            // adding required attributes to make collapse() work
            $legend
                .attr('data-toggle', 'collapse')
                .attr('data-target', '#ipDeckPopup'+index);
                
            // Only the first set of options remains open
            var wrapClass = 'collapse in';
            var isExpanded = 'true';
            if (index > 1) {
                $legend.addClass('collapsed');
                wrapClass = 'collapse';
                isExpanded = 'false';
            }
            
            $fieldset.find('.form-group').wrapAll('<div class="'+ wrapClass +'" aria-expanded="'+ isExpanded +'" id="ipDeckPopup'+index+'" />');
        }
    });
    ipInitForms();
</script>