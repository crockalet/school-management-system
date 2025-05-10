<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $seed = true;
    
    protected function actingAsAdmin(string $guard = null)
    {
        $this->actingAs(
            \App\Models\User::firstWhere('email', config('api.admin.email')),
            $guard ?? config('api.guard')
        );
    }
}
