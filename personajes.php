<?php
require("header.php");
$contador = 1;
if (isset($_GET["contador1"])) {
    if($_GET["contador1"] == 42){
        $contador = 42;
    }
    else{
        $contador = $_GET["contador1"] += 1;
    }
} 
if (isset($_GET["contador2"])) {
    if($_GET["contador2"] == 1){
        $contador = 1;
    }
    else{
        $contador = $_GET["contador2"]-=1;
    }    
} 

$personaje = curl_init();
curl_setopt($personaje, CURLOPT_URL, "https://rickandmortyapi.com/api/character/?page=".$contador);
curl_setopt($personaje, CURLOPT_RETURNTRANSFER, TRUE);
$Respuesta = curl_exec($personaje);
curl_close($personaje);
$person = json_decode($Respuesta, TRUE);
$contadorrr =0;
echo '<br><center><H1><u>Pagina '.$contador.'</u></H1></center>';
echo '<br><center><H1><u>PERSONAJES</u></H1></center>';
echo "<container class='recommendations-characters'>";
foreach ($person['results'] as $personajes) {
    $location = $personajes['location'];
    $origin = $personajes['origin'];
    echo '
            <div class="card">
                <div class="face front">
                    <img src="' . $personajes['image'] . '">
                    <h3>Name: ' . $personajes['name'] . '</h3>
                </div>
                <div class="face back">
                    <h3>Name: ' . $personajes['name'] . '</h3>
                    <p>Specie: ' . $personajes['species'] . '</p>
                    <p>Status: ' . $personajes['status'] . '</p>
                    <p>Gender: ' . $personajes['gender'] . '</p>
                    <p>Location: ' . $location['name'] . '</p>
                    <p>Origin: ' . $origin['name'] . '</p>
                </div>
            </div>';
    $contadorrr += 1;
    if ($contadorrr == 4) {
        echo "</container>";
        echo "<br></br>";
        $contadorrr = 0;
        echo "<container class='recommendations-characters'>";
    }
}

echo "<form action='personajes.php' method='get'>
    <input style='display:none' class='btn' type='text' name='contador1' value=".$contador.">
    <input class='button button1' type='submit' value='siguiente'>
    </form><br>";
echo "<form action='personajes.php' method='get'>
        <input style='display:none' class='btn' type='text' name='contador2' value=".$contador.">
        <input class='button button1'type='submit' value='regresar'>
        </form><br>";

?>
        </section>
        </div>
    </div>
    
</body>

</html>