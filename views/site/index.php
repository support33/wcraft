<?php

use yii\widgets\ActiveForm;

?>

<div class="image-wrap">
    <?php if (isset($files)): ?>
        <section class="images-box">
            <h2>Список оптимизированных файлов</h2>
            <ul class="images-list">
                <?php foreach ($files as $key => $file): ?>
                    <li class="images-list__item">
                       <img src="/img/result/<?= $file ?>" alt="">
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>
</div>
