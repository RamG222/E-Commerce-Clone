<?php
include('./connection.php');
include('header.php');

// Initialize variables
$product_name = $product_dsc = $product_url = $product_url2 = $product_url3 = $product_url4 = $mrp = $discount = $product_price = $product_quantity = $category = $sub_category = $brand = "";
$update_mode = false;

// Check if the edit parameter is present in the URL
if (isset($_GET['edit'])) {
    $update_mode = true;
    $edit_pid = $_GET['edit'];

    // Fetch product details for editing
    $sql_edit = "SELECT * FROM product WHERE PID = $edit_pid";
    $result_edit = mysqli_query($con, $sql_edit);

    if ($row_edit = mysqli_fetch_assoc($result_edit)) {
        $product_name = $row_edit['PRO_NAME'];
        $product_dsc = $row_edit['PRO_DSC'];
        $product_url = $row_edit['PRO_URL'];
        $product_url2 = $row_edit['PRO_URL2'];
        $product_url3 = $row_edit['PRO_URL3'];
        $product_url4 = $row_edit['PRO_URL4'];
        $mrp = $row_edit['MRP'];
        $discount = $row_edit['DISC'];
        $product_price = $row_edit['PRO_PRICE'];
        $product_quantity = $row_edit['PRO_QUANTITY'];
        $category = $row_edit['MCID'];
        $sub_category = $row_edit['SCID'];
        $brand = $row_edit['BID'];
    }
}

// Handle form submission for adding or updating product
if (isset($_POST['add_product']) || isset($_POST['update'])) {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $product_dsc = $_POST['product_dsc'];
    $product_url = $_POST['product_url'];
    $product_url2 = $_POST['product_url2'];
    $product_url3 = $_POST['product_url3'];
    $product_url4 = $_POST['product_url4'];
    $mrp = $_POST['mrp'];
    $discount = $_POST['discount'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];


    if ($update_mode) {
        // Update product
        $sql_update = "UPDATE product SET MCID='$category', SCID='$sub_category', BID='$brand', PRO_NAME='$product_name', PRO_DSC='$product_dsc', PRO_URL='$product_url', PRO_URL2='$product_url2', PRO_URL3='$product_url3', PRO_URL4='$product_url4', MRP='$mrp', DISC='$discount', PRO_PRICE='$product_price', PRO_QUANTITY='$product_quantity' WHERE PID='$edit_pid'";
        $result_update = mysqli_query($con, $sql_update);

        if ($result_update) {
            echo "<br><center><button class='btn btn-success'>Data Update Success</button></center>";
        } else {
            echo "Data update failed";
            echo $sql_update;
        }
    } else {
        // Insert new product
        $sql_insert = "INSERT INTO product (MCID, SCID, BID, PRO_NAME, PRO_DSC, PRO_URL, PRO_URL2, PRO_URL3, PRO_URL4, MRP, DISC, PRO_PRICE, PRO_QUANTITY) VALUES ('$category','$sub_category','$brand','$product_name','$product_dsc','$product_url','$product_url2','$product_url3','$product_url4','$mrp','$discount','$product_price','$product_quantity')";
        $result_insert = mysqli_query($con, $sql_insert);

        if ($result_insert) {
            echo "<br><center><button class='btn btn-success'>Data Insertion Success</button></center>";
        } else {
            echo "Data insertion failed";
            echo $sql_insert;
        }
    }
}

