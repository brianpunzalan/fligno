import { call, takeEvery, put } from 'redux-saga/effects';
import { push } from 'connected-react-router';
import { signIn } from '../services/auth';
import authActions from '../actions/authActions';
import { LOGIN } from '../actions/authActionTypes';

function* login(action) {
  try {
    console.log('login', action);
    const user = yield call(signIn, action.payload);
    if (user) {
      yield put(authActions.loginSuccess(user));
      yield put(push('/dashboard'));
    } else {
      yield put(push('/login'));
    }
  } catch (e) {
    console.log('error! ', e);
  }
}

function* authSagas() {
  yield takeEvery(LOGIN, login);
}

export default authSagas;
