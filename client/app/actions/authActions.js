import { createActions } from 'redux-actions';
import * as authActionTypes from './authActionTypes';

const actionTypes = createActions({}, ...Object.values(authActionTypes));
export default actionTypes;
