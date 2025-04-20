<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Format;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function user_can_add_a_book()
        {
            $this->browse(function (Browser $browser) {
                $user = User::factory()->create([
                    'email' => 'test@example.com',
                    'password' => bcrypt('password'),
                ]);

                $format = Format::factory()->create(['name' => 'Hardcover']);

                $browser->loginAs($user)
                    ->visit('/books/create?title=Test&author=Author&cover=https://via.placeholder.com/150')
                    ->screenshot('book-form')
                    ->assertSee('Add Book to My List')
                    ->select('format_id', $format->id)
                    ->type('opinion', 'One of my favorite books.')
                    ->press('Save Book')
                    ->waitForLocation('/books')
                    ->assertPathIs('/books')
                    ->assertSee('Book added to your list!');
            });
        }
}
