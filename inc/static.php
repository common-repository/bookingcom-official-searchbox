<?php
/**
 * Frontend functions.
 *
 * @package Booking Official Searchbox
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'bos_register_scripts' ) ) :

	/**
	 * Register theme styles and scripts.
	 *
	 * @since 2.2.4
	 */
	function bos_register_scripts() {

        $register_styles = [
			'bos-searchbox' => [
				'src' => BOS_PLUGIN_ASSETS . '/css/bos_searchbox.css',
			],
            'bos-settings' => [
                'src' => BOS_PLUGIN_ASSETS . '/css/bos_settings.css',
            ],
            'jquery-ui' => [
                'src' => BOS_PLUGIN_ASSETS . '/css/jquery-ui.css',
            ]
		];

		foreach ( $register_styles as $name => $props ) {
			bos_register_style( $name, $props['src'] );
		}

        $register_scripts = [
			'bos-main' => [
				'src'       => BOS_PLUGIN_ASSETS . '/js/bos_main.js',
				'deps'      => [ 'jquery' ],
				'in_footer' => true,
			],
			'bos-date' => [
				'src'       => BOS_PLUGIN_ASSETS . '/js/bos_date.js',
				'deps'      => [ 'jquery' ],
				'in_footer' => true,
			],
			'bos-general' => [
				'src'       => BOS_PLUGIN_ASSETS . '/js/bos_general.js',
				'deps'      => [ 'jquery' ],
				'in_footer' => true,
			],
            'bos-moment' => [
                'src'       => BOS_PLUGIN_ASSETS . '/js/moment-with-locales.min.js',
                'deps'      => [],
                'in_footer' => true
            ]
		];

		foreach ( $register_scripts as $name => $props ) {
			bos_register_script( $name, $props['src'], $props['deps'], false, $props['in_footer'] );
		}

    }

endif;

