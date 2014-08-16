<?php
/**
 * The single template file.
 *
 * This template displays single posts.
 *
 * @package worldview
 */
?>


<?php get_header(); ?>

    <section id="primary">
		<main id="main" class="site-main" role="main">

		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; endif; ?>
		<a id="viewers-link" title="Click to see a list of users who have viewed this page." href="" onclick="openWin();return false;">Viewers</a>

		</main><!-- #main -->
    </section>

<?php get_footer(); ?>