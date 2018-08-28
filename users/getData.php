<?php 

// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.

$string = file_get_contents("sampleData1.json");
echo $string;

// Instead you can query your database and parse into JSON etc etc

?>





<?php 
/*
// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.

// $string = file_get_contents("sampleData.json");
// echo $string;
// Instead you can query your database and parse into JSON etc etc


//variable for database connection

require "../connections.php";

//open connection to mysql db
$connection = mysqli_connect("$host","$dbusername","$password","$database") or die("Error " . mysqli_error($connection));


// display the current totals in a table:
$query = "SELECT username, sum(winner) AS 'Total' FROM picksview\n"
. "group by username\n"
. "order by sum(winner) desc LIMIT 0, 35 ";
$result = mysqli_query($connection,$query) or die("Error in Selecting " . mysqli_error($connection));

//create an array
//$score_array = array();

while($row =mysqli_fetch_assoc($result))
    {
   if(!isset($google_JSON)){    
     $google_JSON = '{"cols": [';    
     $column = array_keys($row);
     foreach($column as $key=>$value){
         $google_JSON_cols[]='{"id": "'.$key.'", "label": "'.$value.'"}';
     }    
     $google_JSON .= implode(',',$google_JSON_cols).'],"rows": [';       
   }
   $google_JSON_rows[] = '{"c":[{"v": "'.$row['username'].'"},  {"v": "'.$row['Total'].'"}]}';
};



//        $scrore_array[] = $row;
    
//Convert array to json
echo $google_JSON.implode(",",$google_JSON_rows)."]}";

// echo json_encode($score_array);

*/
?>