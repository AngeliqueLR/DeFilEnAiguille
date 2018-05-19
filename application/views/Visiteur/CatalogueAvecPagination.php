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
                    echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT'], $unProduit['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT'], $prix.' €').'</p><p>';
                }
                else
                {
                    $prix = ($unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA'] / 100))*(1-$unProduit['Promotion']/100);
                    echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT'], $unProduit['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT'], $prix.' €').' | '.anchor('Visiteur/VoirUnProduit/'.$unProduit['NOPRODUIT'], '<span class="glyphicon glyphicon-tag"></span> -'.$unProduit['Promotion'].'%').'</p><p>';
                }
                if ($this->session->statut=='Administrateur'):
                    echo anchor('Administrateur/ModifierProduit/'.$unProduit['NOPRODUIT'].'/'.$unProduit['QUANTITEENSTOCK'], 'Modifier ce produit'); 
                else:
                    if ($unProduit['QUANTITEENSTOCK'] != 0) : 
                        echo anchor('Visiteur/AjouterPanier/'.$unProduit['NOPRODUIT'].'/'.$prix.'/'.$unProduit['QUANTITEENSTOCK'].'/'.$Catalogue, '<span class="glyphicon glyphicon-shopping-cart"></span>'); 
                    else:
                        echo anchor('Client/Alerter/'.$unProduit['NOPRODUIT'], '<span class="glyphicon glyphicon-bell"></span>');
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