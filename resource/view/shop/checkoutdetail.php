  <?php

session_start();
?>


<li><span>Product</span> <span>Total</span></li>
<?php
if(isset($_SESSION['cart']))
{
  foreach($_SESSION['cart'] as $value)
  {
?>
                            <li>
                              <span><?php echo $value['name'];?></span> <span>&#8377;<?php echo $value['price'];?>
                                
                              </span></li>

                            <?php
                          }
                          ?>
                            <li><span>Subtotal</span> <span>&#8377;<?php
                             echo array_sum(array_column($_SESSION['cart'], 'price'));
                           ?></span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total</span> <span>&#8377;<?php
                             echo array_sum(array_column($_SESSION['cart'], 'price'));
                           ?></span></li>

                            <?php
                          }
                          else
                          {
                        ?>

                         <li><span>-</span> <span>&#8377;0</span></li>

                          
                            <li><span>Subtotal</span> <span>&#8377;0
                           </span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total</span> <span>&#8377;0
                           </span></li>
                             <?php
                          }
                          ?>