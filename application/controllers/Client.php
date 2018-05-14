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

        
        public function ValiderPanier($pNoProduit = NULL, $pQte = NULL, $pQteMax = NULL, $pRowid = NULL)
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
                if ($pNoProduit === NULL)
                {
                    $DonneesAInserer = array('NOCLIENT' => $NoClient, 'DATECOMMANDE' => date('y-m-d'), 'ETAT' => '0');
                    $this->ModeleArticle->AjoutCommande($DonneesAInserer);
                    $numCommande = implode($this->ModeleArticle->retournerIdDerniereCommande());
                    foreach ($this->cart->contents() as $Produit):
                        $DonneesInserer = array('NOCOMMANDE' => $numCommande, 'NOPRODUIT' => $Produit['id'], 'QUANTITECOMMANDEE' => $Produit['qty']);
                        $QteAModifier = $Produit['option'] - $Produit['qty'];
                        $DonneesAModifier = array('QUANTITEENSTOCK' => $QteAModifier);
                        $this->ModeleArticle->AjoutLigne($DonneesInserer);
                        $this->ModeleArticle->ModificationQte($DonneesAModifier, $Produit['id']);
                    endforeach;

                    $this->email->from('lerouxangelique.alr@gmail.com', 'De fil en aiguille');
                    $this->email->to($this->session->identifiant); 
                    //$this->email->to('angelique.le-roux@gmx.fr');
                    $this->email->subject('Merci de votre commande!');
                    $message = 'Bonjour '. $this->session->prenom.' '.$this->session->nom.',
Nous vous confirmons que votre commande a bien été prise en compte.

L\'adresse de facturation est la suivante : 
        • '.implode("
        ", $this->ModeleUtilisateur->retournerInfoUtilisateur('EMAIL like  \''.$this->session->identifiant.'\'')).'

L\'adresse de livraison est : 
        • '.$this->input->post('txtNom').'
          '.$this->input->post('txtPrenom').'
          '.$this->input->post('txtAdresse').'
          '.$this->input->post('txtCodePostal').'
          '.$this->input->post('txtVille').'
          
Les produits que vous avez commandés sont : 
    '.implode('
    ', $this->ModeleArticle->retournerLesProduits()).'

Le total de votre commande s\'élève à '.$this->cart->format_number($this->cart->total()).'€

Merci de votre confiance.
A bientôt!☺';
        $this->email->message($message);	

                    if (!$this->email->send())
                    {
                        $this->email->print_debugger();
                    }
                    $this->cart->destroy();
                }            
                else
                {
                    $DonneesAInserer = array('NOCLIENT' => $NoClient, 'DATECOMMANDE' => date('y-m-d'), 'ETAT' => '0');
                    $this->ModeleArticle->AjoutCommande($DonneesAInserer);
                    $numCommande = implode($this->ModeleArticle->retournerIdDerniereCommande());
                    $DonneesInserer = array('NOCOMMANDE' => $numCommande, 'NOPRODUIT' => $pNoProduit, 'QUANTITE' => $pQte);
                    $QteAModifier = $pQteMax - $pQte;
                    $DonneesAModifier = array('QUANTITEENSTOCK' => $QteAModifier);
                    $this->ModeleArticle->AjoutLigne($DonneesInserer);
                    $this->ModeleArticle->ModificationQte($DonneesAModifier, $pNoProduit);

                    $this->email->from('lerouxangelique.alr@gmail.com', 'De fil en aiguille');
                    $this->email->to($this->session->identifiant); 
                    //$this->email->to('angelique.le-roux@gmx.fr');
                    $this->email->subject('Merci de votre commande!');
                    $message = 'Bonjour '. $this->session->prenom.' '.$this->session->nom.',
Nous vous confirmons que votre commande a bien été prise en compte.

L\'adresse de facturation est la suivante : 
        • '.implode("
        ", $this->ModeleUtilisateur->retournerInfoUtilisateur('EMAIL like  \''.$this->session->identifiant.'\'')).'

L\'adresse de livraison est : 
        • '.$this->input->post('txtNom').'
          '.$this->input->post('txtPrenom').'
          '.$this->input->post('txtAdresse').'
          '.$this->input->post('txtCodePostal').'
          '.$this->input->post('txtVille').'
          
Vous avez commandé :
        → '.implode($this->ModeleArticle->NomProduit($pNoProduit)).' au prix de '.implode($this->ModeleArticle->PrixProduit($pNoProduit)).'€ en '.$pQte.' exemplaire(s).

Le total de votre commande s\'élève à '.implode($this->ModeleArticle->PrixProduit($pNoProduit))*$Qte.'€

Merci de votre confiance.
A bientôt!☺';
                    $this->email->message($message);	

                    if (!$this->email->send())
                    {
                        $this->email->print_debugger();
                    }
                    $this->Visiteur->modifierQteMoins($pRowid, 1);
                }
                         
                $this->load->helper('url');
                redirect('Visiteur/AfficherCatalogue');
            }
        }

        public function Alerter($pNoProduit)
        {
            $this->ModeleArticle->Alerter($pNoProduit, $this->session->identifiant);

            $this->load->helper('url');
            redirect('Visiteur/AfficherCatalogue');
        }
    }
?>