<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('mercanet', 'SETTINGS');

$this->breadcrumbs = array(
    Yii::t('mercanet', 'SETTINGS'),
);

foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h1><?= Yii::t('mercanet', 'SETTINGS') ?></h1>



<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'settings-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    $form->errorSummary($model);
    ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
        'panels' => array(
            'Account Details' => $this->renderPartial('panels/_panel1', array('form' => $form, 'model' => $model), true),
            'Configuration' => $this->renderPartial('panels/_panel2', array('form' => $form, 'model' => $model), true),
            'Personalisation' => $this->renderPartial('panels/_panel3', array('form' => $form, 'model' => $model), true),
        ),
        // additional javascript options for the accordion plugin
        'options' => array(
            //'animated' => 'bounceslide',
            'collapsible' => true,
            'active' => false,
            'heightStyle' => 'content'
        ),
        'htmlOptions' => array(
        ),
    ));
    ?>
    <div class="row buttons">
<?php echo CHtml::submitButton('Generate'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->