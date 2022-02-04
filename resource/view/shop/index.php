
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
                            <p class="price">&#8377; `+value.price+`</p>
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
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(../../../public/img/bg-img/bg-1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>asoss</h6>
                        <h2>New Collection</h2>
                        <a href="shop.php" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(../../../public/img/bg-img/bg-2.jpg);">
                        <div class="catagory-content">
                            <a href="shop.php">Clothing</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(../../../public/img/bg-img/bg-3.jpg);">
                        <div class="catagory-content">
                            <a href="shop.php">Shoes</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(../../../public/img/bg-img/bg-4.jpg);">
                        <div class="catagory-content">
                            <a href="shop.php">Accessories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(../../../public/img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="shop.php" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->


    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="../../../public/img/core-img/brand1.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="../../../public/img/core-img/brand2.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="../../../public/img/core-img/brand3.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="../../../public/img/core-img/brand4.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="../../../public/img/core-img/brand5.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="../../../public/img/core-img/brand6.png" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->

<?php
include('../footer.php');
include('../jsplugin.php');

?>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.5/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.5/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCVCVLMLEsX_W2gVE7BmPz3Tcj8TI1yX_U",
    authDomain: "essence-65068.firebaseapp.com",
    projectId: "essence-65068",
    storageBucket: "essence-65068.appspot.com",
    messagingSenderId: "77821451591",
    appId: "1:77821451591:web:4d70cf66650771ebcac062",
    measurementId: "G-BSDTJM8TTJ"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
</body>

</html>