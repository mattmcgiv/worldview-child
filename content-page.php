<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package worldview
 */
?>
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		if ( has_post_thumbnail( get_the_ID() ) ) { ?>

		<header class="post-header <?php echo worldview_has_post_thumbnail(); ?>"<?php echo worldview_get_post_featured_image_bg( get_the_ID() ); ?>>
				<div class="inner">
					<div class="text">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</div>
				</div>
			</header>
	<?php		
		} else {
			$mvmem_the_title = get_the_title();
			echo "<header>
				<div class='inner'>
					<div class='text'>
						<h1 class='entry-title'>$mvmem_the_title</h1>
					</div>
				</div>
			</header>";
		}
	?>
		

		<div class="split-view">

			<div class="content-view">

				<div class="entry-content">

					<?php the_content( __('Read Full Article','worldview') ); ?>

				</div><!--.entry-content-->

				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'worldview' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

				<?php if( comments_open() ) comments_template(); ?>

			</div><!--.content-view-->

		</div><!--.split-view-->

	</article>