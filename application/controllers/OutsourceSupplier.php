<?php
      class  OutSourceSupplier extends CI_Controller
      {
          public function getSuppliers()
          {
              $this->load->model('OutSourceSuplierModel');
              $supplierDetails = $this->OutSourceSuplierModel->getSupplierDetails();
              $this->load->view('crms_outsourcing_supplier',['supplier_details'=>$supplierDetails]);
          }
      }
 ?>