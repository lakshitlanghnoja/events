<?php
###################################################################
##
##	Library of breadcrumb
##	Version: 1.0
##
##	Last Edit:
##	August 1 2013
##
##	Description:
##	Breadcrumb
##	
##	Developed by:
##	By Pankit Shah
##	
##	Comments:
##	To display breadcrumb
##
##################################################################
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Breadcrumb {

    private $breadcrumbs = array();
    private $separator = '';//' › ';
    private $start = '<div class="breadcrumb"><ul class="clearfix">';
    private $end = '</ul></div>';

    public function __construct($params = array()) {
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }

    private function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->{'_' . $key})) {
                    $this->{'_' . $key} = $val;
                }
            }
        }
    }

    /**
     *  Breadcrumb Method: add
     * Allows to add new breadcrumb with URL
     * @param $title 
     * @param $href - optional, default #
     */
    function add($title, $href='#') {
        if (!$title OR !$href)
            return; $this->breadcrumbs[] = array('title' => $title, 'href' => $href);
    }

    /**
     *  Breadcrumb Method: output
     * Allows to display breadcrumb
     */
    function output() {
        if ($this->breadcrumbs) {
            $output = $this->start;
            foreach ($this->breadcrumbs as $key => $crumb) {
                if ($key) {
                    //$output .= $this->separator;
                    $output .= " ".add_image(array('bcarrow.png'))." ";
                } if (end(array_keys($this->breadcrumbs)) == $key) {
                    $output .= '<span>' . $crumb['title'] . '</span>';
                } else {
                    $output .= '<a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
                }
            } return $output . $this->end . PHP_EOL;
        } return '';
    }

}

?>