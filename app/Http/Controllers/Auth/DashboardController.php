<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppInstance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $instance = WhatsAppInstance::where('user_id', auth()->id())->count();
        return view('dashboard.index', compact('instance'));
    }
}
