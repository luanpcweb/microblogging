<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Tweet;

class TweetControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_allows_anyone_to_see_tweets()
    {
        $response = $this->get('/');

        $response->assertSuccessful();
    }

    public function test_add_tweet_validation_error_username()
    {
        $response = $this->post('/tweet', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('username');
    }

    public function test_add_tweet_validation_error_tweet()
    {
        $response = $this->post('/tweet', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('tweet');
    }

    public function test_add_tweet_validation_error_username_not_symbol_at()
    {
        $username = $this->faker->firstName;
        $tweet = 'Sed ut perspiciatis #text omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, #test ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut oia';

        $response = $this->post('/tweet', [
            'username' => $username,
            'tweet' => $tweet
        ]);

        $errors = session('errors');

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('username')[0], 'Username com formato inválido! Comece com @.');
    }

    public function test_add_tweet_validation_error_username_with_space()
    {
        $username = '@'.$this->faker->firstName . ' ' . $this->faker->lastName;
        $tweet = 'Sed ut perspiciatis #text omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, #test ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut oia';

        $response = $this->post('/tweet', [
            'username' => $username,
            'tweet' => $tweet
        ]);

        $errors = session('errors');

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('username')[0], 'Username com formato inválido! Evite espaços.');
    }

    public function test_add_tweet_validation_error_tweet_with_many_characters()
    {
        $username = '@'.$this->faker->firstName;
        $tweet = 'Sed ut perspiciatis #text omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, #test ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut opsum lirum neroia';

        $response = $this->post('/tweet', [
            'username' => $username,
            'tweet' => $tweet
        ]);

        $errors = session('errors');

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['tweet']);
        $this->assertEquals($errors->get('tweet')[0], 'Tweet contem mais de 280 caracteres.');
    }

    public function test_create_tweet()
    {

        $username = '@'. $this->faker->firstName;
        $tweet = 'Sed ut perspiciatis #text omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, #test ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut oia';

        $response = $this->post('/tweet', [
            'username' => $username,
            'tweet' => $tweet
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Tweet publicado com sucesso!');

    }

    public function test_it_allows_anyone_to_see_tweets_by_hashtags()
    {

        factory(Tweet::class)->create();

        $hashtag = 'test';
        $response = $this->get("/hashtags/".$hashtag);

        $response->assertSuccessful();
    }

    public function test_hashtag_wrong_get()
    {

        factory(Tweet::class)->create();

        $hashtag = '#test';
        $response = $this->get("/hashtags/".$hashtag);

        $response->assertNotFound();
    }
}
