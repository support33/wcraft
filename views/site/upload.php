<?php

use yii\widgets\ActiveForm;

?>
<div class="header">Загрузка изображения в базу</div>
<p>К изображению будут применены следующие обработки:</p>
<ul class="opt-info-list">
    <li>Ширина уменьшна до <?= Yii::$app->params['img_params']['w']; ?>px</li>
    <li>Высота уменьшна до <?= Yii::$app->params['img_params']['h']; ?>px</li>
    <li>Наложение водяного знака</li>
</ul>



<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'up-form'
    ]
]) ?>
<?= $form->field($model, 'image')->fileInput()->label('Укажите файл'); ?>
<button class="upload-btn">Загрузить</button>
<?php ActiveForm::end() ?>


<?php if ($model->image): ?>
    <div class="img-preview">
        <img src="/img/src/<?= $model->image ?>" alt="">
    </div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>