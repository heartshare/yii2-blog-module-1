<?php


namespace asdfstudio\blog\models;

use Yii;
use asdfstudio\blog\base\Model;
use yii\base\InvalidCallException;
use yii\behaviors\TimestampBehavior;
use yii\web\User;


/**
 * Class Post
 * @package asdfstudio\blog\models
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $owner_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $published_at
 * @property User $owner
 */
class Post extends Model
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'string', 'length' => [1, 255]],
            ['content', 'string'],
            [['created_at', 'updated_at', 'published_at', 'status', 'owner_id'], 'integer'],
            [['owner'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'Id'),
            'title' => Yii::t('blog', 'Title'),
            'slug' => Yii::t('blog', 'URL slug'),
            'content' => Yii::t('blog', 'Content'),
            'status' => Yii::t('blog', 'Status'),
            'owner' => Yii::t('blog', 'Owner'),
            'owner_id' => Yii::t('blog', 'Owner'),
            'created_at' => Yii::t('blog', 'Created date'),
            'updated_at' => Yii::t('blog', 'Updated date'),
            'published_at' => Yii::t('blog', 'Published date'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_post}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne($this->getUserIdentityClassName(), ['id' => 'owner_id']);
    }

    /**
     * @param integer $owner
     */
    public function setOwner($owner)
    {
        $this->owner_id = $owner;
    }

    public function publish()
    {
        if ($this->status === self::STATUS_PUBLISHED) {
            throw new InvalidCallException('Post already published');
        }
        $this->status = self::STATUS_PUBLISHED;
        $this->published_at = time();
        return $this;
    }

    public static function findOneBySlug($slug)
    {
        return static::findOne(['slug' => $slug]);
    }
}
