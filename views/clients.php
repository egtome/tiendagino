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
.list-clients h2 {
    margin: 0 0 15px;
    text-align: center;
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
#add-client {
    color:#F00;
    text-align: center;
    margin: 0 0 10px;
}
#logout-client {
    text-align: right;
}
#user-image {
    max-width: 50px;
    max-height: 50px;
}
#user-pagination {
    text-align: center;
}
</style>
</head>
<body class="list-clients">
    <div id="logout-client">
        <button id="logoutButton" type="button" class="btn btn-link">Logout</button>
    </div>    
    <h2 class="list-clients">List Clients</h2>
    <div id="add-client">
        <button id="addClientButton" type="button" class="btn btn-primary">+ Add client</button>
    </div>
    
    <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">City</th>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Picture</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php     
            $r = 1;
            foreach ($this->data['clients'] as $client) {
                $image = !empty($client['picture']) ? $client['picture'] : 'default.jpg';
                echo '<tr>';       
                echo '<td>' . $client['city_name'] . '</td>' ;
                echo '<td>' . $client['name'] . '</td>' ;
                echo '<td>' . $client['code'] . '</td>' ;
                echo '<td><img id="user-image" src="assets/user-images/' . $image . '"></img></td>' ; 
                echo '<td><a href="/clients/' . $client['id'] . '/edit">edit</a></td>' ;
                echo '</tr>';    
                $r++;   
            }
        ?>
    </tbody>
    </table>
    <div id="user-pagination">
    <?php  
    
        if ($this->data['page'] > 1) {
            $previousPage = $this->data['page'] - 1;
            echo '<a href="/clients?page=' . $previousPage . '">previous</a>&nbsp'; 
        } else {
            echo '<a>previous</a>&nbsp'; 
        }
        echo ' <b>page ' . $this->data['page'] . '</b>';
        if ($this->data['page'] < $this->data['pages']) {
            $nextPage = $this->data['page'] + 1;
            echo ' &nbsp<a href="/clients?page=' . $nextPage . '">next</a>'; 
        }  else {
            echo '&nbsp<a>next</a>'; 
        }      
    ?>        
    </div>
</body>
</html>
<script>
$( document ).ready(function() {
    $('#addClientButton').click(function() {
        window.location.href = '/clients/create';
    });
    $('#logoutButton').click(function() {
        window.location.href = '/logout';
    });    
});    
</script>