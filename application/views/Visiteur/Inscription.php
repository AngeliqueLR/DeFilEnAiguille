<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>

    <?php
        echo form_open('Visiteur/Inscription');
        echo form_label('Nom ','txtNom'); // creation d'un label devant la zone de saisie
            echo form_input('txtNom', set_value('txtNom')).'<br/>';
        echo form_label('Prénom ','txtPrenom'); // creation d'un label devant la zone de saisie
            echo form_input('txtPrenom', set_value('txtPrenom')).'<br/>';    
        echo form_label('Adresse ','txtAdresse'); // creation d'un label devant la zone de saisie
            echo form_input('txtAdresse', set_value('txtAdresse')).'<br/>';
        echo form_label('Code Postal ','txtCodePostal'); // creation d'un label devant la zone de saisie
            echo form_input('txtCodePostal', set_value('txtCodePostal')).'<br/>';
        echo form_label('Ville ','txtVille'); // creation d'un label devant la zone de saisie
            echo form_input('txtVille', set_value('txtVille')).'<br/>';
        echo form_label('Mail ','txtEMail'); // creation d'un label devant la zone de saisie
            echo form_input('txtEMail', set_value('txtEMail')).'<br/>';
        echo form_label('Mot de passe ','txtMotDePasse');
            echo form_password('txtMotDePasse', set_value('txtMotDePasse')).'<br/>';
        echo form_label('Confirmation de mot de passe ','txtConfMotDePasse');
            echo form_password('txtConfMotDePasse', set_value('txtConfMotDePasse')).'<br/>';
        echo form_submit('submit', '• Inscription •');
            echo form_close();
    ?>
</div>