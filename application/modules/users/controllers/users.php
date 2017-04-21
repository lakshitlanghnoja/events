<?php

/**
 *  User Controller (Front)
 *
 *  To perform login,registration and forgot password process.
 *
 * @package CIDemoApplication
 * @subpackage Users
 * @copyright	(c) 2013, TatvaSoft
 * @author panks
 */
class Users extends Base_Front_Controller {

    function __construct() {
        parent::__construct();
        //load helpers
        $this->theme->set_theme("events");
        $this->load->helper(array('url', 'cookie', 'captcha'));
        $this->load->library('form_validation');
        $this->access_control($this->access_rules());
    }

    /**
     * Function access_rules to check login
     */
    private function access_rules() {
        return array(
            array(
                'actions' => array('action', 'index', 'login', 'registration', 'send_email', 'user_validation_rules', 'activation', 'recaptcha', 'forgot_password', 'ajax_forgotPassword', 'regenerate_activation_link', 'logout', 'profile', 'ajax_login', 'ajax_registration', 'editProfileImage', 'removeProfileImage'),
                'users' => array('*'),
            ),
            array(
                'actions' => array('change_password', 'profile'),
                'users' => array('@'),
            )
        );
    }

    /*
     *  Function index for login
     */

    function index() {
        $this->login();
    }

    /*
     *  Function login for check front header popup login
     */

