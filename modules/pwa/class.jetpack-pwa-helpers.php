<?php
class Jetpack_PWA_Helpers {
	public static function get_default_manifest_icon_sizes() {
		return array(
			48,
			72,
			96,
			144,
			168,
			192,
			512,
		);
	}

	public static function site_icon_url( $size ) {
		$url = function_exists( 'get_site_icon_url' )
			? get_site_icon_url( $size )
			: false;

		// Fall back to built-in WordPress icon
		if ( ! $url && in_array( $size, self::get_default_manifest_icon_sizes() ) ) {
			$url = esc_url_raw(
				plugins_url( "modules/pwa/images/wp-$size.png", JETPACK__PLUGIN_FILE )
			);
		}

		return $url;
	}

	public static function get_theme_color() {
		$theme_color = '#fff';
		// if we have AMP enabled, use those colors?
		if ( class_exists( 'AMP_Customizer_Settings' ) ) {
			/* This filter is documented in wp-content/plugins/amp/includes/class-amp-post-template.php */
			$amp_settings = apply_filters(
				'amp_post_template_customizer_settings',
				AMP_Customizer_Settings::get_settings(),
				null
			);

			if ( isset( $amp_settings['header_background_color'] ) ) {
				$theme_color = $amp_settings['header_background_color'];
			}
		} else if ( current_theme_supports( 'custom-background' ) ) {
			$background_color = get_background_color(); // Returns hex key without hash or empty string
			if ( $background_color ) {
				$theme_color = "#$background_color";
			}
		}

		/**
		 * Allows overriding the PWA theme color which is used when loading the app.
		 *
		 * @since 5.6.0
		 *
		 * @param string $theme_color
		 */
		return apply_filters( 'jetpack_pwa_background_color', $theme_color );
	}
}
