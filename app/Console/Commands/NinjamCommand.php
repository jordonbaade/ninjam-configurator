<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class NinjamCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ninjam {action? : start, stop, restart, status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start, Stop, Restart, and check status of Ninjam';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        switch ($action) {
            case 'start':
                $this->startNinjam();
                break;
            case 'stop':
                $this->stopNinjam();
                break;
            case 'restart':
                $this->restartNinjam();
                break;
            case 'status':
            default:
                $this->ninjamStatus();
                break;
        }
    }

    public function startNinjam() {
        $this->processCommandIfSet('ninjam.commands.start');
    }

    public function stopNinjam() {
        $this->processCommandIfSet('ninjam.commands.stop');
    }

    public function restartNinjam() {
        $this->processCommandIfSet('ninjam.commands.restart');
    }

    public function ninjamStatus() {
        $this->processCommandIfSet('ninjam.commands.status');
    }

    public function processCommandIfSet($command) {
        if (filled(config($command))) {
            $this->info('Running "'.config($command).'"');
            $this->processCommand(config($command), $command);
        } else {
            $msg = 'Make sure '.$command.' is set in .env';
            $this->error($msg);
            \Storage::put($command.'.txt', $msg);
        }
    }

    public function processCommand($command, $filename) {
        $process = new Process($command);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $this->info($process->getOutput());
        \Storage::put($filename.'.txt', $process->getOutput());
    }
}
