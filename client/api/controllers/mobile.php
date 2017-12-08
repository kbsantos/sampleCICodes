<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

   class Mobile extends CI_Controller {

      public function __construct()
      {
          parent::__construct();
      }

      public function index(){
      }

      public function auth(){

         $uname = $this->input->get_post('uname');
         $upass = $this->input->get_post('upass');

         $this->db->select('*');
         $this->db->from('users');
         $this->db->where("(username = '" . $uname . "')");
         $this->db->where("password = '" . $upass . "'");
         $squery = $this->db->get();

         if(empty($squery->result())){
           // no records to display
           echo json_encode(array ('message' => 'User not exist', 'type' => false));

         } else {

           $result = $squery->result();
           echo json_encode(array ('result' => $result,'message' => 'User exist', 'type' => true));
           // records have been returned
         }

      }

      public function customer_list(){

        $enrolled_by = $this->input->get_post('enrolled_by');
        $customer_id = $this->input->get_post('customer_id');

        $this->db->select('cst.id, CONCAT(cst.fname, "  ",cst.mname,"  ",cst.lname) as fullname, cst.status, cty.city');
        $this->db->from('customers as cst');
        $this->db->join('cities as cty', 'cty.id = cst.city_id', 'left');
        $this->db->where("(enrolled_by = '" . $enrolled_by . "' AND status = 'PROSPECT')");
        $prospect = $this->db->get();

        $this->db->select('cst.id, CONCAT(cst.fname, "  ",cst.mname,"  ",cst.lname) as fullname, cst.status, cty.city');
        $this->db->from('customers as cst');
        $this->db->join('cities as cty', 'cty.id = cst.city_id', 'left');
        $this->db->where("(enrolled_by = '" . $enrolled_by . "' AND status = 'FARMER')");
        $farmer = $this->db->get();

        $this->db->select('cst.id, CONCAT(cst.fname, "  ",cst.mname,"  ",cst.lname) as fullname, cst.status, cty.city');
        $this->db->from('customers as cst');
        $this->db->join('cities as cty', 'cty.id = cst.city_id', 'left');
        $this->db->where("(enrolled_by = '" . $enrolled_by . "' AND status = 'DEALER')");
        $dealer = $this->db->get();

        $this->db->select('cst.id, CONCAT(cst.fname, "  ",cst.mname,"  ",cst.lname) as fullname, cst.status, cty.city');
        $this->db->from('customers as cst');
        $this->db->join('cities as cty', 'cty.id = cst.city_id', 'left');
        $this->db->where("(enrolled_by = '" . $enrolled_by . "')");
        $all = $this->db->get();

        $result_prospect  = $prospect->result_array();
        $result_farmer    = $farmer->result_array();
        $result_dealer    = $dealer->result_array();
        $result_all    = $all->result_array();

        echo json_encode(array ('prospect' => $result_prospect,
        'farmer' => $result_farmer,
        'dealer' => $result_dealer,
        'all'   => $result_all,
        'message' => 'Farmers List', 'type' => true));
      }

      public function farmer_activity(){

           $customer_id = $this->input->get_post('customer_id');
           $technician_id = $this->input->get_post('technician_id');

           $this->db->select('*');
           $this->db->from('view_activity_grid');
           $this->db->where("(customer_id = '".$customer_id."' AND technician_id = '" . $technician_id . "')");
           $squery = $this->db->get();
            // $result = ($response->result_array());
           if(empty($squery->result())){
               // no records to display
               echo json_encode(array ('message' => 'No farmers yet', 'type' => false));
           } else {
               $result = $squery->result();
               echo json_encode(array ('result' => $result,'message' => 'Farmers List', 'type' => true));
               // records have been returned
           }
      }

      public function assigned_province(){

       $assigned_id = $this->input->get_post('assigned_id');

       $this->db->select('*');
       $this->db->from('province');
       $this->db->where("(province_id = '".$assigned_id."')");
       $squery = $this->db->get();
        // $result = ($response->result_array());
       if(empty($squery->result())){
           // no records to display
           echo json_encode(array ('message' => 'no results found', 'type' => false));
       } else {
           $result = $squery->result();
           echo json_encode(array ('result' => $result,'message' => 'Result success', 'type' => true));
           // records have been returned
       }
      }

      public function assigned_city(){

       $assigned_id = $this->input->get_post('assigned_id');

       $this->db->select('cty.id, cty.city, cty.province_id as province_id');
       $this->db->from('cities as cty');
       $this->db->join('province as pr', 'pr.province_id = cty.province_id', 'left');
       $this->db->where("(pr.province_id = '".$assigned_id."' and cty.deleted = 0)");
       $squery = $this->db->get();
        // $result = ($response->result_array());
       if(empty($squery->result())){
           // no records to display
           echo json_encode(array ('message' => 'no results found', 'type' => false));
       } else {
           $result = $squery->result();
           echo json_encode(array ('result' => $result,'message' => 'Result success', 'type' => true));
           // records have been returned
       }
      }

      public function add_farmer(){

         date_default_timezone_set('Asia/Singapore');

         $fname       = $this->input->get_post('fname');
         $mname       = $this->input->get_post('mname');
         $lname       = $this->input->get_post('lname');
         $bdate       = $this->input->get_post('bdate');
         $gender      = $this->input->get_post('gender');
         $phonenumber = $this->input->get_post('phonenumber');
         $address     = $this->input->get_post('address');
         $city        = $this->input->get_post('city');
         $farm_size   = $this->input->get_post('farm_size');
         $enrolled_by = $this->input->get_post('enrolled_by');
         $start_time  = $this->input->get_post('start_time');
         $end_time    = $this->input->get_post('end_time');

           $data = array(

                'fname'         => $fname,
                'mname'         => $mname,
                'lname'         => $lname,
                'bday'          => $bdate,
                'gender'        => $gender,
                'celno'         => $phonenumber,
                'address'       => $address,
                'city_id'       => $city,
                'farm_size'     => $farm_size,
                'enrolled_by'   => $enrolled_by,
                'start_time'    => $start_time,
                'end_time'      => $end_time,
                'enrolled_date' => date("Y-m-d H:i:s", time())
              
           );

           
          $this->db->trans_start();
          $this->db->insert('Customers',$data);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE) {
          //  return "Query Failed";
            echo json_encode(array('message' => 'new prospect unsuccessfuly created please try again!', 
                                   'type' => false));
          } else {
          // do whatever you want to do on query success
          echo json_encode(array('message' => 'New prospect succesfully created manager will review the new prospect',
                                 'type' => false));
          }

      }

      public function get_farmer_result(){

        $customer_id = $this->input->get_post('customer_id');
        $enrolled_by = $this->input->get_post('enrolled_by');

         $this->db->select('cst.id, CONCAT(cst.fname, "  ",cst.mname,"  ",cst.lname) as fullname,
            cst.status as customer_status,
            act.id as activity_id,
            act.title, act.description, act.is_approved, act.approved_by, act.enrolled_date,
            act.longitude, act.latitude,
            cty.city');
           $this->db->from('customers as cst');
           $this->db->join('activities as act', 'cst.id = act.customer_id', 'left');
           $this->db->join('cities as cty', 'cty.id = cst.city_id', 'left');
           $this->db->where("(act.customer_id = '". $customer_id ."' AND act.enrolled_by = '". $enrolled_by ."' AND cst.status = 'FARMER')");
           $farmer = $this->db->get();
           // $result = $farmer->result_array();

          if(empty($farmer->result_array())){
                // no records to display
            echo json_encode(array ('message' => 'he/she is a new farmer and doesnt have any records yet', 'type' => false));
          } else {
                // records have been returned
            $result = $farmer->result_array();
            echo json_encode(array ('result' => $result, 'message' => 'He/she is approved by manager', 'type' => true));
          }
      }

      public function new_activity_farmer(){

         date_default_timezone_set('Asia/Singapore');
         
         $presentation            = 'Presentation';
         $customer_id             = $this->input->get_post('customer_id');
         $remarks_presentation    = $this->input->get_post('remarks_presentation');
         $user_id                 = $this->input->get_post('user_id');
         $reported_to             = $this->input->get_post('reported_to');
         $enrolled_by             = $this->input->get_post('enrolled_by');
         $start_time              = $this->input->get_post('start_time');
         $end_time                = $this->input->get_post('end_time');
         $latitude                = $this->input->get_post('latitude');
         $longitude               = $this->input->get_post('longitude');

         $sell                    = 'Sell';
         $remarks_sell            = $this->input->get_post('remarks_sell');

         $demo                    = 'Demo';
         $remarks_demo            = $this->input->get_post('remarks_demo');

         $presentation_type       =$this->input->get_post('presentation_type');
         $sell_type               =$this->input->get_post('sell_type');
         $demo_type               =$this->input->get_post('demo_type');

          $data = array(
            array(
                'title'         => $presentation,
                'customer_id'   => $customer_id,
                'description'   => $remarks_presentation,
                'technician_id' => $user_id,
                'manager_id'    => $reported_to,
                'enrolled_by'   => $user_id,
                'start_time'    => $start_time,
                'end_time'      => $end_time,
                'enrolled_date' => date("Y-m-d H:i:s", time()),
                'type_id'       => $presentation_type,
                'longitude'     => $longitude,
                'latitude'      => $latitude
            ),
            array(
                'title'         => $sell,
                'customer_id'   => $customer_id,
                'description'   => $remarks_sell,
                'technician_id' => $user_id,
                'manager_id'    => $reported_to,
                'enrolled_by'   => $user_id,
                'start_time'    => $start_time,
                'end_time'      => $end_time,
                'enrolled_date' => date("Y-m-d H:i:s", time()),
                'type_id'       => $sell_type,
                'longitude'     => $longitude,
                'latitude'      => $latitude
            ),
            array(
                'title'         => $demo,
                'customer_id'   => $customer_id,
                'description'   => $remarks_demo,
                'technician_id' => $user_id,
                'manager_id'    => $reported_to,
                'enrolled_by'   => $user_id,
                'start_time'    => $start_time,
                'end_time'      => $end_time,
                'enrolled_date' => date("Y-m-d H:i:s", time()),
                'type_id'       => $demo_type,
                'longitude'     => $longitude,
                'latitude'      => $latitude
            )
          );

          $this->db->trans_start();
          $this->db->insert_batch('activities', $data);
          // print_r($this->db->last_query()); exit();
          $this->db->trans_complete();
          
          if ($this->db->trans_status() === FALSE){
                  // generate an error... or use the log_message() function to log your error
             $this->db->trans_rollback();
             echo json_encode(array('message' => 'farmer activity cant insert', 'type' => false));
          }else{
             $this->db->trans_commit();
             echo json_encode(array('message' => 'farmer activity inserted', 'type' => true));

          }
      }

      public function adding_offline_activity(){

        date_default_timezone_set('Asia/Singapore');
        
        
        $customer_id     = $this->input->get_post('customer_id');
        
        $technician_id   = $this->input->get_post('technician_id');
        $manager_id      = $this->input->get_post('manager_id');
        $enrolled_by     = $this->input->get_post('enrolled_by');
        $start_time      = $this->input->get_post('start_time');
        $end_time        = $this->input->get_post('end_time');
        $longitude       = $this->input->get_post('longitude');
        $latitude        = $this->input->get_post('latitude');

        $amount = '';

        if(empty($this->input->get_post('title')) || $this->input->get_post('title') !== '' ){
          $title = '';
        }else{
          $title = $this->input->get_post('title');        
        }

        if(empty($this->input->get_post('description')) || $this->input->get_post('description') !== '' ){
          $description = '';
        }else{
          $description = $this->input->get_post('description');       
        }

        if(empty($this->input->get_post('amount')) || $this->input->get_post('amount') !== '' ){
          $amount = '';
        }else{
          $amount = $this->input->get_post('amount');
        }

        if(empty($this->input->get_post('qty')) || $this->input->get_post('qty') !== ''){
          $qty = '';
        }else{
          $qty = $this->input->get_post('qty');
        }
        
        $data = array(
           'title'         => $title,
           'customer_id'   => $customer_id,
           'description'   => $description,
           'technician_id' => $technician_id,
           'manager_id'    => $manager_id,
           'amount'        => $amount,
           'qty'           => $qty,
           'enrolled_by'   => $enrolled_by,
           'enrolled_date' => date("Y-m-d H:i:s", time()),
           'start_time'    => $start_time,
           'end_time'      => $end_time,
           'longitude'     => $longitude,
           'latitude'      => $latitude
           );


        $this->db->trans_start();
        $this->db->insert('activities',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
        //  return "Query Failed";
          echo json_encode(array('message' => 'new prospect unsuccessfuly created please try again!', 
                                 'type' => false));
        } else {
        // do whatever you want to do on query success
        echo json_encode(array('message' => 'New prospect succesfully created manager will review the new prospect',
                               'type' => false));
        }

      }

      public function new_activity_dealer(){

        date_default_timezone_set('Asia/Singapore');
         
       // $sales_title             = $this->input->get_post('sales_title');
       // $sales_other_title       = $this->input->get_post('sales_other_title');
       // $customer_id             = $this->input->get_post('customer_id');
       // $remarks_sell            = $this->input->get_post('remarks_sell');
       // $remarks_others          = $this->input->get_post('remarks_others');
       // $user_id                 = $this->input->get_post('user_id');
       // $reported_to             = $this->input->get_post('reported_to');
       // $enrolled_by             = $this->input->get_post('enrolled_by');
       // $type_id                 = $this->input->get_post('type_id');
       // $start_time              = $this->input->get_post('start_time');
       // $end_time                = $this->input->get_post('end_time');
       // $latitude                = $this->input->get_post('latitude');
       // $longitude              = $this->input->get_post('longitude');

        $customer_id        = $this->input->get_post('customer_id');
        $reported_to        = $this->input->get_post('reported_to');
        $user_id            = $this->input->get_post('user_id');
        $sales_call         = $this->input->get_post('sales_call');
        $sales_remarks      = $this->input->get_post('sales_remarks');
        $other_title        = $this->input->get_post('other_title');
        $other_remarks      = $this->input->get_post('other_remarks');
        $other_type         = $this->input->get_post('other_type');
        $start_time         = $this->input->get_post('start_time');
        $end_time           = $this->input->get_post('end_time');
        $sales_call_type    = $this->input->get_post('sales_call_type');
        $longitude          = $this->input->get_post('longitude');
        $latitude           = $this->input->get_post('latitude');


         $sell = array(

            'customer_id'     => $customer_id,
            'reported_to'     => $reported_to,
            'user_id'         => $user_id,
            'sales_call'      => $sales_call,
            'sales_remarks'   => $sales_remarks,
            'start_time'      => $start_time,
            'end_time'        => $end_time,
            'enrolled_date'   => date("Y-m-d H:i:s", time()),
            'sales_call_type' => $sales_call_type,
            'longitude'       => $longitude,
            'latitude'        => $latitude

          );

         $other = array(

            'customer_id'     => $customer_id,
            'reported_to'     => $reported_to,
            'user_id'         => $user_id,
            'other_title'     => $other_title,
            'other_remarks'   => $other_remarks,
            'other_type'      => $other_type,
            'start_time'      => $start_time,
            'end_time'        => $end_time,
            'enrolled_date'   => date("Y-m-d H:i:s", time()),
            'longitude'       => $longitude,
            'latitude'        => $latitude

          );


         $data = array(
          array(

            'customer_id'     => $customer_id,
            'reported_to'     => $reported_to,
            'user_id'         => $user_id,
            'sales_call'      => $sales_call,
            'sales_remarks'   => $sales_remarks,
            'start_time'      => $start_time,
            'end_time'        => $end_time,
            'enrolled_date'   => date("Y-m-d H:i:s", time()),
            'sales_call_type' => $sales_call_type,
            'longitude'       => $longitude,
            'latitude'        => $latitude

          ),
          array(

            'customer_id'     => $customer_id,
            'reported_to'     => $reported_to,
            'user_id'         => $user_id,
            'other_title'     => $other_title,
            'other_remarks'   => $other_remarks,
            'other_type'      => $other_type,
            'start_time'      => $start_time,
            'end_time'        => $end_time,
            'enrolled_date'   => date("Y-m-d H:i:s", time()),
            'longitude'       => $longitude,
            'latitude'        => $latitude

          )
         );

          if(!empty($this->input->get_post('sales_call'))){
            echo json_encode(array('sell' => $sell));
          }else if(!empty($this->input->get_post('other_remarks'))){
            echo json_encode(array('other' => $other));
          }


          $this->db->trans_start();
          $this->db->insert_batch('activities', $data);
          // print_r($this->db->last_query()); exit();
          $this->db->trans_complete();
          
          if ($this->db->trans_status() === FALSE){
                  // generate an error... or use the log_message() function to log your error
             $this->db->trans_rollback();
             echo json_encode(array('message' => 'farmer activity cant insert', 'type' => false));
          }else{
             $this->db->trans_commit();
             echo json_encode(array('message' => 'farmer activity inserted', 'type' => true));

          }
      }

      public function create_repeat_farmer(){

        date_default_timezone_set('Asia/Singapore');
        $fertname       = $this->input->get_post('fertname');
        $fertamount     = $this->input->get_post('fertamount');
        $harqty         = $this->input->get_post('harqty');
        $haramout       = $this->input->get_post('haramout');
        $start_time     = $this->input->get_post('start_time');
        $end_time       = $this->input->get_post('end_time');
        $user_id        = $this->input->get_post('user_id');
        $reported_to    = $this->input->get_post('reported_to');
        $customer_id    = $this->input->get_post('customer_id'); 
        $latitude       = $this->input->get_post('latitude');
        $longitude      = $this->input->get_post('longitude');


        $fertilizer = array(
          'title'           => $fertname, 
          'customer_id'     => $customer_id,     
          'technician_id'   => $user_id,
          'manager_id'      => $reported_to,
          'amount'          => $fertamount, 
          'enrolled_by'     => $user_id, 
          'enrolled_date'   => date("Y-m-d H:i:s", time()), 
          'start_time'      =>  $start_time,
          'end_time'        =>  $end_time, 
          'type_id'         =>  1,      
          'longitude'       =>  $longitude, 
          'latitude'        =>  $latitude
        );

        $harvest = array(
          'title'           => 'Harvest', 
          'customer_id'     => $customer_id,     
          'technician_id'   => $user_id,
          'manager_id'      => $reported_to,
          'amount'          => $haramout, 
          'qty'             => $harqty, 
          'enrolled_by'     => $user_id, 
          'enrolled_date'   => date("Y-m-d H:i:s", time()), 
          'start_time'      =>  $start_time,
          'end_time'        =>  $end_time, 
          'type_id'         =>  1,      
          'longitude'       =>  $longitude, 
          'latitude'        =>  $latitude
        );

      
        $data = array(
            array(

                'title'           => $fertname, 
                'customer_id'     => $customer_id,     
                'technician_id'   => $user_id,
                'manager_id'      => $reported_to,
                'amount'          => $fertamount, 
                'qty'             => '',
                'enrolled_by'     => $user_id, 
                'enrolled_date'   => date("Y-m-d H:i:s", time()), 
                'start_time'      => $start_time,
                'end_time'        => $end_time, 
                'type_id'         => '1',      
                'longitude'       => $longitude, 
                'latitude'        => $latitude
            ),
            array(
                'title'           => 'Harvest', 
                'customer_id'     => $customer_id,     
                'technician_id'   => $user_id,
                'manager_id'      => $reported_to,
                'amount'          => $haramout, 
                'qty'             => $harqty, 
                'enrolled_by'     => $user_id, 
                'enrolled_date'   => date("Y-m-d H:i:s", time()), 
                'start_time'      =>  $start_time,
                'end_time'        =>  $end_time, 
                'type_id'         =>  '1',   
                'longitude'       =>  $longitude, 
                'latitude'        =>  $latitude
            )
          );

        $fertilizer_name    = "";
        $fertilizer_amount  = "";
        $harvest_qty        = "";
        $harvest_amount     = "";
        $stats              = "";

        if(empty($this->input->get_post('fertname')) && empty($this->input->get_post('fertamount')) 
          && empty($this->input->get_post('harqty')) && empty($this->input->get_post('haramout'))){

          echo json_encode(array('message'=> 'Please answer any of the questions!'));

        }else{

          if(empty($this->input->get_post('harqty'))){
            
            if(empty($this->input->get_post('haramout'))){
             
              $this->db->trans_begin();
              $this->db->insert('activities', $fertilizer); 

              if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  echo json_encode(array('message'=> 'Sorry problem on saving new activities', 'type' => false));
              }else{
                  $this->db->trans_commit();
                  echo json_encode(array('message' => 'succesfully created', 'type' => true));
                      
              }

            }
              
          }else if(empty($this->input->get_post('fertname'))){
            
            if(empty($this->input->get_post('fertamount'))){

              $this->db->trans_begin();
              $this->db->insert('activities', $harvest); 

              if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  echo json_encode(array('message'=> 'Sorry problem on saving new activities', 'type' => false));
              }else{
                  $this->db->trans_commit();
                  echo json_encode(array('message' => 'succesfully created', 'type' => true));
                      
              }

            }
          
          }else{

            
    
            $this->db->trans_begin();
            $this->db->insert_batch('activities', $data); 

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                echo json_encode(array('message'=> 'Sorry problem on saving new activities', 'type' => false));
            }else{
                $this->db->trans_commit();
                echo json_encode(array('message' => 'succesfully created', 'type' => true));
                    
            }

            

          }

        }
      }

      public function create_dealer_activity(){

        date_default_timezone_set('Asia/Singapore');

        $sales_call_       = $this->input->get_post('sales_call_');
        $sales_remarks_    = $this->input->get_post('sales_remarks_');
        $sales_type        = $this->input->get_post('sales_type');
        $others_remarks_   = $this->input->get_post('others_remarks_');
        $user_id           = $this->input->get_post('user_id');
        $reported_to       = $this->input->get_post('reported_to');
        $customer_id       = $this->input->get_post('customer_id');
        $longitude         = $this->input->get_post('longitude');
        $latitude          = $this->input->get_post('latitude');
        $start_time        = $this->input->get_post('start_time');
        $end_time          = $this->input->get_post('end_time');

        $other = array(
          'title'         => 'Other',
          'customer_id'   => $customer_id,
          'description'   => $others_remarks_,
          'technician_id' => $user_id,
          'manager_id'    => $reported_to,
          'enrolled_by'   => $user_id,
          'start_time'    => $start_time,
          'end_time'      => $end_time,
          'enrolled_date' => date("Y-m-d H:i:s", time()),
          'type_id'       => $sales_type,
          'longitude'     => $longitude,
          'latitude'      => $latitude  
        );

        $sell = array(
          'title'         => $sales_call_,
          'customer_id'   => $customer_id,
          'description'   => $sales_remarks_,
          'technician_id' => $user_id,
          'manager_id'    => $reported_to,
          'enrolled_by'   => $user_id,
          'start_time'    => $start_time,
          'end_time'      => $end_time,
          'enrolled_date' => date("Y-m-d H:i:s", time()),
          'type_id'       => $sales_type,
          'longitude'     => $longitude,
          'latitude'      => $latitude     
        );

        $data = array(
          array(
            'title'         => 'Other',
            'customer_id'   => $customer_id,
            'description'   => $others_remarks_,
            'technician_id' => $user_id,
            'manager_id'    => $reported_to,
            'enrolled_by'   => $user_id,
            'start_time'    => $start_time,
            'end_time'      => $end_time,
            'enrolled_date' => date("Y-m-d H:i:s", time()),
            'type_id'       => $sales_type,
            'longitude'     => $longitude,
            'latitude'      => $latitude 
          ),
          array(
            'title'         => $sales_call_,
            'customer_id'   => $customer_id,
            'description'   => $sales_remarks_,
            'technician_id' => $user_id,
            'manager_id'    => $reported_to,
            'enrolled_by'   => $user_id,
            'start_time'    => $start_time,
            'end_time'      => $end_time,
            'enrolled_date' => date("Y-m-d H:i:s", time()),
            'type_id'       => $sales_type,
            'longitude'     => $longitude,
            'latitude'      => $latitude    
          )
        );

        if(empty($this->input->get_post('others_remarks_'))){

            $this->db->trans_begin();
            $this->db->insert('activities', $sell); 

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                echo json_encode(array('message'=> 'Sorry problem on saving new activities', 'type' => false));
            }else{
                $this->db->trans_commit();
                echo json_encode(array('message' => 'succesfully created', 'type' => true));
                    
            }

        }else if(empty($this->input->get_post('sales_call_'))){

            $this->db->trans_begin();
            $this->db->insert('activities', $other); 

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                echo json_encode(array('message'=> 'Sorry problem on saving new activities', 'type' => false));
            }else{
                $this->db->trans_commit();
                echo json_encode(array('message' => 'succesfully created', 'type' => true));
                    
            }

        }else if(empty($this->input->get_post('sales_remarks_'))){
            $this->db->trans_begin();
            $this->db->insert('activities', $other); 

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                echo json_encode(array('message'=> 'Sorry problem on saving new activities', 'type' => false));
            }else{
                $this->db->trans_commit();
                echo json_encode(array('message' => 'succesfully created', 'type' => true));
                    
            }
            
        }else{
          
          $this->db->trans_start();
          $this->db->insert_batch('activities', $data);
          // print_r($this->db->last_query()); exit();
          $this->db->trans_complete();
          
          if ($this->db->trans_status() === FALSE){
                  // generate an error... or use the log_message() function to log your error
             $this->db->trans_rollback();
             echo json_encode(array('message' => 'farmer activity cant insert', 'type' => false));
          }else{
             $this->db->trans_commit();
             echo json_encode(array('message' => 'farmer activity inserted', 'type' => true));

          }

        }
      }

      //Old Area dont touched
      public function add_customer(){

       date_default_timezone_set('Asia/Singapore');

       $fname = $this->input->get_post('fname');
       $lname = $this->input->get_post('lname');
       $mname = $this->input->get_post('mname');
       $bday =  $this->input->get_post('bday');
       $gender = $this->input->get_post('gender');
       $email = $this->input->get_post('email');
       $celno = $this->input->get_post('celno');
       $telno = $this->input->get_post('telno');
       $address_location = 1;
       $address = $this->input->get_post('address');
       $status = $this->input->get_post('status');
       $enrolled_by = $this->input->get_post('enrolled_by');

        $data = array(
          'fname' => $fname,
          'mname' => $mname,
          'lname' => $lname,
          'bday' => $bday,
          'gender' => $gender,
          'email' => $email,
          'telno' => $telno,
          'celno' => $celno,
          'address_location'=> $address_location,
          'address' => $address,
          'status' => $status,
          'enrolled_by' => $enrolled_by,
          'enrolled_date' => date("Y-m-d H:i:s", time())
        );
        
         $this->db->insert('Customers',$data);
         echo json_encode(array
         ('message' => "new Customer added as"." ".$status));
      }

      public function activity_type_list(){
           $o = new stdClass();
           $response = $this->nativeCurl('https://mobile-farming-hubriz.c9users.io/api.php/ActivityType', (array) $o, 'POST');
           echo json_encode($response);
      }

      public function new_activity(){

           $technician = $this->db->query("select id,  CONCAT_WS(' ',fname, mname,lname) fullname from Users where role_id = 2");
           $technician_ = $technician->result();

           $manager = $this->db->query("select id,  CONCAT_WS(' ',fname, mname,lname) fullname from Users where role_id = 1");
           $manager_ = $manager->result();

           $customer = $this->db->query("select id,CONCAT_WS(' ',fname, mname,lname) fullname
                                       from Customers
                                       where status != 'BLOCKED'");
           $customer_ = $customer->result();

           $event = $this->db->query("select * from events");
           $event_ = $event->result();

           echo json_encode(array(
           'techician' => $technician_,
           'manager' => $manager_,
           'customer' => $customer_,
           'event' => $event_,
           'message' => "Customers List"));
      }

      public function activity_list(){

           $activity_list = $this->db->query("select * from view_activity_grid");
           $activity_grid = $activity_list->result();

           echo json_encode(array('data' => $activity_grid,
           'message' => "new Customer added as"));
      }

      public function save_activity(){

           date_default_timezone_set('Asia/Singapore');
           $title = $this->input->get_post('title');
           $description = $this->input->get_post('title');
           $manager_id = $this->input->get_post('manager_id');
           $technician_id = $this->input->get_post('technician_id');
           $customer_id = $this->input->get_post('customer_id');

           $longitude = 0;
           $latitude = 0;
           $event_id = $this->input->post('event_id');
           $type_id = 1;
           $modified_date = date('Y-m-d h:m:s');
           $is_approved = 'Y';

           $data = array(
               'title'         =>$title,
               'description'   =>$description,
               'manager_id'    =>$manager_id,
               'technician_id' =>$technician_id,
               'customer_id'   =>$customer_id,
               'longitude'     =>$longitude,
               'latitude'      =>$latitude,
               'event_id'      =>$event_id,
               'type_id'       =>$type_id,
               'modified_date' =>$modified_date,
               'is_approved'   =>$is_approved
           );

           $this->db->insert('Activities',$data);
           $activity_id = $this->db->insert_id();

           if(!empty($event_id)){

               $transactions_query = $this->db->query("SELECT * FROM `transactions` WHERE event_id = $event_id");
               $transactions = $transactions_query->result();


               if(!empty($transactions)){

                   foreach($transactions as $transaction){

                       $this->db->query("INSERT INTO `actual_events`
                       (`source_id`, `transaction_id`, `status`, `source`)
                       VALUES ($activity_id, $transaction->id, NULL, NULL)");

                       $actual_event_id = $this->db->insert_id();

                       $this->db->query("INSERT INTO `user_in_actual_event`
                       (`user_id`, `actual_event_id`, `start_date`, `end_date`, `status`, `notes`)
                       VALUES ($technician_id, $actual_event_id, NULL, NULL, NULL, NULL)");

                   }

                    echo json_encode(array('message' => "New Activity succesfully saved!"));

               }
           }
      }

   }