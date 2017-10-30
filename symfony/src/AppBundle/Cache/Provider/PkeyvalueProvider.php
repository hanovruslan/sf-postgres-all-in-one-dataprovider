<?

namespace Evolaze\Paiod\AppBundle\Cache\Provider;

use Symfony\Component\Cache\Adapter\PdoAdapter;

class KeyvalueProvider
{
    /**
     * @var PdoAdapter
     */
    private $adapter;

    public function __construct(PdoAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getOrRefresh(String $key, \Closure $find, \Closure $serialize, \Closure $unserialize)
    {
        $item = $this->adapter->getItem($key);
        if (!$this->adapter->hasItem($key)) {
            $result = $find();
            $this->adapter->save(
                $item->set($serialize($result))
            );
        } else {
            $result = $unserialize($item->get());
        }

        return $result;
    }
}