<?php
$attributes = array('name' => 'account_form', 'id' => 'account_form');
echo form_open('users/profile', $attributes);
?>

<div class="row">
    <div class="form-group col-sm-12">
        <label>Paypal Account ID:</label>
        <?php
        $paypalAccount_data = array(
            'name' => 'paypalAccountId',
            'id' => 'paypalAccountId',
            'value' => set_value('paypalAccountId', ((isset($user_account['paypal_account_id'])) ? $user_account['paypal_account_id'] : '')),
            'placeholder' => 'Paypal Account Id',
            'class' => "form-control border-input"
        );
        ?>
        <?php echo form_input($paypalAccount_data); ?>        
    </div>    
</div>
<div class="clearfix">
    <?php
    echo form_submit('UpdateAccountDetails', 'Save', "class='btn-secondary btn-small pull-left'");
    ?>        
</div>
<input type="hidden" name="formAction" value="update_account_details">
<input type="hidden" name="user_id" value="<?php echo ((isset($profileData['id'])) ? ($profileData['id']) : '0'); ?>">
<input type="hidden" name="id" value="<?php echo ((isset($user_account['id'])) ? ($user_account['id']) : '0'); ?>">
<?php
echo form_close();
?>