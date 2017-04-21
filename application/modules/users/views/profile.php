<?php
$CI = & get_instance();
?>
<style>
    .profleStatusContainer{float: right;width: 100px;}
    .createEventLink{float: right;margin: 10px 0 0 0;}

</style>
<?php
$totalUserFields = 0;
$totalFilledFields = 0;

$totalFilledFields += ((isset($user_profile['firstname']) && $user_profile['firstname'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['lastname']) && $user_profile['firstname'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['email']) && $user_profile['email'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['date_of_birth']) && $user_profile['date_of_birth'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['mobile_number']) && $user_profile['mobile_number'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['social_media_link']) && $user_profile['social_media_link'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['government_id_proof']) && $user_profile['government_id_proof'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['profile_image']) && $user_profile['profile_image'] != '')) ? 1 : 0;
$totalUserFields++;

$totalFilledFields += ((isset($user_profile['about_me']) && $user_profile['about_me'] != '')) ? 1 : 0;
$totalUserFields++;
?>
<section class="main-content">
    <div class="container">

        <div class="card-wrap clearfix">
            <div class="profile-image ">
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
            <div class="edit-left ">
                <div class="checkbox-outer">
                    <?php
                    $profile_image_varified = isset($user_profile['profile_image_varified']) ? $user_profile['profile_image_varified'] : 0;
                    $email_varified = isset($user_profile['email_varified']) ? $user_profile['email_varified'] : 0;
                    $social_media_varified = isset($user_profile['social_media_varified']) ? $user_profile['social_media_varified'] : 0;
                    $government_id_varified = isset($user_profile['government_id_varified']) ? $user_profile['government_id_varified'] : 0;
                    $phone_varified = isset($user_profile['phone_varified']) ? $user_profile['phone_varified'] : 0;

                    $totalField = 0;
                    $totalVarified = 0;
                    $FieldArray = array();
                    $FieldArray['profile_image_varified']['lable'] = 'Profile Image Varified?';
                    if ($profile_image_varified) {
                        $totalVarified ++;
                        $totalField++;
                        $FieldArray['profile_image_varified']['value'] = 1;
                    } else {
                        $totalField ++;
                        $FieldArray['profile_image_varified']['value'] = 0;
                    }

                    $FieldArray['email_varified']['lable'] = 'Email Varified?';
                    if ($email_varified) {
                        $totalVarified ++;
                        $totalField++;
                        $FieldArray['email_varified']['value'] = 1;
                    } else {
                        $totalField ++;
                        $FieldArray['email_varified']['value'] = 0;
                    }

                    $FieldArray['social_media_varified']['lable'] = 'Social Media Link Varified?';
                    if ($social_media_varified) {
                        $totalVarified ++;
                        $totalField++;
                        $FieldArray['social_media_varified']['value'] = 1;
                    } else {
                        $totalField ++;
                        $FieldArray['social_media_varified']['value'] = 0;
                    }

                    $FieldArray['government_id_varified']['lable'] = 'Govt. Id Varified?';
                    if ($government_id_varified) {
                        $totalVarified ++;
                        $totalField++;
                        $FieldArray['government_id_varified']['value'] = 1;
                    } else {
                        $totalField ++;
                        $FieldArray['government_id_varified']['value'] = 0;
                    }

                    $FieldArray['phone_varified']['lable'] = 'Phone Number Varified?';
                    if ($phone_varified) {
                        $totalVarified ++;
                        $totalField++;
                        $FieldArray['phone_varified']['value'] = 1;
                    } else {
                        $totalField ++;
                        $FieldArray['phone_varified']['value'] = 0;
                    }

                    if (is_array($FieldArray) && !empty($FieldArray)) {
                        $i = 1;
                        foreach ($FieldArray as $field) {
                            $checked = ($field['value']) ? 'checked="checked"' : '';
                            ?>
                            <label for="checkbox-<?php echo $i; ?>"><?php echo $field['lable']; ?></label>
                            <input type="checkbox" name="checkbox-<?php echo $i; ?>" id="checkbox-<?php echo $i; ?>" <?php echo $checked; ?> readonly="readonly" disabled="disabled">
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="profleStatusContainer">
                <?php
                $percent = floor(($totalFilledFields * 100) / $totalUserFields);
                ?>
                <style>
                    .progress-block:after{clip: rect(<?php echo $percent;?>px, 100px, 100px, 0) !important;}
                </style>
                <div class="progress-block "><?php echo $percent; ?>% </div>
                <?php
                if ($totalField == $totalVarified) {
                    ?>
                    <div class="createEventLink"><a href="<?php echo base_url('events/create'); ?>">Create Event</a></div>
                    <?php
                }
                ?>

            </div>
        </div>
        <div id="parentVerticalTab" class="clearfix vertical-tabs">
            <ul class="resp-tabs-list hor_1">
                <!--                <li>Create Event</li>-->
                <li>Edit Profile</li>
<!--                <li>Account Details</li>-->
                <li>Review by you</li>
                <li>Review for you</li>
                <li>Your trips</li>
                <li>Your hosting</li>
                <li>FAQ</li>
            </ul>
            <div class="resp-tabs-container hor_1">
                <!--                <div>
                <?php //include('create_event.php');     ?>                            
                                </div>-->
                <div>
                    <?php include('edit_profile.php'); ?>                            
                </div>
<!--                <div>
                    <?php include('account_details.php'); ?> 
                </div>-->
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
    $(document).ready(function () {
        $('#edit_profile_image').click(function () {
            $('#user_profile_image').click();
        });

        $('#user_profile_image').change(function () {
            $('#user_profile_form').submit();
        });
    });
</script>