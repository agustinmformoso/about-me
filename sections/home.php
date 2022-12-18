<?php
require_once './data/bootstrap.php';
require_once './libraries/auth.php';

// $str = userSearchByEmail($db, 'aformoso@test.com');
// print_r($str);

print_r(authGetUser()['username']);
?>

<section class="home">
    <div>
        <h2>welcome</h2>
    </div>
</section>