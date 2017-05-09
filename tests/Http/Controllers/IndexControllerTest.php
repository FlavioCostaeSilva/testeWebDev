<?php

use \org\bovigo\vfs\vfsStream;
use  \Illuminate\Support\Facades\Artisan;
use \Illuminate\Foundation\Testing\DatabaseTransactions;

class IndexControllerTest extends TestCase
{
    use DatabaseTransactions;

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
     * @param $class
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    public function testEditHasEmptyProductData()
    {
        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProductsByLm');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('GET', '/edit/10055');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productData', null);
    }

    public function testEditHasProductData()
    {
        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProductsByLm');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('GET', '/edit/1001', ['lm' => 1001]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productData');
    }

    public function testIndexHasProductData()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', 'no_show');
    }

    public function testUploadFileHasProductDataAndResultTrue()
    {
        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProducts', 'updateOrCreateProduct');

        $this->app->instance('ProductRepository', $mockRepository);

        $mockProductService = Mockery::mock('ProductService')
            ->shouldReceive('storageFileUploaded', 'move')
        ->andReturn('sjwkaokoqo.xlsx')
        ->andReturn(true);

        $this->app->instance('ProductService', $mockProductService);

        $fileUploaded = $this->createUploadFile();
        $fileUploaded->shouldReceive('move')
            ->andReturn(true);

        $response = $this->call('POST', '/', [], [], ['file' => $fileUploaded]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', true);
    }

    public function testUploadFileHasProductDataAndResultError()
    {
        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProducts', 'updateOrCreateProduct');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('POST', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', 'error');
    }

    public function testDeleteIsSuccessful()
    {
        $uri = 'delete';
        $parameters = '/1001';

        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProducts', 'delete');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('GET', $uri . $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', 'product_deleted');
    }

    public function testDeleteIsFailed()
    {
        $uri = 'delete';
        $parameters = '/10085';

        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProducts', 'delete');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('GET', $uri . $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', 'deleted_failed');
    }

    public function testUpdateShouldReturnProdEdited()
    {
        $uri = 'update';
        $parameters = '/?lm=1008&name=Serra+Marmore&category=Ferramentas'.
            '&free_shipping=1&description=Serra+com+1400W+modelo+41000&price=20.00';

        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProducts', 'updateOrCreateProduct');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('POST', $uri . $parameters);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', 'prod_edited');
    }

    /**
     * Creates UploadedFile mocked
     *
     * @return \Mockery\MockInterface
     */
    private function createUploadFile()
    {
        $vfs = vfsStream::setup(sys_get_temp_dir(), null, ['testFile.xlsx' => '']);

        return Mockery::mock(
            'Illuminate\Http\UploadedFile',
            [
                'getClientOriginalName'      => 'file.xlsx',
                'getClientOriginalExtension' => '.xlsx',
                'getPath' => $vfs->url(),
                'isValid' => true,
                'guessExtension' => 'xlsx',
                'getRealPath' => null,
            ]
        );
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
