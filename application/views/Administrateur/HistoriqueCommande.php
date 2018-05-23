<div class="col-sm-9">
    <?php
        if ($NoClient != NULL)
        {
            echo '<h2>Commandes expédiées de '.implode(' ', $NomPrenom).'</h2>';
        }
        else
        {
            echo '<h2>Toutes les commandes expédiées</h2>';
        }
        if ($lesCommandes != NULL)
        {

            echo '<table cellpadding = 6 cellspacing = 1 style="width:100%" border = 1>';
            echo '<tr>';

                echo '<th>Numéro de la commande</th>';
                if ($NoClient == NULL)
                {
                    echo '<th>Nom</th>';
                    echo '<th>Prenom</th>';
                    echo '<th>Adresse</th>';
                    echo '<th>Code Postal</th>';
                    echo '<th>Ville</th>';
                    echo '<th>Adresse mail</th>';
                }
                echo '<th>Produits</th>';
                echo '<th>Quantités commandées</th>';
            echo '</tr>';

            if ($NoClient == NULL)
            {
                $nbCommandes = count($lesCommandes);
                foreach ($lesCommandes as $uneCommande):
                    $nbArticles = count($uneCommande);
                    $articlesAafficher = $uneCommande[0];
                    echo '<tr>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['NOCOMMANDE'].'</td>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['NOM'].'</td>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['PRENOM'].'</td>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['ADRESSE'].'</td>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['CODEPOSTAL'].'</td>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['VILLE'].'</td>';
                        echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['EMAIL'].'</td>';
                        for ($i = 0; $i <= $nbArticles - 1; $i = $i + 1) 
                        {
                            $articlesAafficher = $uneCommande[$i];
                            echo '<td>'.$articlesAafficher['LIBELLE'].'</td>';
                            echo '<td>'.floor($articlesAafficher['QUANTITECOMMANDEE']).'</td>';
                            echo '</tr>';
                        }
                endforeach;
            }
            else
            {
                foreach ($lesCommandes as $uneCommande):
                    $nbArticles = count($uneCommande);
                    $articlesAafficher = $uneCommande[0];
                    echo '<tr>';
                    echo '<td rowspan = '.$nbArticles.'>'.$articlesAafficher['NOCOMMANDE'].'</td>';
                    for ($i = 0; $i <= $nbArticles - 1; $i = $i + 1) 
                        {
                            $articlesAafficher = $uneCommande[$i];
                            echo '<td>'.$articlesAafficher['LIBELLE'].'</td>';
                            echo '<td>'.floor($articlesAafficher['QUANTITECOMMANDEE']).'</td>';
                            echo '</tr>';
                        }
                endforeach;
            }
            echo '</table>';
        }
        else
        {
            echo '<h4>Aucune commande en attente</h4>';
        }
    ?>
</div>