import store from '../redux/store';
import slugify from 'slugify';
import { setCode } from './../redux/codes';

class Codes {
    constructor(holder, router) {
        this._holder = holder;
        this._router = router;
        this._tableRef = null;
        this._loadingRed = null;
        this.init();
        //this.events();
        //this.render();
        //store.subscribe(this.render.bind(this));
    }
    init() {
        this._holder.innerHTML = `
            <h1>BTW codes</h1>
            <table class='codes-table striped'>
                <thead>
                    <tr>
                        <th>Land</th>
                        <th>Code</th>
                        <th>Detail</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            `;
    }
}

export default ( holder, router ) => new Codes( holder, router );