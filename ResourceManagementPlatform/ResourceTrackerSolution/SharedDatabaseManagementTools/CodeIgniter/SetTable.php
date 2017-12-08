<?php
namespace ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;


use ResourceTrackerSolution\SharedKernel\IEntity;

final class SetTable
{
    private $tableName;
    private $dbContext;
    private $entity;

    public function __construct(IEntity $entity, $dbContext)
    {
        $this->entity = $entity;
        $this->tableName = (string) $entity;
        $this->dbContext = $dbContext;
    }

    public function find($id)
    {
        $result = $this->dbContext
            ->get_where($this->tableName, array('id' => $id))
            ->row();
        if(empty($result)) return;
        return $this->setPublicAndProtectedFields($this->entity, $result);
    }

    public function fetch()
    {
        $this->dbContext->order_by('id', 'desc');
        $result = $this->dbContext->get($this->tableName)->result(get_class($this->entity));

        if (empty($result)) return;
        return $result;
    }

    public function add(IEntity $entity)
    {
        // print_r($this->tableName. "dfgh");
        // print_r($this->getPublicAndProtectedFields($entity));
        // exit();
            
        $this->dbContext->insert($this->tableName,
            $this->getPublicAndProtectedFields($entity));
        $entity->setId($this->dbContext->insert_id());
       //  print_r($this->dbContext->last_query()); exit();
    }

    public function update(IEntity $entity)
    {
        $this->dbContext->where('id', $entity->getId());
        $this->dbContext->update($this->tableName,
            $this->getPublicAndProtectedFields($entity));
    }

    public function remove($id)
    {
        $this->dbContext->where('id', $id);
        $this->dbContext->delete($this->tableName);
    }

    private function getPublicAndProtectedFields(IEntity $entity)
    {
        $reflect = new \ReflectionClass(get_class($entity));
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        $properties = array();
        $values = array();
        if (!empty($props)) {
            foreach ($props as $prop) {
                $proper = $reflect->getProperty($prop->getName());
                $proper->setAccessible(true);
                $values[$prop->getName()] = $proper->getValue($entity);
            }
        }
        return $values;
    }

    private function setPublicAndProtectedFields(IEntity $entity, $object)
    {
        $reflect = new \ReflectionObject($entity);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        $properties = array();
        $values = array();
        if (!empty($props)) {
            foreach ($props as $prop) {
                $proper = $reflect->getProperty($prop->getName());
                $proper->setAccessible(true);
                $proper->setValue($entity, $object->{$prop->getName()});
            }
        }

        return $entity;
    }


    public function fetchForServerSideGrid($aGridData,$aColumns)
    {
        // Paging
        if(isset($aGridData['iDisplayStart']) && $aGridData['iDisplayLength'] != '-1'){
           $this->dbContext->limit($this->dbContext->escape_str($aGridData['iDisplayLength']), 
                                     $this->dbContext->escape_str($aGridData['iDisplayStart']));
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
                    $this->dbContext->order_by($aColumns[intval($this->dbContext->escape_str($iSortCol))], $this->dbContext->escape_str($sSortDir));
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
                    $this->dbContext->or_like($aColumns[$i], $this->dbContext->escape_like_str($aGridData['sSearch']));
                }
            }
        }
        
        // Select Data
        $this->dbContext->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->dbContext->get($this->tableName);
        
        
        // Data set length after filtering
        $this->dbContext->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->dbContext->get()->row()->found_rows;
        
        
        // Total data set length
        $iTotal = $this->dbContext->count_all($this->tableName);
        //return $this->dbContext->get()->result((string) $this->context->customers());
        
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
    
    public function fetchForServerSideGridWhere($aGridData,$aColumns,$aColumnsWhere)
    {
        // Paging
        if(isset($aGridData['iDisplayStart']) && $aGridData['iDisplayLength'] != '-1'){
           $this->dbContext->limit($this->dbContext->escape_str($aGridData['iDisplayLength']), 
                                     $this->dbContext->escape_str($aGridData['iDisplayStart']));
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
                    $this->dbContext->order_by($aColumns[intval($this->dbContext->escape_str($iSortCol))], $this->dbContext->escape_str($sSortDir));
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
                    $this->dbContext->or_like($aColumns[$i], $this->dbContext->escape_like_str($aGridData['sSearch']));
                }
            }
        }
        
         // Filtering
        // NOTE this does not match the built-in DataTables filtering which does it
        // word by word on any field. It's possible to do here, but concerned about efficiency
        // on very large tables, and MySQL's regex functionality is very limited
        if(isset($aGridData['sSearch_where']) && !empty($aGridData['sSearch_where'])){
            for($i=0; $i<count($aColumnsWhere); $i++){
                $this->dbContext->or_where($aColumnsWhere[$i], $this->dbContext->escape_like_str($aGridData['sSearch_where']));
            }
        }
        
        
        // Select Data
        $this->dbContext->select(str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->dbContext->get($this->tableName);
        
        
        // Data set length after filtering
        $this->dbContext->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->dbContext->get()->row()->found_rows;
        
        
        // Total data set length
        $iTotal = $this->dbContext->count_all($this->tableName);
        //return $this->dbContext->get()->result((string) $this->context->customers());
        
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
    public function __toString()
    {
        return get_class($this->entity);
    }
}

