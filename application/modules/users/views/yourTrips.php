<style>
    .eventDetail{padding: 0 !important; text-align: left; margin: 0 !important;}
    .completeEventSection .right-column{text-align: center;}
    .completeEventSection .right-column .row div{margin-bottom: 15px;}
    .completeEventSection .right-column .row div a{width: 100%;}
    @media(max-width: 768px){
        .completeEventSection .right-column .row div a{width: 50%;}
    }
</style>
<ul class="trip-list">
    <?php
    
    if (is_array($trip_join_by_you) && !empty($trip_join_by_you)) {
        foreach ($trip_join_by_you as $trip) {
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
                            <?php
                            $totalStar = 0;
                            if (isset($data['event_rating']) && !empty($trip['event_rating']) && is_numeric($data['event_rating'])) {
                                $totalStar = ceil($data['event_rating']);
                            }
                            ?>
                        </div>
                        <ul class="service-details">
                            <li class="eventDetail">
                                <label>PrimaeventDetailry location:</label>
                                <?php echo $trip['e']['source_city'] . ', ' . $trip['e']['source_state'] ?>
                            </li>
                            <li class="eventDetail">
                                <label>Duration:</label>
                                <?php echo $trip['e']['duration']; ?> hours
                            </li>                            
                            <li class="eventDetail">
                                <label>Sheets Booked:</label>
                                <?php echo $trip['ej']['number_of_sheets']; ?>
                            </li>                            
                            <li class="eventDetail">
                                <label>Transportation:</label>
                                <?php echo $trip['e']['transportation']; ?>
                            </li>
                        </ul>                                    
                    </div>
                    <div class="col-md-3 col-sm-4 completeEventSection">
                        <?php
                        if ($trip['ej']['completed'] == "0") {
                            ?>
                        <div class="right-column" id="event_join_<?php echo $trip['ej']['eventJoinId'];?>">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="#" title="Complete the trip" class="btn-secondary btn-small completeEventButton" data-toggle="modal" data-target="#completeEventModal" data-eventid="<?php echo $trip['e']['id']; ?>" data-eventJoinid="<?php echo $trip['ej']['eventJoinId']; ?>">Complete the trip</a>                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="#" title="Complain about the trip" class="btn-secondary btn-small">Complain about the trip</a>
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
            You have not joined any event till now.
        </li>
        <?php
    }
    ?>

</ul>
<script>
    $(document).ready(function(){
        $('.completeEventButton').click(function(){
            $('#eventComplete_message').text('');
            
            $('#submitRateEventId').val($(this).attr('data-eventid'));
            $('#submitRateEventJoinId').val($(this).attr('data-eventJoinid'));             
        });
    });
</script>