<?php
setcookie("name", "karkar");
print_r($_COOKIE);
setcookie("cookie[three]", "cookiethree");
setcookie("cookie[two]", "cookietwo");
setcookie("cookie[one]", "cookieone");
session_start();
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $_SESSION['counter']++;
}

define('NAME', "karim");
$default = "karim";
$hello = function ($name = null) use ($default): string {
    $name = $name ?? $default;

    return $name;
};

?>

<h1>Hello <?php echo NAME; ?>, welcome to Chat Page</h1> 
<a href="/" >go back</a>
<a href="/raw" >go to raw page</a>

<form method="POST" >
<button type="submit" >increase</button>
</form>
<p><?php echo $_SESSION['counter']; ?></p>

<?php echo $hello();
