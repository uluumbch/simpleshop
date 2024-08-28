# TODO
## Implementasi view
- [x] Implementasi view untuk menampilkan list data produk
- [ ] Implementasi view form untuk menambah data produk
- [ ] form harus dapat menampilkan error jika input tidak valid

Test yang harus pass
- `test_should_have_view_with_name_products_index`
- `test_index_displays_products`
- `test_create_displays_form`
- `test_create_form_should_have_name_description_price_stock_image`
- `test_create_form_validation`


## Implementasi logika tambah data dan view edit data
- [ ] Metode store pada `ProductController` harus dapat menambah data produk baru ke dalam database
- [ ] Metode store harus memiliki validasi input sebelum menambahkan data ke database (semua required)
- [ ] mengembalikan response berupa pesan sukses jika data berhasil ditambahkan dan redirect ke halaman list produk
- [ ] Implementasi view form untuk edit data produk
- [ ] Form edit data produk harus dapat menampilkan data produk yang akan diedit
- [ ] nama file view untuk form edit data produk adalah `edit.blade.php` pada folder `resources/views/products`

Test yang harus pass
- `test_store_saves_product_and_redirects`
- `test_edit_displays_form`

## Implementasi logika edit data dan hapus data
- [ ] Metode update pada `ProductController` harus dapat mengubah data produk yang ada di database
- [ ] Metode update harus memiliki validasi input sebelum mengubah data di database (semua required)
- [ ] Metode destroy pada `ProductController` harus dapat menghapus data produk yang ada di database
- [ ] Metode destroy harus mengembalikan response berupa pesan sukses jika data berhasil dihapus dan redirect ke halaman list produk
- [ ] Metode destroy harus menghapus file gambar produk yang terkait

Test yang harus pass
- `test_update_saves_changes_and_redirects`
- `test_destroy_deletes_product_and_redirects`
- `test_destroy_deletes_image_from_storage`

Jalankan test dengan perintah `php artisan test --filter nama_fungsi_test`