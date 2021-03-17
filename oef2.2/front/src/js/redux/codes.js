import axios from "axios";

const initialState = {
  codes: [],
  loading: false,
  error: false,
};

const reducer = (state = initialState, { type, payload }) => {
  switch (type) {
    case "FETCH_CODES_START":
      return { ...state, error: false, loading: true };
    case "FETCH_CODES_SUCCESS":
      return { ...state, error: false, loading: false, codes: payload };
    case "FETCH_CODES_FAIL":
      return { ...state, error: true, loading: false };
    default:
      return { ...state };
  }
};

export const getCodes = () => (dispatch) => {
  dispatch({
    type: "FETCH_CODES_START",
  });
  axios
    .get(`./../api/btwcodes/`)
    .then((responseObj) => {
      console.log(responseObj.data.data);
      dispatch({
        type: "FETCH_CODES_SUCCESS",
        payload: responseObj.data.data,
      });
    })
    .catch((error) => {
      console.log(error);
      dispatch({
        type: "FETCH_CODES_FAIL",
      });
    });
};

export const deleteCodes = (id) => (dispatch) => {
  axios
    .delete(`./../api/btwcode/${id}`)
    .then((responseObj) => {
      console.log(responseObj);
      dispatch(getCodes());
    })
    .catch((error) => console.log(error));
};

export const postCodes = (code, land) => (dispatch) => {
  const params = new URLSearchParams();
  params.append("code", code);
  params.append("land", land);
  axios
    .post(`./../api/btwcodes/`, params)
    .then((responseObj) => {
      console.log(responseObj);
      dispatch(getCodes());
    })
    .catch((error) => console.log(error));
};

export default reducer;
