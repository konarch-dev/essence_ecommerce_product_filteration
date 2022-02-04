<?php
if (isset($_POST['sort'])) //// fetch sorting price, discount

{
    $fetch_data = str_replace('"', "", json_encode($_POST['sort']));
}
else
{
    $fetch_data = "";
}
if (isset($_POST['category'])) ////// fetch category name

{
    $category_data = str_replace('"', "", json_encode($_POST['category']));
}
else
{
    $category_data = "";
}

if (isset($_POST['price_min'])) ////// fetch category name

{
    $price_min_data = str_replace('"', "", json_encode($_POST['price_min']));
}
else
{
    $price_min_data = "";
}

if (isset($_POST['price_max'])) ////// fetch category name

{
    $price_max_data = str_replace('"', "", json_encode($_POST['price_max']));
}
else
{
    $price_max_data = "";
}

//////////////          for dropdown    //////////////
if ((($fetch_data == 'cheapest') || ($fetch_data == 'discount')) && (isset($_POST['category']))) //// if sorting is on price

{
    $data = json_decode(file_get_contents("data.json") , true);
    $i = 0;
    $cheapest = [];
    $category = [];
    foreach ($data as $key => $row)
    {
        $cheapest['new-price'][$key] = $row['new-price'];
        $category['category'][$key] = $row['category'];

        $cheapest['discount'][$key] = $row['discount'];
    }
    //  if (isset($_POST['category']))  //// filteration based on category
    //  {
    if ($fetch_data == "cheapest")
    {
        array_multisort($cheapest['new-price'], SORT_ASC, $data);
    }

    if ($fetch_data == "discount")
    {

        array_multisort($cheapest['discount'], SORT_DESC, $data);
    }
    $category_key = array_keys(array_column($data, 'category') , $category_data);

    $resdata = [];

    foreach ($data as $data_key => $data_value)
    {

        foreach ($category_key as $cat_value)
        {
            if ($data_key == $cat_value)
            {
                if (($_POST['price_max'] > $data_value["new-price"]) && ($data_value["new-price"] > $_POST['price_min']))
                {

                    $resdata[] = array(
                        "id" => $data_value['id'],
                        "name" => $data_value['name'],
                        "img" => $data_value['img'],
                        "img2" => $data_value['img2'],
                        "old-price" => $data_value['old-price'],
                        "new-price" => $data_value['new-price'],
                        "discount" => $data_value['discount'],
                        "category" => $data_value['category']

                    );
                }
            }

        }
    }
    // }
    

    foreach ($resdata as $value)
    {
?>
              <!-- Single Product -->
 <div id="poduct<?php echo $i; ?>" price="<?php echo $value['new-price']; ?>" class="col-12 col-sm-6 col-lg-4" newprice1="55">
    <div class="single-product-wrapper">
                                    <!-- Product Image -->
        <div class="product-img">
            <img src="<?php echo $value['img']; ?>" alt="">
                                        <!-- Hover Thumb -->
                <img class="hover-img" src="<?php echo $value['img2']; ?>" alt="">

                                        <!-- Product Badge -->
                    <div class="product-badge offer-badge">
                        <span>-<?php echo $value['discount']; ?>%</span>
                    </div>
                                        <!-- Favourite -->
                        <div class="product-favourite">
                            <a href="#" class="favme fa fa-heart"></a>
                        </div>
                    </div>

                                    <!-- Product Description -->
                <div class="product-description">
                    <span><?php echo $value['category']; ?></span>
                        <a href="single-product-details.html">
                            <h6><?php echo $value['name']; ?></h6>
                                        </a>
                    <p class="product-price" ><span class="old-price">&#8377;<?php echo $value['old-price']; ?></span>&#8377;<?php echo $value['new-price']; ?></p>

                                        <!-- Hover Content -->
                    <div class="hover-content">
                                            <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
   <button onclick="buy(<?php echo $value['id']; ?>,'<?php echo $value['name']; ?>','<?php echo $value['category']; ?>','<?php echo $value['new-price']; ?>','<?php echo $value['img']; ?>')" class="btn essence-btn">Add to Cart</button>
                                            </div>



  <script>

     function buy(id,name,category,price,img){
        
      
$.ajax({
            type: "POST",
            url: 'purchase.php',
            data: {id:id,name:name,img:img,price:price,category:category},
            success: function(data){
               $("#mycartdetail").html(data);


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

$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'carttotal.php',
            success: function(data){
               $("#carttotal").html(data);
              
            }
        });

});




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
                          <span class="product-remove"><i class="fa fa-close" onClick="deletecart(`+key+`)" aria-hidden="true"></i></span>
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
              //alert('added');
            }
        });

});
/*  end */
            }
        });

                }

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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
<?php
        $i++;
    }
    $data = [];
    $cheapest = [];
    $resdata = [];
}

