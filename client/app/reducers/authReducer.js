import { handleActions } from 'redux-actions';
import * as actionTypes from '../actions/authActionTypes';

const initialState = {
  user: null,
};

const authReducer = handleActions(
  {
    [actionTypes.LOGIN](state, action) {
      return { ...state, ...action.payload };
    },
  },
  initialState,
);

export default authReducer;
