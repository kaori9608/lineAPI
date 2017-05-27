<?php
class Request {
	var $params = array();
	var $errorMsg = array();
	var $pageLinks = array();
	
	function Request() {
		if( is_array($_REQUEST) ) {
			foreach( $_REQUEST as $name => $value) {
				$this->add($name, $value);
			}
		}
	}
	
	function add($name, $data) {
		$this->params[$name] = $data;
	}
	
	function get($name) {
        if(isset($this->params[$name])){
            return $this->params[$name];
        }
	}
	
    function getArrayValue($name,$key){
        if(isset($this->params[$name][$key])){
            return $this->params[$name][$key];
        }
    }
    
	function getAll(){
		return $this->params;
	}
	
	//ErrorMsg
	function setErrorMsg($msg) {
		$this->errorMsg = $msg;
	}
	
	function getErrorMsg() {
		return $this->errorMsg;
	}
	
	//PageLinks
	function setPageLinks($link) {
		$this->pageLinks = $link;
	}
	
	function getPageLinks() {
		return $this->pageLinks;
	}
	
}
?>