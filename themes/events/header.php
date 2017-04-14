<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $ci->theme->get_page_title('Events'); ?></title>
        <?php echo display_meta(); ?>
        <?php
        echo add_css(array('reset', 'bootstrap.min')); // adds css
        ?>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"></link>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"></link>
        <?php
        echo add_css(array('reset', 'bootstrap.min', 'jquery-ui.min', 'dropkick', 'font-awesome', 'nouislider.min', 'easy-responsive-tabs', 'style', 'media')); // adds few more csss
        echo add_js(array('jquery.min', 'bootstrap.min', 'jquery-imagefill', 'imagesloaded.pkgd.min', 'jquery-ui.min', 'dropkick', 'easyResponsiveTabs', 'nouislider.min', 'jquery.validate.min', 'jquery.validationEngine', 'general', 'dev_general')); // adds js files
        //echo add_js(array('jquery.validate.min'));
        ?>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        $controller = $this->_ci->router->fetch_class();
        $class = '';
        if ($controller != 'home_page') {
            $class = 'innerpage';
        }
        ?>
        <div class="wrapper <?php echo $class; ?>">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-xs-3">
                            <a href="<?php echo base_url('/'); ?>" title="Tture" class="logo">Tture</a>
                        </div>

                        <?php
                        $menuClass = 'col-sm-5';
                        if (isset($this->_ci->session->userdata['front']['logged_in']) && $this->_ci->session->userdata['front']['logged_in'] == 1) {
                            $menuClass = 'col-sm-8';
                        }
                        ?>

                        <div class="<?php echo $menuClass; ?> pull-right">  
                            <a href="#" title="Menu" class="hamburger-icon visible-xs"><span></span></a>
                            <nav class="navigation">
                                <?php
                                if (isset($this->_ci->session->userdata['front']['logged_in']) && $this->_ci->session->userdata['front']['logged_in'] == 1) {
                                    //echo "<pre>"; print_r($this->_ci->session->userdata['front']); echo "</pre>";
                                    $name = $this->_ci->session->userdata['front']['firstname'] . " " . $this->_ci->session->userdata['front']['lastname'];
                                    $profileImage_name = $this->_ci->session->userdata['front']['profileImage'];
                                    $profileImageURL = '';
                                    if ($profileImage_name != '') {
                                        $profileImageURL = $this->_ci->config->item('userImageURL') . $profileImage_name;
                                    }
                                    ?>
                                    <ul class="clearfix">
                                        <li class="username visible-xs">
                                            Welcome <?php echo $name; ?> 
                                            <?php
                                            if ($profileImageURL != '') {
                                                ?>
                                                <img src="<?php echo $profileImageURL; ?>" />
                                                <?php
                                            } else {
                                                echo add_image(array('dummy.jpg'));
                                            }
                                            ?>                                            
                                        </li>
                                        <li class="visible-xs">
                                            <a href="<?php echo base_url('users/profile'); ?>" title="Edit Profile">Edit Profile</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('/users/logout'); ?>" title="Logout">Logout</a>
                                        </li>
                                        <li class="hidden-xs">
                                            <a href="<?php echo base_url('users/profile'); ?>" title="Edit Profile">Edit Profile</a>
                                        </li>
                                        <li class="username hidden-xs">
                                            Welcome <?php echo $name; ?> 
                                            <?php
                                            if ($profileImageURL != '') {
                                                ?>
                                                <img src="<?php echo $profileImageURL; ?>" />
                                                <?php
                                            } else {
                                                echo add_image(array('dummy.jpg'));
                                            }
                                            ?>
                                        </li>
                                    </ul>
                                    <?php
                                } else {
                                    ?>
                                    <ul class="clearfix">
                                        <li>
                                            <a href="#" title="Login"  data-toggle="modal" data-target="#loginModal">Login</a>
                                        </li>
                                        <li>
                                            <a href="#" title="Register" data-toggle="modal" data-target="#registerModal">Register</a>
                                        </li>
                                    </ul>
                                    <?php
                                }
                                ?>

                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <?php
            if ($controller != 'home_page') {
                // search pannel for inner pages.
                ?>
                <div class="search-panel">
                    <form class="container" id="searchResultSearchForm" method="post" action="<?php echo site_url('events/search') ?>">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="search_term" class="form-control" value="<?php echo (isset($data['search_term'])) ? $data['search_term'] : ''; ?>" placeholder="Enter your destination">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" id="datepicker" class="form-control" placeholder="Date">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="custom-dropdown">
                                        <option>Duration</option>
                                        <option>Duration</option>
                                        <option>Duration</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="hidden" onchange="submitSearchForm('searchResultSearchForm')" name="filter_duration" id="filter_duration" value="<?php echo (isset($data['filter_duration'])) ? $data['filter_duration'] : '2'; ?>" />
                                <input type="hidden" onchange="submitSearchForm('searchResultSearchForm')" name="filter_price" id="filter_price" value="<?php echo (isset($data['filter_price'])) ? $data['filter_price'] : '2'; ?>" />
                                <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">					
                                    <button type="submit" class="btn-secondary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            } else {
                ?>
                <section class="banner">
                    <div id="banner-slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <?php
                                echo add_image(array('slide01.jpg'));
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="search-panel">
                        <form class="container" id="searchResultSearchForm" method="post" action="<?php echo site_url('events/search') ?>">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="search_term" class="form-control" value="<?php echo (isset($data['search_term'])) ? $data['search_term'] : ''; ?>" placeholder="Enter your destination">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" id="datepicker" class="form-control" placeholder="Date">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select class="custom-dropdown">
                                            <option>Duration</option>
                                            <option>Duration</option>
                                            <option>Duration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" onchange="submitSearchForm('searchResultSearchForm')" name="filter_duration" id="filter_duration" value="<?php echo (isset($data['filter_duration'])) ? $data['filter_duration'] : '2'; ?>" />
                                    <input type="hidden" onchange="submitSearchForm('searchResultSearchForm')" name="filter_price" id="filter_price" value="<?php echo (isset($data['filter_price'])) ? $data['filter_price'] : '2'; ?>" />
                                    <input type="hidden" name="<?php echo $this->_ci->security->get_csrf_token_name(); ?>" value="<?php echo $this->_ci->security->get_csrf_hash(); ?>">					
                                        <button type="submit" class="btn-secondary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <?php
            }
            ?>
            <div class="message_div">
                <?php echo $this->message(); ?>
            </div>

