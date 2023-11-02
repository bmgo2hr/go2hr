<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );
		add_image_size('cp_logo', 266, 150, TRUE);
  		add_image_size('cp_logo_no_crop', 250, 150);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'top'  => esc_html__( 'Top menu', 'twentytwentyone' ),
				'about'  => esc_html__( 'About menu', 'twentytwentyone' ),
				'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),


			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_false' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentytwentyone' );
	}
endif;


/*Custome Code Start*/

/* Resource Post Type Start */
function create_posttype() {

 /* Hr Consultant Custom Post Type Start */
 register_post_type( 'hr-consultant',
array(
  'labels' => array(
   'name' => __( 'HR Consultants' ),
   'singular_name' => __( 'HR Consultant' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'hr-consultant'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt'),
 )
 );

 /* Region Custom Post Type Start */
 register_post_type( 'region',
array(
  'labels' => array(
   'name' => __( 'Regions' ),
   'singular_name' => __( 'Region' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'region'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt'),
 )
 );

 /* Our Coaches Custom Post Type Start */
 register_post_type( 'our-coaches',
array(
  'labels' => array(
   'name' => __( 'Our Coaches' ),
   'singular_name' => __( 'Our Coaches' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'our-coaches'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt'),
 )
 );

 /* Team Custom Post Type Start */
 register_post_type( 'team',
array(
  'labels' => array(
   'name' => __( 'Our Team' ),
   'singular_name' => __( 'Our Team' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'team'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt'),
 )
 );

 /* Board Custom Post Type Start */
 register_post_type( 'board',
array(
  'labels' => array(
   'name' => __( 'Our Board' ),
   'singular_name' => __( 'Our Board' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'board'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt'),
 )
 );


 /* RESEARCH Post Type Start */
 register_post_type( 'research',
array(
  'labels' => array(
   'name' => __( 'Research' ),
   'singular_name' => __( 'Research' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'research'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt','page-attributes'),
 )
 );

 /* STRATEGY Post Type Start */
 register_post_type( 'strategy',
array(
  'labels' => array(
   'name' => __( 'Strategy' ),
   'singular_name' => __( 'Strategy' )
  ),
  'public' => true,
  'has_archive' => false,
  'query_var' => true,
  'rewrite' => array('slug' => 'strategy'),
  'hierarchical' => false,
  'supports' => array('title','editor','thumbnail','excerpt'),
 )
 );

}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
/* Custom Post Type End */


/* Custom Taxonomy of hr consultant Start */
 function hrc_taxonomies(){

 $labels = array(
    'singular_name'     => _x( 'HRC Type', 'taxonomy singular name' ),
    'name'              => _x( 'HRC Type', 'taxonomy general name' ),
    );

 $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'hr_type', 'hr-consultant', $args );
}
add_action( 'init', 'hrc_taxonomies', 0 );

/* Custom Taxonomy of event Start */
 function event_taxonomies(){

 $labels = array(
    'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
    'name'              => _x( 'Event Type', 'taxonomy general name' ),
    );

 $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'event_type', 'event', $args );
}
add_action( 'init', 'event_taxonomies', 0 );

/* Custom Taxonomy End */

/* Hook to Create Admin setting Area fields */

function register_fields() {

    register_setting('general', 'footer_1', 'esc_attr');
    add_settings_field('footer_1', '<label for="footer_1">' . __('Footer Heading 1 :', 'footer_1') . '</label>', 'print_first_field', 'general');

    register_setting('general', 'footer_2', 'esc_attr');
    add_settings_field('footer_2', '<label for="footer_2">' . __('Footer Heading 2 :', 'footer_2') . '</label>', 'print_second_field', 'general');

    register_setting('general', 'footer_3', 'esc_attr');
    add_settings_field('footer_3', '<label for="footer_3">' . __('Footer Heading 3 :', 'footer_3') . '</label>', 'print_third_field', 'general');

    register_setting('general', 'footer_3_link', 'esc_attr');
    add_settings_field('footer_3_link', '<label for="footer_3_link">' . __('Footer Heading 3 Link :', 'footer_3_link') . '</label>', 'print_eight_field', 'general');

    register_setting('general', 'linkedin_link', 'esc_attr');
    add_settings_field('linkedin_link', '<label for="linkedin_link">' . __('LinkedIn Link :', 'linkedin_link') . '</label>', 'print_fourth_field', 'general');

    register_setting('general', 'fb_link', 'esc_attr');
    add_settings_field('fb_link', '<label for="fb_link">' . __('Facebook Link :', 'fb_link') . '</label>', 'print_fifth_field', 'general');

    register_setting('general', 'Instagram_link', 'esc_attr');
    add_settings_field('Instagram_link', '<label for="Instagram_link">' . __('Instagram Link :', 'Instagram_link') . '</label>', 'print_sixth_field', 'general');

    register_setting('general', 'copyright_text', 'esc_attr');
    add_settings_field('copyright_text', '<label for="copyright_text">' . __('Copyright Text :', 'copyright_text') . '</label>', 'print_seventh_field', 'general');

}

function print_first_field() {
    $value = get_option('footer_1', '');
    echo '<input type="text" id="footer_1" name="footer_1" size="47" value="' . $value . '" />';
}

function print_second_field() {
    $value = get_option('footer_2', '');
    echo '<input type="text" id="footer_2" name="footer_2" size="47" value="' . $value . '" />';
}

function print_third_field() {
    $value = get_option('footer_3', '');
    echo '<input type="text" id="footer_3" name="footer_3" size="47" value="' . $value . '" />';
}

function print_fourth_field() {
    $value = get_option('linkedin_link', '');
    echo '<input type="text" id="linkedin_link" name="linkedin_link" size="47" value="' . $value . '" />';
}

function print_fifth_field() {
    $value = get_option('fb_link', '');
    echo '<input type="text" id="fb_link" name="fb_link" size="47" value="' . $value . '" />';
}

function print_sixth_field() {
   $value = get_option('Instagram_link', '');
    echo '<input type="text" id="Instagram_link" name="Instagram_link" size="47" value="' . $value . '" />';
}
function print_seventh_field() {
   $value = get_option('copyright_text', '');
    echo '<input type="text" id="copyright_text" name="copyright_text" size="47" value="' . $value . '" />';
}

function print_eight_field() {
    $value = get_option('footer_3_link', '');
    echo '<input type="text" id="footer_3_link" name="footer_3_link" size="47" value="' . $value . '" />';
}

add_filter('admin_init', 'register_fields');

/*Menu class*/
$menu = wp_get_nav_menu_object("primary" );
//$locations = get_nav_menu_locations(); //get all menu locations
//$menu = wp_get_nav_menu_object($locations['primary']);//get the menu object

 if(!empty($menu->name) =='primary'){
 //Menu A tag class
   function add_class_to_all_menu_anchors( $atts ) {
    $atts['class'] = 'nav-link dropdown-toggle';

    return $atts;
}
 add_filter( 'nav_menu_link_attributes', 'add_class_to_all_menu_anchors', 10 );

 //SubMenu A tag class
add_action('nav_menu_submenu_css_class', 'custom_submenu_css_class');
function custom_submenu_css_class() {
    return array('dropdown-item');
 }

}

/* ACF Json File Generation */


add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point( $path ) {

    // update path
    $path = get_template_directory().'/acf';

    // return
    return $path;

}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {

    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_template_directory().'/acf';

    // return
    return $paths;

}
/*Pagination*/

  /*Custom Pagination */
function pagination_bar() {
	global $wp_query;
	$count = $wp_query->found_posts;
		 if ( have_posts() ) {
			 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
			 $total_pages = $wp_query->max_num_pages;
             echo '	<div class="pagination D-radius dynmic-pagi">';
			 if ($total_pages > 1){
				 $current_page = max(1, get_query_var('paged'));
					   echo paginate_links(array(
					  'base' => get_pagenum_link(1) . '%_%',
					  'format' => '/page/%#%',
					  'current' => $current_page,
					  'total' => $total_pages,
					  'prev_text'          => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
					  'next_text'          => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
		  ));
		} echo '<li class="page-item article-count">'.$count.' Articles</li>';
		echo '</div>';
	  }

	 }

	 $theme_dir = get_template_directory();

	 require $theme_dir . '/custom-post-types/careersummary.php';
	 require $theme_dir . '/custom-post-types/resourcelibrary.php';
	 require $theme_dir . '/custom-post-types/news.php';
	 require $theme_dir . '/custom-post-types/events.php';
	 require $theme_dir . '/custom-post-types/class-cpt-companies.php';
	 require $theme_dir . '/custom-post-types/class-cpt-jobs.php';
     require $theme_dir . '/inc/ajax-filter.php';


/**
* Filter to increse the upload size
*
* @param string $size Upload size limit (in bytes).
* @return int (maybe) Filtered size limit.
*/
function filter_site_upload_size_limit( $size ) {

	$size = 2048 * 10000;

	return $size;
}
//add_filter( 'upload_size_limit', 'filter_site_upload_size_limit', 20 );

add_post_type_support( 'page', 'excerpt' );
add_post_type_support( 'posts', 'excerpt' );

function display_read_time($content) {
	$count_words = str_word_count( strip_tags( $content ) );
	$read_time = ceil($count_words / 250);
	$read_time_output = $read_time . ':00';
	return $read_time_output;
}

require $theme_dir . '/dashboard/functions.php';
require $theme_dir . '/job-board/functions.php';
require $theme_dir . '/company-directory/functions.php';

// Google maps ACF
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDDwEvtVsafaRt3v6Y2SA7RUCZpB8vIGCQ';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_action( 'pre_get_posts', 'pws_exclude_jobs_from_search' );

function pws_exclude_jobs_from_search( $query ) {

    if (is_admin() || ! $query->is_main_query()) {
        return;
    }


    if ($query->is_search()) {

        $post_status = array(
            'publish',
            'company_active',
            'event_active',
            'job_active'
        );

        $query->set('post_status', $post_status);

        $query->set('post_type', array("page", "attachment", "go2hr_careersummary", "team", "go2hr_careerprofiles", "go2hr_resources"));

    }
}

add_action('admin_print_footer_scripts', function() {
   if (wp_script_is('quicktags')) {
       echo <<<EOF
        <script type="text/javascript">
            QTags.addButton('button', 'button', '<a href="URL" class="green-btn lm">Register <i class="fa fa-angle-right" aria-hidden="true"></i></a>', '', 'button');
        </script>
EOF;
   }
}, 100);

function change_posts_orderby($orderby) {
    if (!is_admin() && is_search()) {
        global $wp_query;

        $s = $wp_query->query['s'];
        $exploded_s = explode(" ", $s);

        if (count($exploded_s) > 1) {
            foreach ($exploded_s as $index => $one) {
                if ($index == 0) {
                    $second_case_statement = " WHEN post_title LIKE '%{$one}%'";
                    $third_case_statement = " WHEN post_title LIKE '%{$one}%'";
                } else {
                    $second_case_statement .= " AND post_title LIKE '%{$one}%'";
                    $third_case_statement .= " OR post_title LIKE '%{$one}%'";
                }
            }

            $second_case_statement .= " THEN 2";
            $third_case_statement .= " THEN 3";

            $orderby = "(
                CASE WHEN post_title LIKE '%{$s}%' THEN 1
                {$second_case_statement}
                {$third_case_statement}
                ELSE 4 END
            ), post_type DESC, post_date DESC";
        } else {
            $orderby = "(
                CASE WHEN post_title LIKE '%{$s}%' THEN 1
                ELSE 2 END
            ), post_type DESC, post_date DESC";
        }
    }
    return $orderby;
}
add_filter('posts_orderby', 'change_posts_orderby');

function get_the_custom_excerpt($content, $length) {
	$length = ($length ? $length : 70);
	$content = preg_replace('/<iframe.+<\/iframe>/', '', $content);
	$content = strip_shortcodes($content);
	$content = strip_tags($content);
	$content =  str_replace("&nbsp;","",$content);

	$is_continue = false;
	if (mb_strlen($content) > $length) {
		$is_continue = true;
	}

	$content =  mb_substr($content, 0, $length);
	if ($is_continue) {
		$content = trim($content) . '... <a class="more-link" href="%s">Continue reading</a>';
	}

	return $content;
}

