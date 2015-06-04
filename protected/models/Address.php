<?php

/**
 * This is the model class for table "{{address}}".
 *
 * The followings are the available columns in table '{{address}}':
 * @property string $address_id
 * @property string $comp_id
 * @property string $name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $updated
 * @property string $country_code
 *
 * The followings are the available model relations:
 * @property Company $comp
 * @property Country $countryCode
 * @property SaleOrder[] $saleOrders
 */
class Address extends CActiveRecord
{
        protected function beforeSave() {
            $this->updated = new CDbExpression('NOW()');
            return parent::beforeSave();
        }
        
        public function getAddress($comp_id) {
            return  CHtml::listData(Address::model()->findAll('comp_id=:comp_id', array(':comp_id'=>$comp_id)), 'address_id', 'name');
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Address the static model class
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
		return '{{address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_id, country_code, name', 'required'),
                        //array('comp_id+name', 'application.extensions.uniqueMultiColumnValidator'),
                        array('name', 'unique', 'criteria'=>array(
                            'condition'=>'comp_id=:comp_id',
                            'params'=>array(':comp_id'=>$this->comp_id),
                            ),
                            'message'=>'This address name already exists for this company.'
                            ),
			array('postal_code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>70),
			array('address1, address2, city, province', 'length', 'max'=>150),
			array('updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('address_id, comp_id, name, address1, address2, city, province, postal_code, updated, country_code', 'safe', 'on'=>'search'),
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
			'comp' => array(self::BELONGS_TO, 'Company', 'comp_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_code'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'address_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'address_id' => 'Address',
			'comp_id' => 'Company',
			'name' => 'Name',
			'address1' => 'Address 1',
			'address2' => 'Address 2',
			'city' => 'City',
			'province' => 'Province',
			'postal_code' => 'Postal Code',
			'updated' => 'Updated',
			'country_code' => 'Country',
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

		$criteria->compare('address_id',$this->address_id,true);
		$criteria->compare('comp_id',$this->comp_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('country_code',$this->country_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}