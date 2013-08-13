<?php

/* little curl helper */
function _fetch_status($url) {
    /* init curl */
    if (($ch = curl_init()) === false) {
        /* return false */
        return false;
    }
    /* curl options array */
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_URL => $url,
    );
    /* set curl options */
    if (curl_setopt_array($ch, $options) !== true) {
        /* return false */
        return false;
    }
    /* attempt to fetch url */
    $data = curl_exec($ch);
    /* close curl */
    curl_close($ch);
    /* attempt to decode status */
    if (($json = json_decode($data, true)) === null) {
        /* return false */
    }
    /* debug */
    //print "json == " . print_r($json, true) . "\n\n";
    /* return decoded json array */
    return $json;
}

/* grep process list */
function _ps_grep($string) {
    /* declare header */
    $head = array('user', 'pid', 'cpu', 'mem', 'vsz', 'rss', 'tty', 'stat', 'started', 'time');
    /* get process list from system */
    $exec = shell_exec('ps auxww|grep ' . $string . '|grep -v grep|' .
        'awk \'{print $1"|"$2"|"$3"|"$4"|"$5"|"$6"|"$7"|"$8"|"$9"|"$10}\'');
    /* declare process list and init count */
    $procs = array(); $count = 0;
    /* split return on new line and sum sizes */
    foreach (explode("\n", $exec) as $line) {
        /* explode line */
        $parts = explode("|", $line);
        /* valididty check */
        if (count($parts) < 10) continue;
        /* build an associative array */
        for ($i = 0; $i < 10; $i++) {
            $procs[$count][$head[$i]] = trim($parts[$i]);
        }
        /* increase count */
        $count ++;
    }
    /* return process array */
    return $procs;
}

/* config print function */
function _print_config(array $config = array()) {
    /* loop through config array and print */
    foreach ($config as $name => $value) {
        print "$name $value\n";
    }
    /* exit */
    exit(0);
}

/* supported operating system check */
function _check_osname() {
    /* get os name */
    $osname = php_uname('s');
    /* process list parsing is os specific
     * we have only tested the following */
    switch (strtolower($osname)) {
        case 'linux':
        case 'freebsd':
        case 'openbsd':
        case 'netbsd':
        case 'darwin':
           return true;
        default:
            return false;
        break;
    }
}

/* default autoconf */
function _autoconf_default(array $my = array()) {
    /* ensure we have curl */
    if (!extension_loaded('curl')) {
        print "no (curl support missing in php binary)\n"; exit(1);
    }
    /* ensure we jave json */
    if (!extension_loaded('json') || !function_exists('json_decode')) {
        print "no (json support missing in php binary)\n"; exit(1);
    }
    /* okay make sure we can connect and fetch status */
    if (($data = _fetch_status($my['url'])) === false) {
        print "no (could not fetch or decode status)\n"; exit(1);
    }
    /* default - all okay */
    print "yes\n"; exit(0);
}

?>
