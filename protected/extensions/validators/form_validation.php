<?php
class Form_validation extends CValidator
{
    public $rule;

	private $pattern = array(
				'alpha_numeric' => "/^([a-z0-9])+$/i",
				'alpha' => "/^([a-z])+$/i",
				'nospecial' => "/[^\||\'|\<|\>|\"|\!|\?|\$|\@|\/|\\\|\&\~\*\+]+$/",
			);

	private $lang = array(
				'alpha_numeric' => "Поле может содержать только латинские буквы и цифры.",
				'alpha' => "Поле может содержать только латинские буквы.",
				'nospecial' => "Поле не может содержать специальные символы.",
			);

	public function getPattern()
	{
		$data = $this->pattern;
		return array_key_exists($this->rule, $data) ? $data[$this->rule] : false;
    }

	public function getLang()
	{
		$data = $this->lang;
		return array_key_exists($this->rule, $data) ? $data[$this->rule] : false;
	}

/**
 * Validates the attribute of the object.
 * If there is any error, the error message is added to the object.
 * @param CModel $object the object being validated
 * @param string $attribute the attribute being validated
 */
protected function validateAttribute($object,$attribute)
{
	$pattern = $this->getPattern();

    // extract the attribute value from it's model object
    $value=$object->$attribute;
    if(!preg_match($pattern, $value))
    {
        $this->addError($object,$attribute,$this->getLang());
    }
}

/**
 * Returns the JavaScript needed for performing client-side validation.
 * @param CModel $object the data object being validated
 * @param string $attribute the name of the attribute to be validated.
 * @return string the client-side validation script.
 * @see CActiveForm::enableClientValidation
 */
public function clientValidateAttribute($object,$attribute)
{
     $pattern = $this->getPattern();

$condition="!value.match({$pattern})";

    return "
if(".$condition.") {
    messages.push(".CJSON::encode($this->getLang()).");
}
";
}

}