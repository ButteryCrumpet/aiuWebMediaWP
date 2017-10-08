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
            $('#ttable-times').append('<div class="ttable-input"><input name="ttable-times-meta[]" placeholder="HH:MM" type="text"><br></div>');
        })

        $('#ttable-removetime').on('click', function() {
            $('#ttable-times > .ttable-input').last().remove();
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