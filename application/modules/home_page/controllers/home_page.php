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
class Home_Page extends Base_Front_Controller
{
    /*
     * Create an instance
    */
    function __construct()
    {
        parent::__construct();
        //load helpers
        $this->load->helper(array('url', 'cookie'));
        //load theme        
        $this->theme->set_theme("events");              
    }

    /**
     * action to display language wise cms page based on slug url
     * @param string $slug_url
     */
    function index($slug_url = NULL)
    {     
        $this->load->model('cms/cms_model');        
        $data['aboutUsTitle'] = '';
        $data['aboutUsDescription'] = '';
        $data['aboutUsSlug'] = '';
        
        $data['whyUsTitle'] = '';
        $data['whyUsDescription'] = '';
        $data['whyUsSlug'] = '';
        
        $data['footerSectionTitle'] = '';
        $data['footerSectionDescription'] = '';
        $aboutus = $this->cms_model->get_cms_content_by_slug('aboutus');
       
        if(isset($aboutus['title']) && $aboutus['title'] != ''){
            $data['aboutUsTitle'] = $aboutus['title'];
        }
        if(isset($aboutus['description']) && $aboutus['description'] != ''){
            $data['aboutUsDescription'] = $aboutus['description'];
        }
        if(isset($aboutus['slug_url']) && $aboutus['slug_url'] != ''){
            $data['aboutUsSlug'] = $aboutus['slug_url'];
        }
        
        $whyUs = $this->cms_model->get_cms_content_by_slug('why-us');
        if(isset($whyUs['title']) && $whyUs['title'] != ''){
            $data['whyUsTitle'] = $whyUs['title'];
        }
        if(isset($whyUs['description']) && $whyUs['description'] != ''){
            $data['whyUsDescription'] = $whyUs['description'];
        }
        if(isset($whyUs['slug_url']) && $whyUs['slug_url'] != ''){
            $data['whyUsSlug'] = $whyUs['slug_url'];
        }
        
        $footerSection = $this->cms_model->get_cms_content_by_slug('some-heading-for-footer');
        if(isset($footerSection['title']) && $footerSection['title'] != ''){
            $data['footerSectionTitle'] = $footerSection['title'];
        }
        if(isset($footerSection['description']) && $footerSection['description'] != ''){
            $data['footerSectionDescription'] = $footerSection['description'];
        }
        $this->theme->view($data);
    }

    

}

?>