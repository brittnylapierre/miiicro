<?php must_have_access(); ?>

<?php
$currentVersion = MW_VERSION;
$currentPHPVersion = PHP_VERSION;
$latestVersion = mw_standalone_updater_get_latest_version();
$latestVersionComposerJson = mw_standalone_updater_get_latest_composer_json();

if ($latestVersionComposerJson and isset($latestVersionComposerJson['require']['php']) and $latestVersionComposerJson['require']['php']) {
    $latestPHPVersionNeeded = $latestVersionComposerJson['require']['php'];
    $latestPHPVersionNeeded = str_replace(['>=', '=', '<=', '<','>',], '', $latestPHPVersionNeeded);
} else {
    $latestPHPVersionNeeded = false;
}


$canIUpdate = true;
$canIUpdateMessage = [];
$projectMainDir = dirname(dirname(dirname(__DIR__)));

if (is_dir($projectMainDir . DS . '.git')) {
    $canIUpdate = false;
    $canIUpdateMessages[] = 'The git repository is recognized on your server.';
}

/*
if (app()->environment() == 'production') {
    $canIUpdate = false;
    $canIUpdateMessages[] = 'The app is on production environment.';
}
*/

if (!is_writable($projectMainDir . DS . 'src')) {
    $canIUpdate = false;
    $canIUpdateMessages[] = 'The src folder must be writable.';
}

if (!is_writable($projectMainDir . DS . 'userfiles')) {
    $canIUpdate = false;
    $canIUpdateMessages[] = 'The userfiles folder must be writable.';
}

if (!is_writable($projectMainDir . DS . 'storage')) {
    $canIUpdate = false;
    $canIUpdateMessages[] = 'The storage folder must be writable.';
}

if (!is_writable($projectMainDir . DS . 'vendor')) {
    $canIUpdate = false;
    $canIUpdateMessages[] = 'The vendor folder must be writable.';
}

if (function_exists('disk_free_space')) {
    $bytes = disk_free_space($projectMainDir);
    $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
    $base = 1024;
    $class = min((int)log($bytes, $base), count($si_prefix) - 1);

    if (($bytes / pow($base, $class)) < 1) {
        $canIUpdate = false;
        $canIUpdateMessages[] = 'The minimum required free disk space is 1GB, you have ' . sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . ' on your server.';
    }
}

$isUpToDate = false;
if ($latestVersion) {
    if (\Composer\Semver\Comparator::lessThanOrEqualTo($latestVersion, $currentVersion)) {
        $isUpToDate = true;
    }
}


if ($latestPHPVersionNeeded) {
    if (\Composer\Semver\Comparator::greaterThan($latestPHPVersionNeeded, $currentPHPVersion)) {
        $canIUpdate = false;
        $canIUpdateMessages[] = 'You need to update to PHP version ' . $latestPHPVersionNeeded . ', you have ' . $currentPHPVersion . '.';
    }
}
?>

<?php if (isset($params['backend'])): ?>
    <module type="admin/modules/info"/>
<?php endif; ?>

<module type="standalone-updater/delete_temp_standalone"/>

<style>
    .mw-standalone-icons {
        font-size: 50px;
    }
</style>

