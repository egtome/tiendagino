<?php
defined('SITE_LOADED') OR exit('Access denied');
?>
<script src="/assets/js/loadCityAjax.js"></script>
<body>
<div class="login-form">
    <form action="/clients/add" method="post" enctype="multipart/form-data">
        <h2 class="text-center">Create Client</h2>   
        <?php
            if ($this->error) {
                echo '<h3>'. $this->error .'</h3>';
            }
        ?>
        <div class="form-group">
            <input id="default_city" type="hidden" name="default_city" id="default_city" value="0" />
            <select id="city_list_ajax" name="city_id" placeholder="Client City" required="required" class="form-control"></select>
        </div>
        <div class="form-group">
            <input name="name" type="text" class="form-control" placeholder="Client Name" required="required">
        </div>
        <div class="form-group">
            <input name="code" type="text" class="form-control" placeholder="Client Code" required="required">
        </div>
        <div class="form-group">
            <input name="client-image" id="client-image" type="file" class="form-control" placeholder="Client Image" accept="image/png, image/jpeg">
        </div>                    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Create Client</button>
        </div>
    </form>
</div>
</body>
</html>