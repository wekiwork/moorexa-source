<?php
namespace Classes\Platforms\Launchers;

use Lightroom\Core\{
    Payload, BootCoreEngine
};
use Classes\Platforms\PlatformInterface;
/**
 * @package Web Launcher
 * @author Amadi Ifeamyi <amadiify.com>
 */
class Web implements PlatformInterface
{
    use Helper;
    
    /**
     * @method PlatformInterface loadPlatform
     * @param Payload $payload
     * @param BootCoreEngine $engine
     * @return bool
     */
    public function loadPlatform(Payload &$payload, BootCoreEngine $engine) : bool
    {
        // set content type
        $engine->setContentType($this->loadContentType('web'));

        // headers found
        $engine->defaultPackageManager($payload, \Lightroom\Packager\Moorexa\MoorexaWebPackager::class);

        // return bool
        return true;
    }
}