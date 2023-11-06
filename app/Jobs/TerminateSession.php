<?php

namespace App\Jobs;

use App\Models\Session;
use App\Models\Machine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TerminateSession implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Session $session)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Terminating session " . $this->session->maquina);

        $maquina = Machine::findOne(function($r) {
            return $r->id == $this->session->maquina;
        });

        if ($this->session->estaActiva()) {
            Log::warning("The session is still active");
        }

        $maquina->en_uso = false;
        $maquina->save();
    }
}
