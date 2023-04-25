@extends('layouts.master')

@section('categories-menu')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="categoriesMenu">
        <ul class="navbar-nav">
            @foreach($taxonomies as $taxonomy)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   bdata-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $taxonomy->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @include('shop::product.index._category_level', ['taxons' => $taxonomy->rootLevelTaxons()])
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</nav>
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('product.index') }}">All Products</a></li>
@if($taxon)
@include('product._breadcrumbs')
@endif
@stop

@section('content')
<div class="container">
    @if($taxon && $taxon->hasImage())
    <div style="background-image: url('{{ $taxon->getImageUrl('header') }}'); height: 150px;"
         class="mb-2">
        <h1 class="p-3 text-light" style="text-shadow: #333 0 0 11px">{{ $taxon->name }}</h1>
    </div>
    @endif
    <div class="row">

        <div class="col-md-3">
            @include('shop::product.index._filters', ['properties' => $properties, 'filters' => $filters])
        </div>

        <div class="col-md-9">
            @if($taxon && $products->isEmpty() && $taxon->children->count())
            <div class="card card-default mb-4">
                <div class="card-header">{{ $taxon->name }} Subcategories</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($taxon->children as $child)
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            @include('shop::product.index._category', ['taxon' => $child])
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if(!$products->isEmpty())
            <div class="card card-default">
                <div class="card-header">{{ $taxon ?  'Products in ' . $taxon->name : 'All Products' }}</div>

                <div class="card-body">
                    <div class="row">

                        @foreach($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            @include('shop::product.index._product')
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
