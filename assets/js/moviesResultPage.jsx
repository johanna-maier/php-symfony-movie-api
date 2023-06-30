import React from "react";
import ReactDOM from "react-dom";
import MoviesResultList from "./MoviesResultList.jsx";

const resultPage = document.getElementById("movies-search-results");
const movieResults = JSON.parse(resultPage.dataset.movieDetails);

const titles = {};
for (const result of movieResults.results) {
  titles[result["id"]] = result["title"];
}

export default function MoviesResultPage() {
  return <MoviesResultList titles={titles} />;
}

ReactDOM.render(<MoviesResultPage />, resultPage);
