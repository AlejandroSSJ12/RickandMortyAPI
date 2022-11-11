<?php
$contador=0;
require("header.php");
echo '<br><center><H1><u>Episodios </u></H1></center>';
echo '<br>';

echo "<container class='recommendations-characters'>";
for($i=1; $i<52;$i++)
{
    $capitulos = curl_init();
    curl_setopt($capitulos, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/" . ($i));
    curl_setopt($capitulos, CURLOPT_RETURNTRANSFER, TRUE);
    $Respuesta = curl_exec($capitulos);
    curl_close($capitulos);
    $capitulo = json_decode($Respuesta, TRUE);
    echo'
    <form action="personajeCapitulo.php" method="get">
    <div class="card">
        <div class="face front">
            <img src="img/cap.jpg">
            <h3>Numero de episodio:  '. $i . ' Nombre "'.$capitulo['name'].'"</h3>
        </div>
            <div class="face back">
            <h3>Numero de episodio:  '. $i . '</h3>
            <h3>Nombre "'.$capitulo['name'].'"</h3>
            <button type="submit" class="btn btn-outline-dark" name="'.$i.'" value="'.$i.'">Ver</button>
        </div>
    </div>
    </form>';
    $contador += 1;
    if ($contador == 4) {
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