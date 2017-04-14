<?php
if (is_array($review_by_user) && !empty($review_by_user)) {
    foreach ($review_by_user as $review) {
        ?>
        <div class="media">
            <div class="media-left">
                <?php
                if ($profileData['profile_image'] != '') {
                    $imageURL = $ci->config->item('userImageURL') . $profileData['profile_image'];
                    ?>
                    <img src="<?php echo $imageURL; ?>">
                    <?php
                } else {
                    echo add_image(array('dummy.jpg'));
                }
                ?>                
            </div>
            <div class="media-body">
                <h3><a href="<?php echo base_url('/event/index/' . $review['e']['slug']); ?>"><?php echo $review['e']['eventTitle']; ?></a></h3>
                <?php
                $rate = (int) $review['er']['rate'];
                ?>
                <p>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rate) {
                            echo '<i class="fa fa-star"></i>';
                        } else {
                            echo '<i class="fa fa-star-o"></i>';
                        }
                    }
                    ?>                    
                </p>
                <p><?php print_r($review['er']['review']); ?></p>
                <?php
                if ($review['er']['created'] != '' || $review['er']['created'] != '0000-00-00 00:00:00') {
                    ?>
                    <p><strong>Posted on <?php echo date('d M,Y', strtotime($review['er']['created'])); ?></strong></p>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}
?>
