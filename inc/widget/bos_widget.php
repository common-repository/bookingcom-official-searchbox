<?php
/**
 * Bos Widget.
 * 
 * @package Booking Official Searchbox
 * 
 * @since 2.2.4
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'bos_searchbox_register_widgets' );
function bos_searchbox_register_widgets( ) {
    register_widget( 'bos_searchbox_widget' );
}
    
class bos_searchbox_widget extends WP_Widget {
    //process the new widget       
    function __construct( ) {
        parent::__construct( 'bos_searchbox_widget_class', // Base ID
            BOS_PLUGIN_NAME, // Name
            array(
                'description' => esc_html__( 'Display an accomodation search box', 'bookingcom-official-searchbox' ),
                'classname' => 'bos_searchbox_widget_class' 
            ) // Args
        );
    }
    // build widget settings form : this is only to display a save button on widget area. 
    // This is needed for plugins ( i.e. "Fixed Widget" ) using the save button for extra-option
    function form( $instance ) {
        echo '<p></p>';
    }
    //display the widget
    function widget( $args, $instance ) {
        extract( $args );
        echo $before_widget;
        //retrieve all options stored in DB
        $options = bos_searchbox_retrieve_all_user_options();
        $preview = false; //This is the front-end searchbox
        bos_create_searchbox( $options, $preview );
        echo $after_widget;
    }

    /**
	 * Register widget.
	 */
	public static function bos_register_widget() {
		register_widget( __CLASS__ );
	}
}