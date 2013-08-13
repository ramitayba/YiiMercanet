<?php

$configFile = Yii::getPathOfAlias('webroot.payment') . DIRECTORY_SEPARATOR . 'data';
if (file_exists($configFile)) {
    $data = unserialize(@file_get_contents($configFile));
    //var_dump($data);
} else {
    echo 'You must generate the data file from the  <a href="' . Yii::app()->getBaseUrl(true) . '/mercanet/default/settings">mercanet module</a>';
    return;
}
//		Affectation des paramètres obligatoires

$parm = "merchant_id=" . $data['merchant_id'];
$parm = "$parm merchant_country=" . $data['merchant_country'];
$parm = "$parm amount=" . $amount;
$parm = "$parm currency_code=" . $data['currency_code'];


// Initialisation du chemin du fichier pathfile (à modifier)
//   ex :
//    -> Windows : $parm="$parm pathfile=c:\\repertoire\\pathfile";
//    -> Unix    : $parm="$parm pathfile=/home/repertoire/pathfile";

$parm = "$parm pathfile=" . $data['pathfile'];


//$parm = "$parm transaction_id=" . $transaction_id;
//		Affectation dynamique des autres paramètres
// 		Les valeurs proposées ne sont que des exemples
// 		Les champs et leur utilisation sont expliqués dans le Dictionnaire des données
//
$parm = "$parm normal_return_url=" . $data['normal_return_url'];
$parm = "$parm cancel_return_url=" . $data['cancel_return_url'];
$parm = "$parm automatic_response_url=" . $data['automatic_response_url'];
$parm = "$parm language=" . $data['language'];
$parm = "$parm payment_means=" . implode(',', $data['payment_means']);
$parm = "$parm header_flag=" . $data['header_flag'];
$parm = "$parm capture_day=" . $data['capture_day'];
$parm = "$parm capture_mode=" . $data['capture_mode'];
$parm = "$parm bgcolor=" . $data['bgcolor'];
$parm = "$parm block_align=" . $data['block_align'];
$parm = "$parm block_order=" . $data['block_order'];
$parm = "$parm textcolor=" . $data['textcolor'];
//$parm = "$parm receipt_complement=" . $data['receipt_complement'];
$parm = "$parm caddie=" . $data['caddie'];
$parm = "$parm customer_id=" . $customer_id;
$parm = "$parm customer_email=" . $customer_email;
$parm = "$parm customer_ip_address=" . $customer_ip_address;
//$parm = "$parm data=" . $data['data'];
//$parm = "$parm return_context=" . $data['return_context'];
$parm = "$parm target=" . $data['target'];
$parm = "$parm order_id=" . $order_id;
//		Les valeurs suivantes ne sont utilisables qu'en pré-production
//		Elles nécessitent l'installation de vos fichiers sur le serveur de paiement
//
$parm = "$parm normal_return_logo=" . $data['normal_return_logo'];
$parm = "$parm cancel_return_logo=" . $data['cancel_return_logo'];
$parm = "$parm submit_logo=" . $data['submit_logo'];
$parm = "$parm logo_id=" . $data['logo_id'];
$parm = "$parm logo_id2=" . $data['logo_id2'];
$parm = "$parm advert=" . $data['advert'];
$parm = "$parm background_id=" . $data['background_id'];
$parm = "$parm templatefile=" . $data['templatefile'];
//		insertion de la commande en base de données (optionnel)
//		A développer en fonction de votre système d'information
// Initialisation du chemin de l'executable request (à modifier)
// ex :
// -> Windows : $path_bin = "c:\\repertoire\\bin\\request";
// -> Unix    : $path_bin = "/home/repertoire/bin/request";
//

$path_bin = $data['path_bin_request'];


//	Appel du binaire request

$result = exec("$path_bin $parm");

//	sortie de la fonction : $result=!code!error!buffer!
//	    - code=0	: la fonction génère une page html contenue dans la variable buffer
//	    - code=-1 	: La fonction retourne un message d'erreur dans la variable error
//On separe les differents champs et on les met dans une variable tableau

$tableau = explode("!", "$result");

//	récupération des paramètres

$code = $tableau[1];
$error = $tableau[2];
$message = $tableau[3];

//  analyse du code retour

if (( $code == "" ) && ( $error == "" )) {
    print ("<BR><CENTER>erreur appel request</CENTER><BR>");
    print ("executable request non trouve $path_bin");
}

//	Erreur, affiche le message d'erreur
else if ($code != 0) {
    print ("<center><b><h2>Erreur appel API de paiement.</h2></center></b>");
    print ("<br><br><br>");
    print (" message erreur : $error <br>");
}

//	OK, affiche le formulaire HTML
else {
    print ("<br><br>");

    # OK, affichage du mode DEBUG si activé
    print (" $error <br>");

    print ("  $message <br>");
}
?>