(function($) {

    $('document').ready(function() {

        if (typeof uni_select_data === "undefined") {
            uni_select_data = {};
        }

        var full_data = uni_select_data;

        $('#regionSelect').on('change', function() {
            var region = $('#regionSelect').find(':selected').val();
            insertOptions(region, 'level2');
        });

        $('#countrySelect').on('change', function() {
            var country = $('#countrySelect').find(':selected').val();
            insertOptions(country, 'level3');
        });

        $('#ttable-addtime').on('click', function() {

            var index = $('#ttable-times .ttable-input').last().data('index');
            if (typeof index !== 'number') {
                index = 0;
            } else if (index >= 0) {
                index = index + 1;
            }

            var element = '<tr class="ttable-input" data-index=' + index + ' >';
            element += '<td><input name="ttable-times-meta[' + index + '][time]" type="text" placeholder="HH:MM" ></td>';
            element += '<td><input type="checkbox" name="ttable-times-meta[' + index + '][normal]" checked></td>';
            element += '<td><input type="checkbox" name="ttable-times-meta[' + index + '][longholiday]" checked></td>';
            element += '<td><input type="checkbox" name="ttable-times-meta[' + index + '][weekend]" checked></td></tr>';
            
            $('#ttable-times').append(element);
        })

        $('#ttable-removetime').on('click', function() {
            $('#ttable-times .ttable-input').last().remove();
        })

        $('#sd-adddates').on('click', function() {

            var index = $('#sd-dates .sd-input').last().data('index');
            if (typeof index !== 'number') {
                index = 0;
            } else if (index >= 0) {
                index = index + 1;
            }

            var element = '<div class="sd-input" data-index="'+ index +'" >';
            element += '<input type="date" name="sdates-meta['+ index +'][from]" > -> ';
            element += '<input type="date" name="sdates-meta['+ index +'][to]">';
            element += '</div>';

            $('#sd-dates').append(element);
        })

        $('#sd-removedates').on('click', function() {
            $('#sd-dates .sd-input').last().remove();
        })

        function insertOptions(val, level) {
            if (level == 'level2') {
                var ele = $('#countrySelect');
            } else if (level == 'level3') {
                var ele = $('#uniSelect');
            }

            var data = full_data[val];

            ele.empty();

            for (var i = 0; i < data.length; i++) {
                var place = data[i];
                ele.append('<option value="'+place['term_id']+'">'+place['name']+'</option>');
            }

            if (level == 'level2') {
                var nxt_val = ele.find(':selected').val();
                insertOptions(nxt_val, 'level3');
            }
        }
    })
})(jQuery);