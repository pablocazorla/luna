<?php get_header(); ?>
<?php $cat_name = single_cat_title('',false);?>
<script>pageID = "portfolio-list";</script>
<article id="portfolio">
	<header class="wrap clearfix">
		<h1><?php echo $cat_name; ?></h1>		
		<?php 
		wp_nav_menu(array('menu' => 'Tertiary' ));		
		if($cat_name != "Portfolio"){
			$category_id = get_cat_ID( 'Portfolio');
			$category_link = get_category_link( $category_id );
			echo "<div class=\"menu-tertiary-container\"><ul class=\"menu\"><li><a href=\"".$category_link."\">All</a></li></ul></div>";
		}			
		?>		
	</header>
	
	<div class="grey portfolio">
		<div class="wrap">
			<section class="gallery clearfix" id="gallery">
				<?php if (have_posts()) :?>
				<?php while (have_posts()) : the_post(); ?>	    
				<figure>			
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
		</div>		
	</div>
	
	<?php if (show_posts_nav()) : ?>
	<nav class="navPages wrap">		
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
<div id="modal-portfolio">
	<div class="dimmer close"></div>
	<div id="modal-portfolio-content">
		<div class="loading">
			<img src="<?php bloginfo('template_url'); ?>/img/loading.gif" width="48" height="38"/><br>Loading
		</div>
		<div class="close closebutton"></div>
		<div id="work"></div>
	</div>	
</div>
<?php get_footer(); ?>