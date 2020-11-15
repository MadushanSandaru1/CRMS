<?php
class notification extends CI_Model{
    function vehiacal_notifi(){
        $vehical=$this->db->query("SELECt * FROM vehicle");
        return $vehical;
    }

    function notifi_show($id){
        $vehical_noti=$this->db->query("SELECt * FROM vehicle WHERE id='$id'");
        return $vehical_noti;
    }

    function update_revenue_date($id,$date){
        $update_reve_date=$this->db->query("UPDATE vehicle SET revenue_license_date='$date' WHERE id='$id'");
        return $update_reve_date;
    }

    function update_insurence_date($id,$date){
        $update_reve_date=$this->db->query("UPDATE vehicle SET insurence_date='$date' WHERE id='$id'");
        return $update_reve_date;
    }
}
?>
