<?php

/**
 * This is the model class for table "{{sale_items}}".
 *
 * The followings are the available columns in table '{{sale_items}}':
 * @property string $material_id
 * @property string $sale_id
 * @property string $qty
 * @property string $qty_units
 * @property string $unit_price
 * @property string $price_units
 * @property string $qty_shipped
 * @property string $qty_diff
 * @property string $date
 */
class SaleItems extends CActiveRecord
{
        public $material_cat;
        
        protected function beforeSave() {
            $this->qty_diff = $this->qty_shipped - $this->qty;
            return parent::beforeSave();
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SaleItems the static model class
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
		return '{{sale_items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material_id, sale_id', 'required'),
                        //array('sale_id+material_id', 'application.extensions.uniqueMultiColumnValidator'),
//                        array('material_id', 'unique', 'criteria'=>array(
//                            'condition'=>'sale_id=:sale_id',
//                            'params'=>array(':sale_id'=>$this->sale_id),
//                            ),
//                            'message'=>'This item already exists for this Sale.',
//                        ),
			array('material_id, sale_id', 'length', 'max'=>10),
			array('qty, qty_shipped, qty_diff', 'length', 'max'=>12),
			array('qty_units, price_units', 'length', 'max'=>15),
                        array('qty, qty_shipped, qty_diff', 'type', 'type'=>'float'),
			array('unit_price', 'length', 'max'=>6),
                        array('date', 'default', 'value'=>null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('material_id, sale_id, qty, qty_units, unit_price, price_units, qty_shipped, qty_diff', 'safe', 'on'=>'search'),
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
                    'material' => array(self::BELONGS_TO, 'Material', 'material_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'material_id' => 'Material',
			'sale_id' => 'Sale',
			'qty' => 'Qty',
                        'material_cat'=>'Material Category',
			'qty_units' => 'Qty Units',
			'unit_price' => 'Unit Price',
			'price_units' => 'Price Units',
			'qty_shipped' => 'Qty Shipped',
			'qty_diff' => 'Qty Diff',
                        'date' => 'Date',
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
		$criteria->compare('sale_id',$this->sale_id,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('qty_units',$this->qty_units,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('price_units',$this->price_units,true);
		$criteria->compare('qty_shipped',$this->qty_shipped,true);
		$criteria->compare('qty_diff',$this->qty_diff,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}