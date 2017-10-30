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

    /**
     * @param String $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function touch(String $key, $value)
    {
        $this->adapter->save(
            $this->adapter->getItem($key)->set($value)
        );

        return $this->get($key);
    }

    /**
     * @param String $key
     * @return mixed
     */
    public function get(String $key)
    {
        return $this->adapter->getItem($key)->get();
    }
}