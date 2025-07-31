<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WhatsAppInstanceController extends Controller
{
    public function index()
    {
        $instances = WhatsAppInstance::where('user_id', auth()->id())->latest()->get();
        return view('whatsappp.index', compact('instances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instance_name' => 'required|string|max:255'
        ]);

        $instance = WhatsAppInstance::create([
            'user_id' => Auth::id(),
            'instance_name' => $request->instance_name,
            'api_key' => Str::uuid(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Instance created successfully',
            'data' => $instance
        ]);
    }

    public function show($id)
    {
        $instance = WhatsAppInstance::where('user_id', auth()->id())->findOrFail($id);
        return view('instances.show', compact('instance'));
    }
}
