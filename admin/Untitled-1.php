<div class="form-group m-b-20">
    <label for="exampleInputEmail1">Category</label>
    <select class="form-control" name="category" id="category" required>
        <option value="<?php echo htmlentities($row['categotyid']); ?>"><?php echo getCatName($conn, $row['categoryid']); ?> </option>
        <?php
        // Feching active categories
        $ret = mysqli_query($conn, "select categoryid, category_name from category where Is_Active=1");
        while ($result = mysqli_fetch_array($ret)) {
        ?>
            <option value="<?php echo htmlentities($result['categoryid']); ?>">
                <?php echo htmlentities($result['category_name']); ?></option>
        <?php } ?>

    </select>
</div>

<div class="form-group m-b-20">
    <label for="exampleInputEmail1">Publisher</label>
    <select class="form-control" name="publisher" id="publisher" required>
        <option value="<?php echo htmlentities($row['categotyid']); ?>"><?php echo getPubName($conn, $row['publisherid']); ?> </option>
        <?php
        // Feching active categories
        $ret = mysqli_query($conn, "select publisherid, publisher_name from publisher where Is_Active=1");
        while ($result = mysqli_fetch_array($ret)) {
        ?>
            <option value="<?php echo htmlentities($result['publisherid']); ?>">
                <?php echo htmlentities($result['publisher_name']); ?></option>
        <?php } ?>

    </select>
</div>



$catid = $_POST['category'];
$pubid = $_POST['publisher'];

categoryid='$catid', publisherid='$pubid',