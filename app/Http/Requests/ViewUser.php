<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViewUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->can('view user')) {
            return true;
        }

        if ($this->route('user')) {
            if ($this->user()->id === $this->route('user')->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
