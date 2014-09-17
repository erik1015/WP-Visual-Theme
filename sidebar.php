<?php
	global $solostream_options;
	if ( 
		$solostream_options['solostream_layout'] !== "Full-Width" && 
		$solostream_options['solostream_layout'] !== "Sidebar-Narrow | Content" && 
		$solostream_options['solostream_layout'] !== "Content | Sidebar-Narrow" 
	) 
{ ?>

	<div id="contentright">

		<?php if ( is_active_sidebar('widget-1') ) { ?>
			<div id="sidebar" class="clearfix">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Wide - Top') ) : ?>
				<?php endif; ?>
			</div>
		<?php } ?>

		<?php if ( is_active_sidebar('widget-2') || is_active_sidebar('widget-3') ) { ?>
			<div id="sidebar-bottom" class="clearfix">
				<div id="sidebar-bottom-left">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Wide - Bottom Left') ) : ?>
					<?php endif; ?>
				</div>
				<div id="sidebar-bottom-right">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Wide - Bottom Right') ) : ?>
					<?php endif; ?>
				</div>
			</div>
		<?php } ?>

	</div>

<?php } ?>