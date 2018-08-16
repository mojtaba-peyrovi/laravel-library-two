<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Author extends Model
{
    protected $guarded = [];

    public function path()
    {
        $path = 'authors/'. $this->id;
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function fullName()
    {
        $name = $this->name;
        $lastname = $this->last_name;
        return $name .' '. $lastname;
    }

    public function getAge()
    {
        $start_time = Carbon::parse($this->birthday);
        $age = Carbon::now()->diffInYears($start_time);
        return $age;
    }


}
