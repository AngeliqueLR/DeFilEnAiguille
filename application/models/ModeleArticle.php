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
                $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS, Promotion, QUANTITEENSTOCK');
                $requete = $this->db->get_where('produit', array('DISPONIBLE' => 1));

                return $requete->result_array();
            }

            $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, QUANTITEENSTOCK, NOMIMAGE, NOMIMAGEBIS, NOMIMAGEACCEUIL, DETAIL, Promotion');
            $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoProduit));

            return $requete->row_array();
        }

        public function insererUnProduit($pDonneesAInserer)
        {
            return $this->db->insert('PRODUIT', $pDonneesAInserer);
        }

        public function insererUneMarque($pDonneesAInserer)
        {
            return $this->db->insert('MARQUE', $pDonneesAInserer);
        }

        public function insererUneCategorie($pDonneesAInserer)
        {
            return $this->db->insert('CATEGORIE', $pDonneesAInserer);
        }

        public function retournerArticlesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)//, $pRechercher = NULL)
        {
            $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
            $requete = $this->db->get_where("PRODUIT", array('DISPONIBLE' => 1));

            if($requete->num_rows() > 0)
            {
                foreach ($requete->result() as $ligne)
                {
                    return $requete->result_array(); 
                }
            }
            
            return false;
        }

        public function retournerArticlesLimitePagination($nombreDeLignesARetourner, $noPremiereLigneARetourner, $pRechercher)
        {
                $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
                $this->db->select('distinct(NOPRODUIT), PRODUIT.LIBELLE, PRIXHT, TAUXTVA, QUANTITEENSTOCK, NOMIMAGE, NOMIMAGEBIS, NOMIMAGEACCEUIL, DETAIL, Promotion');
                $requete = $this->db->get_where("PRODUIT, CATEGORIE, MARQUE", '((produit.NOMARQUE = marque.NOMARQUE and marque.NOM like \'%'.$pRechercher.'%\') or (produit.NOCATEGORIE = categorie.NOCATEGORIE and categorie.LIBELLE like \'%'.$pRechercher.'%\') or produit.LIBELLE like \'%'.$pRechercher.'%\') and DISPONIBLE = 1');
                
                if($requete->num_rows() > 0)
                {
                   foreach ($requete->result() as $ligne)
                    {
                        return $requete->result_array(); 
                    }
                }
            
            return false;
        }

        public function nombreDArticles()//$pRechercher = NULL) 
        {
           return $this->db->count_all("PRODUIT");
        }

        public function nombreDArticlesPagination($pRechercher = NULL) 
        {
            $requete = $this->db->query('select count(distinct(NOPRODUIT)) from produit, marque, categorie where ((produit.NOMARQUE = marque.NOMARQUE and marque.NOM like \'%'.$pRechercher.'%\') or (produit.NOCATEGORIE = categorie.NOCATEGORIE and categorie.LIBELLE like \'%'.$pRechercher.'%\') or produit.LIBELLE like \'%'.$pRechercher.'%\') and DISPONIBLE = 1');
            return implode($requete->row_array());
        }

        public function retournerArticlesParCategorie($pCategorieChoisie)
        {
            $this->db->select('NOPRODUIT, LIBELLE, QUANTITEENSTOCK, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS');
            $requete = $this->db->get_where('produit', array('NOCATEGORIE' => $pCategorieChoisie, 'DISPONIBLE' => 1));

            return $requete->result_array(); 
        }

        public function retournerArticlesParMarque($pMarqueChoisie)
        {
            $this->db->select('NOPRODUIT, LIBELLE, QUANTITEENSTOCK, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS');
            $requete = $this->db->get_where('produit', array('NOMARQUE' => $pMarqueChoisie, 'DISPONIBLE' => 1));

            return $requete->result_array(); 
        }

        public function retournerArticlesParDates($pDate)
        {
            //$this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, NOMIMAGEBIS');
            if ($pDate == 1):
                //$requete = $this->db->get_where('produit', array('NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 6)'));
                $requete = $this->db->query('select NOPRODUIT, QUANTITEENSTOCK, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS from produit where DISPONIBLE = 1 and  NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 6)');
            elseif ($pDate == 2):
                //$requete = $this->db->get_where('produit', array('NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 16 and DATEDIFF( NOW( ) , DATEAJOUT ) > 4)'));
                $requete = $this->db->query('select NOPRODUIT, QUANTITEENSTOCK, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS from produit where DISPONIBLE = 1 and NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 16 and DATEDIFF( NOW( ) , DATEAJOUT ) > 4)');
            else :
                //$requete = $this->db->get_where('produit', array('NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) > 14)'));
                $requete = $this->db->query('select NOPRODUIT, QUANTITEENSTOCK, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS from produit where DISPONIBLE = 1 and NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) > 14)');
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

        public function EstDansPanier($pNoProduit)
        {
            foreach ($this->cart->contents() as $Produit):
                if ($Produit['id'] == $pNoProduit):
                    return 'vrai';
                endif;
            endforeach;

            return 'faux';
        }

        public function retournerIdDerniereCommande()
        {
            $requete = $this->db->query('select MAX(NOCOMMANDE) from commande');
            return $requete->row_array();
        }

        public function AjoutCommande($pDonneesAInserer)
        {
            return $this->db->insert('COMMANDE', $pDonneesAInserer);
        }

        public function AjoutLigne($pDonneesAInserer)
        {
            return $this->db->insert('LIGNE', $pDonneesAInserer);
        }

        public function ModificationQte($pDonneesAModifier, $pNoProduit)
        {
            $this->db->set($pDonneesAModifier);
            $this->db->where('NOPRODUIT', $pNoProduit);
            return $this->db->update('PRODUIT');
        }

        public function NomProduit($pNoProduit)
        {
            $this->db->select('LIBELLE');
            $requete = $this->db->get_where('produit', 'NOPRODUIT ='.$pNoProduit);
            
            return $requete->row_array();
        }

        public function PrixProduit($pNoProduit)
        {
            $this->db->select('PRIXHT + ( PRIXHT * TAUXTVA /100 )');
            $requete = $this->db->get_where('produit', 'NOPRODUIT ='.$pNoProduit);
            
            return $requete->row_array();
        }

        public function retournerLesProduits()
        {
            foreach ($this->cart->contents() as $Produit):
                $produits[] = '→ '.$Produit['name'].' au prix de '.$Produit['price'].'€ en '.$Produit['qty'].' exemplaire(s).'; 
            endforeach;

            return $produits;
        }

        public function ModifierProduit($pDonneesAModifier, $pNoProduit)
        {
            $this->db->set($pDonneesAModifier);
            $this->db->where('NOPRODUIT', $pNoProduit);
            return $this->db->update('PRODUIT');
        }

        public function CompterAlerter($pNoProduit, $pEMail)
        {
            $requete = $this->db->query('select count(*) from alerter where NOPRODUIT = '.$pNoProduit.' and NOCLIENT = '.implode($this->ModeleUtilisateur->retournerNumeroUtilisateur($pEMail)));
            return $requete->result_array();
        }

        public function Alerter($pNoProduit, $pEMail)
        {
            if (implode($this->ModeleArticle->CompterAlerter($pNoProduit, $pEMail)) == 0):
                $DonneesAInserer = (array('NOCLIENT' => implode($this->ModeleUtilisateur->retournerNumeroUtilisateur($pEMail)), 'NOPRODUIT' => $pNoProduit));
                return $this->db->insert('alerter', $DonneesAInserer);
            endif;
        }

        public function MarqueCategorie($pNoProduit)
        {
           $requete = $this->db->query('SELECT categorie.LIBELLE, marque.NOM FROM marque, produit, categorie WHERE marque.NOMARQUE = produit.NOMARQUE AND categorie.NOCATEGORIE = produit.NOCATEGORIE AND NOPRODUIT = '.$pNoProduit);
           return $requete->row_array();
        }

        public function SupprimerAlerter($pNoProduit)
        {
            return $this->db->delete('Alerter', array('NOPRODUIT' => $pNoProduit));
        }

        public function ValiderCommande($pDonneesAModifier, $pNoCommande)
        {
            $this->db->set($pDonneesAModifier);
            $this->db->where('NOCOMMANDE', $pNoCommande);
            return $this->db->update('COMMANDE');
        }

        public function afficherRecherche($pRechercher)
        {
            $requete = $this->db->query('select distinct(produit.NOPRODUIT), QUANTITEENSTOCK, produit.LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS from produit, marque, categorie where (produit.NOMARQUE = marque.NOMARQUE and marque.NOM like \'%'.$pRechercher.'%\') or (produit.NOCATEGORIE = categorie.NOCATEGORIE and categorie.LIBELLE like \'%'.$pRechercher.'%\') or produit.LIBELLE like \'%'.$pRechercher.'%\' and DISPONIBLE = 1');
            return $requete->result_array();
        }

        public function meilleuresVentes()
        {
            $requete = $this->db->query('select produit.NOPRODUIT, NOMARQUE, NOCATEGORIE,  SUM(QUANTITECOMMANDEE) from commande, ligne, produit where ligne.NOPRODUIT = produit.NOPRODUIT and commande.NOCOMMANDE	= ligne.NOCOMMANDE group by produit.NOPRODUIT' );
            
            $lesProduits[0] = "";
            foreach($requete->result_array() as $uneLigne):
                $i = 0;
                if ($lesProduits[0] == "")
                {
                    $lesProduits[0] = $uneLigne;
                }
                else
                {
                    foreach ($lesProduits as $unProduit):
                        if ($unProduit['NOMARQUE'] == $uneLigne['NOMARQUE'] and $unProduit['NOCATEGORIE'] == $uneLigne['NOCATEGORIE'])
                        {
                            if($unProduit['SUM(QUANTITECOMMANDEE)'] < $uneLigne['SUM(QUANTITECOMMANDEE)'])
                            {
                                $lesProduits[count($lesProduits)-1] = $uneLigne;
                            }
                        }
                        else
                        {
                            $i = $i + 1;
                        }
                    endforeach;
                    $nbProduits = count($lesProduits);
                    if ($nbProduits == $i)
                    {
                        $lesProduits[$nbProduits] = $uneLigne;
                    }
                }
            endforeach;

            $x = 0;
            foreach ($lesProduits as $unProduit):
                $Produits[$x] = $this->ModeleArticle->retournerProduit($unProduit['NOPRODUIT']);
                $x = $x + 1; 
            endforeach;

            return $Produits;
        }

        public function lesPromos()
        {
            $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, QUANTITEENSTOCK, NOMIMAGE, NOMIMAGEBIS, NOMIMAGEACCEUIL, DETAIL, Promotion');
            $requete = $this->db->get_where('produit', 'Promotion > 0');

            return $requete->result_array();
        }

        public function lesAjoutsRecents()
        {
            $requete = $this->db->query('select NOPRODUIT, QUANTITEENSTOCK, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS, NOMIMAGEACCEUIL from produit where DISPONIBLE = 1 and  NOPRODUIT IN (SELECT NOPRODUIT FROM produit WHERE DATEDIFF( NOW(), DATEAJOUT ) < 15)');
            return $requete->result_array(); 
        }

        public function LAmeilleureVente()
        {
            $requete = $this->db->query('select produit.NOPRODUIT, NOMARQUE, NOCATEGORIE,  SUM(QUANTITECOMMANDEE) from commande, ligne, produit where ligne.NOPRODUIT = produit.NOPRODUIT and commande.NOCOMMANDE	= ligne.NOCOMMANDE group by produit.NOPRODUIT' );
            
            $laMeilleureVente = "";
            foreach($requete->result_array() as $uneLigne):
                $i = 0;
                if ($laMeilleureVente == "")
                {
                    $laMeilleureVente = $uneLigne;
                }
                else
                {
                    if($laMeilleureVente['SUM(QUANTITECOMMANDEE)'] < $uneLigne['SUM(QUANTITECOMMANDEE)'])
                    {
                        $laMeilleureVente = $uneLigne;
                    }
                }
            endforeach;

            $MeilleureVente = $this->ModeleArticle->retournerProduit($laMeilleureVente['NOPRODUIT']);

            return $MeilleureVente;
        }

        public function LAmeilleurePromo()
        {
            $this->db->select('NOPRODUIT, LIBELLE, PRIXHT, TAUXTVA, QUANTITEENSTOCK, NOMIMAGE, NOMIMAGEBIS, NOMIMAGEACCEUIL, DETAIL, MAX(Promotion) as Promotion');
            $requete = $this->db->get_where('produit', 'Promotion > 0');

            return $requete->row_array();
        }

        public function LajoutLePlusRecent()
        {
            $requete = $this->db->query('select NOPRODUIT, QUANTITEENSTOCK, LIBELLE, PRIXHT, TAUXTVA, NOMIMAGE, Promotion, NOMIMAGEBIS, NOMIMAGEACCEUIL from produit where DISPONIBLE = 1 and DATEAJOUT IN (SELECT MAX(DATEAJOUT) FROM produit)');
            return $requete->row_array(); 
        }
    }
?>