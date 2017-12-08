<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter;

class MY_Controller extends CI_Controller {
	
	public $current_user;
	public $user;
	public $menu;
	public $page;
    private $context;
    
	public function __construct()
	{
		parent::__construct();
		
        $this->context = new CodeIgniter\ResourceManagementContext();
        //@todo replace with session value of user id
        $this->current_user = $this->context->users()->find($this->session->userdata('userId'));
        
        if(empty($this->current_user))
        {
        	redirect('/login/logout');
        }

		$this->menu = $this->menu_prep();
		$this->user = $this->current_user;
		$this->page = $this->menuCurrent();
		
	}
	
	private function menu()
	{
		return $this->context
					->db
					->select('m.id, m.label, m.link, m.icon, m.parent')
					->from('Menu m')
					->join('Privileges p', 'm.id = p.menuid')
					->where('p.userid', $this->current_user->getId())
					->where('deleted',0)
					->order_by('m.parent','asc')
					->order_by('m.sort','asc')
					->get()->result((string)$this->context->menu());
		
	}
	
	private function menuCurrent()
	{
		$aReturn = array();
		$sCurrPage = str_replace(base_url(),'base_url/',current_url());
		$oResult   = $this->context
							->db
							->select('curr.label as cLbl, curr.link  as cLink, curr.icon as cIcon, prnt.label as pLbl, prnt.link as pLink, prnt.icon as pIcon')
							->from('Menu curr')
							->join('Menu prnt', 'curr.parent = prnt.id AND curr.parent > 0', 'left')
							->where('curr.link', $sCurrPage)
							->order_by('curr.parent','asc')
							->order_by('curr.sort','asc')
							->limit(1)
							->get()->result((string)$this->context->menu());
		
		if (count($oResult) > 0){
			
			foreach ($oResult as $s=>$oPage) {
				$aReturn['currPage'] = $oPage->cLbl;
				$aReturn['currLink'] = str_replace('base_url/',base_url(),$oPage->cLink);
				$aReturn['currIcon'] = $oPage->cIcon;
				$aReturn['prntPage'] = $oPage->pLbl;
				$aReturn['prntLink'] = str_replace('base_url/',base_url(),$oPage->pLink);
				$aReturn['prntIcon'] = $oPage->pIcon;
			}
		}else{
				$aReturn['currPage'] = '';
				$aReturn['currLink'] = '';
				$aReturn['currIcon'] = '';
				$aReturn['prntPage'] ='';
				$aReturn['prntLink'] = '';
				$aReturn['prntIcon'] = '';
		}
		
		return $aReturn;
	}
	
	private function menu_prep(){
		$aMenu = array();
		$aAllMenu = $this->menu();
		if(is_array($aAllMenu)){
			foreach ($aAllMenu as $nKey=>$oKey) {
				if($oKey->label != 'Profile'){
					$sLink = "#";
					if(trim($oKey->link)<>'') {
						$sLink = str_replace('base_url/',base_url(),$oKey->link);		
					}
					
					if($oKey->parent == 0){
						$aMenu[$oKey->id] = array('label'=>$oKey->label,
												  'link'=>$sLink,
												  'icon'=>$oKey->icon);
					}else{
						$aMenu[$oKey->parent]['sub'][$oKey->id] = array('label'=>$oKey->label,
																		'link'=>$sLink,
															    		'icon'=>$oKey->icon);
					}
				}
			}
		}
		unset($aAllMenu,$sLink);
		return $aMenu;
	}
	
	public function sys_date_format($sDate){
		$sRetDate = NULL;
		if(trim($sDate)<>''){
			if(strpos($sDate,'00-') == false){
				$sRetDate = mdate($this->config->item('short_date_format'),mysql_to_unix($sDate));	
			}
		}
		return $sRetDate;
	}
	
	public function mysql_date_format($sDate){
		$sRetDate = NULL;
		if(trim($sDate)<>''){
			if(strpos($sDate,'00-') == false){
				$sRetDate = date ("Y-m-d H:i:s", $sDate);
			}
		}
		return $sRetDate;
	}

// 	$this->load->library('session');
// $this->session->set_userdata(array(
//     'user_id'  => $user->uid,
//     'username' => $user->username,
//     'groupid'  => $user->groupid,
//     'date'     => $user->date_cr,
//     'serial'   => $user->serial,
//     'rec_id'   => $user->rec_id,
//     'status'   => TRUE
// ));
}
