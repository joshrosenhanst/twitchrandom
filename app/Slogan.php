<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slogan extends Model
{
    protected $table = 'slogans';
    protected $fillable = ['slogan','approved'];
    protected $hidden = ['created_at','updated_at'];

    public function approve(){
        $this->approved = 1;
        $this->save();
    }
    public function reject(){
        $this->approved = 0;
        $this->save();
    }
}
