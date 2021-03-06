<?php
class Kwc_Abstract_List_Form extends Kwc_Abstract_Form
{
    public $toSaveGeneratorProperty = array();

    public function __construct($name, $class)
    {
        parent::__construct($name, $class);
        $this->setProperty('class', $class);
        $this->add($this->_getMultiFields());
    }
    
    protected function _getMultiFields()
    {
        $multifields = new Kwf_Form_Field_MultiFields('Children');
        $multifields->setMinEntries(0);
        $multifields->setPosition(true);
        if (Kwc_Abstract::getSetting($this->getClass(), 'hasVisible')) {
            $multifields->fields->add(new Kwf_Form_Field_Checkbox('visible', trlKwf('Visible')));
        }

        foreach (Kwf_Component_Data_Root::getInstance()->getPlugins('Kwf_Component_PluginRoot_Interface_GeneratorProperty') as $plugin) {
            $params = $plugin->getGeneratorProperty(Kwf_Component_Generator_Abstract::getInstance($this->getClass(), 'child'));
            if ($params) {
                $multifields->fields->add(new Kwf_Form_Field_Select($params['name'],  $params['label']))
                    ->setValues($params['values'])
                    ->setDefaultValue($params['defaultValue'])
                    ->setData(new Kwf_Component_PluginRoot_GeneratorProperty_Data($plugin, $this));
            }
        }

        $form = Kwc_Abstract_Form::createChildComponentForm($this->getClass(), 'child');
        $form->setIdTemplate('{component_id}-{id}');
        $multifields->fields->add($form);

        return $multifields;
    }

    public function afterSave($parentRow, $postData)
    {
        parent::afterSave($parentRow, $postData);
        foreach ($this->toSaveGeneratorProperty as $i) {
            if (isset($i['row']->component_id)) {
                $id = $i['row']->component_id.'-'.$i['row']->id;
            } else {
                $id = $i['row']->id;
            }
            $data = Kwf_Component_Data_Root::getInstance()->getComponentByDbId($id, array('ignoreVisible'=>true, 'limit'=>1));
            if (!$data) {
                throw new Kwf_Exception("Didn't get data for $id");
            }
            $i['plugin']->saveGeneratorPropertyValue($data, $i['value']);
        }
    }
}
