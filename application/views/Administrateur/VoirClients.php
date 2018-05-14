<table cellpadding = 6 cellspacing = 1 style="width:100%" border = 1>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Ville</th>
        <th>Adresse mail</th>
        <th>Commandes</th>
    </tr>

    <?php
        foreach ($InfoClients as $Client):
    ?>

    <tr>
        <td><?php echo $Client['NOM'];?></td>
        <td><?php echo $Client['PRENOM'];?></td>
        <td><?php echo $Client['ADRESSE'];?></td>
        <td><?php echo $Client['CODEPOSTAL'];?></td>
        <td><?php echo $Client['VILLE'];?></td>
        <td><?php echo $Client['EMAIL'];?></td>
        <td><?php echo anchor('Administrateur/VoirLesCommandes/'.$Client['NOCLIENT'], 'Voir les commandes de ce client');?></td>
    </tr>

    <?php 
        endforeach;
    ?>
</table>