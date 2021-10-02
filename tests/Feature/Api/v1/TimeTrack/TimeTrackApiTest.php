<?php

namespace Tests\Feature\Api\v1\TimeTrack;

use App\Models\TimeTrack\TimeTrack;
use App\Models\TimeTrack\TimeTrackType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TimeTrackApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_time_track_store_success()
    {

        $user = User::factory()->create();
        $timeTrackType = TimeTrackType::first();

        $response =  $this->actingAs($user, 'api')->postJson('/api/TimeTrack', [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:45:39',
            'time_to' => '2021-09-11 12:55:39',
            'time_track_type_id' => $timeTrackType->id,
        ]);

        $response
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'description',
                        'time_from',
                        'time_to',
                        'id',
                        'slug',
                        'user_name',
                        'user_slug',
                        'time_track_type_id',
                        'time_track_type_name',
                        'time_track_type_slug',
                    ]
                ]
            );
    }

    public function test_time_track_store_unautorized()
    {
        $timeTrackType = TimeTrackType::first();

        $response =  $this->postJson('/api/TimeTrack', [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:45:39',
            'time_to' => '2021-09-11 12:55:39',
            'time_track_type_id' => $timeTrackType->id,
        ]);

        $response
            ->assertJson([
                'code' => "401",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'message',
                    ]
                ]
            );
    }

    public function test_time_track_store_validation_error()
    {
        $user = User::first();

        $response =  $this->actingAs($user, 'api')->postJson('/api/TimeTrack', [
            'time_to' => '2021-09-11',
            'time_track_type_id' => '99999',
        ]);

        $response
            ->assertJson([
                'code' => "422",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'time_to',
                        'time_track_type_id',
                        'time_from',
                    ]
                ]
            );
    }

    public function test_get_time_tracks_pagination_check_by_user_id()
    {
        $user = User::factory()->create();

        $response =  $this->actingAs($user, 'api')->getJson('/api/TimeTrack');

        $response
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'data' => [
                            '*' => [
                                'description',
                                'time_from',
                                'time_to',
                                'id',
                                'slug',
                                'user_name',
                                'user_slug',
                                'time_track_type_id',
                                'time_track_type_name',
                                'time_track_type_slug',
                            ],
                        ],
                        'current_page',
                        'total',
                    ],
                ]
            );
        $datas = json_decode($response->getContent());

        $this->assertEquals($datas->data->total, 0);

        foreach ($datas->data->data as $data) {
            $this->assertEquals($user->id, $data->user_id);
        }

        TimeTrack::factory()->count(3)->state([
            'user_id' => $user->id,
        ])->create();


        $response2 =  $this->actingAs($user, 'api')->getJson('/api/TimeTrack');

        $response2
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'data' => [
                            '*' => [
                                'description',
                                'time_from',
                                'time_to',
                                'id',
                                'slug',
                                'user_name',
                                'user_slug',
                                'time_track_type_id',
                                'time_track_type_name',
                                'time_track_type_slug',
                            ],
                        ],
                        'current_page',
                        'total',
                    ],
                ]
            );
        $datas2 = json_decode($response2->getContent());

        $this->assertEquals($datas2->data->total, 3);

        foreach ($datas2->data->data as $data) {
            $this->assertEquals($user->slug, $data->user_slug);
        }
    }
    public function test_get_time_tracks_pagination_check_by_user_id_unautorized()
    {

        $response =  $this->getJson('/api/TimeTrack');

        $response
            ->assertJson([
                'code' => "401",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'message',
                    ]
                ]
            );
    }

    public function test_get_one_user_time_track_success()
    {
        $user = User::factory()
            ->create();

        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' => $user->id,
            ])
            ->create();

        $response =  $this->actingAs($user, 'api')->getJson('/api/TimeTrack/' . $timeTrack->slug);

        $response
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'id',
                        'slug',
                        'time_track_type_id',
                        'user_id',
                        'time_from',
                        'time_to',
                        'description',
                        'time_track_type_id',
                        'time_track_type_name',
                        'time_track_type_slug',
                    ],
                ]
            );
    }

    public function test_get_one_user_time_track_fail()
    {
        $user = User::factory()
            ->create();

        $response =  $this->actingAs($user, 'api')->getJson('/api/TimeTrack/' . Str::random(10));

        $response
            ->assertJson([
                'code' => "403",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'message',
                    ],
                ]
            );
    }

    public function test_get_foreign_one_user_time_track_fail()
    {
        $user = User::factory()
            ->create();

        $user2 = User::factory()
            ->create();

        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' =>    $user2->id
            ])
            ->create()
            ->first();

        $response =  $this->actingAs($user, 'api')->getJson('/api/TimeTrack/' . $timeTrack->slug);

        $response
            ->assertJson([
                'code' => "403",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'message',
                    ],
                ]
            );
    }

    public function test_update_time_track()
    {
        $user = User::factory()
            ->create();

        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' => $user->id,
            ])
            ->create();

        $timeTrackCheck = TimeTrack::where('slug', $timeTrack->slug)->where('user_id', $user->id)->first();
        $this->assertNotNull($timeTrackCheck);


        $timeTrackType = TimeTrackType::first();

        $response =  $this->actingAs($user, 'api')->patchJson('/api/TimeTrack/' .  $timeTrack->slug, [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:45:19',
            'time_to' => '2021-09-11 12:55:39',
            'time_track_type_id' => $timeTrackType->id,
        ]);

        $response
            ->assertJson([
                'code' => "200",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'description',
                        'time_from',
                        'time_to',
                        'id',
                        'slug',
                        'user_name',
                        'user_slug',
                        'time_track_type_id',
                        'time_track_type_name',
                        'time_track_type_slug',
                    ]
                ]
            );

        $timeTrackCheck = TimeTrack::where('description', $timeTrack->description)->where('user_id', $user->id)->first();
        $this->assertNull($timeTrackCheck);

        $data = json_decode($response->getContent());

        $timeTrackCheck = TimeTrack::where('description',  $data->data->description)
            ->where('time_track_type_id', $timeTrackType->id)
            ->where('user_id', $user->id)
            ->where('time_to', '2021-09-11 12:55:39')
            ->where('time_from', '2021-09-11 12:45:19')
            ->first();
        $this->assertNotNull($timeTrackCheck);
    }

    public function test_update_foreign_time_track()
    {
        $user = User::factory()
            ->create();
        $user2 = User::factory()
            ->create();

        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' => $user2->id,
            ])
            ->create()
            ->first();

        $timeTrackCheck = TimeTrack::where('slug', $timeTrack->slug)->where('user_id', '!=', $user->id)->first();
        $this->assertNotNull($timeTrackCheck);

        $response =  $this->actingAs($user, 'api')->putJson('/api/TimeTrack/' .  $timeTrack->slug, [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:45:19',
            'time_to' => '2021-09-11 12:55:39',
        ]);

        $response
            ->assertJson([
                'code' => "403",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'message',
                    ],
                ]
            );
    }
    public function test_update_time_track_unatorized()
    {
        $user = User::factory()
            ->create();

        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' => $user->id,
            ])
            ->create();

        $timeTrackCheck = TimeTrack::where('slug', $timeTrack->slug)->where('user_id', $user->id)->first();
        $this->assertNotNull($timeTrackCheck);

        $response =  $this->putJson('/api/TimeTrack/' .  $timeTrack->slug, [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:45:19',
            'time_to' => '2021-09-11 12:55:39',
        ]);

        $response
            ->assertJson([
                'code' => "401",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'message',
                    ],
                ]
            );
    }

    public function test_create_already_taken_time_error()
    {
        $user = User::factory()->create();
        $timeTrackType = TimeTrackType::first();
        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' => $user->id,
                'time_from' => '2021-09-11 12:35:39',
                'time_to' => '2021-09-11 12:58:39',
            ])
            ->create();

        $response =  $this->actingAs($user, 'api')->postJson('/api/TimeTrack', [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:45:39',
            'time_to' => '2021-09-11 12:55:39',
            'time_track_type_id' => $timeTrackType->id,
        ]);

        $response
            ->assertJson([
                'code' => "422",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'time_from',
                        'time_to',
                    ]
                ]
            );
    }
    public function test_update_already_taken_time_error()
    {
        $user = User::factory()->create();
        $timeTrackType = TimeTrackType::first();
        $timeTrack = TimeTrack::factory()
            ->state([
                'user_id' => $user->id,
                'time_from' => '2021-09-11 12:35:39',
                'time_to' => '2021-09-11 12:45:39',
            ])
            ->create();
        $timeTrack2 = TimeTrack::factory()
            ->state([
                'user_id' => $user->id,
                'time_from' => '2021-09-11 12:46:39',
                'time_to' => '2021-09-11 12:58:39',
            ])
            ->create();

        $response =  $this->actingAs($user, 'api')->putJson('/api/TimeTrack/' .  $timeTrack->slug, [
            'description' => 'test_description',
            'time_from' => '2021-09-11 12:35:19',
            'time_to' => '2021-09-11 12:55:39',
            'time_track_type_id' => $timeTrackType->id,
        ]);

        $response
            ->assertJson([
                'code' => "422",
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'errors' => [
                        'time_to',
                    ]
                ]
            );
    }
}
