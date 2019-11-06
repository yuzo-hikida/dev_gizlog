<?php

namespace Tests\Unit;

use App\Models\Comment;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GizlogTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $categories = factory(TagCategory::class, 4)->create();
        factory(User::class, 4)->create()->each(function ($user) use ($categories) {
            factory(Question::class, 3)
                ->create([
                    'user_id' => $user->id,
                    'tag_category_id' => $categories->random()->id
                ])
                ->each(function ($question) {
                    factory(Comment::class, 5)->create(['question_id' => $question->id]);
                });
        });
    }

    public function testIndex()
    {
        $user = factory(User::class)->make(['id' => 4]); //保存しない
        $response = $this->actingAs($user)->get(route('question.index'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/question/create');

        $response->assertStatus(200);
    }

}
