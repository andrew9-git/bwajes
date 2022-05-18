<?php

    include('includes/header.php');
    $title = "Sign up - bwajes+";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);
?>

    <div class="wrapper form">
        <div class="content form">
            <form id="register_form">
                <div id="registration_messages"></div>
                <div class="form-group">
                    <input type="hidden" class="form-control form_data" name="csrf" value="<?php echo $_SESSION['csrf']; ?>" id="csrf">
                </div>
                <div class="form-group">
                    <label for="firstname">First name*</label>
                    <input type="text" class="form-control form_data" placeholder="Enter firstname" name="firstname" id="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Last name*</label>
                    <input type="text" class="form-control form_data" placeholder="Enter lastname" name="lastname" id="lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control form_data" placeholder="Enter email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="businessname">Business name*</label>
                    <input type="text" class="form-control form_data" placeholder="Enter businessname" name="businessname" id="businessname">
                </div>
                <div class="form-group">
                    <label for="gender">Gender*</label>
                    <select class="form-control form_data" name="gender" id="gender">
                      <option value="S">Select gender</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                      <option value="N">Choose not to say</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="TOS" class="form_data" value="TOS">
                    <label for="TOS">I agree to Andadel's <a href="" target="_blank">Terms of Service</a></label>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="PRIP" class="form_data" value="PRIP">
                    <label for="PRIP">I understand that my information will be processed in line with Andadel's <a href="" target="_blank">Privacy Policy</a>. I may withdraw my consent through unsubscribe links at any time.</label>
                </div>
                <div class="form-group">
                    <a style="color: white;" href="login">Sign me in instead</a>
                </div>
                <button name="register" class="btn btn-success form-control" id="registration_button">Sign up</button>
            </form>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        let form = document.getElementById('register_form');
        let registration_button = document.getElementById('registration_button');
        form.addEventListener('submit', register_user);

        function register_user(e)
        {
            e.preventDefault();
            registration_button.disabled = true;
            let form_element = document.getElementsByClassName('form_data');
            let form_data = new FormData();

            for(let i = 0; i < form_element.length; i++)
            {
                if(form_element[i].type == "checkbox" && form_element[i].checked == true)
                {
                    form_data.append(form_element[i].name, form_element[i].value = 1);
                }
                else if(form_element[i].type == "checkbox" && form_element[i].checked == false)
                {
                    form_data.append(form_element[i].name, form_element[i].value = 0);
                }
                else{

                    form_data.append(form_element[i].name, form_element[i].value);
                }
                // console.log(form_element[i].value);
            }
            let form_data_string = new URLSearchParams(form_data).toString();

            let xhr = new XMLHttpRequest();
            
            xhr.open('POST', 'process-ajax');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function()
            {
                if(this.status == 200)
                {
                    registration_button.disabled = false;

                    let response = xhr.responseText;
                    // console.log(response);
                    document.getElementById('registration_messages').innerHTML = response;
                    form.reset();
                }
            }
            
            xhr.send(form_data_string);
        }

    });
</script>
<?php

    include('includes/footer.php');

?>