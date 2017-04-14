<div>
    PAypal Form

    <?php
    echo '<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="personal146@test.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="Teddy Bear">
<input type="hidden" name="amount" value="12.99">
<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
</form>';
    ?>
</div>