<div class="col-sm-9">
    <div class="well" id="well">
        <div class="container" id="container2">
            <h2 id="TitrePage"><?php echo $TitreDeLaPage ?></h2>
            <?php 
                echo validation_errors();
                echo form_open('Administrateur/ajouterUnProduit') 
                //echo '<form action ="'.site_url('Administrateur/ajouterUnProduit').'" methode = "post" accept-charset = "utf-8" name = "ajouterProduit">';
            ?>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtNomProduit">Nom</label>
                    </div>
                    <div class="col-sm-9">
                        <input required pattern = "[a-zA-ZÀ-ÿ ]*" maxlength = 50 type="text" name="txtNomProduit" value="<?php echo set_value('txtNomProduit'); ?>" /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtDetailsProduit">Détails</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea required maxlenght = 300 name="txtDetailsProduit" value="<?php echo set_value('txtDetailsProduit'); ?>"></textarea><br/><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPrixProduit">Prix HT</label>
                    </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9,.]*" maxlength = 5 type="text" name="txtPrixProduit" value="<?php echo set_value('txtPrixProduit'); ?>" /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtTVAProduit">Taux TVA (en %)</label>
                    </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9,.]*" maxlength = 5 type="text" name="txtTVAProduit" value="<?php echo set_value('txtTVAProduit'); ?>" /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPhotoProduit">Première photo</label>
                    </div>
                    <div class="col-sm-9">
                        <input readonly placeholder="Cliquez-ici" style="text-align: center; background-color: #f1afaf; color: white" pattern = "[a-zA-Z0-9.]*" type="text" accept=".jpg, .JPG, .jpeg" onclick="document.getElementById('txtPhotoProduit').click();getFileName()" name="PhotoProduit" value="<?php echo set_value('txtPhotoProduit'); ?>"  /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPhotoBisProduit">Deuxième photo</label>
                    </div>
                    <div class="col-sm-9">
                        <input readonly placeholder="Cliquez-ici" style="text-align: center; background-color: #f1afaf; color: white"   pattern = "[a-zA-Z0-9.]*" type="text" accept=".jpg, .JPG, .jpeg" onclick="document.getElementById('txtPhotoBisProduit').click();getFileName()" name="PhotoBisProduit" value="<?php echo set_value('txtPhotoBisProduit'); ?>" /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtPhotoAccueilProduit">Photo Carousel</label>
                    </div>
                    <div class="col-sm-9">
                        <input readonly placeholder="Cliquez-ici" style="text-align: center; background-color: #f1afaf; color: white"   pattern = "[a-zA-Z0-9.]*" type="text" accept=".jpg, .JPG, .jpeg" onclick="document.getElementById('txtPhotoAccueilProduit').click();getFileName()" name="PhotoAcceuilProduit"  value="<?php echo set_value('txtPhotoAccueilProduit'); ?>" /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtQuantiteProduit">Quantité en stock</label>
                    </div>
                    <div class="col-sm-9">
                        <input required pattern = "[0-9]*" maxlength = 3 type="text" name="txtQuantiteProduit" value="<?php echo set_value('txtQuantiteProduit'); ?>" /><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtMarqueProduit">Marque</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="txtMarqueProduit" value="<?php echo set_value('txtMarqueProduit'); ?>" >
                            <?php foreach ($LesMarques as $UneMarque): echo '<option value = "'.$UneMarque['NOMARQUE'].'">'.$UneMarque['NOM'].'</option>'; endforeach ?>
                        </select><br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtCategorieProduit">Catégorie</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="txtCategorieProduit" value="<?php echo set_value('txtCategorieProduit'); ?>" >
                            <?php foreach ($LesCategories as $UneCategorie): echo '<option value = "'.$UneCategorie['NOCATEGORIE'].'">'.$UneCategorie['LIBELLE'].'</option>'; endforeach ?>
                        </select><br/>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="submit" name="submit" value="• Ajouter un produit •" />
                    </div>
                </div>
                <input class="input-file" required pattern = "[a-zA-Z0-9.]*" type="file" accept=".jpg, .JPG, .jpeg" name="txtPhotoProduit" id="txtPhotoProduit"/><br/>
                <input class="input-file" required pattern = "[a-zA-Z0-9.]*" type="file" accept=".jpg, .JPG, .jpeg" name="txtPhotoBisProduit"  id="txtPhotoBisProduit"/><br/>
                <input class="input-file" required pattern = "[a-zA-Z0-9.]*" type="file" accept=".jpg, .JPG, .jpeg" name="txtPhotoAccueilProduit" id="txtPhotoAccueilProduit"/><br/>            

            </form>
        </div>
    </div>
</div>