<?php
$this->title = "Chi tiết bài viết";

?>
<!-- Begin Kenne's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <h2>Blog Details</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Left Sidebar</li>
            </ul>
        </div>
    </div>
</div>
<!-- Kenne's Breadcrumb Area End Here -->

<!-- Begin Kenne Blog Details Area -->
<div class="blog-details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <div class="kenne-blog-sidebar-wrapper">
                    <div class="kenne-blog-sidebar">
                        <h4 class="kenne-blog-sidebar-title">Search</h4>
                        <div class="search-form_area">
                            <form class="search-form" action="javascript:void(0)">
                                <input type="text" class="search-field" placeholder="search here">
                                <button type="submit" class="search-btn"><i class="ion-ios-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="kenne-blog-sidebar">
                        <h4 class="kenne-blog-sidebar-title">Archives</h4>
                        <ul class="kenne-blog-archive">
                            <li><a href="javascript:void(0)">October 2019</a></li>
                        </ul>
                    </div>
                    <div class="kenne-blog-sidebar">
                        <h4 class="kenne-blog-sidebar-title">Recent Posts</h4>


<!--///////////////////////////////////////////////Recent Post//////////////////////////////////////////////////////////-->
                        <?php foreach ($recentPost as $item) : ?>
                        <?php if(isset($item->image)) { ?>
                        <div class="recent-post">
                            <div class="recent-post_thumb">
                                <a href="<?php echo \yii\helpers\Url::toRoute(['/blog/blog-detail','id' => $item['id']]);?>">
                                    <img class="img-full" src="<?php echo '/backend/web/uploads/'.$item->image[0]; ?>" alt="Kenne's Blog Image">
                                </a>
                            </div>
                            <div class="recent-post_desc">
                                <span><a href="blog-details.html">Ut eum laborum</a></span>
                                <span class="post-date">October 25,2019</span>
                            </div>
                        </div>
                        <?php } ?>
                        <?php endforeach;?>
