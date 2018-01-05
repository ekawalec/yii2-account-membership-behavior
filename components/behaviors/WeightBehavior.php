<?php
/**
 * User: e.kawalec@s4studio.pl
 * Date: 2017.10.04
 * Time: 23:57
 */

namespace common\components\behaviors;


use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

class WeightBehavior extends AttributeBehavior
{

    /**
     * @var string the attribute that will receive value
     */
    public $weightAttribute = 'weight';

    /**
     * @var string the attribute that will count max +1 value
     */
    public $idAttribute = 'id';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->weightAttribute,
            ];
        }
    }

    /**
     * @inheritdoc
     *
     */
    protected function getValue($event)
    {
        return ($this->owner)::find()->max($this->idAttribute)+1;
    }



}
