import axios from "axios";

const initialState = {
  codeId: null,
  loading: false,
  error: false,
  data: {},
};

const reducer = (state = initialState, { type, payload }) => {
  switch (type) {
    case "FETCH_CODE_START":
      return { ...state, error: false, loading: true, codeId: payload };
    case "FETCH_CODE_SUCCESS":
      return { ...state, error: false, loading: false, data: payload };
    case "FETCH_CODE_FAIL":
      return { ...state, error: true, loading: false };
    default:
      return { ...state };
  }
};

export const getCode = (id) => (dispatch, getState) => {
  dispatch({
    type: "FETCH_CODE_START",
    payload: id,
  });
  axios(`./../api/btwcode/${getState().codeState.codeId}`)
    .then((responseObj) => {
      console.log(responseObj.data.data[0]);
      dispatch({
        type: "FETCH_CODE_SUCCESS",
        payload: responseObj.data.data[0],
      });
    })
    .catch((error) => {
      console.log(error);
      dispatch({
        type: "FETCH_CODE_FAIL",
      });
    });
};

export const putCode = (code, land, id) => (dispatch, getState) => {
  axios
    .put(`./../api/btwcode/${getState().codeState.codeId}`, {
      code: code,
      land: land,
    })
    .then((responseObj) => {
      console.log(responseObj);
      dispatch(getCode(id));
    })
    .catch((error) => console.log(error));
};

export const deleteCode = (id) => (dispatch, getState) => {
  axios.delete(`./../api/btwcode/${getState().codeState.codeId}`).then(responseObj => console.log(responseObj));
};

export default reducer;
