<?php

    include('includes/header.php');
    $title = "Login";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

    <div class="wrapper form">
        <div class="content form">
            <form action="">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="csrf" value="" id="csrf">
                </div>
                <div class="form-group">
                    <label for="username">Username*</label>
                    <input type="text" class="form-control" placeholder="Enter username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <a style="color: white;" href="forgot-password">Forgot password?</a>
                </div>
                <button name="login" class="btn btn-danger form-control">Login</button>
            </form>
        </div>
    </div>

<?php

    include('includes/footer.php');

?>