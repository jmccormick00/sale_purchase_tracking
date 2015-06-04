<?php

/**
 * This is the model class for table "{{material}}".
 *
 * The followings are the available columns in table '{{material}}':
 * @property string $material_id
 * @property string $description
 * @property string $cat_id
 *
 * The followings are the available model relations:
 * @property MaterialCategory $cat
 * @property PurchaseOrder[] $tblPurchaseOrders
 * @property SaleOrder[] $tblSaleOrders
 */
class Material extends CActiveRecord
{
//        public function getMaterial($cat_id) {
//            return  CHtml::listData(Material::model()->findAll('cat_id=:cat_id', array(':cat_id'=>$cat_id)), 'material_id', 'description');
//        }
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Material the static model class
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
		return '{{material}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, description', 'required'),
			array('description', 'length', 'max'=>150),
			array('cat_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('material_id, description, cat_id', 'safe', 'on'=>'search'),
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
			'cat' => array(self::BELONGS_TO, 'MaterialCategory', 'cat_id'),
			//'purchaseOrders' => array(self::MANY_MANY, 'PurchaseOrder', '{{po_items}}(material_id, po_number)'),
			//'saleOrders' => array(self::MANY_MANY, 'SaleOrder', '{{sale_items}}(material_id, sale_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'material_id' => 'Material ID',
			'description' => 'Description',
			'cat_id' => 'Category',
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

		$criteria->compare('material_id',$this->material_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cat_id',$this->cat_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}