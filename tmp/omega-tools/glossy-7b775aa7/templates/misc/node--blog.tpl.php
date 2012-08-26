<article<?php print $attributes;?>>

  <?php if (!$teaser && $node_top): ?>
    <div id="node-top" class="node-top region">
      <?php print render($node_top); ?>
    </div>
  <?php endif; ?>
	
  <div class='main-content'>
		<?php
			// Hiding the desired elements to render out later
			if (isset($content['comments'])) {hide($content['comments']);}
			if (isset($content['links'])) {hide($content['links']);}
			if (isset($content['field_image'])) {hide($content['field_image']);}
			if (isset($content['field_tags'])) {hide($content['field_tags']);}
			if (isset($content['field_categories'])) {hide($content['field_categories']);}
			if (isset($content['field_image'])) {print render($content['field_image']);}
		?>
			
		<div class='title_groups'>
			<?php if (!$page && $title): ?>
				<header>
					<?php print render($title_prefix); ?>
					<h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
					<?php print render($title_suffix); ?>
				</header>
			<?php elseif ($page && $title): ?>
				<h1 class="title" id="page-title"><?php print render($title) ;?></h1>
			<?php endif; ?>
			
				<?php if ($node->comment == COMMENT_NODE_OPEN): ?>
				<div class="comments_count">
					<a href='<?php print $node_url ;?>#comments' class='comments-link' title='display recent "<?php print render($title) ;?>" comments'><?php print render($comment_count) ;?></a>
				</div>
				<?php endif; ?>

			<?php if ($display_submitted && isset($content['field_portfolio_tags'])): ?>
				<footer class="submitted footer-el clearfix"><?php print t('Posted on:') . ' ' .  $date; ?>&nbsp;&nbsp;&nbsp;<?php print t('By:') . ' ' . $name; ?></footer>
			<?php endif; ?>
			</div>
		
			<?php print render($content); ?>
  </div>
	
  
	<?php if (!empty($content['links'])): ?>
		<nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
	<?php endif; ?>
		
  <?php if ($display_submitted): ?>
		<?php if (isset($content['field_tags'])): ?>
			<footer class="tags footer-el clearfix"><?php print render($content['field_tags']); ?></footer>
		<?php endif; ?>
		
		<?php if (isset($content['field_categories'])): ?>
			<footer class="categories footer-el clearfix"><?php print render($content['field_categories']); ?></footer>
		<?php endif; ?>		
  <?php endif; ?> 
	
  <?php if (!$teaser && $node_bottom): ?>
    <div id="node-bottom" class="node-bottom region">
      <?php print render($node_bottom); ?>
    </div>
  <?php endif; ?>
	
	<?php if (isset($content['comments'])): ?>
		<div id='node-comment' class="clearfix">
			<?php print render($content['comments']); ?>
		</div>
	<?php endif; ?>
	
</article>