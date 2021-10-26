<?php
defined('SITE_LOADED') OR exit('Access denied');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.login-form h3 {
    margin: 0 0 10px;
    font-size: 13px;
    color: #F00;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
#display-image {
    text-align: center;
    margin-bottom: 5px;
}
#user-image {
    max-width: 50px;
    max-height: 50px;
}
</style>
<script>
    $( document ).ready(function() {
        $('#delete-image').click(function() {
            if (confirm('Delete image?')) {
                $("#delete_image_input").val('yes');
                $("#display-image").css("display", "none");
            } 
        });
    });    
</script>
</head>
<body>
<div class="login-form">
    <form action="/clients/update" method="post" enctype="multipart/form-data">
        <h2 class="text-center">Edit Client</h2>   
        <?php
            if ($this->error) {
                echo '<h3>'. $this->error .'</h3>';
            }
        ?>
        <div class="form-group">
            <select name="city_id" placeholder="Client City" required="required" class="form-control">
            <option value="">Select city...</option>
            <?php     
                foreach ($this->data['cities'] as $cities) { 
                    $selected = $cities['id'] == $this->data['client']['city_id'] ? 'selected' : '';
                    echo '<option value="' . $cities['id'] . '" ' . $selected . '>' . $cities['name'] . '</option>' ;  
                }
            ?>                
            </select>
        </div>
        <div class="form-group">
            <input value="<?php echo $this->data['client']['name'] ?>" name="name" type="text" class="form-control" placeholder="Client Name" required="required" />
        </div>
        <div class="form-group">
            <input value="<?php echo $this->data['client']['code'] ?>" name="code" type="text" class="form-control" placeholder="Client Code" required="required" />
        </div>
        <div class="form-group">
            <?php
                $imageUrl = $this->data['client']['picture'] ? $this->data['client']['picture'] : 'default.jpg';
                if ($this->data['client']['picture']) {
                    echo '<input type="hidden" name="delete_image_input" id="delete_image_input" value="no" />';
                    echo '<div id="display-image"><img id="user-image" src="/assets/user-images/' . $imageUrl . '"></img>&nbsp<a href="#" id="delete-image">delete</a></div>' ;
                }
            ?>            
            <input value="<?php echo $this->data['client']['picture'] ?>" name="client-image" id="client-image" type="file" class="form-control" placeholder="Client Image" accept="image/png, image/jpeg" />
        </div>                    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </div>
        <?php echo '<input type="hidden" name="client_id" value="'. $this->data['client']['id'] .'" />'; ?>
        <?php echo '<input type="hidden" name="client_image_name" value="'. $this->data['client']['picture'] .'" />'; ?>
    </form>
</div>
</body>
</html>
