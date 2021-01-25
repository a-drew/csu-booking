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
        // Create room with boolean attribute as true and make sure it exists
        // and is returned by the filter endpoint
        $room = Room::factory()->create(['attributes' => ['food'=> true]]);
        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
        ]);

        $response = $this->postJson('/api/filterRooms', ['food' => true]);
        $response
            ->assertStatus(200)
            ->assertJson([$room->attributesToArray()]);

        // Find room with numeric field filter, make sure it is found
        $room_2 = Room::factory()->create(['attributes' => ['capacity_sitting'=> 10]]);
        $this->assertDatabaseHas('rooms', [
            'id' => $room_2->id,
        ]);

        $response_2 = $this->postJson('/api/filterRooms', ['capacity_sitting' => '7']);
        $response_2
            ->assertStatus(200)
            ->assertJson([$room_2->attributesToArray()]);

        // Find room with numeric field filter that is out of the range, make sure it is not found
        $response_3 = $this->postJson('/api/filterRooms', ['capacity_sitting' => '15']);
        $response_3
            ->assertStatus(200)
            ->assertJson([]);

    }
}