else if ((($fetch_data == 'cheapest') || ($fetch_data == 'discount')) && (!isset($_POST['category'])))
{

    $data = json_decode(file_get_contents("data.json") , true);
    foreach ($data as $key => $row)
    {
        $cheapest['new-price'][$key] = $row['new-price'];
        $category['category'][$key] = $row['category'];
        $cheapest['discount'][$key] = $row['discount'];
    }
    $resdata = [];
    if ($fetch_data == "cheapest")
    {
        array_multisort($cheapest['new-price'], SORT_ASC, $data);
    }

    if ($fetch_data == "discount")
    {
        array_multisort($cheapest['discount'], SORT_DESC, $data);
    }
    foreach ($data as $data_key => $data_value)
    {
        if (($_POST['price_max'] > $data_value["new-price"]) && ($data_value["new-price"] > $_POST['price_min']))
        {

            $resdata[] = array(
                "id" => $data_value['id'],
                "name" => $data_value['name'],
                "img" => $data_value['img'],
                "img2" => $data_value['img2'],
                "old-price" => $data_value['old-price'],
                "new-price" => $data_value['new-price'],
                "discount" => $data_value['discount'],
                "category" => $data_value['category']

            );
        }
    }

    $i = 0;
    foreach ($resdata as $value)
    {
?>
              <!-- Single Product -->
 <div id="poduct<?php echo $i; ?>" price="<?php echo $value['new-price']; ?>" class="col-12 col-sm-6 col-lg-4" newprice1="55">
    <div class="single-product-wrapper">
                                    <!-- Product Image -->
        <div class="product-img">
            <img src="<?php echo $value['img']; ?>" alt="">
                                        <!-- Hover Thumb -->
                <img class="hover-img" src="<?php echo $value['img2']; ?>" alt="">

                                        <!-- Product Badge -->
                    <div class="product-badge offer-badge">
                        <span>-<?php echo $value['discount']; ?>%</span>
                    </div>
                                        <!-- Favourite -->
                        <div class="product-favourite">
                            <a href="#" class="favme fa fa-heart"></a>
                        </div>
                    </div>

                                    <!-- Product Description -->
                <div class="product-description">
                    <span><?php echo $value['category']; ?></span>
                        <a href="single-product-details.html">
                            <h6><?php echo $value['name']; ?></h6>
                                        </a>
                    <p class="product-price" ><span class="old-price">&#8377;<?php echo $value['old-price']; ?></span>&#8377;<?php echo $value['new-price']; ?></p>

                                        <!-- Hover Content -->
                    <div class="hover-content">
                                            <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
    <button onclick="shop(<?php echo $value['id']; ?>,'<?php echo $value['name']; ?>','<?php echo $value['category']; ?>','<?php echo $value['new-price']; ?>','<?php echo $value['img']; ?>')" class="btn essence-btn">Add to Cart</button>
                                            </div>



  <script>



     function shop(id,name,category,price,img){
        
      
$.ajax({
            type: "POST",
            url: 'purchase.php',
            data: {id:id,name:name,img:img,price:price,category:category},
            success: function(data){
               $("#mycartdetail").html(data);


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

$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'carttotal.php',
            success: function(data){
               $("#carttotal").html(data);
              
            }
        });

});




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
                          <span class="product-remove"><i class="fa fa-close" onClick="deletecart(`+key+`)" aria-hidden="true"></i></span>
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
              //alert('added');
            }
        });

});
/*  end */
            }
        });

            }

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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
<?php
        $i++;
    }
    $data = [];
    $cheapest = [];
    $resdata = [];

}

