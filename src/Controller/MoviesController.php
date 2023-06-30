<?php

declare(strict_types=1);

namespace App\Controller;

use App\Helper\MoviesHelper;

use App\Form\MovieSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class MoviesController extends AbstractController
{
  private MoviesHelper $moviesHelper;

  public function __construct(MoviesHelper $moviesHelper)
  {
    $this->moviesHelper = $moviesHelper;
  }


  #[Route('/movies-search', name: 'movies-search')]
  public function index()
  {
    return $this->render('index.html.twig');
  }

  #[Route('/movies-search/{query}', name: 'movies-query')]
  public function query($query): Response
  {

    $response = $this->moviesHelper->getMoviesApi($query);
    // Return JSON response instead of template
    // Call react instead to render it

    return $this->render('search-result.html.twig', array(
      'query' => $query,
      'movieJson' => $response
    ));
  }



  #[Route('/movies/{id}', name: 'movie-details')]
  public function details($id): Response
  {
    $response = $this->moviesHelper->getMovieDetailsApi($id);

    // $curl = curl_init();
    // curl_setopt_array($curl, [
    //   CURLOPT_URL => $url,
    //   CURLOPT_CUSTOMREQUEST => 'GET',
    //   CURLOPT_RETURNTRANSFER => true,
    // ]);

    // $rawResponse = curl_exec($curl);
    // $info = curl_getinfo($curl);
    // curl_close($curl);

    // if ($info['http_code'] === 200) {
    //   $response = json_decode($rawResponse, true);
    //   $movieDetails = $response;

    //   $details = array();

    //   $details['id'] = $movieDetails['id'];
    //   $details['title'] = $movieDetails['original_title'];
    //   $details['description'] = $movieDetails['overview'];

    //   if (isset($movieDetails['videos'])) {
    //     $videoArray = $movieDetails['videos']['results'];
    //     if (!empty($videoArray)) {
    //       $details['videoKey'] = $videoArray[0]['key'];
    //     }
    //   }
    // }

    return $this->render('movie-details.html.twig', [
      'movieJson' => $response
    ]);
  }


  // #[Route('/movies/{name}', name: 'movies', defaults: ['name' => null], methods:['GET', 'HEAD'])]
  // public function index($name): JsonResponse
  // {
  //     return $this->json([
  //         'message' => $name,
  //         'path' => 'src/Controller/MoviesController.php',
  //     ]);
  // }

  // /**
  //  * oldMethod
  //  *
  //  * @Route("/old", name="old")
  //  */
  // public function oldMethod(): Response
  // {
  //     return $this->json([
  //         'message' => 'Old method!',
  //         'path' => 'src/Controller/MoviesController.php',
  //     ]);
  // }
}
