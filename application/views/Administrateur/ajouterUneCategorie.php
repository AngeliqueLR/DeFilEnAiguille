<div class="col-sm-9">
    
        <h2><?php echo $TitreDeLaPage ?></h2>
        <?php 
            echo validation_errors();
            echo form_open('Administrateur/ajouterUneCategorie') 
        ?>
            <label for="txtNomCategorie">Nom de la catégorie à ajouter</label>
                <input required type="input" name="txtNomCategorie" value="<?php echo set_value('txtNomCategorie'); ?>" /><br/>

            <input type="submit" name="submit" value="• Ajouter cette catégorie •" />
            
        </form>
</div>