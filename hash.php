<?php
// See the password_hash() example to see where this came from.
$hash = md5('123');;
echo $hash;
//echo md5('123');
//$password = "abcd1234";
//$md5hash = "$1$".md5($password);
if(password_verify('123', $hash)){
    echo "yes";
}


$str = 'apple';

echo "test2 1f3870be274f6c49b3e31a0c6728957f ";
echo "test3 ".md5($str);

if (md5($str) === '1f3870be274f6c49b3e31a0c6728957f') {
    echo "  Would you like a green or red apple?";
}

?>