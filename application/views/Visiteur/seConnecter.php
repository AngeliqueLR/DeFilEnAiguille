<div class="well" id="well">
    <div class="container" id="container">
    <h2  id="TitrePage"><?php echo $TitreDeLaPage ?></h2>

    <?php
        if ($Erreur == 'Erreur')
        {
            echo '<script language="Javascript">alert("Erreur dans la saisie du mot de passe ou de l\'identifiant.")</script>';
        }
        echo validation_errors(); // mise en place de la validation
        /* set_value : en cas de non validation les données déjà
        saisies sont réinjectées dans le formulaire */
            echo form_open('Visiteur/seConnecter');
            echo '<div class="row">';
                echo '<div class="col-sm-3">';
                    echo form_label('Identifiant','txtIdentifiant'); // creation d'un label devant la zone de saisie
                echo '</div>';
                echo '<div class="col-sm-9">';
                    echo form_input('txtIdentifiant', set_value('txtIdentifiant'));
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col-sm-3">';
                    echo form_label('Mot de passe','txtMotDePasse');
                echo '</div>';
                echo '<div class="col-sm-9">';
                    echo form_password('txtMotDePasse', set_value('txtMotDePasse'));
                echo '</div>';
            echo '</div>';
            echo '<br/><br/>';
            echo '<div class="row">';
                echo '<div class="col-sm-12">';
                    echo form_submit('submit', '• Se connecter •');
                echo '</div>';
            echo '</div>';
        echo form_close();
    ?>

    <a id="lienInscription" href="<?php echo site_url('Visiteur/Inscription') ?>">Pas encore inscrit, filez par ici!</a>&nbsp;&nbsp;
    </div>
</div>