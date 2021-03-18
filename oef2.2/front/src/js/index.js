
import Navigo from "navigo";

import codes from "./components/Codes";
import code from "./components/Code";



 const router = new Navigo("/php2/oef2.2/front/", { strategy: "ONE" });


 const mainRef = document.querySelector(".main");

 router
  .on("/codes", () => {
    console.log('option 1');
    codes(mainRef, router);
  })
  .on("/code/:id/:label", ({data: {id}}) => {
    console.log('id here');
    code(mainRef, id, router);
  })
  .on("/*", () => {
    console.log('option 3');
    codes(mainRef, router);
  })  
  .resolve();
