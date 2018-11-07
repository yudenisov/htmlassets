<?php
/**
 * Template Theme functions and definitions
 *
 * Установка некоторых вспомогательных функций, которые нужны при настройке 
 * некоторых дополнительных функций в теме. Использует хуки WordPress.
 *
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage template_theme_0001_
 * @since template_theme_0001_ 1.0
 */


if ( ! function_exists( 'template_theme_0001__fonts_url' ) ) :
/**
 * Register Google fonts for template_theme_0001_.
 * Регистрирует Google Fonts для заданной темы
 *
 * @since template_theme_0001_ 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function template_theme_0001__fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'template_theme_0001_' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'template_theme_0001_' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'template_theme_0001_' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'template_theme_0001_' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since template_theme_0001_ 1.1
 */
function template_theme_0001__javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'template_theme_0001__javascript_detection', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @since template_theme_0001_ 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function template_theme_0001__resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'template_theme_0001_-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'template_theme_0001__resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 * Определение скриптов и стилей
 *
 * @since template_theme_0001_ 1.0
 */
function template_theme_0001__scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'template_theme_0001_-fonts', template_theme_0001__fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

// Before placed specific theme css

/* This placed bootstrap & others templates Styles
********************************************/

	// Add bootstrap styles
	wp_enqueue_style( 'template_theme_0001_-bootstrap-style', '/assets/bootstrap/css/bootstrap.min.css');

	// Add Font Awesome styles
	wp_enqueue_style( 'template_theme_0001_-fontawesome-style', '/assets/fontawesome/css/fontawesome.min.css');

	// Add Cyrillic Fonts styles
	wp_enqueue_style( 'template_theme_0001_-fontArialBlack-style', '/assets/fonts/fontArialBlack.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontArialNarrow-style', '/assets/fonts/fontArialNarrow.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontCalibri-style', '/assets/fonts/fontCalibri.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontImpact-style', '/assets/fonts/fontImpact.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontPTSans-style', '/assets/fonts/fontPTSans.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontTahoma-style', '/assets/fonts/fontTahoma.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontTrebuchetMS-style', '/assets/fonts/fontTrebuchetMS.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontVerdana-style', '/assets/fonts/fontVerdana.css', array(), '4.0' );

	// Add MapInfo Fonts Style
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoArrows-style', '/assets/fontMapinfo/fontMapInfoArrows.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoCartographic-style', '/assets/fontMapinfo/fontMapInfoCartographic.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoMiscellaneous-style', '/assets/fontMapinfo/fontMapInfoMiscellaneous.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoOil&Gas-style', '/assets/fontMapinfo/fontMapInfoOil&Gas.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoRealEstate-style', '/assets/fontMapinfo/fontMapInfoRealEstate.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoSymbols-style', '/assets/fontMapinfo/fontMapInfoSymbols.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoTransportation-style', '/assets/fontMapinfo/fontMapInfoTransportation.css', array(), '4.0' );
	wp_enqueue_style( 'template_theme_0001_-fontMapInfoWeather-style', '/assets/fontMapinfo/fontMapInfoWeather.css', array(), '4.0' );

/*  The End of Placed Styles */

	// Load our main stylesheet.
	wp_enqueue_style( 'template_theme_0001_-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'template_theme_0001_-ie', get_template_directory_uri() . '/css/ie.css', array( 'template_theme_0001_-style' ), '20141010' );
	wp_style_add_data( 'template_theme_0001_-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'template_theme_0001_-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'template_theme_0001_-style' ), '20141010' );
	wp_style_add_data( 'template_theme_0001_-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'template_theme_0001_-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'template_theme_0001_-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'template_theme_0001_-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'template_theme_0001_-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'template_theme_0001_' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'template_theme_0001_' ) . '</span>',
	) );
/* This placed bootstrap & others templates Scripts
***************************************************/

// Add HRML5shiv & Response Scripts
	wp_enqueue_script( 'template_theme_0001_-html5shiv-script', '/assets/js/html5shiv.js' );
	wp_enqueue_script( 'template_theme_0001_-respond-min-script', '/assets/js/respond.min.js' );

// Add jQuery Framework
	wp_enqueue_script( 'template_theme_0001_-jQuery-script', '/assets/jQuery/jquery-3.3.1.min.js' );

// Add Bootstrap Scripts
	wp_enqueue_script( 'template_theme_0001_-bootstrap-script', '/assets/bootstrap/js/bootstrap.min.js' );

/*  The End of Placed Scripts */

}
add_action( 'wp_enqueue_scripts', 'template_theme_0001__scripts' );

