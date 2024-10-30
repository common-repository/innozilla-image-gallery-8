<?php

    /**
    * Description : Very simple Image Gallery with filter and load more
    * Package : Innozilla Image Gallery 8
    * Version : 1.0
    * Author : Innozilla
    */

function IIG8_isotope_gallery() {
	ob_start(); ?>

	<div class="IIG8_js_filter" id="">
		<?php $iig8_option = get_option( 'iig8_options' ); ?>
	   <button data-filter="*" class="is-active">
	   	<?php if ( $iig8_option['allover'] ) { echo $iig8_option['allover']; } else { echo 'All';  } ?>
		</button>

	   <?php
	    $args = array( 
				'post_type' => 'cs_gallery',
				'posts_per_page' =>-1
			);

			$loop = new WP_Query( $args ); 

			 while ( $loop->have_posts() ) : $loop->the_post(); 

			 		$Filter_title = get_the_title();
					$filter_slug = iig8_createSlug($Filter_title);
					$gallery = get_post_gallery( $loop->ID, false );
					$ids = explode( ",", $gallery['ids'] ); 
					$link   = wp_get_attachment_url( $id );

					if ($ids[0]) :  ?>
				    	<button data-filter=".<?php echo $filter_slug; ?>"><?php the_title(); ?></button>
					<?php endif;

 
	    endwhile; wp_reset_query();  ?>

	</div>

<?php 

			$args = array( 
				'post_type' => 'cs_gallery',
				'orderby'=>'rand',
				'posts_per_page' =>-1
			);
			$loop = new WP_Query( $args ); ?>
				
			<ul class="IIG8_list"><?php

				while ( $loop->have_posts() ) : $loop->the_post();

					$Filter_title = get_the_title();
					$filter_slug = iig8_createSlug($Filter_title);
					$gallery = get_post_gallery( $loop->ID, false );
					$ids = explode( ",", $gallery['ids'] ); 
					
					foreach( $ids as $id ) {

						$link  = wp_get_attachment_url($id);
						$caption = wp_get_attachment_caption($id); ?>
						
							<li class="IIG8_list__item <?php echo $filter_slug; ?> grid">

								<?php if ( $iig8_option['lbox'] == 1) { ?>
									<a href="<?php echo $link; ?>" data-lity data-title="<?php echo $caption; ?>">
								<?php } ?>
								<?php if ( $iig8_option['check1'] == 1) { ?>
								<figure class="effect-bubba">
									<img src="<?php echo $link; ?>">
									<figcaption>
										<h3><?php echo $caption; ?></h3>
									</figcaption>			
								</figure>
								<?php } else { ?>
									<img src="<?php echo $link; ?>">
								<?php } ?>
								<?php if ( $iig8_option['lbox'] == 1) { ?>
									</a>
								<?php } ?>
		
							</li>


					
					<?php }  

				endwhile; wp_reset_query();  ?>

			</ul>


	<?php
	wp_enqueue_script( 'isotop_min_iig8' );
	wp_enqueue_script( 'imagesloaded-pkgd_iig8' );
	wp_enqueue_script( 'filter_js_iig8' );
	wp_enqueue_script( 'infinite-scroll_ig8' );
	wp_enqueue_script( 'lightbox_ig8_js' );
	wp_enqueue_style('front_style_iig8');
	wp_enqueue_style('lightbox_ig8_style');
	$content = ob_get_contents();
	ob_end_clean();
	
    return $content;
}
add_shortcode('isotope_gallery', 'IIG8_isotope_gallery');