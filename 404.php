<?php get_header(); ?>
<script>pageID = "blog-post";</script>
<article class="blog wrap">
	<section class="blog-post" id="error-404">
		<header class="header-post clearfix">
			<h1>Error 404 - Page not found</h1>			
		</header>
		<div class="content">
			<img src="<?php bloginfo('template_url'); ?>/img/error404.jpg" class="error404-img size-full"/>
		</div>		
	</section>
	<aside class="sidebar on-blog-post">			
		<?php get_sidebar(); ?>	
	</aside>	
</article>
<?php get_footer(); ?>