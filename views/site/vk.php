<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 31.10.2018
 * Time: 20:39
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\TestWidget;
?>

<? TestWidget::begin();?>
<p>Suck my ass!</p>
<? TestWidget::end();?>

    <h1>Тут будем выполнять запрос к Вк</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'term') ?>


    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>