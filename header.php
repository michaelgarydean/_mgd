<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package michael-gary-dean
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_mgd' ); ?></a>

	<header id="masthead" class="site-header">
			<div class="site-header-main">
				<div class="site-branding">
					<div class="wrapper">
						<div id="site-details">
							<?php if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title" class="underline"><a href="<?php echo esc_url( get_option( '_mgd_site_title_link', 'home_url( '/' )' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title" class="underline"><a href="<?php echo esc_url( get_option( '_mgd_site_title_link', home_url( '/' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
							endif; ?>
						</div><!-- #site-details -->
					</div><!-- .wrapper -->
				</div><!-- .site-branding -->
			</div><!-- .site-header-main -->


			<div id="site-header-menu" class="site-header-menu">
				<div class="wrapper">
					<?php if ( has_nav_menu( 'menu-1' ) ) : ?>

						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php
								wp_nav_menu( array(
										'container'      => '',
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
										'menu_class'     => 'menu nav-menu',
									)
								);
							?>

					<?php else : ?>

						<nav id="site-navigation" class="main-navigation default-page-menu" role="navigation">
							<?php wp_page_menu(
								array(
									'menu_class' => 'primary-menu-container',
									'before'     => '<ul id="menu-primary-items" class="menu nav-menu">',
									'after'      => '</ul>',
								)
							); ?>

					<?php endif; ?>

					</nav><!-- .main-navigation -->
				</div><!-- .wrapper -->
			</div><!-- .site-header-menu -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
