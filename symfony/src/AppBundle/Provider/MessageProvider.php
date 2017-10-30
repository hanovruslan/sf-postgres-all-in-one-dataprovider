<?

namespace Evolaze\Paiod\AppBundle\Provider;

use Doctrine\ORM\EntityManager;
use Evolaze\Paiod\AppBundle\Entity\Odm\Message;

class MessageProvider
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): array
    {
        return $this->entityManager
            ->getRepository(Message::class)
            ->findAll();
    }
}