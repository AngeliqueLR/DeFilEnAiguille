<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php 
        echo validation_errors();
        echo form_open('Administrateur/ModifierProduit/'.$NoProduit.'/'.$Qte) 
    ?>
        <label for="txtNomProduit">Nom du produit</label>
            <input pattern = "[a-zA-ZÀ-ÿ ]*" maxlength = 50 type="input" name="txtNomProduit" value="<?php echo $InfoProduits['LIBELLE']; ?>" /><br/>

        <label for="txtDetailsProduit">Détails de l'article</label>
            <textarea  maxlenght = 300 name="txtDetailsProduit"><?php echo $InfoProduits['DETAIL']; ?></textarea><br/>

        <label for="txtPrixProduit">Prix HT du produit</label>
            <input pattern = "[0-9,.]*" maxlength = 5 type="input" name="txtPrixProduit" value="<?php echo $InfoProduits['PRIXHT']; ?>" /><br/>
        
        <label for="txtTVAProduit">Taux TVA du produit (en %)</label>
            <input pattern = "[0-9,.]*" maxlength = 5 type="input" name="txtTVAProduit" value="<?php echo $InfoProduits['TAUXTVA']; ?>" /><br/>

        <label for="txtPromotion">Taux de promotion (en %)</label>
            <input pattern = "[0-9,.]*" type="input" name="txtPromotion" value="<?php echo $InfoProduits['Promotion']; ?>" /><br/>

        <label for="txtPhotoProduit">Première photo du produit</label>
            <input pattern = "[a-zA-Z0-9.]*" type="input" name="txtPhotoProduit" value="<?php echo $InfoProduits['NOMIMAGE']; ?>" /><br/>

        <label for="txtPhotoBisProduit">Deuxième photo du produit</label>
            <input pattern = "[a-zA-Z0-9.]*" type="input" name="txtPhotoBisProduit" value="<?php echo $InfoProduits['NOMIMAGEBIS']; ?>" /><br/>

        <label for="txtPhotoAccueilProduit">Photo du produit pour le carousel</label>
            <input pattern = "[a-zA-Z0-9.]*" type="input" name="txtPhotoAccueilProduit" value="<?php echo $InfoProduits['NOMIMAGEACCEUIL']; ?>" /><br/> 

        <label for="txtQuantiteProduit">Quantité en stock</label>
            <input pattern = "[0-9]*" maxlength = 3 type="input" name="txtQuantiteProduit" value="<?php echo $InfoProduits['QUANTITEENSTOCK']; ?>" /><br/>

        <label for="txtMarqueProduit">Marque du produit</label>
            <select name="txtMarqueProduit" value="<?php echo $MarqueCategorie['NOM']; ?>" >
                <?php foreach ($LesMarques as $UneMarque): echo '<option value = "'.$UneMarque['NOMARQUE'].'">'.$UneMarque['NOM'].'</option>'; endforeach ?>
            </select><br/>

        <label for="txtCategorieProduit">Catégorie du produit</label>
            <select name="txtCategorieProduit" value="<?php echo $MarqueCategorie['LIBELLE']; ?>" >
                <?php foreach ($LesCategories as $UneCategorie): echo '<option value = "'.$UneCategorie['NOCATEGORIE'].'">'.$UneCategorie['LIBELLE'].'</option>'; endforeach ?>
            </select><br/>

        <label for="txtDisponible">Disponibilité du produit</label>
            <select name="txtDisponible" value="<?php echo set_value('txtDisponible'); ?>" >
                <option value = "1">Disponible</option>
                <option value = "0">Indisponible</option>
            </select><br/>

        <input type="submit" name="submit" value="• Modifier ce produit •" />
        
    </form>
</div>