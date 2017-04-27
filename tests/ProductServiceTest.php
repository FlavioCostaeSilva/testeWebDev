<?php

use Illuminate\Support\Facades\App;
use \Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductServiceTest extends PHPUnit_Framework_TestCase
{

    public function testStorageFileUploadedShouldReturnFileName()
    {
        $file = new UploadedFile(file_get_contents(__DIR__ . '/Fixtures/file.xlsx'), '25aeoemao');

        $service = \Mockery::mock(App::make('ProductServiceInterface'))->makePartial();
        $service->shouldReceive('storageFileUploaded')->andReturn('qo1833jsi10amx.xlsx');

        $serviceReal = App::make('ProductServiceInterface');
        $filename = $serviceReal->storageFileUploaded($file);

        $this->assertInternalType('string', $filename);
    }
}
