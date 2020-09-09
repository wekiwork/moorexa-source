<?php
namespace Classes\Platforms;

use Lightroom\Core\{
    Payload, BootCoreEngine
};
use Lightroom\Router\RouterHandler;
use Lightroom\Adapter\ClassManager;
use Lightroom\Common\Interfaces\PackageManagerInterface;
use Lightroom\Packager\Moorexa\Configuration\DefaultPackagerConfiguration;
/**
 * @package Platform Launcher
 * @author Amadi Ifeanyi <amadiify.com>
 * 
 * Payload manager for multiple platforms. Simply intresting... 
 */
class Launcher implements PackageManagerInterface
{
    /**
     * @var Payload $payload
     */
    private $payload;

    /**
     * @var BootCoreEngine $engine
     */
    private $engine;

    /**
     * @var bool $platformLoaded
     */
    private $platformLoaded = false;

    /**
     * @method Launcher registerPayload for multiple platforms using headers
     * @param Payload $payload
     * @param BootCoreEngine $engine
     * @throws ClassNotFound
     */
    public function registerPayload(Payload &$payload, BootCoreEngine $engine)
    {
        // register payload 
        $this->payload =& $payload;

        // register engine
        $this->engine =& $engine;

        // use development server
        $this->loadDevelopmentServer();

        // load api platform
        $this->loadPlatform('ApiPlatform');

        // load cli platform
        // $this->loadPlatform('CliPlatform');

        // load web platform
        $this->loadPlatform('WebPlatform');
    }

    /**
     * @method Launcher ApiPlatform
     * @return bool
     */
    private function ApiPlatform() : bool
    {
        // load instance
        $instance = ClassManager::singleton(Launchers\Api::class);
        
        // load platform
        return $instance->loadPlatform($this->payload, $this->engine);
    }

    /**
     * @method Launcher WebPlatform
     * @return bool
     */
    private function WebPlatform() : bool
    {
        // load instance
        $instance = ClassManager::singleton(Launchers\Web::class);
        
        // load platform
        return $instance->loadPlatform($this->payload, $this->engine);
    }

    /**
     * @method Launcher CliPlatform
     * @return bool
     */
    private function CliPlatform() : bool
    {
        // load instance
        $instance = ClassManager::singleton(Launchers\Cli::class);
        
        // load platform
        return $instance->loadPlatform($this->payload, $this->engine);
    }

    /**
     * @method Launcher loadPlatform
     * @param string $platform
     * @return void
     */
    private function loadPlatform(string $platform) : void 
    {
        // platform not loaded
        if ($this->platformLoaded === false) :

            // check if method exists
            if (method_exists($this, $platform)) :

                // load platform
                $this->platformLoaded = call_user_func([$this, $platform]);

            endif;
    
        endif;
    }

    /**
     * @method Launcher loadDevelopmentServer
     * @return void
     */
    private function loadDevelopmentServer() : void
    {
        $server = new class() {

            use DefaultPackagerConfiguration;

            public function __construct()
            {
                self::useDevelopmentServer();
            }
        };

        // clean up
        $server = null;
    }
}