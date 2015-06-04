<?php

/**
 * This is the model class for table "{{sale_order}}".
 *
 * The followings are the available columns in table '{{sale_order}}':
 * @property string $sale_id
 * @property string $po_number
 * @property string $maturity_date
 * @property string $created
 * @property string $updated
 * @property string $comments
 * @property string $comp_id
 * @property string $payment_term_id
 * @property integer $is_open
 * @property string $address_id
 * @property string $contact
 * @property string $contact_telephone
 *
 * The followings are the available model relations:
 * @property Material[] $tblMaterials
 * @property Address $address
 * @property Company $comp
 * @property PaymentTerms $paymentTerm
 */
class SaleOrder extends CActiveRecord
{
    public $comp_name;
    
        protected function beforeSave() {
            if($this->isNewRecord) {
                $this->created =new CDbExpression('NOW()');
                $this->updated =new CDbExpression('NOW()');
            } else {
                $this->updated =new CDbExpression('NOW()');
            }
            return parent::beforeSave();
        }
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SaleOrder the static model class
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
		return '{{sale_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_id, payment_term_id, address_id, maturity_date', 'required'),
			array('is_open', 'numerical', 'integerOnly'=>true),
			array('po_number', 'length', 'max'=>30),
			array('comp_id, payment_term_id, address_id', 'length', 'max'=>10),
			array('contact', 'length', 'max'=>150),
			array('contact_telephone', 'length', 'max'=>15),
			array('maturity_date, created, updated, comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sale_id, po_number, maturity_date, created, updated, comments, comp_name, payment_term_id, is_open, address_id, contact, contact_telephone', 'safe', 'on'=>'search'),
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
			'materials' => array(self::MANY_MANY, 'Material', '{{sale_items}}(sale_id, material_id)'),
			'address' => array(self::BELONGS_TO, 'Address', 'address_id'),
			'comp' => array(self::BELONGS_TO, 'Company', 'comp_id'),
			'paymentTerm' => array(self::BELONGS_TO, 'PaymentTerms', 'payment_term_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sale_id' => 'Sale Number',
			'po_number' => 'PO Number',
			'maturity_date' => 'Maturity Date',
			'created' => 'Created',
			'updated' => 'Updated',
			'comments' => 'Comments',
			'comp_id' => 'Customer',
                        'comp_name' => 'Customer',
			'payment_term_id' => 'Payment Term',
			'is_open' => 'State',
			'address_id' => 'Shipping Address',
			'contact' => 'Contact',
			'contact_telephone' => 'Contact Telephone',
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
                
                $criteria->together = true;
                $criteria->with = array('comp');
                $criteria->compare('comp.name', $this->comp_name, true);

		$criteria->compare('sale_id',$this->sale_id,true);
		$criteria->compare('po_number',$this->po_number,true);
		$criteria->compare('maturity_date',$this->maturity_date,true);
		//$criteria->compare('created',$this->created,true);
		//$criteria->compare('updated',$this->updated,true);
		//$criteria->compare('comp_id',$this->comp_id,true);
		$criteria->compare('payment_term_id',$this->payment_term_id,true);
		$criteria->compare('is_open',$this->is_open);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('contact_telephone',$this->contact_telephone,true);
                
                $sort = new CSort;
                $sort->attributes=array(
                    'comp_name'=>array(
                        'asc'=>'comp.name',
                        'desc'=>'comp.name DESC',
                    ),
                    'maturity_date'=>array(
                        'asc'=>'maturity_date',
                        'desc'=>'maturity_date DESC',
                    ),
                    'sale_id'=>array(
                        'asc'=>'sale_id',
                        'desc'=>'sale_id DESC',
                    ),
                    'po_number'=>array(
                        'asc'=>'po_number',
                        'desc'=>'po_number DESC',
                    ),
                );
				$sort->defaultOrder='sale_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
}