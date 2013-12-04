<?php get_header(); ?>
<script>pageID = "home";</script>
<article id="home">
	<section class="home-presentation wrap">
		<img src="<?php bloginfo('template_url'); ?>/img/home/3.jpg" id="home-img3" class="home-img"/>
		<img src="<?php bloginfo('template_url'); ?>/img/home/2.jpg" id="home-img2" class="home-img"/>
		<img src="<?php bloginfo('template_url'); ?>/img/home/1.jpg" id="home-img1" class="home-img"/>
		<img src="<?php bloginfo('template_url'); ?>/img/home/5.jpg" id="home-img5" class="home-img"/>		
		<img src="<?php bloginfo('template_url'); ?>/img/home/4.jpg" id="home-img4" class="home-img"/>		
		<div class="banner">
			<div class="banner-shadow on-top"></div>
			<div class="banner-content">
				<h1>I am illustrator and concept artist</h1>
				<p>I’m digital artist, fantasy illustrator, concept artist and designer.</p>
				<p>On my work you will find a great diversity: concept art for games, storyboards, web illustration, infographics, traditional painting, 3D images, books…</p>
			</div>
			<div class="banner-shadow on-bottom"></div>
		</div>		
	</section>
	
	<?php $category_id = get_cat_ID( 'Portfolio');
		  $category_link = get_category_link( $category_id );?>
	<section class="grey portfolio">
		<div class="wrap">
			<h1>Last in <a href="<?php echo esc_url( $category_link ); ?>">Portfolio</a></h1>
			<div class="gallery clearfix">
				<?php query_posts( array( 'category_name' => 'Portfolio', 'posts_per_page' => 3));
				while ( have_posts() ) : the_post();?>
				<figure>			
					<a href="<?php the_permalink(); ?>" class="open-work" rel="<?php the_ID();?>">
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
			</div>
		</div>		
	</section>	

	<?php $category_idb = get_cat_ID( 'Blog');
		  $category_linkb = get_category_link( $category_idb );?>
	<section class="wrap blog">		
		<h1>Last in <a href="<?php echo esc_url( $category_linkb ); ?>">Blog</a></h1>				
		<?php query_posts( array( 'category_name' => 'Blog', 'posts_per_page' => 2));
		while ( have_posts() ) : the_post();?>
		
		<div class="post-in-list clearfix" id="post-<?php the_ID();?>">
				<a href="<?php the_permalink(); ?>" class="thumbnail-link">				
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
					<div class="category">
						Category: <?php the_category(', '); ?>					
					</div>
					<?php the_excerpt(); ?>
					<p><a href="<?php the_permalink(); ?>">Read more &gt;</a></p>
				</div>
			</div>
		<?php endwhile;
		wp_reset_query();
		?>		
	</section>
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