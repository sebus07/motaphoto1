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
<h1>hello wolrd</h1>

</body>

<?php
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'wp-content\themes\motaphoto-child\page.php' );
endwhile; // End of the loop.

get_footer();