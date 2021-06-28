<?php use App\Product; 
      use App\Cart;
?>


<form  action="shoppingcart.html" class="cart-form">
    <table class="shop_table">
        <thead>
        <tr>
            <th class="product-remove"></th>
            <th class="product-thumbnail"></th>
            <th class="product-name"></th>
            <th class="product-price"></th>
            <th class="product-quantity"></th>
            <th class="product-subtotal"></th>
        </tr>
        </thead>
        <tbody>

        <?php $totalPrice = 0 ?>
        @foreach($userCartItems as $item)
            <?php   $attrPrice = Product::getDiscountedAttrPrice( $item['product_id'], $item['size']); 
                    $availableStock = Cart::getAvailableStock($item['product_id'], $item['size']);
            ?>
            <tr class="cart_item">
                <td class="product-remove">
                    <a href="#" class="remove itemDelete" data-cartid="{{$item['id']}}"></a>
                </td>
                <td class="product-thumbnail">
                    <a href="#">
                        <img src="{{ asset('img/product/small/'.$item['product']['main_image'])}}" alt="{{$item['product']['name']}}"
                            class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                    </a>
                </td>
                <td class="product-name" data-title="Product">
                    <a href="#" class="title">{{$item['product']['name']}}</a>
                    <span class="attributes-select attributes-color">{{$item['product']['code']}},</span>
                    <span class="attributes-select attributes-size">{{$item['size']}}</span>
                </td>
                <td class="product-quantity" data-title="Quantity">
                    <div class="quantity">
                        <div class="control">
                            <a class="btn-number btnItemUpdate qtyminus quantity-minus" href="#" data-cartid="{{$item['id']}}">-</a>
                            <input id="qty" name="quantity" type="text" data-step="1" data-min="1" data-max="{{$availableStock}}" value="{{$item['quantity']}}" title="Qty"
                                class="input-qty qty" size="4">
                            <a href="#" class="btn-number btnItemUpdate qtyplus quantity-plus" data-cartid="{{$item['id']}}">+</a>
                        </div>
                    </div>
                </td>
                <td class="product-price" data-title="Price">
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">
                                    $
                                </span>
                                @if($attrPrice['discounted_price']>0)
                                    {{$attrPrice['discounted_price']}}
                                @else
                                    {{$attrPrice['product_price']}}
                                @endif
                            </span>
                </td>
            </tr>
            <?php
                if($attrPrice['discounted_price']>0) {
                    $totalPrice = $totalPrice + ( $attrPrice['discounted_price'] * $item['quantity']);
                } else {
                    $totalPrice = $totalPrice + ( $attrPrice['product_price'] * $item['quantity']);
                }
            ?>
        @endforeach
        <tr>
            <td class="actions">
                    <div class="coupon">
                        <label class="coupon_code">Coupon Code:</label>
                        <input name="code" id="code" type="text" class="input-text" placeholder="Promotion code here">
                        <a href="#"class="button coupBtn"></a>
                    </div>    
                <div class="order-total">
                    <span class="title">
                        Total Price:
                    </span>
                    <span class="total-price">
                        ${{$totalPrice}}
                    </span>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</form>