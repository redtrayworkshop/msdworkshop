<article<?php print $attributes; ?>>
		<div class='left-column clearfix'>
			<?php print $picture; ?>
			<footer class='clearfix'>
			 <?php
					print t('!username !datetime',
					array('!username' => $author, '!datetime' => '<time class="time" datetime="' . $datetime . '">' . $created . '</time>'));
				?>
			</footer>
		</div>
		
		<div class='right-column clearfix'>
			<div class='inner'>
				<header>
					<?php print render($title_prefix); ?>
					<?php if ($title): ?>
						<h3<?php print $title_attributes; ?>><?php print $title ?></h3>
					<?php endif; ?>
					<?php print render($title_suffix); ?>
					<?php if ($new): ?>
						<em class="new"><?php print $new ?></em>
					<?php endif; ?>
					<?php if (isset($unpublished)): ?>
						<em class="unpublished"><?php print $unpublished; ?></em>
					<?php endif; ?>
				</header>

				<div<?php print $content_attributes; ?>>
					<?php
						hide($content['links']);
						print render($content);
					?>
				</div>

				<?php if ($signature): ?>
					<div class="user-signature"><?php print $signature ?></div>
				<?php endif; ?>

				<?php if (!empty($content['links'])): ?>
					<nav class="links comment-links clearfix"><?php print render($content['links']); ?></nav>
				<?php endif; ?>
			</div>
	</div>
	
</article>