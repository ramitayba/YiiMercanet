YiiMercanet 0.1
============

Copyright (c) 2013, Mercanet - Rami Tayba. All rights reserved.  
 - See accompanying LICENSE for license information.

Mercanet is an extension to the Yii Framework (http://www.yiiframework.com/license/) 
in the form of a module. Mercanet adds and integrates a payment system based on ATOS 
to an existing Yii application.


##Requirements

Yii 1.1.8 or above.
The application to which Mercanet is added needs to have a user table.


##Usage

* Extract the zip file to the application's protected/modules directory
* Create the subdirectory 'payment' in your application webroot directory to which 
  the application must be given read/write access rights.
* Edit your configuration to register the module (the default option values may 
  need to be adjusted):
~~~
[php]
'modules'=>array(
	'mercanet'=>array(
		'class' => 'application.modules.mercanet.MercanetModule',
        'merchant_id' => '082584341411111',
        'username' => 'admin',
        'password' => '21232f297a57a5a743894a0e4a801fc3', // md5 format
	),
),
~~~

* Mercanet not requires database it's based on data file read/write.
* Log in to the module http://<your base url>/mercanet/default/login.
  use 'admin/admin' for default username/password.
* Configure the Mercanet Pathfile and others param files.
* Not Mendatory: http://<your base url>/mercanet/default/pathfile.
* Configure the Mercanet options http://<your base url>/mercanet/default/settings,
  this will generate a file with name 'data' under /payment directory.

##Usage

The following code must be used to manage request and responce processes:

* in your view file call the request widget:
~~~
[php]
$this->widget('application.widgets.RequestBlock', array(
    'amount' => [amount],
    'transaction_id' => [transaction_id],
    'order_id' => [id_order],
    'customer_id' => [id_customer],
    'customer_email' => [email],
    'customer_ip_address' => $_SERVER['REMOTE_ADDR'],));
~~~

* For the response part use the following code in your action:
~~~
[php]

...

$configFile = Yii::getPathOfAlias('webroot.payment') . DIRECTORY_SEPARATOR . 'data';
    if (file_exists($configFile)) {
        $data = unserialize(@file_get_contents($configFile));
        //var_dump($data);
    } else {
        echo 'You must generate the data file from the  <a href="' . Yii::app()->getBaseUrl(true) . '/mercanet/default/settings">mercanet module</a>';
        return;
    }

// Récupération de la variable cryptée DATA
    $message = "message=$_POST[DATA]";

// Initialisation du chemin du fichier pathfile (à modifier)
//   ex :
//    -> Windows : $pathfile="pathfile=c:\\repertoire\\pathfile";
//    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile";

    $pathfile = "pathfile=" . $data['pathfile'];

// Initialisation du chemin de l'executable response (à modifier)
// ex :
// -> Windows : $path_bin = "c:\\repertoire\\bin\\response";
// -> Unix    : $path_bin = "/home/repertoire/bin/response";
//

    $path_bin = $data['path_bin_response'];

// Appel du binaire response

    $result = exec("$path_bin $pathfile $message");

//	Sortie de la fonction : !code!error!v1!v2!v3!...!v29
//		- code=0	: la fonction retourne les données de la transaction dans les variables v1, v2, ...
//				: Ces variables sont décrites dans le GUIDE DU PROGRAMMEUR
//		- code=-1 	: La fonction retourne un message d'erreur dans la variable error
//	on separe les differents champs et on les met dans une variable tableau

    $tableau = explode("!", $result);

//	Récupération des données de la réponse

    $code = $tableau[1];
    $error = $tableau[2];
    $returnedData['code'] = $code;
    $returnedData['error'] = $error;

//  analyse du code retour

    if (( $code == "" ) && ( $error == "" )) {
        $message = 'executable response non trouve ' . $path_bin;
    }

//	Erreur, affiche le message d'erreur
    else if ($code != 0) {
        $message = 'Erreur appel API de paiement.';
    }

// OK, affichage des champs de la réponse
    else {
        $message = 'Succes';
        $returnedData['message'] = $message;
        $returnedData['merchant_id'] = $tableau[3];
        $returnedData['merchant_country'] = $tableau[4];
        $returnedData['amount'] = $tableau[5];
        $returnedData['transaction_id'] = $tableau[6];
        $returnedData['payment_means'] = $tableau[7];
        $returnedData['transmission_date'] = $tableau[8];
        $returnedData['payment_time'] = $tableau[9];
        $returnedData['payment_date'] = $tableau[10];
        $returnedData['response_code'] = $tableau[11];
        $returnedData['payment_certificate'] = $tableau[12];
        $returnedData['authorisation_id'] = $tableau[13];
        $returnedData['currency_code'] = $tableau[14];
        $returnedData['card_number'] = $tableau[15];
        $returnedData['cvv_flag'] = $tableau[16];
        $returnedData['cvv_response_code'] = $tableau[17];
        $returnedData['bank_response_code'] = $tableau[18];
        $returnedData['complementary_code'] = $tableau[19];
        $returnedData['complementary_info'] = $tableau[20];
        $returnedData['return_context'] = $tableau[21];
        $returnedData['caddie'] = $tableau[22];
        $returnedData['receipt_complement'] = $tableau[23];
        $returnedData['merchant_language'] = $tableau[24];
        $returnedData['language'] = $tableau[25];
        $returnedData['customer_id'] = $tableau[26];
        $returnedData['order_id'] = $tableau[27];
        $returnedData['customer_email'] = $tableau[28];
        $returnedData['customer_ip_address'] = $tableau[29];
        $returnedData['capture_day'] = $tableau[30];
        $returnedData['capture_mode'] = $tableau[31];
        $returnedData['data'] = $tableau[32];
    }
	
...
	
if ($returnedData['code'] == 0) {
    $order->status = 'Completed';
    ...
} else {
    $order->status = 'Failed';
    ...
}
~~~

OR Use the Built in Response component: mercanet\components\Response.php

- method: getResponse()
