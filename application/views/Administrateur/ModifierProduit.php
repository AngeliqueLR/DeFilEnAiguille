<div class="well" id="well">
<div class="container" id="container">

    <h2 id="TitrePage"><?php echo $TitreDeLaPage ?></h2>
    <?php 
        echo validation_errors();
        echo form_open('Administrateur/ModifierProduit/'.$NoProduit.'/'.$Qte) 
    ?>
        <div class="row">
                    <div class="col-sm-3">
                    <label for="txtNomProduit">Nom</label>
                    </div>
                    <div class="col-sm-9">
                        <input required pattern = "[a-zA-ZÀ-ÿ ]*" maxlength = 50 type="text" name="txtNomProduit" value="<?php echo $InfoProduits['LIBELLE']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtDetailsProduit">Détails</label>
        </div>
                    <div class="col-sm-9">
                        <textarea required maxlenght = 300 name="txtDetailsProduit"><?php echo $InfoProduits['DETAIL']; ?></textarea><br/><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPrixProduit">Prix HT</label>
        </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9,.]*" maxlength = 5 type="text" name="txtPrixProduit" value="<?php echo $InfoProduits['PRIXHT']; ?>" /><br/>
        
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtTVAProduit">Taux TVA (en %)</label>
        </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9,.]*" maxlength = 5 type="text" name="txtTVAProduit" value="<?php echo $InfoProduits['TAUXTVA']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPromotion">Promotion (en %)</label>
        </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9,.]*" type="text" name="txtPromotion" value="<?php echo $InfoProduits['Promotion']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPhotoProduit">Première photo</label>
        </div>
                    <div class="col-sm-9">
                        <input readonly style="text-align: center; background-color: #f1afaf; color: white" required pattern = "[a-zA-Z0-9.]*" type="text" accept=".jpg, .JPG, .jpeg" onclick="document.getElementById('PhotoProduit').click();getFileName()" name="txtPhotoProduit" value="<?php echo $InfoProduits['NOMIMAGE']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPhotoBisProduit">Deuxième photo</label>
        </div>
                    <div class="col-sm-9">
                        <input readonly style="text-align: center; background-color: #f1afaf; color: white" pattern = "[a-zA-Z0-9.]*" type="text" accept=".jpg, .JPG, .jpeg" onclick="document.getElementById('PhotoProduitBis').click();getFileName()" name="txtPhotoBisProduit" value="<?php echo $InfoProduits['NOMIMAGEBIS']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPhotoAccueilProduit">Photo carousel</label>
        </div>
                    <div class="col-sm-9">
                        <input readonly style="text-align: center; background-color: #f1afaf; color: white" pattern = "[a-zA-Z0-9.]*" type="text" accept=".jpg, .JPG, .jpeg" onclick="document.getElementById('PhotoProduitAcceuil').click();getFileName()" name="txtPhotoAccueilProduit" value="<?php echo $InfoProduits['NOMIMAGEACCEUIL']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtQuantiteProduit">Quantité en stock</label>
        </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9]*" maxlength = 3 type="text" name="txtQuantiteProduit" value="<?php echo $InfoProduits['QUANTITEENSTOCK']; ?>" /><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtMarqueProduit">Marque</label>
        </div>
                    <div class="col-sm-9">
                        <select name="txtMarqueProduit" value="<?php echo $MarqueCategorie['NOM']; ?>" >
                <?php foreach ($LesMarques as $UneMarque): echo '<option value = "'.$UneMarque['NOMARQUE'].'">'.$UneMarque['NOM'].'</option>'; endforeach ?>
            </select><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtCategorieProduit">Catégorie</label>
        </div>
                    <div class="col-sm-9">
                        <select name="txtCategorieProduit" value="<?php echo $MarqueCategorie['LIBELLE']; ?>" >
                <?php foreach ($LesCategories as $UneCategorie): echo '<option value = "'.$UneCategorie['NOCATEGORIE'].'">'.$UneCategorie['LIBELLE'].'</option>'; endforeach ?>
            </select><br/>

        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtDisponible">Disponibilité</label>
        </div>
                    <div class="col-sm-9">
                        <select name="txtDisponible" value="<?php echo set_value('txtDisponible'); ?>" >
                <option value = "1">Disponible</option>
                <option value = "0">Indisponible</option>
            </select><br/>

        </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="submit" name="submit" value="• Modifier ce produit •" />

        <input type="file" name="PhotoProduit" id="PhotoProduit" style="visibility:hidden" />
        <input type="file" name="PhotoProduitBis" id="PhotoProduitBis" style="visibility:hidden" />
        <input type="file" name="PhotoProduitAcceuil" id="PhotoProduitAcceuil" style="visibility:hidden" />
        
    </form>
</div>
</div>