if ( ! function_exists( 'bos_enqueue_scripts' ) ) :

    function bos_enqueue_scripts() {

        bos_register_scripts();

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'bos-searchbox' );
        if (is_admin()) {
            wp_enqueue_style( 'bos-settings' );
        }
        wp_enqueue_style( 'jquery-ui' );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'bos-main' );
        wp_enqueue_script( 'bos-date' );
        if (is_admin()) {
            wp_enqueue_script( 'bos-general' );
        }
        wp_enqueue_script( 'bos-moment' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-ui-datepicker' );

        $options = bos_searchbox_retrieve_all_user_options();

        wp_localize_script( 'bos-date', 'objectL10n', array(
            'destinationErrorMsg' => esc_html__( 'Sorry, we need at least part of the name to start searching.', 'bookingcom-official-searchbox' ),
            'tooManyDays' => esc_html__( 'Your check-out date is more than 30 nights after your check-in date. Bookings can only be made for a maximum period of 30 nights. Please enter alternative dates and try again.', 'bookingcom-official-searchbox' ),
            'dateInThePast' => esc_html__( 'Your check-in date is in the past. Please check your dates and try again.', 'bookingcom-official-searchbox' ),
            'cObeforeCI' => esc_html__( 'Please check your dates, the check-out date appears to be earlier than the check-in date.', 'bookingcom-official-searchbox' ),
            'calendar_nextMonth' => esc_html__( 'Next month', 'bookingcom-official-searchbox' ),
            'calendar_open' => esc_html__( 'Open calendar and pick a date', 'bookingcom-official-searchbox' ) ,
            'calendar_prevMonth' => esc_html__( 'Prev month', 'bookingcom-official-searchbox' ),
            'calendar_closeCalendar' => esc_html__( 'Close calendar', 'bookingcom-official-searchbox' ),
            'january' => esc_html__( 'January', 'bookingcom-official-searchbox' ),
            'february' => esc_html__( 'February', 'bookingcom-official-searchbox' ),
            'march' => esc_html__( 'March', 'bookingcom-official-searchbox' ),
            'april' => esc_html__( 'April', 'bookingcom-official-searchbox' ),
            'may' => esc_html__( 'May', 'bookingcom-official-searchbox' ),
            'june' => esc_html__( 'June', 'bookingcom-official-searchbox' ),
            'july' => esc_html__( 'July', 'bookingcom-official-searchbox' ),
            'august' => esc_html__( 'August', 'bookingcom-official-searchbox' ),
            'september' => esc_html__( 'September', 'bookingcom-official-searchbox' ),
            'october' => esc_html__( 'October', 'bookingcom-official-searchbox' ),
            'november' => esc_html__( 'November', 'bookingcom-official-searchbox' ),
            'december' => esc_html__( 'December', 'bookingcom-official-searchbox' ),
            'mo' => esc_html__( 'Mo', 'bookingcom-official-searchbox' ),
            'tu' => esc_html__( 'Tu', 'bookingcom-official-searchbox' ),
            'we' => esc_html__( 'We', 'bookingcom-official-searchbox' ),
            'th' => esc_html__( 'Th', 'bookingcom-official-searchbox' ),
            'fr' => esc_html__( 'Fr', 'bookingcom-official-searchbox' ),
            'sa' => esc_html__( 'Sa', 'bookingcom-official-searchbox' ),
            'su' => esc_html__( 'Su', 'bookingcom-official-searchbox' ),
            'updating' => esc_html__( 'Updating...', 'bookingcom-official-searchbox' ),
            'close' => esc_html__( 'Close', 'bookingcom-official-searchbox' ),
            'placeholder' => esc_html__( 'e.g. city, region, district or specific hotel', 'bookingcom-official-searchbox' ),
            'language' => get_locale(),
            // following values are when reset to default values is triggered
            'aid' => BOS_DEFAULT_AID,
            'dest_type' => BOS_DEST_TYPE,
            'calendar' => BOS_CALENDAR,
            'flexible_dates' => BOS_FLEXIBLE_DATES,
            'logodim' => BOS_LOGODIM,
            'logopos' => BOS_LOGOPOS,
            //'prot' => BOS_PROTOCOL,
            'buttonpos' => BOS_BUTTONPOS,
            //'sticky' => BOS_STICKY,
            'selected_datecolor' => BOS_SELECTED_DATE_COLOR,
            'bgcolor' => BOS_BGCOLOR,
            'dest_bgcolor' => BOS_DEST_BGCOLOR,
            'dest_textcolor' => BOS_DEST_TEXTCOLOR,
            'headline_textsize' => BOS_HEADLINE_SIZE,
            'headline_textcolor' => BOS_HEADLINE_TEXTCOLOR,
            'textcolor' => BOS_TEXTCOLOR,
            'flexdate_textcolor' => BOS_FLEXDATE_TEXTCOLOR,
            'date_textcolor' => BOS_DATE_TEXTCOLOR,
            'date_bgcolor' => BOS_DATES_BGCOLOR,
            'submit_bgcolor' => BOS_SUBMIT_BGCOLOR,
            'submit_bordercolor' => BOS_SUBMIT_BORDERCOLOR,
            'submit_textcolor' => BOS_SUBMIT_TEXTCOLOR,
            'calendar_selected_bgcolor' => !empty( $options[ 'calendar_selected_bgcolor' ] ) ? $options[ 'calendar_selected_bgcolor' ] : BOS_CALENDAR_SELECTED_DATE_BGCOLOR,
            'calendar_selected_textcolor' => !empty( $options[ 'calendar_selected_textcolor' ] ) ? $options[ 'calendar_selected_textcolor' ] : BOS_CALENDAR_SELECTED_DATE_TEXTCOLOR,
            'calendar_daynames_color' => !empty( $options[ 'calendar_daynames_color' ] ) ? $options[ 'calendar_daynames_color' ] : BOS_CALENDAR_DAYNAMES_COLOR,
            'aid_starts_with_four' => esc_html__( 'Affiliate ID is different from partner ID: should start with a 1, 3, 8 or 9. Please change it.', 'bookingcom-official-searchbox' ),
            //set the path for javascript files
            'images_js_path' => BOS_PLUGIN_ASSETS . '/images' //path for images to be called from javascript     
        ) );

        // do_action('wp_enqueue_scripts')
    }

endif;

add_action( 'wp_enqueue_scripts', 'bos_enqueue_scripts', 15 );
add_action( 'admin_enqueue_scripts', 'bos_enqueue_scripts');