<?php
class Kwc_Box_HomeLink_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['placeholder']['linkText'] = trlKwfStatic('Home');
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['home'] = $this->getData()->getSubroot()->getChildPage(array('home' => true), array());
        return $ret;
    }
}
