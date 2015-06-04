<?php

/**
 * This is the model class for table "{{purchase_order}}".
 *
 * The followings are the available columns in table '{{purchase_order}}':
 * @property string $po_number
 * @property string $maturity_date
 * @property string $created
 * @property string $updated
 * @property string $payment_term_id
 * @property string $comp_id
 * @property string $comments
 * @property integer $is_open
 * @property string $contact
 * @property string $contact_telephone
 *
 * The followings are the available model relations:
 * @property Material[] $tblMaterials
 * @property Company $comp
 * @property PaymentTerms $paymentTerm
 */
class PurchaseOrder extends CActiveRecord
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
	 * @return PurchaseOrder the static model class
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
		return '{{purchase_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_term_id, comp_id, maturity_date', 'required'),
			array('is_open', 'numerical', 'integerOnly'=>true),
			array('payment_term_id, comp_id', 'length', 'max'=>10),
			array('contact', 'length', 'max'=>150),
			array('contact_telephone', 'length', 'max'=>15),
			array('maturity_date, created, updated, comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('po_number, comp_name, maturity_date, created, updated, payment_term_id, comp_id, comments, is_open, contact, contact_telephone', 'safe', 'on'=>'search'),
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
			//'materials' => array(self::MANY_MANY, 'Material', '{{po_items}}(po_number, material_id)'),
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
			'po_number' => 'PO Number',
			'maturity_date' => 'Maturity Date',
			'created' => 'Created',
			'updated' => 'Updated',
			'payment_term_id' => 'Payment Term',
			'comp_id' => 'Supplier',
                        'comp_name'=>'Supplier',
			'comments' => 'Comments',
			'is_open' => 'State',
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
                
		$criteria->compare('po_number',$this->po_number,true);
		$criteria->compare('maturity_date',$this->maturity_date,true);
		//$criteria->compare('created',$this->created,true);
		//$criteria->compare('updated',$this->updated,true);
		$criteria->compare('payment_term_id',$this->payment_term_id,true);
		$criteria->compare('comp_id',$this->comp_id,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('is_open',$this->is_open);
		//$criteria->compare('contact',$this->contact,true);
		//$criteria->compare('contact_telephone',$this->contact_telephone,true);

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
                    'po_number'=>array(
                        'asc'=>'po_number',
                        'desc'=>'po_number DESC',
                    ),
                );
				$sort->defaultOrder='po_number DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
}