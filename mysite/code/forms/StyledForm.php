<?php
class StyledForm extends Form {
	
	public function forTemplate() {
		return $this->renderWith(array($this->class, 'Form'));
	}
	
}