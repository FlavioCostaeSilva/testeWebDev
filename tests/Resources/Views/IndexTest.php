<?php

use  \Illuminate\Support\Facades\Artisan;

/**
 * Class IndexTest
 */
class IndexTest extends TestCase
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
        $this->visit(route('.'))
            ->see('Adds new products by uploading .xlsx file:');
    }

    public function testAccessEditLink()
    {
        $this->visit(route('.'))
            ->click('Edit')
            ->see('Edit product:');
    }

    public function testClickRefreshLink()
    {
        $this->visit(route('.'))
            ->click('Refresh')
            ->see('Adds new products by uploading .xlsx file:');
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