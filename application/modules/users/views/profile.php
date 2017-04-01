<?php
$CI = & get_instance();
?>
<section class="main-content">
            <div class="container">
                <div class="card-wrap clearfix">
                    <div class="profile-image">
                        <?php echo add_image(array('dummy.jpg')); ?>
                        <a href="#" title="Edit" class="edit-link">Edit</a>
                        <a href="#" title="Remove" class="remove-link">Remove</a>
                    </div>
                    <div class="edit-left">
                        <div class="checkbox-outer">
                            <label for="checkbox-1">Checkbox1</label>
                            <input type="checkbox" name="checkbox-1" id="checkbox-1">
                            <label for="checkbox-2">Checkbox2</label>
                            <input type="checkbox" name="checkbox-2" id="checkbox-2">
                            <label for="checkbox-3">Checkbox3</label>
                            <input type="checkbox" name="checkbox-3" id="checkbox-3">
                        </div>
                    </div>
                    <div class="progress-block">70%</div>
                </div>
                <div id="parentVerticalTab" class="clearfix vertical-tabs">
                    <ul class="resp-tabs-list hor_1">
                        <li>Create Event</li>
                        <li>Edit Profile</li>
                        <li class="active">Account Details</li>
                        <li>Review by you</li>
                        <li>Review for you</li>
                        <li>Your trips</li>
                        <li>Your hosting</li>
                        <li>FAQ</li>
                    </ul>
                    <div class="resp-tabs-container hor_1">
                        <div>
                            <?php $CI->load->view($middle); ?>
                            
                        </div>
                        <div>
                            <h4 class="text-center">Edit your details</h4>
                            <form>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <input class="form-control border-input" type="text" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input class="form-control border-input" type="text" placeholder="Last Name">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input class="form-control border-input" type="email" placeholder="Email Address">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input class="form-control border-input" type="password" placeholder="Password">
                                    </div>
                                </div>
                                <button class="btn-secondary btn-small">Update</button>
                            </form>
                        </div>
                        <div>
                            <form>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <input class="form-control border-input" type="text" placeholder="Name">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input class="form-control border-input" type="text" placeholder="Account Number">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="custom-dropdown small-dropdown">
                                            <option>Option1</option>
                                            <option>Option2</option>
                                            <option>Option3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn-secondary btn-small pull-left">Update</button>
                                    <button class="btn-secondary btn-small pull-left">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="review-tab">
                            <div class="media">
                                <div class="media-left">
                                    <?php echo add_image(array('dummy.jpg')); ?>
                                </div>
                                <div class="media-body">
                                    <p>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <p><strong>Posted on 20 April, 2015</strong></p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <?php echo add_image(array('dummy.jpg')); ?>
                                </div>
                                <div class="media-body">
                                    <p>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <p><strong>Posted on 20 April, 2015</strong></p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left">
                                    <?php echo add_image(array('dummy.jpg')); ?>
                                </div>
                                <div class="media-body">
                                    <p>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <p><strong>Posted on 20 April, 2015</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="review-tab">
                            <div class="media">
                                <div class="media-left">
                                    <?php echo add_image(array('dummy.jpg')); ?>
                                </div>
                                <div class="media-body">
                                    <p>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <p><strong>Posted on 20 April, 2015</strong></p>
                                    <p><a href="#" title="Reply" data-toggle="collapse" data-target="#collapseReply">Reply</a></p>
                                    <div class="media">
                                        <div class="media-left">
                                            <?php echo add_image(array('dummy.jpg')); ?>
                                        </div>
                                        <div class="media-body">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            <p><strong>Posted on 20 April, 2015</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseReply">
                                    <form>
                                        <div class="form-group">
                                            <textarea class="form-control border-input" placeholder="Reply"></textarea>
                                        </div>
                                        <button class="btn-secondary btn-small">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="trips-tab">
                            <ul class="trip-list">
                                <li class="clearfix">
                                    <span class="pull-left">Trip1</span>
                                    <div class="pull-right">
                                        <a href="#" title="Complete the trip" class="btn-secondary btn-small">Complete the trip</a>
                                        <a href="#" title="Complain about the trip" class="btn-secondary btn-small">Complain about the trip</a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <span class="pull-left">Trip2</span>
                                    <div class="pull-right">
                                        <a href="#" title="Complete the trip" class="btn-secondary btn-small">Complete the trip</a>
                                        <a href="#" title="Complain about the trip" class="btn-secondary btn-small">Complain about the trip</a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <span class="pull-left">Trip3</span>
                                    <div class="pull-right">
                                        <a href="#" title="Complete the trip" class="btn-secondary btn-small">Complete the trip</a>
                                        <a href="#" title="Complain about the trip" class="btn-secondary btn-small">Complain about the trip</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="trips-tab hosting-tab">
                            <h4 class="text-center">Your Hostings</h4>
                            <ul class="trip-list">
                                <li class="clearfix">
                                    <span class="pull-left">Event1</span>
                                    <div class="pull-right">
                                        <a href="#" title="Redeem Payment">Redeem Payment</a>
                                        <a href="#" title="Delete trip">Delete trip</a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <span class="pull-left">Event2</span>
                                    <div class="pull-right">
                                        <a href="#" title="Redeem Payment">Redeem Payment</a>
                                        <a href="#" title="Delete trip">Delete trip</a>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <span class="pull-left">Event3</span>
                                    <div class="pull-right">
                                        <a href="#" title="Redeem Payment">Redeem Payment</a>
                                        <a href="#" title="Delete trip">Delete trip</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="faq-section">
                            <ul>
                                <li>
                                    <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit?</strong>
                                    <div class="faq-content">
                                        <p> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </li>
                                <li>
                                    <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit ?</strong>
                                    <div class="faq-content">
                                        <p> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </li>
                                <li>
                                    <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit?</strong>
                                    <div class="faq-content">
                                        <p> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>