<?php
namespace ResourceTrackerSolution\CustomerManagement\Infrastructure\Data\Repositories;


use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\ResourceManagementContext;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model\Customers;

class CustomerRepository
{
    private $context;

    public function __construct(ResourceManagementContext $context)
    {
        $this->context = $context;
    }

    public function add(Customers $entity)
    {
        $this->context->customers()->add($entity);
    }

    public function find($id)
    {
    
        $oCustomer = $this->context->customers()->find((string) $id);
        //Add location label
        if(trim($oCustomer->city_id)<>''){
            $oCities = $this->context->cities()->find((string) $oCustomer->city_id);
            $oCustomer->city = $oCities->city;            
        }
        if(trim($oCustomer->address_location)<>''){
            $oLocation = $this->context->location()->find((string) $oCustomer->address_location);
            $oCustomer->location_label = $oLocation->display_label;            
        }
        unset($oCities);
        unset($oLocation);
        return $oCustomer;
    }

    public function fetch()
    {
        return $this->context->customers()->fetch();
    }
    
    public function fetchForServerSideGrid($aGridData,$aColumns,$sTable,$user)
    {
        // Paging
        if(isset($aGridData['iDisplayStart']) && $aGridData['iDisplayLength'] != '-1'){
           $this->context->db->limit($this->context->db->escape_str($aGridData['iDisplayLength']), 
                                     $this->context->db->escape_str($aGridData['iDisplayStart']));
        }
        
        // Ordering
        if(isset($aGridData['iSortCol_0']))
        {
            for($i=0; $i<intval($aGridData['iSortingCols']); $i++)
            {
                $iSortCol   = $aGridData['iSortCol_'.$i];
                $bSortable  = $aGridData['bSortable_'.$i];
                $sSortDir   = $aGridData['sSortDir_'.$i];
    
                if($bSortable == 'true')
                {
                    $this->context->db->order_by($aColumns[intval($this->context->db->escape_str($iSortCol))], $this->context->db->escape_str($sSortDir));
                }
            }
        }
        
        // Filtering
        // NOTE this does not match the built-in DataTables filtering which does it
        // word by word on any field. It's possible to do here, but concerned about efficiency
        // on very large tables, and MySQL's regex functionality is very limited
        if(isset($aGridData['sSearch']) && !empty($aGridData['sSearch'])){
            for($i=0; $i<count($aColumns); $i++){
                $bSearchable =  $aGridData['bSearchable_'.$i];
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true'){
                    $this->context->db->or_like($aColumns[$i], $this->context->db->escape_like_str($aGridData['sSearch']));
                }
            }
        }
        
