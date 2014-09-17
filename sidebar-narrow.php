<?php 
	global $solostream_options;
	if ( 
		$solostream_options['solostream_layout'] == "Content | Sidebar-Narrow | Sidebar-Wide" ||
		$solostream_options['solostream_layout'] == "Sidebar-Narrow | Content | Sidebar-Wide" ||
		$solostream_options['solostream_layout'] == "Sidebar-Wide | Sidebar-Narrow | Content" ||
		$solostream_options['solostream_layout'] == "Sidebar-Wide | Content | Sidebar-Narrow" || 
		$solostream_options['solostream_layout'] == "Content | Sidebar-Narrow" || 
		$solostream_options['solostream_layout'] == "Sidebar-Narrow | Content"  
	)
{ ?>

	<div id="sidebar-narrow" class="clearfix">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Narrow') ) : ?>
		<?php endif; ?>
	</div>

<?php } ?>