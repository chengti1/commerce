@extends('layouts.layout') @section('content') <!-- BREADCRUMB

    ================================================== -->

<div class="breadcrumb full-width">

    <div class="background-breadcrumb"></div>

    <div class="background">

        <div class="shadow"></div>

        <div class="pattern">

            <div class="container">

                <div class="clearfix">

                    <h1 id="title-page">Hunt Items</h1>

                    <ul>

                        <li>

                            <a href="{{Request::root()}}">Home</a>

                        </li>



                        <li>

                            <a href="{{Request::root()}}/hunt-listing">Hunt Items</a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- MAIN CONTENT

    ================================================== -->

<div class="main-content full-width inner-page">

    <div class="background-content"></div>

    <div class="background">

        <div class="shadow"></div>

        <div class="pattern">

            <div class="container">

                <div class="row">

                    <div class="col-sm-3" id="column_left">

                        <div class="box box-category">

                            <div class="box-heading">

                                Categories

                            </div>

                            <div class="strip-line"></div>

                            <div class="box-content">

                                <ul class="accordion" id="accordion-category">

                                    @foreach($categories as $category)

                                        <li class="panel">

                                            <a href=

                                               "{{Request::root()}}/category/{{$category->category_name}}">

                                                {{$category->category_name}}</a>

                                        </li>



                                    @endforeach

                                </ul>

                            </div>

                        </div>

<!-- edited by kartik -->
<!-- <div class="box">
    <div class="box-heading">
        Refine Search
    </div>
    <div class="strip-line"></div>
    <div class="box-content">
        <ul class="box-filter">
            <li>
                <span id="filter-group1">Shop by color</span>
                <ul>
                    <li><input id="filter1" type="checkbox" value="1"> <label for="filter1">Black</label>
                    </li>
                    <li><input id="filter2" type="checkbox" value="2"> <label for="filter2">Red</label>
                    </li>
                    <li><input id="filter3" type="checkbox" value="3"> <label for="filter3">White</label>
                    </li>
                    <li><input id="filter4" type="checkbox" value="4"> <label for="filter4">Yellow</label>
                    </li>
                </ul>
            </li>
            <li>
                <span id="filter-group2">Shop by price</span>
                <ul>
                    <li><input id="filter5" type="checkbox" value="5"> <label for="filter5">
                    $0 - $99</label></li>
                    <li><input id="filter6" type="checkbox" value="6"> <label for="filter6">$100 - $199</label>
                    </li>
                    <li><input id="filter7" type="checkbox" value="7"> <label for="filter7">$200 - $399</label>
                    </li>
                    <li><input id="filter8" type="checkbox" value="8"> <label for="filter8">$400 - $999</label>
                    </li>
                </ul>
            </li>
        </ul>
        <a class="button" id="button-filter">Refine Search</a>
    </div>
</div> -->
<!-- end here -->


                        <div class="row banners hidden-xs" style="margin-top: 20px">

                            <div class="col-sm-12">

                                <a href="#"><img alt="Image" src=

                                    "image/catalog/banner-category.png"></a>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-9">

                        <div class="row">

                            <div class="col-sm-12 center-column">

                                <div class="category-info clearfix">

                                    <div class="image"><img alt="Girls" src=

                                        "http://themenis.com/opencart/stowear/v1/image/cache/catalog/women-870x261.png">

                                    </div>

                                </div><!-- Filter -->
<!-- edited by kartik -->
<!-- <div class="product-filter clearfix">
    <div class="options">
        <div class="product-compare">
            <a href="#" id="compare-total">Product Compare (0)</a>
        </div>
        <div class="button-group display" data-toggle="buttons-radio">
            <button class="active" id="grid" onclick="display('grid');" rel="tooltip" title="Grid">
            <i class="fa fa-th-large"></i></button>
            <button id="list" onclick="display('list');" rel="tooltip" title="List"></button>
        </div>
    </div>
    <div class="list-options">
        <div class="sort">
            Sort By: <select>
                <option selected="selected" value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=p.sort_order&amp;order=ASC">
                    Default
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=pd.name&amp;order=ASC">
                    Name (A - Z)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=pd.name&amp;order=DESC">
                    Name (Z - A)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=p.price&amp;order=ASC">
                    Price (Low &gt; High)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=p.price&amp;order=DESC">
                    Price (High &gt; Low)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=rating&amp;order=DESC">
                    Rating (Highest)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=rating&amp;order=ASC">
                    Rating (Lowest)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=p.model&amp;order=ASC">
                    Model (A - Z)
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;sort=p.model&amp;order=DESC">
                    Model (Z - A)
                </option>
            </select>
        </div>
        <div class="limit">
            Show: <select>
                <option selected="selected" value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;limit=15">
                    15
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;limit=25">
                    25
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;limit=50">
                    50
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;limit=75">
                    75
                </option>
                <option value="http://themenis.com/opencart/stowear/v1/index.php?route=product/category&amp;path=33&amp;limit=100">
                    100
                </option>
            </select>
        </div>
    </div>
</div> -->
<!-- end here -->


                                <!-- Products grid -->

                                <div class="product-grid" style="display: block;">

                                    {{-- */$k = 0;/* --}}

                                    {{-- */$l = 4;/* --}}

                                    @for($i=1; $i<=floor(count($products)/2); $i++)

                                        <div class="row">

                                            @for($j=$k; $j<$l; $j++)

                                                @if($products[$j]['product_name'])

                                                    <div class="col-sm-3 col-xs-6">

                                                        <!-- Product -->

                                                        <div class="product clearfix">

                                                            <div class="left">
                                                                <!-- edited by kartik -->
                                                                <div class="image" style="width: 196px; height: 196px;">

                                                                    <div class="image image-swap-effect">

                                                                        <a href=

                                                                           "{{URL::asset('/')}}hunt-detail/{{$products[$j]['hunt_id']}}">

                                                                            <img alt="Canon EOS 5D"

                                                                                 style="height:160px; width:170px;" src=

                                                                                 "images/product_hunt/{{$products[$j]['product_image']}}">

                                                                        </a>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="right">

                                                                <div class="name" style="width: 129px;
    height: 35px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;">

                                                                    <a href=

                                                                       "{{URL::asset('/')}}hunt-detail/{{$products[$j]['hunt_id']}}">

                                                                        {{$products[$j]['product_name']}}</a>

                                                                </div>

                                                                <div class="price">

                                                                    <span class="price-new">${{$products[$j]['product_price']}}</span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                @endif

                                                {{-- */$k++;/* --}}

                                            @endfor

                                            {{-- */$l = 8;/* --}}

                                        </div>

                                    @endfor

                                </div>

                                <div class="row pagination-results">

                                    <div class="col-sm-6 text-left"></div>

                                    <div class="col-sm-6 text-right">

                                        {{ $products->links() }}

                                    </div>

                                </div>

                                <script type="text/javascript">

                                    $(document).ready(function () {

                                        $("#sendmessage").click(function () {

                                            $.ajax({

                                                url: '{{ URL::asset('/')}}send-buyer-message',

                                                type: 'post',

                                                data: {

                                                    message: $('#message').val(),

                                                    product: $('#productname').val(),

                                                    buyer_id: $('#buyer').val(),

                                                    _token: "{{ csrf_token() }}"

                                                },

                                                success: function (getmessage) {

                                                    alert(getmessage);

                                                }

                                            });

                                        })

                                    })

                                </script>

@stop