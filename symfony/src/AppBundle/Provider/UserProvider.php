<?

namespace Evolaze\Paiod\AppBundle\Provider;

use Evolaze\Paiod\AppBundle\Cache\Provider\PkeyvalueProvider;
use Doctrine\ORM\EntityManager;
use Evolaze\Paiod\AppBundle\Entity\Uzer as User;

class UserProvider
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var PkeyvalueProvider
     */
    private $cacheProvider;

    public function __construct(
        EntityManager $entityManager,
        PkeyvalueProvider $cacheProvider
    ) {
        $this->entityManager = $entityManager;
        $this->cacheProvider = $cacheProvider;
    }

    public function findAll(): array {
        $getter = function () {
            return $this->entityManager->getRepository(User::class)->findAll();
        };
        $serializer = function (array $array) {
            $result = [];
            foreach ($array as $item) {
                $result[] = serialize($item);
            }

            return $result;
        };
        $unserialize = function (array $array) {
            $result = [];
            foreach ($array as $item) {
                $result[] = unserialize($item);
            }

            return $result;
        };

        return $this->cacheProvider->getOrRefresh('users', $getter, $serializer, $unserialize);
    }
}
