<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>

    <?php
        echo form_open('Client/ValiderPanier/'.$NoProduit.'/'.$Qte.'/'.$QteMax.'/'.$Rowid);
        echo form_label('Adresse de livraison : ').'<br/>';
        echo form_label('Nom : ','txtNom'); // creation d'un label devant la zone de saisie
            echo form_input('txtNom',  set_value('txtNom'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ -]*', 'maxlength' => 30)).'<br/>';
        echo form_label('Prénom : ', 'txtPrenom'); // creation d'un label devant la zone de saisie
            echo form_input('txtPrenom', set_value('txtPrenom'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ -]*', 'maxlength' => 30)).'<br/>';    
        echo form_label('Adresse : ','txtAdresse'); // creation d'un label devant la zone de saisie
            echo form_input('txtAdresse', set_value('txtAdresse'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ0-9 -]*', 'maxlength' => 75)).'<br/>';
        echo form_label('Code Postal : ','txtCodePostal'); // creation d'un label devant la zone de saisie
            echo form_input('txtCodePostal', set_value('txtCodePostal'), array('required' => 'required', 'pattern' => '[0-9]*', 'maxlength' => 5, 'minlength' => 5)).'<br/>';
        echo form_label('Ville : ','txtVille'); // creation d'un label devant la zone de saisie
            echo form_input('txtVille', set_value('txtVille'), array('required' => 'required', 'pattern' => "[a-zA-Z -]*", 'maxlength' => 50)).'<br/><br/>';
        echo form_label('Adresse de facturation :').'<br/>';
        echo form_label('Nom : '); // creation d'un label devant la zone de saisie
            echo $InfoClient['NOM'].'<br/>';
        echo form_label('Prenom : '); // creation d'un label devant la zone de saisie
            echo $InfoClient['PRENOM'].'<br/>';
        echo form_label('Adresse : '); // creation d'un label devant la zone de saisie
            echo $InfoClient['ADRESSE'].'<br/>';
        echo form_label('Code Postal : '); // creation d'un label devant la zone de saisie
            echo $InfoClient['CODEPOSTAL'].'<br/>';
        echo form_label('Ville : '); // creation d'un label devant la zone de saisie
            echo $InfoClient['VILLE'].'<br/>';
        echo form_label('Mail : '); // creation d'un label devant la zone de saisie
            echo $eMail.'<br/>';
        echo form_submit('submit', '• Validation de la commande •');
            echo form_close();
    ?>
</div>
