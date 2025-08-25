<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image'
    ];
    protected $appends = ['full_image_url'];


    public function getFullImageUrlAttribute(){
        if ($this->image){
            return asset('storage/'. $this->image);
        }
        return null;
    }
    /**
     * Relationship: a note belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeForUser($query, $userId = null)
    {
        return $query->where('user_id', $userId ?? auth()->id());
    }

}
