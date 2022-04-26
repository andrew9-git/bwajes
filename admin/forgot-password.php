<?php

    include('includes/header.php');
    $title = "Forgot password?";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

    <div class="wrapper form">
        <div class="content form">
            <form action="">
                <!-- <div class="form-group">
                    <a href="login" style="float: right;" class="back btn btn-success">back</a>
                </div> -->
                <h1 style="color: bisque; text-align:center;">Reset your password</h1>
                <p style="color: bisque; text-align:center;">An e-mail will be sent to you with instructions on how to reset your password.</p>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="csrf" value="" id="csrf">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="text" class="form-control" placeholder="Enter email" id="email">
                </div>
                <button name="send-mail" class="btn btn-danger form-control">Send</button>
            </form>
        </div>
    </div>

<?php

    include('includes/footer.php');

?>