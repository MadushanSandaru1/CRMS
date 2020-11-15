<?php

    class VehicleOutsource extends CI_Controller
    {
        public function  outsourcingVehicle()
        {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/outsourceVehicles/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('outsource_pic'))
            {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= "assets/images/outsourceVehicles/".$info['raw_name'].$info['file_ext'];
                $this->load->model('OutsourceVehicleModel');
                $outSourceDetails = $this->OutsourceVehicleModel->getOutsourceDetails();
                $supplier = $this->OutsourceVehicleModel->getSupplier();
                $response = $this->OutsourceVehicleModel->insertOutsourceVehicle($image_path);

                if ($response)
                {
                    $this->session->set_flashdata('outsource_status',"Data Recorded Successfully");
                    $this->load->view(
                        'crms_outsourcing',
                        [
                            'outsourceVehicle'=>$outSourceDetails,
                            'supplier'=>$supplier
                        ]
                    );
                }
            }
        }
    }
?>