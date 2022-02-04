
<?php
include('../header.php');
?>
<script src = 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
        </script>
            
 <!-- right cart area -->

<script>
$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'rightcart.php',
            data: {id:"0"},
            success: function(data){
               $("#carticon").html(data);
               $("#carticon2").html(data);
              
            }
        });

});
</script>
 <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>
    <div class="right-side-cart-area">

 <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="../../../public/img/core-img/bag.svg" alt=""> <span id="carticon">
            </span></a>
        </div>

        <div class="cart-content d-flex">

         
<script>
$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'cartlist.php',
            success: function(data){


            let parsed_data = jQuery.parseJSON(data);
            var html = "";

            $.each(parsed_data, function(key, value) {
            html += `<div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="`+value.img+`" class="cart-thumb" alt="">
                        <div class="cart-item-desc">
                          <span class="product-remove"><i onClick="deletecart(`+key+`)" class="fa fa-close"  aria-hidden="true"></i></span>
                            <span class="badge">`+value.category+`</span>
                            <h6>`+value.name+`</h6>
                            <p class="size">category: `+value.category+`</p>
                            <p class="color">id: `+value.id+`</p>
                            <p class="price">$ `+value.price+`</p>
                        </div>
                    </a>
                </div>`;
                   
});
               $(".cart-list").html(html);
       

            }
        });

});
   function deletecart(key)
{
    var cartkey=key;
$.ajax({
            type: "POST",
            url: 'deletecart.php',
            data: {id:cartkey},
             success: function(data){
            //   $("#carticon").html(data);
            //   $("#carticon2").html(data);
             $.ajax({
            type: "POST",
            url: 'cartlist.php',
            success: function(data){

            let parsed_data = jQuery.parseJSON(data);
            var html = "";

            $.each(parsed_data, function(key, value) {
            html += `<div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="`+value.img+`" class="cart-thumb" alt="">
                        <div class="cart-item-desc">
                          <span class="product-remove"><i onClick="deletecart(`+key+`)" class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">`+value.category+`</span>
                            <h6>`+value.name+`</h6>
                            <p class="size">category: `+value.category+`</p>
                            <p class="color">id: `+value.id+`</p>
                            <p class="price">&#8377; `+value.price+`</p>
                        </div>
                    </a>
                </div>`;
            
});
               $(".cart-list").html(html);

   $.ajax({
            type: "POST",
            url: 'rightcart.php',
            data: {id:"0"},
            success: function(data){
               $("#carticon").html(data);
               $("#carticon2").html(data);
            }
        });

   $.ajax({
            type: "POST",
            url: 'checkoutdetail.php',
            data: {id:"0"},
            success: function(data){
              $("#check").html(data);
            }
        });
   $.ajax({
            type: "POST",
            url: 'carttotal.php',
            success: function(data){
               $("#carttotal").html(data);
           
            }
        });

            }
        });
            }
        });
}
</script>
   <!-- Cart List Area -->
            <div class="cart-list">

            </div>


<script>
$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'carttotal.php',
            success: function(data){
               $("#carttotal").html(data);
              //alert('added');
            }
        });

});
</script>
            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> 
                        <span id="carttotal"></span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="./checkout.php" class="btn essence-btn">check out</a>
                </div>
            </div>
        </div>

       
    </div>
        </div>
 <!-- right cart area end -->
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(../../../public/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                        </div>

                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" value="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name <span>*</span></label>
                                    <input type="text" class="form-control" id="last_name" value="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="company">Company Name</label>
                                    <input type="text" class="form-control" id="company" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="country">Country <span>*</span></label>
                                    <select class="w-100" id="country">
                                        <option value="usa">United States</option>
                                        <option value="uk">United Kingdom</option>
                                        <option value="ger">Germany</option>
                                        <option value="fra">France</option>
                                        <option value="ind">India</option>
                                        <option value="aus">Australia</option>
                                        <option value="bra">Brazil</option>
                                        <option value="cana">Canada</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="street_address">Address <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" value="">
                                    <input type="text" class="form-control" id="street_address2" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="postcode">Postcode <span>*</span></label>
                                    <input type="text" class="form-control" id="postcode" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">Town/City <span>*</span></label>
                                    <input type="text" class="form-control" id="city" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="state">Province <span>*</span></label>
                                    <input type="text" class="form-control" id="state" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone_number">Phone No <span>*</span></label>
                                    <input type="number" class="form-control" id="phone_number" min="0" value="">
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="email_address" value="">
                                </div>

                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Terms and conitions</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Subscribe to our newsletter</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

<script>
$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'checkoutdetail.php',
            success: function(data){
             //  $("#carticon").html(data);
             //  $("#carticon2").html(data);
              $("#check").html(data);
            }
        });

});
</script>

                        <ul class="order-details-form mb-4" id="check">
                          
                        </ul>

                        <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                     <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Pay By Paytm</a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <p><a href="paypal.php" class="btn essence-btn">Place Order</a></p>
                                    </div>
                                </div>
                            </div>
                            
                          
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->
<?php
include('../footer.php');
include('../jsplugin.php');

?>

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>