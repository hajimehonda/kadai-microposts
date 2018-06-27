<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
     public function users()
    {
        
         return $this->belongsToMany(User::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
       

        
    }
        
     public function favorite($micropost_id)
    {
     //既にお気に入りしているかの確認
     $exist = $this->is_favorite($micropost_id);

    if ($exist) {
        // 既にお気に入りしていれば何もしない
        return false;
    } else {
        // お気に入りしていなければお気に入りする
        $this->favorite()->attach($micropost_id);
        return true;
    }
}

    public function unfavorite($micropost_id)
    {
    //既にお気に入りしているかの確認
     $exist = $this->is_favorite($micropost_id);

    if ($exist) {
        // 既にお気に入りしていればお気に入りを外す
        $this->favorite()->detach($micropost_id);
        return true;
    } else {
        // 未フォローであれば何もしない
        return false;
    }
    }
    
    public function is_favorite($micropost_id) {
    return $this->is_favorite()->where('user_id', $micropost_id)->exists();

    }
}
