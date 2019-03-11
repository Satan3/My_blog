<?php
use yii\helpers\Html;
?>
<p>Вы ввели следующую информацию</p>

<ul>
    <li><label>Name:<?= Html::encode($model->name)?></label></li>
    <li><label>Email: <?=Html::encode($model->email) ?></label></li>
</ul>
