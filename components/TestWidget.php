<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 05.11.2018
 * Time: 13:48
 */

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class TestWidget extends Widget{
    public $name;

    public function init(){
        parent::init();
       ob_start();
    }

    public function run(){
        $content = ob_get_clean();
        $content = mb_strtoupper($content, 'utf-8');
        return $this->render('test', compact('content'));
    }

}