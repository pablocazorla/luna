<?php
/*
Template Name: About me
*/
?>

<?php get_header(); ?>
<article id="page" class="page wrap clearfix about-me" currentmenu="about me">		
	<section class="content">				
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section class="post box clearfix" id="post-<?php the_ID();?>">
			<header class="post-header clearfix">
				<h1><?php the_title(); ?></h1>
			</header>
			<figure class="about-me-image">
				<img src="<?php bloginfo('template_url'); ?>/img/aboutme.jpg">
			</figure>
			<div class="about-me-summary">
				<?php the_content(); ?>
				<div class="contact-links clearfix">
					<a href="http://bit.ly/google-pcazorla" class="googleplus-link bubble" target="_blank" rel="Follow me on Google+">Google Plus</a>
					<a href="http://bit.ly/twitter-pcazorla" class="twitter-link bubble" target="_blank" rel="Follow me on Twitter">Twitter</a>
					<a href="http://bit.ly/deviantart-pcazorla" class="deviantart-link bubble" target="_blank" rel="Find me on Deviant Art">Deviant Art</a>
					<a href="mailto:contact@pcazorla.com" class="email-link bubble" target="_blank" rel="Send me an e-mail to contact@pcazorla.com">contact@pcazorla.com</a>
				</div>			
			</div>			
		</section>
		<?php endwhile; endif; ?>				
	</section>
</article>
<?php get_footer(); ?>