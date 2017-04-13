<?php

namespace Tylercd100\Database\Eloquent;

use Validator;
use Illuminate\Database\Eloquent\Model as IlluminateModel;

abstract class Model extends IlluminateModel
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
     * A method best used to register Eloquent events when the model boots up
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            if (!$model->validate()) {
                return false;
            }
        });
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
