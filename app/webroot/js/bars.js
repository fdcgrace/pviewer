$(function() {
    function ratingEnable() {
        $('.example-1to10').barrating('show', {
            theme: 'bars-1to10',
            onSelect:function(value) {
                    var id = $(this).attr('gval');
                    $.ajax({
                        type: "POST",
                        url: "pdetails/",
                        data: { 'progress' : value, 'id' : id},
                        success: function (data) {
                            location.reload();
                        }
                    });
                }    

        });

        $('.example-pill').barrating('show', {
            theme: 'bars-pill',
            initialRating: 'A',
            showValues: true,
            showSelectedRating: false,
            onSelect:function(value) {
                    var id = $(this).attr('gval');
                    $.ajax({
                        type: "POST",
                        url: "pdetails/",
                        data: { 'priority' : value, 'id' : id},
                        success: function (data) {
                            location.reload();
                        }
                    });
                }    
        });
    }

    function ratingDisable() {
        $('select').barrating('destroy');
    }

    $('.rating-enable').click(function(event) {
        event.preventDefault();

        ratingEnable();

        $(this).addClass('deactivated');
        $('.rating-disable').removeClass('deactivated');
    });

    $('.rating-disable').click(function(event) {
        event.preventDefault();

        ratingDisable();

        $(this).addClass('deactivated');
        $('.rating-enable').removeClass('deactivated');
    });

    ratingEnable();
});
