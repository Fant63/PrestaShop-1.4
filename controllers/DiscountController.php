<?php
/*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class DiscountControllerCore extends FrontController
{
	public $auth = true;
	public $php_self = 'discount.php';
	public $authRedirection = 'discount.php';
	public $ssl = true;
	
	public function process()
	{
		parent::process();
		
		$discounts = Discount::getCustomerDiscounts((int)(self::$cookie->id_lang), (int)(self::$cookie->id_customer), true, false);
		$nbDiscounts = 0;
		foreach ($discounts AS $discount)
			if ($discount['quantity_for_user'])
				$nbDiscounts++;

		self::$smarty->assign(array('nbDiscounts' => (int)($nbDiscounts), 'discount' => $discounts));
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display(_PS_THEME_DIR_.'discount.tpl');
	}
}

