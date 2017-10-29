<?

namespace Evolaze\Paiod\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Evolaze\Paiod\AppBundle\Cache\Provider\PkeyvalueProvider;

class DefaultController extends Controller
{
    /**
     * @var PkeyvalueProvider
     */
    private $cacheProvider;

    public function __construct(PkeyvalueProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('default/homepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'timestamp' => $this->cacheProvider->touch("timestamp", microtime(true)),
        ]);
    }

//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     *
//     * @Route("/admin", name="admin")
//     */
//    public function adminAction()
//    {
//        return $this->render('default/admin.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
//    }
//
//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     *
//     * @Route("/morozov", name="morozov")
//     */
//    public function morozovAction()
//    {
//        return $this->render('default/morozov.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
//    }
//
//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     *
//     * @Route("/view", name="view")
//     */
//    public function voteForViewAction()
//    {
//        $object = new \stdClass;
//        $object->username = 'foo';
//        $this->denyAccessUnlessGranted('view', $object);
//
//        return $this->render('default/morozov.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
//    }
//
//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     *
//     * @Route("/edit", name="edit")
//     */
//    public function voteForEditAction()
//    {
//        $object = new \stdClass;
//        $object->username = 'bar';
//        $this->denyAccessUnlessGranted('edit', $object);
//
//        return $this->render('default/morozov.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
//    }
//
//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     *
//     * @Route("/delete", name="delete")
//     */
//    public function voteForDeleteAction()
//    {
//        $object = new \stdClass;
//        $object->username = 'bar';
//        $this->denyAccessUnlessGranted('delete', $object);
//
//        return $this->render('default/morozov.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
//    }
}
