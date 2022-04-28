<?php

    include('includes/header.php');
    $title = "Title with PHP";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

    $host='http://localhost:9090/bwajes/';

?>

<div class="wrapper">
        <div class="content">
            <div style="margin-top: 60px;">
                <h1 class="brand-name">My brand name</h1>
                <div class="author">
                    <span><img class="author-img" src="<?php echo $host .'images/andi.png'; ?>" alt=""> Andrew Adelodun</span> | 
                    <span>12 min read</span>
                </div><br>
                <div>
                    <span>Date posted: 4 Dec 2007 | 1:45pm</span> | 
                    <span>Type of post: journal</span>
                </div>
                <div>
                    <span>Date updated: 9 March 2008 | 12:05pm</span> | <span><a href="about-author" class="" style="text-decoration: underline;">About author</a></span>
                </div><br>
                <div class="social">
                    <span><a href="https://wa.me/?text=[post-title] [post-url]"><i class="bx bxl-whatsapp"></i></a></span>
                    <span><a href="https://www.facebook.com/sharer?u=[post-url]"><i class="bx bxl-facebook-circle"></i></a></span>
                    <span><a href="https://twitter.com/share?url=[post-url]&text=[post-title]"><i class="bx bxl-twitter"></i></a></span>
                    <span><a href="https://linkedin.com/shareArticle?url=[post-url]&title=[post-title]"><i class="bx bxl-linkedin"></i></a></span>
                </div>
            </div>
        </div>
        <div class="content">
            <h2 style="text-align: center;">My title here</h2><br>
            <div class="google-ads">
                Google ads
            </div><br>
            <div class="affiliate-link">
                affiliate link
            </div><br>
            <div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta facere molestias fugit sit, labore nostrum sapiente sunt ullam optio ut mollitia cum minima qui consequuntur tempore. Temporibus optio vitae omnis nemo, sunt assumenda hic provident tempore fugit esse similique velit.
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore quaerat quas et corporis eum ipsa ab non eveniet, voluptates in sed omnis optio saepe animi deleniti cupiditate laborum necessitatibus praesentium ipsam ut id recusandae numquam commodi officiis. At repellat consequatur minima corrupti magnam doloremque beatae est amet, ipsum unde voluptatem placeat vero quae exercitationem facilis quidem recusandae eaque cumque aut ex quod. Repudiandae alias voluptates, adipisci error, possimus quidem ad deserunt sequi earum quis corporis dolore minus a laborum placeat!
            </div><br>
            <div>
                <a href="#" id="report">Report post</a>
            </div><br>
            <div class="affiliate-link">
                affiliate link
            </div>
        </div>
        <div class="modal" id="report-modal">
            <div class="card">
                <div class="close" id="report-close">&times;</div>
                <form action="">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="csrf" value="" id="csrf">
                    </div>
                    <div class="form-group">
                        <label for="report">Report*</label>
                        <select class="form-control" name="report" id="report">
                            <option value="null">Please select report</option>
                            <option value="">Nudity</option>
                            <option value="">Violence</option>
                            <option value="">Harassment</option>
                            <option value="">Suicide or self-injury</option>
                            <option value="">False information</option>
                            <option value="">Spam</option>
                            <option value="">Unauthorised sales</option>
                            <option value="">Hate speech</option>
                            <option value="">Terrorism</option>
                        </select>
                    </div>
                    <button name="report-post" class="btn btn-danger form-control">Report post</button>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="posts-container">
                <div style="width: 100%;">
                    <p class="bwajes-plus">More from Full name</p>
                    <div class="posts">
                        <a href="index?pid=idWithPhp&pt=myTitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="index?pid=idWithPhp&pt=myTitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="index?pid=idWithPhp&pt=myTitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                    </div><br>
                    <div><a style="width: 100%;align-items:center;" href="register" class="btn btn-danger">Register now for free!</a></div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="posts-container">
                <div style="width: 100%;">
                    <p class="bwajes-plus">More from bwajes+(with the same 'type' as this current post)</p>
                    <div class="posts">
                        <a href="index?pid=idWithPhp&pt=myTitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="index?pid=idWithPhp&pt=myTitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="index?pid=idWithPhp&pt=myTitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                    </div><br>
                    <div><a style="width: 100%;align-items:center;" href="register" class="btn btn-danger">Register now for free!</a></div>
                </div>
            </div>
        </div>
        <div class="content post">
            <div class="post-form">
                <h3>Leave a comment</h3>
                <form action="" style="color: #0f004e;">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="csrf" value="" id="csrf">
                    </div>
                    <div class="form-group">
                        <label for="firstname">First name*</label>
                        <input type="text" class="form-control" placeholder="Enter firstname" id="firstname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="text" class="form-control" placeholder="Enter email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" placeholder="Enter website" id="website">
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments*</label>
                        <textarea class="form-control" rows="5" id="comments"></textarea>
                    </div>
                    <button name="comment" class="btn btn-success form-control">Comment</button>
                </form><br>
                <div>
                    Display comments
                </div>
            </div>
        </div>
        <div class="content">
            <div class="google-ads">
                Google ads
            </div>
        </div>
    </div>


<?php

    include('includes/footer.php');

?>