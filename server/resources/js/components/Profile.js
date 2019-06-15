import React from 'react';
import ReactDOM from 'react-dom';
import { Container, Row, Col, Jumbotron } from 'reactstrap';
import Editable from './containers/Editable';
import Avatar from './fields/Avatar';

export default class Profile extends React.Component {
	constructor(props) {
		super(props)
		this.state = {
			first_name: props.first_name,
			last_name: props.last_name,
			email: props.email,
			description: props.description,
			editMode: props.auth ? true : false,
		}

		this.toggleMode = this.toggleMode.bind(this);
		this.handleChange = this.handleChange.bind(this);
		this.update = this.update.bind(this);
	}

	toggleMode(e) {
		this.setState(function (state) {
			return { editMode: !state.editMode }
		})
	}

	handleChange(e) {
		this.setState({ [e.target.name]: e.target.value })
	}

	update(data) {
		this.setState({ ...data });
	}

	render() {
		console.log('PROFILE state', this.state);
		console.log('PROFILE props', this.props);
		return (
			<Container fluid>
				<Row>
					<Col sm="12" md="4" className="border-right">
						<Container>
							<img className="img-thumbnail rounded-circle mt-5 mx-auto d-block" src={this.props.avatar} />
						</Container>
					</Col>
					<Col sm="12" md="8">
						<div className="mt-5 text-center text-md-left">
							<Editable 
								auth={this.props.auth}
								onSave={this.update}
								data={{
									first_name: this.state.first_name,
									last_name: this.state.last_name
								}}
								renderEditMode={props => (
									<div>
										<input type="text" className="display-2 w-100" value={props.first_name} onChange={props.handleChange} name="first_name" />
										<input type="text" className="display-2 w-100" value={props.last_name} onChange={props.handleChange} name="last_name" />
									</div>
								)}
								renderViewMode={props => (
									<h1 className="display-2">{ props.first_name } { props.last_name }</h1>
								)}
							/>
							<div>
								<Editable
									auth={this.props.auth}
									onSave={this.update}
									data={{
										email: this.state.email
									}}
									renderEditMode={props => (
										<input type="email" placeholder="Enter Email Address" value={props.email} onChange={props.handleChange} name="email" />
									)}
									renderViewMode={props => (
										<a href={`mailto:${props.email}`}>
											<i className="fa fa-envelope"></i>
											<span>{ props.email }</span>
										</a>
									)}
								/>
							</div>
							<Jumbotron fluid className="mt-5 p-5">
								<Container>
									<h1 className="display-5">About Me</h1>
									<Editable 
										auth={this.props.auth}
										onSave={this.update}
										data={{
											description: this.state.description
										}}
										renderViewMode={props => (
											<p className="lead">{ props.description }</p>
										)}
										renderEditMode={props => (
											<textarea rows="5" className="form-control w-100" name="description" value={props.description} onChange={props.handleChange} />
										)}
									/>
								</Container>
							</Jumbotron>
						</div>
					</Col>
				</Row>
			</Container>
		)
	}
}

Profile.defaultProps = {
	auth: false,
}

if (document.getElementById('profile')) {
	const domElement = document.getElementById('profile');
	const props = Object.assign({}, domElement.dataset);
	ReactDOM.render(<Profile {...props} />, domElement);
}
