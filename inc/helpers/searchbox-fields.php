<?php
/**
 * Searchbox fields helpers.
 * @package Booking Official Searchbox\Helpers
 * @since 2.2.4
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'bos_searchbox_settings_fields_array' ) ) :

    function bos_searchbox_settings_fields_array( $fields = array() ) {
        // 'field name', 'input type',  'field label', 'field bonus expl.', 'input maxlenght', 'input size', 'required', 'which section belongs to?','placeholder'
        $fields[ 'aid' ] = array(
            'aid',
            'number',
            esc_html__( 'Your affiliate ID', 'bookingcom-official-searchbox' ),
            wp_kses_post( __( 'Your affiliate ID is a unique number that allows Booking.com to track commission. If you are not an affiliate yet, <a href="https://www.booking.com/affiliate-program/v2/index.html" target="_blank">check our affiliate programme</a> and get an affiliate ID. It\'s easy and fast. Start earning money, <a href="https://www.booking.com/affiliate-program/v2/index.html" target="_blank">sign up now!</a>', 'bookingcom-official-searchbox' ) ),
            7,
            10,
            0,
            'main',
            __( 'e.g.', 'bookingcom-official-searchbox' ) . ' ' . esc_attr(BOS_DEFAULT_AID) 
        );
        $fields[ 'widget_width' ] = array(
            'widget_width',
            'number',
            esc_html__( 'Width', 'bookingcom-official-searchbox' ),
            esc_html__( 'Need a specific width (e.g. 150px)? You can customise the width of your search box easily - just fill in your pixel requirements. If you leave this field empty, you\'ll get default settings.', 'bookingcom-official-searchbox' ),
            4,
            4,
            0,
            'main',
            '' 
        );
        $fields[ 'widget_width_suffix' ] = array(
            'widget_width_suffix',
            'select',
            esc_html__( 'Widget Width Suffix (px or %)', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            ''
        );
        $fields[ 'cname' ] = array(
            'cname',
            'text',
            esc_html__( 'Cname', 'bookingcom-official-searchbox' ),
            esc_html__( 'Set your cname if you have one. Remember to point it to www.booking.com and to inform our support team.', 'bookingcom-official-searchbox' ),
            '',
            '',
            0,
            'main',
            esc_html__( 'e.g. hotels.mydomain.com', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'flexible_dates' ] = array(
            'flexible_dates',
            'checkbox',
            esc_html__( 'Add a &quot;flexible-date&quot; check box', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            '' 
        );
        $fields[ 'logodim' ] = array(
            'logodim',
            'radio',
            esc_html__( 'Select which logo and dimension you prefer', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            '' 
        );
        $fields[ 'buttonpos' ] = array(
            'buttonpos',
            'select',
            esc_html__( 'Button position', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            '' 
        );
        $fields[ 'logopos' ] = array(
            'logopos',
            'select',
            esc_html__( 'Logo position', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            '' 
        );

        $fields[ 'preset_checkin_date' ] = array(
            'preset_checkin_date',
            'text',
            esc_html__( 'Set check-in date', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            'ex. 01/15/2019' 
        );

        $fields[ 'preset_checkout_date' ] = array(
            'preset_checkout_date',
            'text',
            esc_html__( 'Set check-out date', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'main',
            'ex. 02/15/2019' 
        );


        $fields[ 'destination' ] = array(
            'destination',
            'text',
            esc_html__( 'Destination', 'bookingcom-official-searchbox' ),
            esc_html__( 'You can pre-fill this field with a specific destination ( e.g. Amsterdam )', 'bookingcom-official-searchbox' ),
            '',
            18,
            0,
            'destination',
            esc_html__( 'e.g. Amsterdam', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'dest_type' ] = array(
            'dest_type',
            'select',
            esc_html__( 'Destination type', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'destination',
            '' 
        );
        $fields[ 'dest_id' ] = array(
            'dest_id',
            'text',
            esc_html__( 'Destination ID ( e.g. -2140479 for Amsterdam )', 'bookingcom-official-searchbox' ),
            sprintf( wp_kses( __('<a href="#" id="bos_info_displayer" title="Info box"><img style="border: none;" src="%s" alt="info"></a>', 'bookingcom-official-searchbox'), array(  'a' => array( 'href' => array(), 'id' => array(), 'title' => array() ), 'img' => array( 'style' => array(), 'src' => array(), 'alt' => array() ) ) ), esc_attr(BOS_PLUGIN_ASSETS) . '/images/bos_info_icon.png' ),
            '',
            25,
            0,
            'destination',
            esc_html__( 'e.g. -2140479 for Amsterdam', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'display_in_custom_post_types' ] = array(
            'display_in_custom_post_types',
            'text',
            esc_html__( 'Enable meta boxes for these Custom Post Type ( use the slug )', 'bookingcom-official-searchbox' ),
            esc_html__( 'If you have multiple posts, use a "," (comma) to separate them. i.e.: cpt1, cpt2, cpt3', 'bookingcom-official-searchbox' ),
            '',
            '',
            0,
            'destination',
            '' 
        );
        $fields[ 'bgcolor' ] = array(
            'bgcolor',
            'text',
            esc_html__( 'Background colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            '' 
        );
        $fields[ 'headline_textsize' ] = array(
            'headline_textsize',
            'number',
            esc_html__( 'Headline Text size', 'bookingcom-official-searchbox' ),
            esc_html__( 'Font size in px', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            'main',
            ''
        );
        $fields[ 'headline_textcolor' ] = array(
            'headline_textcolor',
            'text',
            esc_html__( 'Headline Text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            ''
        );
        $fields[ 'textcolor' ] = array(
            'textcolor',
            'text',
            esc_html__( 'Text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            '' 
        );
        $fields[ 'dest_textcolor' ] = array(
            'dest_textcolor',
            'text',
            esc_html__( 'Destination Text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            ''
        );
        $fields[ 'dest_bgcolor' ] = array(
            'dest_bgcolor',
            'text',
            esc_html__( 'Destination Background colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            ''
        );
        $fields[ 'flexdate_textcolor' ] = array(
            'flexdate_textcolor',
            'text',
            esc_html__( 'Flex Date Text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            ''
        );
        $fields[ 'date_bgcolor' ] = array(
            'date_bgcolor',
            'text',
            esc_html__( 'Date Background colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            ''
        );
        $fields[ 'date_textcolor' ] = array(
            'date_textcolor',
            'text',
            esc_html__( 'Date Text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            ''
        );
        $fields[ 'submit_bgcolor' ] = array(
            'submit_bgcolor',
            'text',
            esc_html__( 'Button background colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            '' 
        );
        $fields[ 'submit_bordercolor' ] = array(
            'submit_bordercolor',
            'text',
            esc_html__( 'Button border colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            '' 
        );
        $fields[ 'submit_textcolor' ] = array(
            'submit_textcolor',
            'text',
            esc_html__( 'Button text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'color',
            '' 
        );
        $fields[ 'calendar_selected_bgcolor' ] = array(
            'calendar_selected_bgcolor',
            'text',
            esc_html__( 'Calendar Selected background colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'calendarcolor',
            ''
        );
        $fields[ 'calendar_selected_textcolor' ] = array(
            'calendar_selected_textcolor',
            'text',
            esc_html__( 'Calendar Selected text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'calendarcolor',
            ''
        );
        $fields[ 'calendar_daynames_color' ] = array(
            'calendar_daynames_color',
            'text',
            esc_html__( 'Calendar daynames text colour', 'bookingcom-official-searchbox' ),
            '',
            7,
            10,
            0,
            'calendarcolor',
            ''
        );
        $fields[ 'maintitle' ] = array(
            'maintitle',
            'text',
            esc_html__( 'Default title ( e.g. Search hotels and more... )', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'wording',
            esc_html__( 'Search hotels and more...', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'dest_title' ] = array(
            'dest_title',
            'text',
            esc_html__( 'Destination ( e.g. Destination )', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'wording',
            esc_html__( 'Destination', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'checkin' ] = array(
            'checkin',
            'text',
            esc_html__( 'Check-in ( e.g. Check-in date )', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'wording',
            esc_html__( 'Check-in date', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'checkout' ] = array(
            'checkout',
            'text',
            esc_html__( 'Check-out ( e.g. Check-out date )', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'wording',
            esc_html__( 'Check-out date', 'bookingcom-official-searchbox' ) 
        );
        $fields[ 'submit' ] = array(
            'submit',
            'text',
            esc_html__( 'Submit button ( e.g. Search )', 'bookingcom-official-searchbox' ),
            '',
            '',
            '',
            0,
            'wording',
            esc_html__( 'Search', 'bookingcom-official-searchbox' ) 
        );
        return $fields;
    }

endif;