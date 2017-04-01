$(document).ready(function() {

    $("a[href='#']").click(function(e) {
        e.preventDefault();
    });

    //small header
    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) {
            $(".wrapper").addClass("small-header");
        } else {
            $(".wrapper").removeClass("small-header");
        }
    });

    //imagefill
    $(".thumb").imagefill();

    if ($(window).width() < 768) {
        //imagefill
        $("#banner-slider .carousel-inner .item").imagefill();
    }

    //datepicker
    $("#datepicker,#datepicker1,#datepicker2").datepicker();

    //UiSlider
    if ($("#slider-tooltip").length > 0) {
        var tooltipSlider = document.getElementById('slider-tooltip');
        var rangeSliderValueElement = document.getElementById('value-field');
        noUiSlider.create(tooltipSlider, {
            start: [0],
            tooltips: true,
            behaviour: 'tap',
            step: 10000,
            range: {
                'min': 0,
                'max': 100000,
            }
        });

        // slider with tooltip
        var tipHandles = tooltipSlider.getElementsByClassName('noUi-handle'),
            tooltips = [];

        // Add divs to the slider handles.
        for (var i = 0; i < tipHandles.length; i++) {
            tooltips[i] = document.createElement('div');
            tipHandles[i].appendChild(tooltips[i]);
        }
        //tooltips[0].className += 'range-tooltip';

        // When the slider changes, write the value to the tooltips.
        // tooltipSlider.noUiSlider.on('update', function(values, handle) {
        //     var num = format1(values[handle].substr(0, values[handle].length - 3));
        // });

    }

    //UiSlider
    if ($("#price-slider").length > 0) {
        var tooltipSlider = document.getElementById('price-slider');
        var rangeSliderValueElement = document.getElementById('value-field');
        noUiSlider.create(tooltipSlider, {
            start: [0],
            tooltips: true,
            behaviour: 'tap',
            step: 10000,
            range: {
                'min': 0,
                'max': 100000,
            }
        });

        // slider with tooltip
        var tipHandles = tooltipSlider.getElementsByClassName('noUi-handle'),
            tooltips = [];

        // Add divs to the slider handles.
        for (var i = 0; i < tipHandles.length; i++) {
            tooltips[i] = document.createElement('div');
            tipHandles[i].appendChild(tooltips[i]);
        }
        //tooltips[0].className += 'range-tooltip';

        // When the slider changes, write the value to the tooltips.
        // tooltipSlider.noUiSlider.on('update', function(values, handle) {
        //     var num = format1(values[handle].substr(0, values[handle].length - 3));
        // });

    }

    //Custom Dropdown
    $(".custom-dropdown").dropkick({
        mobile: true
    });

    //Mobile Menu
    $(".hamburger-icon").click(function() {
        $("html,body").toggleClass("menu-open");
        $("html").removeClass("open-filter");
    });

    //Checkbox
    $(".filter-block input,.checkbox-outer input").checkboxradio();

    //Map
    $(".btn-map").click(function() {
        $(this).closest(".wide-column").removeClass("shrinked");
    });

    $(".close-map").click(function() {
        $(this).closest(".wide-column").addClass("shrinked");
    });

    $(".btn-filter").click(function() {
        $("html").addClass("open-filter");
        $("html,body").removeClass("menu-open");
    });

    $(".close-filter").click(function() {
        $("html").removeClass("open-filter");
    });

    //accordion
    $(".faq-section li strong").click(function() {
        var $this = $(this).closest("li");
        if ($this.hasClass("active")) {
            $this.removeClass("active");
            $this.find(".faq-content").stop(true,true).slideUp();
        } else {
            $this.addClass("active");
            $this.siblings("li").removeClass("active").find(".faq-content").stop(true,true).slideUp();
            $this.find(".faq-content").stop(true,true).slideDown();
        }
    });

    //Vertical Tab
    $('#parentVerticalTab').easyResponsiveTabs({
        type: 'vertical',
        width: 'auto',
        fit: true,
        closed: 'accordion',
        tabidentify: 'hor_1',
        activate: function(event) {            
            var $tab = $(this);
            var $info = $('#nested-tabInfo2');
            var $name = $('span', $info);
            $name.text($tab.text());
            $info.show();
        }
    });

    //resize function
    $(window).resize(function() {
        $(".thumb").imagefill();

        if ($(window).width() < 768) {
            //imagefill
            $("#banner-slider .carousel-inner .item").imagefill();
        }
    });
});
