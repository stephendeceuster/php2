import store from '../redux/store';
import { getCode } from '../redux/code.js'

class Code {
    constructor(holder, id, router) {
        this._holder = holder;
        this._codeId = id;
        this._router = router;
        this._dataRef = null;
        this._formRef = null;
        this._formInputCode = null;
        this._formInputLand = null;
        this._loadingRef = null;
        this._errorRef = null;
        store.dispatch(getCode(id));
        this.init(); 
        this.render();
        this.events(); 
        store.subscribe(this.render.bind(this));
    }

    init = () => {
        this._holder.innerHTML = `
            <h2>BTW code detail</h2>
            <p class="loading">Loading...</p>
            <p class="error">Error</p>
            <p class="code-data"></p>
            <form class="col s12 code-form"></form>
            <p><a href="/php2/oef2.2/front/" data-navigo>Ga terug naar overzicht</a></p>
            
        `;
        this._router.updatePageLinks();
        this._dataRef = this._holder.querySelector('.code-data');
        this._formRef = this._holder.querySelector('.code-form');
        this._loadingRef = this._holder.querySelector('.loading');
        this._errorRef = this._holder.querySelector('.error');
    }

    events = () => {
        this._formRef.addEventListener('submit', (e) => {
            e.preventDefault();
            store.dispatch(putCode(this._formInputCode.value, this._formInputLand.value));
        });
    }

    render = () => {
        const {error, loading, data:{eub_id, eub_land, eub_code}} = store.getState().codeState;
        if (loading) {
            this._loadingRef.style.display = "block";
        } else {
            this._loadingRef.style.display = "none";
        }
        if (error) {
            this._errorRef.style.display = "block";
        } else {
            this._errorRef.style.display = "none";
        }
        if (eub_land) {
            this._dataRef.innerHTML = `
                ${eub_id} - ${eub_land} - ${eub_code}
            `;
            this._formRef.innerHTML = `
                <div class="row">
                    <div class="input-field col s3">
                        <input id="eub_code" type="text" class="validate" value="${eub_code}">
                        <label for="eub_code" class="active">Code</label>
                    </div>
                    <div class="input-field col s9">
                        <input id="eub_land" type="text" class="validate" value="${eub_land}">
                        <label for="eub_land" class="active">Land</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Verzend
                    <i class="material-icons right">send</i>
                </button>
            `;
            this._formInputCode = this._formRef.querySelector('#eub_code');
            this._formInputLand = this._formRef.querySelector('#eub_land');
        }
    }
}

export default ( holder, id, router ) => new Code( holder, id, router );