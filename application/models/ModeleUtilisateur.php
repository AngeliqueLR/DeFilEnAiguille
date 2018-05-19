<?php

    class ModeleUtilisateur extends CI_Model 
    {  
        public function __construct()
        {
            $this->load->database();
        }

        public function existe($pUtilisateur) 
        {
            $this->db->where($pUtilisateur);
            $this->db->from('CLIENT');
            return $this->db->count_all_results(); 
        }

        public function retournerUtilisateur($pUtilisateur)
        {
            $requete = $this->db->get_where('CLIENT',$pUtilisateur);
            return $requete->row();
        }

        public function retournerMail($pUtilisateur)
        {
            $this->db->where($pUtilisateur);
            $this->db->from('CLIENT');
            return $this->db->count_all_results();
        }

        public function sInscrire($DonneesClient)
        {
            return $this->db->insert('CLIENT', $DonneesClient);
        }

        public function retournerNumeroUtilisateur($pUtilisateur)
        {
            $this->db->select('NOCLIENT');
            $requete = $this->db->get_where('client', 'EMAIL like \''.$pUtilisateur.'\'');
            
            return $requete->row_array();
        }

        public function retournerInfoUtilisateur($pUtilisateur)
        {
            $this->db->select('NOM, PRENOM, ADRESSE, CODEPOSTAL, VILLE, EMAIL, MOTDEPASSE');
            $requete = $this->db->get_where('CLIENT',$pUtilisateur);
            return $requete->row_array();
        }

        public function retournerEMails($pNoProduit)
        {
            $requete = $this->db->query('select EMAIL from client, alerter where client.NOCLIENT = alerter.NOCLIENT and NOPRODUIT = '.$pNoProduit);
            return $requete->result_array();
        }

        public function retournerNomPrenom($pUtilisateur)
        {
            $this->db->select('PRENOM, NOM');
            $requete = $this->db->get_where('CLIENT',array('EMAIL' => $pUtilisateur));
            return $requete->row_array();
        }

        public function retournerInfoClients()
        {
            $this->db->select('NOM, PRENOM, ADRESSE, CODEPOSTAL, VILLE, EMAIL, NOCLIENT');
            $requete = $this->db->get_where('CLIENT', array('PROFIL' => 'Client'));

            return $requete->result_array();            
        }

        public function retournerIdentifiant($pUtilisateur)
        {
            $this->db->select('EMAIL');
            $requete = $this->db->get_where('CLIENT',array('NOCLIENT' => $pUtilisateur));
            return $requete->row_array();
        }

        public function retournerNoCommandesNonTraitees($pNoClient = NULL)
        {
            if ($pNoClient != NULL)
            {
                $this->db->select('NOCOMMANDE');
                $requete = $this->db->get_where('commande', array('NOCLIENT' => $pNoClient, 'Etat' => '0'));
                return $requete->result_array();
            }
            else 
            {
                $this->db->select('NOCOMMANDE');
                $requete = $this->db->get_where('commande', array('Etat' => '0'));
                return $requete->result_array();
            }
        }

        public function CommandesEnAttentes($pNoClient = NULL, $pNoCommande)
        {
            if ($pNoClient != NULL)
            {
                $this->db->select('LIBELLE, QUANTITECOMMANDEE, commande.NOCOMMANDE');
                $requete = $this->db->get_where('ligne, produit, commande', 'produit.NOPRODUIT = ligne.NOPRODUIT and ligne.NOCOMMANDE = commande.NOCOMMANDE and NOCLIENT = '.$pNoClient.' and commande.NOCOMMANDE = '.$pNoCommande);
                return $requete->result_array();
            }
            else 
            {
                $this->db->select('NOM, PRENOM, ADRESSE, CODEPOSTAL, VILLE, EMAIL, LIBELLE, QUANTITECOMMANDEE, client.NOCLIENT, commande.NOCOMMANDE');
                $requete = $this->db->get_where('ligne, produit, commande, client', 'produit.NOPRODUIT = ligne.NOPRODUIT and ligne.NOCOMMANDE = commande.NOCOMMANDE and commande.NOCOMMANDE = '.$pNoCommande.' and client.NOCLIENT = commande.NOCLIENT');
                return $requete->result_array(); 
            }
        }

        public function retournerHistoriqueCommandes($pNoClient = NULL)
        {
            if ($pNoClient != NULL)
            {
                $this->db->select('NOCOMMANDE');
                $requete = $this->db->get_where('commande', array('NOCLIENT' => $pNoClient, 'Etat' => '1'));
                return $requete->result_array();
            }
            else 
            {
                $this->db->select('NOCOMMANDE');
                $requete = $this->db->get_where('commande', array('Etat' => '1'));
                return $requete->result_array();
            }
        }

        public function CommandesTraitees($pNoClient = NULL, $pNoCommande)
        {
            if ($pNoClient != NULL)
            {
                $this->db->select('LIBELLE, QUANTITECOMMANDEE, commande.NOCOMMANDE');
                $requete = $this->db->get_where('ligne, produit, commande', 'produit.NOPRODUIT = ligne.NOPRODUIT and ligne.NOCOMMANDE = commande.NOCOMMANDE and NOCLIENT = '.$pNoClient.' and commande.NOCOMMANDE = '.$pNoCommande);
                return $requete->result_array();
            }
            else 
            {
                $this->db->select('NOM, PRENOM, ADRESSE, CODEPOSTAL, VILLE, EMAIL, LIBELLE, QUANTITECOMMANDEE, client.NOCLIENT, commande.NOCOMMANDE');
                $requete = $this->db->get_where('ligne, produit, commande, client', 'produit.NOPRODUIT = ligne.NOPRODUIT and ligne.NOCOMMANDE = commande.NOCOMMANDE and commande.NOCOMMANDE = '.$pNoCommande.' and client.NOCLIENT = commande.NOCLIENT');
                return $requete->result_array(); 
            }
        }

        public function ModifierClient($pDonneesAModifier, $pNoClient)
        {
            $this->db->set($pDonneesAModifier);
            $this->db->where('NOCLIENT', $pNoClient);
            return $this->db->update('client');
        }
    }
?>