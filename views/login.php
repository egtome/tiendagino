<?php
defined('SITE_LOADED') OR exit('Access denied');
?>
<body>
<div class="login-form">
    <form action="/login/check" method="post">
        <h2 class="text-center">login</h2>   
        <?php
            if ($this->error) {
                echo '<h3>'. $this->error .'</h3>';
            }
        ?>
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
    </form>
</div>
</body>
</html>
<script>
    $( document ).ready(function() {
        $("#logout-client").css("display", "none");
    });    
</script>