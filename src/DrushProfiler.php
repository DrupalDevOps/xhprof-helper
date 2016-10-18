<?php
namespace rallentemp;

class DrushProfiler {
    public function __construct() {
        xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
        echo "Profiler activated.";
        register_shutdown_function("rallentemp\\DrushProfiler::shutdown");
    }

    static function shutdown() {
        $xhprof_data = xhprof_disable();
        echo "Profiler de-activated.";

        $XHPROF_PATH = $_SERVER['XHPROF_PATH'];
        include_once $XHPROF_PATH . "/xhprof_lib/utils/xhprof_lib.php";
        include_once $XHPROF_PATH . "/xhprof_lib/utils/xhprof_runs.php";

        $xhprof_session_name = "DrushProfiler";
        $xhprof_runs = new \XHProfRuns_Default();
        $run_id = $xhprof_runs->save_run($xhprof_data, $xhprof_session_name);
    }
}
