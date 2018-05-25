<div class="well" id="well">
    <div class="container" id="container">
        <h2 id="TitrePage"><?php echo $TitreDeLaPage ?></h2><br/>
        <?php 
            echo validation_errors();
            echo form_open('Client/ModifierClient/'.$NoClient) 
        ?>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtNom">Nom</label>
                </div>
                <div class="col-sm-9">
                    <input required pattern = "[a-zA-ZÀ-ÿ ]*" maxlength = 30 type="text" name="txtNom" value="<?php echo $InfoClient['NOM']; ?>" /><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtPrenom">Prénom</label>
                </div>
                <div class="col-sm-9">
                    <input required pattern = "[a-zA-ZÀ-ÿ -]*" maxlength = 30 type="text" name="txtPrenom" value="<?php echo $InfoClient['PRENOM']; ?>"/><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtAdresse">Adresse</label>
                </div>
                <div class="col-sm-9">
                    <input required pattern = "[a-zA-Z0-9À-ÿ, ]*" maxlength = 75 type="text" name="txtAdresse" value="<?php echo $InfoClient['ADRESSE']; ?>" /><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtCP">Code Postal</label>
                </div>
                <div class="col-sm-9">
                    <input required pattern = "[0-9]*" minlength = 5 maxlength = 5 type="text" name="txtCP" value="<?php echo $InfoClient['CODEPOSTAL']; ?>" /><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtVille">Ville</label>
                </div>
                <div class="col-sm-9">
                    <input required pattern = "[a-zA-Z -]*" maxlength = 50 type="text" name="txtVille" value="<?php echo $InfoClient['VILLE']; ?>" /><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtEmail">Adresse e-mail</label>
                </div>
                <div class="col-sm-9">
                    <input required pattern = "[a-zA-Z0-1.-_@]*" maxlength = 50 type="text" name="txtEmail" value="<?php echo $InfoClient['EMAIL']; ?>" /><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtMDP">Mot de passe</label>
                </div>
                <div class="col-sm-9">
                    <input required type="password" minlength = 6 name="txtMDP" value="<?php echo $InfoClient['MOTDEPASSE']; ?>" /><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtConfMDP">Confirmation MDP</label>
                </div>
                <div class="col-sm-9">
                    <input type="password" minlength = 6 name="txtConfMDP" /><br/>

            <?php
                if($this->input->post("txtMDP") != $this->input->post("txtConfMDP"))
                {
                    echo '<script language="Javascript">alert("Les mots de passe doivent être identiques.")</script>';
                }
            ?>

                </div>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" name="submit" value="• Modifier mes infos •" />
                </div>
            </div>
        </form>
    </div>
</div>