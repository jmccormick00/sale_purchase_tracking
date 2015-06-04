<?php

/**
 * ReportForm
 */
class ReportForm extends CFormModel
{
	public $material_cat;
	public $material_id;
	public $startDate;
        public $endDate;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('material_cat, material_id, startDate, endDate', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'material_cat'=>'Material Category',
                        'material_id'=>'Material',
                        'startDate'=>'Start Date',
                        'endDate'=>'End Date'
		);
	}
        
        public function getData($report) 
        {
            
        }
        	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CArrayDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
            if(isset($this->material_id) && isset($this->startDate) && isset($this->endDate)) {
		$data = Yii::app()->db->createCommand()
                        ->select('material_id, comp.name AS compName, sum(qty_shipped) AS shippedSum')
                        ->from('tbl_sale_items saleItem')
                        ->join('tbl_sale_order saleOrder', 'saleItem.sale_id=saleOrder.sale_id')
                        ->join('tbl_company comp', 'saleOrder.comp_id=comp.comp_id')
                        ->where('material_id=:id', array(':id'=>$this->material_id))
                        ->andWhere('created BETWEEN :start AND :end', array(":start"=>$this->startDate, ":end"=>$this->endDate))
                        ->group('comp.comp_id')
                        ->queryAll();
            } else {
                $data=array(array('material_id'=>0, 'compName'=>'', 'shippedSum'=>0));
            }
            
            $provider = new CArrayDataProvider($data, array(
                'keyField'=>'compName'
            ));
            $_SESSION['reportdata-excel'] = $provider;
            //$_SESSION['reportcriteria-excel'] = $this;
            return $provider;
	}
}
