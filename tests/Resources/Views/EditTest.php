<?php

use  \Illuminate\Support\Facades\Artisan;

/**
 * Class EditTest
 */
class EditTest extends TestCase
{
    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();

        $this->prepareForTests();
    }

    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     */
    private function prepareForTests()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--database' => 'sqlite_testing']);
    }

    public function testAccessIndexPage()
    {
        $this->visit('/edit/1001')
            ->see('Edit product:');
    }

    public function testAccessBackLink()
    {
        $this->visit('/edit/1001')
            ->click('back')
            ->see('Currently products:');
    }

    public function testClickRefreshLink()
    {
        $this->visit('/edit/1001')
            ->type('Alicate', 'name')
            ->type('Ferramentas', 'category')
            ->type('1', 'free_shipping')
            ->type('Alicate especial', 'description')
            ->type('101', 'price')
            ->press('Edit product')
            ->seePageIs('/update');

        $this->visit(route('.'))
            ->see('Alicate');
    }

    /**
     * Reset the database
     */
    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}