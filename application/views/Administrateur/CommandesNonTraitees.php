<?php
    echo var_dump($lesCommandes);
    if ($NoClient != NULL)
    {
        echo '<h2>Commandes en attentes de '.implode(' ', $NomPrenom).'</h2>';
    }
    else
    {
        echo '<h2>Toutes les commandes en attentes</h2>';
    }
    if ($lesCommandes != NULL)
    {

        echo '<table cellpadding = 6 cellspacing = 1 style="width:100%" border = 1>';
        echo '<tr>';

        echo '<th>Produits et quantités commandés</th>';
        if ($NoClient == NULL)
        {
            echo '<th>Nom</th>';
            echo '<th>Prenom</th>';
            echo '<th>Adresse</th>';
            echo '<th>Code Postal</th>';
            echo '<th>Ville</th>';
            echo '<th>Adresse mail</th>';
        }
        echo '</tr>';

        foreach ($lesCommandes as $uneCommande):
            $i = 0;
            while ($uneCommande != NULL):
                echo '<tr>';
                echo '<td>';
                    echo 'bonjour';
                echo '</td>';
                echo '</tr>';
            endwhile;
            
        endforeach;
        echo '</table>';
    }
    else
    {
        echo '<h4>Ce client n\'a aucune commande en attente</h4>';
    }
?>