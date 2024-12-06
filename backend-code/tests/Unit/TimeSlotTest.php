<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Http\Requests\TimeSlot\StoreRequest;
use Illuminate\Support\Facades\Validator;

class TimeSlotTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_cannot_create_time_slot_with_invalid_time_range()
    {
        $data = [
            'doctor_id' => 1,
            'service_id' => 1,
            'start_time' => '15:00',
            'end_time' => '14:00',
            'date' => '2024-12-02',
            'remaining_slots' => 5,
        ];

        $validator = Validator::make($data, (new StoreRequest())->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('start_time', $validator->errors()->messages());
    }

    /** @test */
    public function test_can_create_time_slot_with_valid_time_range()
    {
        $data = [
            'doctor_id' => 1,
            'service_id' => 1,
            'start_time' => '14:00',
            'end_time' => '15:00',
            'date' => '2024-12-02',
            'remaining_slots' => 5,
        ];

        $validator = Validator::make($data, (new StoreRequest())->rules());
        $this->assertFalse($validator->fails());
    }
}