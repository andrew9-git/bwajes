<?php
include_once('functions.php');


function email_template_1($message='', $website=1, $id=1)
{  
    $host = url()[0];
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
body {
	Margin: 0!important;
	padding: 15px;
	background-color: #FFF;
}
.wrapper {
	width: 100%;
	table-layout: fixed;
}
.wrapper-inner {
	width: 100%;
	background-color: #eee;
	max-width: 670px;
	Margin: 0 auto;
}
table {
	border-spacing: 0;
	font-family: sans-serif;
	color: #727f80;
}
.outer-table {
	width: 100%;
	max-width: 670px;
	margin: 0 auto;
	background-color: #FFF;
}
td {
    padding: 0;
}
.header {
    background-color: #C2C1C1;
    border-bottom: 3px solid #81B9C3;
}
p {
    Margin:0;
}
.header p {
    text-align: center;
    padding: 1%;
    font-weight: 500;
    font-size: 11px;
    text-transform: uppercase;
}
a {
    color: #F1F1F1;
    text-decoration: none;
}
/*--- End Outer Table 1 --*/
.main-table-first {
	width: 100%;
	max-width: 610px;
	Margin: 0 auto;
	background-color: #FFF;
	border-radius: 6px;
	margin-top: 25px;
}
/*--- Start Two Column Sections --*/
.two-column {
    text-align: center;
    font-size: 0;
    padding: 5px 0 10px 0;
}
.two-column .section {
    width: 100%;
    max-width: 300px;
    display: inline-block;
    vertical-align: top;
}
.two-column .content {
    font-size: 16px;
    line-height: 20px;
    text-align: justify;
}
.content {
    width: 100%;
    padding-top: 20px;
}
.center {
    display: table;
    Margin: 0 auto;
}
img {
    border: 0;
}
img.logo {
    float: left;
    Margin-left: 5%;
    max-width: 200px!important;
}
#callout {
    float: right;
    Margin: 4% 5% 2% 0;
    height: auto;
    overflow: hidden;
}
#callout img {
    max-width: 20px;
}
.social {
    list-style-type: none;
    Margin-top: 1%;
    padding: 0;
}
.social li {
    display: inline-block;
}
.social li img {
    max-width: 15px;
    Margin-bottom: 0;
    padding-bottom: 0;
}
/*--- Start Outer Table Banner Image, Text & Button --*/
.image img {
    width: 100%;
    max-width: 670px;
    height: auto;
}
.main-table {
    width: 100%;
    max-width: 610px;
    margin: 0 auto;
    background-color: #FFF;
    border-radius: 6px;
}
.one-column .inner-td {
    font-size: 16px;
    line-height: 20px;
    text-align: justify;
}
.mail-content
{
    margin: 20px
}
.inner-td {
    padding: 10px;
}
.h2 {
    text-align: center;
    font-size: 23px;
    font-weight: 600;
    line-height: 45px;
    Margin: 12px;
    color: #4A4A4A;
}
p.center {
    text-align: center;
    max-width: 580px;
    line-height: 24px;
}
.btn {
    font-size: 15px;
    font-weight: 600;
    background: #81BAC6;
    color: #FFF;
    text-decoration: none;
    padding: 9px 16px;
    border-radius: 28px;
}
/*--- Start Two Column Image & Text Sections --*/
.two-column img {
    width: 100%;
    max-width: 280px;
    height: auto;
}
.two-column .text {
    padding: 10px 0;
}
/*--- Start Two Column Article Section --*/
.outer-table-3 {
    width: 100%;
    max-width: 670px;
    margin: 22px auto;
    background-color: #C2C1C1;
    border-top: 3px solid #81B9C3;
}
.h3 {
	text-align: center;
	font-size: 21px;
	font-weight: 600;
	Margin-bottom: 8px;
	color: #4A4A4A;
}
/*--- Start Bottom One Column Section --*/
.h1 {
    text-align: center!important;
    font-size: 25px!important;
    font-weight: 600;
    line-height: 45px;
    Margin: 12px 0 20px 0;
    color: #4A4A4A;
}
/*--- Start Footer Section --*/
.footer {
	width: 100%;
	background-color: #C2C1C1;
	Margin: 0 auto;
    color: #FFF;
}
.footer  img {
	max-width: 135px;
	Margin: 0 auto;
	display: block;
	padding: 4% 0 1% 0;
}
p.footer {
	text-align: center;
	color: #FFF!important;
	line-height: 30px;
	padding-bottom: 4%;
    text-transform: uppercase;
}
/*--- Media Queries --*/
@media screen and (max-width: 400px) {
	.h1 {
		font-size: 22px;
	}
	.two-column .column {
		max-width: 100%!important;
	}
	.two-column img {
		width: 100%!important;
	}
}
@media screen and (min-width: 401px) and (max-width: 400px) {

	.two-column .column {
		max-width: 50%!important;
	}
}
@media screen and (max-width:768px) {
    img.logo {
        float:none !important;
        margin-left:0% !important;
        max-width: 200px!important;
    }

    #callout {
        float:none !important;
        margin: 0% 0% 0% 0;
        height: auto;
        text-align:center;
        overflow: hidden;
    }
    #callout img {
        max-width:26px !important; 
    }
    .two-column .section {
        width: 100% !important;
        max-width: 100% !important;
        display: inline-block;
        vertical-align: top;
    }

    .two-column img {
        width: 100% !important;
        height: auto !important;
    }
    img.img-responsive {
        width:100% !important;
        height:auto !important;
        max-width:100% !important;
    }
    .content {
        width: 100%;
        padding-top:0px !important;
    }
}
</style>
 </head>
