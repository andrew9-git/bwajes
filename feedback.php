<?php

    include('includes/header.php');
    $title = "Product feedback - bwajes+";
    $description = "To comment or report any problems you experienced";
    bwajes_plus_header($title, $description);

?>

    <div class="wrapper form">
        <div class="content form" style="padding-top: 80px;">
            <form action="">
                <p style="color: white;">Use the form below to send us your comments. We read all feedbacks carefully, but we are unable to respond to each submission individually. If you provide your email address, you agree that we may contact you to better understand the comments you submitted</p>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="csrf" value="" id="csrf">
                </div>
                <div class="form-group">
                    <label for="firstname">First name*</label>
                    <input type="text" class="form-control" placeholder="Enter first name" id="firstname">
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="email">
                </div>
                <div class="form-group">
                    <label for="subject">Subject*</label>
                    <input type="text" class="form-control" placeholder="Enter subject" id="subject">
                </div>
                <div class="form-group">
                    <label for="support">Feedback*</label>
                    <select class="form-control" name="support" id="support">
                        <option value="null">Select feedback type</option>
                        <option value="">Feature request</option>
                        <option value="">Error/Bug report</option>
                        <option value="">Perfomance</option>
                        <option value="">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comments">Comments*</label>
                    <textarea class="form-control" rows="5" id="comments"></textarea>
                </div>
                <div class="form-group">
                    <label for="version">What version of bwajes+ are you using?*</label>
                    <select class="form-control" name="version" id="version">
                        <option value="null">Select version</option>
                        <option value="">Version 1.0.0</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="checkbox">
                    <label for="ISP">Please read Andadel's <a href="idea-submission-policy" target="_blank">Idea Submission Policy</a> before you send us your feedback</label>
                </div>
                <button name="feedback" class="btn btn-success form-control">Send feedback</button>
            </form>
        </div>
    </div>

<?php

    include('includes/footer.php');

?>