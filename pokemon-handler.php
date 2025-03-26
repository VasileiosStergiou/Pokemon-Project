<?php
    function getColumns() {
        if (($handle = fopen("actual_pokemon_data.csv", "r")) !== FALSE) {
            if(($data = fgetcsv($handle)) !== FALSE){
                $num = count($data);
                echo "<tr>";
                foreach ($data as $row) {
                    echo "<th>".trim($row)."</th>";
                }
                echo "</tr>";
            }
        }
    }

    function getPokemonData() {
        $pokemon_data = [];
        if (($handle = fopen("actual_pokemon_data.csv", "r")) !== FALSE) {
            $headers = fgetcsv($handle);
            while(($data = fgetcsv($handle)) !== FALSE){
                $pokemon_data[] = array_combine($headers, $data);
            }
            fclose($handle);
        }
        return $pokemon_data;
    }
    
    function getGenerations() {
        $columns = [];
        if (($handle = fopen("generations.csv", "r")) !== FALSE) {
            $headers = fgetcsv($handle);
            while(($data = fgetcsv($handle)) !== FALSE){
                $columns[] = array_combine($headers, $data);
            }
            fclose($handle);
            foreach ($columns as $row) {
                echo sprintf("<option value='%s'>%s</option>",$row['id'],$row['identifier']); // Example column names
            }
        }
    }

    function getPokemonByID($id,$pokemon_data) {
        foreach ($pokemon_data as $row) {
            if ($row['pkdx no'] == $id){
                return [$row];
            }
        }
        return [];
    }
    
    function getPokemonByName($pokemon_name,$pokemon_data) {
        $target_pokemons =[];
        foreach ($pokemon_data as $row) {
            if (str_contains(strtolower($row['name']), strtolower($pokemon_name))){
                $target_pokemons[] = $row;
            }
            #if (str_contains(strtoupper($row['name']), strtoupper($pokemon_name))){
            #    $target_pokemons[] = $row;
            #}
        }
        return $target_pokemons;
    }

    function getPokemonByGeneration($gen,$pokemon_data) {
        $target_pokemons =[];
        foreach ($pokemon_data as $row) {
            if ($row['gen'] == $gen){
                $target_pokemons[] = $row;
            }
        }
        return $target_pokemons;
    }
    
    
    #echo sprintf("<option value='%s'>%s</option>",$row['id'],$row['identifier']); // Example column names
    function createPokemonCard($target_pokemons) {
        foreach($target_pokemons as $tp){
            echo "<div class='pokemon-info'>";
                echo sprintf("<h2>%s</h2>",$tp['name']);
                echo "<hr>";
                $files = glob("pokemon/{$tp['pkdx no']}.png"); // This will match exactly "1.png", "151.png", etc.

                // Use glob to find files that match the format "number-*.png"
                $forms = glob("pokemon/{$tp['pkdx no']}-*.png");
                $files = array_merge($files, $forms);
                foreach ($files as $file) {
                    echo sprintf("<img src='%s' alt='%s'>",$file,$tp['name']);
                }
                echo "<div class='stats'>";
                    echo sprintf("<p>HP: %s | ATK: %s | SP ATK: %s | DEF: %s | SP DEF: %s | SPD: %s</p>",
                    $tp['hp'],$tp['atk'],$tp['sp atk'],$tp['def'],$tp['sp def'],$tp['spd']);
                echo "</div>";
                echo "<hr>";
                echo sprintf("<p>Ability: %s | Hidden Ability: %s.</p>",
                $tp['base ability'],$tp['hidden ability']);
                echo "<hr>";
                echo sprintf("<p>Type 1: %s | Type 2: %s.</p>",
                $tp['type1'],$tp['type2']);
                #echo "<div class='evolution'>";
                #    echo "<p>⚡ Pichu → Pikachu → Raichu</p>";
                #echo "</div>";
             echo "</div>";
        }
    }
?>