<?php

declare(strict_types=1);

namespace App\Helper;

class MoviesHelper
{
  public function getMoviesApi($query): array
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

    return $titles;
  }
}
