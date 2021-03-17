import store from "../redux/store";
import slugify from "slugify";
import { getCodes } from "./../redux/codes";
import { deleteCode } from "./../redux/code";

class Codes {
  constructor(holder, router) {
    this._holder = holder;
    this._router = router;
    this._tableRef = null;
    this._tbodyRef = null;
    this._loadingRef = null;
    this._errorRef = null;
    this.init();
    store.dispatch(getCodes());
    //this.events();
    this.render();
    store.subscribe(this.render.bind(this));
  }
  init = () => {
    this._holder.innerHTML = `
        <div class="container">
            <h1>BTW codes</h1>
            <div class="table-container">
            <table class='codes-table striped'>
                <thead>
                    <tr>
                        <th>Land</th>
                        <th>Code</th>
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
            `<tr>
            <td>${eub_land}</td>
            <td>${eub_code}</td>
            <td><a data-navigo href="/php2/oef2.2/front/code/${eub_id}/${slugify(eub_land, {
              lower: true,
            })}">edit</a></td>
            <td><a href="/">delete</a></td>
            </tr>`
        )
        .join("");
      this._router.updatePageLinks();
    }
  };
}

export default (holder, router) => new Codes(holder, router);
