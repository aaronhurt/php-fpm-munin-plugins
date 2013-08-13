<?php

/* average config */
function _config_phpfpm_average(array $my = array()) {
    /* set config options */
    $config = array(
        'graph_title' => 'PHP-FPM Average Process Size',
        'graph_args' => '--base 1024 -l 0',
        'graph_vlabel' => 'Average Process Size',
        'graph_category' => 'PHP',
        'graph_info' => 'This graph shows the average size of all php-fpm processes',
        'average.label' => 'Average Process Size',
        'average.draw' => 'LINE2',
    );
    /* print the config */
    _print_config($config);
}

/* average autoconf */
function _autoconf_phpfpm_average(array $my = array()) {
    if (_check_osname() === true) {
            print "yes\n"; exit(0);
    } else {
            print "no (possibly unsupported operating system)\n"; exit(1);
    }
}

/* connections config */
function _config_phpfpm_connection(array $my = array()) {
    /* set config options */
    $config = array(
        'graph_title' => 'PHP-FPM Accepted Connections',
        'graph_args' => '--base 1024 -l 0',
        'graph_vlabel' => 'Accepted Connections',
        'graph_category' => 'PHP',
        'graph_info' => 'This graph shows the connections accepted by all php-fpm processes',
        'accepted.label' => 'Accepted',
        'accepted.draw' => 'AREA',
        'accepted.type' => 'DERIVE',
        'accepted.min' => 0,
    );
    /* print the config */
    _print_config($config);
}

/* memory config */
function _config_phpfpm_memory(array $my = array()) {
    /* set config options */
    $config = array(
        'graph_title' => 'PHP-FPM Memory Usage',
        'graph_args' => '--base 1024 -l 0',
        'graph_vlabel' => 'RAM',
        'graph_category' => 'PHP',
        'graph_info' => 'This graph shows the total memory usage of all php-fpm processes',
        'memory.label' => 'Memory',
    );
    /* print the config */
    _print_config($config);
}

/* memory autoconf */
function _autoconf_phpfpm_memory(array $my = array()) {
    if (_check_osname() === true) {
            print "yes\n"; exit(0);
    } else {
            print "no (possibly unsupported operating system)\n"; exit(1);
    }
}

/* process config */
function _config_phpfpm_process(array $my = array()) {
    /* set config options */
    $config = array(
        'graph_title' => 'PHP-FPM Total Processes',
        'graph_args' => '--base 1024 -l 0',
        'graph_vlabel' => 'Total Processes',
        'graph_category' => 'PHP',
        'graph_info' => 'This graph shows the total number of all running php-fpm processes',
        'process.label' => 'Processes',
        'process.draw' => 'LINE2',
        'process.info' => 'The current number of php-fpm processes',
    );
    /* print the config */
    _print_config($config);
}

/* status config */
function _config_phpfpm_status(array $my = array()) {
    /* set config options */
    $config = array(
        'graph_title' => 'PHP-FPM Status',
        'graph_args' => '--base 1024 -l 0',
        'graph_vlabel' => 'Connections',
        'graph_category' => 'PHP',
        'graph_order' => 'idle active total',
        'graph_info' => 'This graph shows php-fpm connection status',
        'idle.label' => 'Idle',
        'idle.draw' => 'AREA',
        'active.label' => 'Active',
        'active.draw' => 'AREA',
        'total.label' => 'Total',
        'total.draw' => 'STACK',
    );
    /* print the config */
    _print_config($config);
}

?>
