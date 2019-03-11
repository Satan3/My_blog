<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 31.10.2018
 * Time: 21:05
 */
use yii\helpers\Html;
?>
<title><?$this->title = "Ответ сервера";?></title>

<p>Вы ввели: <?=Html::encode($model->term)?></p>
<p>Ответ серва: <pre><?=print_r($message)?></pre>
