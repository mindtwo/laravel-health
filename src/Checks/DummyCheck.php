<?php

namespace Mindtwo\LaravelHealth\Checks;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;

class DummyCheck extends Check
{
    public function run(): Result
    {
        $result = Result::make()->meta([
            'test' => 'success',
        ]);

        return $result->ok();
    }
}
