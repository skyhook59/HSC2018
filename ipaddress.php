<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>IP Address</title>
</head>
<body>
<?php
$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: ([\[\]:.[0-9a-fA-F]+)</', $externalContent, $m);
$externalip = $m[1];
?>

<table>
<td><tr>STeve</tr></td>
</table>

</body>
</html>

<?php echo $externalip ?> 

