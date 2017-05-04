<?php


class IndexControllerTest extends TestCase
{
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

    public function testUploadFileHasProductDataAndResultWithError()
    {
        $mockRepository = Mockery::mock('ProductRepository')
            ->shouldReceive('getProducts', 'updateOrCreateProduct');

        $this->app->instance('ProductRepository', $mockRepository);

        $response = $this->call('POST', '/', [], [], ['files' => []]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('productsData');
        $this->assertViewHas('result', 'error');
    }

    public function testDeleteIsSuccessful()
    {
        $uri = 'delete';
        $parameters = '/1008';

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
}
