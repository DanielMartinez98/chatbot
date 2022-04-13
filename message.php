<!-- Created By CampCodes -->
<?php
// connecting to database
$conn = mysqli_connect("localhost", "root", "", "chatprueba") or die("Database Error");

// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

//checking user query to database query
$check_data = "SELECT Palabra FROM palabraclave WHERE locate(Palabra,'%$getMesg%')";

$run_query = mysqli_query($conn, $check_data) or die("Error");


// if user query matched to database query we'll show the reply otherwise it go to else statement
if(mysqli_num_rows($run_query) > 0){
    //fetching replay from the database according to the user query
    $fetch_data = mysqli_fetch_assoc($run_query);
    //storing replay to a varible which we'll send to ajax
    #echo $fetch_data['Palabra'];
    $s = $fetch_data['Palabra'];
    $check_data2 = "SELECT String From respuesta, palabraclave WHERE locate(Palabra,'%$s%')>0 and respuesta.palabraClave = palabraclave.ID;";
    $run_query2 = mysqli_query($conn,$check_data2) or die("Error");
    $variable = "";
        if(mysqli_num_rows($run_query2) > 0)
        {
            for ($x = 0; $x <= mysqli_num_rows($run_query2)-1; $x++) {
                $p=  mysqli_fetch_row($run_query2);
                if ($x == 0)
                {
                    $variable = "buenas, creo haber entendido correctamente, buscas un perfume para usar en una $s, nuestra primera recomendacion es $p[$x]";
                }   
                else
                {
                    $variable .= ", otro muy bueno es el perfume $p[0]";
                }
                #echo "The number is: $x <br>";
              }
            $variable .= ". logre resolver tu duda?";
            echo $variable;
        }
        else{
            echo "Perdona, no te entiendo!";
        }

}else{
    
    if(strpos($getMesg, "si") !== false){
        echo "que gusto, cualquier otra recomendacion que necesites, escribe en el chat para que necesitarias tu perfume y con gusto te recomendamos un perfume";
    }
    else if(strpos($getMesg,"no") !== false)
    {
        echo "hay alguna otra forma como me puedas describir tu necesidad?";
    }
    else
    {
        echo "Perdona, no te entiendo!";
    }
    
}

?>