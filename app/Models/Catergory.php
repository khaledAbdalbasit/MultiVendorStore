<?php

namespace App\Models;

use App\Models\Scopes\CategoryScope;
use App\Rules\Filter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Catergory extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'parent_id', 'description', 'image', 'status', 'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class , 'category_id' ,'id');
    }

    public function parent()
    {
        return $this->belongsTo(Catergory::class,'parent_id','id')
        ->withDefault([
            'name'=>'-'
        ]);
    }

    public function chaldren()
    {
        return $this->hasMany(Catergory::class, 'parent_id', 'id');
    }
    public function scopeActive(Builder $builder)
    {
        //$builder->where('status' , '=' , 'active');
    }

    public function scopeFilter()
    {
        static::addGlobalScope('category', new CategoryScope());

    }
    public static function rules($id=0)
    {
        return[
            'name' => [
            'required',
            'string',
            'min:3',
            'max:255',
                //'unique:categories,name,$id,'
            Rule::unique('categories', 'name')->ignore($id),
            /*function($attribute,$value,$fails)
            {
                if(strtolower($value)=='laravel')
                {
                    $fails('this name is forbidden!');
                }
            },*/
            'filter:php,laravel,html'
            //new Filter(['php','laravel','html']),
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width:100|min_height:100',
            ],
            'status' => 'in:active,archived',
        ];
    }

}
