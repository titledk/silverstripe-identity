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
        echo 'Syncing identities to sass file:';
        $colors = Identity::get_colors();
        $str = '';
        echo '<ul>';
        foreach ($colors as $name => $c) {
            $str .= '$identity-color-' . $name . ': ' . $c . ';' . "\n";
            echo "<li><em>$name:</em> <strong>$c</strong></li>";
        }
        echo '</ul>';
        echo 'Sync done.';
        $base = str_replace('/public', '', Director::baseFolder());
        //TODO this one should be configurable
        $file = "$base/resources/sass/_identity_synced.scss";
        file_put_contents($file,$str);
    }
}
