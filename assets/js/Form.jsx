// https://codesandbox.io/s/netflix-like-search-v7iee?file=/SearchBar.js
// https://stackoverflow.com/questions/57483582/how-to-update-the-url-of-a-page-using-an-input-field

import React, { useState } from "react";

export default function Form() {
  const [text, setText] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    if (text.trim() !== "") {
      const url = `https://localhost:8000/movies-search/${encodeURIComponent(
        text
      )}`;
      window.location.href = url;
    }
  };

  const handleChange = (e) => {
    setText(e.target.value);
  };

  return (
    <div>
      <h1 className="form-container">The Movie DB at your fingertips! 🔍</h1>
      <form className="form-container" onSubmit={handleSubmit}>
        <input type="text" value={text} onChange={handleChange} />
        <button type="submit">Search movie!</button>
      </form>
    </div>
  );
}
