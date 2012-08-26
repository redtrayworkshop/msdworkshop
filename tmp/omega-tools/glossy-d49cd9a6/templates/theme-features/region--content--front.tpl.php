<div<?php print $attributes;?>>
<?php if ($breadcrumb): ?>
	<div id="breadcrumb"><?php print $breadcrumb; ?></div>
<?php endif; ?>  
 
<?php if ($messages): ?>
	<div id="messages" class="grid-<?php print $columns; ?>"><?php print $messages; ?></div>
<?php endif; ?>

  <div<?php print $content_attributes; ?>>
	    <?php if ($tabs): ?><div class="tabs clearfix"><?php print render($tabs); ?></div><?php endif; ?>
    <a id="main-content"></a>
    <?php if ($title): ?>
    <?php if ($title_hidden): ?><div class="element-invisible"><?php endif; ?>
    <?php print render($title_prefix); ?>
    <h1 class="title" id="page-title"><?php print $title; ?></h1>
    <?php print render($title_suffix); ?>
    <?php if ($title_hidden): ?></div><?php endif; ?>
    <?php endif; ?>
    <?php if ($action_links): ?><ul class="action-links clearfix"><?php print render($action_links); ?></ul><?php endif; ?>
    <?php print $content; ?>
    <?php if ($feed_icons): ?><div class="feed-icon-outter clearfix"><?php print $feed_icons; ?></div><?php endif; ?>
  </div>
</div>