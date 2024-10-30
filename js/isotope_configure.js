jQuery(document).ready(function($) {

    // Initialize Isotope
    var Anims = parseInt(iig8_option.dgrid);
    if (isNaN(Anims)) {
        var trandsD = 400;
    } else {
        var trandsD = 0;
    }

    $grid = $('.IIG8_list').isotope({
        // options
        itemSelector: '.IIG8_list__item',
        transitionDuration: trandsD
    });
    $grid.isotope('shuffle');
    $grid .show();

    // Filter items on button click
    $('.IIG8_js_filter').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
        $('.IIG8_js_filter button').removeClass('is-active');
        $(this).addClass('is-active');
    });

    // Isotope Load more button

    var initShow = parseInt(iig8_option.per_page);
    var initLoadShow = parseInt(iig8_option.load_more);
    

    if (isNaN(initShow)) {
        initShow = 9;
    }
    if (isNaN(initLoadShow)) {
        initLoadShow = 3;
    }
    
    var initialV = initShow;
    var counter = initLoadShow;
    var iso = $grid.data('isotope');

    loadMore(initShow);

    function loadMore(toShow) {

        $grid.find(".hidden").removeClass("hidden");
        var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
            return item.element;
        });
        $(hiddenElems).addClass('hidden');
        $grid.isotope('layout');

        //when no more to load, hide show more button
        if (hiddenElems.length == 0) {
            $("#load-more").hide();
        } else {
            $("#load-more").show();
        }

    }

    //append load more button
    $grid.after('<div class="load-more-isotope"><button id="load-more"> Load More</button></div>');

    //when load more button clicked
    $("#load-more").click(function() {

        if ($('.IIG8_js_filter').data('clicked')) {
          //when filter button clicked, set initial value for counter
          counter = initLoadShow + initShow;
          $('.IIG8_js_filter').data('clicked', false);
        } else {
          counter = counter;
          counter = counter + initialV;
        };
        
        console.log(counter);
        loadMore(counter);
        initialV = initLoadShow;
    });


    //when filter button clicked
    $('.IIG8_js_filter').click(function() {
        $(this).data('clicked', true);

        loadMore(initShow);
    });


    // lightbox title set-up
    $(document).on('lity:ready', function(event, $lightbox) {
        var $triggeringElement = $lightbox.opener();
        $('.lity-content').append('<h2>' + $triggeringElement.data('title') + '</h2>');
    });


});