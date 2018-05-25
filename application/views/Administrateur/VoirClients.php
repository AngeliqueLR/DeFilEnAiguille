<div class = "well" id="well">
    <h2 id="TitrePage">Liste des clients</h2>
    <table class="table table-hover" id="panier" cellpadding = 6 cellspacing = 1 style="width:100%">
    <thead class="titrepanier">
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Ville</th>
        <th>Adresse mail</th>
        <th>Commandes</th>
    </tr>
    <thead>

    <tbody>
    <?php
        foreach ($InfoClients as $Client):
    ?>
    
    <tr>
        <td><h5 class="nompanier"><?php echo $Client['NOM'];?></h5></td>
        <td><h5 class="nompanier"><?php echo $Client['PRENOM'];?></h5></td>
        <td><h5 class="nompanier"><?php echo $Client['ADRESSE'];?></h5></td>
        <td><h5 class="nompanier"><?php echo $Client['CODEPOSTAL'];?></h5></td>
        <td><h5 class="nompanier"><?php echo $Client['VILLE'];?></h5></td>
        <td><h5 class="nompanier"><?php echo $Client['EMAIL'];?></h5></td>
        <td><h5 class="nompanier"><a class="lienPanier" href="<?php echo site_url('Administrateur/CommandesNonTraitees/'.$Client['NOCLIENT']);?>">Voir les commandes de ce client</a></h5></td>
    </tr>

    <?php 
        endforeach;
    ?>
    </tbody>
</table>
<br/><br/>