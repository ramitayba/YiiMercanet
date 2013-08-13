<?php

/**
 * DefaultController.php
 *
 * This is the defaultcontroller for the mercanet
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
 
class DefaultController extends Controller {

    //public $layout = '//layouts/column1';
    
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'login'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('logout', 'pathfile', 'settings'),
                'users' => array($this->module->username),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {
        if (Yii::app()->user->getId())
            $this->redirect(Yii::app()->createUrl($this->module->homeUrl));

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->createUrl($this->module->homeUrl));
            }
        }

        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->createUrl($this->module->homeUrl));
    }

    public function actionPathFile() {
        $model = new PathFileForm();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'path-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['PathFileForm'])) {
            $model->attributes = $_POST['PathFileForm'];
            // validate user input and redirect to the previous page if valid
            $debug = 'NO';
            if ($model->validate()) {
                if ($model->DEBUG == 1) {
                    $debug = 'YES';
                }

                $data = <<<EOT
#########################################################################
#
#	Pathfile 
#
#	Liste des fichiers parametres utilises par le module de paiement
#
#########################################################################
#
#
#-------------------------------------------------------------------------
# Activation (YES) / Désactivation (NO) du mode DEBUG
#-------------------------------------------------------------------------
#
DEBUG!$debug!
#
# ------------------------------------------------------------------------
# Chemin vers le répertoire des logos depuis le web alias  
# Exemple pour le répertoire www.merchant.com/mercanet/payment/logo/
# indiquer:
# ------------------------------------------------------------------------
#
D_LOGO!$model->D_LOGO!
#
# --------------------------------------------------------------------------
#  Fichiers paramètres liés a l'api mercanet paiement	
# --------------------------------------------------------------------------
#
# fichier des  paramètres mercanet
#
F_DEFAULT!$model->F_DEFAULT!
#
# fichier paramètre commercant
#
F_PARAM!$model->F_PARAM!
#
# certicat du commercant
#
F_CERTIFICATE!$model->F_CERTIFICATE!
# 
# type du certificat 	
# 
F_CTYPE!$model->F_CTYPE!
#
# --------------------------------------------------------------------------
# 	end of file
# --------------------------------------------------------------------------
EOT;


                $registrationDir = Yii::getPathOfAlias('webroot.payment');
                $paramDir = Yii::getPathOfAlias('webroot.payment.param');
                $registrationDirReady = true;
                $paramDirReady = true;
                if (!file_exists($registrationDir)) {
                    if (!mkdir($registrationDir) || !chmod($registrationDir, 0775)) {
                        $registrationDirReady = false;
                    }
                }
                if (!file_exists($paramDir)) {
                    if (!mkdir($paramDir) || !chmod($paramDir, 0775)) {
                        $paramDirReady = false;
                    }
                }

                if ($registrationDirReady && $paramDirReady && file_put_contents($paramDir . DIRECTORY_SEPARATOR . 'pathfile', $data))
                    Yii::app()->user->setFlash('success', "PATHFILE successfully created");
                else
                    Yii::app()->user->setFlash('error', "PATHFILE cannot be created");
                $this->redirect(Yii::app()->createUrl($this->module->id . '/' . $this->id . '/pathfile/'));
            }
        }

        $this->render('pathfile', array('model' => $model));
    }

    public function actionsettings() {

        $model = new SettingsForm();

        $configPaymentDir = Yii::getPathOfAlias('webroot.payment');
        $configPaymentDirReady = true;
        if (!file_exists($configPaymentDir)) {
            if (!mkdir($configPaymentDir) || !chmod($configPaymentDir, 0775)) {
                $configPaymentDirReady = false;
            }
        }

        // load data if exists
        $configFile = Yii::getPathOfAlias('webroot.payment') . DIRECTORY_SEPARATOR . 'data';
        if (file_exists($configFile)) {
            $data = unserialize(@file_get_contents($configFile));
            $model->attributes = $data;
        }

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'settings-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['SettingsForm'])) {
            $model->attributes = $_POST['SettingsForm'];
            $model->merchant_id = $this->module->merchant_id;
            $data = $model->attributes;

            // validate user input and redirect to the previous page if valid
            if ($model->validate(array('payment_means'))) {

                $configPaymentDir = Yii::getPathOfAlias('webroot.payment');
                $configPaymentDirReady = true;
                if (!file_exists($configPaymentDir)) {
                    if (!mkdir($configPaymentDir) || !chmod($configPaymentDir, 0775)) {
                        $configPaymentDirReady = false;
                    }
                }

                if ($configPaymentDirReady && file_put_contents($configPaymentDir . DIRECTORY_SEPARATOR . 'data', serialize($data)))
                    Yii::app()->user->setFlash('success', "config successfully created");
                else
                    Yii::app()->user->setFlash('error', "config cannot be created");
                $this->redirect(Yii::app()->createUrl($this->module->id . '/' . $this->id . '/settings/'));
            }
        }
        $this->render('settings', array('model' => $model));
    }

}