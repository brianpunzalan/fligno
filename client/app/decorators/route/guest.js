/* eslint-disable react/prop-types */
import React from 'react';
import PropTypes from 'prop-types';
import { Route, Redirect } from 'react-router-dom';
import { connect } from 'react-redux';

function GuestRoute({ component: WrappedComponent, isAuthenticated, ...others }) {
  return (
    <Route
      {...others}
      render={props =>
        (isAuthenticated ? (
          <Redirect
            to={{
              pathname: '/dashboard',
              state: { from: props.location },
            }}
          />
        ) : (
          <WrappedComponent {...props} />
        ))
      }
    />
  );
}

const mapStateToProps = state => ({
  isAuthenticated: state.auth.user !== null,
});

GuestRoute.propTypes = {
  isAuthenticated: PropTypes.bool,
};

export default connect(
  mapStateToProps,
  null,
)(GuestRoute);
