<?php

namespace App\Http\Requests;

use App\Models\Catergory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->route('category')){
            return Gate::allows('categories.update');
        }
        return Gate::allows('categories.update') || Gate::allows('categories.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id=$this->route('category');
        return Catergory::rules($id);
    }

    public function messages()
    {
        return[
            'name.unique'=>'this name is already exists!',
        ];
    }
}
