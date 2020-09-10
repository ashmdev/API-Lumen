<?php
namespace App\Http\Validations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserValidator{

    /**
     * @var request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        return Validator::make($this->request->all(), $this->rules(), $this->messages());
    }

    public function rules()
    {
        return [
            'firstName' => 'required|string',
            'lastName'  => 'required|string',
            'email'     => 'required|unique:users,email,'.$this->request->id,
            'phone'     => 'required',
            'password'  => "required|string",
            'confirm_password'  => 'required|same:password'
        ];
    }

    public function messages()
    {
        return[];
    }

}
