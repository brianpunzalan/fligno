import { call, takeEvery, put } from 'redux-saga/effects';
import { push } from 'connected-react-router';
import { signIn } from '../services/auth';
import { LOGIN } from '../actions/authActionTypes';

function* login(action) {
  try {
    console.log(action);
    const user = yield call(signIn, action.payload);
    if (user) {
      yield put(push('/dashboard'));
    }
  } catch (e) {
    console.log('error! ', e);
  }
}

function* authSagas() {
  yield takeEvery(LOGIN, login);
}

export default authSagas;
