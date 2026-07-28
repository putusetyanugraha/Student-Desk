<?php

namespace App\Console\Commands;

use App\Services\ScorePredictionService;
use Illuminate\Console\Command;

class TrainScorePredictionModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student-score-prediction:train';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Train student score prediction model';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        ScorePredictionService::trainModel();
        $this->info('Model training success.');

        return self::SUCCESS;
    }
}
