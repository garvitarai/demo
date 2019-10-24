<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       $this->middleware('auth');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $rules = [
        'name' => 'required'
      ];
      $pictures = count($this->input('pictures'));
      foreach(range(0, $pictures) as $index) {
        $rules['pictures.' . $index] = 'nullable|image|mimes:jpeg,bmp,png|max:2000';
      }

      return $rules;
    }
}
