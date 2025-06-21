<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'user_id'];

    protected static function newFactory()
    {
        return \Modules\Contact\Database\factories\ContactFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
