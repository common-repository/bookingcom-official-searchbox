<?php
/**
 * Core Function scripts
 * 
 * @since 2.2.4
 *
 * @package Booking Official Searchbox
 */

defined( 'ABSPATH' ) || exit;

register_activation_hook( BOS_PLUGIN_DIR_URL, 'bos_searchbox_install' );
function bos_searchbox_install( ) {
    //this install defaults values
    $bos_searchbox_options = array(
        'plugin_ver' => BOS_PLUGIN_VERSION //plugin version 
    );
    update_option( 'bos_searchbox_options', $bos_searchbox_options );
}

// Add a menu for our option page
add_action( 'admin_menu', 'bos_searchbox_add_page' );
function bos_searchbox_add_page( ) {
    add_options_page( 
        esc_html__('Booking.com Search Box settings', 'bookingcom-official-searchbox'), // Page title on browser bar 
        esc_html__('Booking.com Search Box', 'bookingcom-official-searchbox'), // menu item text
        'manage_options', // only administartors can open this
        'bos_searchbox', // unique name of settings page
        'bos_searchbox_option_page' //call to fucntion which creates the form
    );

    add_action( 'admin_enqueue_scripts', 'bos_load_styles' );
}
// Add settings link on plugin page

/* Localization and internazionalization */
add_action( 'plugins_loaded', 'bos_searchbox_init' );
function bos_searchbox_init( ) {
    load_plugin_textdomain( 'bookingcom-official-searchbox', false, dirname( BOS_PLUGIN_MAIN_FILE ) . '/languages/' );
}

function bos_searchbox_retrieve_all_user_options( ) {
    // Retrieve all user options from DB
    $user_options = get_option( 'bos_searchbox_user_options' );
    return $user_options;
}

function bos_load_styles() {
    bos_register_scripts();
}

if ( ! function_exists( 'bos_searchbox_settings_link' ) ) :

    function bos_searchbox_settings_link( $actions ) {
        $settings_link = '<a href="' . admin_url( 'options-general.php?page=bos_searchbox' ) . '">' . esc_html__( 'Settings', 'bookingcom-official-searchbox' ) . '</a>';
        // array_unshift( $actions, $settings_link );
        array_unshift( $actions, $settings_link );
        return $actions;
    }

endif;
add_filter( 'plugin_action_links_' . BOS_PLUGIN_MAIN_FILE, 'bos_searchbox_settings_link' );

// Register and define the settings
add_action( 'admin_init', 'bos_searchbox_admin_init' );
function bos_searchbox_admin_init( ) {
    register_setting( 'bos_searchbox_settings', 'bos_searchbox_user_options', 'bos_searchbox_validate_options' );
    add_settings_section( //Main settings 
        'bos_searchbox_main', //id
        esc_html__( 'Main settings', 'bookingcom-official-searchbox' ), //title
        'bos_searchbox_section_main', //callback
        'bos_searchbox' //page
    );
    add_settings_section( //Destination
        'bos_searchbox_destination', //id
        '<hr>' . esc_html__( 'Preset destination', 'bookingcom-official-searchbox' ), //title
        'bos_searchbox_section_destination', //callback
        'bos_searchbox' //page
    );
    add_settings_section( //Color settings
        'bos_searchbox_color',
        '<hr>' . esc_html__( 'Colour scheme', 'bookingcom-official-searchbox' ), 
        'bos_searchbox_section_color', 
        'bos_searchbox' 
    );
    add_settings_section( // Calendar Color settings
        'bos_searchbox_calendarcolor',
        '<hr>' . esc_html__( 'Calendar Colour scheme', 'bookingcom-official-searchbox' ), 
        'bos_searchbox_section_calendarcolor', 
        'bos_searchbox' 
    );
    add_settings_section( //Wording settings
        'bos_searchbox_wording',
        '<hr>' .  esc_html__( 'Search box text', 'bookingcom-official-searchbox' ), 
        'bos_searchbox_section_wording', 
        'bos_searchbox' 
    );
    $arrayFields = bos_searchbox_settings_fields_array();
    foreach ( $arrayFields as $field ) {
        add_settings_field( 'bos_searchbox_' . $field[ 0 ], //id
            esc_html__( $field[ 2 ], 'bookingcom-official-searchbox' ), //title
            'bos_searchbox_settings_field', //callback
            'bos_searchbox', //page
            'bos_searchbox_' . $field[ 7 ], //section
            $args = array(
                $field[ 0 ],
                $field[ 1 ],
                $field[ 3 ],
                $field[ 4 ],
                $field[ 5 ],
                $field[ 8 ] 
            ) //args
        );
    } //$arrayFields as $field
}

