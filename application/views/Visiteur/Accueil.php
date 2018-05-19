<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <?php if (!(empty($LajoutLePlusRecent))):?>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      <?php endif;?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php echo img_url('LOGOAccueil.jpg'); ?>" alt="LOGO">
        <div class="carousel-caption">
          <h3>Bienvenu chez nous!</h3>
          <p>Filez dans notre catalogue pour trouvez votre petit bonheur</p>
        </div>      
      </div>

      <div class="item">
        <img src="<?php echo img_url($LAmeilleureVente['NOMIMAGEACCEUIL']); ?>" alt="<?php echo $LAmeilleureVente['LIBELLE']; ?>">
        <div class="carousel-caption">
          <?php
            if ($LAmeilleureVente['Promotion'] == 0)
            {
                $prix = $LAmeilleureVente['PRIXHT'] + ($LAmeilleureVente['PRIXHT'] * $LAmeilleureVente['TAUXTVA'] / 100);
            }
            else
            {
                $prix = ($LAmeilleureVente['PRIXHT'] + ($LAmeilleureVente['PRIXHT'] * $LAmeilleureVente['TAUXTVA'] / 100))*(1-$LAmeilleureVente['Promotion']/100);
            }
          ?>
          <h3><?php echo $prix.' €';
            if($LAmeilleureVente['Promotion'] != 0):
              echo '| <span class="glyphicon glyphicon-tag"></span> -'.$LAmeilleureVente['Promotion'].'%';
            endif;
          ?></h3>
          <p><?php echo $LAmeilleureVente['LIBELLE']; ?></p>
        </div>      
      </div>

      <div class="item">
        <img src="<?php echo img_url($LAmeilleurePromo['NOMIMAGEACCEUIL']); ?>" alt="<?php echo $LAmeilleurePromo['LIBELLE']; ?>">
        <div class="carousel-caption">
          <?php
            $prix = ($LAmeilleurePromo['PRIXHT'] + ($LAmeilleurePromo['PRIXHT'] * $LAmeilleurePromo['TAUXTVA'] / 100))*(1-$LAmeilleurePromo['Promotion']/100);
          ?>
          <h3><?php echo $prix.' € | <span class="glyphicon glyphicon-tag"></span> -'.$LAmeilleurePromo['Promotion'].'%';?></h3>
          <p><?php echo $LAmeilleurePromo['LIBELLE']; ?></p>
        </div>      
      </div>

      <?php if (!(empty($LajoutLePlusRecent))):?>
      <div class="item">
        <img src="<?php echo img_url($LajoutLePlusRecent['NOMIMAGEACCEUIL']); ?>" alt="<?php echo $LajoutLePlusRecent['LIBELLE']; ?>">
        <div class="carousel-caption">
          <?php
            if ($LajoutLePlusRecent['Promotion'] == 0)
            {
                $prix = $LajoutLePlusRecent['PRIXHT'] + ($LajoutLePlusRecent['PRIXHT'] * $LajoutLePlusRecent['TAUXTVA'] / 100);
            }
            else
            {
                $prix = ($LajoutLePlusRecent['PRIXHT'] + ($LajoutLePlusRecent['PRIXHT'] * $LajoutLePlusRecent['TAUXTVA'] / 100))*(1-$LajoutLePlusRecent['Promotion']/100);
            }
          ?>
          <h3><?php echo $prix.' €';
            if($LajoutLePlusRecent['Promotion'] != 0):
              echo '| <span class="glyphicon glyphicon-tag"></span> -'.$LajoutLePlusRecent['Promotion'].'%';
            endif;
          ?></h3>
          <p><?php echo $LajoutLePlusRecent['LIBELLE']; ?></p>
        </div>      
      </div>
      <?php endif; ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">
  <h3><span class="glyphicon glyphicon-heart"></span> Meilleures Ventes</h3><br>
  <div class="well">
    <?php
      $nbProduits = 0;
        echo '<div class="row">';
        foreach ($MeilleuresVentes as $uneVente):
            echo '<div class="col-sm-4">';
            if ($uneVente['Promotion'] == 0)
            {
                $prix = $uneVente['PRIXHT'] + ($uneVente['PRIXHT'] * $uneVente['TAUXTVA'] / 100);
                echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$uneVente['NOPRODUIT'], $uneVente['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$uneVente['NOPRODUIT'], $prix.' €').'</p><p>';
            }
            else
            {
                $prix = ($uneVente['PRIXHT'] + ($uneVente['PRIXHT'] * $uneVente['TAUXTVA'] / 100))*(1-$uneVente['Promotion']/100);
                echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$uneVente['NOPRODUIT'], $uneVente['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$uneVente['NOPRODUIT'], $prix.' €').' | '.anchor('Visiteur/VoirUnProduit/'.$uneVente['NOPRODUIT'], '<span class="glyphicon glyphicon-tag"></span> -'.$uneVente['Promotion'].'%').'</p><p>';
            }
            if ($this->session->statut=='Administrateur'):
                echo anchor('Administrateur/ModifierProduit/'.$uneVente['NOPRODUIT'].'/'.$uneVente['QUANTITEENSTOCK'], 'Modifier ce produit'); 
            else:
                if ($uneVente['QUANTITEENSTOCK'] != 0) : 
                    echo anchor('Visiteur/AjouterPanier/'.$uneVente['NOPRODUIT'].'/'.$prix.'/'.$uneVente['QUANTITEENSTOCK'].'/'.$Catalogue, '<span class="glyphicon glyphicon-shopping-cart"></span>'); 
                else:
                    echo anchor('Client/Alerter/'.$uneVente['NOPRODUIT'], '<span class="glyphicon glyphicon-bell"></span>');
                endif;
            endif;
            echo '</p><p>'.anchor('Visiteur/VoirUnProduit/'.$uneVente['NOPRODUIT'], img_onmouseover($uneVente['NOMIMAGE'], $uneVente['NOMIMAGEBIS'])).'</p>';
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
    </div>

  <h3><span class="glyphicon glyphicon-tags"></span> Promotions du moments</h3><br>
  <div class="well">
    <?php
      $nbProduits = 0;
        echo '<div class="row">';
        foreach ($LesPromos as $unePromo):
            echo '<div class="col-sm-4">';
            $prix = ($unePromo['PRIXHT'] + ($unePromo['PRIXHT'] * $unePromo['TAUXTVA'] / 100))*(1-$unePromo['Promotion']/100);
            echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$unePromo['NOPRODUIT'], $unePromo['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unePromo['NOPRODUIT'], $prix.' €').' | '.anchor('Visiteur/VoirUnProduit/'.$unePromo['NOPRODUIT'], '<span class="glyphicon glyphicon-tag"></span> -'.$unePromo['Promotion'].'%').'</p><p>';
            if ($this->session->statut=='Administrateur'):
                echo anchor('Administrateur/ModifierProduit/'.$unePromo['NOPRODUIT'].'/'.$unePromo['QUANTITEENSTOCK'], 'Modifier ce produit'); 
            else:
                if ($unePromo['QUANTITEENSTOCK'] != 0) : 
                    echo anchor('Visiteur/AjouterPanier/'.$unePromo['NOPRODUIT'].'/'.$prix.'/'.$unePromo['QUANTITEENSTOCK'].'/'.$Catalogue, '<span class="glyphicon glyphicon-shopping-cart"></span>'); 
                else:
                    echo anchor('Client/Alerter/'.$unePromo['NOPRODUIT'], '<span class="glyphicon glyphicon-bell"></span>');
                endif;
            endif;
            echo '</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unePromo['NOPRODUIT'], img_onmouseover($unePromo['NOMIMAGE'], $unePromo['NOMIMAGEBIS'])).'</p>';
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
    </div>

  <?php if (!(empty($lesAjoutsRecents))):?>
    <h3><span class="glyphicon glyphicon-calendar"></span> Ajouts récents</h3><br>
    <div class="well">
      <?php
        $nbProduits = 0;
          echo '<div class="row">';
          foreach ($lesAjoutsRecents as $unAjoutRecent):
            echo '<div class="col-sm-4">';
            if ($unAjoutRecent['Promotion'] == 0)
            {
                $prix = $unAjoutRecent['PRIXHT'] + ($unAjoutRecent['PRIXHT'] * $unAjoutRecent['TAUXTVA'] / 100);
                echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$unAjoutRecent['NOPRODUIT'], $unAjoutRecent['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unAjoutRecent['NOPRODUIT'], $prix.' €').'</p><p>';
            }
            else
            {
                $prix = ($unAjoutRecent['PRIXHT'] + ($unAjoutRecent['PRIXHT'] * $unAjoutRecent['TAUXTVA'] / 100))*(1-$unAjoutRecent['Promotion']/100);
                echo '<p>'.anchor('Visiteur/VoirUnProduit/'.$unAjoutRecent['NOPRODUIT'], $unAjoutRecent['LIBELLE']).'</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unAjoutRecent['NOPRODUIT'], $prix.' €').' | '.anchor('Visiteur/VoirUnProduit/'.$unAjoutRecent['NOPRODUIT'], '<span class="glyphicon glyphicon-tag"></span> -'.$unAjoutRecent['Promotion'].'%').'</p><p>';
            }
            if ($this->session->statut=='Administrateur'):
                echo anchor('Administrateur/ModifierProduit/'.$unAjoutRecent['NOPRODUIT'].'/'.$unAjoutRecent['QUANTITEENSTOCK'], 'Modifier ce produit'); 
            else:
                if ($unAjoutRecent['QUANTITEENSTOCK'] != 0) : 
                    echo anchor('Visiteur/AjouterPanier/'.$unAjoutRecent['NOPRODUIT'].'/'.$prix.'/'.$unAjoutRecent['QUANTITEENSTOCK'].'/'.$Catalogue, '<span class="glyphicon glyphicon-shopping-cart"></span>'); 
                else:
                    echo anchor('Client/Alerter/'.$unAjoutRecent['NOPRODUIT'], '<span class="glyphicon glyphicon-bell"></span>');
                endif;
            endif;
            echo '</p><p>'.anchor('Visiteur/VoirUnProduit/'.$unAjoutRecent['NOPRODUIT'], img_onmouseover($unAjoutRecent['NOMIMAGE'], $unAjoutRecent['NOMIMAGEBIS'])).'</p>';
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
      <?php endif;?>
    </div>
  </div>
</div><br>