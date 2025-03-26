<?php
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
        if (strstr($row['name'], $pokemon_name)){
            $target_pokemons[] = $row;
        }
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
            echo sprintf("<img src='pokemon/%s.png' alt='%s'>",$tp['pkdx no'],$tp['name']);
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

#$pokemon_data = getPokemonData();
#print_r($pokemon_data);
#$req = getPokemonByID(1,$pokemon_data);
#$req = getPokemonByName('AT',$pokemon_data);
#createPokemonCard($req);
?>