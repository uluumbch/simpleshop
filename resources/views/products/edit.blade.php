{{--
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Products</title>
</head>

<body>
  <form action="" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="{{ old('name') ?? $product->name }}">
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description" value="{{ old('description') ?? $product->description }}">
    </div>
    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price" value="{{ old('price') ?? $product->price }}">
    </div>
    <div>
      <label for="stock">Stock</label>
      <input type="number" name="stock" id="stock" value="{{ old('stock') ?? $product->stock }}">
    </div>
    <div>
      <button type="submit">Save</button>
    </div>
  </form>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Products</title>
</head>

<body>
  {{-- <form action="/product" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="{{ $product->name}}">
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description"
        value="{{ $product->description}}">
    </div>
    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price" value="{{ $product->price}}">
    </div>
    <div>
      <label for="stock">Stock</label>
      <input type="number" name="stock" id="stock" value="{{ $product->stock}}">
    </div>
    <div>
      <label for="image">Image</label>
      <input type="file" name="image" id="image" value="{{ $product->image}}">
      <div>{{ $product->image}}"</div>
    </div>
    <div>
      <button type="submit">Update</button>
    </div>
  </form> --}}
  <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="{{ $product->name }}">
    </div>
  
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description" value="{{ $product->description }}">
    </div>
  
    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price" value="{{ $product->price }}">
    </div>
  
    <div>
      <label for="stock">Stock</label>
      <input type="number" name="stock" id="stock" value="{{ $product->stock }}">
    </div>
  
    <div>
      <label for="image">Image</label>
      <input type="file" name="image" id="image">
      <div>
        <img src="{{ $product->image }}" alt="">
      </div>
    </div>
  
    <div>
      <button type="submit">Update</button>
    </div>
  </form>
</body>

</html>