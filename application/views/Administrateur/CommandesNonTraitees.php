<div class="col-sm-10">
<div class = "well" id="well">
<div class="container" id="container2">
    <?php
        if ($NoClient != NULL)
        {
            echo '<h2 id="TitrePage">Commandes en attentes de '.implode(' ', $NomPrenom).'</h2></br>';
        }
        else
        {
            echo '<h2 id="TitrePage">Toutes les commandes en attentes</h2></br>';
        }
        if ($lesCommandes != NULL)
        {

            echo '<table class="table table-hover" id="panier" cellpadding = 6 cellspacing = 1 style="width:100%">';
            echo '<thead class="titrepanier">';
            echo '<tr>';

                echo '<th>Numéro de la commande</th>';
                echo '<th>Valider la commande</th>';
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
            echo '</thead>';

            echo '<tbody>';
            if ($NoClient == NULL)
            {
                $nbCommandes = count($lesCommandes);
                foreach ($lesCommandes as $uneCommande):
                    $nbArticles = count($uneCommande);
                    $articlesAafficher = $uneCommande[0];
                    echo '<tr>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['NOCOMMANDE'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier"><a class="lienPanier" href="'.site_url('Administrateur/ValiderCommande/'.$articlesAafficher['NOCOMMANDE'].'/'.$NoClient).'">Valider cette commande</a></h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['NOM'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['PRENOM'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['ADRESSE'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['CODEPOSTAL'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['VILLE'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['EMAIL'].'</h5></td>';
                        for ($i = 0; $i <= $nbArticles - 1; $i = $i + 1) 
                        {
                            $articlesAafficher = $uneCommande[$i];
                            echo '<td><h5 class="nompanier">'.$articlesAafficher['LIBELLE'].'</h5></td>';
                            echo '<td><h5 class="nompanier">'.floor($articlesAafficher['QUANTITECOMMANDEE']).'</h5></td>';
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
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier">'.$articlesAafficher['NOCOMMANDE'].'</h5></td>';
                        echo '<td rowspan = '.$nbArticles.'><h5 class="nompanier"><a class="lienPanier" href="'.site_url('Administrateur/ValiderCommande/'.$articlesAafficher['NOCOMMANDE'].'/'.$NoClient).'">Valider cette commande</a></h5></td>';
                        for ($i = 0; $i <= $nbArticles - 1; $i = $i + 1) 
                        {
                            $articlesAafficher = $uneCommande[$i];
                            echo '<td><h5 class="nompanier">'.$articlesAafficher['LIBELLE'].'</h5></td>';
                            echo '<td><h5 class="nompanier">'.floor($articlesAafficher['QUANTITECOMMANDEE']).'</h5></td>';
                            echo '</tr>';
                        }
                endforeach;
            }
            echo '</tbody>';
            echo '</table>';
        }
        else
        {
            echo '<h4 class="titreAdresse">Aucune commande en attente</h4>';
        }
        
    ?>
</div>
</div>
</div>