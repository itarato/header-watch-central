<?php

namespace AppBundle\Controller;

use AppBundle\Document\Location;
use AppBundle\Document\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

  /**
   * @Route("/", name="homepage")
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function indexAction(Request $request) {
    // replace this example code with whatever you need
    return $this->render('default/index.html.twig', array(
      'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
    ));
  }

  /**
   * @Route("/location/add", name="location_create")
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return mixed
   */
  public function createLocationAction(Request $request) {
    $location = new Location();

    /** @var User $user */
    $user = $this->getUser();
    $location->setUserId($user->getId());

    $formBuilder = $this->createFormBuilder($location);
    $formBuilder->add('path', 'text', ['label' => 'URL']);
    $formBuilder->add('save', 'submit', ['label' => 'Save']);
    $form = $formBuilder->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
      // Add record.
      $om = $this->get('doctrine_mongodb')->getManager();
      $om->persist($location);
      $om->flush();
    }

    return $this->render('default/create_location.html.twig', ['form' => $form->createView()]);
  }

  /**
   * @Route("/location/list", name="location_list")
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function listAction(Request $request) {
    /** @var User $user */
    $user = $this->getUser();
    $repo = $this->get('doctrine_mongodb')->getRepository('AppBundle:Location');
    $userLocations = $repo->findBy(['user_id' => $user->getId()]);

    return $this->render('default/list_location.html.twig', ['locations' => $userLocations]);
  }

}
