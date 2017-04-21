<?php
$ci = get_instance(); // CI_Loader instance
$login = ((isset($ci->session->userdata['front']['logged_in'])) && $ci->session->userdata['front']['logged_in'] == 1) ? $ci->session->userdata['front']['logged_in'] : 0;
?>

<style>
    .taxDescriptionTable{width: 100%;}
    .taxDescriptionTable .valueCell{text-align: left; padding-left: 15px; width: 11%;}
</style>

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" role="listbox">
                        <?php
                        $galleryImages = $data['gallery_images'];
                        if ($galleryImages != '') {
                            $images = explode(',', $galleryImages);
                            if (is_array($images) && !empty($images)) {
                                $activeClass = 'active';
                                $baseGalleryImageURL = $ci->config->item('eventGalleryImageURL');
                                foreach ($images as $image) {
                                    ?>
                                    <div class="item <?php echo $activeClass; ?>">
                                        <img src="<?php echo $baseGalleryImageURL . $image; ?>" >
                                    </div>
                                    <?php
                                    $activeClass = '';
                                }
                            }
                        }
                        ?>                        
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="fa fa-angle-left" aria-hidden="true"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="fa fa-angle-right" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="description-outer">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#about-the-event" data-toggle="tab">About the event</a></li>
                        <li role="presentation"><a href="#about-the-host" data-toggle="tab">About the host</a></li>
                        <?php
                        if (isset($data['about_safety']) && $data['about_safety'] != '') {
                            ?>
                            <li role="presentation"><a href="#about-the-safety" data-toggle="tab">About the safety</a></li>
                            <?php
                        }
                        if (isset($data['special_requirement']) && $data['special_requirement'] != '') {
                            ?>
                            <li role="presentation"><a href="#sepcial-requirement" data-toggle="tab">Special Requirement</a></li>
                            <?php
                        }
                        ?>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="about-the-event">                            
                            <div class="row">
                                <div class="col-md-3 col-sm-4">            
                                    <?php
                                    if (isset($data['display_image']) && !empty($data['display_image'])) {
                                        ?>
                                        <span class="thumb">
                                            <img src="<?php echo $baseGalleryImageURL . $data['display_image']; ?>">  
                                        </span>
                                        <?php
                                    }
                                    ?>                                                                          
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <div class="clearfix">
                                        <h4 class="pull-left"><?php echo $data['title']; ?></h4>
                                        <?php
                                        $totalStar = 0;
                                        if (isset($data['event_rating']) && !empty($data['event_rating']) && is_numeric($data['event_rating'])) {
                                            $totalStar = ceil($data['event_rating']);
                                        }
                                        ?>
                                        <div class="pull-right">
                                            <?php
                                            for ($i = 0; $i < $totalStar; $i++) {
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <?php
                                            }
                                            for ($i = 0; $i < (5 - $totalStar); $i++) {
                                                ?>
                                                <i class="fa fa-star-o"></i>
                                                <?php
                                            }
                                            ?>
                                        </div>


                                    </div>
                                    <ul class="service-details">
                                        <li>
                                            <label>Primary location:</label>
                                            <?php echo $data['source_city'] . ', ' . $data['source_state'] ?>
                                        </li>
                                        <li>
                                            <label>Duration:</label>
                                            <?php echo $data['duration']; ?> hours
                                        </li>
                                        <li>
                                            <?php
                                            $totalJoined = 0;
                                            if (isset($data['userJoined']) && !empty($data['userJoined']) && is_numeric($data['userJoined'])) {
                                                $totalJoined = $data['userJoined'];
                                            }
                                            $sheetsLeft = $data['sheet'] - $totalJoined;
                                            ?>
                                            <label>No. of seats left:</label>
                                            <?php echo $sheetsLeft; ?> / <?php echo $data['sheet']; ?>
                                        </li>
                                        <li>
                                            <label>Transportation:</label>
                                            <?php echo $data['transportation']; ?>
                                        </li>
                                    </ul>                                    
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="about-the-host">
                            <h3>About the host</h3>
                            <p><?php echo $data['about_me']; ?></p>
                        </div>
                        <?php
                        if (isset($data['about_safety']) && $data['about_safety'] != '') {
                            ?>
                            <div role="tabpanel" class="tab-pane" id="about-the-safety">
                                <h3>About the safety</h3>
                                <p><?php echo $data['about_safety']; ?></p>
                            </div>
                            <?php
                        }
                        if (isset($data['special_requirement']) && $data['special_requirement'] != '') {
                            ?>
                            <div role="tabpanel" class="tab-pane" id="sepcial-requirement">
                                <h3>Special Requirements</h3>
                                <p><?php echo $data['special_requirement']; ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="event-map" id="map">

                </div>

                <form class="event-form">
                    <h4>No. of members</h4>
                    <div class="form-group">
                        <?php
                        $totalSheets = $data['sheet'];
                        $disable = ($sheetsLeft == 0) ? 'disabled="disabled"' : '';
                        ?>
                        <select class="custom-dropdown" id="totalSheets" name="totalSheets" <?php echo $disable; ?>>
                            <?php
                            if ($sheetsLeft != 0) {
                                for ($i = 1; $i <= $sheetsLeft; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="">All sheets are booked</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <?php
                        $totalAmount = $data['price'];
                        $tax = 0;
                        if (isset($tax_persent) && $tax_persent != 0) {
                            $tax = ((isset($tax_persent['tax'])) && $tax_persent['tax'] != '') ? $tax_persent['tax'] : 0;

                            if ($tax != 0) {
                                $tax = $tax_persent['tax'];
                                $tax_amount = $data['price'] * ($tax_persent['tax'] / 100);
                                $totalAmount = $data['price'] + $tax_amount;
                                ?>
                                <div class="row">
                                    <table class="taxDescriptionTable">
                                        <tr>
                                            <td class="lableCell"><label>Event Amount:</label></td>
                                            <td class="valueCell">$<?php echo $data['price']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="lableCell"><label>Tax:</label></td>
                                            <td class="valueCell"><?php echo $tax_persent['tax']; ?>%</td>
                                        </tr>
                                        <tr>
                                            <td class="lableCell"><label>Total:</label></td>
                                            <td class="valueCell"><span id="totalAmountDiv"> $<?php echo $data['price'] + $tax_amount; ?></span></td>
                                        </tr>
                                    </table>
                                </div>

                                <?php
                            } else {
                                ?>
                                <label>Total:</label>
                                <strong id="totalAmountDiv">$<?php echo $data['price']; ?>/ Per Person</strong>
                                <?php
                            }
                        } else {
                            ?>
                            <label>Total:</label>
                            <strong id="totalAmountDiv">$<?php echo $data['price']; ?>/ Per Person</strong>
                            <?php
                        }
                        ?>

                    </div>
                    <input type="hidden" id="eventAmount" name="eventAmount" value="<?php echo $data['price']; ?>">
                    <input type="hidden" id="tax" name="tax" value="<?php echo $tax; ?>">
                    <!--<input type="hidden" id="totalAmount" name="amount" value="<?php //echo $totalAmount;     ?>">-->


                    <?php
                    $disable = ($sheetsLeft < 1) ? 'disabled="disabled"' : '';
                    ?>
                    <span class="clearfix">
                        <button id="join_event" class="btn-secondary btn-small pull-right"  <?php echo $disable; ?> login="<?php echo $login; ?>">Join</button>
                        <span id="join_message" class="clearfix"></span>
                    </span>

                </form>
            </div>
        </div>
    </div>
</section>
<?php
//echo "<pre>"; print_r($data); echo "</pre>";
?>
<!-- Paypal Form -->
<form id="event_join_form" action="<?php echo base_url('events/joinevent'); ?>" method="post">
    <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo $ci->config->item('admin_paypal_id'); ?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="item_name" value="<?php echo $data['title']; ?>">
    <input type="hidden" id="totalAmount" name="amount" value="<?php echo $totalAmount; ?>">  
    <input type="hidden" id="event_id" name="event_id" value="<?php echo $data['id']; ?>">
    <input type="hidden" id="total_sheet_booked" name="total_sheet" value="">
</form>



<input type="hidden" id="source_lat" value="<?php echo $data['source_lat']; ?>">
<input type="hidden" id="source_lng" value="<?php echo $data['source_lng']; ?>">
<input type="hidden" id="destination_lat" value="<?php echo $data['destination_lat']; ?>">
<input type="hidden" id="destination_lng" value="<?php echo $data['destination_lng']; ?>">
<input type="hidden" id="source_address" value="<?php echo $data['source_address'] . '<br/>' . $data['source_city'] . '<br/>' . $data['source_state'] . '<br/>' . $data['source_country']; ?>">
<input type="hidden" id="destination_address" value="<?php echo $data['destination_address'] . '<br/>' . $data['destination_city'] . '<br/>' . $data['destination_state'] . '<br/>' . $data['destination_country']; ?>">

<script>


    $ = jQuery.noConflict();

    $(document).ready(function () {
        $('#totalSheets').change(function () {
            var totalSheets = $(this).val();
            var eventAmount = $('#eventAmount').val();
            var tax = $('#tax').val();
            totalEventAmount = (eventAmount * totalSheets);
            taxAmount = totalEventAmount * (tax / 100);
            totalAmount = totalEventAmount + taxAmount;
            $('#totalAmount').val(totalAmount);
            $('#totalAmountDiv').text('$' + totalAmount);
        });

        $('#join_event').click(function (e) {
            e.preventDefault();
            var login = $(this).attr('login');
            if (login == 0) {
                $('#join_message').html('<label class="error">Please login to site to join an event.</label>');
            } else {
                $('#join_message').html('<label class="success">Please wait. Page will redirect to payment site.</label>');

                $('#total_sheet_booked').val($('#totalSheets').val());

                $('#event_join_form').submit();
            }
        });
    });


    function initMap() {
        var s_lat = $('#source_lat').val();
        var s_lgt = $('#source_lng').val();

        var d_lat = $('#destination_lat').val();
        var d_lgt = $('#destination_lng').val();
//        var uluru = {lat: lat, lng: lgt};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            zoomControl: true,
            panControl: false,
            scaleControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            scrollwheel: false,
        });
        var flag = 0;
        var sourceInfoBox = '';
        var destinationInfoBox = '';
        var infowindow = '';
        var infowindow_destination = '';

        if ((d_lat == s_lat) && (s_lgt == d_lgt)) {
            sourceInfoBox = "<div><h3> Address: </h3></div> <div>" + $('#source_address').val() + "</div>";

            infowindow = new google.maps.InfoWindow({
                content: sourceInfoBox
            });
        } else {
            flag = 1;
            sourceInfoBox = "<div><h3>Source Address: </h3></div> <div>" + $('#source_address').val() + "</div>";

            infowindow = new google.maps.InfoWindow({
                content: sourceInfoBox
            });

            destinationInfoBox = "<div><h3>Destination Address: </h3></div> <div>" + $('#destination_address').val() + "</div>";

            infowindow_destination = new google.maps.InfoWindow({
                content: destinationInfoBox
            });
        }

        var markersArray = [];//some array
        source = new google.maps.LatLng(s_lat, s_lgt);
        marker = new google.maps.Marker({
            position: source,
            map: map
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
        markersArray[0] = marker;

        if (flag == 1) {
            detination = new google.maps.LatLng(d_lat, d_lgt);
            marker1 = new google.maps.Marker({
                position: detination,
                map: map
            });
            marker1.addListener('click', function () {
                infowindow_destination.open(map, marker1);
            });
            markersArray[1] = marker1;
        }

        map.setCenter(new google.maps.LatLng(s_lat, s_lgt));

        // bound markers
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markersArray.length; i++) {
            bounds.extend(markersArray[i].getPosition());
        }

        map.fitBounds(bounds);

    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwdAbTnUO7i06aSYTHpuh9VQNPhJfg6lk&callback=initMap">
</script>
