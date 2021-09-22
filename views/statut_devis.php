        <?php 
    if($r['type_devis']=='Devis'){
        if($r['statut_devis']=='En attente') $class = "yellow";
        elseif($r['statut_devis']=='Valider') $class="green";
        elseif($r['statut_devis']=='Refus') $class="red";                
    ?>
        <!-- <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
        <span aria-hidden class="absolute inset-0 bg-yellow-500 opacity-50 rounded-full"></span> -->
        <select class="statut_devis relative text-xs px-3 py-1 inset-0 leading-tight font-semibold text-<?= $class; ?>-900 bg-<?= $class ;?>-500  rounded-full" data-id="<?= $r['devis_num']; ?>"><?= $r['statut_devis'] ;?>
            <option value="En attente" <?php if($r['statut_devis']=='En attente') echo "selected";?>>En attente</option>
            <option value="Valider" <?php if($r['statut_devis']=='Valider') echo "selected";?>>Validé</option>
            <option value="Refus"<?php if($r['statut_devis']=='Refus') echo "selected";?>>Refusé</option>
        </select>
    <?php
    }
    ?>
