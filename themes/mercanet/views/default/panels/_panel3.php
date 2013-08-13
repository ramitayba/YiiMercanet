
<div class="row">
    <?php echo $form->labelEx($model, 'header_flag'); ?>
    <?php
    echo $form->dropDownList($model, 'header_flag', array(
        'no' => 'No',
        'yes' => 'Yes',));
    ?>
    <?php echo $form->error($model, 'header_flag'); ?>
    <p class="hint">

    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'block_align'); ?>
    <?php
    echo $form->dropDownList($model, 'block_align', array(
        'left' => 'left', 'center' => 'center', 'right' => 'right'));
    ?>
    <?php echo $form->error($model, 'block_align'); ?>
    <p class="hint">

    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'block_order'); ?>
    <?php echo $form->textField($model, 'block_order'); ?>
    <?php echo $form->error($model, 'block_order'); ?>
    <p class="hint">
        1,2,3,4,5,6,7,8,9
    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'bgcolor'); ?>
    <?php echo $form->textField($model, 'bgcolor'); ?>
    <?php echo $form->error($model, 'bgcolor'); ?>
    <p class="hint">
        ffffff
    </p>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'textcolor'); ?>
    <?php echo $form->textField($model, 'textcolor'); ?>
    <?php echo $form->error($model, 'textcolor'); ?>
    <p class="hint">
        ffffff
    </p>
</div>