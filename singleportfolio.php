<?php
/*
Template Name: SinglePortfolio
*/
?>
<?php
    $post = get_post($_POST['id']);
	$url = $_POST['urlpost'];
?>
<?php if ($post) : ?>
    <?php setup_postdata($post); ?>
    	<div class="work-image">
    		<?php if(has_post_thumbnail()): the_post_thumbnail('large'); endif; ?>
    	</div>
    	<div class="work-content">
	    	<header class="header-post clearfix">
				<h1><?php the_title(); ?></h1>
				<div class="category">
					Category: <?php the_category(', '); ?>					
				</div>
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="<?php echo $url;?>" addthis:title="<?php the_title(); ?>" addthis:description="<?php the_excerpt();?>" >
				<a class="addthis_button_facebook"></a>
				<a class="addthis_button_twitter"></a>
				<a class="addthis_button_pinterest_share"></a>
				<a class="addthis_button_google_plusone_share"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_bubble_style"></a>
				</div>
				<!-- AddThis Button END -->
			</header>
			<div class="content">
				<?php the_content(); ?>
			</div>
			<?php comments_template(); ?>
		</div>	
<?php endif; ?>