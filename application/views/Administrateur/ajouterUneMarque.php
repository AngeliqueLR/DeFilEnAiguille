<div class="col-sm-9">
    <div class="well" id="well">
        <div class="container" id="container2">
            <h2 id="TitrePage"><?php echo $TitreDeLaPage ?></h2>
            <?php 
                echo validation_errors();
                echo form_open('Administrateur/ajouterUneMarque') 
            ?>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="txtNomMarque">Nom</label>
                    </div>
                    <div class="col-sm-9">
                        <input required type="text" name="txtNomMarque" value="<?php echo set_value('txtNomMarque'); ?>" /><br/>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="submit" name="submit" value="• Ajouter cette marque •" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>