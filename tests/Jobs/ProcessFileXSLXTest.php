<?php

use  \Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Queue;
use \App\Models\Services\ProductService;

/**
 * Class ProcessFileXSLXTest
 */
class ProcessFileXSLXTest extends TestCase
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

    /**
     * Test disabled, possible bug on Queue::fake() on Laravel 5.3,
     * related in https://github.com/laravel/framework/issues/18223
     */
    public function testDispatchJobShouldReturnTrue()
    {
//        Queue::fake();
//
//        $filename = 'file.xlsx';
//
//        dispatch(new \App\Jobs\ProcessFileXSLX($filename));
//
//        Queue::assertPushedOn('default', \App\Jobs\ProcessFileXSLX::class);
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