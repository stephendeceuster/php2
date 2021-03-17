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
   .on("/*", () => {
     //console.log('test');
     code(mainRef, 2, router);
   })
  .on("/test", () => {
    mainRef.innerHTML = '<h2>TEST</h2>';
  })
  .on("/codes", () => {
    codes(mainRef, router);
  })
  .on("/code/:id/", ({data: {id}}) => {
    code(mainRef, id, router);
  })  
  .resolve();
