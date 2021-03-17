//import "./style.css";

import Navigo from "navigo";

import codes from "./components/Codes";
import code from "./components/Code";
// import person from "./components/Person";
// import counter from "./components/Counter";
// import klasvrienden from "./components/KlasVrienden";
// import movie from "./components/Movie";
// import header from "./components/Header";
// import todos from "./components/Todos";



 const router = new Navigo("/", { strategy: "ALL" });


 const mainRef = document.querySelector(".main");

 router
  .on("/php2/oef2.2/front/codes", () => {
    codes(mainRef, router);
  })
  .on("/php2/oef2.2/front/code/:id/*", ({data: {id}}) => {
    code(mainRef, id, router);
  })
  .on("/*", () => {
    codes(mainRef, router);
  })  
  .resolve();
