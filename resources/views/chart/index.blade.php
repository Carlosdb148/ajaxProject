<?php
/*
    * Cart page - Shortcut Flow.
*/
    session_start();
    $rootPath = "paypal/";
    include_once('paypal/api/Config/Config.php');
    include_once('paypal/api/Config/Sample.php');
    include('paypal/templates/header.php');

    $baseUrl = str_replace("index.php", "", URL['current']);
?>
 @extends('base')
@section('modalContent')

<!-- ****** Cart Area Start ****** -->
        <div class="cart_area section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0;?>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td class="cart_product_img d-flex align-items-center">
                                                <a href="#"><img src="data:image/jpeg;base64,{{ $cart->shops->thumbnail }}" alt="Product"></a>
                                                <h6>{{ $cart->shops->name }}</h6>
                                            </td>
                                            <td class="price"><span>{{ $cart->shops->price }}€</span></td>
                                            <td class="qty">
                                                <div class="quantity">
                                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="{{ $cart->ammount }}">
                                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                </div>
                                            </td>
                                            <?php $total += $cart->shops->price * $cart->ammount; ?>
                                            <td class="total_price"><span>{{ $cart->shops->price * $cart->ammount }}€</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-footer d-flex mt-30">
                            <div class="back-to-shop w-50">
                                <a href="shop-grid-left-sidebar.html">Continue shooping</a>
                            </div>
                            <div class="update-checkout w-50 text-right">
                                <a href="#">clear cart</a>
                                <a href="#">Update cart</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="coupon-code-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Cupon code</h5>
                                <p>Enter your cupone code</p>
                            </div>
                            <form action="#">
                                <input type="search" name="search" placeholder="#569ab15">
                                <button type="submit">Apply</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="shipping-method-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Shipping method</h5>
                                <p>Select the one you want</p>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1"><span>Next day delivery</span><span>$4.99</span></label>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2"><span>Standard delivery</span><span>$1.99</span></label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3"><span>Personal Pickup</span><span>Free</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-total-area mt-70">
                            <h3 class="text-center">Pricing Details</h3>
        <hr>
                            <form class="form-horizontal">
            <!-- Cart Details -->
            <div class="form-group">
                <label for="camera_amount" class="col-sm-5 control-label">Camera</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="camera_amount"
                           name="camera_amount"
                           value="<?= SampleCart['item_amt'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="tax_amt" class="col-sm-5 control-label">Tax</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="tax_amt"
                           name="tax_amt"
                           value="<?= SampleCart['tax_amt'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="insurance_fee" class="col-sm-5 control-label">Insurance</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="insurance_fee"
                           name="insurance_fee"
                           value="<?= SampleCart['insurance_fee'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="handling_fee" class="col-sm-5 control-label">Handling Fee</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="handling_fee"
                           name="handling_fee"
                           value="<?= SampleCart['handling_fee'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="shipping_amt" class="col-sm-5 control-label">Estimated Shipping</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="shipping_amt"
                           name="shipping_amt"
                           value="<?= SampleCart['shipping_amt'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="shipping_discount" class="col-sm-5 control-label">Shipping Discount</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="shipping_discount"
                           name="shipping_discount"
                           value="<?= SampleCart['shipping_discount'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="total_amt" class="col-sm-5 control-label">Total Amount</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="total_amt"
                           name="total_amt"
                           value="<?= SampleCart['total_amt'] ?>"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="currency_Code" class="col-sm-5 control-label">Currency</label>
                <div class="col-sm-7">
                    <input class="form-control"
                           type="text"
                           id="currency_Code"
                           name="currency_Code"
                           value="USD"
                           readonly>
                </div>
            </div>
            <hr>

            <!-- Checkout Options -->
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-7">
                    <!-- Container for PayPal Shortcut Checkout -->
                    <div id="paypalCheckoutContainer"></div>

                    <!-- Container for PayPal Mark Redirect -->
                    <div id="paypalMarkRedirect">
                        <h4 class="text-center">OR</h4>
                        <a class="btn btn-success btn-block" href="<?= $rootPath ?>pages/shipping.php" role="button">
                            <h4>Proceed to Checkout</h4>
                        </a>
                    </div>
                </div>
            </div>
        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    

<!-- Javascript Import -->
<script src="https://www.paypal.com/sdk/js?client-id=sb&intent=capture&vault=false&commit=true<?php echo isset($_GET['buyer-country']) ? "&buyer-country=" . $_GET['buyer-country'] : "" ?>"></script>
<script src="<?= $rootPath ?>js/config.js"></script>

<!-- PayPal In-Context Checkout script -->
<script type="text/javascript">

    paypal.Buttons({

        // Set your environment
        env: '<?= PAYPAL_ENVIRONMENT ?>',

        // Set style of buttons
        style: {
            layout: 'vertical',   // horizontal | vertical
            size:   'responsive',   // medium | large | responsive
            shape:  'pill',         // pill | rect
            color:  'gold',         // gold | blue | silver | black,
            fundingicons: false,    // true | false,
            tagline: false          // true | false,
        },

        // Wait for the PayPal button to be clicked
        createOrder: function() {
            let formData = new FormData();
            formData.append('item_amt', document.getElementById("camera_amount").value);
            formData.append('tax_amt', document.getElementById("tax_amt").value);
            formData.append('handling_fee', document.getElementById("handling_fee").value);
            formData.append('insurance_fee', document.getElementById("insurance_fee").value);
            formData.append('shipping_amt', document.getElementById("shipping_amt").value);
            formData.append('shipping_discount', document.getElementById("shipping_discount").value);
            formData.append('total_amt', document.getElementById("total_amt").value);
            formData.append('currency', document.getElementById("currency_Code").value);
            formData.append('return_url',  '<?= $baseUrl.URL["redirectUrls"]["returnUrl"]?>' + '?commit=true');
            formData.append('cancel_url', '<?= $baseUrl.URL["redirectUrls"]["cancelUrl"]?>');

            return fetch(
                '<?= $rootPath.URL['services']['orderCreate']?>',
                {
                    method: 'POST',
                    body: formData
                }
            ).then(function(response) {
                return response.json();
            }).then(function(resJson) {
                console.log('Order ID: '+ resJson.data.id);
                return resJson.data.id;
            });
        },

        // Wait for the payment to be authorized by the customer
        onApprove: function(data, actions) {
            return fetch(
                '<?= $rootPath.URL['services']['orderGet'] ?>',
                {
                    method: 'GET'
                }
            ).then(function(res) {
                return res.json();
            }).then(function(res) {
                window.location.href = 'paypal/pages/success.php';
            });
        }

    }).render('#paypalCheckoutContainer');

</script>
@endsection