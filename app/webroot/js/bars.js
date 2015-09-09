$(function() {
    function ratingEnable() {
        $('.example-1to10').barrating('show', {
            theme: 'bars-1to10',
            onSelect:function(value) {
                    var id = $(this).attr('gval');
                    //alert('Selected rating: ' + value+'-'+id);
                    $.ajax({
                        type: "POST",
                        url: "pdetails/",
                        data: { 'progress' : value, 'id' : id},
                        success: function (data) {
                            // location.reload();
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
                   // alert('Selected rating: ' + value+'-'+id);
                    $.ajax({
                        type: "POST",
                        url: "pdetails/",
                        data: { 'priority' : value, 'id' : id},
                        success: function (data) {
                            // location.reload();
                        }
                    });
                }    
        });

        $('#example-reversed').barrating('show', {
            theme: 'bars-reversed',
            showSelectedRating: true,
            reverse: true
        });

        $('#example-horizontal').barrating('show', {
            theme: 'bars-horizontal',
            reverse: true
        });

        $('#example-fontawesome').barrating({
            theme: 'fontawesome-stars',
            showSelectedRating: false
        });

        $('#example-css').barrating({
            theme: 'css-stars',
            showSelectedRating: false
        });

        $('#example-bootstrap').barrating({
            theme: 'bootstrap-stars',
            showSelectedRating: false
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
