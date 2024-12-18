<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark" py-3>
      <h3 class="text-white text-center">CRUD operation</h3>
    </div>
      <div class="container">
        <div class="row d-flex justify-content-center mt-4">
          <div class="col-md-10 d-flex justify-content-end">
              <a href="{{route('products.list')}}" class="btn btn-dark">Back</a>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-10">
            <div class="card border-0 shadow-lg my-3">
              <div class="class-header bg-dark">
                <h4 class="text-white">Edit Product</h4>
              </div>
              <form enctype="multipart/form-data" action="{{route('products.update',$product->id)}}" method="POST">
                @method('put')
                @csrf
                <div class="card-body">

                  <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input value="{{old('name',$product->name)}}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                    @error('name')
                      <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Sku</label>
                    <input value="{{old('sku',$product->sku)}}" type="text" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="Sku" name="sku">
                    @error('sku')
                    <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input value="{{old('price',$product->price)}}" type="text" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="price">
                    @error('price')
                    <p class="invalid-feedback">{{$message}}</p>
                  @enderror
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea  class="form-control" placeholder="Description" name="description"  cols="30" rows="5">{{old('description',$product->description)}}</textarea>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control form-control-lg" placeholder="Image" name="image">
                      @if ($product->image != "")
                      <img class="w-10 my-2" src="{{asset('upload/products/'.$product->image)}}" alt="">
                      @endif
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-lg btn-primary">Update</button>
                  </div>
                </div>
            </form>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>