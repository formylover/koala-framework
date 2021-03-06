<?php
class Kwc_Advanced_GoogleMapViewManual_Root extends Kwf_Component_NoCategoriesRoot
{
    public static function getSettings()
    {
        $ret = parent::getSettings();
        $ret['generators']['page']['model'] = new Kwf_Model_FnF(array('data'=>array(
            array('id'=>2000, 'pos'=>1, 'visible'=>true, 'name'=>'Foo', 'filename' => 'foo', 'custom_filename' => false,
                'parent_id'=>'root', 'component'=>'gmapView', 'is_home'=>false, 'category' =>'main', 'hide'=>false, 'parent_subroot_id' => 'root')
        )));
        $ret['generators']['page']['component'] = array(
            'gmapView' => 'Kwc_Advanced_GoogleMapViewManual_TestComponent',
        );

        unset($ret['generators']['title']);
        unset($ret['generators']['box']);
        return $ret;
    }
}

