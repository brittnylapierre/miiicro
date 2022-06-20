<?php

use Composer\Semver\Comparator;

autoload_add_namespace(__DIR__ . '/src/', 'MicroweberPackages\\Modules\\StandaloneUpdater\\');

function mw_standalone_updater_get_latest_version()
{
    return cache()->remember('standalone_updater_latest_version', 1440, function () {
        $updateApi = 'http://updater.microweberapi.com/builds/master/version.txt';
        $version = app()->url_manager->download($updateApi);
        if ($version) {
            $version = trim($version);
            return $version;
        }
    });
}
function mw_standalone_updater_get_latest_composer_json()
{
    return cache()->remember('standalone_updater_latest_version_composer_json', 1440, function () {
        $updateApi = 'http://updater.microweberapi.com/builds/master/composer.json';
        $json = app()->url_manager->download($updateApi);
        if ($json) {
            $json = @json_decode($json,true);
            return $json;
        }
    });
}

function mw_standalone_updater_delete_recursive($dir)
{
    if (!is_dir($dir)) {
        return;
    }

    try {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            @$todo($fileinfo->getRealPath());
        }
    } catch (\Exception $e) {
        // Cant remove files from this path
    }

    @rmdir($dir);
}

function mw_standalone_updater_is_enabled()
{

    if (mw()->ui->disable_marketplace != true) {
        return false;
    }
    if (is_link(mw_root_path() . DS . 'src')) {
        return false;
    }
    if (is_link(mw_root_path() . DS . 'vendor')) {
        return false;
    }
    return true;
}


event_bind('mw.admin', function ($params = false) {
    if (mw_standalone_updater_is_enabled()) {
        // Show new update on dashboard
        $lastUpdateCheckTime = get_option('last_update_check_time', 'standalone-updater');
        if (!$lastUpdateCheckTime) {
            $lastUpdateCheckTime = \Carbon\Carbon::now();
        }

        $showDashboardNotice = \Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($lastUpdateCheckTime));
        if ($showDashboardNotice) {

            $newVersionNumber = mw_standalone_updater_get_latest_version();


            if (Comparator::equalTo($newVersionNumber, MW_VERSION)) {
                save_option('last_update_check_time', \Carbon\Carbon::parse('+24 hours'), 'standalone-updater');
                return;
            }

            $mustUpdate = false;
            if (Comparator::greaterThan($newVersionNumber, MW_VERSION)) {
                $mustUpdate = true;
            }

            if ($mustUpdate) {
                event_bind('mw.admin.dashboard.start', function ($item) use ($newVersionNumber) {
                    echo '<div type="standalone-updater/dashboard_notice" new-version="' . $newVersionNumber . '" class="mw-lazy-load-module"></div>';
                });
            } else {
                save_option('last_update_check_time', \Carbon\Carbon::parse('+24 hours'), 'standalone-updater');
                return;

            }
        }
    }
});

