<?php get_header(); ?>
<div class="main-heading text-center">
	<h1 style="text-align: left;"><?php the_title(); ?></h1>
</div>
<section>
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php title(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>