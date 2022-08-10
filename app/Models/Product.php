<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (is_null($product->user_id)) {
                $product->user_id = auth()->user()->id;
            }
        });

        static::deleting(function ($user) {
            $user->products()->delete();

        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
