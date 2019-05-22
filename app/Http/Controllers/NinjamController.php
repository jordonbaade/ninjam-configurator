<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NinjamController extends Controller
{
    public function action(Request $request) {
        switch($request->input('action')) {
            case 'start':
                $this->call('ninjam start', 'Ninjam Started', 'Ninjam failed to start.');
                $output = \Storage::get('ninjam.commands.start.txt');
                request()->session()->flash('ninjam_output', $output);
                break;
            case 'restart':
                $this->call('ninjam restart', 'Ninjam Restarted', 'Ninjam failed to restart.');
                $output = \Storage::get('ninjam.commands.restart.txt');
                request()->session()->flash('ninjam_output', $output);
                break;
            case 'stop':
                $this->call('ninjam stop', 'Ninjam Stopped', 'Ninjam failed to stop.');
                $output = \Storage::get('ninjam.commands.stop.txt');
                request()->session()->flash('ninjam_output', $output);
                break;
            case 'status':
                $this->call('ninjam', 'Ninjam Status', 'Could not get ninjam status.');
                $output = \Storage::get('ninjam.commands.status.txt');
                request()->session()->flash('ninjam_output', $output);
                break;
            default:
                $this->call('ninjam', 'Ninjam Status', 'Could not get ninjam status.');
                $output = \Storage::get('ninjam.commands.status.txt');
                request()->session()->flash('ninjam_output', $output);
                break;
        }
        return redirect('home');
    }

    public function call($command, $ok, $failed) {
        $exit_code = \Artisan::call($command);
        if ($exit_code) {
            request()->session()->flash('failed', $failed);
        } else {
            request()->session()->flash('status', $ok);
        }
    }
}
