<?php
/**
 * The image attachment template file.
 *
 * This file is shown for all image attachments.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package worldview
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1120;

?>

<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>

				<div class="entry-content">

					<div class="entry-attachment">

						<!-- <nav id="image-navigation" class="navigation" role="navigation"> -->
						<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'worldview' ) ); ?></span>
						<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'worldview' ) ); ?></span>
						<!-- </nav> #image-navigation -->

						<div class="attachment">
<?php         /**
              * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
              * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
              */
              $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
              foreach ( $attachments as $k => $attachment ) :
                if ( $attachment->ID == $post->ID )
                break;
              endforeach;

              $k++;
              // If there is more than 1 attachment in a gallery
              if ( count( $attachments ) > 1 ) :
                if ( isset( $attachments[ $k ] ) ) :
                  // get the URL of the next image attachment
                  $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                else :
                  // or get the URL of the first image attachment
                  $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                endif;
              else :
                // or, if there's only 1 image, get the URL of the image
                $next_attachment_url = wp_get_attachment_url();
              endif; ?>
							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'worldview_attachment_size', array( 960, 960 ) );
							echo wp_get_attachment_image( $post->ID, $attachment_size );
							?></a>

							<?php //if ( ! empty( $post->post_excerpt ) ) : ?>
							<!-- <div class="entry-caption">
								<?php the_excerpt(); ?>
							</div> -->
							<?php //endif; ?>
						</div><!-- .attachment -->

					</div><!-- .entry-attachment -->

				</div><!-- .entry-content -->

				<div class="post-wrapper" id="image-post-wrapper">

					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<p></p>

					<div class="entry-description">
						
						<?php the_content(); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'worldview' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-description -->

					<footer class="entry-meta" style="margin-top: 30px;">
						<?php
							$metadata = wp_get_attachment_metadata();
							echo '<p>To see the original picture <a href="'.esc_url(wp_get_attachment_url()).'" target="_blank">click here</a>. To return to the album <a href="'.esc_url(get_permalink($post->post_parent )).'">click here</a>.';
							/*printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'worldview' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( wp_get_attachment_url() ),
								$metadata['width'],
								$metadata['height'],
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);*/
						?>
						<?php edit_post_link( __( 'Edit', 'worldview' ), '<span class="edit-link">', '</span>' ); ?>
					</p></footer><!-- .entry-meta -->
					<div class="" style="">
						<span class="previous-image"><p><?php previous_image_link( false, __( '&larr; Previous', 'worldview' ) ); ?></span>
						<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'worldview' ) ); ?></span>
					</div>
					<?php comments_template(); ?>

				</div><!-- .post-wrapper -->

			</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>