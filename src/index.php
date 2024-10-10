<?php
function obtenerPokemonAleatorio() {
    $idPokemon = rand(1, 151); // Random Pokémon ID for the first generation
    return obtenerPokemon($idPokemon);
}

function obtenerPokemon($nombrePokemon) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . $nombrePokemon;
    $respuesta = file_get_contents($url);
    if ($respuesta === FALSE) {
        return null;
    }
    return json_decode($respuesta, true);
}

$pokemonData = null;
$resultadoAdivinanza = null;

// Obtener un Pokémon aleatorio
$pokemonData = obtenerPokemonAleatorio();

// Si se encontró el Pokémon
if ($pokemonData) {
    // Obtener la habilidad más significativa (la primera en el array de habilidades)
    $nombreHabilidad = $pokemonData['abilities'][0]['ability']['name'];
    $nombrePokemon = strtolower($pokemonData['name']);
    $imagenPokemon = $pokemonData['sprites']['front_default'] ?? '';
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la adivinanza del usuario
    $adivinanzaNombre = strtolower(trim($_POST['nombre']));
    $adivinanzaHabilidad = strtolower(trim($_POST['habilidad']));

    // Verificar las adivinanzas
    $resultadoNombre = ($adivinanzaNombre === $nombrePokemon) ? "¡Correcto! Adivinaste el nombre del Pokémon." : "Incorrecto. El Pokémon era $nombrePokemon.";
    $resultadoHabilidad = ($adivinanzaHabilidad === $nombreHabilidad) ? "¡Correcto! Adivinaste la habilidad." : "Incorrecto. La habilidad era $nombreHabilidad.";
    $resultadoAdivinanza = $resultadoNombre . " " . $resultadoHabilidad;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el Pokémon</title>
    <style>
        body {
            background-color: yellow;
            text-align: center;
            font-family: Verdana,Arial, sans-serif;
        }
        .pokemon-container {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .pokemon-image {
            max-width: 200px;
            height: auto;
            object-fit: contain;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Adivina el Pokémon</h1>

<div class="pokemon-container">
    <h2>¡Pokémon Aleatorio!</h2>
    <?php if ($imagenPokemon): ?>
        <img src="<?php echo $imagenPokemon; ?>" alt="<?php echo htmlspecialchars($nombrePokemon); ?>" class="pokemon-image"><br>
    <?php else: ?>
        <p>No hay imagen disponible para este Pokémon.</p>
    <?php endif; ?>

    <!-- Formulario para adivinar el nombre y la habilidad del Pokémon -->
    <form method="POST" action="">
        <label for="nombre">Adivina el nombre del Pokémon:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="habilidad">Adivina la habilidad del Pokémon:</label><br>
        <input type="text" id="habilidad" name="habilidad" required><br><br>
        <input type="submit" value="Enviar Adivinanza">
    </form>

    <!-- Mostrar resultado de la adivinanza -->
    <?php if ($resultadoAdivinanza): ?>
        <p><?php echo $resultadoAdivinanza; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
