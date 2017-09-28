<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {


            //Login page testing with empty email and password
            $browser->visit('admin/signin')
                ->type('email', '')
                ->type('password', '')
                ->press('Log In')
                ->assertSee('The email address is required');

            //testing with dummy email and empty password
            $browser->visit('admin/signin')
                ->type('email', 'a@a.com')
                ->type('password', '')
                ->press('Log In')
                ->assertSee('Password is required');

            //testing with dummy email and dummy password
            $browser->visit('admin/signin')
                ->type('email', 'a@a.com')
                ->type('password', 'aaa')
                ->press('Log In')
                ->assertSee('Email or password is incorrect');

            //testing with correct email and password
            $browser->visit('/admin/signin')
                ->type('email', 'admin@admin.com')
                ->type('password', 'admin')
                ->press('Log In')
//                ->assertPathIs('/admin/')
                ->assertSee('Welcome to Dashboard');

            // Register page testing all the fields as empty
            $browser->visit('admin/register2')
                ->type('first_name', '')
                ->type('last_name', '')
                ->type('email', '')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('First name is required');

            // testing firstname with numericals
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '')
                ->type('email', '')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('Last name is required');

            // testing firstname and last name with numericals
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', '')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('The email address is required');

            // testing existed email id
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', '')
                ->type('password', '')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('The confirm email address is required');

            // testing existed email id and diferent confirm email
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@ad.com')
                ->type('password', '')
                ->type('password_confirm', '')
                ->assertSee('Entered email is not matching with your email');

            // testing password field with 2 characters
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '')
                ->press('Register')
                ->assertSee('Confirm Password is required');

            // testing password field and confirm fields both are different
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '34')
                ->press('Register')
                ->assertSee('Please enter the same value');

            // testing password and confirm password with same value
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '12')
                ->press('Register')
                ->assertSee('Please check the checkbox');

            // testing checkbox
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin@admin.com')
                ->type('email_confirm', 'admin@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '12')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertSee('The email has already been taken.');

            //testing password and confirm password with 2 characters
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin1@admin.com')
                ->type('email_confirm', 'admin1@admin.com')
                ->type('password', '12')
                ->type('password_confirm', '12')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertSee('The password must be between 3 and 32 characters.');

            // testing password and confirm password with 4 characters
            $browser->visit('admin/register2')
                ->type('first_name', '123')
                ->type('last_name', '321')
                ->type('email', 'admin1@admin.com')
                ->type('email_confirm', 'admin1@admin.com')
                ->type('password', '1234')
                ->type('password_confirm', '1234')
                ->check('.iCheck-helper')
                ->press('Register')
                ->assertSee(' ');

        });
    }
}
