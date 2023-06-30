import React from "react";

export default function MoviesResultList(titles) {
  const movieData = titles.titles;
  const movieList = Object.entries(movieData);
  console.log(movieData);

  return (
    <div>
      <h1 className="list-heading">Your Movie Search Results!</h1>
      <ul className="list">
        {Object.keys(movieData).map((key, index) => {
          return (
            <li key={index}>
              <a className="link" href={`/movies/${key}`}>
                {movieData[key].toString()}
              </a>
            </li>
          );
        })}
      </ul>
    </div>
  );
}
