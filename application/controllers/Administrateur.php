<?php
    class Administrateur extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModeleArticle');
            $this->load->model('ModeleUtilisateur');
            $this->load->library('email');
            $this->load->helper('form');         
            $this->load->library('form_validation');
            $this->load->helper('url');
            $this->load->helper('assets');

            $this->load->library('session');
            if ($this->session->statut=='Client')
            {
                $this->load->helper('url');
                redirect('/Visiteur/Accueil');
            }
            elseif (is_null($this->session->statut))
            {
                $this->load->helper('url');
                redirect('/Visiteur/seConnecter');
            }
        }

        public function ajouterUnProduit()
        {
            $Catalogue['Catalogue'] = 'ajout';

            $dateAjout = date('Y-m-d');

            $DonneesEnvoyees['TitreDeLaPage'] = 'Ajouter un produit au catalogue';
            $DonneesEnvoyees['LesMarques'] = $this->ModeleArticle->retournerMarques();
            $DonneesEnvoyees['LesCategories'] = $this->ModeleArticle->retournerCategories();
            
            //regles de validations
            $this->form_validation->set_rules('txtNomProduit', 'required');
            $this->form_validation->set_rules('txtPrixProduit', 'required');
            $this->form_validation->set_rules('txtTVAProduit', 'required');
            $this->form_validation->set_rules('txtPhotoProduit', 'required');
            $this->form_validation->set_rules('txtPhotoBisProduit', 'required');
            $this->form_validation->set_rules('txtQuantiteProduit', 'required');
            $this->form_validation->set_rules('txtPhotoAccueilProduit', 'required');
            $this->form_validation->set_rules('txtDetailsProduit', 'required');
            $this->form_validation->set_rules('txtMarqueProduit', 'required');
            $this->form_validation->set_rules('txtCategorieProduit', 'required');

            if ($this->input->post('submit'))
            {
                $DonneesAInserer = array('NOCATEGORIE' => $this->input->post('txtCategorieProduit'), 'NOMARQUE' => $this->input->post('txtMarqueProduit'), 
                'LIBELLE' => $this->input->post('txtNomProduit'), 'DETAIL' => $this->input->post('txtDetailsProduit'),
                'PRIXHT' => $this->input->post('txtPrixProduit'), 'TAUXTVA' => $this->input->post('txtTVAProduit'),
                'NOMIMAGE' => $this->input->post('txtPhotoProduit'), 'NOMIMAGEBIS' => $this->input->post('txtPhotoBisProduit'),
                'QUANTITEENSTOCK' => $this->input->post('txtQuantiteProduit'), 'DATEAJOUT' => $dateAjout,
                'NOMIMAGEACCEUIL' => $this->input->post('txtPhotoAccueilProduit'), 'DISPONIBLE' => '1', 'Promotion' => '0');

                $this->ModeleArticle->insererUnProduit($DonneesAInserer);
                $this->load->helper('url');
                redirect('/Administrateur/ajouterUnProduit');
            }
            else 
            {                
                //formulaire non validé
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Administrateur/ajouterUnProduit', $DonneesEnvoyees);
                $this->load->view('templates/PiedDePage');        
            }
        }

        public function ajouterUneMarque()
        {
            $Catalogue['Catalogue'] = 'ajout';

            $DonneesEnvoyees['TitreDeLaPage'] = 'Ajouter une marque au catalogue';
            
            //regles de validations
            $this->form_validation->set_rules('txtNomMarque', 'required');
            
            if ($this->input->post('submit'))
            {
                $DonneesAInserer = array('NOM' => $this->input->post('txtNomMarque'));

                $this->ModeleArticle->insererUneMarque($DonneesAInserer);
                $this->load->helper('url');
                redirect('/Administrateur/ajouterUneMarque');
            }
            else 
            {                
                //formulaire non validé
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Administrateur/ajouterUneMarque', $DonneesEnvoyees);
                $this->load->view('templates/PiedDePage');        
            }
        }

        public function ajouterUneCategorie()
        {
            $Catalogue['Catalogue'] = 'ajout';
            
            $DonneesEnvoyees['TitreDeLaPage'] = 'Ajouter une marque au catalogue';
            
            //regles de validations
            $this->form_validation->set_rules('txtNomCategorie', 'required');
            
            if ($this->input->post('submit'))
            {
                $DonneesAInserer = array('LIBELLE' => $this->input->post('txtNomCategorie'));

                $this->ModeleArticle->insererUneCategorie($DonneesAInserer);
                $this->load->helper('url');
                redirect('/Administrateur/ajouterUneCategorie');
            }
            else 
            {                
                //formulaire non validé
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Administrateur/ajouterUneCategorie', $DonneesEnvoyees);
                $this->load->view('templates/PiedDePage');        
            }
        }

        public function ModifierProduit($pNoProduit, $pQte)
        {
            $Catalogue['Catalogue'] = 'non';

            $DonneesEnvoyees['TitreDeLaPage'] = 'Modifier '.implode($this->ModeleArticle->NomProduit($pNoProduit));
            $DonneesEnvoyees['LesMarques'] = $this->ModeleArticle->retournerMarques();
            $DonneesEnvoyees['LesCategories'] = $this->ModeleArticle->retournerCategories();
            $DonneesEnvoyees['NoProduit'] = $pNoProduit;
            $DonneesEnvoyees['Qte'] = $pQte;
            $DonneesEnvoyees['InfoProduits'] = $this->ModeleArticle->retournerProduit($pNoProduit);
            $DonneesEnvoyees['MarqueCategorie'] = $this->ModeleArticle->MarqueCategorie($pNoProduit);

            //regles de validations
            $this->form_validation->set_rules('txtNomProduit', 'required');
            $this->form_validation->set_rules('txtPrixProduit', 'required');
            $this->form_validation->set_rules('txtTVAProduit', 'required');
            $this->form_validation->set_rules('txtPromotion', 'required');
            $this->form_validation->set_rules('txtPhotoProduit', 'required');
            $this->form_validation->set_rules('txtPhotoBisProduit', 'required');
            $this->form_validation->set_rules('txtPhotoAccueilProduit', 'required');
            $this->form_validation->set_rules('txtQuantiteProduit', 'required');
            $this->form_validation->set_rules('txtDetailsProduit', 'required');
            $this->form_validation->set_rules('txtMarqueProduit', 'required');
            $this->form_validation->set_rules('txtCategorieProduit', 'required');
            $this->form_validation->set_rules('txtDisponible', 'required');

            if ($this->input->post('submit'))
            {
                if($pQte == 0)
                {
                    $EMail = $this->ModeleUtilisateur->retournerEMails($pNoProduit);
                    foreach ($EMail as $Mail):
                        $this->email->from('lerouxangelique.alr@gmail.com', 'De fil en aiguille');
                        $this->email->to($Mail['EMAIL']); 
                        //$this->email->to('angelique.le-roux@gmx.fr');
                        $this->email->subject('Information remise en stock');
                        $message = 'Bonjour '.implode(" ", $this->ModeleUtilisateur->retournerNomPrenom($Mail['EMAIL'])).', 
Nous vous informons que le produit '.implode($this->ModeleArticle->NomProduit($pNoProduit)).' a bien été remis en stock. 

Venez vite le commander.☺';
                        $this->email->message($message);	

                        if (!$this->email->send())
                        {
                            $this->email->print_debugger();
                        }
                    endforeach;
                    $this->ModeleArticle->SupprimerAlerter($pNoProduit);
                }

                if ($this->input->post('PhotoProduit') != null and $this->input->post('PhotoProduit') != $this->input->post('txtPhotoProduit'))
                {
                    $cheminPhoto = $this->input->post('PhotoProduit');
                }
                else
                {
                    $cheminPhoto = $this->input->post('txtPhotoProduit');
                }

                if ($this->input->post('PhotoProduitBis') != null and $this->input->post('PhotoProduitBis') != $this->input->post('txtPhotoBisProduit'))
                {
                    $cheminPhotoBis = $this->input->post('PhotoProduitBis');
                }
                else
                {
                    $cheminPhotoBis = $this->input->post('txtPhotoBisProduit');
                }

                if ($this->input->post('PhotoProduitAcceuil') != null and $this->input->post('PhotoProduitAcceuil') != $this->input->post('txtPhotoAccueilProduit'))
                {
                    $cheminPhotoAccueil = $this->input->post('PhotoProduitAcceuil');
                }
                else
                {
                    $cheminPhotoAccueil = $this->input->post('txtPhotoAccueilProduit');
                }

                $DonneesAModifier = array('NOCATEGORIE' => $this->input->post('txtCategorieProduit'), 'NOMARQUE' => $this->input->post('txtMarqueProduit'), 
                'LIBELLE' => $this->input->post('txtNomProduit'), 'DETAIL' => $this->input->post('txtDetailsProduit'),
                'PRIXHT' => $this->input->post('txtPrixProduit'), 'TAUXTVA' => $this->input->post('txtTVAProduit'),
                'NOMIMAGE' => $cheminPhoto, 'NOMIMAGEBIS' => $cheminPhotoBis,
                'NOMIMAGEACCEUIL' => $cheminPhotoAccueil,'QUANTITEENSTOCK' => $this->input->post('txtQuantiteProduit'),
                'DISPONIBLE' => $this->input->post('txtDisponible'), 'Promotion' => $this->input->post('txtPromotion'));

                $this->ModeleArticle->ModifierProduit($DonneesAModifier, $pNoProduit);
                $this->load->helper('url');
                redirect('/Visiteur/AfficherCatalogue');
            }
            else 
            {                
                //formulaire non validé
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Administrateur/ModifierProduit', $DonneesEnvoyees);
                $this->load->view('templates/PiedDePage');        
            }  
        }

        public function voirClients()
        {
            $DonneesAEnvoyer['InfoClients'] = $this->ModeleUtilisateur->retournerInfoClients();
            $Catalogue['Catalogue'] = 'non';

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Administrateur/VoirClients', $DonneesAEnvoyer);
            $this->load->view('templates/PiedDePage');
        }

        public function CommandesNonTraitees($pNoClient = NULL)
        {
            $DonneesAEnvoyer['NoClient'] = $pNoClient;
            $Catalogue['Catalogue'] = 'commandes';
            $Catalogue['NoClient'] = $pNoClient;
            $Commandes = $this->ModeleUtilisateur->retournerNoCommandesNonTraitees($pNoClient); 
            //le numéro commande peut être égal à NULL et donc retourne les commandes passées par tous les utilisateurs
            if ($pNoClient != NULL):
                $Catalogue['NomPrenom'] = $this->ModeleUtilisateur->retournerNomPrenom(implode($this->ModeleUtilisateur->retournerIdentifiant($pNoClient)));
            endif; 
            if ($Commandes != NULL)
            {
                foreach ($Commandes as $UneCommande) 
                {
                    $ProduitsDuneCommande[] = $this->ModeleUtilisateur->CommandesEnAttentes($pNoClient, implode($UneCommande));
                }
                $DonneesAEnvoyer['lesCommandes'] = $ProduitsDuneCommande;
                //retourne le libelle, la quantite commandee et le numero de la commande
            }
            else
            {
                $DonneesAEnvoyer['lesCommandes'] = NULL;
                //ne renvoie rien
            }
            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Administrateur/CommandesNonTraitees', $DonneesAEnvoyer);
            $this->load->view('templates/PiedDePage');
        }

        public function HistoriqueCommandes($pNoClient = NULL)
        {
            $DonneesAEnvoyer['NoClient'] = $pNoClient;
            $Catalogue['NoClient'] = $pNoClient;
            $Catalogue['Catalogue'] = 'commandes';
            $Commandes = $this->ModeleUtilisateur->retournerHistoriqueCommandes($pNoClient); 
            //le numéro commande peut être égal à NULL et donc retourne les commandes passées par tous les utilisateurs
            if ($pNoClient != NULL):
                $Catalogue['NomPrenom'] = $this->ModeleUtilisateur->retournerNomPrenom(implode($this->ModeleUtilisateur->retournerIdentifiant($pNoClient)));
            endif; 
            if ($Commandes != NULL)
            {
                foreach ($Commandes as $UneCommande) 
                {
                    $ProduitsDuneCommande[] = $this->ModeleUtilisateur->CommandesTraitees($pNoClient, implode($UneCommande));
                }
                $DonneesAEnvoyer['lesCommandes'] = $ProduitsDuneCommande;
                //retourne le libelle, la quantite commandee et le numero de la commande
            }
            else
            {
                $DonneesAEnvoyer['lesCommandes'] = NULL;
                //ne renvoie rien
            }
            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Administrateur/HistoriqueCommande', $DonneesAEnvoyer);
            $this->load->view('templates/PiedDePage');
        }

        public function ValiderCommande($pNoCommande, $pNoClient = NULL)
        {
            $this->ModeleArticle->ValiderCommande(array('Etat' => '1'), $pNoCommande);

            $this->load->helper('url');
            redirect('/Administrateur/CommandesNonTraitees/'.$pNoClient);
        }
    }
?>