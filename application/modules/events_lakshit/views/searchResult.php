<?php
//echo "<pre/>"; print_r($data); exit;
?>       
<!--<div class="search-panel">
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
</div>-->

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <a href="#" title="Filter" class="btn-secondary btn-filter visible-xs">Filters</a>
                <aside class="filter-block">
                    <a href="#" title="Close" class="visible-xs fa fa-close close-filter"></a>
                    <h3 class="clearfix">Filter <a href="#" title="Reset">Reset</a></h3>
                    <h4>Duration</h4>
                    <div class="filter-content">
                        <div id="duration-slider"></div>
                    </div>
                    <h4>Price</h4>
                    <div class="filter-content">
                        <div id="price-slider"></div>
                    </div>
                    <h4>User Rating</h4>
                    <div class="filter-content">
                        <label for="checkbox-3">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                        </label>
                        <input type="checkbox" name="checkbox-3" id="checkbox-3">
                        <label for="checkbox-4">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </label>
                        <input type="checkbox" name="checkbox-4" id="checkbox-4">
                    </div>
                    <h4>Transportation</h4>
                    <div class="filter-content">
                        <label for="checkbox-1">By Vehicle</label>
                        <input type="checkbox" name="checkbox-1" id="checkbox-1">
                        <label for="checkbox-2">By Bus</label>
                        <input type="checkbox" name="checkbox-2" id="checkbox-2">
                    </div>
                    <h4>Availability</h4>
                </aside>
            </div>
            <div class="col-md-9 col-sm-8">
                <section class="wide-column shrinked">
                    <div class="top-panel clearfix">
                        <ul class="tags-outer pull-left">
                            <li><span>Filter1 <a href="#" title="Remove" class="fa fa-close"></a></span></li>
                            <li><span>Filter2 <a href="#" title="Remove" class="fa fa-close"></a></span></li>
                        </ul>
                        <div class="sort-dropdown pull-right">
                            <label>Sort by:</label>
                            <div class="form-group">
                                <select class="custom-dropdown">
                                    <option>Relevance</option>
                                    <option>Popularity</option>
                                </select>
                            </div>
                            <a href="#" title="" class="btn-secondary btn-small btn-map">Map View</a>
                        </div>
                    </div>
                    <?php
                    if (isset($data['events']) && (count($data['events']) > 0)) {
                        foreach ($data['events'] as $row) {
                            $row = $row['events'];
                            ?>
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <a href="#" title="Pokemon go" class="thumb">
                                        <img src="images/destination01.jpg">
                                    </a>
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <div class="clearfix">
                                        <h4 class="pull-left"><a href="#" title="Pokemon go"><?php echo $row['title'] ?></a> <strong><?php echo '$' . $row['price'] ?></strong></h4>
                                        <div class="pull-right">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <ul class="service-details">
                                        <li>
                                            <label>Primary location:</label>
                                            <?php echo trim($row['source_address']); //.', '.$row['source_city'].', '.$row['source_state'].', '.$row['source_country'] ?>
                                        </li>
                                        <li>
                                            <label>Duration:</label>
                                            <?php echo $row['duration'] ?> hours
                                        </li>
                                        <li>
                                            <label>No. of seats left:</label>
                                            01/<?php echo $row['sheet'] ?>
                                        </li>
                                        <li>
                                            <label>Transportation:</label>
                                            <?php echo $row['transportation'] ?> only
                                        </li>
                                    </ul>
                                    <a href="<?php echo site_url('events/view/') . $row['id'] ?>" title="View Details" class="btn-secondary btn-small">View Details</a>
                                    <a href="#" title="View Details" class="btn-secondary btn-small btn-map">Map View</a>
                                </div>
                            </div>

                        <?php }
                    } ?>

                    #Other Results 

                    <?php
                    if (isset($data['eventsOthers']) && (count($data['eventsOthers']) > 0)) {
                        foreach ($data['eventsOthers'] as $row) {
                            $row = $row['events'];
                            ?>
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <a href="#" title="Pokemon go" class="thumb">
                                        <img src="images/destination01.jpg">
                                    </a>
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <div class="clearfix">
                                        <h4 class="pull-left"><a href="#" title="Pokemon go"><?php echo $row['title'] ?></a> <strong><?php echo '$' . $row['price'] ?></strong></h4>
                                        <div class="pull-right">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <ul class="service-details">
                                        <li>
                                            <label>Primary location:</label>
        <?php echo trim($row['source_address']); //.', '.$row['source_city'].', '.$row['source_state'].', '.$row['source_country']  ?>
                                        </li>
                                        <li>
                                            <label>Duration:</label>
        <?php echo $row['duration'] ?> hours
                                        </li>
                                        <li>
                                            <label>No. of seats left:</label>
                                            01/<?php echo $row['sheet'] ?>
                                        </li>
                                        <li>
                                            <label>Transportation:</label>
        <?php echo $row['transportation'] ?> only
                                        </li>
                                    </ul>
                                    <a href="<?php echo site_url('events/view/') . $row['id'] ?>" title="View Details" class="btn-secondary btn-small">View Details</a>
                                    <a href="#" title="View Details" class="btn-secondary btn-small btn-map">Map View</a>
                                </div>
                            </div>

                        <?php }
                    } else { ?>
                        <h2>No result found, please try with other city!</h2>
<?php } ?>
                    <div class="map-outer">
                        <a href="#" title="Close" class="close-map"><i class="fa fa-close"></i></a>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193747.65735076263!2d-74.08508298190995!3d40.64515936176339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24416947c2109%3A0x82765c7404007886!2sBrooklyn%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1490151309321" class="map"></iframe>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>