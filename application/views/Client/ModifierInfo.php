<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php 
        echo validation_errors();
        echo form_open('Client/ModifierClient/'.$NoClient) 
    ?>
        <label for="txtNom">Nom</label>
            <input pattern = "[a-zA-ZÀ-ÿ ]*" maxlength = 30 type="input" name="txtNom" value="<?php echo $InfoClient['NOM']; ?>" /><br/>

        <label for="txtPrenom">Prénom</label>
            <input pattern = "[a-zA-ZÀ-ÿ -]*" maxlength = 30 type="input" name="txtPrenom" value="<?php echo $InfoClient['PRENOM']; ?>"/><br/>

        <label for="txtAdresse">Adresse</label>
            <input pattern = "[a-zA-Z0-9À-ÿ, ]*" maxlength = 75 type="input" name="txtAdresse" value="<?php echo $InfoClient['ADRESSE']; ?>" /><br/>
        
        <label for="txtCP">Code Postal</label>
            <input pattern = "[0-9]*" minlength = 5 maxlength = 5 type="input" name="txtCP" value="<?php echo $InfoClient['CODEPOSTAL']; ?>" /><br/>

        <label for="txtVille">Ville</label>
            <input pattern = "[a-zA-Z -]*" maxlength = 50 type="input" name="txtVille" value="<?php echo $InfoClient['VILLE']; ?>" /><br/>

        <label for="txtEmail">Adresse e-mail</label>
            <input pattern = "[a-zA-Z0-1.-_@]*" maxlength = 50 type="input" name="txtEmail" value="<?php echo $InfoClient['EMAIL']; ?>" /><br/>

        <label for="txtMDP">Mot de passe</label>
            <input type="password" minlength = 6 name="txtMDP" value="<?php echo $InfoClient['MOTDEPASSE']; ?>" /><br/>

        <label for="txtConfMDP">Confirmation mot de passe</label>
            <input type="password" minlength = 6 name="txtConfMDP" /><br/>

        <?php
            if($this->input->post("txtMDP") != $this->input->post("txtConfMDP"))
            {
                echo '<script language="Javascript">alert("Les mots de passe doivent être identiques.")</script>';
            }
        ?>

        <input type="submit" name="submit" value="• Modifier mes infos •" />
        
    </form>
</div>