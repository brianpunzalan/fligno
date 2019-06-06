import React from 'react';
import { Route, Switch } from 'react-router-dom';
import LoginContainer from './containers/LoginContainer';
import Dashboard from './components/Dashboard';
import PrivateRoute from './decorators/route/private';
import GuestRoute from './decorators/route/guest';
import NotFound from './components/NotFound';

const App = () => {
  return (
    <Switch>
      <GuestRoute path="/login" component={LoginContainer} />
      <PrivateRoute path="/dashboard" component={Dashboard} />
      <GuestRoute path="/" exact component={LoginContainer} />
      <Route component={NotFound} />
    </Switch>
  );
};

export default App;
