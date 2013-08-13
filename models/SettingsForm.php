<?php

/**
 * SettingsForm.php
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
 
class SettingsForm extends CFormModel {

    public $merchant_id; //without $parm
    public $merchant_country;
    //public $amount;
    public $currency_code;
    public $pathfile;
    //public $transaction_id;
    public $normal_return_url;
    public $cancel_return_url;
    public $automatic_response_url;
    public $language;
    public $payment_means;
    public $header_flag;
    public $capture_day;
    public $capture_mode;
    public $bgcolor;
    public $block_align;
    public $block_order;
    public $textcolor;
    public $receipt_complement;
    public $caddie;
    //public $customer_id;
    //public $customer_email;
    //public $customer_ip_address;
    //public $data;
    //public $return_context;
    public $target;
    //public $order_id;
    public $normal_return_logo;
    public $cancel_return_logo;
    public $submit_logo;
    public $logo_id;
    public $logo_id2;
    public $advert;
    public $background_id;
    public $templatefile;
    public $path_bin_request; //without $parm
    public $path_bin_response; //without $parm

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */

    public function rules() {
        return array(
            array('merchant_country, currency_code,
                pathfile, normal_return_url, cancel_return_url,
                automatic_response_url, language, payment_means,
                path_bin_request, path_bin_response', 'required'),
            array('merchant_country, currency_code,
                pathfile, normal_return_url, cancel_return_url,
                automatic_response_url, language, payment_means,
                logo_id, logo_id2, advert, background_id, templatefile, block_align,
                caddie, target, path_bin_request, path_bin_response', 'safe'),
            array('merchant_country', 'length', 'max' => 2),
            array('bgcolor, textcolor', 'length', 'max' => 6),
            //array('merchant_id', 'length', 'max' => 15),
            array('block_order, logo_id, logo_id2, advert, background_id, templatefile', 'length', 'max' => 32),
            array('normal_return_logo, cancel_return_logo, submit_logo', 'length', 'max' => 50),
            array('normal_return_url, cancel_return_url, automatic_response_url', 'length', 'max' => 511),
            array('caddie', 'length', 'max' => 2048),
            array('receipt_complement', 'length', 'max' => 3072),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array();
    }

}
