<!--<div class="row">
<?php //echo $form->labelEx($model, 'merchant_id'); ?>
<?php //echo $form->textField($model, 'merchant_id'); ?>
<?php //echo $form->error($model, 'merchant_id'); ?>
        <p class="hint">
            max 15
        </p>
    </div>-->
<div class="row">
    <?php echo $form->labelEx($model, 'merchant_country'); ?>
    <?php echo $form->dropDownList($model, 'merchant_country', array('be' => 'Belgique', 'fr' => 'France', 'de' => 'Allemagne', 'it' => 'Italie', 'es' => 'Espagne', 'en' => 'Royaume-Uni')); ?>
    <?php echo $form->error($model, 'merchant_country'); ?>
    <p class="hint">

    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'currency_code'); ?>
    <?php
    echo $form->dropDownList($model, 'currency_code', array('978' => 'Euro',
        '840' => 'Dollar Américain',
        '756' => 'Franc Suisse',
        '826' => 'Livre Sterling',
        '124' => 'Dollar Canadien',
        '392' => 'Yen',
        '484' => 'Peso Mexicain',
        '949' => 'Nouvelle Livre Turque',
        '036' => 'Dollar Australien',
        '554' => 'Dollar Néo-Zélandais',
        '578' => 'Couronne Norvégienne',
        '986' => 'Real Brésilien',
        '032' => 'Peso Argentin',
        '116' => 'Riel',
        '901' => 'Dollar de Taiwan',
        '752' => 'Couronne Suédoise',
        '208' => 'Couronne Danoise',
        '410' => 'Won',
        '702' => 'Dollar de Singapour',
        '953' => 'Franc Polynésien',
        '952' => 'Franc CFA',
    ));
    ?>
    <?php echo $form->error($model, 'currency_code'); ?>
    <p class="hint">

    </p>
</div>

<div class="row">
    <?php echo $form->labelEx($model, 'language'); ?>
    <?php
    echo $form->dropDownList($model, 'language', array('fr' => 'Français',
        'ge' => 'Allemand',
        'en' => 'Anglais',
        'sp' => 'Espagnol',
        'it' => 'Italien',));
    ?>
    <?php echo $form->error($model, 'language'); ?>
    <p class="hint">

    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'payment_means'); ?>
    <?php
    echo $form->dropDownList($model, 'payment_means', array('AMEX,2' => 'AMEX',
        'CB,2' => 'CB',
        'MASTERCARD,2' => 'MASTERCARD',
        'VISA,2' => 'VISA',
            ), array('multiple' => 'multiple'));
    ?>
    <?php echo $form->error($model, 'payment_means'); ?>
    <p class="hint">

    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'capture_day'); ?>
    <?php
    $days = array();
    for ($i = 0; $i < 100; $i++)
        $days[$i] = $i;
    echo $form->dropDownList($model, 'capture_day', array(
        $days));
    ?>
    <?php echo $form->error($model, 'capture_day'); ?>
    <p class="hint">

    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'capture_mode'); ?>
    <?php
    echo $form->dropDownList($model, 'capture_mode', array(
        'AUTHOR_CAPTURE' => 'AUTHOR_CAPTURE', 'VALIDATION' => 'VALIDATION'));
    ?>
    <?php echo $form->error($model, 'capture_mode'); ?>
    <p class="hint">

    </p>
</div>