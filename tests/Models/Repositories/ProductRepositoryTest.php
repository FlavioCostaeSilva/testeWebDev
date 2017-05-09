<?php

use  \Illuminate\Support\Facades\Artisan;
use \App\Models\Repositories\ProductRepository;
use \App\Models\Entities\Product;

/**
 * Class ProductRepositoryTest
 */
class ProductRepositoryTest extends TestCase
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

    public function testGetProductsShouldReturnAllProducts()
    {
        $productRepository = new ProductRepository(new Product());
        $data = $productRepository->getProducts();

        $this->assertEquals(2, $data->count());
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Collection', $data);
    }

    public function testGetProductsByLmShouldReturnOneProduct()
    {
        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->getProductsByLm(1001);

        $this->assertInstanceOf('\App\Models\Entities\Product', $data);
        $this->assertEquals('1001', $data->lm);
        $this->assertEquals('Furadeira X', $data->name);
        $this->assertEquals('Ferramentas', $data->category);
        $this->assertEquals('0', $data->free_shipping);
        $this->assertEquals('Furadeira eficiente X', $data->description);
        $this->assertEquals('1586.00', $data->price);
    }

    public function testGetProductsByLmShouldReturnNull()
    {
        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->getProductsByLm(25468);

        $this->assertNull($data);
    }

    public function testUpdateOrCreateProductShouldCreateAProduct()
    {
        $newProduct = [
            'lm' => '3',
            'name' => 'Martelo',
            'category' => 'Ferramentas',
            'free_shipping' => '0',
            'description' => 'Martelo artesanal',
            'price' => 15.00
        ];

        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->updateOrCreateProduct($newProduct);

        $this->assertInstanceOf('\App\Models\Entities\Product', $data);
        $this->assertEquals('3', $data->lm);
        $this->assertEquals('Martelo', $data->name);
        $this->assertEquals('Ferramentas', $data->category);
        $this->assertEquals('0', $data->free_shipping);
        $this->assertEquals('Martelo artesanal', $data->description);
        $this->assertEquals('15.00', $data->price);
    }

    public function testUpdateOrCreateProductShouldEditAProduct()
    {
        $newProduct = [
            'lm' => '3',
            'name' => 'Chave de Fenda',
            'category' => 'Ferramentas',
            'free_shipping' => '1',
            'description' => 'Chave de fenda artesanal',
            'price' => 8.00
        ];

        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->updateOrCreateProduct($newProduct);

        $this->assertInstanceOf('\App\Models\Entities\Product', $data);
        $this->assertEquals('3', $data->lm);
        $this->assertEquals('Chave de Fenda', $data->name);
        $this->assertEquals('Ferramentas', $data->category);
        $this->assertEquals('1', $data->free_shipping);
        $this->assertEquals('Chave de fenda artesanal', $data->description);
        $this->assertEquals('8.00', $data->price);
    }

    public function testDeleteShouldReturnTrue()
    {
        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->delete(1001);

        $this->assertTrue($data);
    }

    public function testDeleteShouldReturnFalse()
    {
        $productRepository = new ProductRepository(new Product());
        /** @var Product $data */
        $data = $productRepository->delete(125478);

        $this->assertFalse($data);
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