<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockUserInfo extends Module
{
	public function __construct()
	{
		$this->name = 'blockuserinfo';
		$this->tab = 'front_office_features';
		$this->version = 0.1;

		parent::__construct();
		
		$this->displayName = $this->l('User info block');
		$this->description = $this->l('Adds a block that displays information about the customer');
	}

	public function install()
	{
		return (parent::install() AND $this->registerHook('top') AND $this->registerHook('header'));
	}

	/**
	* Returns module content for header
	*
	* @param array $params Parameters
	* @return string Content
	*/
	public function hookTop($params)
	{
		global $smarty, $cookie, $cart;
		$smarty->assign(array(
			'cart' => $cart,
			'cart_qties' => $cart->nbProducts(),
			'logged' => $cookie->isLogged(),
			'customerName' => ($cookie->logged ? $cookie->customer_firstname.' '.$cookie->customer_lastname : false),
			'firstName' => ($cookie->logged ? $cookie->customer_firstname : false),
			'lastName' => ($cookie->logged ? $cookie->customer_lastname : false),
			'order_process' => Configuration::get('PS_ORDER_PROCESS_TYPE') ? 'order-opc' : 'order'
		));
		return $this->display(__FILE__, 'blockuserinfo.tpl');
	}
	
	public function hookHeader($params)
	{
		Tools::addCSS(($this->_path).'blockuserinfo.css', 'all');
	}
}

?>
