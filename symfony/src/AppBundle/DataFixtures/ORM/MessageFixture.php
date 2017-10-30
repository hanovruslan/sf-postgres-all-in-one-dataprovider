<?

namespace Evolaze\Paiod\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Evolaze\Paiod\AppBundle\Entity\Odm\Message;
use Evolaze\Paiod\AppBundle\Entity\Odm\MessageBody;

class MessageFixture implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach (['foo', 'bar'] as $value) {
            $messageBody = new MessageBody();
            $messageBody->title = $value;
            $messageBody->text = md5($value);
            $messageBody->createdAt = time();
            $message = new Message();
            $message->setBody($messageBody);
            $manager->persist($message);
        }
        $manager->flush();
    }
}