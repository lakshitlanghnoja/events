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
                    <form enctype="multipart/form-data" action="<?php echo site_url('events/create'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control border-input" placeholder="Title">
                        </div>
                        <div class="form-group checkbox-outer radio-outer">
                            <h4>Transportation</h4>
                            <label for="radio-1">self</label>
                            <input type="radio" name="radio" id="radio-1">
                            <label for="radio-2">pickup only</label>
                            <input type="radio" name="radio" id="radio-2">
                            <label for="radio-3">pickup &amp; drop</label>
                            <input type="radio" name="radio" id="radio-3">
                        </div>

                        <div class="form-group">
                            <h4>Choose Gallery Images</h4>
                            <input type="file" class="form-control border-input" id="galleryImageUpload" name="galleryImages[]" multiple/>
                            <div id="image-holder"></div>
                        </div>	


                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h4>Price</h4>
                                <div id="price-slider"></div>
                            </div>
                            <div class="form-group col-sm-6">
                                <h4>Duration</h4>
                                <div id="slider-tooltip"></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h4>Start Date</h4>
                                <input type="text" id="datepicker1" class="form-control border-input" placeholder="Start Date">
                            </div>
                            <div class="form-group col-sm-6">
                                <h4>Number Of Sheets</h4>
                                <div id="price-slider"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="text" id="searchAddress" class="form-control border-input" placeholder="Search Source Address">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="text" id="sourceAddress" class="form-control border-input" placeholder="Source Address">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="sourceCity" class="form-control border-input" placeholder="Source City">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="sourceState" class="form-control border-input" placeholder="Source State">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="sourceCountry" class="form-control border-input" placeholder="Source Country">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="sourceZip" class="form-control border-input" placeholder="Source Zipcode">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="sourceLat" class="form-control border-input" placeholder="Source Latitude">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="sourceLong" class="form-control border-input" placeholder="Source Longitude">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="text" id="searchAddress" class="form-control border-input" placeholder="Search Destination Address">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="text" id="destinationAddress" class="form-control border-input" placeholder="Destination Address">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="destinationCity" class="form-control border-input" placeholder="Destination City">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="destinationState" class="form-control border-input" placeholder="Destination State">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="destinationCountry" class="form-control border-input" placeholder="Destination Country">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="destinationZip" class="form-control border-input" placeholder="Destination Zipcode">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="destinationLat" class="form-control border-input" placeholder="Destination Latitude">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" id="destinationLong" class="form-control border-input" placeholder="Destination Longitude">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <textarea class="form-control border-input" placeholder="About Event"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">					
                            <button type="submit" name="createEvent" value="Create" class="btn-secondary btn-small">Create</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>