<?php

class WebUser extends CWebUser {
    public function checkAccess($operation, $params=array()) {
        if(empty($this->name)) {
            return false;
        }
        $role = $this->getState('roles');
        return ($operation === $role);
    }
}