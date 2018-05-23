<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>

    <?php
        echo form_open('Visiteur/Inscription');
        echo form_label('Nom ','txtNom'); // creation d'un label devant la zone de saisie
            echo form_input('txtNom', set_value('txtNom'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ -]*', 'maxlength' => 30)).'<br/>';
        echo form_label('Prénom ','txtPrenom'); // creation d'un label devant la zone de saisie
            echo form_input('txtPrenom', set_value('txtPrenom'), array('required' => 'required', 'pattern' => '[a-zA-ZÀ-ÿ -]*', 'maxlength' => 30)).'<br/>';    
        echo form_label('Adresse ','txtAdresse'); // creation d'un label devant la zone de saisie
            echo form_input('txtAdresse', set_value('txtAdresse'), array('required' => 'required', 'pattern' => '[a-zA-Z0-9À-ÿ, ]*', 'maxlength' => 75)).'<br/>';
        echo form_label('Code Postal ','txtCodePostal'); // creation d'un label devant la zone de saisie
            echo form_input('txtCodePostal', set_value('txtCodePostal'), array('required' => 'required', 'pattern' => '[0-9]*', 'maxlength' => 5, 'minlength' => 5)).'<br/>';
        echo form_label('Ville ','txtVille'); // creation d'un label devant la zone de saisie
            echo form_input('txtVille', set_value('txtVille'), array('required' => 'required', 'pattern' => '[a-zA-Z -]*', 'maxlength' => 50)).'<br/>';
        echo form_label('Mail ','txtEMail'); // creation d'un label devant la zone de saisie
            echo form_input('txtEMail', set_value('txtEMail'), array('required' => 'required', 'pattern' => '[a-zA-Z0-1.-_@]*', 'maxlength' => 50)).'<br/>';
        echo form_label('Mot de passe ','txtMotDePasse');
            echo form_password('txtMotDePasse', set_value('txtMotDePasse'), array('required' => 'required', 'minlength' => 6)).'<br/>';
        echo form_label('Confirmation de mot de passe ','txtConfMotDePasse');
            echo form_password('txtConfMotDePasse', set_value('txtConfMotDePasse'), array('required' => 'required', 'minlength' => 6)).'<br/>';
        echo form_submit('submit', '• Inscription •');
            echo form_close();
    ?>
</div>