<div class="card style-1 m-3">
    <div class="card-header">
        <?php $module_info = module_info($params['module']); ?>
        <h5>
            <img src="<?php echo $module_info['icon']; ?>" class="module-icon-svg-fill"/>
            <strong><?php _e($module_info['name']); ?></strong>
        </h5>
    </div>

    <div class="card-body border-0">
        <div class="text-center <?php if ($isUpToDate): ?>card-success<?php else: ?> card-danger <?php endif; ?>">
            <div class="card-body p-5">
                <h4>Easy update your website builder and CMS</h4>
                <small>with Standalone Updater</small>
                <br><br>
                <div class="d-flex justify-content-center ">
                    <p>Your current version is <span class="font-weight-bold"><?php echo $currentVersion; ?></span></p>&nbsp;
                    <p class="mb-0">and the latest version is <span
                            class="font-weight-bold"><?php echo $latestVersion; ?></span></p>

                    <br><br>
                </div>


                <?php if ($canIUpdate) { ?>
                <?php if ($isUpToDate) { ?>
                <br> <br>
                <h1 class="text-success"><i class="mw-standalone-icons mdi mdi-check-circle-outline"></i>
                    <h4><h5 class="text-success font-weight-bold"> You are up to date!</h5></h4>
                    <?php
                    } else { ?>
                        <br> <br>
                        <h1 class="text-danger"><i class="mw-standalone-icons mdi mdi-close-circle-outline"></i></h1>
                        <h5 class="text-danger font-weight-bold"> You're not up to date!</h5><br/>
                    <?php } ?>
                    <br><br>

                    <form method="post" action="<?php echo route('api.standalone-updater.update-now'); ?>">
                        <div class="d-flex justify-content-center">
                            <div class="form-group mb-0 mr-4">
                                <div class="input-group align-items-center">
                                    <label> Version:</label>&nbsp;
                                    <select name="version" class="form-control js-standalone-updater-select-version">
                                        <option value="latest">Latest stable</option>
                                        <option value="dev">Latest Developer (unstable)</option>
                                    </select>
                                </div>
                            </div>

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('.js-standalone-updater-select-version').change(function () {
                                        if ($(this).val() == 'dev') {
                                            $('.js-standalone-updater-update-button').html('Update');
                                        } else {
                                            $('.js-standalone-updater-update-button').html('Reinstall');
                                        }
                                    });
                                });
                            </script>

                            <?php if ($isUpToDate) { ?>
                                <button method="submit" class="btn btn-success js-standalone-updater-update-button">
                                    Reinstall
                                </button>
                                <?php
                            } else {
                                ?>
                                <button method="submit" class="btn btn-success js-standalone-updater-update-button">
                                    Update now!
                                </button>
                                <?php
                            }
                            ?>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                mw.options.form('.js-standalone-updater-settings', function () {
                                    mw.clear_cache();
                                    mw.notification.success("<?php _ejs("All changes are saved"); ?>.");
                                });
                            });
                        </script>


                        <div class="mb-0 mt-4 mr-4 js-standalone-updater-settings">
                            <a href="#"
                               onClick="$('.js-advanced-settings').toggle();"><?php echo _e('Advanced settings'); ?></a>
                            <div class="js-advanced-settings" style="display:none">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group mb-0 mr-4">
                                        <div class="input-group align-items-center">
                                            <label>  <?php echo _e('Max receive speed download (per second)'); ?></label>
                                            <select name="max_receive_speed_download"
                                                    class="ml-4 form-control mw_option_field"
                                                    option-group="standalone_updater">
                                                <option
                                                    value="0" <?php if (get_option('max_receive_speed_download', 'standalone_updater') == '0'): ?> selected="selected" <?php endif; ?>>
                                                    Unlimited
                                                </option>
                                                <option
                                                    value="5" <?php if (get_option('max_receive_speed_download', 'standalone_updater') == '5'): ?> selected="selected" <?php endif; ?>>
                                                    5MB/s
                                                </option>
                                                <option
                                                    value="2" <?php if (get_option('max_receive_speed_download', 'standalone_updater') == '2'): ?> selected="selected" <?php endif; ?>>
                                                    2MB/s
                                                </option>
                                                <option
                                                    value="1" <?php if (get_option('max_receive_speed_download', 'standalone_updater') == '1'): ?> selected="selected" <?php endif; ?>>
                                                    1MB/s
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="form-group mb-0 mr-4 mt-2">
                                        <div class="input-group align-items-center">
                                            <label>  <?php echo _e('Download method'); ?></label>
                                            <select name="download_method" class="ml-4 form-control mw_option_field"
                                                    option-group="standalone_updater">
                                                <option
                                                    value="curl" <?php if (get_option('download_method', 'standalone_updater') == 'curl'): ?> selected="selected" <?php endif; ?>>
                                                    CURL
                                                </option>
                                                <option
                                                    value="file_get_contents" <?php if (get_option('download_method', 'standalone_updater') == 'file_get_contents'): ?> selected="selected" <?php endif; ?>>
                                                    File Get Contents
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    } else {
                        ?>
                        <br> <br>
                        <h1 class="text-danger"><i class="mw-standalone-icons mdi mdi-close-circle-outline"></i></h1>
                        <h5 class="text-danger font-weight-bold">The standalone update can't be run on this server
                            because:</h5>
                        <ol>
                            <?php
                            foreach ($canIUpdateMessages as $message):
                                ?>
                                <li style="font-weight: bold"><?php echo $message; ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ol>
                        <br/>
                        <?php
                    }
                    ?>

            </div>
        </div>
    </div>
</div>
