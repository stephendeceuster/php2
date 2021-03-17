import {createStore, applyMiddleware, combineReducers} from 'redux';
import logger from 'redux-logger';
import thunk from 'redux-thunk';

import codesReducer from './codes';
import codeReducer from './code';

const rootReducer = combineReducers({
    codesState : codesReducer,
    codeState : codeReducer,
});

const store = createStore(rootReducer, applyMiddleware(logger, thunk));

export default store;