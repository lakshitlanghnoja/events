<?php
//echo "<pre/>"; print_r($data); exit;
?>
<style>
    .thumb-image {
        width:125px;
        height:125px;
    }
</style>

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">

                <div>
                    <h3 class="text-center">Create your event</h3>
                    <form enctype="multipart/form-data" action="<?php echo site_url('events/create'); ?>" id="eventForm" method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control border-input" placeholder="Title">
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4 checkbox-outer radio-outer">
                                <h4>Transportation</h4>
                                <label for="radio-1">self</label>
                                <input type="radio" value="self" name="transportation" id="radio-1">
                                <label for="radio-2">pickup only</label>
                                <input type="radio" value="pickup" name="transportation" id="radio-2">
                                <label for="radio-3">pickup &amp; drop</label>
                                <input type="radio" value="both" name="transportation" id="radio-3">
                            </div>

                            <div class="form-group col-sm-8">
                                <h4>Price</h4>
                                <div id="price-event"></div>
                                <input type="hidden" name="price" id="eventPrice" value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <h4>Choose Gallery Images</h4>
                            <input type="file" class="form-control border-input" id="galleryImageUpload" name="galleryImages[]" multiple/>
                            <div id="image-holder"></div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h4>Number Of Seat</h4>
                                <div id="seat-event"></div>
                                <input type="hidden" name="seats" id="eventSeat" value="0" />
                            </div>

                            <div class="form-group col-sm-6">
                                <h4>Duration</h4>
                                <div id="duration-event"></div>
                                <input type="hidden" name="duration" id="eventDuration" value="0" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h4>Start Date</h4>
                                <input type="text" id="datepicker2" name="startDate" class="form-control border-input" placeholder="Start Date">
                            </div>
                            <div class="form-group col-sm-6">
                                <h4>Start Time</h4>
                                <input type="text" id="startTime" name="startTime" class="form-control border-input" placeholder="Start Time">

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="map_canvas"></div>
                                </div>
                                <div class="row" id="source_address">

                                    <div class="form-group col-md-12">
                                        <h4>Source Address</h4>
                                        <input type="text" id="searchSourceAddress" class="form-control border-input" placeholder="Search Source Address">
<!--                                        <input id="find1" type="button" value="find" />-->
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="text" readonly="true" id="SourceAddress" name="formatted_address" class="form-control border-input" placeholder="Source Address">
                                        <input type="hidden" name="sourceAddress" value="" id="hiddenSourceAddress"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="SourceCity" name="locality" class="form-control border-input" placeholder="Source City">
                                        <input type="hidden" name="sourceCity" value="" id="hiddenSourceCity"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="SourceState" name="administrative_area_level_1" class="form-control border-input" placeholder="Source State">
                                        <input type="hidden" name="sourceState" value="" id="hiddenSourceState"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="SourceCountry" name="country" class="form-control border-input" placeholder="Source Country">
                                        <input type="hidden" name="sourceCountry" value="" id="hiddenSourceCountry"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="SourceZip" name="postal_code" class="form-control border-input" placeholder="Source Zipcode">
                                        <input type="hidden" name="sourceZip" value="" id="hiddenSourceZip"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="SourceLat" name="lat" class="form-control border-input" placeholder="Source Latitude">
                                        <input type="hidden" name="SourceLat" value="" id="hiddenSourceLat"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="SourceLong" name="lng" class="form-control border-input" placeholder="Source Longitude">
                                        <input type="hidden" name="Sourcelong" value="" id="hiddenSourceLong"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">                                
                                <div class="row" id="destination_address">

                                    <div class="form-group col-md-12">
                                        <h4>Source Address</h4>
                                        <input type="text" id="searchDestinationAddress" class="form-control border-input" placeholder="Search Destination Address">                                        
