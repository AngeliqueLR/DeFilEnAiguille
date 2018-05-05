<?php
    class Client extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('cart');           
            $this->load->model('ModeleUtilisateur');
            $this->load->model('ModeleArticle');

            $this->load->library('session');
            if ($this->session->statut==NULL | $this->session->statut=='Administrateur')
            {
                $this->load->helper('url');
                redirect('/Visiteur/seConnecter');
            }
        }

        
        public function ValiderPanier($pNoProduit = NULL, $pQte = NULL)
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->library('email');

            $Catalogue['Catalogue'] = 'non';
            $DonneesInjectees['TitreDeLaPage'] = 'Validation de votre panier';
            $NoClient =implode($this->ModeleUtilisateur->retournerNumeroUtilisateur($this->session->identifiant));
            $DonneesInjectees['noClient'] = $NoClient;
            $DonneesInjectees['eMail'] = $this->session->identifiant;
            $DonneesInjectees['InfoClient'] = $this->ModeleUtilisateur->retournerInfoUtilisateur('EMAIL like  \''.$this->session->identifiant.'\'');

            $this->form_validation->set_rules('txtNom', 'required');
            $this->form_validation->set_rules('txtPrenom', 'required');
            $this->form_validation->set_rules('txtAdresse', 'required');
            $this->form_validation->set_rules('txtCodePostal', 'required');
            $this->form_validation->set_rules('txtVille', 'required');

            if (!($this->input->post('submit')))
            {
                $this->load->view('templates/Entete', $Catalogue);
                $this->load->view('Client/ValiderPanier', $DonneesInjectees);                
                $this->load->view('templates/PiedDePage');
            
            }
            else
            {
                if ($pNoProduit == NULL)
                {
                    $DonneesAInserer = array('NOCLIENT' => $NoClient, 'DATECOMMANDE' => date('y-m-d'), 'ETAT' => '0');
                    $this->ModeleArticle->AjoutCommande($DonneesAInserer);
                    $numCommande = implode($this->ModeleArticle->retournerIdDerniereCommande());
                    foreach ($this->cart->contents() as $Produit):
                        $DonneesInserer = array('NOCOMMANDE' => $numCommande, 'NOPRODUIT' => $Produit['id'], 'QUANTITECOMMANDEE' => $Produit['qty']);
                        $QteAModifier = 2; //'QUANTITEENSTOCK - '. $Produit['qty'];
                        $DonneesAModifier = array('QUANTITEENSTOCK' => $QteAModifier);
                        $this->ModeleArticle->AjoutLigne($DonneesInserer);
                        $this->ModeleArticle->ModificationQte($DonneesAModifier, $Produit['id']);
                    endforeach;

                    $this->email->from('lerouxangelique.alr@gmail.com', 'De fil en aiguille');
                    //$this->email->to($Utilisateur['EMAIL']); 
                    $this->email->to('angelique.le-roux@gmx.fr');
                    $this->email->subject('Merci de votre commande!');
                    $message = 'Bonjour '. $this->session->prenom.' '.$this->session->nom.', 
Nous vous confirmons l\'enregistrement de votre commande sur notre site "De fil en aiguille". 
    
Les produits que vous avez commandez sont : 

';
foreach ($this->cart->contents() as $Produit):
    $message = $message + $Produit['name'].' en '.$Produit['qty'].' exemplaire(s).
    
    ';
endforeach;

$message = $message + 'Merci de votre confiance et à bientôt.';
                        $this->email->message($message);	

                        if (!$this->email->send())
                        {
                            $this->email->print_debugger();
                        }
                }            
                else
                {
                    $DonneesAInserer = array('NOCLIENT' => $NoClient, 'DATECOMMANDE' => date('y-m-d'), 'ETAT' => '0');
                    $this->ModeleArticle->AjoutCommande($DonneesAInserer);
                    $numCommande = implode($this->ModeleArticle->retournerIdDerniereCommande());
                    $DonneesInserer = array('NOCOMMANDE' => $numCommande, 'NOPRODUIT' => $pNoProduit, 'QUANTITE' => $pQte);
                    $QteAModifier = 2; //'QUANTITEENSTOCK - '. $Produit['qty'];
                    $DonneesAModifier = array('QUANTITEENSTOCK' => $QteAModifier);
                    $this->ModeleArticle->AjoutLigne($DonneesInserer);
                    $this->ModeleArticle->ModificationQte($DonneesAModifier, $pNoProduit);

                    $this->email->from('lerouxangelique.alr@gmail.com', 'De fil en aiguille');
                    //$this->email->to($Utilisateur['EMAIL']); 
                    $this->email->to('angelique.le-roux@gmx.fr');
                    $this->email->subject('Merci de votre commande!');
                    $message = 'Bonjour '. $this->session->prenom.' '.$this->session->nom.', 
Nous vous confirmons l\'enregistrement de votre commande sur notre site "De fil en aiguille". 
    
Vous avez commandez :

'.implode($this->ModeleArticle->NomProduit).' en '.$pQte.' exemplaire(s).

Merci de votre confiance et à bientôt.';
                        $this->email->message($message);	

                        if (!$this->email->send())
                        {
                            $this->email->print_debugger();
                        }
                }
                         
                $this->load->helper('url');
                redirect('Visiteur/AfficherCatalogue');
            }
        }
    }
?>