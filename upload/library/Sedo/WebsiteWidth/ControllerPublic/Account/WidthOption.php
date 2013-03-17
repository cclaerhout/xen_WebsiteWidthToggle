<?php
class Sedo_WebsiteWidth_ControllerPublic_Account_WidthOption extends XFCP_Sedo_WebsiteWidth_ControllerPublic_Account_WidthOption
{
	public function actionPreferencesSave()
	{
		$this->_assertPostOnly();
		$widthOption = $this->_input->filterSingle('sedo_website_width', XenForo_Input::UINT);

		$dw = XenForo_DataWriter::create('XenForo_DataWriter_User');
		$dw->setExistingData(XenForo_Visitor::getUserId());
		$dw->set('sedo_website_width', $widthOption);
		$dw->preSave();
		if ($dwErrors = $dw->getErrors())
		{
			return $this->responseError($dwErrors);
		}
		$dw->save();

		return parent::actionPreferencesSave();
	}
}


