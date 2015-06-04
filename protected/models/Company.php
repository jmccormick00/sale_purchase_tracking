<?php

/**
 * This is the model class for table "{{company}}".
 *
 * The followings are the available columns in table '{{company}}':
 * @property string $comp_id
 * @property string $name
 * @property string $description
 * @property string $website
 * @property string $updated
 * @property integer $comp_type_id
 * @property string $telephone
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 * @property CompanyType $compType
 * @property PurchaseOrder[] $purchaseOrders
 * @property SaleOrder[] $saleOrders
 */
class Company extends CActiveRecord
{
        protected function beforeSave() {
            $this->updated = new CDbExpression('NOW()');
            return parent::beforeSave();
        }
        
        public function getSaleOrderComp() {
            return  CHtml::listData(Company::model()->findAll('comp_type_id >= 2'), 'comp_id', 'name');
        }
        
        public function getPurchaseOrderComp() {
            return  CHtml::listData(Company::model()->findAll('comp_type_id = 1 OR comp_type_id = 3'), 'comp_id', 'name');
        }
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return '{{company}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_type_id, name', 'required'),
			array('comp_type_id', 'numerical', 'integerOnly'=>true),
			array('name, website', 'length', 'max'=>128),
			array('telephone', 'length', 'max'=>15),
			array('description, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comp_id, name, description, website, updated, comp_type_id, telephone', 'safe', 'on'=>'search'),
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
			'addresses' => array(self::HAS_MANY, 'Address', 'comp_id'),
			'compType' => array(self::BELONGS_TO, 'CompanyType', 'comp_type_id'),
			//'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'comp_id'),
			//'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'comp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comp_id' => 'Comp',
			'name' => 'Name',
			'description' => 'Description',
			'website' => 'Website',
			'updated' => 'Updated',
			'comp_type_id' => 'Type',
			'telephone' => 'Telephone',
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

		$criteria->compare('comp_id',$this->comp_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('comp_type_id',$this->comp_type_id);
		$criteria->compare('telephone',$this->telephone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}