// Handle product deletion
if (isset($_GET['delete'])) {
    $delete_pid = $_GET['delete'];

    // Delete product
    $sql_delete = "DELETE FROM product WHERE PID='$delete_pid'";
    $result_delete = mysqli_query($con, $sql_delete);

    if ($result_delete) {
        echo "<br><center><button class='btn btn-success'>Data Deletion Success</button></center>";
    } else {
        echo "Data deletion failed";
        echo $sql_delete;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div>
                <h1 class="p-4">Admin Dashboard</h1>
                <h2>Add Products</h2>
                <hr>
            </div>
        </div>
    </div>

    

    <form class="form pt-4" method="post" action="" name="add_product">
        <div class="row">
            <div class="col-md-4">
                <div class="p-2 m-2">
                    <label>Product Name</label>
                    <input type="text"class="form-control" name="product_name" id="product_name" required value="<?php echo $pro_name ?>"/>
                </div>
                <div class="form-group p-2 m-2">
                    <label>Product Description</label>
                    <input type="text"class="form-control" name="product_dsc" id="product_dsc" required value="<?php echo $product_dsc ?>" />
                </div>
                <div class="form-group p-2 m-2">
                    <label>Product Image URL</label>
                    <input class="form-control" type="text" name="product_url" id="product_url" required value="<?php echo $product_url ?>"/>
                </div>
                <div class="p-2 m-2">
                    <label>Product Image URL 2</label>
                    <input class="form-control" type="text" name="product_url2" id="product_url2" required value="<?php echo $product_url2 ?>"/>
                </div>
                <div class="p-2 m-2">
                    <label>Product Image URL 3</label>
                    <input type="text"class="form-control" name="product_url3" id="product_url3" required value="<?php echo $product_url3 ?>"/>
                </div>
            </div>

        <div class="col-md-4">
        <div class="p-2 m-2">
                    <label>Product Image URL 4</label>
                    <input type="text"class="form-control" name="product_url4" id="product_url4" required value="<?php echo $product_url4 ?>"/>
                </div>
                <div class="p-2 m-2">
                    <label>Product MRP</label>
                    <input type="text" class="form-control"name="mrp" id="mrp" required value="<?php echo $mrp ?>"/>
                </div>

            <div class="p-2 m-2">
                    <label>Discount</label>
                    <input type="text"class="form-control" name="discount" id="discount" required value="<?php echo $discount ?>"/>
                </div>
                
                <div class="p-2 m-2">
                    <label>Product Price</label>
                    <input type="text"class="form-control" name="product_price" id="product_price" required value="<?php echo $product_price ?>"/>
                </div>
                <div class="p-2 m-2">
                    <label>Quantity</label>
                    <input type="text"class="form-control" name="product_quantity" id="product_quantity" required value="<?php echo $product_quantity ?>" />
                </div>
                
        </div>


        <div class="col-md-4">
        <div class="p-2 m-2">
                    <label>Select Category</label>
                    <select class="form-control" name="category">
                        <option value="0">Select Category</option>
                        <?php 
                            $sql_select_cat = "SELECT * FROM main_category";
                            $result_select_cat = mysqli_query($con, $sql_select_cat);

                            while ($row = mysqli_fetch_array($result_select_cat)){
                                echo "<option value='" . $row['MCID'] . "'>" . $row['CATEGORY'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="p-2 m-2">
                    <label>Select Sub Category</label>
                    <select class="form-control" name="sub_category">
                        <option value="0">Select Sub Category</option>
                        <?php 
                            $sql_select_sub_cat = "SELECT * FROM sub_category";
                            $result_select_sub_cat = mysqli_query($con, $sql_select_sub_cat);

                            while ($row2 = mysqli_fetch_array($result_select_sub_cat)){
                                echo "<option value='" . $row2['SCID'] . "'>" . $row2['SUB_CATEGORY'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="p-2 m-2">
                    <label>Select Brand</label>
                    <select class="form-control" name="brand">
                        <option value="0">Select Brand</option>
                        <?php 
                            $sql_select_brand = "SELECT * FROM mst_brand";
                            $result_select_brand = mysqli_query($con, $sql_select_brand);

                            while ($row3 = mysqli_fetch_array($result_select_brand)){
                                echo "<option value='" . $row3['BID'] . "'>" . $row3['BRAND'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <?php
                if ($_GET['edit'] != 0) {
                    echo "<button class='btn btn-primary' type='submit' name='update' value='add_product'>Update</button>";
                } else {
                    echo "<button class='btn btn-primary' type='submit' name='add_product' value='add_product'>Add Product</button>";
                }
                ?>
            </div>
        </div>
    </form>
</div>
    <?php

    if (isset($_POST['add_product'])){
        $pro_name=$_POST['product_name'];
        $pro_dsc=$_POST['product_dsc'];
        $pro_url=$_POST['product_url'];
        $pro_url2=$_POST['product_url2'];
        $pro_url3=$_POST['product_url3'];
        $pro_url4=$_POST['product_url4'];
        $mrp=$_POST['mrp'];
        $discount=$_POST['discount'];
        $pro_price=$_POST['product_price'];
        $pro_quantity=$_POST['product_quantity'];
        $brand=$_POST['brand'];
        $category=$_POST['category'];
        $sub_category=$_POST['sub_category'];


        $sql2= "INSERT INTO `product`( `MCID`, `SCID`, `BID`, `PRO_NAME`, `PRO_DSC`, `PRO_URL`, `PRO_URL2`, `PRO_URL3`, `PRO_URL4`, `MRP`, `DISC`, `PRO_PRICE`, `PRO_QUANTITY`) VALUES ('$category','$sub_category','$brand','$pro_name','$pro_dsc','$pro_url','$pro_url2','$pro_url3','$pro_url4','$mrp','$discount','$pro_price','$pro_quantity')";
        
        $result2= mysqli_query($con,$sql2);
        if ($result2){
            echo "<br><center><button class='btn btn-success'>Data Insertion Success</button></center>";
        } else {
            echo "data insertion failed";
            echo $sql2;
        }
    }
        ?>
        <hr>


        <div class="container-fluid">
        <table class="table table-striped">
            <tr>
                <th>SR NO</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Image 1</th>
                <th>Product Image 2</th>
                <th>Product Image 3</th>
                <th>Product Image 4</th>
                <th>MRP</th>
                <th>Discount</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            
                <?php
                $i=1;

                
                $sql3 = "select * from product";
                $result3 = mysqli_query($con,$sql3);

                while($row = mysqli_fetch_assoc($result3)) {
                    $PID = $row['PID'];
                ?>
                <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['PID']?></td>
                <td><?php echo $row['PRO_NAME']?></td>
                <td><?php echo $row['PRO_DSC']?></td>
                <td><img src="<?php echo $row['PRO_URL']?>" class="" width="100px" height="60px"></td>
                <td><img src="<?php echo $row['PRO_URL2']?>" class="" width="100px" height="60px"></td>
                <td><img src="<?php echo $row['PRO_URL3']?>" class="" width="100px" height="60px"></td>
                <td><img src="<?php echo $row['PRO_URL4']?>" class="" width="100px" height="60px"></td>
                <td><?php echo $row['MRP']?></td>
                <td><?php echo $row['DISC']?></td>
                <td><?php echo $row['PRO_PRICE']?></td>
                <td><?php echo $row['PRO_QUANTITY']?></td>

                <td><button class="btn btn-success"><a href="add_product.php?edit=<?php echo $PID?>" class="text-decoration-none text-white">Edit</a></button></td>
                <td><button class="btn btn-danger"><a href="add_product.php?delete=<?php echo $PID?>" class="text-decoration-none text-white">Delete</a></button></td>
            <?php 
            $i++;   
            }
                ?>
       </tr>
        </table>
        </div>
        </div>
        </center>
        </div>

        
</body>
</html>