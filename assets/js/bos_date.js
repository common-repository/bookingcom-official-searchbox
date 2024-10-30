/*
This contains all the vars for the namespace */
/* Get current date*/
var my_date = new Date();
var b_gg_today = my_date.getDate();
var b_gg_tomorrow = b_gg_today + 1;
var b_mm_today = my_date.getMonth() + 1;
var b_yy_today = my_date.getFullYear();
var sp = sp || {};
sp.vars = {};
sp.vars.errors = {
    destinationErrorMsg: objectL10n.destinationErrorMsg,
    tooManyDays: objectL10n.tooManyDays,
    dateInThePast: objectL10n.dateInThePast,
    cObeforeCI: objectL10n.cObeforeCI
};
sp.vars.gen = {
    b_todays_date: b_yy_today + '-' + b_mm_today + '-' + b_gg_today,
    b_tomorrows_date: b_yy_today + '-' + b_mm_today + '-' + b_gg_tomorrow
};
booking = {};
booking.env = {};
sp.variables = {
    calendar_nextMonth: objectL10n.calendar_nextMonth,
    calendar_prevMonth: objectL10n.calendar_prevMonth,
    calendar_closeCalendar: objectL10n.calendar_closeCalendar,
    calendar_url: '',
    calendar_selected_bgcolor: objectL10n.calendar_selected_bgcolor,
    calendar_selected_textcolor: objectL10n.calendar_selected_textcolor,
    calendar_daynames_color: objectL10n.calendar_daynames_color,
    months: [objectL10n.january, objectL10n.february, objectL10n.march,
        objectL10n.april, objectL10n.may, objectL10n.june, objectL10n.july,
        objectL10n.august, objectL10n.september, objectL10n.october, objectL10n.november,
        objectL10n.december
    ],
    days: [objectL10n.mo, objectL10n.tu, objectL10n.we, objectL10n.th, objectL10n
        .fr, objectL10n.sa, objectL10n.su
    ],
    b_is_searchbox: true
};
// TODO: Sort all of the naming out. Once all of the products have been consolidated the name space needs cleaning up to stay consistent.
sp.gen = {
    difference: function(a, b) {
        return Math.abs(a - b);
    },
    id: function(elm) {
        return (elm) ? document.getElementById(elm) : false;
    }
};
// Calender
calendar = new Object();
tr = new Object();
var filaMonth;

function showCalendar(cal, dt, frm, m, y, d) {
    var d = document;

    if (d.getElementById) {
        var c = d.getElementById(cal),
            f = d.getElementById(frm);
        calendar.calfrm = frm;
        calendar.cal = c;
        calendar.caldt = dt;
        calendar.calf = f;
        var my = f[dt].value.split("-");
        y = my[0];
        m = my[1];
        d = my[2];

        buildCal(y, m, d);

        var prvw = document.getElementById('preview_button');
        if (prvw && prvw.dataset.clicked) {
            sp.example.calendarStyling();
        }

        c.style.position = "absolute";
        c.style.display = "block";
    }
}

function closeCal() {
    calendar.cal.style.display = 'none';
}