        // Select Data
         if(!empty($user)){
            $this->context->db->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false)
                            ->where('enrolled_by_id',$user);
        }
        else{
            $this->context->db->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        }
        $rResult = $this->context->db->get($sTable);
        
        // Data set length after filtering       
        $this->context->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->context->db->get()->row()->found_rows;
        
        
        // Total data set length
        $iTotal = $this->context->db->count_all($sTable);
        //return $this->context->db->get()->result((string) $this->context->customers());
        
        // Output
        $output = array(
            'sEcho' => intval($aGridData['sEcho']),
            'iTotalRecords' => intval($iTotal),
            'iTotalDisplayRecords' => intval($iFilteredTotal),
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow){
            $row = array();
            foreach($aColumns as $col){
                $row[] = $aRow[$col];
            }
            $output['aaData'][] = $row;
        }
        
        return $output;
    }
    
    // for cities
    public function fetchLookUpCity($aGridData,$aColumns,$sTable,$province)
    {
        // Paging
        if(isset($aGridData['iDisplayStart']) && $aGridData['iDisplayLength'] != '-1'){
           $this->context->db->limit($this->context->db->escape_str($aGridData['iDisplayLength']), 
                                     $this->context->db->escape_str($aGridData['iDisplayStart']));
        }
        
        // Ordering
        if(isset($aGridData['iSortCol_0']))
        {
            for($i=0; $i<intval($aGridData['iSortingCols']); $i++)
            {
                $iSortCol   = $aGridData['iSortCol_'.$i];
                $bSortable  = $aGridData['bSortable_'.$i];
                $sSortDir   = $aGridData['sSortDir_'.$i];
    
                if($bSortable == 'true')
                {
                    $this->context->db->order_by($aColumns[intval($this->context->db->escape_str($iSortCol))], $this->context->db->escape_str($sSortDir));
                }
            }
        }
        
        // Filtering
        // NOTE this does not match the built-in DataTables filtering which does it
        // word by word on any field. It's possible to do here, but concerned about efficiency
        // on very large tables, and MySQL's regex functionality is very limited
        if(isset($aGridData['sSearch']) && !empty($aGridData['sSearch'])){
            for($i=0; $i<count($aColumns); $i++){
                $bSearchable =  $aGridData['bSearchable_'.$i];
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true'){
                    $this->context->db->or_like($aColumns[$i], $this->context->db->escape_like_str($aGridData['sSearch']));
                }
            }
        }
        
        // Select Data
         if(!empty($province)){
            $this->context->db->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false)
                            ->where('id',$province);
        }
        else{
            $this->context->db->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        }
        $rResult = $this->context->db->get($sTable);
        
        // Data set length after filtering       
        $this->context->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->context->db->get()->row()->found_rows;
        
        
        // Total data set length
        $iTotal = $this->context->db->count_all($sTable);
        //return $this->context->db->get()->result((string) $this->context->customers());
        
        // Output
        $output = array(
            'sEcho' => intval($aGridData['sEcho']),
            'iTotalRecords' => intval($iTotal),
            'iTotalDisplayRecords' => intval($iFilteredTotal),
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow){
            $row = array();
            foreach($aColumns as $col){
                $row[] = $aRow[$col];
            }
            $output['aaData'][] = $row;
        }
        
        return $output;
    }

    public function update(Customers $entity)
    {
        $this->context->customers()->update($entity);
    }

    public function remove($id)
    {
        $this->context->customers()->remove($id);
    }

    //Organization
    public function add_organization($data){
        $this->context->db->insert('Customer_Organization', $data);
    }
    
    
    public function findOrganization($customer_id)
    {
       $aData['data'] = array();
       $customer_id = intval($customer_id);
       $oOrganization = $this->context->db
                			->select('org.id, org.title, org.description, org.status, loc.display_label, org.address, org.remarks')
                			->from('Customer_Organization org')
                			->join('Location loc','org.address_location = loc.id', 'left')
                			->where('org.customer_id', $customer_id)
                			->order_by('org.id','asc')
                			->get()->result((string) $this->context->organization());
                			
        if(count($oOrganization) > 0){
            foreach($oOrganization as $key=>$Org){
                $aData['data'][$key][]=$Org->id;
                $aData['data'][$key][]=$Org->title;
                $aData['data'][$key][]=trim($Org->display_label).', '.$Org->address;
                $aData['data'][$key][]=$Org->remarks;
                $aData['data'][$key][]=$Org->status;
                //$aData['data'][$key][]=$Org->description;
            }
        }		
                			
        return $aData;
    }
    
    public function findOrganizationByName($org)
    {
       $aData = array();
       $oOrganization = $this->context->db
                			->select('loc.id, loc.display_label')
                			->from('Location loc')
                			->like('loc.display_label', $org)
                			->order_by('loc.id','asc')
                			->get()->result((string) $this->context->organization());
                			
        if(count($oOrganization) > 0){
            foreach($oOrganization as $key=>$Org){
                $aData[$key][]=trim($Org->display_label).', '.$Org->address;
                //$aData['data'][$key][]=$Org->id;
                //$aData['data'][$key][]=$Org->title;
                //$aData['data'][$key][]=$Org->description;
                //$aData['data'][$key][]=$Org->remarks;
                //$aData['data'][$key][]=$Org->status;
            }
        }		
        return $aData;
    }

    public function search($name)
    {
        return $this->context
                    ->db
                    ->select('*')
                    ->from('Customers')
                    ->like("CONCAT_WS(' ',fname, mname,lname)", trim($name),  'right')
                    ->get()->result((string) $this->context->customers());
    }
}