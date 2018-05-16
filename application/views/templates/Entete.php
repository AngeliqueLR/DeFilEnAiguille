<html>
    <head>
        <title>De fil en aiguille</title>
        <style type = 'text/css'>
            select[name=tbxCategorieProduit], select
            {
                width : 175px;
                height : 21px;
            }
            select[name=tbxMarqueProduit], select
            {
                width : 175px;
                height : 21px;
            }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            /* Remove the navbar's default margin-bottom and rounded borders */ 
            .navbar 
            {
                margin-bottom: 0;
                border-radius: 0;
            }
            
            /* Add a gray background color and some padding to the footer */
            footer 
            {
                background-color: #f2f2f2;
                padding: 25px;
            }
            
            .carousel-inner img 
            {
                width: 100%; /* Set width to 100% */
                margin: auto;
                min-height:200px;
            }

            /* Hide the carousel text when the screen is less than 600 pixels wide */
            @media (max-width: 600px) 
            {
                .carousel-caption 
                {
                    display: none; 
                }
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Logo</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo site_url('Visiteur/Accueil') ?>"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
                        <?php if ($this->session->statut=='Administrateur') : ?>
                            <li class="active"><a href="<?php echo site_url('Administrateur/ajouterUnProduit') ?>">Ajouter un produit</a></li>&nbsp;&nbsp;
                            <li class="active"><a href="<?php echo site_url('Administrateur/ajouterUneMarque') ?>">Ajouter une marque</a></li>&nbsp;&nbsp;
                            <li class="active"><a href="<?php echo site_url('Administrateur/ajouterUneCategorie') ?>">Ajouter une catégorie</a></li>&nbsp;&nbsp;
                            <li class="active"><a href="<?php echo site_url('Administrateur/voirClients') ?>">Voir les clients</a></li>&nbsp;&nbsp;    
                            <li class="active"><a href="<?php echo site_url('Administrateur/HistoriqueCommandes') ?>">Voir l'historique des commandes</a></li>&nbsp;&nbsp;    
                            <li class="active"><a href="<?php echo site_url('Administrateur/CommandesNonTraitees') ?>">Voir les commandes non traitées</a></li>&nbsp;&nbsp;    
                        <?php endif; ?>    
                        <li class="active"><a href="<?php echo site_url('Visiteur/AfficherCatalogue') ?>">Catalogue</a></li>&nbsp;&nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($this->session->statut=='Client' or is_null($this->session->statut)) : ?>
                            <li class="active"><a href="<?php echo site_url('Visiteur/VoirPanier') ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Panier</a></li>&nbsp;&nbsp; 
                        <?php endif; ?>    
                        <?php if (!is_null($this->session->identifiant)) : ?>
                            <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo ' Bonjour : <B>'.$this->session->prenom.' '.$this->session->nom.'</B>&nbsp;&nbsp;';?></a></li>
                            <li class="active"><a href="<?php echo site_url('Visiteur/seDeconnecter') ?>"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>&nbsp;&nbsp; 
                        <?php else : ?>
                            <li class="active"><a href="<?php echo site_url('Visiteur/seConnecter') ?>"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>&nbsp;&nbsp;
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav> 

        <?php
            if($Catalogue == 'oui') :
        ?>
            <br/><br/>
            <div class="container text-center">    
                <div class="row">
                    <div class="col-sm-3 well">
                    <div class="well">
                        <p>De Fil en Aiguille</p>
                        <img src="<?php echo img_url('LOGO.jpg');?>" class="img-circle" height="65" width="65" alt="Avatar">
                    </div>
                    <div class="well">
                        <ul><a href="<?php echo site_url('Visiteur/listerLesArticlesAvecPagination') ?>">• Catalogue (par 3) •</a></ul>
                        <form action="<?php echo site_url('Visiteur/afficherRecherche'); ?>" method = "GET" accept-charset = "UTF-8">
                            <div class="form-group input-group">
                                <input name="txtRechercher" type="keywords" class="form-control" placeholder="Rechercher.." autocomplete = "on">
                                <span class="input-group-btn" height="40">
                                    <button class="btn btn-default" type="button" height="34">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>        
                            </div>
                        </form>
                    </div>
                    <div class="well">
                        <ul>• Categories •
                            <p>
                                <?php
                                    foreach ($lesCategories as $uneCategorie):
                                        echo '<li>'.anchor('Visiteur/AfficherCatalogueParCategorie/'.$uneCategorie['NOCATEGORIE'], $uneCategorie['LIBELLE']).'</li>';
                                    endforeach;
                                ?>
                            </p>
                        </ul>
                    </div>
                    <div class="well">
                        <ul>• Marques •
                            <p>
                                <?php
                                    foreach ($lesMarques as $uneMarque):
                                        echo '<li>'.anchor('Visiteur/AfficherCatalogueParMarque/'.$uneMarque['NOMARQUE'], $uneMarque['NOM']).'</a></li>';
                                    endforeach;
                                ?>
                            </p>
                        </ul>
                    </div>
                    <div class="well">
                        <ul>• Dates d'ajout •
                            <p>
                                <li><?php echo anchor('Visiteur/AfficherCatalogueParDate/1/','Inférieur ou égale à 5 jours');?></li>
                                <li><?php echo anchor('Visiteur/AfficherCatalogueParDate/2/','Entre 5 et 15 jours');?></li>
                                <li><?php echo anchor('Visiteur/AfficherCatalogueParDate/3/','Supérieur à 15 jours');?></li>
                            </p>
                        </ul>
                    </div>
                </div>
        <?php
            endif;
        ?>

