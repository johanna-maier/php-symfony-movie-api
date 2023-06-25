import ReactDOM from "react-dom";
import React from "react";
import Header from "./Header";
import MovieDetails from "./MovieDetails";

// Select the div element with 'app' id
const app = document.getElementById("app");
const movieDetails = JSON.parse(app.dataset.movieDetails);
const title = movieDetails.original_title;
const description = movieDetails.overview;
let youtubeKey;
if (movieDetails.videos.results[0] === undefined) {
  youtubeKey = null;
} else {
  youtubeKey = movieDetails.videos.results[0].key;
}

export default function MoviesDetailPage() {
  return (
    <div className="page-container">
      <Header />
      <MovieDetails
        title={title}
        description={description}
        youtubeKey={youtubeKey}
      />
    </div>
  );
}

ReactDOM.render(<MoviesDetailPage />, app);

// https://symfonycasts.com/screencast/reactjs/server-pass-props

// Use React instead of direct manipulation with JS code below
// ReactDOM.render(<h1>Develop. Preview. Ship. 🚀</h1>, app);

// // Create a new H1 element
// const header = document.createElement("h1");

// // Create a new text node for the H1 element
// const headerContent = document.createTextNode("Develop. Preview. Ship. 🚀");

// // Append the text to the H1 element
// header.appendChild(headerContent);

// // Place the H1 element inside the div
// app.appendChild(header);
