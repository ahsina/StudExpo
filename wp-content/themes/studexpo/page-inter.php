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
					<h2>Insere ton texte ma gueule !</h2>
					<p>j'ai dit ton texte ma gueule !</p>
					<?php echo get_content(); ?>
				</div>
			</div>
		</div>
		<!-- GALLERY -->
	</div>

<?php get_footer(); ?>