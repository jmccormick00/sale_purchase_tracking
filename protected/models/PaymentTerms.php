<?php

/**
 * This is the model class for table "{{payment_terms}}".
 *
 * The followings are the available columns in table '{{payment_terms}}':
 * @property string $term_id
 * @property string $description
 *
 * The followings are the available model relations:
 * @property PurchaseOrder[] $purchaseOrders
 * @property SaleOrder[] $saleOrders
 */
class PaymentTerms extends CActiveRecord
{
    
        public function getPaymentTerms() {
            return  CHtml::listData(PaymentTerms::model()->findAll(), 'term_id', 'description');
        }
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PaymentTerms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{payment_terms}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('term_id, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'payment_term_id'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'payment_term_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'term_id' => 'Term',
			'description' => 'Payment Term',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('term_id',$this->term_id,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}