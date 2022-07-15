<?php

    include('includes/header.php');
    $title = "Sign in - bwajes+";
    $description = "Description with PHP";
    bwajes_plus_header($title, $description);

?>

<div class="wrapper form">
        <div class="content form">
            <form id="login_form">
                <div id="login_messages">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control form_data" name="csrf" value="<?php echo $_SESSION['csrf']; ?>" id="csrf">
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="text" name="email" value="<?php if(isset($_COOKIE['user_email'])){echo $_COOKIE['user_email'];} ?>" class="form-control form_data" placeholder="Enter email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="password" value="<?php if(isset($_COOKIE['user_password'])){echo $_COOKIE['user_password'];} ?>" class="form-control form_data" id="password">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember_me" class="form_data" <?php if(isset($_COOKIE['user_email'])){?> checked <?php } ?>>
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="form-group">
                    <a style="color: white;" href="forgot-password">Forgot password?</a>
                </div>
                <div class="form-group">
                    <a style="color: white;" href="register">Create an account instead?</a>
                </div>
                <button name="login" class="btn btn-danger form-control" id="login_button">Login</button>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        let form = document.getElementById('login_form');
        let login_button = document.getElementById('login_button');
        let login_messages = document.getElementById('login_messages');
        form.addEventListener('submit', login_user);

        function login_user(e)
        {
            e.preventDefault();
            login_button.disabled = true;

            let log_btn_bg_col = login_button.style.backgroundColor;
            let log_btn_border = login_button.style.border;

            if(login_button.disabled == true)
            {
                login_button.style.backgroundColor = 'grey';
                login_button.style.border = 'grey';
            }

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
                    login_button.disabled = false;

                    if(login_button.disabled == false)
                    {
                        login_button.style.backgroundColor = log_btn_bg_col;
                        login_button.style.border = log_btn_border;
                    }

                    let response = xhr.responseText;
                    const pattern = /Success!/;
                    let regex = pattern.test(response);
                    if(regex === false)
                    {
                        login_messages.innerHTML = response;
                    }
                    else
                    {
                        form.reset();
                        let url = 'http://localhost:9090/bwajesplus-app/dashboard';
                        window.location.href = url;
                    }
                    // console.log(typeof(response));
                    // let output = '<div class="card error">';
                    // output += '<ul>';
                    // for(const [key, value] of Object.entries(response))
                    // {
                    //     // console.log(`${key}: ${value}`);
                    //     if(key == 'success' && response[key] != '')
                    //     {
                    //         output = '<div class="card success">';
                    //         output += '<ul>';
                    //     }
                    //     output += '<li>' + value + '</li>';
                    // }
                    // output += '</ul>';
                    // output += '</div>';
                    // login_messages.innerHTML = output;
                  
                }
            }
            
            xhr.send(form_data_string);
        }

    });
    </script>
<?php

    include('includes/footer.php');

?>