import React from "react";

// Now returning h1 element as a component.
export default function Header({ title, description }) {
  return (
    <div>
      <h1 className="title"> {title}</h1>
      <p>{description}</p>
    </div>
  );
}
