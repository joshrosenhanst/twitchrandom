<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slogan extends Model
{
    protected $table = 'slogans';
    protected $fillable = ['slogan','approved'];

    public function approve(){
        $this->approved = 1;
        $this->save();
    }
    public function unapprove(){
        $this->approved = 0;
        $this->save();
    }
}
