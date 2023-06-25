import React from "react";

// Option 1: pass props and use props.title
// Or use object (props!) deconstructing when passing the params
export default function MovieDetails({ title, description, youtubeKey }) {
  return (
    <div className="movie-details">
      <div className="youtube-video">
        {youtubeKey ? (
          <iframe
            src={`https://www.youtube.com/embed/${youtubeKey}`}
            title={`Trailer ${title}`}
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
          ></iframe>
        ) : (
          <p>Sorry, there is no video for this movie available.</p>
        )}
      </div>
      <div className="movie-description">
        <h2>{title}</h2>
        <p>{description}</p>
      </div>
    </div>
  );
}
