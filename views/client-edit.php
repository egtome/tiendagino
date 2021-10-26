<?php
defined('SITE_LOADED') OR exit('Access denied');
?>
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
                $imageUrl = $this->data['client']['picture'] ? $this->data['client']['picture'] : 'default.JPG';
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
