<?php

/**
 * RequestBlock.php
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
 
class RequestBlock extends CWidget {

    /**
     * @property string the content name.
     */
    public $amount;
    public $transaction_id;
    public $order_id;
    public $customer_id;
    public $customer_email;
    public $customer_ip_address;

    /**
     * Runs the widget.
     */
    public function run() {
        $this->render('requestblock', array(
            'amount' => $this->amount,
            'transaction_id' => $this->transaction_id,
            'order_id' => $this->order_id,
            'customer_id' => $this->customer_id,
            'customer_email' => $this->customer_email,
            'customer_ip_address' => $this->customer_ip_address,
        ));
    }

}
