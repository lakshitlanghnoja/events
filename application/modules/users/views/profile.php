<?php
$CI = & get_instance();
?>

<section class="main-content">
    <div class="container">
        <div class="card-wrap clearfix">
            <div class="profile-image">
                <?php
                $profileImageURL = $ci->config->item('userImageURL');
                if (isset($user_profile['profile_image']) && $user_profile['profile_image'] != '') {
                    $imageURL = $profileImageURL . $user_profile['profile_image'];
                    ?>
                    <img src="<?php echo $imageURL; ?>">
                    <?php
                } else {
                    echo add_image(array('dummy.jpg'));
                }
                ?>                
                <a href="#" title="Edit" id="edit_profile_image" class="edit-link">Edit</a>
                <a href="<?php echo base_url('users/removeProfileImage/' . $user_profile['id']); ?>" title="Remove" class="remove-link">Remove</a>
            </div>
            <form id="user_profile_form" method="post" action="<?php echo base_url('users/profile/'); ?>" enctype="multipart/form-data" style="display: none;">
                <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">
                <input type="file" id="user_profile_image" name="user_profile" value="" accept="image/*">
                <input type="hidden" name="user_id" value="<?php echo $user_profile['id']; ?>">
                <input type="hidden" name="action" value="editProfileImage">
            </form>
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
                    <?php include('create_event.php'); ?>                            
                </div>
                <div>
                    <?php include('edit_profile.php'); ?>                            
                </div>
                <div>
                    <?php include('account_details.php'); ?> 
                </div>
                <div class="review-tab">
                    <?php include('reviewByYou.php'); ?>
                </div>
                <div class="review-tab">
                    <?php include('reviewforYou.php'); ?>
                </div>
                <div class="trips-tab">
                    <?php include('yourTrips.php'); ?>
                </div>
                <div class="trips-tab hosting-tab1">
                    <?php include('yourHostings.php'); ?>
                </div>
                <div class="faq-section">
                    <?php include('faq.php'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $('#edit_profile_image').click(function(){
            $('#user_profile_image').click();
        });
        
        $('#user_profile_image').change(function(){
            $('#user_profile_form').submit();
        });
    });
</script>