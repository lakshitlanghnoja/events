<h4 class="text-center">Edit your details</h4>
<div class="editProfileMessage"></div>
<?php
$profileData = $user_profile;
//pre($profileData);
$attributes = array('name' => 'profile_form', 'id' => 'profile_form');
echo form_open_multipart('users/profile', $attributes);
?>

<div class="row">
    <div class="form-group col-sm-6">
        <?php
        $firstname_data = array(
            'name' => 'firstname',
            'id' => 'firstname',
            'value' => set_value('firstname', ((isset($profileData['firstname'])) ? $profileData['firstname'] : '')),
            'maxlength' => '50',
            'placeholder' => 'First Name',
            'class' => "form-control border-input validate[required,maxSize[50]]"
        );
        ?>
        <?php echo form_input($firstname_data); ?>        
    </div>
    <div class="form-group col-sm-6">
        <?php
        $lastname_data = array(
            'name' => 'lastname',
            'id' => 'lastname',
            'value' => set_value('lastname', ((isset($profileData['lastname'])) ? $profileData['lastname'] : '')),
            'maxlength' => '50',
            'placeholder' => 'Last Name',
            'class' => "form-control border-input validate[required,maxSize[50]]"
        );
        ?>
        <?php echo form_input($lastname_data); ?>           
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <?php
        $email_data = array(
            'name' => 'email',
            'id' => 'email',
            'value' => set_value('email', ((isset($profileData['email'])) ? $profileData['email'] : '')),
            'maxlength' => '50',
            'placeholder' => 'Email Address',
            'class' => "form-control border-input validate[required,custom[email]]"
        );
        ?>
        <?php echo form_input($email_data); ?> 
    </div>
    <div class="form-group col-sm-6">
        <?php
        $dateOfBirth = array(
            'name' => 'date_of_birth',
            'id' => 'date_of_birth',
            'value' => set_value('date_of_birth', ((isset($profileData['date_of_birth']) && $profileData['date_of_birth'] != '0000-00-00 00:00:00') ? date('m/d/Y', strtotime($profileData['date_of_birth'])) : '')),
            'maxlength' => '50',
            'placeholder' => 'Date of Birth',
            'class' => "form-control border-input "
        );
        ?>
        <?php echo form_input($dateOfBirth); ?> 
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <?php
        $mobileNumber = array(
            'name' => 'mobile_number',
            'id' => 'mobile_number',
            'value' => set_value('mobile_number', ((isset($profileData['mobile_number'])) ? ($profileData['mobile_number']) : '')),            
            'placeholder' => 'Mobile Number',
            'class' => "form-control border-input "
        );
        ?>
        <?php echo form_input($mobileNumber); ?> 
    </div>

    <div class="form-group col-sm-6">
        <?php
        $socialMediaLink = array(
            'name' => 'social_media_link',
            'id' => 'social_media_link',
            'value' => set_value('social_media_link', ((isset($profileData['social_media_link'])) ? ($profileData['social_media_link']) : '')),
            'placeholder' => 'Social Media Profile Link',
            'class' => "form-control border-input "
        );
        ?>
        <?php echo form_input($socialMediaLink); ?> 
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        Please upload Govt. Proof ID.
        <?php
        $socialMediaLink = array(
            'name' => 'government_id_proof',
            'id' => 'government_id_proof',
            'class' => "form-control border-input "
        );
        ?>
        <?php echo form_upload($socialMediaLink); ?> 
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <?php
        $aboutMe = array(
            'name' => 'about_me',
            'id' => 'vs',
            'value' => set_value('about_me', ((isset($profileData['about_me'])) ? ($profileData['about_me']) : '')),
            'placeholder' => 'Tell Something About You',
            'class' => "form-control border-input "
        );
        ?>
        <?php echo form_textarea($aboutMe); ?> 
    </div>
</div>

<input type="hidden" name="id" value="<?php  echo ((isset($profileData['id'])) ? ($profileData['id']) : '0');?>">
<input type="hidden" name="role_id" value="<?php  echo ((isset($profileData['role_id'])) ? ($profileData['role_id']) : '0');?>">
<input type="hidden" name="formAction" value="edit_profile">
<button class="btn-secondary btn-small updateProfileForm">Update</button>
<?php
echo form_close();
?>