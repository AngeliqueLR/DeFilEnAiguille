<?php
    if ($NoClient != NULL)
    {
        echo '<h2>Voir les commandes de '.implode(' ', $NomPrenom).'</h2>';
        echo '<p>'.anchor('Administrateur/CommandesNonTraitees/'.$NoClient, 'Voir les commandes non traitées').'</p>';
        echo '<p>'.anchor('Administrateur/HistoriqueCommandes/'.$NoClient, 'Voir l\'historique des commandes').'</p>';
    }
    else
    {   
        echo '<h2>Voir les commandes</h2>';
        echo '<p>'.anchor('Administrateur/CommandesNonTraitees', 'Voir les commandes non traitées').'</p>';
        echo '<p>'.anchor('Administrateur/HistoriqueCommandes', 'Voir l\'historique des commandes').'</p>';
    }
?>