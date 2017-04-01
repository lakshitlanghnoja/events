<?php
$CI = & get_instance();
?>
<section class="main-content">
            <div class="container">
                <div class="card-wrap clearfix">
                    <div class="profile-image">
                        <?php echo add_image(array('dummy.jpg')); ?>
                        <a href="#" title="Edit" class="edit-link">Edit</a>
                        <a href="#" title="Remove" class="remove-link">Remove</a>
                    </div>
                    <div class="edit-left">
                        <div class="checkbox-outer">
                            <label for="checkbox-1">Checkbox1</label>
                            <input type="checkbox" name="checkbox-1" id="checkbox-1">
                            <label for="checkbox-2">Checkbox2</label>
                            <input type="checkbox" name="checkbox-2" id="checkbox-2">
                            <label for="checkbox-3">Checkbox3</label>
                            <input type="checkbox" name="checkbox-3" id="checkbox-3">
                        </div>
                    </div>
                    <div class="progress-block">70%</div>
                </div>
                <div id="parentVerticalTab" class="clearfix vertical-tabs">
                    <ul class="resp-tabs-list hor_1">
                        <li>Create Event</li>
                        <li>Edit Profile</li>
                        <li>Account Details</li>
                        <li>Review by you</li>
                        <li>Review for you</li>
                        <li>Your trips</li>
                        <li>Your hosting</li>
                        <li>FAQ</li>
                    </ul>
                    <div class="resp-tabs-container hor_1">
                        <div>
                            <?php $CI->load->view($createEventView); ?>
                            
                        </div>
                        <div>
                            <?php $CI->load->view($editProfileView); ?>
                        </div>
                        <div>
                            <?php $CI->load->view($accountDetailsView); ?>
                        </div>
                        <div class="review-tab">
                            <?php $CI->load->view($reviewByYouView); ?>
                        </div>
                        <div class="review-tab">
                            <?php $CI->load->view($reviewForYouView); ?> 
                        </div>
                        <div class="trips-tab">
                            <?php $CI->load->view($yourTripsView); ?>
                        </div>
                        <div class="trips-tab hosting-tab">
                            <?php $CI->load->view($yourTripsHostingsView); ?>
                        </div>
                        <div class="faq-section">
                            <?php $CI->load->view($faqVeiw); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>