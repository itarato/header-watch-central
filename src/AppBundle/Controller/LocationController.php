<?php
/**
 * @file
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends Controller {

  /**
   * @Route("/location/{location_id}/results", name="location_results")
   * @param string $location_id
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function locationResultsAction($location_id, Request $request) {
    $locationRepo = $this->get('doctrine_mongodb')->getRepository('AppBundle:Location');
    $location = $locationRepo->find($location_id);

    $resultRepo = $this->get('doctrine_mongodb')->getRepository('AppBundle:CrawlResult');
    $results = $resultRepo->findBy(['location_id' => $location_id]);

    return $this->render('location/results.html.twig', [
      'location' => $location,
      'results' => $results,
    ]);
  }

}
