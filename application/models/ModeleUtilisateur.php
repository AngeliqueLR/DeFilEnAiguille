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
            $this->db->select('NOM, PRENOM, ADRESSE, CODEPOSTAL, VILLE');
            $requete = $this->db->get_where('CLIENT',$pUtilisateur);
            return $requete->row_array();
        }
    }
?>