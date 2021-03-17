
import Navigo from "navigo";

import codes from "./components/Codes";
import code from "./components/Code";



 const router = new Navigo("/php2/oef2.2/front", { strategy: "ALL" });


 const mainRef = document.querySelector(".main");

 router
  .on("/codes", () => {
    codes(mainRef, router);
  })
  .on("/code/:id/*", ({data: {id}}) => {
    code(mainRef, id, router);
  })
  .on("/*", () => {
    codes(mainRef, router);
  })  
  .resolve();
