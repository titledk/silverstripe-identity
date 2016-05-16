<?php

/**
 * TaskSnippet
 * Run like this:
 * php public/framework/cli-script.php /dev/tasks/IdentityToScss
 *
 */
class IdentityToScss extends BuildTask
{
    public $description = 'Syncing identity defined in yml to scss file';

    /**
     * @param SS_HTTPRequest $request
     */
    public function run($request)
    {
        $colors = Identity::get_colors();
        $str = '';
        foreach ($colors as $name => $c) {
            $str .= '$identity-color-' . $name . ': ' . $c . ';' . "\n";
        }
        $base = str_replace('/public', '', Director::baseFolder());
        $file = "$base/resources/sass/_identity_synced.scss";
        file_put_contents($file,$str);
    }
}
