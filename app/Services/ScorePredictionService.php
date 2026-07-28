<?php

namespace App\Services;

use Faker\Factory;
use Illuminate\Support\Facades\File;
use Phpml\Classification\Ensemble\RandomForest;
use Phpml\ModelManager;

class ScorePredictionService
{
    private const MODEL_PATH = 'app/train_model/student_classier_model.phpml';

    private mixed $model;

    public function __construct()
    {
        if (! File::exists(self::modelPath())) {
            self::trainModel();
        }

        $this->model = (new ModelManager())->restoreFromFile(self::modelPath());
    }

    public function predict(
        float $attendence,
        float $assigment,
        float $mid_exam,
        float $final_exam,
    ): bool {
        $result = $this->model->predict(
            [$attendence, $assigment, $mid_exam, $final_exam]
        );

        return (bool) $result;
    }

    /** Train and save the classifier used by student score predictions. */
    public static function trainModel(): void
    {
        $faker = Factory::create();
        $attributes = [];
        $labels = [];

        for ($i = 0; $i < 200; $i++) {
            $attendence = $faker->numberBetween(40, 100);
            $assigment = $faker->numberBetween(40, 100);
            $midExam = $faker->numberBetween(40, 100);
            $finalExam = $faker->numberBetween(40, 100);

            $attributes[] = [$attendence, $assigment, $midExam, $finalExam];
            $average = ($assigment + $midExam + $finalExam) / 3;
            $labels[] = ($attendence < 85 || $average < 75) ? 1 : 0;
        }

        $classifier = new RandomForest(10);
        $classifier->train($attributes, $labels);

        File::ensureDirectoryExists(dirname(self::modelPath()));
        (new ModelManager())->saveToFile($classifier, self::modelPath());
    }

    private static function modelPath(): string
    {
        return storage_path(self::MODEL_PATH);
    }
}
