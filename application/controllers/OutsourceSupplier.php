<?php
      class  OutSourceSupplier extends CI_Controller
      {
          public function getSuppliers()
          {
              $this->load->model('OutSourceSuplierModel');
              $supplierDetails = $this->OutSourceSuplierModel->getSupplierDetails();
              $this->load->view('crms_outsourcing_supplier',['supplier_details'=>$supplierDetails]);
          }

          public function outSourcingSupplier()
          {
                $config['allowed_types'] = 'jpg|png|jpeg'; 
                $config['upload_path'] = './assets/images/outsourceSupplier/';
                $this->load->library('upload',$config);

                if($this->upload->do_upload('nic_copy'))
                {
                    $data = $this->input->post();
                    $info = $this->upload->data();
                    $image_path= "assets/images/outsourceSupplier/".$info['raw_name'].$info['file_ext'];
                    $this->load->model('OutSourceSuplierModel');
                    $response = $this->OutSourceSuplierModel->insertOutSourceSupplier($image_path);

                    if($response)
                    {
                        $this->load->model('OutSourceSuplierModel');
                        $supplierDetails = $this->OutSourceSuplierModel->getSupplierDetails();
                        $this->session->set_flashdata('outsource_supplier_status', 'Data Recorded Successfully!');
                        $this->load->view('crms_outsourcing_supplier',['supplier_details'=>$supplierDetails]);
                    }
                }    
          }
      }
 ?>