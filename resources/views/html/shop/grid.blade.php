<div class="row">
    @foreach($products_gird as $item)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{$item->thumbnail}}">
                    <ul class="product__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="{{url("/add-to-cart", ["product"=>$item->id])}}"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="{{url("/product", ["product" => $item->slug])}}">{{$item->name}}</a></h6>
                    <h5>${{$item->price }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>
{!! $products_gird->appends(app("request")->input())->links("pagination::bootstrap-4") !!}
