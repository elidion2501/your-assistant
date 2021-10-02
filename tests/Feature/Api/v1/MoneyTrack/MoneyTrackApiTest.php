<?php

namespace Tests\Feature\Api\v1\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrack;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class MoneyTrackApiTest extends TestCase
{
    public function test_get_money_tracks_pagination_check_by_user_id()
    {
        $user = User::factory()->create();

        $response =  $this->actingAs($user, 'api')->getJson('/api/MoneyTrack');

        $response
            ->assertJson([
                'code' => 200,
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'data' => [
                            '*' => [
                                'description',
                                'title',
                                'id',
                                'slug',
                                'user_name',
                                'user_slug',
                                'money_track_type_id',
                                'money_track_type_name',
                                'money_track_type_slug',
                                'money_track_action_type_id',
                                'money_track_action_type_name',
                                'money_track_action_type_slug',
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

        MoneyTrack::factory()->count(3)->state([
            'user_id' => $user->id,
        ])->create();

        $response2 =  $this->actingAs($user, 'api')->getJson('/api/MoneyTrack');

        $response2
            ->assertJson([
                'code' => 200,
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'data' => [
                            '*' => [
                                'description',
                                'title',
                                'id',
                                'slug',
                                'user_name',
                                'user_slug',
                                'money_track_type_id',
                                'money_track_type_name',
                                'money_track_type_slug',
                                'money_track_action_type_id',
                                'money_track_action_type_name',
                                'money_track_action_type_slug',
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

    public function test_get_money_tracks_pagination_check_by_user_id_unautorized()
    {

        $response =  $this->getJson('/api/MoneyTrack');

        $response
            ->assertJson([
                'code' => 401,
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

    public function test_get_one_user_money_track_success()
    {
        $user = User::factory()
            ->create();

        $moneyTrack = MoneyTrack::factory()
            ->state([
                'user_id' => $user->id,
            ])
            ->create();

        $response =  $this->actingAs($user, 'api')->getJson('/api/MoneyTrack/' . $moneyTrack->slug);

        $response
            ->assertJson([
                'code' => 200,
            ])
            ->assertJsonStructure(
                [
                    'code',
                    'data' => [
                        'description',
                        'title',
                        'id',
                        'slug',
                        'user_name',
                        'user_slug',
                        'money_track_type_id',
                        'money_track_type_name',
                        'money_track_type_slug',
                        'money_track_action_type_id',
                        'money_track_action_type_name',
                        'money_track_action_type_slug',
                    ],
                ]
            );
    }

    public function test_get_one_user_money_track_fail()
    {
        $user = User::factory()
            ->create();

        $response =  $this->actingAs($user, 'api')->getJson('/api/MoneyTrack/' . Str::random(10));

        $response
            ->assertJson([
                'code' => 403,
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

    public function test_get_foreign_one_user_money_track_fail()
    {
        $user = User::factory()
            ->create();

        $user2 = User::factory()
            ->create();

        $moneyTrack = MoneyTrack::factory()
            ->state([
                'user_id' =>    $user2->id
            ])
            ->create()
            ->first();

        $response =  $this->actingAs($user, 'api')->getJson('/api/MoneyTrack/' . $moneyTrack->slug);

        $response
            ->assertJson([
                'code' => 403,
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
}
