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

export default reducer;
