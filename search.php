<?php get_header(); ?>
<header class="page-header wrap">
	<h1>Results for <i><?php echo $s; ?></i></h1>	
</header>
<article id="blog-list" class="blog search-results wrap">	
	<section class="content clearfix">		
		<?php if (have_posts()) :?>
		<?php while (have_posts()) : the_post(); ?>
		<div class="post box" id="post-<?php the_ID();?>">
			<a href="<?php the_permalink(); ?>" class="link-image">
			<?php if(has_post_thumbnail()){
				the_post_thumbnail('thumbnail');
			}else{ ?>
				<img src="<?php bloginfo('template_url'); ?>/img/default-blog-thumbnail.jpg" />
			<?php } ?>
			</a>			
			<div class="summary">
				<h2>
					<a href="<?php the_permalink(); ?>">					
						<?php the_title(); ?>
					</a>
				</h2>
				<?php the_excerpt(); ?>
				<div class="category">
					<?php the_category(', '); ?>					
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		<?php else :?>
			<div class="box not-found">
				<h2>Sorry, nothing found related to <i><?php echo $s; ?></i>.</h2>
			</div>		
		<?php endif; ?>
		
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
	</section>
	<aside class="sidebar">			
		<?php get_sidebar(); ?>	
	</aside>		
</article>
<?php get_footer(); ?>