<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *  CMS Controller
 *
 *  CMS controller to display cms page in front site.
 *  Also dispaly default page of cms.
 * 
 * @package CIDemoApplication

 */
class Event extends Base_Front_Controller {
    /*
     * Create an instance
     */

    function __construct() {
        parent::__construct();
        //load helpers
        $this->load->helper(array('url', 'cookie'));

        //$this->access_control($this->access_rules());
        //load theme        
        $this->theme->set_theme("events");
    }

    /**
     * Function access_rules to check login
     */
    private function access_rules() {
        return array(
            array(
                'actions' => array('action', 'index'),
                'users' => array('*'),
            ),
            array(
                'actions' => array('proceddPayment'),
                'users' => array('@'),
            )
        );
    }

    /**
     * action to display language wise cms page based on slug url
     * @param string $slug_url
     */
    function index($slug_url = NULL) {
        if ($slug_url == '' || $slug_url == NULL) {
            redirect('/');
        }
        $stateModel = $this->load->model('states/states_model');
        $eventData = $this->event_model->getEventDetailBySlug($slug_url);
        $taxPersent = 0;
        if (isset($eventData['source_state']) && !empty($eventData['source_state'])) {
            $taxPersent = $stateModel->get_record_by_state_name($eventData['source_state']);
        }

        $eventData['tax_persent'] = $taxPersent;
        if (isset($eventData['id']) && !empty($eventData['id'])) {
            $eventRatings = $this->event_model->getEventRatings($eventData['id']);
            if (isset($eventRatings['event_rating']) && !empty($eventRatings['event_rating'])) {
                $eventData['event_rating'] = $eventRatings['event_rating'];
            }

            $userJoined = $this->event_model->getEventJoinedUser($eventData['id']);
            if (isset($userJoined['userJoined']) && !empty($userJoined['userJoined'])) {
                $eventData['userJoined'] = $userJoined['userJoined'];
            }
        }
        $this->theme->view($eventData);
    }

