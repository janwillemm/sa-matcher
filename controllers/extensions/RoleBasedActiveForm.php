<?php
namespace app\controllers\extensions;
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 04/02/16
 * Time: 14:28
 *
 * Idea came from
 *
 * http://stackoverflow.com/questions/28531284/yii2-specific-form-field-editable-based-on-role
 *
 */

use kartik\widgets\ActiveForm;

class RoleBasedActiveForm extends ActiveForm {

    const EDITABLE = 0;
    const NONEDITABLE = 1;
    const INVISIBLE = 2;


    /**
     * @param $model
     * @param $attribute
     * @param array $options adds the option of access_rule
     *      If this equals 0 its editable
     *      If this equals 1 its non editable
     *      If this equals 2 its not visible and not editable
     *
     * @return the field as defined by the parent
     */
    public function field($model, $attribute, $options = []) {
        if(!isset($options)) {
            return parent::field($model, $attribute);
        }
        if(!isset($options['access_rule'])) {
            return parent::field($model, $attribute, $options);
        }

        // There are access rules for this field

        $rule = $options['access_rule'];
        unset($options['access_rule']);
        return $this->_fieldWithAccessRules($model, $attribute, $options, $rule);
    }

    private function _fieldWithAccessRules($model, $attribute, $options, $rule){
        switch($this->_verifyAccessRules($rule)){
            case self::EDITABLE:
                return parent::field($model, $attribute, $options);
            case self::NONEDITABLE:
                return parent::field($model, $attribute, array_merge($options, [
                    'template' => '{label}' . $model->$attribute,
                ]));
            case self::INVISIBLE:
                return;
        }


    }

    private function _verifyAccessRules($rule){
        return is_int($rule) ? $rule : 1;
    }

}