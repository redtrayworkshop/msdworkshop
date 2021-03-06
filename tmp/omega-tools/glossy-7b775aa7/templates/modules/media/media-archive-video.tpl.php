<?php

/**
 * @file media_archive/includes/themes/media-archive-video.tpl.php
 *
 * Template file for theme('media_archive_video').
 *
 * Variables available:
 *  $uri - The uri to the Archive video, such as archive://v/xsy7x8c9.
 *  $video_id - The unique identifier of the Archive video.
 *  $width - The width to render.
 *  $height - The height to render.
 *  $autoplay - If TRUE, then start the player automatically when displaying.
 *  $fullscreen - Whether to allow fullscreen playback.
 *
 * Note that we set the width & height of the outer wrapper manually so that
 * the JS will respect that when resizing later.
 */
?>
<div class="media-archive-outer-wrapper responsive-video" id="media-archive-<?php print $id; ?>">
    <?php print $output; ?>
</div>
