<?php 


if(isset($_POST['old']) && isset($_POST['new'])){


    $old = $_POST['old'];
    $new = $_POST['new'];
    
 
    echo "<pre>";

    echo "UPDATE wp_options SET option_value = replace(option_value, '".$old."', '".$new."') WHERE option_name = 'home' OR option_name = 'siteurl';";

    echo "<br>";

    echo "UPDATE wp_posts SET guid = replace(guid, '".$old."','".$new."');";

    echo "<br>";
    echo "UPDATE wp_posts SET post_content = replace(post_content, '".$old."', '".$new."');";

    echo "<br>";

    echo "UPDATE wp_postmeta SET meta_value = replace(meta_value, '".$old."', '".$new."');";

    echo "<br>";

    echo "</pre>";

}



?>

<pre>
<form method="post">
    
    <input type="text" required="" name="old" placeholder="Old url" /><br>
    <input type="text" name="new" required="" placeholder="New url" />
    <input type="submit" name="submit" value="Create" />
    
</form>


    


</pre>

<?php phpinfo(); ?>