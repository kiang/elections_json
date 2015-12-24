<?php

$path = __DIR__;

$now = date('Y-m-d H:i:s');
$count = $size = 0;
// 50MB = 52428800
foreach (glob($path . '/media/*/*/*/*/*.*') AS $imgFile) {
    system("/usr/bin/git add {$imgFile}");
    $size += filesize($imgFile);
    if ($size >= 52428800) {
        ++$count;
        system("cd {$path} && /usr/bin/git commit --author 'auto commit <noreply@localhost>' -m 'media commit - {$count} @ {$now}'");
        system("cd {$path} && /usr/bin/git push origin master");
        $size = 0;
    }
}
if ($size > 0) {
    ++$count;
    system("cd {$path} && /usr/bin/git commit --author 'auto commit <noreply@localhost>' -m 'media commit - {$count} @ {$now}'");
    system("cd {$path} && /usr/bin/git push origin master");
}
