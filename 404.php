<?php get_header(); ?>
<article id="blog-post" class="blog wrap clearfix" currentmenu="blog">
	<section class="content">				
		<section class="post box" id="error-404">
			<header class="post-header clearfix">
				<h1>Error 404 - Page not found</h1>				
			</header>				
			<img src="<?php bloginfo('template_url'); ?>/img/error404.jpg" class="error404-img"/>
		</section>
	</section>			
	<aside class="sidebar">			
		<?php get_sidebar(); ?>	
	</aside>	
</article>
<?php get_footer(); ?>

