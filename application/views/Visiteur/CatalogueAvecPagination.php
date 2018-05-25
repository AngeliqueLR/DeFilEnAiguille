<div class="col-sm-9">

        <?php
            echo '<h2>'.$TitreDeLaPage.'</h2><br/><br/>';
            $nbProduits = 0;

            echo '<div class="row">';
            foreach ($LesProduits as $unProduit):
                echo '<div class="col-sm-4">';
                if ($unProduit['Promotion'] == 0)
                {
                    $prix = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA'] / 100);
                    echo '<p><a href="'.site_url('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT']).'" class="liensCatalogue">'.$unProduit['LIBELLE'].'</a></p><p><a href="'.site_url('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT']).'" class="liensCatalogue">'.$prix.' €</a></p><p>';
                }
                else
                {
                    $prix = ($unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA'] / 100))*(1-$unProduit['Promotion']/100);
                    echo '<p><a href="'.site_url('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT']).'" class="liensCatalogue">'.$unProduit['LIBELLE'].'</a></p><p><a href="'.site_url('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT']).'" class="liensCatalogue">'.$prix.' € | <span class="glyphicon glyphicon-tag"></span> -'.$unProduit['Promotion'].'%</a></p><p>';
                }
                if ($this->session->statut=='Administrateur'):
                    echo '<p><a href="'.site_url('Administrateur/ModifierProduit/'.$unProduit['NOPRODUIT'].'/'.$unProduit['QUANTITEENSTOCK']).'" class="liensCatalogue">Modifier ce produit</a></p>';
                else:
                    if ($unProduit['QUANTITEENSTOCK'] != 0) : 
                        echo '<p><a href="'.site_url('Visiteur/AjouterPanier/'.$unProduit['NOPRODUIT'].'/'.$prix.'/'.$unProduit['QUANTITEENSTOCK'].'/'.$Catalogue).'" class="liensCatalogue"><span class="glyphicon glyphicon-shopping-cart"></span></a></p>';
                    else:
                        echo '<p><a href="'.site_url('Client/Alerter/'.$unProduit['NOPRODUIT']).'" class="liensCatalogue"><span class="glyphicon glyphicon-bell"></span></a></p>';
                    endif;
                endif;
                echo '</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT'], img_onmouseover($unProduit['NOMIMAGE'], $unProduit['NOMIMAGEBIS'])).'</p>';
                echo '</div>';
                $nbProduits = $nbProduits + 1;
                if ($nbProduits%3 == 0)
                {
                    echo '</div><br/>';
                    echo '<div class="row">';
                }
            endforeach;        
            echo '</div>';
    ?>

    <p><?php echo $liensPagination; ?></p>
</div>