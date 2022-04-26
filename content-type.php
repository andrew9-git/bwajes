<?php

    include('includes/header.php');
    $title = "Title with PHP";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

    <div class="wrapper">
        <div class="content">
            <div style="margin-top: 60px;">
                <h1><i class="bx bx-purchase-tag">Health</i></h1>
                <span>439K Stories 15K Writers</span>
                <a href="register" class="btn btn-primary">Start writing</a><br><br>
                <hr><br>
                <div class="posts-container">
                    <div style="width: 100%;">
                        <p class="bwajes-plus">More from bwajes+(on the same type)</p>
                        <div class="posts">
                            <a href="post?pid=idWithPhp&pt=myTitle" class="bwajes">
                                <div>
                                    <span><img src="" alt=""> Fullname</span>
                                    <p>My title is....</p>
                                    <span>Date 12 min read</span>
                                </div>
                            </a>
                            <a href="post?pid=idWithPhp&pt=myTitle" class="bwajes">
                                <div>
                                    <span><img src="" alt=""> Fullname</span>
                                    <p>My title is....</p>
                                    <span>Date 12 min read</span>
                                </div>
                            </a>
                            <a href="post?pid=idWithPhp&pt=myTitle" class="bwajes">
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
    </div>

<?php

    include('includes/footer.php');

?>