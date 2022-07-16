<?php

    include('includes/header.php');
    $title = "Forgot password? - bwajes+";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

<div class="wrapper form">
        <div class="content form">
            <form id="forgot_password_form">
                <div id="forgot_password_messages">
                </div>
                <!-- <div class="form-group">
                    <a href="login" style="float: right;" class="back btn btn-success">back</a>
                </div> -->
                <h1 style="color: bisque; text-align:center;">Reset your password</h1>
                <p style="color: bisque; text-align:center;">An e-mail will be sent to you with instructions on how to reset your password.</p>
                <br>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="text" class="form-control form_data" name="forgot_password_email" placeholder="Enter email" id="email">
                </div>
                <button name="send-mail" id="forgot_password_button" class="btn btn-danger form-control">Send</button>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        let form = document.getElementById('forgot_password_form');
        let forgot_password_button = document.getElementById('forgot_password_button');
        let forgot_password_messages = document.getElementById('forgot_password_messages');
        form.addEventListener('submit', forgot_password);

        function forgot_password(e)
        {
            e.preventDefault();
            forgot_password_button.disabled = true;

            let for_pass_btn_bg_col = forgot_password_button.style.backgroundColor;
            let for_pass_btn_border = forgot_password_button.style.border;
            let for_pass_btn_cursor = forgot_password_button.style.cursor;

            if(forgot_password_button.disabled == true)
            {
                forgot_password_button.style.backgroundColor = 'grey';
                forgot_password_button.style.border = 'grey';
                forgot_password_button.style.cursor = 'not-allowed';
            }

            let form_element = document.getElementsByClassName('form_data');
            let form_data = new FormData();

            for(let i = 0; i < form_element.length; i++)
            {
                form_data.append(form_element[i].name, form_element[i].value);
            }
            let form_data_string = new URLSearchParams(form_data).toString();

            let xhr = new XMLHttpRequest();
            
            xhr.open('POST', 'process-ajax');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function()
            {
                if(this.status == 200)
                {
                    forgot_password_button.disabled = false;

                    if(forgot_password_button.disabled == false)
                    {
                        forgot_password_button.style.backgroundColor = for_pass_btn_bg_col;
                        forgot_password_button.style.border = for_pass_btn_border;
                        forgot_password_button.style.cursor = for_pass_btn_cursor;
                    }

                    let response = xhr.responseText;
                    const pattern = /request/;
                    let regex = pattern.test(response);
                    if(regex === true)
                    {
                        form.reset(); 
                    }
                    forgot_password_messages.innerHTML = response;
                  
                }
            }
            
            xhr.send(form_data_string);
        }

    });
    </script>
<?php

    include('includes/footer.php');

?>