<?php
/*
Template Name: contact
*/
get_header();
function getSliderHTML(){
	global $wpdb;
		$sliders = $wpdb->get_results("SELECT id,image,titre,soustitre,url FROM ste_slider ORDER BY id");
		foreach ($sliders as $slider){
			echo "<div style='background-image: url(./wp-content/plugins/GestionContenu/".$slider->image.")' class='swiper-slide'>";
			echo "		<a href='".$slider->url."' class='swiper-slide__link'>";
			echo "			<div class='swiper-slide__title'>";
			echo "			<h4>".$slider->titre."<small>".$slider->soustitre."</small></h4>";
			echo "			</div>";
			echo "		</a>";
			echo "</div>";
		}
}
 ?>

	<div class="page page-index">
		<!-- SLIDER -->
		<div class="swiper-container slider page-index__slider">
			<a href="" class="btn btn-default slider__next"><i class="fa fa-forward"></i></a>
			<a href="" class="btn btn-default slider__prev"><i class="fa fa-backward"></i></a>
			<div class="swiper-wrapper">
				
				 <?php 
					getSliderHTML();
				?>
			</div>
		</div>
		<div class="swiper-pagination"></div>
		<!-- END SLIDER -->
		<div class="introduction">
			<div class="container">
				<div class="bloc-notif">
					<button class="view-more">Plus +</button>
					<h2>Titre du bloc</h2>
					<p>
						Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.
						Quod cum ita sit, paucae domus studiorum seriis cultibus antea celebratae nunc ludibriis ignaviae torpentis exundant, vocali sonu, perflabili tinnitu fidium resultantes. denique pro philosopho cantor et in locum oratoris doctor artium ludicrarum accitur et bybliothecis sepulcrorum ritu in perpetuum clausis organa fabricantur hydraulica, et lyrae ad speciem carpentorum ingentes tibiaeque et histrionici gestus instrumenta non levia.
					</p>
				</div>
			</div>
			<div class="container">
				<div class="container-bloc row">
					<div class="index-bloc span">
						<a href="?page_id=13">
							<div class="icon">
								<i class="fa fa-university"></i>
							</div>
							<h3>EXPOSER</h3>
							<p>
								Rencontrez de nouveaux clients, valorisez vos services et votre savoir-faire auprès des associations étudiantes. 
							</p>
							<button class="read-more">En savoir +</button>
						</a>
					</div>
					<div class="index-bloc span2">
						<a href="?page_id=19">
							<div class="icon">
								<i class="fa fa-graduation-cap"></i>
							</div>
							<h3>VISITER</h3>
							<p>
								Visitez Stud'Expo pour découvrir les nouveautés et l'ensemble des services disponibles pour dynamiser vos campus.
							</p>
							<button class="read-more">En savoir +</button>
						</a>
					</div>
					<div class="index-bloc span2">
						<a href="?page_id=17">
							<div class="icon">
								<i class="fa fa-trophy"></i>
							</div>
							<h3>CONCOURS</h3>
							<p>
								Stud'Trophy, le premier concours au service des étudiants mettant en compétition l'ensemble des associations étudiantes de 8 régions.
							</p>
							<button class="read-more">En savoir +</button>
						</a>
					</div>
					<div class="index-bloc span2">
						<a href="?page_id=15">
							<div class="icon">
								<i class="fa fa-briefcase"></i>
							</div>
							<h3>PARTENARIAT</h3>
							<p>
								Soutenez Stud'Expo et les associations étudiantes françaises en s'appliquant et en devenant partenaires d'un événement exclusif.
							</p>
							<button class="read-more">En savoir +</button>
						</a>
					</div>
				</div>
			</div>	
		</div>
		<div class="content">
			<div class="container-text">
				<div class="container">
					<h2>Les partenaires</h2>
					<p></p>
				</div>
				<div class="container-slider">
					<div class="slider-diapo">
						<div id="owl-demo">
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						  <div class="item"><center><h1>LOGO</h1></center></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="last-container">
			<div class="last-container-content">
				<div class="left">
					<div class="row-intro">
						<h3>Pourquoi Stud'Expo ?</h3>
						<ul class="why-us">
							<li>
								<a href="">
									1ère plateforme d'échanges
								</a>
							</li>
							<li>
								<a href="">
									Prestations clefs en main
								</a>
							</li>
							<li>
								<a href="">
									Gain de temps
								</a>
							</li>
							<li>
								<a href="">
									Une rencontre d'envergure
								</a>
							</li>
							<li>
								<a href="">
									1er concours inter-asso
								</a>
							</li>
							<li>
								<a href="">
									Centraliser l'information
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="center">
					<div class="center-text">
						<p>
							1er rendez-vous inédit de la profession pour se rencontrer, négocier, échanger et comprendre tous les
							aspects du marché, apporte une vision des prestations à 360° couvrant ainsi tous les besoins
							envisageables : Voyages, Gala, Partenariats…<br /><br />
							Stud'Expo – Le salon professionnel des associations étudiantes se déroulera le 21
							novembre rentrée 2015 à Paris, au Parc des expositions de la porte de Champerret en partie privatisé (Hall
							A) pour l’occasion.
						</p>
						<div class="container-skills">
							<div class="bloc-skills">
								<span class="num">234</span>
								<span class="attr">Visiteurs</span>
							</div>
							<div class="bloc-skills">
								<span class="num">124</span>
								<span class="attr">Participants</span>
							</div>
							<div class="bloc-skills">
								<span class="num">49</span>
								<span class="attr">Stands</span>
							</div>
							<div class="bloc-skills">
								<span class="num">100</span>
								<span class="attr">Associations</span>
							</div>
						</div>

					</div>
					<div class="counter">
						<div class="row-intro">

						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- GALLERY -->
	</div>


<?php get_footer(); ?>