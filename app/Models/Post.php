<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'created_at',
        'updated_at',
        'category_id',
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    // カテゴリーのスコープ
    public function scopeCategoryId($query,$category_id)
    {
        if(empty($category_id)){
            return;
        }
        return $query->where('category_id',$category_id);
    }

    // ワード検索のスコープ
    public function scopeSearchWords($query,$searchword){
        if(empty($searchword)){
            return;
        }
        return $query->where(function($query) use($searchword){
            $query->orWhere('title','like',"%{$searchword}%")
                ->orWhere('body','like',"%{$searchword}%");
        });
    }
}
