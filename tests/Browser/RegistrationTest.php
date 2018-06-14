<?php

class RegistrationTest extends \Tests\DuskTestCase
{

	public function testEmptyFieldsShowsErrorOnSubmit()
	{

        $this->browse(function ($browser) {
            $browser->visit('/')->with('.registration-form', function ($form){
                $form->type('firstname',	         '')
                    ->type('lastname',	            '')
                    ->type('email',                 '')
                    ->type('password',	            '')
                    ->type('password_confirmation', '')
                    ->radio('gender',	            'M')
                    ->select('month',	             12)
                    ->select('day',	                 11)
                    ->press('Submit');

            })
                ->assertSee('Your first name is required.')
                ->assertSee('Your last name is required.')
                ->assertSee('The email field is required.')
                ->assertSee('The password field is required.')
                ->assertSee('The password confirmation field is required.')
                ->assertSee('Your profile image is required.')
                ->assertSee('The year field is required')


                ->assertPathIs('/');

        });

	}

	public function testFieldsTooShortShowsErrorOnSubmit()
	{
        $this->browse(function ($browser) {
            $browser->visit('/')->with('.registration-form', function ($form){
                $form->type('firstname',	        'g')
                    ->type('lastname',	            'g')
                    ->type('email',                 'Doe@example.com')
                    ->type('password',	            'pas')
                    ->type('password_confirmation', 'pas')
                    ->radio('gender',	            'M')
                    ->select('month',	             12)
                    ->select('day',	                 11)
                    ->type('year',	                 date('Y')-16)
                    ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                    ->press('Submit');

            })
                ->assertSee('Your first name must have at least 2 characters.')
                ->assertSee('Your last name must have at least 2 characters.')
                ->assertSee('The password must be between 4 and 12 characters.')

                ->assertPathIs('/');

        });
	}

    public function testFirstNameContainNumberShowsErrorOnSubmit()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')->with('.registration-form', function ($form){
                $form->type('firstname',	        'able12345')
                    ->type('lastname',	            'Doe')
                    ->type('email',                 'Doe@example.com')
                    ->type('password',	            'secret')
                    ->type('password_confirmation', 'secret')
                    ->radio('gender',	            'M')
                    ->select('month',	             12)
                    ->select('day',	                 11)
                    ->type('year',	                 date('Y')-16)
                    ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                    ->press('Submit');

            })
                ->assertSee('Your first name may only contain letters.')
                ->assertPathIs('/');

        });

    }


    public function testLastNameContainNumberShowsErrorOnSubmit()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')->with('.registration-form', function ($form){
                $form->type('firstname',	        'able')
                    ->type('lastname',	            'g1234')
                    ->type('email',                 'Doe@example.com')
                    ->type('password',	            'secret')
                    ->type('password_confirmation', 'secret')
                    ->radio('gender',	            'M')
                    ->select('month',	             12)
                    ->select('day',	                 11)
                    ->type('year',	                 date('Y')-16)
                    ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                    ->press('Submit');

            })
                ->assertSee('Your last name may only contain letters.')
                ->assertPathIs('/');

        });
    }


    public function testTakenEmailShowsErrorOnSubmit()
    {

        $user = factory(\App\User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/')->with('.registration-form', function ($form) use($user){
                $form->type('firstname',	        'able')
                    ->type('lastname',	            'Doe')
                    ->type('email',                 $user->email)
                    ->type('password',	            'secret')
                    ->type('password_confirmation', 'secret')
                    ->radio('gender',	            'M')
                    ->select('month',	             12)
                    ->select('day',	                 11)
                    ->type('year',	                 date('Y')-16)
                    ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                    ->press('Submit');

            })
                ->assertSee('The email has already been taken.')
                ->assertPathIs('/');

        });
    }



    public function testConfirmPasswordShowsErrorOnSubmit()
    {
        $this->browse(function ($browser) {
               $browser->visit('/')->with('.registration-form', function ($form){
                    $form->type('firstname',	        'able')
                        ->type('lastname',	            'Doe')
                        ->type('email',                 'Doe@example.com')
                        ->type('password',	            'secret')
                        ->type('password_confirmation', 'hello')
                        ->radio('gender',	            'M')
                        ->select('month',	             12)
                        ->select('day',	                 11)
                        ->type('year',	                 date('Y')-16)
                        ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                        ->press('Submit');

                })
                    ->assertSee('The password confirmation does not match.')
                    ->assertPathIs('/');

        });

    }



        public function testNumericYearShowsErrorOnSubmit()
        {
            $this->browse(function ($browser) {
                $browser->visit('/')->with('.registration-form', function ($form){
                    $form->type('firstname',	        'able')
                        ->type('lastname',	            'Doe')
                        ->type('email',                 'Doe@example.com')
                        ->type('password',	            'secret')
                        ->type('password_confirmation', 'secret')
                        ->radio('gender',	            'M')
                        ->select('month',	             12)
                        ->select('day',	                 11)
                        ->type('year',	                 'bab1')
                        ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                        ->press('Submit');

                })
                    ->assertSee('The year must be a number.')
                    ->assertPathIs('/');

            });
       
        }
    
           public function testYearLessThen15BeforeCurrentShowsErrorOnSubmit()
           {
               $this->browse(function ($browser) {
                   $browser->visit('/')->with('.registration-form', function ($form){
                       $form->type('firstname',	        'able')
                           ->type('lastname',	            'Doe')
                           ->type('email',                 'Doe@example.com')
                           ->type('password',	            'secret')
                           ->type('password_confirmation', 'secret')
                           ->radio('gender',	            'M')
                           ->select('month',	             12)
                           ->select('day',	                 11)
                           ->type('year',	                 date('Y')-13)
                           ->attach('profileimage',	     public_path('images/larasocial-main.png'))
                           ->press('Submit');

                   })
                       ->assertSee('The year must be a date before '. (date('Y')-15))
                       ->assertPathIs('/');

               });
           }

       

}