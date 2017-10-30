<?

namespace Evolaze\Paiod\AppBundle\Controller;

use Evolaze\Paiod\AppBundle\Provider\MessageProvider;
use Evolaze\Paiod\AppBundle\Provider\UserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @var UserProvider
     */
    private $userProvider;

    /**
     * @var MessageProvider
     */
    private $messageProvider;

    public function __construct(
        UserProvider $userProvider,
        MessageProvider $messageProvider
    ) {
        $this->userProvider = $userProvider;
        $this->messageProvider = $messageProvider;
    }

    public function homepageAction()
    {
        return $this->render('default/homepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    public function usersAction()
    {
        return $this->render('default/users.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'users' => $this->userProvider->findAll(),
        ]);
    }

    public function messagesAction()
    {
        return $this->render('default/messages.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'messages' => $this->messageProvider->findAll(),
        ]);
    }
}
