<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_have_view_with_name_products_index()
    {
        $response = $this->get(route('products.index'));


        $response->assertViewIs('products.index');
    }

    /**
     * Test the index method.
     */
    public function test_index_displays_products()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products', function ($viewProducts) use ($products) {
            return $viewProducts->count() === $products->count();
        });
    }

    /**
     * saat user mengakses route products.create
     * harus menampilkan form untuk menambahkan product
     */
    public function test_create_displays_form()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
    }

    /**
     * saat user mengakses route products.create
     * harus menampilkan form untuk menambahkan product
     * form tersebut harus memiliki field name, description, price, stock, image
     */

    public function test_create_form_should_have_name_description_price_stock_image()
    {
        $response = $this->get(route('products.create'));

        $response->assertSee('name');
        $response->assertSee('description');
        $response->assertSee('price');
        $response->assertSee('stock');
        $response->assertSee('image');
        $response->assertSee('method="POST"', false);
        $response->assertSee('enctype="multipart/form-data"',false);
    }

    /**
     * saat user mengakses route products.create
     * form harus dapat menampilkan error ketika user tidak mengisi field yang wajib diisi
     */
    public function test_create_form_validation()
    {
        $response = $this->post(route('products.store'), []);

        $response->assertSessionHasErrors(['name', 'description', 'price', 'stock', 'image']);

        $response = $this->get(route('products.create'));

        $response->assertSee(__('validation.required', ['attribute' => 'name']));
        $response->assertSee(__('validation.required', ['attribute' => 'description']));
        $response->assertSee(__('validation.required', ['attribute' => 'price']));
        $response->assertSee(__('validation.required', ['attribute' => 'stock']));
        $response->assertSee(__('validation.required', ['attribute' => 'image']));

    }



    /**
     * saat user mengirimkan data product baru
     * harus menyimpan data product baru dan redirect ke halaman index
     * serta data product yang baru disimpan harus ada di database
     * lalu session harus memiliki key success dengan value bebas
     */
    public function test_store_saves_product_and_redirects()
    {
        $productData = Product::factory()->make()->toArray();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('product.jpg');

        $productData['image'] = $file;

        $response = $this->post(route('products.store'), $productData);

        $response->assertRedirect(route('products.index'));

        $response->assertSessionHas('success');

        $productData['image'] = "images/{$file->hashName()}";
        $this->assertDatabaseHas('products', $productData);
    }


    /**
     * saat user mengakses route products.edit
     * harus menampilkan form untuk mengedit product
     * form tersebut harus memiliki field name, description, price, stock, image
     * dan field tersebut harus terisi dengan data product yang akan diedit
     * serta form tersebut harus memiliki method PUT
     * dan enctype multipart/form-data
     * dan harus memiliki tombol submit
     * dan tombol submit harus memiliki text "Update"
     */
    public function test_edit_displays_form()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
        $response->assertViewIs('products.edit');
    
        $response->assertSee('name');
        $response->assertSee($product->name);
        $response->assertSee('description');
        $response->assertSee($product->description);
        $response->assertSee('price');
        $response->assertSee($product->price);
        $response->assertSee('stock');
        $response->assertSee($product->stock);
        $response->assertSee('image');
        $response->assertSee($product->image);
        $response->assertSee('method="POST"', false);
        $response->assertSee('enctype="multipart/form-data"', false);
        $response->assertSee('Update');

    }

    /**
     * Test the update method.
     */
    public function test_update_saves_changes_and_redirects()
    {
        $product = Product::factory()->create();
        $updatedData = Product::factory()->make()->toArray();

        $response = $this->put(route('products.update', $product), $updatedData);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $updatedData);
    }

    /**
     * Test the destroy method.
     */
    public function test_destroy_deletes_product_and_redirects()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', $product->toArray());
    }

    /**
     * saat user menghapus product
     * harus menghapus image dari storage
     */
    public function test_destroy_deletes_image_from_storage()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('product.jpg');
        $product = Product::factory()->create([
            'image' => $file->store('images', 'public')
        ]);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', $product->toArray());

        Storage::disk('public')->assertMissing($file->hashName());
    }
}
