import React from "react";

// Option 1: pass props and use props.title
// Or use object (props!) deconstructing when passing the params
export default function MovieDetails({ title, description, youtubeKey }) {
  return (
    <div className="movie-card">
      <div className="youtube-video">
        {youtubeKey ? (
          <embed src={`https://www.youtube.com/embed/${youtubeKey}`} />
        ) : (
          <p>Sorry, there is no video for this movie available.</p>
        )}
      </div>
      <div>
        <h2>{title}</h2>
        <p>{description}</p>
      </div>
    </div>
  );
}
