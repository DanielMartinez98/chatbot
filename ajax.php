<?php

/* Establishes a connection with database. First argument is the server name, second is the username for database, third is password (blank for me) and final is the database name 
*/
$conn = mysqli_connect("LocalHost","root","","chatprueba");

// If connection is established succesfully
if($conn)
{
     // Get users message from request object and escape characters
    $user_messages = mysqli_real_escape_string($conn, $_POST['messageValue']);

    // create SQL query for retrieving corresponding reply
    $query = "SELECT * FROM chatbot WHERE messages LIKE '%$user_messages%'";

     // Execute query on connected database using the SQL query
     $makeQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($makeQuery) > 0) 
    {

        // Get result
        $result = mysqli_fetch_assoc($makeQuery);

        // Echo only the response column
        echo $result['response'];
    }else{

        // Otherwise, echo this message
        echo "Sorry, I can't understand you.";
    }
}else {

    // If connection fails to establish, echo an error message
    echo "Connection failed" . mysqli_connect_errno();
}
?>