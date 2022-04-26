<?php

    include('includes/header.php');
    $title = "Reset password";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

    <div class="wrapper form">
        <div class="content form">
            <form action="">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="csrf" value="" id="csrf">
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="selector" id="selector">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="validator" id="validator">
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" placeholder="Enter password" id="password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm password*</label>
                    <input type="password" class="form-control" placeholder="Enter confirm password" id="confirm-password">
                </div>
                <button name="reset-password" class="btn btn-danger form-control">Reset password</button>
            </form>
        </div>
    </div>

<?php

    include('includes/footer.php');

?>