$(function() {

    // Nur auf der suchseite
    if($('body.suche')) {

        // Collapse State im Suchformular speichern
        $('.collapse').on('hidden.bs.collapse', function () {
            $('#hdn-collapse').val('collapsed');
        }).on('shown.bs.collapse', function () {
            $('#hdn-collapse').val('in');
        });

        // Reset Suchform
        $('#reset').click(function() {
            $('input[type=text]').attr('value', '');
        });

        // Erzeucgt clickbare <tr>-Elemente
        $('.clickable-row').click(function() {
            window.document.location = $(this).data('href');
        });

        // Bloodhound Datasource mit dynamischer URL
        function getBloodHound(url) {
            url += '/';

            return new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: url,
                    ttl: 600000 // 10 Minuten
                },
                remote: {
                    url: url + '%QUERY',
                    wildcard: '%QUERY'
                }
            });
        }

        // Typahead binden
        $('.typeahead').each(function () {
            if($(this).attr('data-typehead').length > 0) {
                $(this).typeahead(
                    {
                        highlight: true,
                        hint: true,
                        minLength: 0
                    },
                    {
                        display: 'value',
                        limit: 8,
                        source: getBloodHound('ajax/' + $(this).data('typehead').replace('-', '/'))
                    }
                );
            }
        }).on('focus', function () {
            $(this).typeahead('open');
        });



    } // if($('body.suche'))

    // Suche
    $('#form_freitext').focusin(function() {
        $(this).parent().addClass('hover');
    }).blur(function() {
        $(this).parent().removeClass('hover');
    });

    // Datepicker Options & Lokalisation
    var datepickerOptions = {
        'showDropdowns': true,
        'autoUpdateInput': false,
        'autoApply': true,
        'locale': {
            'format': 'DD.MM.YYYY',
            "separator": " - ",
            "applyLabel": "Übernehmen",
            "cancelLabel": "Abbrechen",
            "fromLabel": "Von",
            "toLabel": "Bis",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "So",
                "Mo",
                "Di",
                "Mi",
                "Do",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "Januar",
                "Februar",
                "März",
                "April",
                "Mai",
                "Juni",
                "Juli",
                "August",
                "September",
                "Oktober",
                "November",
                "Dezember"
            ],
            "firstDay": 1
        }
    };

    // Datepicker binden - Zeitraum
    $('.datepicker').daterangepicker(
        datepickerOptions
    ).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' bis ' + picker.endDate.format('DD.MM.YYYY'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Datepicker binden - Zeitraum rechtsbündig
    datepickerOptions.opens = 'left';
    $('.datepicker-right').daterangepicker(
        datepickerOptions
    ).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' bis ' + picker.endDate.format('DD.MM.YYYY'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Datepicker binden - Einfaches Datum
    datepickerOptions.opens = 'right';
    datepickerOptions.singleDatePicker = true;
    $('.datepicker-single').daterangepicker(
        datepickerOptions
    ).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD.MM.YYYY'));
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});