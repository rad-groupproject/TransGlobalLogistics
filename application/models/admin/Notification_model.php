<?php 
    class Notification_model extends CI_Model{
        
        public function __construct(){
            $this->load->database();
        }

        public function decline_hire($hire_type,$hire_id,$receiver_id){

            $data = array(
                'sender_id' => 1,
                'title' => "Hire Request Declined",
                'receiver_id' => $receiver_id,
                'message' => $this->input->post('message'),
                'hire_id' => $hire_id,
                'hire_type' => $hire_type
            );

            return $this->db->insert('notifications',$data);
        }

        public function get_notifications(){

            $this->db->from('notifications');
            $this->db->where('receiver_id',1);
            $this->db->where('visible',1);
            $query = $this->db->get();

            return $query->num_rows();
        }

        public function show_notifications(){
            
            $this->db->from('notifications');
            $this->db->where('receiver_id',1);
            $this->db->where('visible',1);
            $query = $this->db->get();

            return $query->result_array();
        }

        public function read_notification($id){

            $data = array(
                'visible' => 0
            );
            $this->db->where('id',$id);
            return $this->db->update('notifications',$data);
        }

        public function mark_completed($type,$hire_id,$customer_id){
            $data = array(
                'sender_id' => 1,
                'title' => "Hire Completed",
                'receiver_id' => $customer_id,
                'message' => 'Hire Completed Successfully',
                'hire_id' => $hire_id,
                'hire_type' => $type
            );

            return $this->db->insert('notifications',$data);
        }

    }
?>