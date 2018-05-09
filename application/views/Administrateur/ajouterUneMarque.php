<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php 
        echo validation_errors();
        echo form_open('Administrateur/ajouterUneMarque') 
    ?>
        <label for="txtNomMarque">Nom de la marque à ajouter</label>
            <input type="input" name="txtNomMarque" value="<?php echo set_value('txtNomMarque'); ?>" /><br/>

        <input type="submit" name="submit" value="• Ajouter cette marque •" />
        
    </form>
</div>