// Draw section header
function bos_searchbox_section_main( ) {
    echo '<div id="bos_main_settings_wrapper">';
    echo '<p><em>' . esc_html__( 'Use these settings to customise your search box.', 'bookingcom-official-searchbox' ) . '</em></p>';
    echo '<span id="bos_ajax_nonce" class="hidden" style="visibility: hidden;">' . wp_create_nonce( 'bos_ajax_nonce' ) . '</span>';
    echo '</div>';
}
function bos_searchbox_section_destination( ) {
    echo '<div id="bos_dest_settings_wrapper" class="bos_hide">';
    echo '<p><em>' . wp_kses_post( __( 'Use the following fields to select a specific destination. <em>Destination types</em> and <em>IDs</em> make guest searches more accurate.', 'bookingcom-official-searchbox' ) ) . '</em><span></span></p>';
    echo '</div>';
}
// Draw color section header
function bos_searchbox_section_color( ) {
    echo '<div id="bos_color_settings_wrapper" class="bos_hide">';
    echo '<p><em>' . esc_html__( 'Enter your colour scheme settings here.', 'bookingcom-official-searchbox' ) . '</em><span></span></p>';
    echo '</div>';
}
// Draw color section header
function bos_searchbox_section_calendarcolor( ) {
    echo '<div id="bos_calendar_color_settings_wrapper" class="bos_hide">';
    echo '<p><em>' . esc_html__( 'Enter your calendar colour scheme settings here.', 'bookingcom-official-searchbox' ) . '</em><span></span></p>';
    echo '</div>';
}
// Draw wording section header
function bos_searchbox_section_wording( ) {
    echo '<div id="bos_wording_settings_wrapper" class="bos_hide">';
    echo '<p><em>' . esc_html__( 'Customise the search box text here.', 'bookingcom-official-searchbox' ) . '</em><span></span></p>';
    echo '</div>';
}
// Display and fill general fields
function bos_searchbox_settings_field( $args ) {
    // get options value from the database        
    $options      = bos_searchbox_retrieve_all_user_options();
    $fields_array = $args[ 0 ];
    $fields_value = '';
    if ( !empty( $options[ $fields_array ] ) ) {
        $fields_value = $options[ $fields_array ]; // if user eneterd values fields_value
    } //!empty( $options[ $fields_array ] )
    // $output = '';
    // echo the fields
    if ( $args[ 1 ] == 'text' ) {
        echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '" ';
        if ( !empty( $args[ 3 ] ) ) {
            echo ' maxlength="' . esc_attr($args[ 3 ]) . '" ';
        } //!empty( $args[ 3 ] )
        if ( !empty( $args[ 4 ] ) ) {
            echo ' size="' . esc_attr($args[ 4 ]) . '" ';
        } //!empty( $args[ 4 ] )
        if ( !empty( $args[ 5 ] ) ) {
            echo ' placeholder="' . esc_attr($args[ 5 ]) . '" ';
        } //!empty( $args[ 5 ] )
        // If default plugin values empty show default values  ( but for aid as we do not want the default aid is shown on the input field )
        if ( $args[ 0 ] == 'aid' && ( $fields_value == BOS_DEFAULT_AID || empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || !is_numeric( $fields_value ) ) ) {
            $fields_value = '';
        } //$args[ 0 ] == 'aid' && ( $fields_value == BOS_DEFAULT_AID || empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' || !is_numeric( $fields_value ) )
        // Color scheme default values in case no custom values
        if ( $args[ 0 ] == 'bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_BGCOLOR;
        } //$args[ 0 ] == 'bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_TEXTCOLOR;
        } //$args[ 0 ] == 'textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'dest_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_DEST_BGCOLOR;
        } //$args[ 0 ] == 'dest_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'headline_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_HEADLINE_TEXTCOLOR;
        } //$args[ 0 ] == 'headline_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'dest_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_DEST_TEXTCOLOR;
        } //$args[ 0 ] == 'dest_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'date_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_DATE_TEXTCOLOR;
        } //$args[ 0 ] == 'date_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'date_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_DATES_BGCOLOR;
        } //$args[ 0 ] == 'date_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'flexdate_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_FLEXDATE_TEXTCOLOR;
        } //$args[ 0 ] == 'flexdate_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'submit_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_SUBMIT_BGCOLOR;
        } //$args[ 0 ] == 'submit_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'submit_bordercolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_SUBMIT_BORDERCOLOR;
        } //$args[ 0 ] == 'submit_bordercolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'submit_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_SUBMIT_TEXTCOLOR;
        } //$args[ 0 ] == 'submit_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'calendar_selected_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_CALENDAR_SELECTED_DATE_BGCOLOR;
        } //$args[ 0 ] == 'calendar_selected_bgcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'calendar_selected_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_CALENDAR_SELECTED_DATE_TEXTCOLOR;
        } //$args[ 0 ] == 'calendar_selected_textcolor' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        if ( $args[ 0 ] == 'calendar_daynames_color' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_CALENDAR_DAYNAMES_COLOR;
        } //$args[ 0 ] == 'calendar_daynames_color' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )

        echo 'value="' . esc_html($fields_value) . '" />&nbsp;' . wp_kses_post( __( $args[ 2 ], 'bookingcom-official-searchbox' ) );
        if ( $args[ 0 ] == 'dest_id' ) {
            echo '<div id="bos_info_box" style="display: none;padding: 1em; background-color:#FFFFE0;border:1px solid  #E6DB55; margin:10px 0 10px;">';
            echo wp_kses_post( __( 'For more info on your destination ID, login to the <a href="https://admin.booking.com/partner/" target="_blank">Partner Center</a>. Check <em>&quot;URL constructor&quot;</em> section to find your destination ID. These IDs, also known as UFIs, are usually a negative number ( e.g. <strong>-2140479 is for Amsterdam</strong> , but can be positive ones in the US ) while regions, district and landmarks are always positive ( e.g. <strong>1408 is for Ibiza</strong> ).', 'bookingcom-official-searchbox' ) );
            echo '</div>';
        } //$args[ 0 ] == 'dest_id'
    } // $args[ 1 ] == 'text'
    elseif ( $args[ 1 ] == 'number' ) {
        echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '" ';
        if ( $args[ 0 ] == 'headline_textsize' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' ) ) {
            $fields_value = BOS_HEADLINE_SIZE;
        } //$args[ 0 ] == 'headline_textsize' && ( empty( $fields_value ) || $fields_value == '' || $fields_value == ' ' )
        echo 'value="' . esc_html($fields_value) . '" />&nbsp;' . wp_kses_post( __( $args[ 2 ], 'bookingcom-official-searchbox' ) );
    } // $args[ 1 ] == 'number'
    elseif ( $args[ 1 ] == 'checkbox' ) {
        if ( $args[ 0 ] == 'calendar' ) {
            if ( empty( $fields_value ) ) {
                $fields_value = BOS_CALENDAR;
            } // default value
        } //$args[ 0 ] == 'calendar'
        else if ( $args[ 0 ] == 'flexible_dates' ) {
            if ( empty( $fields_value ) ) {
                $fields_value = BOS_FLEXIBLE_DATES;
            } // default values
        } //$args[ 0 ] == 'flexible_dates'
        /*else if ( $args[ 0 ] == 'save_button_on_widget' )  {
        
        if ( empty( $fields_value ) ) { $fields_value = BOS_SAVE_BUTTON ; } // default values
        
        }  */
        echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  ' . checked( 1, esc_attr($fields_value), false ) . ' />';
    } //$args[ 1 ] == 'checkbox'
    elseif ( $args[ 1 ] == 'radio' ) {
        if ( $args[ 0 ] == 'month_format' ) {
            if ( empty( $fields_value ) ) {
                $fields_value = BOS_MONTH_FORMAT;
            } // default values
            //if( empty( $fields_value ) ) { $fields_value = 'short' ; }// set defaults value
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="long" ' . checked( 'long', esc_attr($fields_value), false ) . ' />&nbsp;' . esc_html__( 'long', 'bookingcom-official-searchbox' );
            echo '&nbsp;<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="short" ' . checked( 'short', esc_attr($fields_value), false ) . ' />&nbsp;' . esc_html__( 'short', 'bookingcom-official-searchbox' );
        } // $args[ 0 ] == 'month_format'
        if ( $args[ 0 ] == 'logodim' ) {
            //if( empty( $fields_value ) ) { $fields_value = 'blue_150x25' ; }// set defaults value
            $bgcolor = !empty($options[ 'bgcolor' ]) ? $options[ 'bgcolor' ] : BOS_BGCOLOR; // default values
            if ( empty( $fields_value ) ) {
                $fields_value = BOS_LOGODIM;
            } // default values
            echo '<span id="bos_img_blue_logo" class="bos_logo_dim_box" style="background: ' . esc_attr($bgcolor) . ';"><img  src="' . BOS_PLUGIN_ASSETS . '/images/booking_logotype_blue_150x25.png" alt="Booking.com logo" /></span>';
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="blue_150x25"  ' . checked( 'blue_150x25', esc_attr($fields_value), false ) . ' />&nbsp;( 150x25 )&nbsp;';
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="blue_200x33"  ' . checked( 'blue_200x33', esc_attr($fields_value), false ) . ' />&nbsp;( 200x33 )&nbsp;';
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="blue_300x50" ' . checked( 'blue_300x50', esc_attr($fields_value), false ) . ' />&nbsp;( 300x50 )&nbsp;';
            echo '<br /><br />';
            echo '<span id="bos_img_white_logo" class="bos_logo_dim_box" style="background: ' . esc_attr($bgcolor) . ';"><img src="' . BOS_PLUGIN_ASSETS . '/images/booking_logotype_white_150x25.png" alt="Booking.com logo" /></span>';
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="white_150x25" ' . checked( 'white_150x25', esc_attr($fields_value), false ) . ' />&nbsp;( 150x25 )&nbsp;';
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="white_200x33" ' . checked( 'white_200x33', esc_attr($fields_value), false ) . ' />&nbsp;( 200x33 )&nbsp;';
            echo '<input name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" class="' . esc_attr($args[ 0 ]) . '" type="' . esc_attr($args[ 1 ]) . '"  value="white_300x50" ' . checked( 'white_300x50', esc_attr($fields_value), false ) . ' />&nbsp;( 300x50 )&nbsp;';
        } // $args[ 0 ] == 'logodim'            
    } // $args[ 1 ] == 'radio'      
    elseif ( $args[ 1 ] == 'select' ) {
        if ( $args[ 0 ] == 'logopos' ) {
            echo '<select name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" >';
            echo '<option value="left" ' . selected( 'left', esc_attr($fields_value), false ) . ' >' . esc_html__( 'Left', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="center" ' . selected( 'center', esc_attr($fields_value), false ) . ' >' . esc_html__( 'Centre', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="right" ' . selected( 'right', esc_attr($fields_value), false ) . ' >' . esc_html__( 'Right', 'bookingcom-official-searchbox' ) . '</option>';
            echo '</select>';
        } // $args[ 0 ] == 'logopos'                               
        if ( $args[ 0 ] == 'buttonpos' ) {
            if ( empty( $fields_value ) ) {
                $fields_value = BOS_BUTTONPOS;
            } //empty( $fields_value )
            echo '<select name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" >';
            echo '<option value="left" ' . selected( 'left', esc_attr($fields_value), false ) . ' >' . esc_html__( 'Left', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="center" ' . selected( 'center', esc_attr($fields_value), false ) . ' >' . esc_html__( 'Centre', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="right" ' . selected( 'right', esc_attr($fields_value), false ) . ' >' . esc_html__( 'Right', 'bookingcom-official-searchbox' ) . '</option>';
            echo '</select>&nbsp;' . wp_kses_post( __( $args[ 2 ], 'bookingcom-official-searchbox' ) );
        } // $args[ 0 ] == 'buttonpos'
        if ( $args[ 0 ] == 'dest_type' ) {
            echo '<select name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" >';
            echo '<option value="select" ' . selected( 'select', esc_attr($fields_value), false ) . ' >' . esc_html__( 'select...', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="city" ' . selected( 'city', esc_attr($fields_value), false ) . ' >' . esc_html__( 'city', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="landmark" ' . selected( 'landmark', esc_attr($fields_value), false ) . ' >' . esc_html__( 'landmark', 'bookingcom-official-searchbox' ) . '</option>';
            //echo '<option value="district" ' . selected( 'district', $fields_value, false ) . ' >' . esc_html__( 'district' , BOS_TEXT_DOMAIN) . '</option>' ;
            echo '<option value="region" ' . selected( 'region', esc_attr($fields_value), false ) . ' >' . esc_html__( 'region', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="airport" ' . selected( 'airport', esc_attr($fields_value), false ) . ' >' . esc_html__( 'airport', 'bookingcom-official-searchbox' ) . '</option>';
            echo '</select>';
        } //$args[ 0 ] == 'dest_type'
        if ( $args[ 0 ] == 'widget_width_suffix' ) {
            echo '<select name="bos_searchbox_user_options[' . esc_attr($fields_array) . ']" id="' . esc_attr($args[ 0 ]) . '" >';
            echo '<option value="px" ' . selected( 'px', esc_attr($fields_value), false ) . ' >' . esc_html__( 'px', 'bookingcom-official-searchbox' ) . '</option>';
            echo '<option value="%" ' . selected( '%', esc_attr($fields_value), false ) . ' >' . esc_html__( '%', 'bookingcom-official-searchbox' ) . '</option>';
            echo '</select>&nbsp;' . wp_kses_post( __( $args[ 2 ], 'bookingcom-official-searchbox' ) );
        }
    } // $args[ 1 ] == 'select'
}

// Validate user inputs 
function bos_searchbox_validate_options( $input ) {
    $valid       = array( );
    $message     = array( );
    $error       = false;
    $arrayFields = bos_searchbox_settings_fields_array();
    foreach ( $arrayFields as $field ) {
        if ( $field[ 1 ] == 'text' ) {
            if ( $field[ 0 ] == 'display_in_custom_post_types' ) {
                // accept only string with letters ( lowercase and uppercase ), numbers,dash, underscore and commas
                if ( !empty( $input[ $field[ 0 ] ] ) ) {
                    if ( preg_match( '/^[a-zA-Z0-9-_,]+$/', $input[ $field[ 0 ] ] ) ) {
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                    } //preg_match( '/^[a-zA-Z0-9-_,]+$/', $input[ $field[ 0 ] ] )
                    else {
                        $error      = true;
                        $message[ ] = '"' . esc_html($field[ 2 ]) . '": ' . esc_html__( 'Use only alphanumeric strings and commas for multiple slugs', 'bookingcom-official-searchbox' ) . '<br>';
                    }
                } // if( !empty( $input[ $field[ 0 ] ] )  )
            } //$field[ 0 ] == 'display_in_custom_post_types'
            if ( $field[ 0 ] == 'cname' ) {
                if ( !empty( $input[ $field[ 0 ] ] ) ) {
                    if ( preg_match( '/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\\-_]*[a-zA-Z0-9])\\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\\-]*[A-Za-z0-9])$/', $input[ $field[ 0 ] ] ) ) {
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                    } //preg_match( '/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\\-_]*[a-zA-Z0-9])\\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\\-]*[A-Za-z0-9])$/')
                    else {
                        $error      = true;
                        $message[ ] = '"' . esc_html($field[ 2 ]) . '": ' . esc_html__( 'Cname format is incorrect', 'bookingcom-official-searchbox' ) . '<br>';
                    }
                }// if ( !empty( $input[ $field[ 0 ] ] ) )
            } //$field[ 0 ] == 'cname'
            else {
                $valid[ $field[ 0 ] ] = sanitize_text_field( $input[ $field[ 0 ] ] ); //sanitize and escape malicius input
                if ( $valid[ trim( $field[ 0 ] ) ] != trim( $input[ $field[ 0 ] ] ) ) {
                    $error      = true;
                    $message[ ] = '"' . esc_html($field[ 2 ]) . '": ' . esc_html__( 'Missing or incorrect information', 'bookingcom-official-searchbox' ) . '<br>';
                } //$valid[ trim( $field[ 0 ] ) ] != trim( $input[ $field[ 0 ] ] )
            }
        } //if ( $field[ 1 ] == 'text' )
        elseif ( $field[ 1 ] == 'number' ) {
            if ( $field[ 0 ] == 'widget_width' ) {
                $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                if ( !empty( $input[ $field[ 0 ] ] ) && $input[ $field[ 0 ] ] != '' && !is_numeric( $input[ $field[ 0 ] ] ) ) {
                    $error      = true;
                    $message[ ] = '"' . esc_html($field[ 2 ]) . '": ' . esc_html__( 'needs to be an integer', 'bookingcom-official-searchbox' ) . '<br>';
                } //!empty( $input[ $field[ 0 ] ] ) && $input[ $field[ 0 ] ] != '' && !is_numeric( $input[ $field[ 0 ] ] )
            } //$field[ 0 ] == 'widget_width'
            if ( $field[ 0 ] == 'aid' ) {
                $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                if ( !empty( $input[ $field[ 0 ] ] ) && $input[ $field[ 0 ] ] != '' && !is_numeric( $input[ $field[ 0 ] ] ) ) {
                    $error      = true;
                    $message[ ] = '"' . esc_html($field[ 2 ]) . '": ' . esc_html__( 'needs to be an integer', 'bookingcom-official-searchbox' ) . '<br>';
                } //!empty( $input[ $field[ 0 ] ] ) && $input[ $field[ 0 ] ] != '' && !is_numeric( $input[ $field[ 0 ] ] )
                // Check if user is placing correct affiliate ID and not partner ID
                else if ( !empty( $input[ $field[ 0 ] ] ) && is_numeric( $input[ $field[ 0 ] ] ) ) {
                    $input[ $field[ 0 ] ] = strval( $input[ $field[ 0 ] ] );
                    if ( $input[ $field[ 0 ] ][ 0 ] == '4' ) { // check first number of the converted value into a string 
                        $error      = true;
                        $message[ ] = '"' . esc_html($field[ 2 ]) . '": ' . esc_html__( 'Affiliate ID is different from partner ID: should start with a 1, 3, 8 or 9. Please change it.', 'bookingcom-official-searchbox' ) . '<br>';
                    } //$input[ $field[ 0 ] ][ 0 ] == '4'
                } //!empty( $input[ $field[ 0 ] ] ) && is_numeric( $input[ $field[ 0 ] ] )
            } //$field[ 0 ] == 'aid'
        }
        elseif ( $field[ 1 ] == 'radio' ) {
            if ( $field[ 0 ] == 'month_format' ) {
                switch ( $input[ $field[ 0 ] ] ) {
                    case 'short':
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                        break;
                    case 'long':
                    default:
                        $valid[ $field[ 0 ] ] = 'long'; //default : long
                        break;
                } //$input[ $field[ 0 ] ]
            } //$field[ 0 ] == 'month_format'
            if ( $field[ 0 ] == 'logodim' ) {
                switch ( $input[ $field[ 0 ] ] ) {
                    case 'blue_200x33':
                    case 'blue_300x50':
                    case 'white_150x25':
                    case 'white_200x33':
                    case 'white_300x50':
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                        break;
                    case 'blue_150x25':
                    default:
                        $valid[ $field[ 0 ] ] = 'blue_150x25'; //default : blue_150x25
                        break;
                }
            }        
        }
        elseif ( $field[ 1 ] == 'checkbox' ) {
            if ( $field[ 0 ] == 'calendar' ) {
                            $valid[ $field[ 0 ] ] = empty( $input[ $field[ 0 ] ] ) ? 0 : 1;
            }
            if ( $field[ 0 ] == 'flexible_dates' ) {
                            $valid[ $field[ 0 ] ] = empty( $input[ $field[ 0 ] ] ) ? 0 : 1;
            } 
        }
        else {
            if ( $field[ 0 ] == 'buttonpos' ) {
                switch ( $input[ $field[ 0 ] ] ) {
                    case 'center':
                    case 'left':
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                        break;
                    case 'right':
                    default:
                        $valid[ $field[ 0 ] ] = 'right'; //default : right
                        break;
                } //$input[ $field[ 0 ] ]
            } //$field[ 0 ] == 'buttonpos'
            elseif ( $field[ 0 ] == 'logopos' ) {
                switch ( $input[ $field[ 0 ] ] ) {
                    case 'center':
                    case 'right':
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                        break;
                    case 'left':
                    default:
                        $valid[ $field[ 0 ] ] = 'left'; //default : left
                        break;
                } //$input[ $field[ 0 ] ]
            } //$field[ 0 ] == 'logopos'
            elseif ( $field[ 0 ] == 'widget_width_suffix' ) {
                switch ( $input[ $field[ 0 ] ] ) {
                    case '%':
                        $valid[ $field[ 0 ] ] = '%';
                        break;
                    case 'px':
                    default:
                        $valid[ $field[ 0 ] ] = 'px'; //default : px
                        break;
                }
            }
            else {
                switch ( $input[ $field[ 0 ] ] ) {
                    case 'city':
                    case 'region':
                    case 'district':
                    case 'landmark':
                        $valid[ $field[ 0 ] ] = $input[ $field[ 0 ] ];
                        break;
                    case 'select':
                    default:
                        $valid[ $field[ 0 ] ] = 'select'; //default : select
                        break;
                } //$input[ $field[ 0 ] ]
            }
        } //logopos entries      
    } //foreach( $arrayFields as $field)
    if ( $error ) {
        add_settings_error( 'bos_searchbox_user_options', //setting
            'bos_searchbox_texterror', //code added to tag #id            
            implode( '', $message ), 'error'
        );
    } //$error
    return $valid;
}

add_action( 'wp_ajax_bos_preview', 'bos_ajax_preview' );
function bos_ajax_preview( ) {
    if ( isset( $_REQUEST[ 'nonce' ] ) ) {
        // Verify that the incoming request is coming with the security nonce
        if ( wp_verify_nonce( $_REQUEST[ 'nonce' ], 'bos_ajax_nonce' ) ) {
            $arrayFields = bos_searchbox_settings_fields_array();
            foreach ( $arrayFields as $field ) {
                // print_r($field[1]);
                if ( $field[ 1 ] == 'text' || $field[ 1 ] == 'number' || $field[ 1 ] == 'radio' || $field[ 1 ] == 'select' ) {
                    $options[ $field[ 0 ] ] = isset( $_REQUEST[ $field[ 0 ] ] ) ? stripslashes( sanitize_text_field( $_REQUEST[ $field[ 0 ] ] ) ) : '';
                } //if ( $field[ 1 ] == 'text' )
                elseif ( $field[ 1 ] == 'checkbox' ) {
                    if ( $field[ 0 ] == 'calendar' ) {
                        $options[ $field[ 0 ] ] = empty( $_REQUEST[ 'calendar' ] ) ? 0 : 1;
                    } //if ( $field[ 0 ] == 'calendar' )
                    if ( $field[ 0 ] == 'flexible_dates' ) {
                        $options[ $field[ 0 ] ] = empty( $_REQUEST[ 'flexible_dates' ] ) ? 0 : 1;
                    } //if ( $field[ 0 ] == 'flexible_dates' )
                } //$field[ 1 ] == 'checkbox'
            } //foreach( $arrayFields as $field)
            $preview = true;
            echo '<div id="bos_preview_title"><img src="' . esc_attr(BOS_PLUGIN_ASSETS) . '/images/preview_title.png" alt="Preview" /></div>';
            bos_create_searchbox( $options, $preview );
            die( );
        } //wp_verify_nonce( $_REQUEST[ 'nonce' ], 'bos_ajax_nonce' )
        else {
            die( 'There was an issue in the preview statement' );
        }
    } //isset( $_REQUEST[ 'nonce' ] )
}