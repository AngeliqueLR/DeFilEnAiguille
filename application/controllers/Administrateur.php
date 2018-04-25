<?php
    class Administrateur extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModeleArticle');

            $this->load->library('session');
            if ($this->session->statut=='Client')
            {
                $this->load->helper('url');
                redirect('/Visiteur/seConnecter');
            }
        }

        public function ajouterUnProduit()
        {
            $Catalogue['Catalogue'] = 'non';

            $this->load->helper('form');
            $this->load->library('form_validation');

            $dateAjout = date('Y-m-d');

            $DonneesEnvoyees['TitreDeLaPage'] = 'Ajouter un produit au catalogue';
            $DonneesEnvoyees['LesMarques'] = $this->ModeleArticle->retournerMarque();
            $DonneesEnvoyees['LesCategories'] = $this->ModeleArticle->retournerCategorie();
            
            //regles de validations
            $this->form_validation->set_rules('txtNomProduit', 'required');
            $this->form_validation->set_rules('txtPrixProduit', 'required');
            $this->form_validation->set_rules('txtTVAProduit', 'required');
            $this->form_validation->set_rules('txtPhotoProduit', 'required');
            $this->form_validation->set_rules('txtPhotoBisProduit', 'required');
            $this->form_validation->set_rules('txtQuantiteProduit', 'required');
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
                'DISPONIBLE' => '1', 'Promotion' => '0');

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
    }
?>