<!DOCTYPE html>
<html lang="en">

<style>
<?php include 'styles.css'; ?>
<?php include 'pokemon-handler.php'; ?>
<?php $pokemon_data = getPokemonData();?>
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Pokedex</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- 
    <link rel="stylesheet" href="styles.css">
    Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Search any Pokemon here</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <li class="nav-item">
                        <input type="text" name="pokemon-id" class="form-control" placeholder="Number" aria-label="Name">
                    </li>
                </li>
                <li class="nav-item">
                    <input type="text" name="pokemon-name" class="form-control" placeholder="Name" aria-label="Name">
                </li>
                <form method="GET" action=""></form>
                    <li class="nav-item">
                        <select name ="generation" class="form-control" aria-label="Generation">
                            <?php
                                getGenerations();
                                #echo $_GET["pokemon-id"];
                                #echo $_GET["pokemon-name"];
                            ?>
                        </select>
                    </li>
                    <button type="submit" id= "submit-button">Submit</button>
                </form>
            </ul>
        </div>
    </nav>

    <script>
        // Select all elements with the class 'my-class'
        const elements = document.querySelectorAll('.form-control');

        // Variable to keep track of the currently selected element
        let selectedElement = null;
        console.log(elements.length);
        elements.forEach((element) => console.log(element.tagName+':'+element.value));
        
    </script>

    <?php
        #print_r($pokemon_data);
        #$req = getPokemonByID(643,$pokemon_data);
        #$req = getPokemonByGeneration(2,$pokemon_data);
        $req = getPokemonByName('OL',$pokemon_data);
        createPokemonCard($req);
    ?>
</body>
</html>
