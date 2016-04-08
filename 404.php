<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 


wp_redirect(home_url("/client-dashboard"));  
?>
 
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
				</header><!-- .page-header -->

			</section><!-- .error-404 -->

		</main><!-- .site-main -->

		<?php #get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->

<?php # get_sidebar(); ?>
<?php #get_footer(); ?>
