<?php

function dd( $value ) {
    echo "<pre>";
    var_dump( $value );
    echo "</pre>";
    die();
}

function gettodos($conn) {
    
    
    $q = "SELECT * FROM todos";
    $result = $conn->query($q);
    
    if ($result->num_rows < 0){
        die("no item in the database or error while getting the data");
    }

    $todos = $result->fetch_all();

    return $todos;
}

?>