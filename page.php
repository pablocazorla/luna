<?php get_header(); ?>
<article id="page" class="page wrap clearfix">
	
		
	<section class="content">				
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section class="post box" id="post-<?php the_ID();?>">
			<header class="post-header clearfix">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_twitter"></a>
					<a class="addthis_button_pinterest_share"></a>
					<a class="addthis_button_google_plusone_share"></a>
					<a class="addthis_button_compact"></a>
					<a class="addthis_bubble_style"></a>
				</div>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9270a3495656e9"></script>
				<!-- AddThis Button END -->
				<h1><?php the_title(); ?></h1>
			</header>				
			<?php the_content(); ?>
		</section>
		<?php endwhile; endif; ?>				
	</section>
</article>
<?php get_footer(); ?>