<!--///////////////////////////////////////////////End Recent Post//////////////////////////////////////////////////////////-->


                        <h4 class="kenne-blog-sidebar-title">Comments</h4>
                        <div class="recent-comment">
                            <div class="user-img">
                                <img class="img-full" src="/images/blog/admin.jpg" alt="Kenne's Blog Image">
                            </div>
                            <div class="user-info">
                                <span>HasTech say:</span>
                                <a href="javascipt:void(0)">Nulla auctor mi vel nisl...</a>
                            </div>
                        </div>
                        <div class="recent-comment">
                            <div class="user-img">
                                <img class="img-full" src="/images/blog/user.jpg" alt="Kenne's Blog Image">
                            </div>
                            <div class="user-info">
                                <span>Kathy Young say:</span>
                                <a href="javascipt:void(0)">Mauris Venenatis Orci Quis...</a>
                            </div>
                        </div>
                        <div class="recent-comment">
                            <div class="user-img">
                                <img class="img-full" src="/images/blog/admin.jpg" alt="Kenne's Blog Image">
                            </div>
                            <div class="user-info">
                                <span>HasTech say:</span>
                                <a href="javascipt:void(0)">Quisque Semper Nunc Vitae...</a>
                            </div>
                        </div>
                        <div class="recent-comment">
                            <div class="user-img">
                                <img class="img-full" src="/images/blog/user.jpg" alt="Kenne's Blog Image">
                            </div>
                            <div class="user-info">
                                <span>Kathy Young say:</span>
                                <a href="javascipt:void(0)">Thanks for the information, anyway :)</a>
                            </div>
                        </div>
                    </div>
                    <div class="kenne-blog-sidebar">
                        <h4 class="kenne-blog-sidebar-title">Tags</h4>
                        <ul class="kenne-tags_list">
                            <li><a href="javascript:void(0)">Shirt</a></li>
                            <li><a href="javascript:void(0)">Hoodie</a></li>
                            <li><a href="javascript:void(0)">Jacket</a></li>
                            <li><a href="javascript:void(0)">Scarf</a></li>
                            <li><a href="javascript:void(0)">Frocks</a></li>
                        </ul>
                    </div>
                </div>
            </div>






            <div class="col-lg-9 order-lg-2 order-1">
                <div class="blog-item">
                    <div class="blog-img">
                        <a href="blog-details.html">
                                <img src="<?php  echo '/backend/web/uploads/'.$data->image[0]?>" alt="Blog Image">
                        </a>
                    </div>
                    <div class="blog-content">
                        <h3 class="heading">
                            <a href="blog-details.html"><?php echo $data->title?></a>
                        </h3>
                        <p class="short-desc">
                            <?php echo $data->descriptions?>
                        </p>
                        <div class="blog-meta">
                            <ul>
                                <li><?php echo $data->date?></li>
                                <li>
                                    <a href="javascript:void(0)">02 Comments</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="kenne-blog-blockquote">
                    <blockquote>
                        <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur. In venenatis elit ac ultrices convallis. Duis est nisi, tincidunt ac urna sed, cursus blandit lectus. In ullamcorper sit amet ligula ut eleifend. Proin dictum tempor ligula, ac feugiat metus. Sed finibus tortor eu scelerisque scelerisque.
                        </p>
                    </blockquote>
                </div>
                <div class="blog-additional_information">
                    <p>Aenean et tempor eros, vitae sollicitudin velit. Etiam varius enim nec quam tempor, sed efficitur ex ultrices. Phasellus pretium est vel dui vestibulum condimentum. Aenean nec suscipit nibh. Phasellus nec lacus id arcu facilisis elementum. Curabitur lobortis, elit ut elementum congue, erat ex bibendum odio, nec iaculis lacus sem non lorem. Duis suscipit metus ante, sed convallis quam posuere quis. Ut tincidunt eleifend odio, ac fringilla mi vehicula nec. Nunc vitae lacus eget lectus imperdiet tempus sed in dui. Nam molestie magna at risus consectetur, placerat suscipit justo dignissim. Sed vitae fringilla enim, nec ullamcorper arcu.
                    </p>
                </div>
                <div class="blog-additional_information">
                    <p>Suspendisse turpis ipsum, tempus in nulla eu, posuere pharetra nibh. In dignissim vitae lorem non mollis. Praesent pretium tellus in tortor viverra condimentum. Nullam dignissim facilisis nisl, accumsan placerat justo ultricies vel. Vivamus finibus mi a neque pretium, ut convallis dui lacinia. Morbi a rutrum velit. Curabitur sagittis quam quis consectetur mattis. Aenean sit amet quam vel turpis interdum sagittis et eget neque. Nunc ante quam, luctus et neque a, interdum iaculis metus. Aliquam vel ante mattis, placerat orci id, vehicula quam. Suspendisse quis eros cursus, viverra urna sed, commodo mauris. Cras diam arcu, fringilla a sem condimentum, viverra facilisis nunc. Curabitur vitae orci id nulla maximus maximus. Nunc pulvinar sollicitudin molestie.
                    </p>
                </div>
                <div class="kenne-tag-line">
                    <h4>Tag:</h4>
                    <a href="javascript:void(0)">chair</a>,
                    <a href="javascript:void(0)">interior</a>,
                    <a href="javascript:void(0)">tables</a>
                </div>
                <div class="kenne-social_link">
                    <ul>
                        <li class="facebook">
                            <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                <i class="fab fa-twitter-square"></i>
                            </a>
                        </li>
                        <li class="google-plus">
                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                <i class="fab fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="instagram">
                            <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="kenne-comment-section">
                    <h3>04 comment</h3>
                    <ul>
                        <li>
                            <div class="author-avatar">
                                <img src="/images/blog/user.jpg" alt="User">
                            </div>
                            <div class="comment-body">
                                <span class="reply-btn"><a href="javascript:void(0)">reply</a></span>
                                <h5 class="comment-author">Kathy Young</h5>
                                <div class="comment-post-date">
                                    25 Oct, 2019 at 10:30am
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maiores adipisci
                                    optio ex,
                                    laboriosam
                                    facilis non pariatur itaque illo sunt?</p>
                            </div>
                        </li>
                        <li class="comment-children">
                            <div class="author-avatar">
                                <img src="/images/blog/admin.jpg" alt="Admin">
                            </div>
                            <div class="comment-body">
                                <span class="reply-btn"><a href="javascript:void(0)">reply</a></span>
                                <h5 class="comment-author">HasTech</h5>
                                <div class="comment-post-date">
                                    25 Oct, 2019 at 11:00am
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim maiores adipisci
                                    optio ex,
                                    laboriosam
                                    facilis non pariatur itaque illo sunt?</p>
                            </div>
                        </li>
                        <li>
                            <div class="author-avatar">
                                <img src="/images/blog/user.jpg" alt="User">
                            </div>
                            <div class="comment-body">
                                <span class="reply-btn"><a href="javascript:void(0)">reply</a></span>
                                <h5 class="comment-author">Kathy Young</h5>
                                <div class="comment-post-date">
                                    25 Oct, 2019 at 06:50pm
                                </div>
                                <p>Thank You :)</p>
                            </div>
                        </li>
                        <li class="comment-children">
                            <div class="author-avatar">
                                <img src="/images/blog/admin.jpg" alt="Admin">
                            </div>
                            <div class="comment-body">
                                <span class="reply-btn"><a href="javascript:void(0)">reply</a></span>
                                <h5 class="comment-author">HasTech</h5>
                                <div class="comment-post-date">
                                    25 Oct, 2019 at 11:00am
                                </div>
                                <p>Your Welcome ^^</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="kenne-blog-comment-wrapper">
                    <h3>leave a reply</h3>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <form action="javascript:void(0)">
                        <div class="comment-post-box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>comment</label>
                                    <textarea name="commnet" placeholder="Write a comment"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>Name</label>
                                    <input type="text" class="coment-field" placeholder="Name" formmethod="post">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>Email</label>
                                    <input type="text" class="coment-field" placeholder="Email">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>Website</label>
                                    <input type="text" class="coment-field" placeholder="Website">
                                </div>
                                <div class="col-lg-12">
                                    <div class="comment-btn_wrap f-left">
                                        <div class="kenne-btn-ps_left">
                                            <a class="kenne-btn transparent-btn transparent-btn-2" href="javascript:void(0)">Post comment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kenne Blog Details Area End Here -->
