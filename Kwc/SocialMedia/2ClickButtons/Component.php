<?php
class Kwc_SocialMedia_2ClickButtons_Component extends Kwc_Abstract
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['componentName'] = trlKwfStatic('2 click social media buttons');
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_Form';
        $ret['ownModel'] = 'Kwf_Component_FieldModel';
        $ret['cssClass'] = 'webStandard webListNone';
        $ret['assets']['dep'][] = 'socialshareprivacy';
        return $ret;
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer = null)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['config'] = array(
            'showFacebook' => ($ret['row']->facebook) ? 1 : 0,
            'showTwitter' => ($ret['row']->twitter) ? 1 : 0,
            'showGoogle' => ($ret['row']->google) ? 1 : 0,
            'services' => array(
                'facebook' => array(
                    'txtInfo' => $this->getData()->trlKwf('2 clicks for more privacy: When you click here the button will be activated and you can send your recommendation. As soon as the button is activated data will be send to third party &ndash; for details click on <em>i</em>.'),
                    'txtFbOff' => $this->getData()->trlKwf('not connected to Facebook'),
                    'txtFbOn' => $this->getData()->trlKwf('connected to Facebook'),
                    'dummyCaption' => $this->getData()->trlKwf('Recommend'),
                    'language' => $this->getData()->trlKwf('en_US')
                ),
                'twitter' => array(
                    'txtInfo' => $this->getData()->trlKwf('2 clicks for more privacy: When you click here the button will be activated and you can send your recommendation. As soon as the button is activated data will be send to third party &ndash; for details click on <em>i</em>.'),
                    'txtTwitterOff' => $this->getData()->trlKwf('not connected to Twitter'),
                    'txtTwitterOn' => $this->getData()->trlKwf('connected to Twitter'),
                    'dummyCaption' => $this->getData()->trlKwf('Tweet'),
                    'language' => $this->getData()->getLanguage()
                ),
                'gplus' => array(
                    'txtInfo' => $this->getData()->trlKwf('2 clicks for more privacy: When you click here the button will be activated and you can send your recommendation. As soon as the button is activated data will be send to third party &ndash; for details click on <em>i</em>.'),
                    'txtGPlusOff' => $this->getData()->trlKwf('not connected to Google+'),
                    'txtGPlusOn' => $this->getData()->trlKwf('connected to Google+'),
                    'language' => $this->getData()->getLanguage()
                )
            ),
            'txtHelp' => $this->getData()->trlKwf('If you activate these buttons with a click informations will be send to Facebook, Twitter or Google in the USA and may be stored there. For details click on <em>i</em>.'),
            'settingsPerma' => $this->getData()->trlKwf('Agree permanent activation and data transfer:'),
            'settings' => $this->getData()->trlKwf('settings')
        );
        return $ret;
    }

    public function hasContent()
    {
        $row = $this->getRow();
        if ($row->facebook || $row->twitter || $row->google) return true;
        return false;
    }


}
