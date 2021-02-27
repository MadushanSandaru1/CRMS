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

    function update_insurence_date(){

        $id=$this->input->post('vehicle_id');
        $date=$this->input->post('insurance_date');
        $update_reve_date=$this->db->query("UPDATE vehicle SET insurence_date='$date' WHERE id='$id'");
        return $update_reve_date;
    }

    function insurence_date(){
        $after_one_year=date("Y-m-d",strtotime("-350 day"));
        $insurence_date=$this->db->query("SELECT * FROM vehicle WHERE insurence_date<'$after_one_year';");
        return $insurence_date;
    }

    function revenue_license_date(){
        $after_one_year=date("Y-m-d",strtotime("-350 day"));
        $insurence_date=$this->db->query("SELECT * FROM vehicle WHERE revenue_license_date<'$after_one_year';");
        return $insurence_date;
    }

    function car_booking_notification(){
        $car_booking_notification=$this->db->query("SELECT * FROM booking b, vehicle v WHERE v.id=b.vehicle_id AND status='0' ORDER BY posting_date DESC;");
        return $car_booking_notification;
    }

    function car_not_recive(){
        $date=date("Y-m-d h:i:s");
        $car_booking_notification=$this->db->query("SELECT * FROM reserved r,customer v WHERE r.customer_id=v.id AND to_date<'$date' AND is_returned='0';");
        return $car_booking_notification;
    }
}
?>
