<div class="row">
    <div class="col-md-6">
        <div class="mb-2">
            <?php $img = $product->hasImage() ? $product->getImageUrl('medium') : url('/themes/default/assets/img/product-medium.jpg') ?>
            <img src="{{ $img  }}" id="product-image" />
        </div>

        <div class="thumbnail-container">
            @foreach($product->getMedia() as $media)
            <div class="thumbnail mr-1">
                <img class="mw-100" src="{{ $media->getUrl('thumbnail') }}"
                     onclick="document.getElementById('product-image').setAttribute('src', '{{ $media->getUrl("medium") }}')"
                     />
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        @unless(empty($product->propertyValues))
        <table class="table table-sm">
            <tbody>
                @foreach($product->propertyValues as $propertyValue)
                <tr>
                    <th>{{ $propertyValue->property->name }}</th>
                    <td>{{ $propertyValue->title }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <hr>
        @endunless

        @unless(empty($product->description))
        <hr>
        <p class="text-secondary">{!!  nl2br($product->description) !!}</p>
        <hr>
        @endunless

        <form action="{{ route('cart.add', $product) }}" method="post" class="mb-4">
            {{ csrf_field() }}

            <span class="mr-2 font-weight-bold text-primary btn-lg">{{ format_price($product->price) }}</span>
            <button type="submit" class="btn btn-success btn-lg" @if(!$product->price) disabled @endif>Add to cart</button>
        </form>
    </div>
</div>
