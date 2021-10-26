<?php
defined('SITE_LOADED') OR exit('Access denied');
?>
<body class="list-clients">   
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
                $image = !empty($client['picture']) ? $client['picture'] : 'default.JPG';
                echo '<tr>';       
                echo '<td>' . $client['city_name'] . '</td>' ;
                echo '<td>' . $client['name'] . '</td>' ;
                echo '<td>' . $client['code'] . '</td>' ;
                echo '<td><img id="user-image" src="assets/user-images/' . $image . '"></img></td>' ; 
                echo '<td><a href="/clients/' . $client['id'] . '/edit">edit</a>&nbsp<a id="delete-client" href="/clients/' . $client['id'] . '/delete">delete</a></td>' ;
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
    $('#delete-client').click(function() {
        if(confirm('Confirm delete client?')){
            return true;
        }
        return false;
    });        
});    
</script>