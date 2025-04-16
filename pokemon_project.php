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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="form-inline ml-auto" method="GET" action="">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <input type="text" name="pokemon-id" class="form-control mr-sm-2" placeholder="Number" aria-label="Number">
                    </li>
                    <li class="nav-item">
                        <input type="text" name="pokemon-name" class="form-control mr-sm-2" placeholder="Name" aria-label="Name">
                    </li>
                    <li class="nav-item">
                        <select name="generation" class="form-control mr-sm-2" aria-label="Generation">
                            <?php getGenerations(); ?>
                        </select>
                    </li>
                    <li class="nav-item">
                        <button type="submit" id="submit-button" name="submit" class="btn btn-outline-light">Submit</button>
                    </li>
                </ul>
            </form>
        </div>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fields = [
                document.querySelector('input[name="pokemon-id"]'),
                document.querySelector('input[name="pokemon-name"]'),
                document.querySelector('select[name="generation"]')
            ];

            fields.forEach(activeField => {
                activeField.addEventListener("click", function () {
                    const isDisabled = activeField.classList.contains("active-field");

                    // Enable all fields first
                    fields.forEach(f => {
                        f.disabled = false;
                        f.classList.remove("active-field");
                    });

                    // If field wasn't already active, disable the others
                    if (!isDisabled) {
                        fields.forEach(f => {
                            if (f !== activeField) f.disabled = true;
                        });
                        activeField.classList.add("active-field");
                    }
                });
            });
        });
    </script>

    <?php
        #print_r($pokemon_data);
        if (isset($_GET['submit'])) {
            // Grab form data
            $pokemonId = $_GET['pokemon-id'] ?? '';
            $pokemonName = $_GET['pokemon-name'] ?? '';
            $generation = $_GET['generation'] ?? '';
            
            $req = get_data_from_field($pokemon_data, $pokemonId,
                                $pokemonName,$generation);
            
            createPokemonCard($req);
        }
    ?>
</body>
</html>
