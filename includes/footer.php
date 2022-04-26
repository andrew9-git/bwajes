<?php

    $host='http://localhost:9090/bwajes/';
    
    $host1='http://localhost:9090/andadel/';  

?>
<footer>
        <div class="footer-fluid">
            <div class="container-fluid">
                <div class="newsletter">
                    <h4>Subscribe to our newsletter</h4>
                    <p>Signup for our newsletter to get the latest news, updates
                        and amazing offers delivered directly in your inbox
                    </p>
                    <form class="form-inline" action="">
                        <div class="form-group">
                            <input type="email" placeholder="Enter your email" class="form-control" id="email">
                        </div>
                        <button type="submit" id="subscribe" class="btn btn-danger">Subscribe</button>
                    </form>
                </div>
                <div class="social">
                    <a href="#"><i class="bx bxl-facebook-circle"></i></a>
                    <a href="#"><i class="bx bxl-instagram-alt"></i></a>
                    <a href="#"><i class="bx bxl-twitter"></i></a>
                    <a href="#"><i class="bx bxl-linkedin"></i></a>
                </div>
                <div class="legal">
                    <ul>
                        <li><a href="<?php echo $host .'feedback'; ?>" target="_bank">Report an issue</a></li>
                        <li><a href="<?php echo $host1 .'terms-of-service'; ?>" target="_bank">Terms of Service</a></li>
                        <li><a href="<?php echo $host1 .'privacy-policy'; ?>" target="_bank">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <hr>
            <i class="bx bx-copyright"></i> <?php echo date('Y'); ?> Andadel
        </div>
    </footer>
    <script src="<?php echo $host .'assets/js/script.js'; ?>"></script>
</body>
</html>