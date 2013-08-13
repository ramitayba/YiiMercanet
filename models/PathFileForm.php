<?php

/**
 * PathFileForm.php
 *
 * PHP version 5.2+
 *
 * @author Rami Tayba <rami[dot]tayba[at]gmail[dot]com>
 * @copyright 2013 SearchAndConnect.com
 * @license New BSD License
 * @category User Interface
 * @package modules.mercanet.mercanetModule
 * @version 0.1
 * @since 0.1
 */

class PathFileForm extends CFormModel {

    public $DEBUG;
    public $D_LOGO;
    public $F_DEFAULT;
    public $F_PARAM;
    public $F_CERTIFICATE;
    public $F_CTYPE;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('D_LOGO, F_DEFAULT, F_PARAM, F_CERTIFICATE, F_CTYPE', 'required'),
            array('DEBUG', 'boolean'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
        );
    }

}
