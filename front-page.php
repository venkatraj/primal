<?php
/**
 * The front page template file.
 *
 *
 * @package Primal
 */
 
if ( 'posts' == get_option( 'show_on_front' ) ) { 
	get_template_part('index');
} else {

	 
    get_header(); 

	$slider_cat = get_theme_mod( 'slider_cat', '' );
	$slider_count = get_theme_mod( 'slider_count', 5 );   
	$slider_posts = array(   
		'cat' => absint($slider_cat),
		'posts_per_page' => intval($slider_count)              
	);

	$home_slider = get_theme_mod('slider_field',true); 
	if( $home_slider ):
	if ( $slider_cat ) {
		$query = new WP_Query($slider_posts);        
		if( $query->have_posts()) : ?>
			<div class="flexslider">  
				<ul class="slides">
					<?php while($query->have_posts()) :
							$query->the_post();
							if( has_post_thumbnail() ) : ?>
							    <li>
							    	<div class="flex-image">
							    		<?php the_post_thumbnail('full'); ?>
							    	</div>
							    	<div class="flex-caption">
							    		<?php the_content( __('Read More','primal') ); ?>
							    	</div>
							    </li>
						    <?php endif;?>			   
					<?php endwhile; ?>
				</ul>
			</div>
	
		<?php endif; ?>
	   <?php  
		$query = null;
		wp_reset_postdata();
		
	}else{	?>	
		<span class="home-divider"></span><?php	  	
    } 
    endif; ?>
		
	<div id="content" class="site-content">
		<div class="container">
			<main id="main" class="site-main" role="main"><?php
			
	            if( get_theme_mod('enable_recent_post_service',true) ) :
				   	do_action('primal_recent_post_before');
					primal_recent_posts(); 
				    do_action('primal_recent_post_after');
			    endif;

			    if( get_theme_mod('enable_home_default_content',false ) ) {  
					while ( have_posts() ) : the_post();       
						the_content();
					endwhile;
			    } ?>
		    </main><!-- #main -->
	    </div><!-- #primary -->
    </div>

    <?php  get_footer();

}