    function ajax_login() {
        if (isset($this->session->userdata[$this->section_name]['user_id'])) {
            redirect("/");
        }

        $postData = $this->input->post();
        if (!empty($postData)) {
            $email = trim(strip_tags($postData['email']));
            $password = trim(strip_tags($postData['password']));

            $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $result = $this->users_model->check_front_login($email, $password);
                if (!empty($result)) {
                    if ($result[0]['u']['status'] == 1) {
                        $data['user_id'] = $result[0]['u']['id'];
                        $data['role_id'] = $result[0]['u']['role_id'];
                        $data['email'] = $result[0]['u']['email'];
                        $data['firstname'] = $result[0]['u']['firstname'];
                        $data['lastname'] = $result[0]['u']['lastname'];
                        $data['profileImage'] = $result[0]['u']['profile_image'];
                        $data['logged_in'] = TRUE;

                        $this->allowed_permission_list($data['role_id']);

                        $this->session->set_custom_userdata($this->section_name, $data);
                        $data['status'] = 1;
                        $data['msg'] = 'Login Success';
                    } else {
                        $data['status'] = 0;
                        $data['msg'] = 'Please enter valid data';
                    }
                } else {
                    $data['status'] = 0;
                    $data['msg'] = 'Please enter valid data';
                }
            } else {
                $data['status'] = 0;
                $data['msg'] = 'Please enter valid data';
            }
        } else {
            $data['status'] = 0;
            $data['msg'] = 'Invalid request';
        }
        echo json_encode($data);
        exit;
    }

    /*
     *  Function login for check front login
     */

    function login() {

        if (isset($this->session->userdata[$this->section_name]['user_id'])) {
            redirect("/");
        }
        //Initializing
        $data = $this->input->post();

        if (!empty($data) && $this->input->post('Login')) {
            //form validation
            $email = trim(strip_tags($data['email_w']));
            $password = trim(strip_tags($data['password_w']));

            $this->form_validation->set_rules('email_w', lang('email'), 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password_w', lang('password'), 'trim|required|xss_clean');

            //Variable Assignment
            //Logic
            if ($this->form_validation->run() == TRUE) {
                $result = $this->users_model->check_front_login($email, $password);
                if (!empty($result)) {
                    if ($result[0]['u']['status'] == 1) {
                        $data['user_id'] = $result[0]['u']['id'];
                        $data['role_id'] = $result[0]['u']['role_id'];
                        $data['email'] = $result[0]['u']['email'];
                        $data['firstname'] = $result[0]['u']['firstname'];
                        $data['lastname'] = $result[0]['u']['lastname'];
                        $data['profileImage'] = $result[0]['u']['profile_image'];
                        $data['logged_in'] = TRUE;

                        $this->allowed_permission_list($data['role_id']);

                        $this->session->set_custom_userdata($this->section_name, $data);

                        //Update last login entry
                        $this->users_model->update_last_login($result[0]['u']['id']);

                        redirect('/');
                    } else {
                        $this->theme->set_message(lang('inactive-account-msg'), "error");
                    }
                } else {
                    $this->theme->set_message(lang('invalid-email-password'), "error");
                }
            }
        }

        //Render view
        $this->theme->view($data, 'login');
    }

    /*
     * Function redirect user on profile page after activates his account
     */

    public function login_user_directly($user_id) {
        if ($user_id == '') {
            redirect("/");
        }
        $userInfo = $this->users_model->get_user_detail($user_id);
        $data['user_id'] = $userInfo['id'];
        $data['role_id'] = $userInfo['role_id'];
        $data['email'] = $userInfo['email'];
        $data['firstname'] = $userInfo['firstname'];
        $data['lastname'] = $userInfo['lastname'];
        $data['logged_in'] = TRUE;

        $this->allowed_permission_list($userInfo['role_id']);

        $this->session->set_custom_userdata($this->section_name, $data);

        //Update last login entry
        $this->users_model->update_last_login($userInfo['id']);

        redirect('users/profile');
    }

    /*
     *  Function logout to destroy all front session data
     */

    function logout() {
        $this->session->unset_userdata($this->section_name);
        redirect('/');
        exit;
    }

    /*
     * Function registration for ajax registration 
     */

    public function ajax_registration() {
        $firstname = "";
        $lastname = "";
        $email = "";
        $password = "";
        $status = "";
        $role_id = "";
        $id = 0;
        if ($this->input->post()) {
            $post = $this->input->post();
            $default_role = $this->users_model->get_default_role();

            $firstname = trim(strip_tags($post['register_first_name']));
            $lastname = trim(strip_tags($post['register_last_name']));
            $email = trim(strip_tags($post['email']));
            $password = trim(strip_tags($post['register_password']));
            $role_id = intval($default_role['id']);
            $date_of_birth = trim(strip_tags($post['register_dob']));
            $mobile_number = trim(strip_tags($post['register_mobile']));


            $status = 0;

            $data_array['id'] = $id;
            $data_array['firstname'] = $firstname;
            $data_array['lastname'] = $lastname;
            $data_array['email'] = $email;
            $data_array['date_of_birth'] = $date_of_birth;
            $data_array['mobile_number'] = $mobile_number;
            if ($id == 0) {
                $data_array['password'] = encriptsha1($password);
            }
            $data_array['role_id'] = $role_id;
            $data_array['status'] = $status;
            $data_array['activation_code'] = get_random_string(12);


            $this->form_validation->set_rules('register_first_name', lang('first-name'), 'trim|required|min_length[2]|xss_clean');
            $this->form_validation->set_rules('register_last_name', lang('last-name'), 'trim|required|min_length[2]|xss_clean');
            //is_unique[users.email.id.' . $id . ']
            $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|callback_check_unique_email|xss_clean');

            if ($id == 0 || $id == "") {
                $this->form_validation->set_rules('register_password', lang('password'), 'trim|required|xss_clean|min_length[4]|max_length[40]');
            }

            if ($this->form_validation->run($this) == TRUE) {
                $flag = $this->users_model->save_user($data_array);
                //$flag = $this->send_email($data_array, 'registration_template');
                $return['status'] = 1;
                $return['msg'] = 'Thank you for registering in our site! We have sent email on your email address. Please activate your account from link given in email.';
            } else {
                $return['status'] = 0;
                $return['msg'] = 'Entered data is not valid.';
            }
        } else {
            $return['status'] = 0;
            $return['msg'] = 'Invalid request.';
        }
        echo json_encode($return);
        exit;
    }

    /*
     *  Function registration for front registration
     */

    public function registration() {
        $CI = & get_instance();
        //Variable Assignment
        $firstname = "";
        $lastname = "";
        $email = "";
        $password = "";
        $passconf = "";
        $status = "";
        $role_id = "";

        if (!$this->input->post('mysubmit'))
            $captcha = $this->my_captcha->deleteImage()->createWord()->createCaptcha();


        //If form submit
        if ($this->input->post('mysubmit')) {
            $post = $this->input->post();
            $default_role = $this->users_model->get_default_role();

            //Variable Assignment
            $id = intval($post['id']);
            $firstname = trim(strip_tags($post['firstname']));
            $lastname = trim(strip_tags($post['lastname']));
            $email = trim(strip_tags($post['email']));
            $password = trim(strip_tags($post['password']));
            $passconf = trim(strip_tags($post['passconf']));
            $role_id = intval($default_role['id']);
            $status = 1;


            $data_array['id'] = $id;
            $data_array['firstname'] = $firstname;
            $data_array['lastname'] = $lastname;
            $data_array['email'] = $email;
            if ($id == 0) {
                $data_array['password'] = encriptsha1($password);
            }
            $data_array['role_id'] = $role_id;
            $data_array['status'] = $status;


            // field name, error message, validation rules
            $this->user_validation_rules();
            if ($this->form_validation->run($this) == TRUE) {
                $this->users_model->save_user($data_array);
                //$flag = $this->send_email($data_array, 'registration_template');
                if ($flag) {
                    $this->theme->set_message(lang('registration-success-msg'), 'success');
                } else {
                    $this->theme->set_message(lang('email-template-inactive'), 'info');
                }
                redirect(base_url() . "users");
            } else {
                $captcha = $this->my_captcha->deleteImage()->createWord()->createCaptcha();
            }
        }

        //Pass data to view file
        $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;
        $data['email'] = $email;
        $data['password'] = $password;
        $data['passconf'] = $passconf;
        $data['role_id'] = $role_id;
        $data['status'] = $status;
        $data['captcha'] = $captcha;
        $data['ci'] = $CI;

        //echo $captcha; exit;
        //Render view
        $this->theme->view($data);
    }

    /*
     *  Function registration for edit profile in front
     */

    public function profile() {
        $CI = & get_instance();
        $id = $this->session->userdata[$this->section_name]['user_id'];

        if ($this->input->post('action') == 'editProfileImage') {
            if (!empty($_FILES['user_profile']['name'])) {
                $user_id = $this->session->userdata[$this->section_name]['user_id'];
                $fileName = '';
                $fileNameArray = explode('.', $_FILES['user_profile']['name']);
                $fileNameExt = end($fileNameArray);
                array_pop($fileNameArray);
                $fileName = implode('.', $fileNameArray) . '_' . $user_id . '.' . $fileNameExt;

                $_FILES['user_profile']['name'] = $fileName;
                $_FILES['user_profile']['type'] = $_FILES['user_profile']['type'];
                $_FILES['user_profile']['tmp_name'] = $_FILES['user_profile']['tmp_name'];
                $_FILES['user_profile']['error'] = $_FILES['user_profile']['error'];
                $_FILES['user_profile']['size'] = $_FILES['user_profile']['size'];

                $uploadPath = $CI->config->item('userImagePath');

                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|png';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('user_profile')) {

                    $fileData = $this->upload->data();
                    $profileImageData['profile_image'] = $fileData['file_name'];

                    $this->users_model->updateProfileImage($profileImageData, $user_id);
                    $this->session->set_custom_userdata($this->section_name, array('profileImage' => $fileData['file_name']));
                }
            }
        }

        if (!empty($id)) {
            $result = $this->users_model->get_user_detail($id);
            if (!empty($result) && $result['status'] == 1) {
                //Variable Assignment
                $firstname = $result['firstname'];
                $lastname = $result['lastname'];
                $email = $result['email'];
                $status = $result['status'];
                $role_id = $result['role_id'];

                //accounts tab
                $accountResult = $this->users_model->get_user_account_detail($id);

                //Review By You Tab
                $reviewByYou = $this->users_model->getReviewByUser($id);

                //Review for yo tab
                $reviewForYou = $this->users_model->getReviewForYou($id);

                //FAQ tab               
                $faqModel = $this->load->model('faq/faq_model');
                $userFAQ = $faqModel->get_record_listing();

                //Your Trips tab
                $tripsJoinByYou = $this->users_model->getEventsJoinedByUser($id);

                // Your Hostings tab
                $tripsCreatedByYou = $this->users_model->getEventsCreatedByUser($id);
                $tripJoinedData = $this->users_model->getTripJoinDataByTripCreatorId($id);
                $redeemAmount = array();
                if (is_array($tripJoinedData) && !empty($tripJoinedData)) {
                    $redeemAmount = $this->CateculateRedeemAmount($tripJoinedData);
                }

                //If form submit
                //pre($this->input->post());


                if ($this->input->post('formAction') == 'edit_profile') {
                    $post = $this->input->post();

                    //$default_role = $this->users_model->get_default_role();
                    //Variable Assignment
                    //$id = intval($post['id']);
                    $id = $this->session->userdata[$this->section_name]['user_id'];
                    $firstname = trim(strip_tags($post['firstname']));
                    $lastname = trim(strip_tags($post['lastname']));
                    $email = trim(strip_tags($post['email']));
                    $role_id = $post['role_id'];
                    $date_of_birth = $post['date_of_birth'];
                    $mobile_number = $post['mobile_number'];
                    $social_media_link = $post['social_media_link'];
                    $about_me = $post['about_me'];

                    $paypalAccountId = $post['paypalAccountId'];


                    $status = 1;


                    $data_array['id'] = $id;
                    $data_array['firstname'] = $firstname;
                    $data_array['lastname'] = $lastname;
                    $data_array['email'] = $email;
                    $data_array['role_id'] = $role_id;
                    $data_array['status'] = $status;
                    $data_array['date_of_birth'] = $date_of_birth;
                    $data_array['mobile_number'] = $mobile_number;
                    $data_array['social_media_link'] = $social_media_link;
                    $data_array['about_me'] = $about_me;

                    if (!empty($_FILES['government_id_proof']['name'])) {                        
                        $fileName = '';
                        $fileNameArray = explode('.', $_FILES['government_id_proof']['name']);
                        $fileNameExt = end($fileNameArray);
                        array_pop($fileNameArray);
                        $fileName = implode('.', $fileNameArray) . '_govt_proof_' . $id . '.' . $fileNameExt;

                        $_FILES['government_id_proof']['name'] = $fileName;
                        $_FILES['government_id_proof']['type'] = $_FILES['government_id_proof']['type'];
                        $_FILES['government_id_proof']['tmp_name'] = $_FILES['government_id_proof']['tmp_name'];
                        $_FILES['government_id_proof']['error'] = $_FILES['government_id_proof']['error'];
                        $_FILES['government_id_proof']['size'] = $_FILES['government_id_proof']['size'];

                        $uploadPath = $CI->config->item('userImagePath');

                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|png';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('government_id_proof')) {
                            $fileData = $this->upload->data();
                            $data_array['government_id_proof'] = $fileData['file_name'];
                        }
                    }

                    //pre($data_array);
                    // field name, error message, validation rules
                    //$this->profile_validation_rules();

                    $this->users_model->save_profile($data_array);

                    if ($paypalAccountId) {
                        $accountId = $post['account_id'];
                        $data_account_array['id'] = $accountId;
                        $data_account_array['user_id'] = $id;
                        $data_account_array['paypal_account_id'] = $paypalAccountId;
                        $this->users_model->save_accountDetails($data_account_array);
                    }

                    $this->theme->set_message(lang('edit-profile-success'), 'success');
                    redirect(base_url() . "users/profile");
                }

                if ($this->input->post('formAction') == 'update_account_details') {
                    $post = $this->input->post();
                    $userId = $post['user_id'];
                    $paypalAccountId = $post['paypalAccountId'];
                    $accountId = $post['id'];
                    if ($userId != '' || $userId != '0') {
                        $data_array['id'] = $accountId;
                        $data_array['user_id'] = $userId;
                        $data_array['paypal_account_id'] = $paypalAccountId;
                        $this->users_model->save_accountDetails($data_array);
                        redirect(base_url() . "users/profile");
                    }
                }

                //Pass data to view file
                $data['user_profile'] = $result;
                $data['user_account'] = $accountResult;
                $data['review_by_user'] = $reviewByYou;
                $data['review_for_user'] = $reviewForYou;
                $data['trip_join_by_you'] = $tripsJoinByYou;
                $data['trip_created_by_you'] = $tripsCreatedByYou;
                $data['redeemAmount'] = $redeemAmount;
                $data['userFAQ'] = $userFAQ;
                $data['ci'] = $CI;
                $data['id'] = $id;

                //echo $captcha; exit;
                //Render view
                $this->theme->view($data);
            } else {
                $this->session->unset_userdata($this->section_name);
                $this->theme->set_message(lang('inactive-account-msg'), "error");
                redirect(site_url() . 'users/login');
            }
        } else {
            $this->theme->set_message(lang('do-login-msg-edit-profile'), 'info');
            redirect(site_url() . 'users/login');
        }
    }

    public function CateculateRedeemAmount($tripJoinedData) {

        $redeemAmount = array();
        if (is_array($tripJoinedData) && !empty($tripJoinedData)) {
            $eventId = '';
            $amount = 0;
            $requested_amount = 0;
            $i = 0;
            $temp_id = array();

            foreach ($tripJoinedData as $joinData) {
                if ($joinData['e']['eid'] != $eventId) {
                    $eventId = $joinData['e']['eid'];
                    $amount = 0;
                    $requested_amount = 0;
                    $temp_id = array();
                }
                if (isset($joinData['ep']['payment_gross']) && $joinData['ep']['payment_gross'] != '') {
                    if (isset($joinData['ej']['completed_at']) && $joinData['ej']['completed_at'] != '') {
                        if (isset($joinData['er']['rate']) && $joinData['er']['rate'] != '') {
                            if (isset($joinData['ej']['redeem_status']) && $joinData['ej']['redeem_status'] == 2) {
                                $requested_amount += $joinData['ep']['payment_gross'];
                            } else {
                                $day_diff = 5 - $joinData['er']['rate'];
                                $date = strtotime($joinData['ej']['completed_at']);
                                $date = strtotime("+" . $day_diff . " day", $date);
                                $issue_date = date('m-d-Y', $date);
                                if ($issue_date == date('m-d-Y')) {
                                    //$redeemAmount[$eventId]['date'] = $issue_date;
                                    $temp_id[] = $joinData['ej']['id'];
                                    $amount += $joinData['ep']['payment_gross'];
                                }
                            }
                        }
                    }
                }
                $temp_id_string = implode(',', $temp_id);
                $redeemAmount[$eventId]['amount'] = $amount;
                $redeemAmount[$eventId]['requested_amount'] = $requested_amount;
                $redeemAmount[$eventId]['join_ids'] = $temp_id_string;
                $i++;
            }
        }
//        echo "<pre>";
//        print_r($redeemAmount);
//        echo "</pre>";
//        pre($tripJoinedData);
        return $redeemAmount;
    }

    public function removeProfileImage($user_id) {
        if (isset($user_id) && $user_id != '') {
            $data['profile_image'] = '';
            $this->users_model->updateProfileImage($data, $user_id);
            $this->session->set_custom_userdata($this->section_name, array('profileImage' => ''));
        }
        redirect('users/profile');
    }

    /**
     * Function send email to user
     * @params $data for sending email
     */
    public function send_email($data = array(), $template = NULL) {

        $this->load->library('mailer');
        $this->mailer->mail->SetFrom("noreply@tture.com", SITE_NAME);
        $this->mailer->mail->IsHTML(true);

        $firstname = isset($data['firstname']) ? $data['firstname'] : '';
        $lastname = isset($data['lastname']) ? $data['lastname'] : '';
        $password = isset($data['password']) ? $data['password'] : '';

        $activation_code = '';
        $mail_vars = array(
            'USERNAME' => $data['email'],
            'name' => $firstname . ' ' . $lastname,
            'activation_link' => base_url() . 'users/activation/' . $activation_code,
            'SITE_NAME' => SITE_NAME,
            'YEAR' => date('Y'),
            'logopath' => site_base_url() . 'themes/default/images/logo.jpg',
            'PASSWORD' => $password
        );

        $body = get_template_body($this, $template, $mail_vars, $this->session->userdata[$this->section_name]['site_lang_id']);
        $subject = get_template_subject($this, $template);

        if (trim($body) == "") {
            return false;
        } else {
            try {
                $this->mailer->sendmail(
                        $data['email'], $firstname . " " . $lastname, $subject, $body
                );
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
                exit;
            }
            return true;
        }
    }

    /*
     *  Function user_validation_rules to validate user registration form
     */

    function user_validation_rules() {
        //Type casting
        $id = intval($this->input->post('id'));

        //Validation rules
        $this->form_validation->set_rules('firstname', lang('first-name'), 'trim|required|min_length[2]|xss_clean');
        $this->form_validation->set_rules('lastname', lang('last-name'), 'trim|required|min_length[2]|xss_clean');
        //is_unique[users.email.id.' . $id . ']
        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|callback_check_unique_email|xss_clean');
        if (CAPTCHA_SETTING)
            $this->form_validation->set_rules('captcha', 'Captcha', 'required|xss_clean|validate_captcha[' . $this->input->post("captcha") . ']');
        if ($id == 0 || $id == "") {
            $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean|min_length[4]|max_length[40]');
            $this->form_validation->set_rules('passconf', lang('c-password'), 'trim|required|xss_clean|matches[password]');
        }
    }

    function profile_validation_rules() {
        //Type casting
        //$id = intval($this->input->post('id'));
        //$id = $this->session->userdata[$this->section_name]['user_id'];

        $id = intval($this->input->post('id'));

        //Validation rules
        $this->form_validation->set_rules('firstname', lang('first-name'), 'trim|required|min_length[2]|xss_clean');
        $this->form_validation->set_rules('lastname', lang('last-name'), 'trim|required|min_length[2]|xss_clean');
        //is_unique[users.email.id.' . $id . ']
//        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|is_unique[users.email.id.' . $id . ']|xss_clean');

        $this->form_validation->set_rules('email', lang('email'), 'trim|required|valid_email|callback_check_unique_email|xss_clean');
        //if (CAPTCHA_SETTING)
        // $this->form_validation->set_rules('captcha', 'Captcha', 'required|xss_clean|validate_captcha[' . $this->input->post("captcha") . ']');
    }

    /*
     *  Function for activate user account
     */

    function activation($activation_key) {

        //Type casting
        $activation_key = strip_tags($activation_key);

        //Model function call
        $result = $this->users_model->activation($activation_key);
        if (is_array($result) && !empty($result)) {
            $flag = (isset($result['flag']) && $result['flag'] != '') ? $result['flag'] : 0;
            if ($flag == 1) {
                $userId = (isset($result['user_id']) && $result['user_id'] != '') ? $result['user_id'] : 0;
                if ($userId) {
                    $this->login_user_directly($userId);
                }
                $this->theme->set_message(lang('account-activation-msg'), 'success');
            } elseif ($flag == 2) {
                $this->theme->set_message(lang('activation_expiry-msg') . '<a href="' . base_url() . 'users/regenerate_activation_link/' . $activation_key . '">' . lang('regenerate_avtivation_link') . '</a>', 'error');
            } else {
                $this->theme->set_message(lang('account-already-activated-msg'), 'error');
            }
        } else {
            $this->theme->set_message(lang('account-already-activated-msg'), 'error');
        }
        //Success message

        redirect(site_url() . 'users');
        exit;
    }

    /*
     *  Function for change password
     */

    function change_password() {
        //Type casting
        $user_id = intval($this->session->userdata[$this->section_name]['user_id']);

        $result = $this->users_model->get_user_detail($user_id);

        if (!empty($result) && $result['status'] == 1) {
            //Initializing
            $data = array();
            $current_password = "";

            $this->theme->set('current_password', $current_password);

            //Logic
            if (isset($user_id) && $user_id != "" && $user_id != 0) {
                if ($this->input->post('Submit')) {
                    //Variable assignment
                    $password = trim(strip_tags($this->input->post('password')));
                    $current_password = $this->input->post('current_password');
                    $this->theme->set('current_password', $current_password);

                    //Validation rules
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[40]|xss_clean');
                    $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|matches[password]|xss_clean');

                    if ($this->form_validation->run() == TRUE) {
                        $user_data = $this->users_model->get_user_detail($user_id);
                        $current_password = encriptsha1($this->input->post('current_password'));

                        if ($current_password == $user_data['password']) {
                            $this->users_model->changepassword($user_id, $password);
                            $this->theme->set_message(lang('change-password-success'), 'success');
                            redirect(site_url() . 'users/change_password');
                        } else {
                            $this->theme->set_message(lang('does-not-match-currentpassword'), 'error');
                            redirect(site_url() . 'users/change_password');
                        }
                    }
                }
            } else {
                $this->theme->set_message(lang('do-login-msg-change-password'), 'info');
                redirect(site_url() . 'admin/users/login');
            }

            //Create page-title
            $this->theme->set('page_title', lang('change-password'));

            //Render view
            $this->theme->view($data);
        } else {
            $this->session->unset_userdata($this->section_name);
            $this->theme->set_message(lang('inactive-account-msg'), "error");
            redirect(site_url() . 'users/login');
        }
    }

    /*
     * Function for AJAX based Forgot PAssword
     */

    function ajax_forgotPassword() {
        $data = array();
        $postData = $this->input->post();
        if (!empty($postData)) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == TRUE) {
                $data['email'] = trim(strip_tags($this->input->post("email")));
                $this->users_model->email_id = $data['email'];

                $result = $this->users_model->get_user_detail_by_email($data['email']);
                if (!empty($result)) {
                    if ($result[0]['u']['status'] == '1') {
                        $random_string = get_random_string();
                        $data['password'] = encriptsha1($random_string);

                        // send email for regerate password
                        $this->users_model->forgot_password($data);

                        $forgot_array['email'] = $data['email'];
                        $forgot_array['password'] = $random_string;
                        $this->send_email($forgot_array, 'forgot_password_email_template');

                        $return['status'] = 1;
                        $return['msg'] = "We have sent login details on your email address. Please check your email.";
                    } else {
                        $return['status'] = 0;
                        $return['msg'] = "No matching email address found. Please create account.";
                    }
                } else {
                    $return['status'] = 0;
                    $return['msg'] = "No matching email address found. Please create account.";
                }
            } else {
                $return['status'] = 0;
                $return['msg'] = "Please enter valid email address.";
            }
        } else {
            $return['status'] = 0;
            $return['msg'] = "Please enter valid email address.";
        }

        echo json_encode($return);
        exit;
    }

    /*
     *  Function for forgot password
     */

    function forgot_password() {


        //Initializing
        $data = array();

        //If form submit
        if ($this->input->post('Submit')) {
            //Set validation rules
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            //Logic
            if ($this->form_validation->run() == TRUE) {
                $data['email'] = trim(strip_tags($this->input->post("email")));
                // get userdetail
                $this->users_model->email_id = $data['email'];

                $result = $this->users_model->get_user_detail_by_email($data['email']);

                if (!empty($result)) {
                    if ($result[0]['u']['status'] == '1') {
                        $random_string = get_random_string();
                        $data['password'] = encriptsha1($random_string);

                        // send email for regerate password
                        $this->users_model->forgot_password($data);

                        $forgot_array['email'] = $data['email'];
                        $forgot_array['password'] = $random_string;
                        $this->send_email($forgot_array, 'forgot_password_email_template');

                        $this->theme->set_message(lang('forgot-success-msg'), 'success');
                        //echo "Here1"; exit;
                        redirect(site_url() . 'users/login');
                    } else {
                        // For deleted & inactive group checking
                        $this->theme->set_message(lang('inactive-account-msg'), 'error');
                        redirect(site_url() . 'users/forgot_password');
                    }
                } else {
                    $this->theme->set_message(lang('forgot-error-msg'), 'error');
                    redirect(site_url() . 'users/forgot_password');
                }
            }
        }
        //Create page-title
        $this->theme->set('page_title', lang('forgot_password'));

        //Render view
        $this->theme->view($data);
    }

    /*
     * function for regenerate captcha
     */

    function recaptcha() {

        $data['captcha'] = $this->my_captcha->deleteImage()->createWord()->createCaptcha();
        echo $data['captcha'];
        exit;
    }

    /*
     * function for check unique email
     */

    public function check_unique_email() {
        $data = $this->input->post();
        $result = $this->users_model->check_unique_mail($data);
        if ($result > 0) {
            $this->form_validation->set_message('check_unique_email', lang('msg-alvailable-email'));
            return false;
        } else {
            return true;
        }
    }

    /*
     * function for regenerate avtivation link
     */

    public function regenerate_activation_link($activation_key) {
        //echo $activation_key;exit;
        $activation_code = $this->users_model->update_activation_key($activation_key);
        $userdata = $this->users_model->get_user_data_by_activation_key($activation_code);
        $this->send_email($userdata, 'registration_template');
        $this->theme->set_message(lang('account-activation-msg'), 'success');

        redirect(site_url() . 'users/login');
        exit;
    }

}
