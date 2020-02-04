<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package adamant
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'adamant' ); ?></a>

	<header id="masthead" class="site-header">

<div class="container">
<div class="logo">
	<a href="<?php echo home_url(); ?>"><?php the_header_image_tag(); ?></a>
</div>
<div class="navbar">
<div class="icon-bar" onclick="Show()">
    <i></i>
    <i></i>
    <i></i>
</div>

<?php wp_nav_menu(array(
	'theme_location'  => 'primary',
	'menu' => 'primary',
	'container_id'    => 'navigation',
	'menu_class'      => 'navmenu',
	'menu_id'         => 'nav-lists',
	'fallback_cb'     => 'wp_page_menu',
    'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="close"><span onclick="Hide()">×</span></li>%3$s</ul>'
	));?>
</div>
</div>

<script>
var navList = document.getElementById("nav-lists");
function Show() {
navList.classList.add("_Menus-show");
}

function Hide(){
navList.classList.remove("_Menus-show");
}
</script>

	<!-- banner slideshow -->
	<div id="slideshow">
	<?php
        $urls=explode(",", get_theme_mod('adamant_slideshow_images'));
        foreach($urls as $url) {
            if ($url != ''){
                echo "<img src='"."$url"."' class='slideshow' />";
            }
        }
        ?>
	</div>

	<script>
	var myIndex = 0;
	carousel();

	function carousel() {
	  var i;
	  var x = document.getElementsByClassName("slideshow");
	  for (i = 0; i < x.length; i++) {
	    x[i].style.display = "none";  
	  }
	  myIndex++;
	  if (myIndex > x.length) {myIndex = 1}    
	  x[myIndex-1].style.display = "block";  
	  setTimeout(carousel, 4000); // Change image every 2 seconds
	}
	</script>
	<!-- /banner slideshow -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
