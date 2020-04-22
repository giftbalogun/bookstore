<?php
$pagetype = 'overal';
$query = mysqli_query($con, "select PageTitle,Description from tblpages where PageName='$pagetype'");
while ($row = mysqli_fetch_array($query)) {

    ?>
<!-- App title -->
<title><?php echo htmlentities($row['PageTitle']) ?></title>

<?php } ?>