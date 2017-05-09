<?php

use  \Illuminate\Support\Facades\Artisan;

/**
 * Class ProductServiceTest
 */
class ProductServiceTest extends TestCase
{
    protected $file;
    protected $storage;

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();

        $this->prepareForTests();
        $this->file = $this->mock('Illuminate\Contracts\Filesystem');
        $this->storage = $this->mock('Illuminate\Contracts\Filesystem\Factory');
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
     * @param $class
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    public function testStorageFileUploadedShouldReturnFileName()
    {
        $uploadedFile = Mockery::mock(
            'Illuminate\Http\UploadedFile',
            [
                'getClientOriginalName'      => 'file.xlsx',
                'getClientOriginalExtension' => '.xlsx',
                'getPath' => '/path/to/file',
                'isValid' => true,
                'guessExtension' => 'xlsx',
                'getRealPath' => null,
            ]
        );

        $uploadedFile->shouldReceive('move')->andReturn(true);

        $serviceReal = new \App\Models\Services\ProductService();
        $filename = $serviceReal->storageFileUploaded($uploadedFile);

        $this->assertInternalType('string', $filename);
    }

    public function testProcessFileWithProductsShouldReturnTrue()
    {
        $uploadedFile = Mockery::mock(
            'Illuminate\Http\UploadedFile',
            [
                'getClientOriginalName'      => 'file.xlsx',
                'getClientOriginalExtension' => '.xlsx',
                'getPath' => 'path/to/file',
                'isValid' => true,
                'guessExtension' => 'xlsx',
                'getRealPath' => null,
            ]
        );

        $uploadedFile->shouldReceive('move')
            ->with(storage_path() . '/xlsx/')
        ->andReturn(true);

        Mockery::mock('ProductRepositoryInterface')
            ->shouldReceive('selectSheetsByIndex')
            ->andReturn(0);

        $serviceReal = new \App\Models\Services\ProductService();
        $result = $serviceReal->processFileWithProducts('file.xlsx');

        $this->assertTrue($result);
    }

    public function testProcessFileWithProductsShouldReturnFalse()
    {
        Mockery::mock('\Maatwebsite\Excel\Excel')
            ->shouldReceive('selectSheetsByIndex')
            ->andReturn(0);

        $serviceReal = new \App\Models\Services\ProductService();
        $result = $serviceReal->processFileWithProducts('fileNotExists.xlsx');

        $this->assertFalse($result);
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
