/* eslint-disable react/prop-types */
import React from 'react';
import PropTypes from 'prop-types';
import { Route, Redirect } from 'react-router-dom';
import { connect } from 'react-redux';

function PrivateRoute({ component: WrappedComponent, isAuthenticated, ...others }) {
  return (
    <Route
      {...others}
      render={props =>
        (isAuthenticated ? (
          <WrappedComponent {...props} />
        ) : (
          <Redirect
            to={{
              pathname: '/login',
              state: { from: props.location },
            }}
          />
        ))
      }
    />
  );
}

const mapStateToProps = state => ({
  isAuthenticated: state.auth.user !== null,
});

PrivateRoute.propTypes = {
  isAuthenticated: PropTypes.bool,
};

export default connect(
  mapStateToProps,
  null,
)(PrivateRoute);
