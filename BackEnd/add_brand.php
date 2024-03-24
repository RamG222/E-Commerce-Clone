<?php
include('./connection.php');
include('header.php');

// Code for adding brand
if (isset($_POST['add'])) {
    $brand = $_POST['brandName'];

    $sql = "INSERT INTO `mst_brand`(`BRAND`) VALUES ('$brand')";
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "Brand added successfully";
    } else {
        echo "Failed to add Brand: " . mysqli_error($con);
    }
}

// Code for editing brand
if (isset($_GET['edit'])) {
    $editBID = $_GET['edit'];
    $sql_edit = "SELECT * FROM `mst_brand` WHERE `BID`='$editBID'";
    $res_edit = mysqli_query($con, $sql_edit);
    $row_edit = mysqli_fetch_assoc($res_edit);
}

// Code for updating brand
if (isset($_POST['update'])) {
    $editBID = $_POST['editBID'];
    $updatedBrand = $_POST['brandName'];

    $sql_update = "UPDATE `mst_brand` SET `BRAND`='$updatedBrand' WHERE `BID`='$editBID'";
    $res_update = mysqli_query($con, $sql_update);

    if ($res_update) {
        echo "Brand updated successfully";
    } else {
        echo "Failed to update Brand: " . mysqli_error($con);
    }
}

// Code for deleting brand
if (isset($_GET['delete'])) {
    $deleteBID = $_GET['delete'];
    $sql_delete = "DELETE FROM `mst_brand` WHERE `BID`='$deleteBID'";
    $res_delete = mysqli_query($con, $sql_delete);

    if ($res_delete) {
        echo "Brand deleted successfully";
    } else {
        echo "Failed to delete Brand: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- ... (unchanged HTML) ... -->

<body>
    <center>
        <div class="container">
            <h1 class="">Admin Dashboard</h1>
            <h2><?php echo isset($_GET['edit']) ? 'Edit Brand' : 'Add Brand'; ?></h2>
            <hr>

            <!-- Bootstrap Form -->
            <div class="col-md-3">
                <form method="POST">
                    <?php if (isset($_GET['edit'])) : ?>
                        <input type="hidden" name="editBID" value="<?php echo $row_edit['BID']; ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="brandName" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="brandName" name="brandName" value="<?php echo isset($_GET['edit']) ? $row_edit['BRAND'] : ''; ?>" required>
                    </div>
                    <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'add'; ?>" class="btn btn-primary">
                        <?php echo isset($_GET['edit']) ? 'Update Brand' : 'Add Brand'; ?>
                    </button>
                </form>
            </div>
        </div>
    </center>

    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>BID</th>
                <th>Brand Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $sql_brand_disp = "SELECT * FROM `mst_brand`";
            $res_brand_disp = mysqli_query($con, $sql_brand_disp);

            while ($row = mysqli_fetch_assoc($res_brand_disp)) {
            ?>
                <tr>
                    <td><?php echo $row['BID'] ?></td>
                    <td><?php echo $row['BRAND'] ?></td>
                    <td><button class="btn btn-success"><a href="add_brand.php?edit=<?php echo $row['BID'] ?>" class="text-decoration-none text-white">Edit</a></button></td>
                    <td><button class="btn btn-danger"><a href="add_brand.php?delete=<?php echo $row['BID'] ?>" class="text-decoration-none text-white">Delete</a></button></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>
