<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<!doctype html>
<html>

<body>
	<div class="hero">
		<a href="lien-de-votre-page.html">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/header.webp" alt="Description de l'image">
		</a>
	</div>
	<section class="">
		<div class="filtres">
			<div class="dropdown">
				<button class="dropbtn">CATEGORIES</button>
				<div class="dropdown-content">
					<a href="#">Réception</a>
					<a href="#">Télévision</a>
					<a href="#">Concert</a>
					<a href="#">Mariage</a>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">FORMATS</button>
				<div class="dropdown-content">
					<a href="#">Paysage</a>
					<a href="#">Portrait</a>
				</div>
			</div>
		</div>
		<div class="filtres2">
			<div class="dropdown">
				<button class="dropbtn2">TRIER PAR</button>
				<div class="dropdown-content">
					<a href="#">Argentique</a>
					<a href="#">Numérique</a>
				</div>
			</div>
		</div>
	</section>
	<div class="grid">

	</div>
</body>

<?php
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'wp-content\themes\motaphoto-child\page.php' );
endwhile; // End of the loop.

get_footer();