<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php 
        echo validation_errors();
        echo form_open('Administrateur/ajouterUnProduit') 
    ?>
        <label for="txtNomProduit">Nom du produit</label>
            <input type="input" name="txtNomProduit" value="<?php echo set_value('txtNomProduit'); ?>" /><br/>

        <label for="txtDetailsProduit">Détails de l'article</label>
            <textarea name="txtDetailsProduit" value="<?php echo set_value('txtDetailsProduit'); ?>"></textarea><br/>

        <label for="txtPrixProduit">Prix HT du produit</label>
            <input type="input" name="txtPrixProduit" value="<?php echo set_value('txtPrixProduit'); ?>" /><br/>
        
        <label for="txtTVAProduit">Taux TVA du produit (en %)</label>
            <input type="input" name="txtTVAProduit" value="<?php echo set_value('txtTVAProduit'); ?>" /><br/>

        <label for="txtPhotoProduit">Première photo du produit</label>
            <input type="input" name="txtPhotoProduit" value="<?php echo set_value('txtPhotoProduit'); ?>" /><br/>

        <label for="txtPhotoBisProduit">Deuxième photo du produit</label>
            <input type="input" name="txtPhotoBisProduit" value="<?php echo set_value('txtPhotoBisProduit'); ?>" /><br/>

        <label for="txtQuantiteProduit">Quantité en stock</label>
            <input type="input" name="txtQuantiteProduit" value="<?php echo set_value('txtQuantiteProduit'); ?>" /><br/>

        <label for="txtMarqueProduit">Marque du produit</label>
            <select name="txtMarqueProduit" value="<?php echo set_value('txtMarqueProduit'); ?>" >
                <?php foreach ($LesMarques as $UneMarque): echo '<option value = "'.$UneMarque['NOMARQUE'].'">'.$UneMarque['NOM'].'</option>'; endforeach ?>
            </select><br/>

        <label for="txtCategorieProduit">Catégorie du produit</label>
            <select name="txtCategorieProduit" value="<?php echo set_value('txtCategorieProduit'); ?>" >
                <?php foreach ($LesCategories as $UneCategorie): echo '<option value = "'.$UneCategorie['NOCATEGORIE'].'">'.$UneCategorie['LIBELLE'].'</option>'; endforeach ?>
            </select><br/>

        <input type="submit" name="submit" value="• Ajouter un produit •" />
        
    </form>
</div>