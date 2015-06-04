<?php

/**
 * This is the model class for table "{{po_items}}".
 *
 * The followings are the available columns in table '{{po_items}}':
 * @property string $material_id
 * @property string $po_number
 * @property string $qty
 * @property string $qty_units
 * @property string $unit_price
 * @property string $price_units
 * @property string $qty_recieved
 * @property string $qty_diff
 * @property string $date
 */
class PoItems extends CActiveRecord
{
        public $material_cat;
        
        protected function beforeSave() {
            $this->qty_diff = $this->qty_recieved - $this->qty;
            return parent::beforeSave();
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PoItems the static model class
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
		return '{{po_items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material_id, po_number', 'required'),
                        //array('po_number+material_id', 'application.extensions.uniqueMultiColumnValidator'),
//                        array('material_id', 'unique', 'criteria'=>array(
//                            'condition'=>'po_number=:po_number',
//                            'params'=>array(':po_number'=>$this->po_number),
//                            ),
//                            'message'=>'This item already exists for this PO.',
//                        ),
			array('material_id, po_number', 'length', 'max'=>10),
			array('qty, qty_recieved, qty_diff', 'length', 'max'=>12),
			array('qty_units, price_units', 'length', 'max'=>15),
                        array('qty, qty_recieved, qty_diff', 'type', 'type'=>'float'),
			array('unit_price', 'length', 'max'=>6),
                        array('date', 'default', 'value'=>null),
                        //array('material_cat', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('material_id, po_number, qty, qty_units, unit_price, price_units, qty_recieved, qty_diff', 'safe', 'on'=>'search'),
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
			'po_number' => 'Po Number',
			'qty' => 'Qty',
                        'material_cat'=>'Material Category',
			'qty_units' => 'Qty Units',
			'unit_price' => 'Unit Price',
			'price_units' => 'Price Units',
			'qty_recieved' => 'Qty Recieved',
			'qty_diff' => 'Recieved Diff',
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
		$criteria->compare('po_number',$this->po_number,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('qty_units',$this->qty_units,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('price_units',$this->price_units,true);
		$criteria->compare('qty_recieved',$this->qty_recieved,true);
		$criteria->compare('qty_diff',$this->qty_diff,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}