<?

namespace Evolaze\Paiod\AppBundle\Provider;

use Doctrine\ORM\EntityManager;
use Evolaze\Paiod\AppBundle\Cache\Provider\KeyvalueProvider;
use Evolaze\Paiod\AppBundle\Entity\Orm\Uzer as User;

class UserProvider
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var KeyvalueProvider
     */
    private $cacheProvider;

    public function __construct(
        EntityManager $entityManager,
        KeyvalueProvider $cacheProvider
    ) {
        $this->entityManager = $entityManager;
        $this->cacheProvider = $cacheProvider;
    }

    public function findAll(): array {
        $find = function () {
            return $this->entityManager
                ->getRepository(User::class)
                ->findAll();
        };
        $serialize = function (array $array) {
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

        return $this->cacheProvider
            ->getOrRefresh('users', $find, $serialize, $unserialize);
    }
}
