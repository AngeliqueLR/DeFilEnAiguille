<div class="container text-center">    
  <h2 id="TitrePage"><?php echo '<p>'.$unProduit['LIBELLE'].'</p>'; ?></h2><br>
  <div class="row">
    <div id="divProduit"class="col-sm-4">
      <img id="imageProduit" src="<?php echo img_url($unProduit['NOMIMAGE']); ?>" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div id="divProduit" class="col-sm-4"> 
      <img id="imageProduit" src="<?php echo img_url($unProduit['NOMIMAGEBIS']); ?>" class="img-responsive" style="width:100%" alt="ImageBis"> 
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger" id="ecriturePanel">
        <div class="panel-heading" id="panelRose"><?php echo 'Informations sur le produit : '.$unProduit['DETAIL']; ?></div>
        <div class="panel-body"><?php $prix = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA'] / 100); echo 'Prix : '.$prix.' €'; ?></div>
        <div class="panel-heading" id="panelRose"><?php echo 'Quantité en stock : '.$unProduit['QUANTITEENSTOCK']; ?></div>
        <div class="panel-body">
          <?php 
            if ($this->session->statut=='Administrateur'):
              echo '<a  id="lienInscription" href="'.site_url('Administrateur/ModifierProduit/'.$unProduit['NOPRODUIT'].'/'.$unProduit['QUANTITEENSTOCK']).'">Modifier cet article</a>';
            else:
              if ($unProduit['QUANTITEENSTOCK'] == 0):
                echo anchor('Visiteur/Alerter/'.$unProduit['NOPRODUIT'], '<span class=\'glyphicon glyphicon-bell\'></span> M\'alerter à la remise en stock');
              else :
              
              echo form_open('Visiteur/AjouterPanier/'.$unProduit['NOPRODUIT'].'/'.$prix.'/'.$unProduit['QUANTITEENSTOCK'].'/'.$Catalogue);
            ?>
              <label class="labelQuantite" for="txtQuantiteDesiree">Quantité désirée</label>
                <select name="txtQuantiteDesiree">
                    <?php 
                      $i = 1;    
                      while ($i < $unProduit['QUANTITEENSTOCK'] + 1): echo '<option value = "'.$i.'">'.$i.'</option>'; $i = $i + 1; endwhile;
                    ?>
                </select><br/><br/>
                <button class="boutonAjouter"><span class='glyphicon glyphicon-shopping-cart'></span> Ajouter</button>
              <?php endif; 
            endif;?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div><br>