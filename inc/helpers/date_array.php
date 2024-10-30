<?php
/**
 * Dates helpers.
 * @package Booking Official Searchbox\Helpers
 * @since 2.2.4
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'bos_dateSelector' ) ) :

    function bos_dateSelector( $calendar, $checkin, $checkout, $date_bgcolor, $date_textcolor, $preset_checkin_date, $preset_checkout_date ) {

        /* create all variables */
        /* Detect language */
        $wp_system_language = get_locale();

        $checkin      = $checkin ? $checkin : esc_html__( 'Check-in date', 'bookingcom-official-searchbox' );
        $checkout     = $checkout ? $checkout : esc_html____( 'Check-out date', 'bookingcom-official-searchbox' );
        $date_textcolor    = $date_textcolor ? 'color:' . esc_attr($date_textcolor) . ';' : 'color: #003580;';
        $date_bgcolor = $date_bgcolor ? 'background:' . esc_attr($date_bgcolor) . ';' : '';
        $currentDate  = time();
        $currentDateDate = date('Y-m-d');
        if ($wp_system_language == 'de_DE') {
            $currentDateText = date_i18n('D. d M Y', $currentDate);
        } else {
            $currentDateText = date_i18n('D d M Y', $currentDate);
        }
        /* add one day to today in seconds*/
        $nextDate     = $currentDate + ( 1 * 24 * 60 * 60 );
        $nextDateDate = date('Y-m-d', strToTime('+1 day'));
        if ($wp_system_language == 'de_DE') {
            $nextDateText = date_i18n('D. d M Y', $nextDate);
        } else {
            $nextDateText = date_i18n('D d M Y', $nextDate);
        }

        //Retrieve check-in and check-out preset if any
        if( !empty($preset_checkin_date) && (new DateTime($preset_checkin_date) > new DateTime()) ) {
            $currentDate  = date('Y-m-d', strtotime( $preset_checkin_date ));
            $currentDateText = date_i18n('D d M Y', strtotime($preset_checkin_date));
            $tomorrow     = strtotime( $preset_checkin_date ) + ( 1 * 24 * 60 * 60 );
            $nextDate  = date('Y-m-d', $tomorrow);
            if ($wp_system_language == 'de_DE') {
                $nextDateText = date_i18n('D. d M Y', $tomorrow);
            } else {
                $nextDateText = date_i18n('D d M Y', $tomorrow);
            }
        }

        if( !empty($preset_checkout_date) && (new DateTime($preset_checkout_date) > new DateTime())) {
            $nextDate  = date('Y-m-d', strtotime( $preset_checkout_date ));
            if ($wp_system_language == 'de_DE') {
                $nextDateText = date('D. d M Y', strtotime($preset_checkout_date));
            } else {
                $nextDateText = date('D d M Y', strtotime($preset_checkout_date));
            }
        }

        if( $wp_system_language == 'ja' ) {
            /*  CHECKIN STARTS*/
            echo '<div id="b_searchCheckInDate" class="bos-dates__col bos_lang_'. esc_attr($wp_system_language) .'" data-dates="b_checkin" style="' . esc_attr($date_bgcolor) . '">';
            echo '<h4 id="checkInDate_h4" style="' . esc_attr($date_textcolor) . '">' . esc_html($checkin) . '</h4>';
            echo '<div class="b_searchDatesInner">';

            echo '<div class="bos-date-field__display bos-date__checkin" id="bos-date_b_checkin" style="' . esc_attr($date_textcolor) . '">'. esc_html($currentDateText) .'</div><input type="hidden" name="checkin" value="'.esc_attr($currentDateDate).'" id="b_checkin">';

            echo '</div>';
            echo '</div>';
            /* CHECKOUT STARTS */
            /* make checkout day selector - default tomorrow */
            echo '<div id="b_searchCheckOutDate" class="bos-dates__col bos_lang_'. esc_attr($wp_system_language) .'" data-dates="b_checkout" style="' . esc_attr($date_bgcolor) . '">';
            echo '<h4 id="checkOutDate_h4" style="' . esc_attr($date_textcolor) . '">' . esc_html($checkout) . '</h4>';
            echo '<div class="b_searchDatesInner">';

            echo '<div class="bos-date-field__display bos-date__checkout" id="bos-date_b_checkout" style="' . esc_attr($date_textcolor) . '">'. esc_html($nextDateText) .'</div><input type="hidden" name="checkout" value="'.esc_attr($nextDateDate).'" id="b_checkout">';
 
            echo '</div>';                
            echo '</div>';

        }
        /* FINISH JAPANESE EXPCEPTION SWITCH BETWEEN DAYS AND MONTH-YEAR*/

        else {
            /*  CHECKIN STARTS FOR ALL OTHER LANGUAGES */
            echo '<div id="b_searchCheckInDate" class="bos-dates__col '. esc_attr($wp_system_language) .'" data-dates="b_checkin" style="' . esc_attr($date_bgcolor) . '">';
            echo '<h4 id="checkInDate_h4" style="' . esc_attr($date_textcolor) . '">' . esc_html($checkin) . '</h4>';
            echo '<div class="b_searchDatesInner">';

            echo '<div class="bos-date-field__display bos-date__checkin" id="bos-date_b_checkin" style="' . esc_attr($date_textcolor) . '">'. esc_html($currentDateText) .'</div><input type="hidden" name="checkin" value="'.esc_attr($currentDateDate).'" id="b_checkin">';

            echo '</div>';
            echo '</div>';
            /* CHECKOUT STARTS */
            /* make checkout day selector - default tomorrow */
            echo '<div id="b_searchCheckOutDate" class="bos-dates__col '. esc_attr($wp_system_language) .'" data-dates="b_checkout" style="' . esc_attr($date_bgcolor) . '">';
            echo '<h4 id="checkOutDate_h4" style="' . esc_attr($date_textcolor) . '">' . esc_html($checkout) . '</h4>';
            echo '<div class="b_searchDatesInner">';

            echo '<div class="bos-date-field__display bos-date__checkout" id="bos-date_b_checkout" style="' . esc_attr($date_textcolor) . '">'. esc_html($nextDateText) .'</div><input type="hidden" name="checkout" value="'.esc_attr($nextDateDate).'" id="b_checkout">';

            echo '</div>';                
            echo '</div>';
        } // if( $wp_system_language == 'ja' )
    }

endif;