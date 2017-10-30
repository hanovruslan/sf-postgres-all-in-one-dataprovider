<?

namespace Evolaze\Paiod\AppBundle\Cache\Provider;

use Symfony\Component\Cache\Adapter\PdoAdapter;

class PkeyvalueProvider
{
    /**
     * @var PdoAdapter
     */
    private $adapter;

    public function __construct(PdoAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getOrRefresh(String $key, \Closure $getter, \Closure $serialize, \Closure $unserialize)
    {
        $cacheItem = $this->adapter->getItem($key);
        if (!$this->adapter->hasItem($key)) {
            $value = $getter();
            $this->adapter->save(
                $cacheItem->set($serialize($value))
            );
            $result = $value;
        } else {
            $result = $unserialize($cacheItem->get());
        }

        return $result;
    }
}