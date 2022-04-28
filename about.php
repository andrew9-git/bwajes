<?php

    include('includes/header.php');
    $title = "About Us - bwajes+";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>


<div class="wrapper">
        <div class="content" id="intro">
            <div class="stay-informed">
                <h1>Stay informed.</h1>
                <h3>Publish your content for the world to see!</h3><br>
                <p>Let the world know what you are made of...</p>
                <p>Write to inspire. Write to teach. Write to make the world happy!</p><br>
                <a href="register" class="btn btn-primary">Get started now!</a>
                <p>in creating your own MIND-BLOWING content</p>
            </div>
        </div>
        <div class="content">
            <div class="users-container">
                <div style="width: 100%;">
                    <p class="bwajes-plus">bwajes+ is made just for</p><br>
                    <div class="users">
                        <div class="bwajes businesses"><p>businesses</p></div>
                        <div class="bwajes bloggers"><p>bloggers</p></div>
                        <div class="bwajes writers"><p>writers</p></div>
                        <div class="bwajes journalist"><p>journalist</p></div>
                        <div class="bwajes story-tellers"><p>story tellers</p></div>
                        <div class="bwajes others"><p>Others</p></div>
                    </div><br>
                    <div><a style="width: 100%;align-items:center;" href="register" class="btn btn-danger">Register now for free!</a></div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="posts-container">
                <div style="width: 100%;">
                    <p class="bwajes-plus">Recent on bwajes+</p>
                    <div class="posts">
                        <a href="post/4/<?php echo htmlentities(rawurlencode('#')); ?>" class="bwajes">
                            <div>
                                <!-- Use php to shorten the title to 20 - 30 characters, increase if less than 20 characters -->
                                <span><img src="../images/andi.png" alt=""> Andrew Adelodun</span>
                                <p>Lorem, ipsum dolor sit amet consectetur</p>
                                <span>5 April 12 min read</span>
                            </div>
                        </a>
                        <a href="post/4/mytitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="post/4/mytitle" class="bwajes">
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
            <div class="type-container">
                <div>
                    <p class="bwajes-plus">Discover more of what matter most to you</p>
                    <div>
                        <div class="type">
                            <div><a href="content-type?tid=idWithPhp" class="btn">Health & fitness</a></div>
                            <div><a href="content-type?tid=idWithPhp" class="btn">Art</a></div>
                            <div><a href="content-type?tid=idWithPhp" class="btn">Business & Career</a></div>
                            <div><a href="content-type?tid=idWithPhp" class="btn">Technology</a></div>
                        </div>
                        <div class="type">
                            <div><a href="content-type?tid=idWithPhp" class="btn">Sport</a></div>
                            <div><a href="content-type?tid=idWithPhp" class="btn">Religion</a></div>
                            <div><a href="content-type?tid=idWithPhp" class="btn">Family & friends</a></div>
                            <div><a href="content-type?tid=idWithPhp" class="btn">Environment</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <!-- Older posts(or any other post) can go here -->
            <div class="posts-container">
                <div style="width: 100%;">
                    <p class="bwajes-plus">More on bwajes+</p>
                    <div class="posts">
                        <a href="post/4/mytitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="post/4/mytitle" class="bwajes">
                            <div>
                                <span><img src="" alt=""> Fullname</span>
                                <p>My title is....</p>
                                <span>Date 12 min read</span>
                            </div>
                        </a>
                        <a href="post/4/mytitle" class="bwajes">
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
    </div>

<?php

    include('includes/footer.php');

?>