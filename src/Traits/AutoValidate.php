<?php

namespace Tylercd100\Database\Eloquent\Traits;

use Tylercd100\Database\Eloquent\Exceptions\ValidationException;
use Validator;

trait AutoValidate
{
    /**
     * An array of validation rules
     * @var array
     */
    protected $rules = [];

    /**
     * An array of validation messages
     * @var array
     */
    protected $messages = [];

    /**
     * A method best used to register Eloquent events when the model boots up
     * @return void
     */
    protected static function boot()
    {
        self::saving(function ($model) {
            if (!$model->validate()) {
                return false;
            }
        });
    }

    /**
     * Validates the Model
     * @return boolean Whether or not the input is valid
     */
    public function validate()
    {
        $data = $this->toArray();
        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();

        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        } else {
            return true;
        }
    }

    /**
     * Returns an array of validation rules
     * @return array An Array of validation rules
     */
    protected function getValidationRules()
    {
        return $this->rules;
    }

    /**
     * Returns an array of validation messages
     * @return array An Array of validation messages
     */
    protected function getValidationMessages()
    {
        return $this->messages;
    }
}
