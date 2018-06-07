<?php
/**
 * Public representation of the widget.
 * All form data is available here in form of variables.
 * Please check the existence of all variables as at the beginning widget has no data.
 */

$image_options = array(
    'type' => 'width',
    'width' => 480);

$image_url = '';

if ( !empty($imagelink[0]) ) {
    $image_url = ipFileUrl( ipReflection($imagelink[0], $image_options));
}

if (empty($position)) {
  $position = "topLeft";
} else {
  $position = str_replace(' ', '', ucwords( strtolower($position) ) );
  $position[0] = strtolower($position[0]);
}

?>
<div class='deck-block' style='background-image: url("<?php echo $image_url ?>")' data-color='<?php echo $blockcolor ?>'>
    <?php if (!empty($pagelink)): ?>
    <a href='<?php echo !empty($pagelink) ? $pagelink : '#' ?>' class='btn btn-primary deck-title <?php echo $position ?>'>
       <span><?php echo esc(!empty($title) ? $title : '') ?></span>
    </a>
    <?php endif ?>
    <div class='deck-overflow'></div>
    <div class='deck-text'><?php echo !empty($text) ? $text : '' ?></span></div>
</div>
