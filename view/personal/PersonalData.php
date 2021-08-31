<form name="fUser" id="fUser" method="post" action="?page=TabEdit">
    <input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['SES_LOGIN'];?>">
    <input type="hidden" name="mode" id="mode" value="1">
    <input type="hidden" name="user" id="user" value="U">
</form>
<?php
//echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&Kode=".$_SESSION['SES_LOGIN']."&mode=1&user=U'>";
?>
<script>
    document.forms["fUser"].submit();
</script>
