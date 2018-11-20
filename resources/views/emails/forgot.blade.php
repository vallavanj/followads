<?php 
/* echo"<pre>";
print_R($user) ;exit;
foreach($user as $usr)
{
	echo "<a>Hiie Thanks for Register Mr". $usr->name."</a>";
	echo "<a href=" .$user->url.">Click</a>";
} */
?>
<a>Hi <?php echo $user['name'].",";?></a>
<div>Please<a href=<?php echo $user['url'];?> > Click Here </a>to reset your password.</div>


