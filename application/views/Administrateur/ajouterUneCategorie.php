<div class="col-sm-9">
    <div class="well" id="well">
        <div class="container" id="container2">
                <h2 id="TitrePage"><?php echo $TitreDeLaPage ?></h2>
                <?php 
                    echo validation_errors();
                    echo form_open('Administrateur/ajouterUneCategorie') 
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtNomCategorie">Nom</label>
                </div>
                    <div class="col-sm-9">
                        <input required type="text" name="txtNomCategorie" value="<?php echo set_value('txtNomCategorie'); ?>" /><br/>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="submit" name="submit" value="• Ajouter cette catégorie •" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>