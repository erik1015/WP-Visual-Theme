<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/" >
	<input type="text" value="<?php _e("Enter Search Terms", "solostream"); ?>" onfocus="if (this.value == '<?php _e("Enter Search Terms", "solostream"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Enter Search Terms", "solostream"); ?>';}" size="18" maxlength="50" name="s" id="searchfield" />
	<input type="submit" value="<?php _e("", "solostream"); ?>" id="submitbutton" />
</form>
