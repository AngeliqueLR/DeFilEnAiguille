<div class="well" id="well">
    <div class="container" id="container">

        <h2 id="TitrePage"><?php echo $TitreDeLaPage ?></h2>

        <?php
            echo form_open('Client/ValiderPanier/'.$NoProduit.'/'.$Qte.'/'.$QteMax.'/'.$Rowid);
                echo '<br/><h4 class="titreAdresse">Adresse de livraison : </h4><br/>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Nom : ','txtNom'); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo form_input('txtNom',  set_value('txtNom'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ -]*', 'maxlength' => 30)).'<br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Prénom : ', 'txtPrenom'); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo form_input('txtPrenom', set_value('txtPrenom'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ -]*', 'maxlength' => 30)).'<br/>';    
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Adresse : ','txtAdresse'); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo form_input('txtAdresse', set_value('txtAdresse'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ0-9 -]*', 'maxlength' => 75)).'<br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Code Postal : ','txtCodePostal'); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo form_input('txtCodePostal', set_value('txtCodePostal'), array('required' => 'required', 'pattern' => '[0-9]*', 'maxlength' => 5, 'minlength' => 5)).'<br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Ville : ','txtVille'); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo form_input('txtVille', set_value('txtVille'), array('required' => 'required', 'pattern' => "[a-zA-Z -]*", 'maxlength' => 50)).'<br/><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<br/><h4 class="titreAdresse">Adresse de facturation :</h4><br/>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Nom : '); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo '<input type="text" value="'.$InfoClient['NOM'].'" readonly><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Prenom : '); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo '<input type="text" value="'.$InfoClient['PRENOM'].'" readonly><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Adresse : '); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo '<input type="text" value="'.$InfoClient['ADRESSE'].'" readonly><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Code Postal : '); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo '<input type="text" value="'.$InfoClient['CODEPOSTAL'].'" readonly><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                        echo '<div class="col-sm-3">';
                            echo form_label('Ville : '); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo '<input type="text" value="'.$InfoClient['VILLE'].'" readonly><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                        echo form_label('Mail : '); // creation d'un label devant la zone de saisie
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                        echo '<input type="text" value="'.$eMail.'" readonly><br/>';
                    echo '</div>';
                echo '</div>';
                echo '<br/><br/>';
                echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                        echo form_submit('submit', '• Validation de la commande •');
                    echo '</div>';
                echo '</div>';
            echo form_close();
        ?>
    </div>
</div>
