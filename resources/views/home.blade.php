@extends('layouts.master')

@section('content')
  @foreach ($products as $product)
    <div class="col-md-6 bg-white" >
      <div class="row no-gutters border rounded d-flex align-items-center flex-md-row mb-4 shadow-sm position-relative">
        <div class="col p-3 d-flex flex-column position-static">
          <h6 class="d-inline-block text-info mb-2">
            @foreach ($product->categories as $category)
                {{ $category->name }}{{ $loop->last ? '' : ', '}}
            @endforeach
          </h6>
          <h5 class="mb-0">{{ $product->title }}</h5>
          <strong class="display-5 mb-4 text-secondary">{{ $product->getPrice() }}</strong>
          <a href="{{ route('products.show', $product->slug) }}" class="stretched-link btn btn-primary"><i class="fa fa-location-arrow" aria-hidden="true"></i> Consulter le produit</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img class="w-100" src="{{ asset('storage/' . $product->image) }}"  width="260" height="200"  class="img-thumbnail" alt="">
        </div>
      </div>
    </div>
  @endforeach
  {{ $products->appends(request()->input())->links() }}
@endsection
