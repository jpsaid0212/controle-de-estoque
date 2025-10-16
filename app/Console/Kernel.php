<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Produto;

class Kernel extends ConsoleKernel
{
    /**
     * Define as tarefas agendadas.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Apaga permanentemente produtos soft-deletados há mais de 30 dias
        $schedule->call(function () {
            Produto::onlyTrashed()
                ->where('deleted_at', '<', now()->subDays(30))
                ->forceDelete();
        })->dailyAt('03:00'); // executa todos os dias às 03h
    }

    /**
     * Registra comandos personalizados (se tiver algum no futuro)
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
