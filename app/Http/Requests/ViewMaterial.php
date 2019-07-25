<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViewMaterial extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->id === $this->route('material')->user->id) {
            return true;
        }

        if ($this->user()->can('view material')) {
            return true;
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
