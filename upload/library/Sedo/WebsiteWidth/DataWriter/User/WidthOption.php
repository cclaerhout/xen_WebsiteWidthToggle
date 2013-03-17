<?php
class Sedo_WebsiteWidth_DataWriter_User_WidthOption extends XFCP_Sedo_WebsiteWidth_DataWriter_User_WidthOption 
{
	protected function _getFields() {
		$parent = parent::_getFields();
		$parent['xf_user_option']['sedo_website_width'] = array(
				'type' => self::TYPE_BOOLEAN, 
				'default' => 0
		);

		return $parent;
	}
}
?>

