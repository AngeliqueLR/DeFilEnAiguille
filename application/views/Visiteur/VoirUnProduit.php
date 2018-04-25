<div class="container text-center">    
  <h3><?php echo '<p>'.$unProduit['LIBELLE'].'</p>'; ?></h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="<?php echo img_url($unProduit['NOMIMAGE']); ?>" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <img src="<?php echo img_url($unProduit['NOMIMAGEBIS']); ?>" class="img-responsive" style="width:100%" alt="ImageBis"> 
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading"><?php echo 'Informations sur le produit : '.$unProduit['DETAIL']; ?></div>
        <div class="panel-body"><?php $prix = $unProduit['PRIXHT'] + ($unProduit['PRIXHT'] * $unProduit['TAUXTVA'] / 100); echo 'Prix : '.$prix.' €'; ?></div>
        <div class="panel-heading"><?php echo 'Quantité en stock : '.$unProduit['QUANTITEENSTOCK']; ?></div>
      </div>
    </div>
  </div>
</div><br>