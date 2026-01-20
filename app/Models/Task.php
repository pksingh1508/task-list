<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description'];
    // protected $guarded = ['password'];  // don't use this as it set all the other attribute to fillable which is more dangourous
    public function toggleComplete() {
        $this->completed = !$this->completed;
        $this->save();
    }
}
