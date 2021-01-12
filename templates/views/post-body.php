<?php
/**
 * This is a single post (and default for any other post types) template for <body>...</body> content: post-body.php.
 *
 * @package MobiLoud.
 * @subpackage MobiLoud/templates/viewa
 * @version 4.2.0
 */

if ( ! function_exists( 'setup_postdata_custom' ) ) {
	/**
	 * Set up global post data.
	 *
	 * @since 1.5.0
	 *
	 * @param WP_Post $post Post data.
	 *
	 * @uses do_action_ref_array() Calls 'the_post'
	 * @return bool True when finished.
	 */
	function setup_postdata_custom( $post ) {
		global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $query;

		$id = (int) $post->ID; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		if ( empty( $query ) ) {
			$query = new WP_Query( [ 'p' => $id ] );
		}

		$authordata = get_userdata( $post->post_author ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		$currentday   = mysql2date( 'd.m.y', $post->post_date, false ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		$currentmonth = mysql2date( 'm', $post->post_date, false ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		$numpages     = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		$multipage    = 0; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		$page         = get_query_var( 'page' ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		if ( ! $page ) {
			$page = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		}
		if ( is_single() || is_page() || is_feed() ) {
			$more = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		}
		$content = $post->post_content;
		$pages   = array( $post->post_content ); // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		/**
		* Fires once the post data has been setup.
		*
		* @since 2.8.0
		*
		* @param WP_Post &$post The Post object (passed by reference).
		*/
		do_action_ref_array( 'the_post', array( &$post, &$query ) );

		return true;
	}
}

if ( ! function_exists( 'ml_remove_shortcodes' ) ) {

	function ml_remove_shortcodes_callback( $param ) {
		global $shortcode_tags;
		// Be sure to keep active shortcodes.
		$active_shortcodes = ( is_array( $shortcode_tags ) && ! empty( $shortcode_tags ) ) ? array_keys( $shortcode_tags ) : array();
		if ( in_array( $param[2], $active_shortcodes ) ) {
			return $param[0];
		} else {
			return '';
		}
	}

	/**
	 * Hide unused shortcodes
	 *
	 * @param string $content
	 */
	function ml_remove_shortcodes( $content ) {
		global $shortcode_tags;

		if ( ! empty( $shortcode_tags ) ) {
			$patt    = "~(\[(?:\[?)/?([a-z0-9_\-]+)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?))~";
			$content = preg_replace_callback( $patt, 'ml_remove_shortcodes_callback', $content );
		} else {
			$hack    = md5( microtime() );
			$content = str_replace( '/', $hack, $content ); // avoid "/" chars in content breaks preg_replace.
			// Strip all shortcodes.
			$content = preg_replace( '~(?:\[/?)[^/\]]+/?\]~s', '', $content );
			$content = str_replace( $hack, '/', $content ); // set "/" back to its place.
		}

		return ltrim( $content );
	}
}


if ( ! function_exists( 'ml_remove_elements' ) ) {

	function ml_remove_elements( $content ) {
		if ( strpos( $content, 'ml_remove' ) !== false ) {
			libxml_use_internal_errors();
			$d = new DOMDocument();
			$d->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
			$s = new DOMXPath( $d );

			foreach ( $s->query( '//div[contains(attribute::class, "ml_remove")]' ) as $t ) {
				$t->parentNode->removeChild( $t );
			}

			return preg_replace( '~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i', '', html_entity_decode( $d->saveHTML() ) );
		} else {
			return $content;
		}
	}
}

$current_permalink = get_permalink( $post->ID );
if ( ! function_exists( 'ml_convert_relative_links' ) ) {
	function ml_convert_relative_links( $content ) {
		global $current_permalink;
		$content = preg_replace( "#(<\s*a\s+[^>]*href\s*=\s*[\"'])(?!http|/)([^\"'>]+)([\"'>]+)#", '$1' . $current_permalink . '$2$3', $content );

		return $content;
	}

	add_filter( 'the_content', 'ml_convert_relative_links', 20 );
}

setup_postdata_custom( $post ); // enable author and other data.
Mobiloud::reinitialize_shortcodes(); // apply 'Ignore shortcodes for in-app articles' option.

if ( ! isset( $custom_css ) ) {
	$custom_css = stripslashes( get_option( 'ml_post_custom_css' ) );
	echo $custom_css ? '<style type="text/css" media="screen">' . $custom_css . '</style>' : ''; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
}
if ( ! isset( $custom_js ) ) {
	$custom_js = stripslashes( get_option( 'ml_post_custom_js' ) );
	echo $custom_js ? '<script>' . $custom_js . '</script>' : ''; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
}

do_action( 'mobiloud_single_post', 'top' );

echo wp_kses( stripslashes( get_option( 'ml_banner_above_content', '' ) ), Mobiloud::expanded_alowed_tags() );
/* Next line of code (with eval function) and other eval calls required for MobiLoud Editor settings */
eval( stripslashes( get_option( 'ml_post_start_body' ) ) ); // phpcs:ignore Squiz.PHP.Eval.Discouraged
echo wp_kses( stripslashes( get_option( 'ml_html_post_start_body', '' ) ), Mobiloud::expanded_alowed_tags() );

eval( stripslashes( get_option( 'ml_post_before_top_banner' ) ) ); // phpcs:ignore Squiz.PHP.Eval.Discouraged

eval( stripslashes( get_option( 'ml_post_after_top_banner' ) ) ); // phpcs:ignore Squiz.PHP.Eval.Discouraged

$categories = wp_get_post_categories( get_the_ID() );
$categories = array_map( function( $cat_id ) {
	$cat = get_category( $cat_id );
	return $cat->name;
}, $categories );
?>
<article class="mlwoo-single-post">
	<div class="mlwoo-single-post-categories">
		<?php echo implode( ', ', $categories ); ?>
	</div>
	<div class="mlwoo-single-post-title"><?php the_title(); ?></div>
	<div class="mlwoo-single-post-separator"></div>
	<div class="mlwoo-single-post-data-author">
		<?php
			printf(
				'Posted on %s by %s',
				get_the_date(),
				get_the_author()
			);
		?>
	</div>
	<div class="mlwoo-single-post-featured-image"><?php the_post_thumbnail(); ?></div>
	<div class="mlwoo-single-post-content"><?php the_content(); ?></div>
</article>
<?php

eval( stripslashes( get_option( 'ml_post_after_body' ) ) ); // phpcs:ignore Squiz.PHP.Eval.Discouraged
echo wp_kses( stripslashes( get_option( 'ml_html_post_after_body', '' ) ), Mobiloud::expanded_alowed_tags() );
echo wp_kses( stripslashes( get_option( 'ml_banner_below_content', '' ) ), Mobiloud::expanded_alowed_tags() );
do_action( 'mobiloud_single_post', 'bottom' );

?>
<script>
	var iframes = document.getElementsByTagName('iframe')
	, frameRatios = []
	, container = document.getElementsByTagName('article')[0]
	, imgs = document.getElementsByTagName('img');
	for (var i = 0; i < iframes.length; i++) {
		var frame = iframes[i];
		frameRatios[i] = frame.offsetHeight / frame.offsetWidth;
		frame.removeAttribute('width');
		frame.removeAttribute('height');
		frame.style.width = '100%';
	}
	for (var i = 0; i < imgs.length; i++) {
		var img = imgs[i];
		img.removeAttribute('width');
		img.removeAttribute('height');
		while (img = img.parentNode) {
			if (/^attachment_[0-9]+$/.test(img.id)) {
				img.removeAttribute('style');
			}
		}
	}
	window.onresize = function () {
		var containerWidth = container.offsetWidth;
		for (var i = 0; i < iframes.length; i++) {
			var frame = iframes[i];
			frame.style.height = (containerWidth * frameRatios[i]) + 'px';
		}
	};
	window.onresize();
</script>
