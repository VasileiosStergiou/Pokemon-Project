<?php
function getGenerations() {
    $columns = [];
    if (($handle = fopen("generations.csv", "r")) !== FALSE) {
        $headers = fgetcsv($handle);
        while(($data = fgetcsv($handle)) !== FALSE){
            $columns[] = array_combine($headers, $data);
        }
        fclose($handle);
        foreach ($columns as $row) {
            echo "<option value='".$row['id']."'>".$row['identifier']."</option>"; // Example column names
        }
    }
}

getGenerations();

?>