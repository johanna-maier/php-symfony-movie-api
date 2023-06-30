<?php

declare(strict_types=1);

namespace App\Helper;


use Symfony\Contracts\HttpClient\HttpClientInterface;


class MoviesHelper
{
  private HttpClientInterface $client;
  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }

  /**
   * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
   * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
   * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
   * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
   * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
   */

  public function getMoviesApi($query): array
  {
    $apiKey = $_ENV['MOVIE_API'];
    $url = 'https://api.themoviedb.org/3/search/movie?query=' . $query . '&api_key=' . $apiKey;

    $response = $this->client->request('GET', $url);
    $parsedResponse = $response->toArray();
    // $movies = $parsedResponse;

    // $titles = array();

    // foreach ($movies['results'] as $movie) {
    //   $titles[$movie['id']] = $movie['title'];
    // }

    return $parsedResponse;
  }

  public function getMovieDetailsApi($id): array
  {
    $apiKey = $_ENV['MOVIE_API'];
    $url = 'https://api.themoviedb.org/3/movie/' . $id . '?&append_to_response=videos&api_key=' . $apiKey;

    $response = $this->client->request('GET', $url);
    $parsedResponse = $response->toArray();


    return $parsedResponse;
  }
}
