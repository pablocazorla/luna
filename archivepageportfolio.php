<?php get_header(); ?>
<script>portfolioGrid = true;</script>
<?php $cat_name = single_cat_title('',false);?>
<header class="page-header wrap portfolio clearfix">
	<h1><?php echo $cat_name; ?></h1>
	<?php 
	if($cat_name == "Portfolio"){
	wp_nav_menu(array('menu' => 'Tertiary' ));
	}else{
		$category_id = get_cat_ID( 'Portfolio');
		$category_link = get_category_link( $category_id );
		echo "<div class=\"menu\"><a href=\"".$category_link."\">back to Portfolio</a></div>";
	}?>
</header>

<article id="portfolio-list" class="wrap portfolio" currentmenu="portfolio">
	<section class="gallery clearfix" id="gallery">
		<?php if (have_posts()) :?>
		<?php while (have_posts()) : the_post(); ?>	    
		<figure class="box">			
			<a href="<?php the_permalink(); ?>" class="explain-work open-work" rel="<?php the_ID();?>">
				<span class="hover"></span>
				<?php if(has_post_thumbnail()): the_post_thumbnail('portfolio-thumb'); endif; ?>	
			</a>									
			<figcaption>
				<h2><a href="<?php the_permalink(); ?>" class="open-work" rel="<?php the_ID();?>"><?php the_title(); ?></a></h2>
				<div class="categories"><?php the_category(', '); ?></div>
			</figcaption>						
		</figure>	   
		<?php endwhile; ?>
		<?php else :?>
		<h2>Sorry, works not found</h2>
		<?php endif; ?>
	</section>	
	<?php if (show_posts_nav()) : ?>
		<nav class="navPages">		
			<?php global $wp_query;
			$big = 999999999; // need an unlikely integer		
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => 'Prev',
				'next_text' => 'Next'
			) );
			?>
		</nav>
	<?php endif; ?>	
</article>

<div class="item-back item-show" style="display:none">
	<div id="item-dimmer" class="close-work"></div>
	<div class="item-header">
		<div class="item-header-content wrap">
			<span class="close-work x box"></span>
		</div>
	</div>
	<div class="item wrap">	
		<div id="item-content" class="content-portfolio box">
			<div class="loading">Loading...</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>