<!--                                        <input id="find1" type="button" value="find" />-->
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="text" readonly="true" id="DestinationAddress" name="formatted_address" class="form-control border-input" placeholder="Destination Address">
                                        <input type="hidden" name="destinationAddress" value="" id="hiddenDestinationAddress"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="DestinationCity" name="locality" class="form-control border-input" placeholder="Destination City">
                                        <input type="hidden" name="destinationCity" value="" id="hiddenDestinationCity"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="DestinationState" name="administrative_area_level_1" class="form-control border-input" placeholder="Destination State">
                                        <input type="hidden" name="destinationState" value="" id="hiddenDestinationState"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="DestinationCountry" name="country" class="form-control border-input" placeholder="Destination Country">
                                        <input type="hidden" name="destinationCountry" value="" id="hiddenDestinationCountry"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="DestinationZip" name="postal_code" class="form-control border-input" placeholder="Destination Zipcode">
                                        <input type="hidden" name="destinationZip" value="" id="hiddenDestinationZip"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="DestinationLat" name="lat" class="form-control border-input" placeholder="Destination Latitude">
                                        <input type="hidden" name="destinationLat" value="" id="hiddenDestinationLat"/>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" readonly="true" id="DestinationLong" name="lng" class="form-control border-input" placeholder="Destination Longitude">
                                        <input type="hidden" name="destinationLong" value="" id="hiddenDestinationLong"/>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <textarea class="form-control border-input" name="aboutEvent" placeholder="About Event"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control border-input" name="aboutSafety" placeholder="About Safety"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control border-input" name="specialRequirement" placeholder="Special Requirement"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">					
                            <button type="submit" id="createEventSubmit" name="createEvent" value="Create" class="btn-secondary btn-small">Create</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDlCBiX6WhItj1nmcQ2pyqQYa7217oXuDI"></script>

<script>
    $(function () {
        $("#searchSourceAddress").geocomplete({
            map: ".map_canvas",
            details: "#source_address",
            types: ["geocode", "establishment"],

        });

        $("#searchDestinationAddress").geocomplete({
            map: ".map_canvas",
            details: "#destination_address",
            types: ["geocode", "establishment"],
        });

//        $('#createSubmit').click(function () {
//            $("#source_address").find("input[type=text]").each(function () {
//                console.log(this.id);
//                if (this.id != 'searchSourceAddress') {
//                    $('#hidden' + this.id).val($('#' + this.id).val());
//                }
//            });
//
//            $("#destination_address").find("input[type=text]").each(function () {
//                console.log(this.id);
//                if (this.id != 'searchDestinationAddress') {
//                    $('#hidden' + this.id).val($('#' + this.id).val());
//                }
//            });
//
//        });

        if ($("#duration-event").length > 0) {
            var durationEvent = document.getElementById('duration-event');
            var eventDuration = document.getElementById('eventDuration');
            noUiSlider.create(durationEvent, {
                start: $('#eventDuration').val(),
                tooltips: true,
                behaviour: 'tap',
                step: 1,
                range: {
                    'min': 1,
                    'max': 50,
                }
            });
            durationEvent.noUiSlider.on('update', function (values, handle) {
                eventDuration.value = durationEvent.noUiSlider.get();
            });
        }

        if ($("#price-event").length > 0) {
            var priceEvent = document.getElementById('price-event');
            var eventPrice = document.getElementById('eventPrice');
            noUiSlider.create(priceEvent, {
                start: $('#eventPrice').val(),
                tooltips: true,
                behaviour: 'tap',
                step: 1,
                range: {
                    'min': 1,
                    'max': 100,
                }
            });
            priceEvent.noUiSlider.on('update', function (values, handle) {
                eventPrice.value = priceEvent.noUiSlider.get();
            });
        }

        if ($("#seat-event").length > 0) {
            var seatslider = document.getElementById('seat-event');
            var eventSeat = document.getElementById('eventSeat');
            noUiSlider.create(seatslider, {
                start: $('#eventSeat').val(),
                tooltips: true,
                behaviour: 'tap',
                step: 1,
                range: {
                    'min': 1,
                    'max': 50,
                }
            });
            seatslider.noUiSlider.on('update', function (values, handle) {
                eventSeat.value = seatslider.noUiSlider.get();
            });
        }

    });
</script>