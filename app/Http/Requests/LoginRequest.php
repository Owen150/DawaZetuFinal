<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required'
        ];
    }

    public function getCredentials()
    {
        $name = $this->get('name');

        if ($this->isEmail($name)) {
            return [
                'email' => $name,
                'password' => $this->get('password')
            ];
        }

        return $this->only('name', 'password');
    }

    private function isEmail($param)
    {
        // $factory = $this->container->make(ValidationFactory::class);

        // return ! $factory->make(
        //     ['username' => $param],
        //     ['username' => 'email']
        // )->fails();
    }
}
