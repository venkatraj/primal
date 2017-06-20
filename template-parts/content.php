<?php
/**
 * @package Primal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		$featured_image = get_theme_mod( 'featured_image',true );
	    $featured_image_size = get_theme_mod ('featured_image_size','1');
		if( $featured_image &&  has_post_thumbnail() ) : ?>
			<div class="five columns"><?php
		        if ( $featured_image_size == '1' ) :?>	  	
						<div class="post-thumb">
						  <?php	if( $featured_image && has_post_thumbnail() ) : 
								    the_post_thumbnail('primal-blog-full-width');
			                endif;?>
			            </div> <?php
		        else: ?>
		 	            <div class="post-thumb">
		 	                 <?php if( has_post_thumbnail() && ! post_password_required() ) :   
					               the_post_thumbnail('primal-small-featured-image-width');
								endif;?>
			             </div>  <?php				
	            endif; ?>
	            </div><?php
		endif;


if( $featured_image && has_post_thumbnail() ) : ?>
   <div class="eleven columns">
<?php else: ?>
	<div class="sixteen columns">
<?php endif; ?>

	<div class="latest-content">
			<header class="entry-header">  
				<div class="title-meta">
					<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
					<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta">
						<span class="date-structure">				
							<span class="dd"><i class="fa fa-calendar"></i><?php the_time(get_option('date_format')); ?></span>			
						</span>
						<?php primal_author(); ?>
						<?php primal_comments_meta(); ?> 
						<?php primal_edit() ?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
				</div>
		    </header><!-- .entry-header -->

		<div class="entry-content">   
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Read More', 'primal' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>  

			
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
	</div>
</div>

<br style="clear:both;">   

</article><!-- #post-## -->