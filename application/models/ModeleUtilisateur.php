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
    }
?>