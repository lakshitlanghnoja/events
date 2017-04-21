<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Recored per page for pagination */
 define('RECORD_PER_PAGE','5');
/*settings for captcha */
 define('CAPTCHA_SETTING','1');
/*contact us email id */
 define('CONTACT_US_EMAIL','contactus@tture.com');
/*from email address */
 define('SITE_FROM_EMAIL','no-reply@tture.com');
/*smtp host setting */
 define('SMTP_HOST','smtp.gmail.com');
/*set smtp port */
 define('SMTP_PORT','465');
/*set smtp password */
// define('SMTP_PASSWORD','admin@123');
 define('SMTP_PASSWORD','');
/*set smtp username */
// define('SMTP_USERNAME','testsoft.255@gmail.com');
 define('SMTP_USERNAME','');
/*Default CMS Page */
 define('DEFAULT_CMS_PAGE','home');
/*jquery validation engine prompt position */
 define('VALIDATION_ERROR_POSITION','centerRight');
/*Exclude Keys in Data Variable assignment in Theme's View function to render as it is */
 define('EXCLUDE_KEYS_FILTEROUTPUT','captcha,content,description,search_term');
/*Enable activity log. 1 for enable and 0 for disable */
 define('ACTIVITY_LOG','1');
/*site name */
 define('SITE_NAME','Tture');
/*teestin mecasfddf */
 define('TEST_FOR_SETTING','this is testing');
/*Default currency code for all products */
 define('CURRENCY_CODE','USD');
/*Paypal mode if sandbox then it will go to testing site if you left blank then it will go to the live paypal site */
 define('PAYPAL_TEST_MODE','true');
/* */
 define('PAYPAL_API_USERNAME','avinash_api1.harmistechnology.com');
/* */
 define('PAYPAL_API_PASSWORD',' 1370340116 ');
/* */
 define('PAYPAL_API_SIGNATURE',' A2SWcQAS0uppuSsEeK2HVEognWrWA8ewm2jWM40td6VN2BLc1Kihd3MU');
?>