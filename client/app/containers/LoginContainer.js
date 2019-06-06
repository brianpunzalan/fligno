import React from 'react';
import PropTypes from 'prop-types';
import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';
import authActions from '../actions/authActions';
import SignIn from '../components/SignIn';

class LoginContainer extends React.Component {
  constructor(props) {
    super(props);
    this.handleLogin = this.handleLogin.bind(this);
  }

  handleLogin(email, password) {
    console.log(email, password);
    this.props.login({ email, password });
  }

  render() {
    return (
      <SignIn onSubmit={this.handleLogin} />
    );
  }
}

LoginContainer.propTypes = {
  login: PropTypes.func,
};

const mapDispatchToProps = dispatch =>
  bindActionCreators({
    login: authActions.login,
  }, dispatch);

export default connect(
  null,
  mapDispatchToProps,
)(LoginContainer);
