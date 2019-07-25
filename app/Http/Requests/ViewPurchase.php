<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViewPurchase extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->id === $this->route('purchase')->user->id) {
            return true;
        }

        if ($this->user()->can('view purchase')) {
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
