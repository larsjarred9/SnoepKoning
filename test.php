<?php
    if (empty($productcount)) {
        echo "<p>Je hebt nog geen producten toegevoegd aan de winkelwagen.</p>";
    }
    for ($x = 0; $x < $productcount; $x++):  
        $snoepjes = unserialize($_SESSION['snoepjes'][$x]);
        $vorm = getVorm($conn, $snoepjes->vorm);
        $smaak = getSmaak($conn, $snoepjes->smaak);
        $kleur = getKleur($conn, $snoepjes->kleur);
    ?>
    <li class="list-group-item d-flex justify-content-between lh-sm">';
       <div>
           <h6 class="my-0">Snoep <?= $vorm ?> | <small>50 KG</small></h6>';
           <small class="text-muted">Kleur: <?= $kluer ?> </small><br>';
           <small class="text-muted">Smaak: <?= $smaak ?></small>';
        </div>
        <span class="text-muted">€75</span>';
    </li>
    
<?php endfor ?>
