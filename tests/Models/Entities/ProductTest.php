<?php

use \App\Models\Entities\Product;
use  \Illuminate\Support\Facades\Artisan;
use \App\Models\Repositories\ProductRepository;

/**
 * Class ProductTest
 */
class ProductTest extends TestCase
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

    public function testGetPriceAttributeShouldReturnPriceFormattedFromDatabase()
    {
        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->getProductsByLm(1001);

        // Regular expression that represents 100.00 pattern
        $expected = '(\d{1,3}.\d{2})';

        $result = (preg_match($expected, $data->price)) ? true : false;

        $this->assertTrue($result);
        $this->assertEquals('1586.00', $data->price);
    }

    public function testGetPriceAttributeShouldReturnPriceFormattedByMethodCall()
    {
        $product = new Product();
        $data = $product->getPriceAttribute(100);

        // Regular expression that represents 100.00 pattern
        $expected = '(\d{1,3}.\d{2})';

        $result = (preg_match($expected, $data)) ? true : false;

        $this->assertTrue($result);
        $this->assertEquals('100.00', $data);
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