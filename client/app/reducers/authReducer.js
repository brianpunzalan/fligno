import { handleActions } from 'redux-actions';
import * as actionTypes from '../actions/authActionTypes';

const initialState = {
  user: null,
  loading: false,
};

const authReducer = handleActions(
  {
    [actionTypes.LOGIN](state) {
      return {
        ...state,
        loading: true,
      };
    },
    [actionTypes.LOGIN_SUCCESS](state, action) {
      return {
        ...state,
        user: { ...action.payload },
        loading: false,
      };
    },
  },
  initialState,
);

export default authReducer;
