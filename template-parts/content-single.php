<?php
/**
 * @package Primal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	$single_featured_image = get_theme_mod( 'single_featured_image',true );
	$single_featured_image_size = get_theme_mod ('single_featured_image_size','1');
	if ( $single_featured_image &&  has_post_thumbnail() ) :
	    if ( $single_featured_image_size == '1' ) :?>
	 		<div class="post-thumb"><?php  
		 	    if( has_post_thumbnail() && ! post_password_required() ) :   
					the_post_thumbnail('primal-blog-large-width'); 		
				endif;?>
			</div><?php
		else: ?>
		 	<div class="post-thumb"><?php
			 	if( has_post_thumbnail() && ! post_password_required() ) :   
						the_post_thumbnail('primal-small-featured-image-width');
				endif;?>
			</div><?php
	    endif; 
	endif ?>

	<header class="entry-header"> 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		    <div class="entry-meta">
				<span class="date-structure">				
					<span class="dd"><i class="fa fa-calendar"></i><?php the_time(get_option('date_format')); ?></span>	
				</span>
				<?php primal_author(); ?>
				<?php primal_comments_meta(); ?> 
				<?php primal_edit() ?>
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
    <?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'primal' ),
			'after'  => '</div>',
		) );
	?>

	<?php if ( 'post' == get_post_type() ): ?>
		<footer class="entry-footer">
			<?php primal_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif;?>

	<?php primal_post_nav(); ?>
</article><!-- #post-## -->
