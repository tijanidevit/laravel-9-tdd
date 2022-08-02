<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path(): RedirectResponse
    {
        return redirect()->route('show_hotel', $this->id);
    }
}
