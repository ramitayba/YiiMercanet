<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('mercanet', 'PATHFILE');

$this->breadcrumbs = array(
    Yii::t('mercanet', 'PATHFILE'),
);

foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h1><?= Yii::t('mercanet', 'PATHFILE') ?></h1>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pathfile-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'D_LOGO'); ?>
        <?php echo $form->textField($model, 'D_LOGO'); ?>
        <?php echo $form->error($model, 'D_LOGO'); ?>
        <p class="hint">
            /mercanet/payment/logo/
        </p>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'F_DEFAULT'); ?>
        <?php echo $form->textField($model, 'F_DEFAULT'); ?>
        <?php echo $form->error($model, 'F_DEFAULT'); ?>
        <p class="hint">
            C:\payment\param\parmcom.mercanet
        </p>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'F_PARAM'); ?>
        <?php echo $form->textField($model, 'F_PARAM'); ?>
        <?php echo $form->error($model, 'F_PARAM'); ?>
        <p class="hint">
            C:\payment\param\parmcom
        </p>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'F_CERTIFICATE'); ?>
        <?php echo $form->textField($model, 'F_CERTIFICATE'); ?>
        <?php echo $form->error($model, 'F_CERTIFICATE'); ?>
        <p class="hint">
            C:\payment\param\certif
        </p>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'F_CTYPE'); ?>
        <?php echo $form->dropDownList($model, 'F_CTYPE', array('php' => 'php', 'asp' => 'asp')); ?>
        <?php echo $form->error($model, 'F_CTYPE'); ?>
        <p class="hint">
            
        </p>
    </div>
    <div class="row">
        <?php echo $form->checkBox($model, 'DEBUG'); ?>
        <?php echo $form->label($model, 'DEBUG'); ?>
        <?php echo $form->error($model, 'DEBUG'); ?>
        <p class="hint">
            
        </p>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Generate'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
