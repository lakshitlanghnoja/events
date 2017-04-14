
<h4 class="text-center">Your Hostings</h4>

<ul class="trip-list">
    <?php
    if (is_array($trip_created_by_you) && !empty($trip_created_by_you)) {
        foreach ($trip_created_by_you as $trip) {
            ?>
            <li class="clearfix">
                <div class="row">
                    <div class="col-md-3 col-sm-4">            
                        <?php
                        if (isset($trip['e']['display_image']) && !empty($trip['e']['display_image'])) {
                            ?>
                            <span class="thumb">
                                <?php
                                $baseGalleryImageURL = $ci->config->item('eventGalleryImageURL');
                                $imgSRC = $baseGalleryImageURL . $trip['e']['display_image'];
                                ?>
                                <img src="<?php echo $imgSRC; ?>">  
                            </span>
                            <?php
                        }
                        ?>                                                                          
                    </div>
                    <div class="col-md-6 col-sm-4">
                        <div class="clearfix">
                            <h4 class="pull-left"><a href="<?php echo base_url('event/index/' . $trip['e']['slug']); ?>"><?php echo $trip['e']['title']; ?></a></h4>   

                        </div>
                        <ul class="service-details">

                            <li class="eventDetail">
                                <?php
                                $totalStar = 0;
                                if (isset($trip['custom']['event_rating']) && !empty($trip['custom']['event_rating']) && is_numeric($trip['custom']['event_rating'])) {
                                    $totalStar = ceil($trip['custom']['event_rating']);
                                }
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
                            </li>
                            <li class="eventDetail">
                                <label>PrimaeventDetailry location:</label>
                                <?php echo $trip['e']['source_city'] . ', ' . $trip['e']['source_state'] ?>
                            </li>
                            <li class="eventDetail">
                                <label>Duration:</label>
                                <?php echo $trip['e']['duration']; ?> hours
                            </li>                            
                            <li class="eventDetail">
                                <label>Total Sheets Booked:</label>
                                <?php echo $trip['custom']['userJoined']; ?>
                            </li>                            
                            <li class="eventDetail">
                                <label>Transportation:</label>
                                <?php echo $trip['e']['transportation']; ?>
                            </li>
                        </ul>                                    
                    </div>
                    <div class="col-md-3 col-sm-4 completeEventSection">
                        <?php
                        $event_id = $trip['e']['id'];

                        if (isset($redeemAmount[$event_id])) {
                            ?>
                            <div class="right-column">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <?php
                                        $lable = '';
                                        $formFlag = 0;
                                        $disableFlag = 1;
                                        if (isset($redeemAmount[$event_id]['amount']) && $redeemAmount[$event_id]['amount'] != 0) {
                                            $amount = number_format($redeemAmount[$event_id]['amount'], 2, '.', '');
                                            $formFlag = 1;
                                            $disableFlag = 0;
                                            $lable .= 'Redeem $' . $amount;
                                        }

                                        if (isset($redeemAmount[$event_id]['requested_amount']) && $redeemAmount[$event_id]['requested_amount'] != 0) {
                                            $requested_amount = number_format($redeemAmount[$event_id]['requested_amount'], 2, '.', '');
                                            $lable .= ' Requested for $' . $requested_amount;
                                        }
                                        ?>
                                        <?php
                                        $amount = number_format($redeemAmount[$event_id]['amount'], 2, '.', '');
                                        $disable_class = ($disableFlag == 1) ? 'disableed' : '';
                                        ?>
                                        <a href="#" title="Redeem Payment" class="btn-secondary btn-small redeem_payment <?php echo $disable_class; ?>" id="redeemLink_<?php echo $event_id; ?>" event_id='<?php echo $event_id; ?>' ><?php echo $lable; ?></a>
                                        <form id="redeem_<?php echo $event_id; ?>" method="post">
                                            <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">
                                            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $this->_ci->session->userdata['front']['user_id']; ?>">
                                            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                                            <input type="hidden" name="event_join_ids" value="<?php echo $redeemAmount[$event_id]['join_ids']; ?>">
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </li>
            <?php
        }
    } else {
        ?>
        <li class="clearfix">
            You have not created any event till now.
        </li>
        <?php
    }
    ?>

</ul>
<style>
    .disableed{
        background: #6a6c6e; color: #fff; cursor: default;
    }
</style>
<script>
    $(document).ready(function () {
        $('.redeem_payment').click(function () {
            if ($(this).hasClass('disableed')) {
                return false;
            }
            alert('hi');
            var event_id = $(this).attr('event_id');
            var data = $('#redeem_' + event_id).serialize();

            var baseURL = $('#baseURL').val();
            var URL = baseURL + 'events/request_redeem';
            $.ajax({
                type: 'POST',
                url: URL,
                data: data,
                success: function (data) {
                    data = jQuery.parseJSON(data);
                    if (data.status == 1) {
                        $('#redeemLink_' + event_id).text('Request Sent');
                    }
                }
            });
        });
    });
</script>
