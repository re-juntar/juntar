<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        return [
            'name' => 'required|max:200|string',
            'short-name' => 'required|max:100|string',
            'description' => 'required',
            'place' => 'required|max:200|string',
            'category' => 'required',
            'modality' => 'required',
            'start-date' => 'required|before_or_equal:end-date',
            'end-date' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg',
            'flyer' => 'required|image|mimes:jpeg,png,jpg',
            'amount-of-participants' => 'min:1',
            'preinscription-date' => 'before_or_equal:start-date',
            'acreditation-code' => 'required|string'
        ];
    }
    
}
