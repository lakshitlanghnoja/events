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
        echo add_css(array('jquery-ui.min', 'dropkick', 'font-awesome', 'style', 'media')); // adds few more csss
        echo add_js(array('jquery.min', 'bootstrap.min', 'jquery-imagefill', 'imagesloaded.pkgd.min', 'jquery-ui.min', 'dropkick', 'general','dev_general')); // adds js files
        ?>

    </head>
    <body>

        <div class="wrapper">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- <a href="#" title="Logo" class="logo">Logo</a> -->
                        </div>
                        <div class="col-sm-5 pull-right">                            
                            <nav class="navigation">
                                <?php
                                if (isset($this->_ci->session->userdata['front']['logged_in']) && $this->_ci->session->userdata['front']['logged_in'] == 1) {
                                    widget('front_menu', array('menu_name' => 'front_menu', 'section_name' => $ci->theme->get('section_name')));
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

                                //widget('front_menu', array('menu_name' => 'front_menu', 'section_name' => $ci->theme->get('section_name')));
                                ?>

                            </nav>
                        </div>
                    </div>
                </div>
            </header>