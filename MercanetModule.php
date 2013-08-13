<?php

class MercanetModule extends CWebModule {

    public $homeUrl;
    public $themeBasePath = 'mercanet.themes';
    public $theme = 'mercanet';
    public $merchant_id;
    public $username;
    public $password;

    public function init() {
        parent::init();
        $this->homeUrl = "{$this->name}/{$this->defaultController}/index";
        //init theme directory
        Yii::app()->themeManager->basePath = Yii::getPathOfAlias($this->themeBasePath);
        Yii::app()->theme = $this->theme;

        //always use the cms layout, for submodules too
        $this->layoutPath = Yii::getPathOfAlias($this->themeBasePath . '.' .
                        $this->theme .
                        '.views.layouts');

        $this->viewPath = Yii::getPathOfAlias($this->themeBasePath . '.' .
                        $this->theme .
                        '.views');

        Yii::app()->setComponents(
                array(
                    'user' => array(
                        'class' => 'CWebUser',
                        'stateKeyPrefix' => "_{$this->id}",
                        'loginUrl' => "login",
                    ),
                    'messages' => array(
                        'class' => 'CPhpMessageSource',
                        'basePath' => 'protected/modules/mercanet/messages',
                    ),
                    'errorHandler' => array(
                        'errorAction' => "{$this->name}/{$this->defaultController}/error",
                    ),
                )
        );

        // import the module-level models and components
        $this->setImport(array(
            'mercanet.models.*',
            'mercanet.components.*',
        ));
    }

}
