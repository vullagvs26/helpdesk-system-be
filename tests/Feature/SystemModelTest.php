<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\System;
use Spatie\Activitylog\Models\Activity;

class SystemModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_activity_when_system_is_created()
    {
        // Create a new system
        $system = System::create([
            'code_name' => 'TestCode',
            'system_name' => 'TestSystem',
            'owner' => 'TestOwner',
            'release' => '1.0',
            // Add other necessary attributes
        ]);

        // Fetch the latest activity log
        $activity = Activity::latest()->first();

        // Assert that an activity log exists
        $this->assertNotNull($activity);
        $this->assertEquals('created', $activity->description);
        $this->assertEquals('TestCode', $activity->properties['attributes']['code_name']);
    }
}
