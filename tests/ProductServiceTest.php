<?php


class ProductServiceTest extends TestCase
{
    protected $file;
    protected $storage;

    public function setUp()
    {
        parent::setUp();

        $this->file = $this->mock('Illuminate\Contracts\Filesystem');
        $this->storage = $this->mock('Illuminate\Contracts\Filesystem\Factory');
    }

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

        Mockery::mock('\Maatwebsite\Excel\Excel')
            ->shouldReceive('selectSheetsByIndex')
            ->andReturn(0);

        $serviceReal = new \App\Models\Services\ProductService();
        $result = $serviceReal->processFileWithProducts('file.xlsx');

        $this->assertTrue($result);
    }
}
