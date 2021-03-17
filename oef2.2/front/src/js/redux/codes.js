import axios from "axios";

const initialState = {
    codes: [],
    loading: false,
    error: false 
}

const reducer = (state = initialState, {type, payload}) => {
    return state
}

export default reducer;