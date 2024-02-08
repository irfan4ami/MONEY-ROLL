<?php



function headers($host){
    $headers = array();
        $headers[] = 'Host: '.$host;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'User-Agent: okhttp/4.10.0';
    return $headers;
}





function api_balance($host, $symbol, $mgckey){
    $url = 'https://'.$host.'/gs2c/ge/gameService';
    $body = 'action=doInit&symbol='.$symbol.'&cver=""&index=1&counter=1&repeat=0&mgckey='.$mgckey;
    $headers = headers($host);
    $get = get_postc($url, $body, $headers);
    if ($get[1] ==  'unlogged'){
        echo @color('red', 'TOKEN TIDAK VALID');
        main();
    } 
    echo @color('nevy', "\nBERHASIL LOGIN");
    echo @color('yellow', "\nSALDO : ".get_between($get[1], 'balance=', '&'));
    return $get;
}


function api_spin($host, $symbol, $mgckey, $bet, $index, $counter){
    $url = 'https://'.$host.'/gs2c/ge/gameService';
    $body = 'action=doSpin&symbol='.$symbol.'&c='.$bet.'&l=5&index='.$index.'&counter='.$counter.'&repeat=0&mgckey='.$mgckey;
    $headers = headers($host);
    $get = get_postc($url, $body, $headers);
    return $get;
}


function cek_token(){
    echo @color('green', "\n\nInput Token : ");
    $token = input();
    $url_parts = parse_url($token);
    parse_str($url_parts['query'], $parameters);
    $host = get_between($token, 'https://', '/');
    $symbol = $parameters['symbol'];
    $mgckey = $parameters['mgckey'];
    return array(
        $host,
        $symbol,
        $mgckey
    );
}


function nyepin($host, $symbol, $mgckey){
    echo @color('green', "\n\nInput SPIN : ");
    $total_spin = input();
    echo @color('green', "Input BET  : ");
    $bet = input();
    $index = 1;
    $counter = 1;
    for ($i = 1; $i <= $total_spin; $i++) {
        $index++; $counter++; $counter++;
        $spin = api_spin($host, $symbol, $mgckey, $bet / 5, $index, $counter);
        if (strpos($spin[1], 'stime=') === false){
            echo @color('red', 'TERJADI KESALAHAN');
            main();
        }
        echo @color('white', "\n[$i/$total_spin]");
        echo @color('yellow', " Saldo ".get_between($spin[1], 'balance=', '&'));
        echo @color('red', " => Bet $bet");
        echo @color('green', " => Reward ".get_between($spin[1], '&w=', ".00"));
    }
    main();
}
