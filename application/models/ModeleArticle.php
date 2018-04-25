<?php
    class ModeleArticle extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function retournerProduit($pNoProduit = FALSE)
        {
            if($pNoProduit === FALSE)
            {
                $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS, Promotion');
                $requete = $this->db->get('produit');

                return $requete->result_array();
            }

            $this->db->select('LIBELLE, PRIXHT, TAUXTVA, QUANTITEENSTOCK, NOMIMAGE, NOMIMAGEBIS, DETAIL, Promotion');
            $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoProduit));

            return $requete->row_array();
        }

        public function insererUnProduit($pDonneesAInserer)
        {
            return $this->db->insert('PRODUIT', $pDonneesAInserer);
        }

        public function retournerArticlesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
        {
            $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
            $requete = $this->db->get("PRODUIT");

            if($requete->num_rows() > 0)
            {
                foreach ($requete->result() as $ligne)
                {
                    return $requete->result_array(); 
                }
            }
            return false;
        }

        public function nombreDArticles() 
        {
            return $this->db->count_all("PRODUIT");
        }

        public function retournerArticlesParCategorie($pCategorieChoisie)
        {
            $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS');
            $requete = $this->db->get_where('produit', array('NOCATEGORIE' => $pCategorieChoisie));

            return $requete->result_array(); 
        }

        public function retournerArticlesParMarque($pMarqueChoisie)
        {
            $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS');
            $requete = $this->db->get_where('produit', array('NOMARQUE' => $pMarqueChoisie));

            return $requete->result_array(); 
        }

        public function retournerArticlesParDates($pDate)
        {
            //$this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS');
            if ($pDate == 1):
                //$requete = $this->db->get_where('produit', array('NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 6)'));
                $requete = $this->db->query('select NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS from produit where NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 6)');
            elseif ($pDate == 2):
                //$requete = $this->db->get_where('produit', array('NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 16 and DATEDIFF( NOW( ) , DATEAJOUT ) > 4)'));
                $requete = $this->db->query('select NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS from produit where NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 16 and DATEDIFF( NOW( ) , DATEAJOUT ) > 4)');
            else :
                //$requete = $this->db->get_where('produit', array('NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) > 14)'));
                $requete = $this->db->query('select NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS from produit where NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) > 14)');
            endif;
            return $requete->result_array(); 
        }

        public function retournerCategories()
        {
            $this->db->select('distinct(categorie.LIBELLE), categorie.NOCATEGORIE');
            $requete = $this->db->get_where('produit, categorie', array('categorie.NOCATEGORIE = produit.NOCATEGORIE'));

            return $requete->result_array(); 
        }

        public function retournerMarques()
        {
            $this->db->select('distinct(NOM), marque.NOMARQUE');
            $requete = $this->db->get_where('produit, marque', array('marque.NOMARQUE = produit.NOMARQUE'));

            return $requete->result_array(); 
        }
    }
?>