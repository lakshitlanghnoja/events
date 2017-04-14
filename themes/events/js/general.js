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
    if ($("#duration-slider").length > 0) {
        var durationSlider = document.getElementById('duration-slider');
        var filter_duration = document.getElementById('filter_duration');
        noUiSlider.create(durationSlider, {
            start: $('#filter_duration').val(),
            tooltips: true,
            behaviour: 'tap',
            step: 1,
            range: {
                'min': 1,
                'max': 50,
            }
        });

		durationSlider.noUiSlider.on('update', function( values, handle ) {
			filter_duration.value = durationSlider.noUiSlider.get();			
		});
		
        // slider with tooltip
        var tipHandles = durationSlider.getElementsByClassName('noUi-handle'),
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
        var priceslider = document.getElementById('price-slider');
        var filter_price = document.getElementById('filter_price');
        noUiSlider.create(priceslider, {
            start: $('#filter_price').val(),
            tooltips: true,
            behaviour: 'tap',
            step: 1,
            range: {
                'min': 1,
                'max': 50,
            }
        });
		priceslider.noUiSlider.on('update', function( values, handle ) {
			filter_price.value = priceslider.noUiSlider.get();
		});

        // slider with tooltip
        var tipHandles = priceslider.getElementsByClassName('noUi-handle'),
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
	
	$("#galleryImageUpload").on('change', function () {

     //Get count of selected files
     var countFiles = $(this)[0].files.length;

     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#image-holder");
     image_holder.empty();

     if (extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {

                 var reader = new FileReader();
                 reader.onload = function (e) {
                     
					 $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
                     }).appendTo(image_holder);
                 }

                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }

         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }
});
	
});
