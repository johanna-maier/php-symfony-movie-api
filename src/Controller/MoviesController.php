<?php

namespace App\Controller;

use App\Form\MovieSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MoviesController extends AbstractController
{

  #[Route('/movies-search', name: 'movies-search')]
  public function index(Request $request, $search = null)
  {
    $form = $this->createForm(MovieSearchType::class);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $query = $form->get('search')->getData();
      dump($query);
      return $this->redirectToRoute('movies-query', $parameters = [$query], $status = 301);
    }

    return $this->render('index.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/movies-search/{query}', name: 'movies-query')]
  public function query($query): Response
  {
    $apiKey = $_ENV['MOVIE_API'];
    $url = 'https://api.themoviedb.org/3/search/movie?query=' . $query . '&api_key=' . $apiKey;

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => $url,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
    ]);

    $rawResponse = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    if ($info['http_code'] === 200) {
      $response = json_decode($rawResponse, true);
      $movies = $response;

      $titles = array();

      foreach ($movies['results'] as $movie) {
        $titles[$movie['id']] = $movie['title'];
      }
    }

    return $this->render('search-result.html.twig', array(
      'response' => $response,
      'movie' => $movies,
      'query' => $query,
      'url' => $url,
      'titles' => $titles
    ));
  }



  #[Route('/movies/{id}', name: 'movie-details')]
  public function details($id): Response
  {
    $apiKey = $_ENV['MOVIE_API'];
    $url = 'https://api.themoviedb.org/3/movie/' . $id . '?&append_to_response=videos&api_key=' . $apiKey;

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => $url,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true,
    ]);

    $rawResponse = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    if ($info['http_code'] === 200) {
      $response = json_decode($rawResponse, true);
      $movieDetails = $response;

      $details = array();

      $details['id'] = $movieDetails['id'];
      $details['title'] = $movieDetails['original_title'];
      $details['description'] = $movieDetails['overview'];

      if (isset($movieDetails['videos'])) {
        $videoArray = $movieDetails['videos']['results'];
        if (!empty($videoArray)) {
          $details['videoKey'] = $videoArray[0]['key'];
        }
      }
    }

    return $this->render('movie-details.html.twig', [
      'id' => $id,
      'movieDetails' => $details
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