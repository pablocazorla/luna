<?php get_header(); ?>
<script>portfolioGrid = true;</script>
<article id="home">
	<section class="presentation">
		<?php $category_id = get_cat_ID( 'Portfolio');
		    $category_link = get_category_link( $category_id );?>
		
		<h1>I am <a href="<?php echo esc_url( $category_link ); ?>" class="ill">illustrator</a> and <a href="<?php echo esc_url( $category_link ); ?>" class="con">concept artist</a></h1>
		<div class="brush">
			<img src="<?php bloginfo('template_url'); ?>/img/brush.jpg"/>
		</div>
		<p>I’m digital artist, fantasy illustrator, concept artist and designer.</p>
<p>On my work you will find a great diversity: concept art for games, storyboards, web illustration, infographics, traditional painting, 3D images, books…</p>
	</section>
	<div class="wrap portfolio">
		<hr/>
		<h2>Last in <a href="<?php echo esc_url( $category_link ); ?>">portfolio</a></h2>
		<section class="gallery clearfix" id="gallery">
			<?php query_posts( array( 'category_name' => 'Portfolio', 'posts_per_page' => 4));
			while ( have_posts() ) : the_post();?>
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
			<?php endwhile;
			wp_reset_query();
			?>
		</section>
	</div>

	<div class="wrap blog" id="blog-list">
		<hr/>
		<?php $category_idb = get_cat_ID( 'Blog');
		    $category_linkb = get_category_link( $category_idb );?>
		<h2>Last in <a href="<?php echo esc_url( $category_linkb ); ?>">blog</a></h2>
		<section class="clearfix">		
			<?php query_posts( array( 'category_name' => 'Blog', 'posts_per_page' => 3));
			while ( have_posts() ) : the_post();?>
			<div class="post box" id="post-<?php the_ID();?>">
				<a href="<?php the_permalink(); ?>" class="link-image">
					<span class="hover"></span>
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
			<?php endwhile;
			wp_reset_query();
			?>
		</section>
	</div>

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