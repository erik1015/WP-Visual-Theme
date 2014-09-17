<div class="featured-tabs clearfix">

	<ul class="flextabs-custom-controls clearfix">
		<li class="tab-pop firstab"><a href="#tabs-popular"><?php _e("Popular", "solostream"); ?><span></span></a></li>
		<li class="tab-recent"><a href="#tabs-recent"><?php _e("Recent", "solostream"); ?><span></span></a></li>
		<li class="tab-comments"><a href="#tabs-comments"><?php _e("Comments", "solostream"); ?><span></span></a></li>
		<li class="tab-archives lastab"><a href="#tabs-archives"><?php _e("Archives", "solostream"); ?><span></span></a></li>
	</ul>

	<div id="flextabs" class="flextabs clearfix">

		<ul class="slides clearfix">

			<!-- POPULAR POSTS SLIDE -->
    			<li class="popular-slide clearfix">
				<?php if ( function_exists('get_mostpopular') ) : ?>
					<?php get_mostpopular(array(
						"range" => "weekly",
						"post_type" => "post",
						"limit" => "5",
						"order_by" => "avg",
						"thumbnail_width" => "100",
						"thumbnail_height" => "100",
						"excerpt_length" => "100",
						"post_start" => "<li><div class='pop-excerpt'>",
						"post_end" => "</div></li>",
						"do_pattern" => "1",
						"pattern_form" => "{image} {title}<br />{summary}",
						"post_html" => "<li><div class='pop-excerpt'>{image} {title}<br />{summary}</div></li>"
					)); ?>
				<?php else : ?>
					<ul><li><?php _e("This feature has not been activated yet.", "solostream"); ?></li></ul>
				<?php endif; ?>
			</li>

			<!-- RECENT POSTS SLIDE -->
    			<li class="recent-slide clearfix">
				<ul>
					<?php
						$numposts = 5;
						$my_query = new WP_Query(array('showposts' => $numposts));
						while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<li>
								<div class="pop-excerpt">
									<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
									<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark"); ?>" title="<?php _e("Permanent Link to"); ?> <?php the_title(); ?>"><?php the_title(); ?></a>
									<?php the_excerpt(); ?>
								</div>
							</li>
						<?php
					endwhile; ?>
				</ul>
			</li>

			<!-- RECENT COMMENTS SLIDE -->
    			<li class="comment-slide clearfix">
				<?php
					$comments = get_comments(array('status' => 'approve','number' => '5'));
					$output = "\n<ul>";
					foreach ($comments as $comment) {
						$comment_text = strip_tags($comment->comment_content);
						$num_words = 10;
						$blah = explode(' ', $comment_text);
						if (count($blah) > $num_words) {
							$k = $num_words;
							$use_dotdotdot = 1;
						} else {
							$k = count($blah);
							$use_dotdotdot = 0;
						}
						$excerpt = '';
						for ($i=0; $i<$k; $i++) { $excerpt .= $blah[$i] . ' '; }
						$excerpt .= ($use_dotdotdot) ? '[...]' : '';
						$output .= "\n<li><div class='pop-excerpt'>" . get_avatar($comment,'72') . strip_tags($comment->comment_author) ."<br /><a href=\"" . get_permalink($comment->comment_post_ID)."#comment-" . $comment->comment_ID . "\">" . strip_tags($excerpt)."</a></div></li>";
					}
					$output .= "\n</ul>";
					echo $output;
				?>
			</li>

			<!-- ARCHIVES SLIDE -->
    			<li class="archive-slide clearfix">
				<ul>
					<li class="clearfix">
						<select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
							<option value=""><?php echo esc_attr(__('Select a Month', 'solostream')); ?></option>
							<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
						</select>
						<noscript><input type="submit" value="<?php _e("Go", "solostream"); ?>" /></noscript>
					</li>
					<li class="clearfix">
						<form action="<?php bloginfo('url'); ?>/" method="get">
							<?php $select = wp_dropdown_categories('show_option_none=' . __('Select a Category', 'solostream') .'&show_count=1&orderby=name&echo=0&hierarchical=1&id=catdrop');
							$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
							echo $select;
							?>
							<noscript><input type="submit" value="<?php _e("Go", "solostream"); ?>" /></noscript>
						</form>
					</li>
					<li class="clearfix">
						<select name="tag-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
							<option value=""><?php echo esc_attr(__('Select a Tag', 'solostream')); ?></option>
							<?php $posttags = get_tags('orderby=count&order=DESC&number=50'); ?>
							<?php if ($posttags) {
								foreach($posttags as $tag) {
									echo "<option value='";
									echo get_tag_link($tag);
									echo "'>";
									echo $tag->name;
									echo " (";
									echo $tag->count;
									echo ")";
									echo "</option>"; }
							} ?>
						</select>
						<noscript><input type="submit" value="<?php _e("Go", "solostream"); ?>" /></noscript>
					</li>
				</ul>
			</li>

		</ul>

	</div>

</div>