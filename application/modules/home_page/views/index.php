
<section class="main-content pb0">
    <div class="container">
        <h1>Page Header</h1>
        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="row thumbnail-outer">
            <div class="col-sm-4">
                <div class="thumbnail">
                    <a href="#" title="">
                        <?php echo add_image(array('destination01.jpg')); ?>
                    </a>
                    <div class="caption">
                        <h3><a href="#" title="">Thumbnail Title</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <a href="#" title=""><?php echo add_image(array('destination01.jpg')); ?></a>
                    <div class="caption">
                        <h3><a href="#" title="">Thumbnail Title</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <a href="#" title=""><?php echo add_image(array('destination01.jpg')); ?></a>
                    <div class="caption">
                        <h3><a href="#" title="">Thumbnail Title</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.</p>
                    </div>
                </div>
            </div>
        </div>

        <h2>Our Popular Destinations</h2>
        <div class="row destination-outer">
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="#" title="Destination">
                        <?php echo add_image(array('destination02.jpg'), '', '', array('alt' => 'Destination', 'class' => 'img-responsive')); ?>
                    </a>
                    <span class="btn-outer"><a href="#" title="View Details" class="btn-secondary">View Details</a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="container">
            <?php
            if (isset($data['footerSectionTitle']) && $data['footerSectionTitle'] != '') {
                ?>
                <h2 class="text-center"><?php echo $data['footerSectionTitle']; ?></h2>
                <?php
            }
            if (isset($data['footerSectionDescription']) && $data['footerSectionDescription'] != '') {
                $tags = array("&lt;p&gt;", "&lt;/p&gt;");
                ?>
                <p class="text-center"><?php echo str_replace($tags, "", $data['footerSectionDescription']); ?></p>
                <?php
            }
            ?>            
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    if (isset($data['aboutUsTitle']) && $data['aboutUsTitle'] != '') {
                        ?>
                        <h3><?php echo str_replace($tags, "", $data['aboutUsTitle']); ?></h3>
                        <?php
                    }
                    if (isset($data['aboutUsDescription']) && $data['aboutUsDescription'] != '') {
                        $content = str_replace($tags, "", $data['aboutUsDescription']);
                        $content = implode(' ', array_slice(explode(' ', $content), 0, 100));
                        ?>
                        <p class="pb0"><?php echo $content; ?>                        
                        </p>
                        
                        <?php                        
                        $detailLink =  base_url('/cms/index/'.$data['aboutUsSlug']);
                        ?>
                        <div class="contentReadMoreLink"><a href="<?php echo $detailLink;?>">Read More</a></div>
                        <?php
                    }
                    ?>

                </div>
                <div class="col-sm-6">
                    <?php
                    if (isset($data['whyUsTitle']) && $data['whyUsTitle'] != '') {
                        ?>
                        <h3><?php echo str_replace($tags, "", $data['whyUsTitle']); ?></h3>
                        <?php
                    }
                    if (isset($data['whyUsDescription']) && $data['whyUsDescription'] != '') {
                        $content = str_replace($tags, "", $data['whyUsDescription']);
                        $content = implode(' ', array_slice(explode(' ', $content), 0, 100));
                        ?>
                        <p class="pb0"><?php echo $content; ?></p>
                        <?php                        
                        $detailLink =  base_url('/cms/index/'.$data['whyUsSlug']);
                        ?>
                        <div class="contentReadMoreLink"><a href="<?php echo $detailLink;?>">Read More</a></div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>
</section>
<style>
    .contentReadMoreLink{width: 100%; text-align: right;}
    .contentReadMoreLink a{color:#0070b1}
    .contentReadMoreLink a:hover{color:#6a6c6e}
</style>
