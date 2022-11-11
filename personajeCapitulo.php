<?php
require("header.php");
$contador = 0;
for ($x = 0; $x < 52; $x++) {
    if (isset($_GET[$x])) {
        $cap = $_GET[$x];
        $capitulos = curl_init();
        curl_setopt($capitulos, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/" . ($cap));
        curl_setopt($capitulos, CURLOPT_RETURNTRANSFER, TRUE);
        $Respuesta = curl_exec($capitulos);
        curl_close($capitulos);
        $capitulo = json_decode($Respuesta, TRUE);
        echo '<center><H1><u>Episodio ' . $cap . '-- "' . $capitulo['name'] . '"</u></H1></center>';
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
            if ($contador == 4) {
                echo "</container>";
                echo "<br></br>";
                $contador = 0;
                echo "<container class='recommendations-characters'>";
            }
        }

    }
}
?>
        </section>
        </div>
    </div>
    
</body>

</html>