else if ((!isset($_POST['sort']) || ($_POST['sort'] == "")) && (isset($_POST['category'])))
{

    $data = json_decode(file_get_contents("data.json") , true);
    foreach ($data as $key => $row)
    {
        $cheapest['new-price'][$key] = $row['new-price'];
        $category['category'][$key] = $row['category'];
        $cheapest['discount'][$key] = $row['discount'];
    }

    $category_key = array_keys(array_column($data, 'category') , $category_data);

    $resdata = [];

    foreach ($data as $data_key => $data_value)
    {

        foreach ($category_key as $cat_value)
        {
            if ($data_key == $cat_value)
            {
                if (($_POST['price_max'] > $data_value["new-price"]) && ($data_value["new-price"] > $_POST['price_min']))
                {

                    $resdata[] = array(
                        "id" => $data_value['id'],
                        "name" => $data_value['name'],
                        "img" => $data_value['img'],
                        "img2" => $data_value['img2'],
                        "old-price" => $data_value['old-price'],
                        "new-price" => $data_value['new-price'],
                        "discount" => $data_value['discount'],
                        "category" => $data_value['category']

                    );
                }
            }

        }
    }

    $i = 0;
    foreach ($resdata as $value)
    {
?>
              <!-- Single Product -->
 <div id="poduct<?php echo $i; ?>" price="<?php echo $value['new-price']; ?>" class="col-12 col-sm-6 col-lg-4" newprice1="55">
    <div class="single-product-wrapper">
                                    <!-- Product Image -->
        <div class="product-img">
            <img src="<?php echo $value['img']; ?>" alt="">
                                        <!-- Hover Thumb -->
                <img class="hover-img" src="<?php echo $value['img2']; ?>" alt="">

                                        <!-- Product Badge -->
                    <div class="product-badge offer-badge">
                        <span>-<?php echo $value['discount']; ?>%</span>
                    </div>
                                        <!-- Favourite -->
                        <div class="product-favourite">
                            <a href="#" class="favme fa fa-heart"></a>
                        </div>
                    </div>

                                    <!-- Product Description -->
                <div class="product-description">
                    <span><?php echo $value['category']; ?></span>
                        <a href="single-product-details.html">
                            <h6><?php echo $value['name']; ?></h6>
                                        </a>
                    <p class="product-price" ><span class="old-price">&#8377;<?php echo $value['old-price']; ?></span>&#8377;<?php echo $value['new-price']; ?></p>

                                        <!-- Hover Content -->
                    <div class="hover-content">
                                            <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
<button onclick="purchased(<?php echo $value['id']; ?>,'<?php echo $value['name']; ?>','<?php echo $value['category']; ?>','<?php echo $value['new-price']; ?>','<?php echo $value['img']; ?>')" class="btn essence-btn">Add to Cart</button>
                                            </div>



  <script>

     function purchased(id,name,category,price,img){
        
      
$.ajax({
            type: "POST",
            url: 'purchase.php',
            data: {id:id,name:name,img:img,price:price,category:category},
            success: function(data){
               $("#mycartdetail").html(data);


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

$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'carttotal.php',
            success: function(data){
               $("#carttotal").html(data);
              
            }
        });

});

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
                          <span class="product-remove"><i class="fa fa-close" onClick="deletecart(`+key+`)"  aria-hidden="true"></i></span>
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
              //alert('added');
            }
        });

});
/*  end */
            }
        });
                }

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


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
<?php
        $i++;
    }
    $data = [];
    $cheapest = [];
    $resdata = [];

}

else
//// by default product listing

{
    $i = 0;
    $data = json_decode(file_get_contents("data.json") , true);
    foreach ($data as $value)
    {
        if (($_POST['price_max'] > $value['new-price']) && ($value['new-price'] > $_POST['price_min']))
        {
?>
        <!-- Single Product -->
 <div id="poduct<?php echo $i; ?>" price="<?php echo $value['new-price']; ?>" class="col-12 col-sm-6 col-lg-4" newprice1="55">
    <div class="single-product-wrapper">
                                    <!-- Product Image -->
        <div class="product-img">
            <img src="<?php echo $value['img']; ?>" alt="">
                                        <!-- Hover Thumb -->
                <img class="hover-img" src="<?php echo $value['img2']; ?>" alt="">

                                        <!-- Product Badge -->
                    <div class="product-badge offer-badge">
                        <span>-<?php echo $value['discount']; ?>%</span>
                    </div>
                                        <!-- Favourite -->
                        <div class="product-favourite">
                            <a href="#" class="favme fa fa-heart"></a>
                        </div>
                    </div>

                                    <!-- Product Description -->
                <div class="product-description">
                    <span><?php echo $value['category']; ?></span>
                        <a href="single-product-details.html">
                            <h6><?php echo $value['name']; ?></h6>
                                        </a>
                    <p class="product-price" ><span class="old-price">&#8377;<?php echo $value['old-price']; ?></span>&#8377;<?php echo $value['new-price']; ?></p>

                                        <!-- Hover Content -->
                    <div class="hover-content">
                                            <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
    <button onclick="added(<?php echo $value['id']; ?>,'<?php echo $value['name']; ?>','<?php echo $value['category']; ?>','<?php echo $value['new-price']; ?>','<?php echo $value['img']; ?>')" class="btn essence-btn">Add to Cart</button>
                                            </div>
                                            <script>



     function added(id,name,category,price,img){
      
$.ajax({
            type: "POST",
            url: 'purchase.php',
            data: {id:id,name:name,img:img,price:price,category:category},
            success: function(data){
               $("#mycartdetail").html(data);


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

$(document).ready(function(){
$.ajax({
            type: "POST",
            url: 'carttotal.php',
            success: function(data){
               $("#carttotal").html(data);
              
            }
        });

});

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
}
              //alert('added');
            
        });

});

/*  end */
            }
        });

                                                }
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Single Product -->
                            <?php
            $i++;
        }
    }
    $data = [];
}

?>
