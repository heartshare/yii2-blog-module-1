<?php


namespace asdfstudio\blog;

use Yii;
use yii\base\BootstrapInterface;


class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'asdfstudio\blog\controllers';
    /**
     * URL prefix
     * @var string
     */
    public $urlPrefix = '/blog';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setViewPath(dirname(__FILE__) . '/views');
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            $this->urlPrefix . '' => 'admin/blog/index',
        ]);
    }
}
