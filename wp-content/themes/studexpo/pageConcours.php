<?php
/*
Template Name: Page Concours
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
					<img src="http://www.stud-expo.fr/StudExpo/wp-content/themes/studexpo/img/temp/page8.jpg" width="100%" style="margin-bottom:30px;" />
					<img src="http://www.stud-expo.fr/StudExpo/wp-content/themes/studexpo/img/temp/page9.jpg" width="100%" style="margin-bottom:30px;" />
					<img src="http://www.stud-expo.fr/StudExpo/wp-content/themes/studexpo/img/temp/page10.jpg" width="100%" style="margin-bottom:30px;" />
					<img src="http://www.stud-expo.fr/StudExpo/wp-content/themes/studexpo/img/temp/page11.jpg" width="100%" style="margin-bottom:30px;" />
					
					<p style="font-family:'Drugs' !important;">
					<?php 

						if ( have_posts() ) : while( have_posts() ) : the_post();
					    the_content();
						endwhile; endif;
						
						?>
					</p>
					</br>
					<?php if($_SESSION['userRole']==null or $_SESSION['userRole']==1){ ?>
					<center>
					<button onclick="window.location='?page_id=41'" class="btn button-primary valider">Participer au concours</button>
					</center>
					
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- GALLERY -->
	</div>

<?php get_footer(); ?>