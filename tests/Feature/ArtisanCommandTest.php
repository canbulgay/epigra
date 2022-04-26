<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtisanCommandTest extends TestCase
{
    /**
     *  Test get all data from space x command.
     * 
     * @return void
     */
    public function test_get_all_data_from_space_x_command()
    {
        $this->artisan('get:all')
            ->expectsOutput('All data from SpaceX Api has been synced to database.')
            ->assertExitCode(0);
    }
}
