(function($) {
    $(function() {

        // Check if affiliate placed partner's ID instead of affiliate ID
        if ($('#aid').length && $('#aid').val()[0] === '4') {
            alert(objectL10n.aid_starts_with_four);
            $('#aid').focus();
        }

        // Setup a click handler to initiate the Ajax request and handle the response
        $('#preview_button').click(function() {
            $(this).data('clicked', true);

            var ajax_loader = '<div id=\"bos_ajax_loader\"><h3>' + objectL10n.updating +
                '</h3>';
            /*ajax_loader = ajax_loader + '<img src=\"' ;
                ajax_loader = ajax_loader + objectL10n.images_js_path ;
                ajax_loader = ajax_loader + '\/ajax-loader.gif">' ;*/
            ajax_loader = ajax_loader + '</div>';
            $('#bos_preview').append(ajax_loader);
            $('#flexi_searchbox').css('opacity', '0.5');

            var data = {

                action: 'bos_preview', // The function for handling the request
                nonce: $('#bos_ajax_nonce').text(), // The security nonce
                aid: $('#aid').val(), // bgcolor
                destination: $('#destination').val(), // destination
                dest_id: $('#dest_id').val(),
                dest_type: $('#dest_type').val(),
                widget_width: $('#widget_width').val(), // widget_width
                widget_width_suffix: $('#widget_width_suffix').val(), // widget_width_suffix
                calendar: $('#calendar:checked').val(), // calendar
                flexible_dates: $('#flexible_dates:checked').val(), // flexible dates
                month_format: $('.month_format:checked').val(), // logodim
                logodim: $('.logodim:checked').val(), // logodim
                logopos: $('#logopos').val(), // logopos 
                preset_checkin_date: $('#preset_checkin_date').val(), // preset_checkin_date 
                preset_checkout_date: $('#preset_checkout_date').val(), // preset_checkout_date  
                buttonpos: $('#buttonpos').val(), // buttonpos  
                bgcolor: $('#bgcolor').val(), // bgcolor
                dest_bgcolor: $('#dest_bgcolor').val(), // dest bgcolor
                dest_textcolor: $('#dest_textcolor').val(), // dest textcolor
                headline_textsize: $('#headline_textsize').val(), // headline text size
                headline_textcolor: $('#headline_textcolor').val(), // headline textcolor
                textcolor: $('#textcolor').val(), // textcolor
                date_textcolor: $('#date_textcolor').val(), // date textcolor
                date_bgcolor: $('#date_bgcolor').val(), // date bgcolor
                flexdate_textcolor: $('#flexdate_textcolor').val(), // flexdate textcolor
                submit_bgcolor: $('#submit_bgcolor').val(), // submit_bgcolor
                submit_bordercolor: $('#submit_bordercolor').val(), // submit_bordercolor
                submit_textcolor: $('#submit_textcolor').val(), // submit_textcolor
                calendar_selected_bgcolor: $('#calendar_selected_bgcolor').val(), // calendar selected bgcolor
                calendar_selected_textcolor: $('#calendar_selected_textcolor').val(), // calendar selected textcolor
                calendar_daynames_color: $('#calendar_daynames_color').val(), // calendar daynames color
                maintitle: $('#maintitle').val(), // maintitle
                dest_title: $('#dest_title').val(), // destination  
                checkin: $('#checkin').val(), // checkin
                checkout: $('#checkout').val(), // checkout
                submit: $('#submit').val() // submit                

            };

            $.post(ajaxurl, data, function(response) {

                $('#bos_preview').html(response);
                $('#flexi_searchbox').css('opacity', '1');
                $('#bos_ajax_loader').empty();
                sp.starting.defaultSettings();
            });


        }); // $('#preview_button').click( function()


        // Setup a click handler to initiate the reset values button
        $('#reset_default').click(function() {

            //alert( 'values reset' );
            // Set all values to default values

            $('#aid').val(objectL10n.aid);
            $('#destination').val('');
            $('#dest_id').val('');
            $('#dest_type').val(objectL10n.dest_type);
            $('#display_in_custom_post_types').val('');
            $('#widget_width').val('');
            $('#widget_width_suffix').val('px');
            $('#calendar').val(objectL10n.calendar);
            $('.month_format').val(objectL10n.month_format);
            $('#flexible_dates').val(objectL10n.flexible_dates);
            $('.logodim').val(objectL10n.logodim);
            $('#logopos').val(objectL10n.logopos);
            //$( '#prot' ).val( objectL10n.prot ) ;
            $('#buttonpos').val(objectL10n.buttonpos);
            $('#bgcolor').val(objectL10n.bgcolor);
            $('#dest_bgcolor').val(objectL10n.dest_bgcolor);
            $('#dest_textcolor').val(objectL10n.dest_textcolor);
            $('#headline_textsize').val(objectL10n.headline_textsize);
            $('#headline_textcolor').val(objectL10n.headline_textcolor);
            $('#textcolor').val(objectL10n.textcolor);
            $('#date_textcolor').val(objectL10n.date_textcolor);
            $('#date_bgcolor').val(objectL10n.date_bgcolor);
            $('#flexdate_textcolor').val(objectL10n.flexdate_textcolor);
            $('#submit_bgcolor').val(objectL10n.submit_bgcolor);
            $('#submit_bordercolor').val(objectL10n.submit_bordercolor);
            $('#submit_textcolor').val(objectL10n.submit_textcolor);
            $('#calendar_selected_bgcolor').val('#0071c2');
            $('#calendar_selected_textcolor').val('#FFFFFF');
            $('#calendar_daynames_color').val('#003580');
            $('#maintitle').val('');
            $('#dest_title').val('');
            $('#checkin').val('');
            $('#checkout').val('');
            $('#submit').val('');

        }); // $('#reset_default').click( function()*/      


        // colour picker for specific fields    
        $(
            '#bgcolor,#textcolor,#dest_bgcolor,#dest_textcolor,#headline_textcolor,#date_textcolor,#date_bgcolor,#flexdate_textcolor,#submit_bgcolor,#submit_bordercolor,#submit_textcolor,#calendar_selected_bgcolor,#calendar_selected_textcolor,#calendar_daynames_color'
        ).wpColorPicker();

        //show/hide
        var item_handle = $('.bos_hide');
        var item_arrow = 'p > span';
        //var item_to_show =  $( '.bos_hide +  table.form-table' );

        item_handle.click(function() {
            $(this).next().toggle('fast');
            $(this).find(item_arrow).toggleClass('bos_open');
        });

        //Pick calendar for Preset chec-in and check-out dates
        $.datepicker.setDefaults({
          showOn: "both",//focus,click
          buttonImageOnly: true,
          buttonImage: objectL10n.images_js_path + "/b_calendar_icon.jpg",
          buttonText: objectL10n.calendar_open,
          dayNamesMin: [ objectL10n.su, objectL10n.mo, objectL10n.tu, objectL10n.we, objectL10n.th, objectL10n.fr, objectL10n.sa ],
          monthNames: [ objectL10n.january, objectL10n.february, objectL10n.march, objectL10n.april, objectL10n.may, objectL10n.june, objectL10n.july, objectL10n.august, objectL10n.september, objectL10n.october, objectL10n.november, objectL10n.december ]

        });
        $( "#preset_checkin_date, #preset_checkout_date" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
        


    });
})(jQuery);