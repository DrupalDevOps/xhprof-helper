<?php

namespace rallentemp;

class XHProfHelper {
    public function __construct() {
        register_shutdown_function('xhprof_helper_shutdown');
    }
}

function xhprof_helper_shutdown() {
    error_log("Shut down function called");
    echo "Shut down function called";
}
