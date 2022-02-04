
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

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>dresses</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>


<?php
$list_data=json_decode(file_get_contents("data.json"), true);

        foreach ($list_data as $list_key => $list_row)
        {
            $category_data[] = $list_row['category'];
        }
     //   print_r($category_data);

?>
                            <!--  Catagories  -->
                            <div class="widget-desc">
                                <ul >
                                    <!-- Single Item -->

      <?php
            foreach (array_unique($category_data) as $category_key => $category_row)
        {
           
        ?>
            <li>
                <input type="radio" name="category_opt" id="category_opt" value="<?php echo $category_row; ?>">
              <?php echo $category_row; ?>
                                    </li>
                                    <?php
                                }
                                ?>
                                   
<script>
  var urlmenuopt = document.getElementById('category_opt');



$(document).ready(function(){
    $('input[name="category_opt"]').click(function(){
       var category=$("input:radio[name=category_opt]:checked").val();

    // var pricelist=$("#mysortByselect").val();
$('.slider-range-price').each(function () {
        var min = jQuery(this).data('min');
        var max = jQuery(this).data('max');
        var unit = jQuery(this).data('unit');
        var value_min = jQuery(this).data('value-min');
        var value_max = jQuery(this).data('value-max');
        var label_result = jQuery(this).data('label-result');
        var t = $(this);

        $(this).slider({

             range: true,
            min: min,
            max: max,
            values: [value_min, value_max],

            change: function (event, ui) {
            

var category=$("input:radio[name=category_opt]:checked").val();
var price_min=ui.values[0];
var price_max=ui.values[1];
     var pricelist=$("#mysortByselect").val();
       $.ajax({
            type: "POST",
            url: 'product.php',
            data: {"sort":pricelist,"category":category,"price_min":price_min,"price_max":price_max},
            success: function(data){
               $("#result").html(data);
            }
        });

            }
        });
    });
    });
});

</script>

                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="0"  data-max="100" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="0" data-value-max="100" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $0.00 - $100.00</div>
                                </div>
                            </div>
                        </div>


                        <script>







                        </script>

                        <!-- ##### Single Widget ##### -->
                    

             
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                   
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                    
            <form action="#" method="get">

        <select name="select"  id="mysortByselect">
                        <option value="">Filter</option>
                        <option value="cheapest">Lowest price</option>
                      <option value="discount">Discount</option>
                                            </select>

<script>
  var urlmenu = document.getElementById('mysortByselect');
 
 urlmenu.onchange = function() {

       
$('.slider-range-price').each(function () {
        var min = jQuery(this).data('min');
        var max = jQuery(this).data('max');
        var unit = jQuery(this).data('unit');
        var value_min = jQuery(this).data('value-min');
        var value_max = jQuery(this).data('value-max');
        var label_result = jQuery(this).data('label-result');
        var t = $(this);

        $(this).slider({

             range: true,
            min: min,
            max: max,
            values: [value_min, value_max],

            change: function (event, ui) {
            

var category=$("input:radio[name=category_opt]:checked").val();
//
     var pricelist=$("#mysortByselect").val();
  //   alert(pricelist);
var price_min=ui.values[0];
var price_max=ui.values[1];
       $.ajax({
            type: "POST",
            url: 'product.php',
            data: {"sort":pricelist,"category":category,"price_min":price_min,"price_max":price_max},
            success: function(data){
               $("#result").html(data);
            }
        });

            }
        });
    });

};

</script>

                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                  <script type="text/javascript">
    $(document).ready(
           function(){
     var category=$("input:radio[name=category_opt]:checked").val();

     var pricelist=$("#mysortByselect").val();
   $.ajax({
            type: "POST",
            url: 'product.php',
            data: {"sort":pricelist,"category":category,"price_min":0,"price_max":100},
            success: function(data){
               $("#result").html(data);
            }
        });
    // var pricelist=$("#mysortByselect").val();
$('.slider-range-price').each(function () {
        var min = jQuery(this).data('min');
        var max = jQuery(this).data('max');
        var unit = jQuery(this).data('unit');
        var value_min = jQuery(this).data('value-min');
        var value_max = jQuery(this).data('value-max');
        var label_result = jQuery(this).data('label-result');
        var t = $(this);

        $(this).slider({

             range: true,
            min: min,
            max: max,
            values: [value_min, value_max],

            change: function (event, ui) {
            

var category=$("input:radio[name=category_opt]:checked").val();
var price_min=ui.values[0];
var price_max=ui.values[1];
       $.ajax({
            type: "POST",
            url: 'product.php',
            data: {"sort":pricelist,"category":category,"price_min":price_min,"price_max":price_max},
            success: function(data){
               $("#result").html(data);
            }
        });

            }
        });
    });
    }
    );
    </script>
              
                        <div class="row" id="result">

   
                            

                        </div>

                    </div>
                
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

<?php
include('../footer.php');
include('../jsplugin.php');

?>


</body>

</html>