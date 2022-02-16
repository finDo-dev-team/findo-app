<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class ODPEventTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('schedule:run');

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page()
    {
        $response = $this->get('odpEvents');

        $response->assertStatus(200);
    }

    public function test_show_page()
    {
        $response = $this->get('odpEvents/1');

        $response->assertStatus(200);
    }
}
