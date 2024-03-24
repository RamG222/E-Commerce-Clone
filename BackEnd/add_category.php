<?php 
    include('./connection.php');
    include('header.php');

    $category = '';
    $editMode = false; // Variable to track whether in edit mode or not
        // Code for deleting category
    if (isset($_GET['delete'])) {
        $deleteId = $_GET['delete'];

        // Perform the deletion
        $sql_delete_cat = "DELETE FROM `main_category` WHERE MCID = '$deleteId'";
        $res_delete_cat = mysqli_query($con, $sql_delete_cat);

        if ($res_delete_cat) {
            echo "Category deleted successfully";
            // Redirect to the same page to avoid resubmitting form on refresh
            header("Location: add_category.php");
            exit;
        } else {
            echo "Failed to delete category: " . mysqli_error($con);
        }
    }
    // Code for editing category
    if (isset($_GET['edit'])) {
        $mcid = $_GET['edit'];

        $sql_fetch_1 = "SELECT * FROM main_category WHERE MCID = '$mcid'";
        $res_sql_fetch = mysqli_query($con, $sql_fetch_1);

        if ($row_fetch = mysqli_fetch_assoc($res_sql_fetch)) {
            $category = $row_fetch['CATEGORY'];
            $editMode = true; // Set edit mode to true
        } else {
            $_GET['edit'] = 0;
        }
    }

    // Code for updating category
    if (isset($_POST['update'])) {
        $id = $_GET['edit'];
        $category = $_POST['cat'];

        $sql_update_cat = "UPDATE `main_category` SET `CATEGORY`='$category' WHERE MCID='$id'";
        $res_update_cat = mysqli_query($con, $sql_update_cat);

        if ($res_update_cat) {
            echo "Category updated successfully";
            // Redirect to the same page to avoid resubmitting form on refresh
            header("Location: add_category.php");
            exit;
        } else {
            echo "Failed to update category: " . mysqli_error($con);
        }
    }

    // Code for adding category
    if (isset($_POST['add'])) {
        $cat = $_POST['cat'];

        $sql = "INSERT INTO `main_category`(`CATEGORY`) VALUES ('$cat')";
        $res = mysqli_query($con, $sql);
        
        if ($res) {
            echo "Category added successfully";
        } else {
            echo "Failed to add category: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editMode ? 'Edit' : 'Add' ?> Category</title>
</head>
<body>
    <div id="container">
        <center>
            <div>
                <h1 class="">Admin Dashboard</h1>
                <h2><?php echo $editMode ? 'Edit' : 'Add' ?> Category</h2>
                <hr>
            </div>

            <div class="col-md-3">
                <form method="post">
                    <input type="text" value="<?php echo $category ?>" class="form-control" placeholder="Enter Category Name" name="cat">
                    <br>
                    <button type="submit" class="btn btn-primary" name="<?php echo $editMode ? 'update' : 'add' ?>"><?php echo $editMode ? 'Update' : 'Add' ?> Category</button>
                </form>
            </div>
        </center>

        <div class="container py-4">
            <table class="table table-striped">
                <tr>
                    <th>Cat ID</th>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    $sql_cat_disp = "SELECT * FROM `main_category` WHERE 1";
                    $res_cat_disp = mysqli_query($con, $sql_cat_disp);
                    while($row = mysqli_fetch_assoc($res_cat_disp)){
                ?>
                    <tr>
                        <td><?php echo $row['MCID'] ?></td>
                        <td><?php echo $row['CATEGORY']?></td>
                        <td><button class="btn btn-success"><a href="add_category.php?edit=<?php echo $row['MCID']?>" class="text-decoration-none text-white">Edit</a></button></td>
                        <td><button class="btn btn-danger"><a href="add_category.php?delete=<?php echo $row['MCID']?>" class="text-decoration-none text-white">Delete</a></button></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
