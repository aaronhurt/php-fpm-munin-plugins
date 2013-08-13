<?php

/* average check */
function _check_phpfpm_average(array $my = array()) {
    /* get processes matching fpmbin */
    $ps = _ps_grep($my['fpmbin'] . '|grep -v master');
    /* init count and total */
    $count = 0; $total = 0;
    /* split return on new line and sum sizes */
    foreach ($ps as $line => $data) {
        /* check validity */
        if (!empty($data['rss']) && is_numeric($data['rss'])) {
            /* build total */
            $total += ((int)$data['rss'] * 1024);
            /* increase count */
            $count ++;
        }
    }
    /* check results */
    if (($total > 0) && ($count > 0)) {
        print "average.value " . ($total / $count) . "\n";
    } else {
        print "average.value U\n";
    }
}

/* connection check */
function _check_phpfpm_connection(array $my = array()) {
    /* fetch stats */
    if (($data = _fetch_status($my['url'])) === false) {
        /* this will just return U below */
        $data = array();
    }

    /* check and print idle value */
    if (isset($data['accepted conn'])) {
        print "accepted.value " . $data['accepted conn'] . "\n";
    } else {
        print "accepted.value U\n";
    }
}

/* memory check */
function _check_phpfpm_memory(array $my = array()) {
    /* get processes matching fpmbin */
    $ps = _ps_grep($my['fpmbin'] . '|grep -v master');
    /* init count and total */
    $count = 0; $total = 0;
    /* split return on new line and sum sizes */
    foreach ($ps as $line => $data) {
        /* check validity */
        if (!empty($data['rss']) && is_numeric($data['rss'])) {
            /* build total */
            $total += ((int)$data['rss'] * 1024);
            /* increase count */
            $count ++;
        }
    }
    /* check results */
    if (($total > 0) && ($count > 0)) {
        print "memory.value " . $total . "\n";
    } else {
        print "memory.value U\n";
    }
}

/* process check */
function _check_phpfpm_process(array $my = array()) {
    /* fetch stats */
    if (($data = _fetch_status($my['url'])) === false) {
        /* this will just return U below */
        $data = array();
    }

    /* check and print idle value */
    if (isset($data['total processes'])) {
        print "process.value " . $data['total processes'] . "\n";
    } else {
        print "process.value U\n";
    }
}

/* status check */
function _check_phpfpm_status(array $my = array()) {
    /* fetch stats */
    if (($data = _fetch_status($my['url'])) === false) {
        /* this will just return U below */
        $data = array();
    }

    /* check and print idle value */
    if (isset($data['idle processes'])) {
        print "idle.value " . $data['idle processes'] . "\n";
    } else {
        print "idle.value U\n";
    }

    /* check and print active value */
    if (isset($data['active processes'])) {
        print "active.value " . $data['active processes'] . "\n";
    } else {
        print "active.value U\n";
    }

    /* check and print total value */
    if (isset($data['total processes'])) {
        print "total.value " . $data['total processes'] . "\n";
    } else {
        print "total.value U\n";
    }
}

?>
