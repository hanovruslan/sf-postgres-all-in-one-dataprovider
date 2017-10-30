<?

namespace Evolaze\Paiod\AppBundle\Controller;

use Evolaze\Paiod\AppBundle\Provider\UserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @var UserProvider
     */
    private $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
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
}
