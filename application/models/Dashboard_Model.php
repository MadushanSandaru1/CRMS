<?php


class Dashboard_Model extends CI_Model {

    function getNewBookingCount(){
        $query = $this->db->query("SELECT COUNT(`id`) AS 'new_booking_count' FROM `booking` WHERE `from_date` > NOW() AND `status` = 0 AND `is_deleted` = 0");
        return $query;
    }

    function getAcceptedBookingCount(){
        $query = $this->db->query("SELECT COUNT(`id`) AS 'accepted_booking_count' FROM `booking` WHERE `from_date` > NOW() AND `status` = 1 AND `is_deleted` = 0");
        return $query;
    }

    function getDailyExpense(){
        $query = $this->db->query("SELECT SUM(`amount`) AS 'daily_expense' FROM `transaction` WHERE `type` = 'E' AND DATE(`date`) = CURDATE()");
        return $query;
    }

    function getDailyIncome(){
        $query = $this->db->query("SELECT SUM(`amount`) AS 'daily_income' FROM `transaction` WHERE `type` = 'I' AND DATE(`date`) = CURDATE()");
        return $query;
    }

    function getWeeklyExpense(){
        $query = $this->db->query("SELECT SUM(`amount`) AS 'weekly_expense' FROM `transaction` WHERE `type` = 'E' AND YEARWEEK(`date`) = YEARWEEK(NOW())");
        return $query;
    }

    function getWeeklyIncome(){
        $query = $this->db->query("SELECT SUM(`amount`) AS 'weekly_income' FROM `transaction` WHERE `type` = 'I' AND YEARWEEK(`date`) = YEARWEEK(NOW())");
        return $query;
    }

    function getWeeklyDate(){
        $query = $this->db->query("SELECT DATE(NOW() + INTERVAL (1 - DAYOFWEEK(NOW())) DAY) as start_date, DATE(NOW() + INTERVAL (7 - DAYOFWEEK(NOW())) DAY) as end_date");
        return $query;
    }

    function getMonthlyExpense(){
        $query = $this->db->query("SELECT SUM(`amount`) AS 'monthly_expense' FROM `transaction` WHERE `type` = 'E' AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND MONTH(`date`) = MONTH(CURRENT_DATE())");
        return $query;
    }

    function getMonthlyIncome(){
        $query = $this->db->query("SELECT SUM(`amount`) AS 'monthly_income' FROM `transaction` WHERE `type` = 'I' AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND MONTH(`date`) = MONTH(CURRENT_DATE())");
        return $query;
    }

    function getMonthlyDate(){
        $query = $this->db->query("SELECT DATE_ADD(DATE_SUB(LAST_DAY(now()), INTERVAL  1 MONTH), INTERVAL  1 day) start_date, LAST_DAY(now()) end_date");
        return $query;
    }

    function getDamageVehicleCount(){
        $query = $this->db->query("SELECT DISTINCT COUNT(`vehicle_id`) AS 'damage_vehicles' FROM `damage` WHERE `is_solved` = 0 AND `is_deleted` = 0");
        return $query;
    }

    function getDamageInMonth(){
        $query = $this->db->query("SELECT COUNT(*) AS 'monthly_damage' FROM `damage` WHERE YEAR(`d_date`) = YEAR(CURRENT_DATE()) AND MONTH(`d_date`) = MONTH(CURRENT_DATE()) AND `is_deleted` = 0");
        return $query;
    }

    function getReserved(){
        $query = $this->db->query("SELECT COUNT(*) AS 'reserved_count' FROM `reserved` WHERE `is_returned` = 0 AND `is_deleted` = 0");
        return $query;
    }

    function getReservedDelay(){
        $query = $this->db->query("SELECT COUNT(*) AS 'reserved_delay_count' FROM `reserved` WHERE `to_date` < NOW() AND `is_returned` = 0 AND `is_deleted` = 0");
        return $query;
    }

}