function buildCal(y, m, d) {
    var daysInMonth = [31, 0, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    td = new Date();
    if (!y) {
        y = td.getFullYear();
    }
    if (!m) {
        m = td.getMonth() + 1;
    }
    if (!d) {
        d = td.getDate;
    }
    var frm = calendar.calfrm;
    var dt = calendar.caldt;
    var mDate = new Date(y, m - 1, 1);
    var firstMonthDay = mDate.getDay();
    daysInMonth[1] = (((mDate.getFullYear() % 100 != 0) && (mDate.getFullYear() %
        4 == 0)) || (mDate.getFullYear() % 400 == 0)) ? 29 : 28;

    var t = '<div class="bos_calendar_month"><div class="bos_prev_controls">';

    var flm = td.getMonth() + 1;
    var flyr = td.getFullYear();
    for (p = 0; p <= 11; p++) {
        if (flm == m) {
            filaMonth = p;
        }
        flm++;
        if (flm > 12) {
            flm = 1;
            flyr++;
        }
    }

    if (filaMonth == 0) {
        t += '<span class="prevMonthDisabled">&nbsp;</span>';
    } else {
        t += '<a class="changeMonth" href="javascript:prevMonth(' + y + ',' + m +
            ');" title="' + sp.variables.calendar_prevMonth + '">';
            
            t += '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="presentation">';
                t += '<path d="M14.55 18a.74.74 0 0 1-.53-.22l-5-5A1.08 1.08 0 0 1 8.7 12a1.1 1.1 0 0 1 .3-.78l5-5a.75.75 0 0 1 1.06 0 .74.74 0 0 1 0 1.06L10.36 12l4.72 4.72a.74.74 0 0 1 0 1.06.73.73 0 0 1-.53.22zm-4.47-5.72zm0-.57z"></path>';
            t += '</svg>';
            
        t += '</a>';
    }

    t += '</div>';
    
    if (!sp.variables.b_hide_month_dd) {

        t +=
            '<div class="bos_month_wrapper"><select name="ym" class="selectMonth" disabled>';
        var mn = td.getMonth() + 1;
        var yr = td.getFullYear();
        for (n = 0; n <= 11; n++) {
            t += '<option value="' + mn + '"';
            if (mn == m) {
                t += ' selected="selected"';
            }
            t += '>' + sp.variables.months[mn - 1] + ' ' + yr + '</option>';
            mn++;
            if (mn > 12) {
                mn = 1;
                yr++;
            }
        }
        t += '</select></div>';
    }

    t += '<div class="bos_next_controls">';

    if (filaMonth == 11) {
        t += '<span class="nextMonthDisabled">&nbsp;</span>';
    } else {
        t += '<a class="changeMonth" href="javascript:nextMonth(' + y + ',' + m +
            ');" title="' + sp.variables.calendar_nextMonth + '">';
            
            t += '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="presentation">';
                t += '<path d="M9.45 6a.74.74 0 0 1 .53.22l5 5a1.08 1.08 0 0 1 .32.78 1.1 1.1 0 0 1-.32.78l-5 5a.75.75 0 0 1-1.06 0 .74.74 0 0 1 0-1.06L13.64 12 8.92 7.28a.74.74 0 0 1 0-1.06.73.73 0 0 1 .53-.22zm4.47 5.72zm0 .57z"></path>';
            t += '</svg>';
            
        t += '</a>';
    }

    t += '</div></div>';
    
    t += '<table class="bos-calendar__dates">';
    
        t += '<thead class="bos_calendar__row">';
        
            t += '<tr>';
    
                for (dn = 0; dn < 7; dn++) {
                    var cl = '';
                    var dnSt = '';
                    if ((dn % 7 == 5) || (dn % 7 == 6)) {
                        cl += ' b_calWeekend';
                    }
                    dnSt += 'style="color:'+ sp.variables.calendar_daynames_color +';"';
                    t += '<th scope="col" class="bos_calendar_day-name" '+ dnSt +'>' + sp.variables.days[dn] + '</th>';
                }

            t += '</tr>';

        t += '</thead>';

        t += '<tbody>';

            t += '<tr class="bos_calendar__row">';
                // Make the previous and next months dates appear. 
                if (sp.variables.full_dates) {
                    var getPrevMonth = (m - 1) - 1,
                        prevMonth = daysInMonth[getPrevMonth],
                        newMonth = 1;
                }
                for (i = 1; i <= 42; i++) {
                    var x = i - (firstMonthDay + 6) % 7,
                        prevM = 0,
                        nextM;
                    // This out puts the days in the month
                    if (x > daysInMonth[m - 1] || x < 1) {
                        if (sp.variables.full_dates) {
                            prevM = (x < 1) ? 1 : 0;
                            nextM = (x > daysInMonth[m - 1]) ? 1 : 0;
                        }
                        x = (!sp.variables.full_dates) ? '&nbsp;' : (x >= daysInMonth[m - 1]) ?
                            newMonth++ : (prevMonth - x);
                    }
                    var cl = '';
                    var stbg = '';
                    var stText = '';
                    var href = 0;
                    if (x > 0) {
                        var xDay = new Date(y, m - 1, x);
                        if ((xDay.getFullYear() == y) && (xDay.getMonth() + 1 == m) && (xDay.getDate() ==
                            d)) {
                            cl += 'b_calSelected';
                            stbg += 'style="background:' + sp.variables.calendar_selected_bgcolor + ';"';
                            stText += 'style="color:'+ sp.variables.calendar_selected_textcolor +';"';
                            href = 1;
                        }
                        if ((xDay.getFullYear() == td.getFullYear()) && (xDay.getMonth() == td.getMonth()) &&
                            (xDay.getDate() == td.getDate())) {
                            cl += ' b_calToday';
                            href = 1;
                        } else {
                            if (xDay > td && !prevM || sp.variables.full_dates && nextM && !prevM) {
                                cl += (nextM) ? 'nextMonth b_calFuture' : ' b_calFuture';
                                href = 1;
                            } else {
                                if (xDay < td || sp.variables.full_dates && prevM) {
                                    cl += 'disabled'
                                }
                            }
                        }
                    }else {
                        cl += 'empty';
                    };
                    t += '<td class="bos-calendar__date bos-calendar__date--' + cl + '" tabindex="-1" '+ stbg +'>';
                    if (href) {
                        t += '<span aria-label="' + x + '-' + m + '-' + y + '" role="checkbox" aria-checked="false"><span aria-hidden="true">';

                            t += '<a id="' + x + '-' + m + '-' + y +
                                '" class="calDateClick" href="javascript:pickDate(' + y + ',' + m + ',' +
                                x + ',\'' + dt + '\',\'' + frm + '\');" '+stText+'>' + x + '</a>';

                        t += '</span></span>';
                    } else {
                        t += x;
                    }
                    t += '</td>';
                    if (((i) % 7 == 0) && (i < 36)) {
                        t += '</tr><tr class="bos_calendar__row" tabindex="-1">';
                    }
                }
            t += '</tr>';
                    
            t += '<tr class="b_calClose"><td colspan="7"><a href="javascript:closeCal();">' +
                    sp.variables.calendar_closeCalendar + '</a></td>';
                    
            t += '</tr>';
            
        t += '</tbody></table>';

        document.getElementById("b_calendarInner").innerHTML = t;
}

function prevMonth(y, m) {
    if (new Date(y, m - 1, 1) < td) {
        return;
    }
    if (m > 1) {
        m--;
    } else {
        m = 12;
        y--;
    };
    buildCal(y, m);
}

function nextMonth(y, m) {
    if (m < 12) {
        m++;
    } else {
        m = 1;
        y++;
    }
    if (y > td.getFullYear() && m >= (td.getMonth() + 1)) {
        return;
    }
    buildCal(y, m);
}

function goMonth(m) {
    var y = td.getFullYear();
    if (m < td.getMonth() + 1) {
        y++;
    }
    buildCal(y, m);
}

function pickDate(y, m, d, dt, frm) {
    // set form values
    var checkin_date,
        checkin_date_text,
        checkout_date,
        checkout_date_text,
        dt = calendar.caldt,
        tInput,
        dDisplay;

    tickCheckBox('b_availcheck');
    moment.locale(objectL10n.language);
    if (dt == "b_checkin") {
        checkin_date = y + "-" + m + "-" + d;
        checkin_date_text = moment(checkin_date, "YYYY-MM-D").format('ddd D MMM YYYY');

        if (tInput = document.getElementById(dt)) {
            tInput.value = checkin_date;
        }
        if (dDisplay = document.getElementById('bos-date_' + dt)) {
            dDisplay.innerHTML = checkin_date_text;
        }
        checkDateOrder(calendar.calfrm, 'b_checkin', 'b_checkout');
    }
    if (dt == 'b_checkout') {
        checkout_date = y + "-" + m + "-" + d;
        checkout_date_text = moment(checkout_date, "YYYY-MM-D").format('ddd D MMM YYYY');

        if (tInput = document.getElementById(dt)) {
            tInput.value = checkout_date;
        }
        if (dDisplay = document.getElementById('bos-date_' + dt)) {
            dDisplay.innerHTML = checkout_date_text;
        }
        checkDateOrder(calendar.calfrm, 'b_checkin', 'b_checkout');
    }
    closeCal();
}

function checkDateOrder(frm, ci_date, co_date) {
    var frm = document.getElementById(frm),
        my = frm[ci_date].value.split("-"),
        ci = new Date(my[0], my[1] - 1, my[2], 12, 0, 0, 0);
    // create date object from checkout values
    my = frm[co_date].value.split("-");
    var co = new Date(my[0], my[1] - 1, my[2], 12, 0, 0, 0);
    // if checkin date is at or after checkout date,
    // add a day full of milliseconds, and set the
    // selectbox values for checkout date to new value
    if (ci >= co) {
        co.setTime(ci.getTime() + 1000 * 60 * 60 * 24);
        frm[co_date].value = co.getDate();
        var com = co.getMonth() + 1;
        frm[co_date].value = co.getFullYear() + "-" + com;
        var tInput, checkout_date, checkout_date_text;
        if (tInput = document.getElementById(co_date)) {
            tInput.value = co.getFullYear() + "-" + com + "-" + co.getDate();
        }
        checkout_date = co.getFullYear() + "-" + com + "-" + co.getDate();
        checkout_date_text = moment(checkout_date, "YYYY-MM-D").format('ddd D MMM YYYY');
        if (dDisplay = document.getElementById('bos-date_' + co_date)) {
            dDisplay.innerHTML = checkout_date_text;
        }
    }
}

function tickCheckBox(a) {
    if (document.getElementById(a)) {
        document.getElementById(a).checked = true;
    }
    return true;
}