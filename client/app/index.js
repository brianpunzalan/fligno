import 'index.scss';
import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware, compose } from 'redux';
import { routerMiddleware, ConnectedRouter } from 'connected-react-router';
import { createBrowserHistory } from 'history';
import createSagaMiddleware from 'redux-saga';
import createRootReducer from 'reducers';
import sagas from 'sagas';
import App from './App';

const history = createBrowserHistory();
const sagaMiddleware = createSagaMiddleware();
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;
const store = createStore(
  createRootReducer(history),
  composeEnhancers(
    applyMiddleware(
      routerMiddleware(history),
      sagaMiddleware,
    ),
  ),
);

sagaMiddleware.run(sagas);

render(
  <Provider store={store}>
    <ConnectedRouter history={history}>
      <App />
    </ConnectedRouter>
  </Provider>,
  document.getElementById('root'),
);

console.log(store.getState());

store.subscribe(() => {
  console.log(store.getState());
});
