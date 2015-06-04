<?php

class maturityDateCommand extends CConsoleCommand {
    
    public function run($args) {
        
        Yii::app()->db
            ->createCommand("UPDATE tbl_purchase_order set is_open=0 where maturity_date < CURDATE() and is_open=1")
            ->execute();
        
        Yii::app()->db
            ->createCommand("UPDATE tbl_sale_order set is_open=0 where maturity_date < CURDATE() and is_open=1")
            ->execute();
    }
}
?>
