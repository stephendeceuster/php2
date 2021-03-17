import store from "../redux/store";
import slugify from "slugify";
import { getCodes, deleteCodes, postCodes } from "./../redux/codes";

class Codes {
  constructor(holder, router) {
    this._holder = holder;
    this._router = router;
    this._tableRef = null;
    this._tbodyRef = null;
    this._loadingRef = null;
    this._errorRef = null;
    this._formRef = null;
    this._formInputCode = null;
    this._formInputLand = null;
    this.init();
    store.dispatch(getCodes());
    this.render();
    this.events();
    store.subscribe(this.render.bind(this));
  }
  init = () => {
    this._holder.innerHTML = `
        <div class="container">
            <h2>BTW codes</h2>
            <div class="table-container">
            <form class="col s12 code-form">
                <div class="row" >
                    <div class="input-field col s2">
                        <input id="eub_code" type="text" class="validate">
                        <label for="eub_code" class="active">Code</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="eub_land" type="text" class="validate">
                        <label for="eub_land" class="active">Land</label>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Verzend
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                
            </form>
            <hr>
            <table class='codes-table striped'>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Land</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="tbody-container">

                </tbody>
            </table>
            </div>
            <div class="loading">Loading...</div>
            <div class="error">Error</div>
        </div>
            `;
    this._tableRef = this._holder.querySelector(".table-container");
    this._tbodyRef = this._holder.querySelector(".tbody-container");
    this._loadingRef = this._holder.querySelector(".loading");
    this._errorRef = this._holder.querySelector(".error");
    this._formRef = this._holder.querySelector(".code-form");
    this._formInputCode = this._formRef.querySelector("#eub_code");
    this._formInputLand = this._formRef.querySelector("#eub_land");
  };

  render = () => {
    const { error, loading, codes } = store.getState().codesState;
    loading
      ? (this._loadingRef.style.display = "block")
      : (this._loadingRef.style.display = "none");
    error
      ? (this._errorRef.style.display = "block")
      : (this._errorRef.style.display = "none");
    if (codes) {
      this._tableRef.style.display = "block";

      this._tbodyRef.innerHTML = codes
        .map(
          ({ eub_id, eub_land, eub_code }) =>
            `<tr data-id="${eub_id}" data-land="${eub_land}" data-code="${eub_code}">
            <td>${eub_code}</td>
            <td>${eub_land}</td>
            <td><a data-navigo href="./code/${eub_id}/${slugify(eub_land, {
              lower: true,
            })}">🖊</a></td>
            <td class="lets-delete"><span>🗑</span></td>
            </tr>`
        )
        .join("");
      this._router.updatePageLinks();
    }
  };

  events = () => {
    this._formRef.addEventListener("submit", (e) => {
      e.preventDefault();
      store.dispatch(
        postCodes(this._formInputCode.value, this._formInputLand.value)
      );
      this._formInputCode.value = "";
      this._formInputLand.value = "";
    });
    this._tbodyRef.addEventListener("click", (e) => {
      if (e.target.classList.contains("lets-delete")) {
        const youSure = confirm(
          `We gaan nu ${e.target.parentElement.dataset.land} wissen?`
        );
        if (youSure) {
          store.dispatch(deleteCodes(e.target.parentElement.dataset.id));
        }
      }
    });
  };
}

export default (holder, router) => new Codes(holder, router);