<body>
    <div class="wrapper">
    	<div class="wrapper-inner">
    		<table class="outer-table">
    			<tr>
    				<td class="header">
                        <?php
                        if($website != 0)
                        {
                            echo '<p><a href="https://bwajes-plus.andadel.com/email/'. $id . '" target="_blank">Click to view this email in your browser</a></p>';
                        }
                        ?>
    				</td>
    			</tr> <!--- End Header -->
            </table> <!--- End Outer Table -->
            <table class="main-table-first">
                <tr>
                    <td class="two-column">
                        <div class="section">
                            <table width="100%">
                                <tr>
                                    <td class="inner-td">
                                        <table class="content">
                                            <tr>
                                                <td align="center">
                                                    <a href="#" target="_blank"><img src="<?php echo $host . 'images/bwajes_mail_1.png' ?>" class="logo"></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div> <!--- End First Column of Two Columns -->
                        <div class="section">
                            <table width="100%">
                                <tr>
                                    <td class="inner-td">
                                        <table class="content">
                                            <tr>
                                                <td>
                                                    <div id="callout">
                                                        <ul class="social">
                                                            <li><a href="#" target="_blank"><img src="<?php echo $host . 'images/facebook.png' ?>"></a></li>
                                                            <li><a href="#" target="_blank"><img src="<?php echo $host . 'images/twitter.png' ?>"></a></li>
                                                            <li><a href="#" target="_blank"><img src="<?php echo $host . 'images/instagram.png' ?>"></a></li>
                                                            <li><a href="#" target="_blank"><img src="<?php echo $host . 'images/in.PNG' ?>"></a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div> <!--- End Second Column of Two Columns -->
                    </td>
                </tr> <!--- End Two Column Section -->
                </table> <!--- End Main Table -->
            <table class="outer-table">
    			<tr>
    				<td class="image">
    					<a href="#" target="_blank"><img src="<?php echo $host . 'images/bwajes_mail.png' ?>"></a>
    				</td>
    			</tr> <!--- End Banner -->
            </table> <!--- End Outer Table -->
            <table class="main-table">
    			<tr>
    				<td class="one-column">
                        <div class="mail-content">
                            <?php echo $message; ?>
                        </div>
    				</td>
            </table>
            <table class="outer-table-3">
    			<tr>
    				<td class="one-column">
    					<table width="100%">
    						<tr>
    							<td class="footer">
    								<a href="#" target="_blank"><img src="<?php echo $host . 'images/andLogo.png' ?>" style="width: 58px;"></a>
    								<p class="footer">1000 Street Road My City, My State 19000<br>&copy; andadel, <?php echo date('Y') ?>.<br><a href="#" target="_blank">Unsubscribe</a></p>
    							</td>
    						</tr>
    					</table>
    				</td>
    			</tr>
    		</table> <!--- End Main Table -->
    	</div> <!--- End Wrapper Inner -->
    </div> <!--- End Wrapper -->
    <br>
</body>
</html>

<!-- <div style="width: 100%;text-align: center;line-height: 40px;font-size: 25px;">
	<a href="#" target="_blank" style="color: #404577;text-decoration: none;">www.ResponsiveHTMLEmail.com</a>
</div> -->

