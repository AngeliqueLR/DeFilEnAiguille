<?php
    class Visiteur extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('assets');
            $this->load->library("pagination");
            $this->load->library('cart');           
            $this->load->model('ModeleArticle');          
            $this->load->model('ModeleUtilisateur');          
        }

        public function AfficherCatalogue()
        {
            $Catalogue['Catalogue'] = 'oui';
            $Catalogue['lesCategories'] = $this->ModeleArticle->retournerCategories();
            $Catalogue['lesMarques'] = $this->ModeleArticle->retournerMarques();

            $DonneesEnvoyees['lesProduits'] = $this->ModeleArticle->retournerProduit();
            $DonneesEnvoyees['TitreDePage'] = 'De fil en aiguille trouvez votre petit bonheur par ici';

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/Catalogue', $DonneesEnvoyees, $Catalogue);
            $this->load->view('templates/PiedDePage');            
        }

        public function voirUnProduit($pNoProduit = NULL)
        {
            $Catalogue['Catalogue'] = 'non';

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('txtQuantiteDesiree', 'required');

            $DonneesEnvoyees['unProduit'] = $this->ModeleArticle->retournerProduit($pNoProduit);

            if (empty($DonneesEnvoyees['unProduit']))
            {//pas d'article correspondant à ce numéro
                show_404();
            }

            $DonneesEnvoyees['TitreDePage'] = $DonneesEnvoyees['unProduit']['LIBELLE'];
            //récupère le nom du produit et l'ajoute comme titre

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/VoirUnProduit', $DonneesEnvoyees, $Catalogue);
            $this->load->view('templates/PiedDePage');            
        }

        public function seConnecter()
        {
            $Catalogue['Catalogue'] = 'non';

            $this->load->helper('form');
            $this->load->library('form_validation');

            $DonneesInjectees['TitreDeLaPage'] = 'Connectez-vous!';

            $this->form_validation->set_rules('txtIdentifiant', 'required');
            $this->form_validation->set_rules('txtMotDePasse', 'required');

            if (!($this->input->post('submit')))
            {
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Visiteur/seConnecter', $DonneesInjectees);
                $this->load->view('templates/PiedDePage');
            }
            else
            {  
                $Utilisateur = array( 
                'EMAIL' => $this->input->post('txtIdentifiant'),
                'MOTDEPASSE' => $this->input->post('txtMotDePasse'));

                $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);

                if (!($UtilisateurRetourne == null))
                { 
                    $this->load->library('session');
                    $this->session->identifiant = $UtilisateurRetourne->EMAIL;
                    $this->session->statut = $UtilisateurRetourne->PROFIL;
                    $this->session->nom = $UtilisateurRetourne->NOM;
                    $this->session->prenom = $UtilisateurRetourne->PRENOM;

                    $DonneesInjectees['Identifiant'] = $Utilisateur['EMAIL'];
                    
                    $this->load->helper('url');
                    redirect('/Visiteur/AfficherCatalogue');    
                }
                else
                {
                    $this->load->view('templates/Entete', $Catalogue);
                    $this->load->view('Visiteur/seConnecter', $DonneesInjectees);
                    $this->load->view('templates/PiedDePage');
                }  
            }
        }

        public function Inscription()
        {
            $Catalogue['Catalogue'] = 'non';

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->library('email');

            $DonneesInjectees['TitreDeLaPage'] = 'Inscrivez-vous!';

            $this->form_validation->set_rules('txtNom', 'required');
            $this->form_validation->set_rules('txtPrenom', 'required');
            $this->form_validation->set_rules('txtAdresse', 'required');
            $this->form_validation->set_rules('txtCodePostal', 'required');
            $this->form_validation->set_rules('txtVille', 'required');
            $this->form_validation->set_rules('txtEMail', 'required');
            $this->form_validation->set_rules('txtMotDePasse', 'required');
            $this->form_validation->set_rules('txtConfMotDePasse', 'required');


            if (!($this->input->post('submit')))
            {
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Visiteur/Inscription', $DonneesInjectees);
                $this->load->view('templates/PiedDePage');
            }
            else
            {        
                if ($this->input->post('txtMotDePasse') == $this->input->post('txtConfMotDePasse'))  
                {      
                    $Utilisateur = array('EMAIL' => $this->input->post('txtEMail'));

                    $MailRetourne = $this->ModeleUtilisateur->retournerMail($Utilisateur);

                    if ($MailRetourne == null)
                    { 
                        $DonneesAInserer = array('NOM' => $this->input->post('txtNom'), 'PRENOM' => $this->input->post('txtPrenom'),
                        'ADRESSE' => $this->input->post('txtAdresse'), 'VILLE' => $this->input->post('txtVille'), 'CODEPOSTAL' => $this->input->post('txtCodePostal'), 'EMAIL' => $this->input->post('txtEMail'),
                        'MOTDEPASSE' => $this->input->post('txtMotDePasse'), 'PROFIL'=> 'Client');

                        $this->ModeleUtilisateur->sInscrire($DonneesAInserer);

                        $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);
                        $this->load->library('session');
                        $this->session->identifiant = $UtilisateurRetourne->EMAIL;
                        $this->session->statut = $UtilisateurRetourne->PROFIL;
                        $this->session->nom = $UtilisateurRetourne->NOM;
                        $this->session->prenom = $UtilisateurRetourne->PRENOM;

                        $DonneesInjectees['Identifiant'] = $Utilisateur['EMAIL'];
                        $DonneesInjectees['Nom'] = $this->input->post('Nom');
                        $DonneesInjectees['Prenom'] = $this->input->post('txtPrenom');
                        $DonneesInjectees['MotDePasse'] = $this->input->post('txtMotDePasse');

                        $this->email->from('lerouxangelique.alr@gmail.com', 'De fil en aiguille');
                        $this->email->to($Utilisateur['EMAIL']); 
                        //$this->email->to('angelique.le-roux@gmx.fr');
                        $this->email->subject('Bienvenu sur notre site');
                        $message = 'Bonjour '. $this->input->post('txtPrenom').' '.$this->input->post('txtNom').', 
Nous vous confirmons votre inscription sur notre site "De fil en aiguille". 
        • Votre identifiant est : '.$Utilisateur['EMAIL'].'. 
        • Votre mot de passe : '.$this->input->post('txtMotDePasse').'. 

En espérant que vous trouverez votre bonheur chez nous.☺';
                        $this->email->message($message);	

                        if (!$this->email->send())
                        {
                            $this->email->print_debugger();
                        }
                        
                        $this->load->helper('url');
                        redirect('/Visiteur/AfficherCatalogue');    
                    }
                    else
                    {
                        $this->load->view('templates/Entete', $Catalogue);
                        $this->load->view('Visiteur/Inscription', $DonneesInjectees);
                        $this->load->view('templates/PiedDePage');
                    }  
                }
                else
                {
                    $this->load->view('templates/Entete', $Catalogue);
                    $this->load->view('Visiteur/Inscription', $DonneesInjectees);
                    $this->load->view('templates/PiedDePage');
                }
            }
        }

        public function seDeConnecter() 
        { 
            $Catalogue['Catalogue'] = 'non';

            $this->session->sess_destroy();
            $this->load->helper('url');
            redirect('/Visiteur/AfficherCatalogue');
        }

        public function listerLesArticlesAvecPagination() 
        {
            $Catalogue['Catalogue'] = 'oui';
            $Catalogue['lesCategories'] = $this->ModeleArticle->retournerCategories();
            $Catalogue['lesMarques'] = $this->ModeleArticle->retournerMarques();

            $config = array();
            $config["base_url"] = site_url('Visiteur/listerLesArticlesAvecPagination');
            $config["total_rows"] = $this->ModeleArticle->nombreDArticles();
            $config["per_page"] = 3;
            $config["uri_segment"] = 3;

            $config["first_link"] = "<span class='glyphicon glyphicon-backward'></span> ";
            $config["last_link"] = " <span class='glyphicon glyphicon-forward'></span>";
            $config["next_link"] = "  <span class='glyphicon glyphicon-chevron-right'></span>";
            $config["prev_link"] = "<span class='glyphicon glyphicon-chevron-left'></span>  ";

            $this->pagination->initialize($config);

            $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $DonneesEnvoyees['TitreDeLaPage'] = 'De fil en aiguille trouvez votre petit bonheur par ici';
            $DonneesEnvoyees['LesProduits'] = $this->ModeleArticle->retournerArticlesLimite($config["per_page"], $noPage);
            $DonneesEnvoyees['liensPagination'] = $this->pagination->create_links();
            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/CatalogueAvecPagination', $DonneesEnvoyees, $Catalogue);
            $this->load->view('templates/PiedDePage');  
        }

        public function Accueil()
        {
            $Catalogue['Catalogue'] = 'non';

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/Accueil');
            $this->load->view('templates/PiedDePage');
        }

        public function AfficherCatalogueParCategorie($pNoCategorie)
        {
            $Catalogue['Catalogue'] = 'oui';
            $Catalogue['lesCategories'] = $this->ModeleArticle->retournerCategories();
            $Catalogue['lesMarques'] = $this->ModeleArticle->retournerMarques();

            $DonneesEnvoyees['lesProduits'] = $this->ModeleArticle->retournerArticlesParCategorie($pNoCategorie);
            $DonneesEnvoyees['TitreDePage'] = 'De fil en aiguille trouvez votre petit bonheur par ici';

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/Catalogue', $DonneesEnvoyees, $Catalogue);
            $this->load->view('templates/PiedDePage');            
        }

        public function AfficherCatalogueParMarque($pNoMarque)
        {
            $Catalogue['Catalogue'] = 'oui';
            $Catalogue['lesCategories'] = $this->ModeleArticle->retournerCategories();
            $Catalogue['lesMarques'] = $this->ModeleArticle->retournerMarques();

            $DonneesEnvoyees['lesProduits'] = $this->ModeleArticle->retournerArticlesParMarque($pNoMarque);
            $DonneesEnvoyees['TitreDePage'] = 'De fil en aiguille trouvez votre petit bonheur par ici';

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/Catalogue', $DonneesEnvoyees, $Catalogue);
            $this->load->view('templates/PiedDePage');            
        }

        public function AfficherCatalogueParDate($pDate)
        {
            $Catalogue['Catalogue'] = 'oui';
            $Catalogue['lesCategories'] = $this->ModeleArticle->retournerCategories();
            $Catalogue['lesMarques'] = $this->ModeleArticle->retournerMarques();
            
            $this->load->view('templates/Entete', $Catalogue);
            $DonneesEnvoyees['TitreDePage'] = 'De fil en aiguille trouvez votre petit bonheur par ici';
            $DonneesEnvoyees['lesProduits'] = $this->ModeleArticle->retournerArticlesParDates($pDate);
            $this->load->view('Visiteur/Catalogue', $DonneesEnvoyees, $Catalogue);
            $this->load->view('templates/PiedDePage');            
        }

        public function AjouterPanier($pNumeroProduit, $pNomProduit, $pPrix, $pQuantiteMax, $pCatalogue)
        {            
            if ($pCatalogue == 'non'):
                $NomProduit = implode($this->ModeleArticle->NomProduit($pNumeroProduit));
                $quantite = $this->input->post('txtQuantiteDesiree');
                $produitAjoute = array(
                    'id'      => $pNumeroProduit,
                    'qty'     => $quantite,
                    'price'   => $pPrix,
                    'name'    => $NomProduit,
                    'option'  => $pQuantiteMax,
                );
            
                $this->cart->insert($produitAjoute);

                $this->load->helper('url');
                redirect('Visiteur/VoirUnProduit/'.$pNumeroProduit);
            else:
                if ($this->ModeleArticle->EstDansPanier($pNumeroProduit) == 'faux')
                {
                    $NomProduit = implode($this->ModeleArticle->NomProduit($pNumeroProduit));
                    $produitAjoute = array(
                        'id'      => $pNumeroProduit,
                        'qty'     => 1,
                        'price'   => $pPrix,
                        'name'    => $NomProduit,
                        'option'  => $pQuantiteMax,
                    );
    
                    $this->cart->insert($produitAjoute);
                }               

                $this->load->helper('url');
                redirect('Visiteur/AfficherCatalogue');
            endif;                         
        }

        public function VoirPanier()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $Catalogue['Catalogue'] = 'non';

            $this->load->view('templates/Entete', $Catalogue);
            $this->load->view('Visiteur/Panier');
            $this->load->view('templates/PiedDePage'); 
        }

        public function modifierQteMoins($pNoProduit, $pQte)
        {
            $DonneesAModifier = array(
                'rowid' => $pNoProduit,
                'qty'   => $pQte - 1
            );
        
            $this->cart->update($DonneesAModifier); 

            $this->load->helper('url');
            redirect('Visiteur/VoirPanier');
        }

        public function modifierQtePlus($pNoProduit, $pQte, $QteMax)
        {
            if ($QteMax >= $pQte + 1):
                $DonneesAModifier = array(
                    'rowid' => $pNoProduit,
                    'qty'   => $pQte + 1
                );
            
                $this->cart->update($DonneesAModifier);
            endif;            

            $this->load->helper('url');
            redirect('Visiteur/VoirPanier');
        }
    }
?>