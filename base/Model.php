<?php


namespace asdfstudio\blog\base;


use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Model extends ActiveRecord
{
    /**
     * Returns user identity class name
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function getUserIdentityClassName()
    {
        if (isset(Yii::$app->components['user']['identityClass'])) {
            return Yii::$app->components['user']['identityClass'];
        }
        throw new InvalidConfigException('User::identityClass must be set');
    }
}
