<?php

    include('includes/header.php');
    $title = "Reset password";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

    <div class="wrapper form">
        <div class="content form">
            <?php

                if(isset($_GET['selector']) && isset($_GET['token']))
                {
                    $selector = $_GET['selector'];
                    $token = $_GET['token'];

                    $errors = array();

                    if(empty($selector) || empty($token))
                    {
                        redirect_to('forgot-password');
                    }
                    else
                    {
                        if(ctype_xdigit($selector) === false && ctype_xdigit($token) === false)
                        {
                            redirect_to('forgot-password');
                        }
                    }

                    
                }
                else
                {
                    redirect_to('forgot-password');
                }

            ?>
            <form id="reset_password_form">
                <div id="reset_password_messages">
                </div>
                <br>
                <div class="form-group">
                    <input type="hidden" value="<?php echo $selector; ?>" class="form-control form_data" name="selector" id="selector">
                </div>
                <div class="form-group">
                    <input type="hidden" value="<?php echo $token; ?>" class="form-control form_data" name="validator" id="validator">
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="password" class="form-control form_data" placeholder="Enter password" id="password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm password*</label>
                    <input type="password" name="confirm-password" class="form-control form_data" placeholder="Enter confirm password" id="confirm-password">
                </div>
                <button name="reset-password" id="reset_password" class="btn btn-danger form-control">Reset password</button>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        let form = document.getElementById('reset_password_form');
        let reset_password_button = document.getElementById('reset_password');
        let reset_password_messages = document.getElementById('reset_password_messages');
        form.addEventListener('submit', reset_password);

        function reset_password(e)
        {
            e.preventDefault();
            reset_password_button.disabled = true;

            let rst_pass_btn_bg_col = reset_password_button.style.backgroundColor;
            let rst_pass_btn_border = reset_password_button.style.border;
            let rst_pass_btn_cursor = reset_password_button.style.cursor;

            if(reset_password_button.disabled == true)
            {
                reset_password_button.style.backgroundColor = 'grey';
                reset_password_button.style.border = 'grey';
                reset_password_button.style.cursor = 'not-allowed';
            }

            let form_element = document.getElementsByClassName('form_data');
            let form_data = new FormData();

            for(let i = 0; i < form_element.length; i++)
            {
                form_data.append(form_element[i].name, form_element[i].value);
            }
            let form_data_string = new URLSearchParams(form_data).toString();

            let xhr = new XMLHttpRequest();
            
            xhr.open('POST', 'http://localhost:9090/bwajes/process-ajax');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function()
            {
                if(this.status == 200)
                {
                    reset_password_button.disabled = false;

                    if(reset_password_button.disabled == false)
                    {
                        reset_password_button.style.backgroundColor = rst_pass_btn_bg_col;
                        reset_password_button.style.border = rst_pass_btn_border;
                        reset_password_button.style.cursor = rst_pass_btn_cursor;
                    }

                    let response = xhr.responseText;
                    const pattern = /Success!/;
                    let regex = pattern.test(response);
                    if(regex === true)
                    {
                        form.reset();
                        // let url = 'http://localhost:9090/bwajes/login';
                        let url = '/bwajes/login';
                        window.location.href = url;
                    }
                    reset_password_messages.innerHTML = response;
                  
                }
            }
            
            xhr.send(form_data_string);
        }

    });
    </script>
<?php

    include('includes/footer.php');

?>