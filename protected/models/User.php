<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $user_id
 * @property string $username
 * @property string $pw_hash
 * @property string $first_name
 * @property string $last_name
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property Roles $role
 */
class User extends CActiveRecord
{
        public $password = '';
        public $password_repeat = '';
    
        /**
        * Generate a random salt in the crypt(3) standard Blowfish format.
        *
        * @param int $cost Cost parameter from 4 to 31.
        *
        * @throws Exception on invalid cost parameter.
        * @return string A Blowfish hash salt for use in PHP's crypt()
        */
        private function blowfishSalt($cost = 13) {
           if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
               throw new Exception("cost parameter must be between 4 and 31");
           }
           $rand = array();
           for ($i = 0; $i < 8; $i += 1) {
               $rand[] = pack('S', mt_rand(0, 0xffff));
           }
           $rand[] = substr(microtime(), 2, 6);
           $rand = sha1(implode('', $rand), true);
           $salt = '$2a$' . str_pad((int) $cost, 2, '0', STR_PAD_RIGHT) . '$';
           $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
           return $salt;
        }
        
        public function beforeSave() {
        if(parent::beforeSave()) {
            $this->pw_hash = crypt($this->password, $this->blowfishSalt());
            return true;
        }
        return false;
    }
    
    private function constTimeComp($a, $b) {
        /**
         * @see http://codereview.stackexchange.com/questions/13512 
         */
        if (!is_string($a) || !is_string($b)) {
            return false;
        }
        $mb = function_exists('mb_strlen');
        $length = $mb ? mb_strlen($a, '8bit') : strlen($a);
        if ($length !== ($mb ? mb_strlen($b, '8bit') : strlen($b))) {
            return false;
        }
        $check = 0;
        for ($i = 0; $i < $length; $i += 1) {
            $check |= (ord($a[$i]) ^ ord($b[$i]));
        }
        return $check === 0;
    }
    
    
    public function checkPassword($value) {
        $new_hash = crypt($value, $this->pw_hash);
        if($this->constTimeComp($new_hash, $this->pw_hash))
            return true;
        return false;
    }
    
    public function passwordStrengthCheck($attribute, $params) {
        // default to true
        $valid = true;
        
        // atleast one number
        $valid = $valid && preg_match('/.*[\d].*/', $this->$attribute);
        
        // atleast one non-word character
        //$valid = $valid && preg_match('/.*[\W].*/', $this->$attribute);
        
        if(!$valid)
            $this->addError ($attribute, "Does not meet password requirements.");
        
        return $valid;
    }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, username, first_name, last_name', 'required'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>45),
                        array('username', 'unique'),
			array('first_name, last_name', 'length', 'max'=>30),
                        array('password', 'length', 'min'=>6, 'max'=>32, 'on'=>'passwordset'),
                        array('password, password_repeat', 'required', 'on'=>'passwordset'),
                        array('password', 'passwordStrengthCheck', 'on'=>'passwordset'),
                        array('password', 'compare', 'compareAttribute'=>'password_repeat'),
                        array('password_repeat, username, password, first_name, last_name', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, first_name, last_name, role_id', 'safe', 'on'=>'search'),
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
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User ID',
			'username' => 'Username',
			'password' => 'Password',
                        'password_repeat' => 'Repeat Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'role_id' => 'Role',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('role_id',$this->role_id);
                $sort = New CSort;
                $sort->attributes = array(
                  'fname' => array(
                      'asc' => 'first_name',
                      'desc' => 'first_name DESC',
                  ),
                  'lname' => array(
                      'asc'=>'last_name',
                      'desc'=>'last_name DESC'
                  ),
                  '*'
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
}