<?php

namespace Tests\Unit;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterRoomsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_filter_rooms()
    {
      $this->withoutExceptionHandling();
        // Create room with boolean attribute as true and make sure it exists
        // and is returned by the filter endpoint
        $room = Room::factory()->create([
          'attributes' => [
            'food'=> true,
            'alcohol'=> true,
            'chairs' => 8
          ]]);
        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
        ]);

        $response = $this->postJson('/api/filterRooms', ['food' => true]);
        $response
            ->assertStatus(200)
            ->assertJson([$room->attributesToArray()]);

        // Find room with numeric field filter, make sure it is found
        $response_2 = $this->postJson('/api/filterRooms', ['chairs' => 4]);
        $response_2
            ->assertStatus(200)
            ->assertJson([$room->attributesToArray()]);

        // Find room with numeric field filter that is out of the range, make sure it is not found
        $response_3 = $this->postJson('/api/filterRooms', ['chairs' => 15]);
        $response_3
            ->assertStatus(200)
            ->assertJson([]);

    }
}