        function proceddPayment() {
        $paypal = $this->load->library('paypal');

        $this_script = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $paypal->add_field('business', 'llanghnoja@gmail'); // Call the facilitator eaccount
        //$paypal->add_field('business', 'grillfirst@hotmail.com'); // Call the facilitator eaccount
        $paypal->add_field('cmd', '_cart'); // cmd should be _cart for cart checkout
        $paypal->add_field('upload', '1');
        $paypal->add_field('return', 'localhost/events/event/index/event1?order=1111'); // return URL after the transaction got over
        $paypal->add_field('cancel_return', $this_script . '?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
        $paypal->add_field('notify_url', $this_script . '?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
        $paypal->add_field('currency_code', 'USD');

        $paypal->add_field('item_name_1', 'Test Event');
        $paypal->add_field('amount_1', '100');
        $paypal->add_field('quantity_1', '1');
        $paypal->add_field('invoice', '1111 -' . time());

        $paypal->add_field('first_name', 'Test Name');
        $paypal->add_field('last_name', 'Last Name');
        //$paypal->add_field('address1', 'Test Address 1');
//?/       $paypal->add_field('city', $_POST["city"]);
        //$paypal->add_field('state', utf8_decode(getStateOrCountryNameById($_POST["state"])));
        //$paypal->add_field('country', utf8_decode(getStateOrCountryNameById($_POST["country"])));
        //$paypal->add_field('zip', $_POST["postcode"]);
        // $paypal->add_field('email', $_POST["paypal_id"]);
        $paypal->add_field('rm', '2');
        $paypal->submit_paypal_post(); // POST it to paypal
    }

    function testpaypal() {
        $this->config->load('paypal');
        $config = array(
            'Sandbox' => $this->config->item('Sandbox'), // Sandbox / testing mode option.
            'APIUsername' => $this->config->item('APIUsername'), // PayPal API username of the API caller
            'APIPassword' => $this->config->item('APIPassword'), // PayPal API password of the API caller
            'APISignature' => $this->config->item('APISignature'), // PayPal API signature of the API caller
            'APISubject' => '', // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
            'APIVersion' => $this->config->item('APIVersion'), // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
            'DeviceID' => $this->config->item('DeviceID'),
            'ApplicationID' => $this->config->item('ApplicationID'),
            'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
        );

        // Show Errors
        if ($config['Sandbox']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }

        // Load PayPal library
        $this->load->library('paypal/paypal_pro', $config);

        $cart['items'][0] = array(
            'id' => '123-ABC',
            'name' => 'Widget',
            'qty' => '2',
            'price' => '9.99',
        );

        // Example Data - cart item
        $cart['items'][1] = array(
            'id' => 'XYZ-456',
            'name' => 'Gadget',
            'qty' => '1',
            'price' => '4.99',
        );

        // Example Data - cart variable with items included
        $cart['shopping_cart'] = array(
            'items' => $cart['items'],
            'subtotal' => 24.97,
            'shipping' => 0,
            'handling' => 0,
            'tax' => 0,
        );

        // Example Data - grand total
        $cart['shopping_cart']['grand_total'] = number_format($cart['shopping_cart']['subtotal'] + $cart['shopping_cart']['shipping'] + $cart['shopping_cart']['handling'] + $cart['shopping_cart']['tax'], 2);

        // Load example cart data to variable
        $this->load->vars('cart', $cart);

        // Set example cart data into session
        $this->session->set_userdata('shopping_cart', $cart);

        $cart = $this->session->userdata('shopping_cart');
        $SECFields = array(
            'maxamt' => round($cart['shopping_cart']['grand_total'] * 2, 2), // The expected maximum total amount the order will be, including S&H and sales tax.
            'returnurl' => site_url('event/GetExpressCheckoutDetails'), // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
            'cancelurl' => site_url('event/OrderCancelled'), // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
            'hdrimg' => 'https://www.angelleye.com/images/angelleye-paypal-header-750x90.jpg', // URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
            'logoimg' => 'https://www.angelleye.com/images/angelleye-logo-190x60.jpg', // A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
            'brandname' => 'Angell EYE', // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
            'customerservicenumber' => '816-555-5555', // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
        );

        $Payments = array();
        $Payments[]['ORDER_ITEMS'] = array(array(
            'amt' => '10',
            'item' => 'xyz',
            'qty' => '1'
        ));
        $Payment = array(
            'total' => $cart['shopping_cart']['grand_total'], // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
            
        );


        array_push($Payments, $Payment);


        $PayPalRequestData = array(
            'SECFields' => $SECFields,
            'Payments' => $Payments,
        );

        echo "<pre>";
        print_r($PayPalRequestData);
        echo "</pre>";
        $PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
        echo "<pre>";
        print_r($PayPalResult);
        echo "</pre>";

        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = array('Errors' => $PayPalResult['ERRORS']);
            echo "testpaypal --";
            echo "<pre>";
            print_r($errors);
            echo "</pre>";
            //$this->load->vars('errors', $errors);
            //$this->load->view('paypal/demos/express_checkout/paypal_error');
        } else {

            $this->session->set_userdata('PayPalResult', $PayPalResult);

            redirect($PayPalResult['REDIRECTURL'], 'Location');
        }
    }

    function GetExpressCheckoutDetails() {
        // Get cart data from session userdata
        $cart = $this->session->userdata('shopping_cart');

        // Get PayPal data from session userdata
        $SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
        $PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

        /**
         * Now we pass the PayPal token that we saved to a session variable
         * in the SetExpressCheckout.php file into the GetExpressCheckoutDetails
         * request.
         */
        $PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);

        /**
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         *
         * If the call is successful, we'll save some data we might want to use
         * later into session variables.
         */
        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = array('Errors' => $PayPalResult['ERRORS']);

            // Load errors to variable
            echo "GetExpressCheckoutDetails --";
            echo "<pre>";
            print_r($errors);
            echo "</pre>";
//            $this->load->vars('errors', $errors);
//
//            $this->load->view('paypal/demos/express_checkout/paypal_error');
        } else {
            // Successful call.

            /**
             * Here we'll pull out data from the PayPal response.
             * Refer to the PayPal API Reference for all of the variables available
             * in $PayPalResult['variablename']
             *
             * https://developer.paypal.com/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
             *
             * Again, Express Checkout allows for parallel payments, so what we're doing here
             * is usually the library to parse out the individual payments using the GetPayments()
             * method so that we can easily access the data.
             *
             * We only have a single payment here, which will be the case with most checkouts,
             * but we will still loop through the $Payments array returned by the library
             * to grab our data accordingly.
             */
            $cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
            $cart['phone_number'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
            $cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
            $cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
            $cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

            foreach ($PayPalResult['PAYMENTS'] as $payment) {
                $cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
                $cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
                $cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
                $cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
                $cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
                $cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
                $cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
            }

            /**
             * At this point, we now have the buyer's shipping address available in our app.
             * We could now run the data through a shipping calculator to retrieve rate
             * information for this particular order.
             *
             * This would also be the time to calculate any sales tax you may need to
             * add to the order, as well as handling fees.
             *
             * We're going to set static values for these things in our static
             * shopping cart, and then re-calculate our grand total.
             */
            $cart['shopping_cart']['shipping'] = 10.00;
            $cart['shopping_cart']['handling'] = 2.50;
            $cart['shopping_cart']['tax'] = 1.50;

            $cart['shopping_cart']['grand_total'] = number_format(
                    $cart['shopping_cart']['subtotal'] + $cart['shopping_cart']['shipping'] + $cart['shopping_cart']['handling'] + $cart['shopping_cart']['tax'], 2);

            /**
             * Now we will redirect the user to a final review
             * page so they can see the shipping/handling/tax
             * that has been added to the order.
             */
            // Set example cart data into session
            $this->session->set_userdata('shopping_cart', $cart);

            echo "GetExpressCheckoutDetails --";
            echo "<pre>";
            print_r($cart);
            echo "</pre>";
        }
    }

    function OrderComplete() {
        // Get cart from session userdata
        $cart = $this->session->userdata('shopping_cart');

        if (empty($cart))
            redirect('paypal/demos/express_checkout');

        echo "OrderComplete --";
        echo "<pre>";
        print_r($cart);
        echo "</pre>";
        // Set cart data into session userdata
    }

    /**
     * Order Cancelled - Pay Cancel Url
     */
    function OrderCancelled() {
        // Clear PayPalResult from session userdata
        $this->session->unset_userdata('PayPalResult');

        // Clear cart from session userdata
        $this->session->unset_userdata('shopping_cart');

        echo "OrderCancelled --";


        // Successful call.  Load view or whatever you need to do here.
//        /$this->load->view('paypal/demos/express_checkout/order_cancelled');
    }

}

?>