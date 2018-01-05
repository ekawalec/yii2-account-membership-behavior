<?php

namespace common\components\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;


/**
 * AccountMembershipBehavior automatically fills the specified attributes with the current Account Id value.
 *
 * To use AccountMembershipBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 * use yii\behaviors\AccountMembershipBehavior;
 *
 * public function behaviors()
 * {
 *     return [
 *         AccountMembershipBehavior::className(),
 *     ];
 * }
 * ```
 *
 * By default, AccountMembershipBehavior will fill the `account_id` attributes with the current user account_id
 * when the associated AR object is being inserted;
 *
 * Because attribute values will be set automatically by this behavior, they are usually not user input and should therefore
 * not be validated, i.e. `account_id` should not appear in the [[\yii\base\Model::rules()|rules()]] method of the model.
 *
 * For the above implementation to work with MySQL database, please declare the columns(`account_id`) as int(11) for being Integer type.
 *
 * If your attribute names are different or you want to use a different way of calculating account_id,
 * you may configure the [[accountIdAttribute]] and [[value]] properties like the following:
 *
 * ```php
 * use yii\db\Expression;
 *
 * public function behaviors()
 * {
 *     return [
 *         [
 *             'class' => AccountMembershipBehavior::className(),
 *             'accountIdAttribute' => 'instance_id',
 *             'value' => Yii::$app->user->identity->instance_id,
 *         ],
 *     ];
 * }
 * ```
 *
 * @author Edmund Kawalec <e.kawalec@gmail.com>
 * @since 2.0
 */

class AccountMembershipBehavior extends AttributeBehavior
{

    /**
     * @var string the attribute that will receive timestamp value
     * Set this property to false if you do not want to record the creation time.
     */
    public $accountIdAttribute = 'account_id';

    /**
     * @inheritdoc
     *
     * In case, when the value is `null`, the result of the actual account_id
     * will be used as value.
     */
    public $value;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->accountIdAttribute,
                BaseActiveRecord::EVENT_BEFORE_VALIDATE => $this->accountIdAttribute,
            ];
        }
    }

    /**
     * @inheritdoc
     *
     * In case, when the [[value]] is `null`, the result of the actual account_id
     * will be used as value.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            return \Yii::$app->user->identity->{$this->accountIdAttribute};
        }
        return parent::getValue($event);
    }


}
