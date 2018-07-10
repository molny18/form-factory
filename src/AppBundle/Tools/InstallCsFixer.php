<?php

namespace AppBundle\Tools;

use Composer\IO\IOInterface;
use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class InstallCsFixer
{
    /**
     * @var Filesystem
     */
    private static $fs;

    public static function postUpdate(Event $event)
    {
        $io = $event->getIO();
        $io->write('Installing cs-fixer pre-commit hook');

        $baseDir = $event->getComposer()->getConfig()->get('vendor-dir').'/../';

        $hookContent = static::getHookContent(__DIR__.'/script/cs_fix.sh', ['{projectPath}' => $baseDir]);

        // megcsinaljuk a projectre
        static::installHook($baseDir, $hookContent, $io);

    }

    private static function installHook($baseDir, $hookContent, IOInterface $io)
    {
        $fs = static::getFs();

        $baseDir = rtrim($baseDir, '/').'/';
        $gitDir = $baseDir.'.git/';
        $hookTarget = $gitDir.'hooks'.DIRECTORY_SEPARATOR.'pre-commit';

        // van e egyaltalan .git
        if (!$fs->exists($gitDir)) {
            return;
        }

        // beirjuk a hookot
        $io->write(sprintf('Writing hook: "%s"', $hookTarget));
        $fs->dumpFile($hookTarget, strtr($hookContent, ['{repoPath}' => $baseDir]), 0755);
    }

    private static function getFs()
    {
        if (null === static::$fs) {
            static::$fs = new Filesystem();
        }

        return static::$fs;
    }

    private static function getHookContent($hook, array $variables)
    {
        return strtr(file_get_contents($hook), $variables);
    }
}
