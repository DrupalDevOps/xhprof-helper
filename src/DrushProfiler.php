#!/usr/bin/env php
<?php

namespace rallentemp;

# Reference:
# - http://php.net/manual/en/xhprof.examples.php

//require "/composer/vendor/autoload.php";
//use rallentemp\DrushProfiler;
//new rallentemp\DrushProfiler();

# Todo
# Update readme
# Drush wrapper with the profiler


class DrushProfiler {
    public function __construct() {
        xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
        echo "Profiler activated.";
        register_shutdown_function("rallentemp\\DrushProfiler::shutdown");
    }

    static function shutdown() {
        $xhprof_data = xhprof_disable();
        echo "Profiler de-activated.";

        $XHPROF_PATH = getenv('XHPROF_PATH');
        include_once $XHPROF_PATH . "/xhprof_lib/utils/xhprof_lib.php";
        include_once $XHPROF_PATH . "/xhprof_lib/utils/xhprof_runs.php";

        $xhprof_session_name = "DrushProfiler";
        $xhprof_runs = new XHProfRuns_Default();
        $run_id = $xhprof_runs->save_run($xhprof_data, $xhprof_session_name);

        # $XHPROF_URL = getenv('NGINX_VHOST_NAME');
        # echo "http://${$XHPROF_URL}/index.php?run={$run_id}&source=${$xhprof_session_name}\n";
    }
}
