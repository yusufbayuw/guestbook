<?php

namespace App\Http\Controllers;

use App\Models\Go;
use Illuminate\Http\Request;

class GoController extends Controller
{
    public function gotolink(string $urlx) 
    {
        $linkx = Go::where('short_link', $urlx)->first();
        return isset($linkx->original_link) ? redirect($linkx->original_link) : back();
    }
}
