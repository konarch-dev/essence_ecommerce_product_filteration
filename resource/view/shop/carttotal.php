<?php

session_start();

                            if(isset($_SESSION['cart']))
                { 
                        echo "&#8377;".array_sum(array_column($_SESSION['cart'], 'price'));
                    }
                    else{
                        echo "0";
                    }
?>