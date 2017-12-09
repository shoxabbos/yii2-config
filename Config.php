<?php

namespace shoxabbos\config;

use Yii;

/**
 * This is the model class for table "simple_config".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $big_value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'simple_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'unique'],
            [['key', 'value', 'big_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'big_value' => Yii::t('app', 'Big Value'),
        ];
    }

    /**
     * @param $key
     * @return null|static
     */
    public function get($key) {
        $config = self::findOne(['key' => $key]);

        if (!$config) {
            $config = new self();
        }

        return $config;
    }

    /**
     * @param $key
     * @param null $value
     * @param null $bigValue
     * @return Config
     */
    public function set($key, $value = null, $bigValue = null) {
        $config = $this->get($key);

        if (!$config) {
            $config = new self();
            $config->key = $key;
        }

        $config->value = $value;
        $config->big_value = $bigValue;
        $config->save();

        return $config;
    }

}