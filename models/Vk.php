<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 31.10.2018
 * Time: 20:41
 */


namespace app\models;

use yii\base\Model;

class Vk extends Model
{
    public $term;

    public function rules()
    {
        return [
            [['term'], 'required']
        ];
    }
}