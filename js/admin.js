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

        $('#sa-search').submit(function() {
            disableAny($('#regionSelect'));
            disableAny($('#countrySelect'));
            disableAny($('#uniSelect'));
            return false;
        });

        $('#regionSelect').trigger('change');

        function disableAny(element) {
            console.log(element.val());
            if (element.val() === 'any') {
                element.prop('disabled', true);
            }
        }

        function insertOptions(val, level) {
            if (level == 'level2') {
                var ele = $('#countrySelect');
            } else if (level == 'level3') {
                var ele = $('#uniSelect');
            }

            var data = full_data[val];
            
            ele.empty();

            if (! data) {
                ele.append('<option disabled >...</option>');
                return;
            }

            for (var i = 0; i < data.length; i++) {
                var place = data[i];
                ele.append('<option value="'+place['slug']+'">'+place['name']+'</option>');
            }

            if (level == 'level2') {
                var nxt_val = ele.find(':selected').val();
                insertOptions(nxt_val, 'level3');
            }
        }
    })


    $(document).ready(function() {
        var $root = $('html, body')
        
        $(".smooth-scroll").on('click', function(event) {
            $root.animate(
              { scrollTop: $(this.hash).offset().top },
              1000,
            )});
    });


})(jQuery);

