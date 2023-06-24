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

// Now returning h1 element as a component.
function Header() {
  return <h1>Movie DB Case 🚀</h1>;
}

// Option 1: pass props and use props.title
// Or use object (props!) deconstructing when passing the params
function MovieDetails({ title, description }) {
  return (
    <div>
      <title>{title}</title>
      <p>{description}</p>

      {youtubeKey ? (
        <embed
          width="420"
          height="315"
          src={`https://www.youtube.com/embed/${youtubeKey}`}
        />
      ) : (
        <p>Sorry, there is no video for this movie available.</p>
      )}
    </div>
  );
}

function MoviesDetailPage() {
  return (
    <div>
      <Header />
      <MovieDetails title={title} description={description} />
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
