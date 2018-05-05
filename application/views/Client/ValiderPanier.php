<div class="well">
    <h2><?php echo $TitreDeLaPage ?></h2>

    <?php
        echo form_open('Client/ValiderPanier');
        echo form_label('Adresse de livraison : ').'<br/>';
        echo form_label('Nom : ','txtNom'); // creation d'un label devant la zone de saisie
            echo form_input('txtNom', set_value('txtNom')).'<br/>';
        echo form_label('Prénom : ','txtPrenom'); // creation d'un label devant la zone de saisie
            echo form_input('txtPrenom', set_value('txtPrenom')).'<br/>';    
        echo form_label('Adresse : ','txtAdresse'); // creation d'un label devant la zone de saisie
            echo form_input('txtAdresse', set_value('txtAdresse')).'<br/>';
        echo form_label('Code Postal : ','txtCodePostal'); // creation d'un label devant la zone de saisie
            echo form_input('txtCodePostal', set_value('txtCodePostal')).'<br/>';
        echo form_label('Ville : ','txtVille'); // creation d'un label devant la zone de saisie
            echo form_input('txtVille', set_value('txtVille')).'<br/><br/>';
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
