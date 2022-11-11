
<?php
require("header.php");
$contador = 0;
$random1 = rand(1, 826);
$random2 = rand(1, 826);
$random3 = rand(1, 826);
$personajes = curl_init();
curl_setopt($personajes, CURLOPT_URL, 'https://rickandmortyapi.com/api/character/' . "[" . $random1 . "," . $random2 . "," . $random3 . "]");
curl_setopt($personajes, CURLOPT_RETURNTRANSFER, TRUE);
$Respuesta = curl_exec($personajes);
curl_close($personajes);
$capitulo = json_decode($Respuesta, TRUE);
echo '<br><center><H1><u>Personajes random </u></H1></center>';
echo "<container class='recommendations-characters'>";
foreach ($capitulo as $personaje) {
    $location = $personaje['location'];
    $origin = $personaje['origin'];
    echo '
    <div class="card">
        <div class="face front">
            <img src="' . $personaje['image'] . '">
            <h3>Name: ' . $personaje['name'] . '</h3>
        </div>
        <div class="face back">
            <h3>Name: ' . $personaje['name'] . '</h3>
            <p>Specie: ' . $personaje['species'] . '</p>
            <p>Status: ' . $personaje['status'] . '</p>
            <p>Gender: ' . $personaje['gender'] . '</p>
            <p>Location: ' . $location['name'] . '</p>
            <p>Origin: ' . $origin['name'] . '</p>
        </div>
        <br>
    </div>';
}
echo '</container>';
$capitulos = curl_init();
curl_setopt($capitulos, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/1");
curl_setopt($capitulos, CURLOPT_RETURNTRANSFER, TRUE);
$Respuesta = curl_exec($capitulos);
curl_close($capitulos);
$capitulo = json_decode($Respuesta, TRUE);
echo '<br><center><H1><u>Episodio 1 ' . $capitulo['name'] . '</u></H1></center>';
echo '<br><center><H1><u>Personajes principales </u></H1></center>';
echo "<container class='recommendations-characters'>";
foreach ($capitulo['characters'] as $personajes) {
    $personaje = curl_init();
    curl_setopt($personaje, CURLOPT_URL, $personajes);
    curl_setopt($personaje, CURLOPT_RETURNTRANSFER, TRUE);
    $Respuesta = curl_exec($personaje);
    curl_close($personaje);
    $person = json_decode($Respuesta, TRUE);
    $location = $person['location'];
    $origin = $person['origin'];
    echo '
        <div class="card">
                <div class="face front">
                    <img src="' . $person['image'] . '">
                    <h3>Name: ' . $person['name'] . '</h3>
                </div>
                <div class="face back">
                    <h3>Name: ' . $person['name'] . '</h3>
                    <p>Specie: ' . $person['species'] . '</p>
                    <p>Status: ' . $person['status'] . '</p>
                    <p>Gender: ' . $person['gender'] . '</p>
                    <p>Location: ' . $location['name'] . '</p>
                    <p>Origin: ' . $origin['name'] . '</p>
                </div>
        </div>';

    $contador += 1;
    if ($contador == 4) 
    {
        echo "</container>";
        echo "<br></br>";
        $contador = 0;
        echo "<container class='recommendations-characters'>";
    } 
}
?>
        </section>
        </div>
    </div>
    
</body>

</html>
        