<?php


namespace asdfstudio\blog;

use Yii;
use yii\base\BootstrapInterface;
use asdfstudio\admin\Module as AdminModule;


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
     * Admin module id
     */
    public $admin = 'admin';

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
            $this->urlPrefix . ''                   => $this->id . '/post/index',
            $this->urlPrefix . '/<id:[\w\d-_]+>'    => $this->id . '/post/view',
        ]);

        $this->registerTranslations();

        if ($this->admin) {
            $admin = Yii::$app->getModule($this->admin);
            if ($admin instanceof AdminModule) {
                $this->registerAdmin($admin);
            }
        }
    }

    /**
     * Register blog in admin module
     * @param AdminModule $admin
     */
    public function registerAdmin($admin)
    {
        $item = \asdfstudio\blog\admin\PostItem::className();
        $admin->registerItem($item);

        $category = $admin->sidebar->addCategory(Yii::t('blog', 'Blog'));
        $category->addItem($item);
    }

    /**
     * Register translations
     */
    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['blog'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@vendor/asdf-studio/yii2-blog-module/messages',
        ];
    }
}
