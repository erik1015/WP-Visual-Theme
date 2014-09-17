<div class="navigation clearfix">
<?php if ( is_single() ) { ?>
	<div class="alignleft">
		<?php previous_post_link('&laquo; %link'); ?>
	</div>
	<div class="alignright">
		<?php next_post_link('%link &raquo;'); ?>
	</div>
<?php } else { ?>
	<?php if ( function_exists('wp_pagenavi') ) { ?>
		<?php wp_pagenavi(); ?>
	<?php } else { ?>
		
		<?php
        //posts_nav_link();
        //global $wp_query;
        $big = 999999999; // need an unlikely integer
        $args = array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?page=%#%',
            'total' => $wp_query->max_num_pages,
            'current' => max( 1, get_query_var( 'paged') ),
            'show_all' => false,
            'end_size' => 3,
            'mid_size' => 2,
            'prev_next' => True,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;')
            );
        echo paginate_links($args);
    ?>
	<?php } ?>
<?php } ?>
</div>