<?php 
}
//   email_template_1('Hello World!');
?>

<?php 
function email_template($message='', $website=1, $id=1)
{  
    $host = url()[0];

    $output = '';

    $output.= '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
    body {
        Margin: 0!important;
        padding: 15px;
        background-color: #FFF;
    }
    .wrapper {
        width: 100%;
        table-layout: fixed;
    }
    .wrapper-inner {
        width: 100%;
        background-color: #eee;
        max-width: 670px;
        Margin: 0 auto;
    }
    table {
        border-spacing: 0;
        font-family: sans-serif;
        color: #727f80;
    }
    .outer-table {
        width: 100%;
        max-width: 670px;
        margin: 0 auto;
        background-color: #FFF;
    }
    td {
        padding: 0;
    }
    .header {
        background-color: #C2C1C1;
        border-bottom: 3px solid #81B9C3;
    }
    p {
        Margin:0;
    }
    .header p {
        text-align: center;
        padding: 1%;
        font-weight: 500;
        font-size: 11px;
        text-transform: uppercase;
    }
    a {
        color: #F1F1F1;
        text-decoration: none;
    }
    /*--- End Outer Table 1 --*/
    .main-table-first {
        width: 100%;
        max-width: 610px;
        Margin: 0 auto;
        background-color: #FFF;
        border-radius: 6px;
        margin-top: 25px;
    }
    /*--- Start Two Column Sections --*/
    .two-column {
        text-align: center;
        font-size: 0;
        padding: 5px 0 10px 0;
    }
    .two-column .section {
        width: 100%;
        max-width: 300px;
        display: inline-block;
        vertical-align: top;
    }
    .two-column .content {
        font-size: 16px;
        line-height: 20px;
        text-align: justify;
    }
    .content {
        width: 100%;
        padding-top: 20px;
    }
    .center {
        display: table;
        Margin: 0 auto;
    }
    img {
        border: 0;
    }
    img.logo {
        float: left;
        Margin-left: 5%;
        max-width: 200px!important;
    }
    #callout {
        float: right;
        Margin: 4% 5% 2% 0;
        height: auto;
        overflow: hidden;
    }
    #callout img {
        max-width: 20px;
    }
    .social {
        list-style-type: none;
        Margin-top: 1%;
        padding: 0;
    }
    .social li {
        display: inline-block;
    }
    .social li img {
        max-width: 15px;
        Margin-bottom: 0;
        padding-bottom: 0;
    }
    /*--- Start Outer Table Banner Image, Text & Button --*/
    .image img {
        width: 100%;
        max-width: 670px;
        height: auto;
    }
    .main-table {
        width: 100%;
        max-width: 610px;
        margin: 0 auto;
        background-color: #FFF;
        border-radius: 6px;
    }
    .one-column .inner-td {
        font-size: 16px;
        line-height: 20px;
        text-align: justify;
    }
    .mail-content
    {
        margin: 20px
    }
    .inner-td {
        padding: 10px;
    }
    .h2 {
        text-align: center;
        font-size: 23px;
        font-weight: 600;
        line-height: 45px;
        Margin: 12px;
        color: #4A4A4A;
    }
    p.center {
        text-align: center;
        max-width: 580px;
        line-height: 24px;
    }
    .btn {
        font-size: 15px;
        font-weight: 600;
        background: #81BAC6;
        color: #FFF;
        text-decoration: none;
        padding: 9px 16px;
        border-radius: 28px;
    }
    /*--- Start Two Column Image & Text Sections --*/
    .two-column img {
        width: 100%;
        max-width: 280px;
        height: auto;
    }
    .two-column .text {
        padding: 10px 0;
    }
    /*--- Start Two Column Article Section --*/
    .outer-table-3 {
        width: 100%;
        max-width: 670px;
        margin: 22px auto;
        background-color: #C2C1C1;
        border-top: 3px solid #81B9C3;
    }
    .h3 {
        text-align: center;
        font-size: 21px;
        font-weight: 600;
        Margin-bottom: 8px;
        color: #4A4A4A;
    }
    /*--- Start Bottom One Column Section --*/
    .h1 {
        text-align: center!important;
        font-size: 25px!important;
        font-weight: 600;
        line-height: 45px;
        Margin: 12px 0 20px 0;
        color: #4A4A4A;
    }
    /*--- Start Footer Section --*/
    .footer {
        width: 100%;
        background-color: #C2C1C1;
        Margin: 0 auto;
        color: #FFF;
    }
    .footer  img {
        max-width: 135px;
        Margin: 0 auto;
        display: block;
        padding: 4% 0 1% 0;
    }
    p.footer {
        text-align: center;
        color: #FFF!important;
        line-height: 30px;
        padding-bottom: 4%;
        text-transform: uppercase;
    }
    /*--- Media Queries --*/
    @media screen and (max-width: 400px) {
        .h1 {
            font-size: 22px;
        }
        .two-column .column {
            max-width: 100%!important;
        }
        .two-column img {
            width: 100%!important;
        }
    }
    @media screen and (min-width: 401px) and (max-width: 400px) {
    
        .two-column .column {
            max-width: 50%!important;
        }
    }
    @media screen and (max-width:768px) {
        img.logo {
            float:none !important;
            margin-left:0% !important;
            max-width: 200px!important;
        }
    
        #callout {
            float:none !important;
            margin: 0% 0% 0% 0;
            height: auto;
            text-align:center;
            overflow: hidden;
        }
        #callout img {
            max-width:26px !important; 
        }
        .two-column .section {
            width: 100% !important;
            max-width: 100% !important;
            display: inline-block;
            vertical-align: top;
        }
    
        .two-column img {
            width: 100% !important;
            height: auto !important;
        }
        img.img-responsive {
            width:100% !important;
            height:auto !important;
            max-width:100% !important;
        }
        .content {
            width: 100%;
            padding-top:0px !important;
        }
    }
    </style>
     </head>
    <body>
        <div class="wrapper">
            <div class="wrapper-inner">
                <table class="outer-table">
                    <tr>
                        <td class="header">';

                        if($website != 0)
                        {
                            $output.= '<p><a href="https://bwajes-plus.andadel.com/email/'. $id . '" target="_blank">Click to view this email in your browser</a></p>';
                        }
    $output.= '</td>
        </tr> <!--- End Header -->
    </table> <!--- End Outer Table -->
    <table class="main-table-first">
        <tr>
            <td class="two-column">
                <div class="section">
                    <table width="100%">
                        <tr>
                            <td class="inner-td">
                                <table class="content">
                                    <tr>
                                        <td align="center">
                                            <a href="#" target="_blank"><img src="' . $host . 'images/bwajes_mail_1.png " class="logo"></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div> <!--- End First Column of Two Columns -->
                <div class="section">
                    <table width="100%">
                        <tr>
                            <td class="inner-td">
                                <table class="content">
                                    <tr>
                                        <td>
                                            <div id="callout">
                                                <ul class="social">
                                                    <li><a href="#" target="_blank"><img src="' . $host . 'images/facebook.png"></a></li>
                                                    <li><a href="#" target="_blank"><img src="' . $host . 'images/twitter.png"></a></li>
                                                    <li><a href="#" target="_blank"><img src="' . $host . 'images/instagram.png"></a></li>
                                                    <li><a href="#" target="_blank"><img src="' . $host . 'images/in.PNG"></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div> <!--- End Second Column of Two Columns -->
            </td>
        </tr> <!--- End Two Column Section -->
        </table> <!--- End Main Table -->
    <table class="outer-table">
        <tr>
            <td class="image">
                <a href="#" target="_blank"><img src="' . $host . 'images/bwajes_mail.png"></a>
            </td>
        </tr> <!--- End Banner -->
    </table> <!--- End Outer Table -->
    <table class="main-table">
        <tr>
            <td class="one-column">
                <div class="mail-content">
                    ' . $message . '
                </div>
            </td>
    </table>
    <table class="outer-table-3">
        <tr>
            <td class="one-column">
                <table width="100%">
                    <tr>
                        <td class="footer">
                            <a href="#" target="_blank"><img src="' . $host . 'images/andLogo.png" style="width: 58px;"></a>
                            <p class="footer">1000 Street Road My City, My State 19000<br>&copy; andadel, ' . date('Y') . '<br><a href="#" target="_blank">Unsubscribe</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> <!--- End Main Table -->
    </div> <!--- End Wrapper Inner -->
    </div> <!--- End Wrapper -->
    <br>
    </body>
    </html>

    <!-- <div style="width: 100%;text-align: center;line-height: 40px;font-size: 25px;">
    <a href="#" target="_blank" style="color: #404577;text-decoration: none;">www.ResponsiveHTMLEmail.com</a>
    </div> -->';
    return $output;
}

// echo email_template('Hello world!')
?>
