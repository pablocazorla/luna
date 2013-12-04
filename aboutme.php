<?php
/*
Template Name: About me
*/
?>

<?php get_header(); ?>
<script>pageID = "about-me";</script>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="about-me" class="page wrap clearfix">
	<header class="header-post clearfix">
		<h1><?php the_title(); ?></h1>
	</header>
		<figure class="about-me-image">
			<img src="<?php bloginfo('template_url'); ?>/img/aboutme.jpg">
		</figure>
		<div class="about-me-summary content">
			<?php the_content(); ?>
			<div class="contact-links clearfix">
				<a href="mailto:contact@pcazorla.com" class="email-link" target="_blank" title="Send me an e-mail to contact@pcazorla.com">contact@pcazorla.com</a>
				<a href="http://bit.ly/deviantart-pcazorla" class="deviantart-link" target="_blank" title="Find me on Deviant Art">Deviant Art</a>
				<a href="http://bit.ly/twitter-pcazorla" class="twitter-link" target="_blank" title="Follow me on Twitter">Twitter</a>
				<a href="http://bit.ly/google-pcazorla" class="googleplus-link" target="_blank" title="Follow me on Google+">Google Plus</a>
			</div>			
		</div>
		<?php endwhile; endif; ?>
</article>
<?php get_footer(); ?>