<?php

require('function.php');
require('api.php');







main();




function main(){
    banner();
    $cek = cek_token();
    api_balance($cek[0], $cek[1], $cek[2]);
    nyepin($cek[0], $cek[1], $cek[2]);
}




function banner(){
    echo @color('yellow', "\n\n
███╗   ███╗██████╗     ███████╗███████╗
████╗ ████║██╔══██╗    ╚════██║╚════██║
██╔████╔██║██████╔╝        ██╔╝    ██╔╝
██║╚██╔╝██║██╔══██╗       ██╔╝    ██╔╝ 
██║ ╚═╝ ██║██║  ██║       ██║     ██║  
╚═╝     ╚═╝╚═╝  ╚═╝       ╚═╝     ╚═╝");
}

