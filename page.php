<?php get_header(); ?>
<script>pageID = "page";</script>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="page wrap clearfix">	
	<header class="header-post clearfix">
		<h1><?php the_title(); ?></h1>
	</header>
	<div class="content">			
		<?php the_content(); ?>
	</div>
	<?php endwhile; endif; ?>
</article>
<?php get_footer(); ?>