<?php 

use Laracasts\TestDummy\Factory;

class LoginTest extends \Tests\DuskTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;


    public function testEmptyEmailShowsErrorOnSubmit()
	{
        $this->browse(function ($browser) {
            $browser->visit('/')->with('.registration-form', function ($form){
                $form->type('email','')
                    ->type('password','secret')
                    ->click('.submit-registration');
                })
                ->assertPathIs('/')
                ->assertSee('The email field is required');

        });

	}

     public function testEmptyPasswordShowsErrorOnSubmit()
     {
        $this->browse(function ($browser) {
            $browser->visit('/')->with('.registration-form', function ($form){
                $form->type('email','jon@Doe.com')
                    ->type('password','')
                    ->click('.submit-registration');
            })
                ->assertPathIs('/')
                ->assertSee('The password field is required');

        });

     }

    public function testLoginWithWrongCedentialsShowsError()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')->with('.login-form', function ($form){
                $form->type('email','jon@Doe.com')
                    ->type('password','heheheh')
                    ->click('.login-button');
            })
                ->assertPathIs('/')
                ->assertSee('We were unable to sign you in. Please check your credentials and try again');

        });

    }

}