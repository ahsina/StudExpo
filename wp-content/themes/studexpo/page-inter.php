<?php
/*
Template Name: Page intermédiaire
*/
get_header(); ?>

	<div class="page page-index">
		<div class="header-page">
			<div class="title">
				<h1><?php echo get_the_title(); ?></h1>
			</div>
		</div>
		<div class="content-inter">
			<div class="container-content">
				<div class="container">
					<p style="font-family:'Drugs' !important;">
					<?php 

						if ( have_posts() ) : while( have_posts() ) : the_post();
					    the_content();
						endwhile; endif;
						
						?>
					</p>
				</div>
			</div>
		</div>
		<!-- GALLERY -->
	</div>

<?php get_footer(); ?>