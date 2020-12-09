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
                $this->form_validation->set_rules('name','Supplier Name','required');
                $this->form_validation->set_rules('nic','Supplier NIC','required');
                //$this->form_validation->set_rules('nic_copy','OutSource Supplier NIC Image File','required');
                $this->form_validation->set_rules('email','Email','required');
                $this->form_validation->set_rules('phone','Phone Number','required');
                $this->form_validation->set_rules('address','Address','required');
                
                if($this->form_validation->run() == FALSE)
                {   
                    $this->load->model('OutSourceSuplierModel');
                    $supplierDetails = $this->OutSourceSuplierModel->getSupplierDetails();
                    $this->load->view('crms_outsourcing_supplier',['supplier_details'=>$supplierDetails]);
                }
                else
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

          public function prepareToDeleteOutsourceSupplier()
          {
              $this->load->model('OutSourceSuplierModel');
              $response = $this->OutSourceSuplierModel->deleteOutSourceSupplier();

              if ($response) {
                  $this->session->set_flashdata('outsource_status', 'Data Deleted Successfully!');
                  redirect('Home/crms_outsourcing_supplier');
              }

          }
      }
 ?>