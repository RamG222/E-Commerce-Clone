<?php
include('./connection.php');
include('header.php');

$category = '';
$editMode = false; // Variable to track whether in edit mode or not
// Code for deleting category
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];

    // Perform the deletion
    $sql_delete_cat = "DELETE FROM `sub_category` WHERE SCID = '$deleteId'";
    $res_delete_cat = mysqli_query($con, $sql_delete_cat);

    if ($res_delete_cat) {
        echo "Category deleted successfully";
        // Redirect to the same page to avoid resubmitting form on refresh
        header("Location: add_sub_cat.php");
        exit;
    } else {
        echo "Failed to delete category: " . mysqli_error($con);
    }
}
// Code for editing category
if (isset($_GET['edit'])) {
    $mcid = $_GET['edit'];

    $sql_fetch_1 = "SELECT * FROM sub_category WHERE SCID = '$mcid'";
    $res_sql_fetch = mysqli_query($con, $sql_fetch_1);

    if ($row_fetch = mysqli_fetch_assoc($res_sql_fetch)) {
        $category = $row_fetch['SUB_CATEGORY'];
        $editMode = true; // Set edit mode to true
    } else {
        $_GET['edit'] = 0;
    }
}

// Code for updating category
if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $category = $_POST['cat'];

    $sql_update_cat = "UPDATE `sub_category` SET `SUB_CATEGORY`='$category' WHERE SCID='$id'";
    $res_update_cat = mysqli_query($con, $sql_update_cat);

    if ($res_update_cat) {
        echo "Category updated successfully";
        // Redirect to the same page to avoid resubmitting form on refresh
        header("Location: add_sub_cat.php");
        exit;
    } else {
        echo "Failed to update category: " . mysqli_error($con);
    }
}

// Code for adding sub category
if (isset($_POST['add'])) {
    $cat = $_POST['cat'];
    $mcid = isset($_POST['mcid']) ? intval($_POST['mcid']) : 0; // Convert to integer

    $sql = "INSERT INTO `sub_category`(`MCID`, `SUB_CATEGORY`) VALUES ('$mcid', '$cat')";
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "SUB Category added successfully";
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
                <h2><?php echo $editMode ? 'Edit' : 'Add' ?> Sub Category</h2>
                <hr>
            </div>

            <div class="col-md-3">
                <form method="post">
                    <select class="form-control" name="mcid"> <!-- Corrected name attribute -->
                        <option value="0">Select Category</option>
                        <?php
                        $sql_select_brand = "SELECT * FROM main_category";
                        $result_select_brand = mysqli_query($con, $sql_select_brand);

                        while ($row3 = mysqli_fetch_array($result_select_brand)) {
                            echo "<option value='" . $row3['MCID'] . "'>" . $row3['CATEGORY'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <input type="text" value="<?php echo $category ?>" class="form-control" placeholder="Enter SUB Category Name" name="cat">
                    <br>
                    <button type="submit" class="btn btn-primary" name="<?php echo $editMode ? 'update' : 'add' ?>"><?php echo $editMode ? 'Update' : 'Add' ?> Sub Category</button>
                </form>

            </div>
        </center>
        <br>
        <div class="container py-4">
            <table class="table table-striped">
                <tr>
                    <th>MCID</th>
                    <th>SCID</th>
                    <th>SUB_CATEGORY</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                // Fetch and display sub-categories from the database
                $sql_select_subcategories = "SELECT * FROM `sub_category`";
                $result_select_subcategories = mysqli_query($con, $sql_select_subcategories);

                while ($row = mysqli_fetch_assoc($result_select_subcategories)) {
                    echo "<tr>
                                <td>{$row['MCID']}</td>
                                <td>{$row['SCID']}</td>
                                <td>{$row['SUB_CATEGORY']}</td>
                                <td><a href='add_sub_cat.php?edit={$row['SCID']}' class='btn btn-success'>Edit</a></td>
                                <td><a href='add_sub_cat.php?delete={$row['SCID']}' class='btn btn-danger'>Delete</a></td>
                            </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
    </div>



    </div>
</body>

</html>