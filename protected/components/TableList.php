<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class TableList extends CWidget {
    public $tableTitle = '';
    public $buttonLabel = '';
    public $dataProvider;
    public $columns = array();
    public $modalTitle = '';
    public $ajaxCreateURL = array();
    //public $ajaxUpdateURL = array();
    
    public function run() {
        $this->render('tableList');
    }
}

?>
