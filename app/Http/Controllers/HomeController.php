<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (\Storage::exists(config('ninjam.path'))) {
            $config = \Storage::get(config('ninjam.path'));
            return view('home')->with(compact('config'));
        } else {
            abort(503, "Ninjam Config file is not set or does not exist");
        }
    }

    public function store(Request $request) {
        \Storage::put(config('ninjam.path'), $request->input('config'));
        return redirect('home')->with('status', 'Config updated!');
    }

    public function backup() {
        $ninjamConfigPath = config('ninjam.path');
        $ninjamConfigFileName = basename($ninjamConfigPath);
        $backupFile = $ninjamConfigPath.'.backup';
        \Storage::put(
            $backupFile,
            \Storage::get(config('ninjam.path'))
        );
        return \Storage::download($backupFile, $ninjamConfigFileName);
    }

    public function ninjam(Request $request) {
        return $request;
    }
}
