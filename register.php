<?php

    include('includes/header.php');
    $title = "Sign up - bwajes+";
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
                    <label for="firstname">First name*</label>
                    <input type="text" class="form-control" placeholder="Enter firstname" id="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Last name*</label>
                    <input type="text" class="form-control" placeholder="Enter lastname" id="lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="email">
                </div>
                <div class="form-group">
                    <label for="businessname">Business name*</label>
                    <input type="text" class="form-control" placeholder="Enter businessname" id="businessname">
                </div>
                <!-- <div class="form-group">
                    <span class="title">Gender:</span>
                    <input type="radio" name="gender" id="male"
                    value="M">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female"
                    value="F">
                    <label for="female">Female</label>
                </div> -->
                <div class="form-group">
                    <label for="gender">Gender*</label>
                    <select class="form-control" name="gender" id="gender">
                      <option value="null">Select gender</option>
                      <option value="">Male</option>
                      <option value="">Female</option>
                      <option value="">Choose not to say</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="checkbox">
                    <label for="TOS">I agree to Andadel's <a href="" target="_blank">Terms of Service</a></label>
                </div>
                <div class="form-group">
                    <input type="checkbox">
                    <label for="TOS">I understand that my information will be processed in line with Andadel's <a href="" target="_blank">Privacy Policy</a>. I may withdraw my consent through unsubscribe links at any time.</label>
                </div>
                <div class="form-group">
                    <a style="color: white;" href="login">Sign me in instead</a>
                </div>
                <button name="register" class="btn btn-success form-control">Sign up</button>
            </form>
        </div>
    </div>

<?php

    include('includes/footer.php');

?>