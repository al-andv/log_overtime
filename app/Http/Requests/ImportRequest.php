<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
           //
        ];
    }
    public function withValidator($validator)
    {
        if (!$this->file('import')) {
            back()->with('error' , 'The file import is required');
        } else {
            $validator->after(function ($validator) {
                $extension = $this->file('import')->getClientOriginalExtension();
                $extensionImport = ['xls', 'xlsx', 'csv'];
                $check = in_array($extension, $extensionImport);
                if (!$check) {
                    $validator->errors()->add('log_file', trans('The file import format is "xls, xlsx, csv."'));
                }
            });
        }
    }
}
