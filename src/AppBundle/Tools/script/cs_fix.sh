#!/bin/bash
#   staged only with status       blacklist                                    only php      remove deleted files   remove status              running cs-fix-dry-run
git diff --staged --name-status | grep -v Tools/InstallCsFixer.php |  grep \.php$ | grep -v ^D           | grep -P -o '\K([^\s]+)$' | xargs -I{} -t -P4 bash -c "vendor/bin/php-cs-fixer -vvv fix --dry-run"