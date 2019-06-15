import React from 'react';

export default class Editable extends React.Component {
	constructor(props) {
		super(props)
		this.state = {
			editMode: false,
			data: { ...this.props.data }
		}

		this.toggle = this.toggle.bind(this);
		this.save = this.save.bind(this);
		this.cancel = this.cancel.bind(this);
		this.handleChange = this.handleChange.bind(this);
	}

	toggle() {
		this.setState(function (state) { 
			return { editMode: !state.editMode }
		});
	}

	save() {
		this.props.onSave({ ...this.state.data });
		this.setState({ editMode: false });
	}

	cancel() {
		this.setState({
			editMode: false,
			data: { ...this.props.data }
		})
	}

	handleChange(e) {
		if (e.target.type !== 'file') {
			const field = { [e.target.name]: e.target.value };
			this.setState(state => {
				return {
					data: {
						...state.data,
						...field
					}
				}
			});
		} else {
			const fieldName = e.target.name;
			const file = e.target.files[0];
			const fileReader = new FileReader();

			fileReader.readAsDataURL(file);
			fileReader.addEventListener("load", (e) => {
				this.setState(state => {
					return {
						data: {
							...state.data,
							[fieldName]: fileReader.result
						}
					}
				});
			});
		}
	}

	render() {
		if (!this.props.auth) {
			return this.props.renderViewMode(this.state.data)
		}
	
		if (this.state.editMode) {
			return (
				<div className="editable">
					{ this.props.renderEditMode({ handleChange: this.handleChange, ...this.state.data }) }
					<div className="action-icons">
						<i className="fa fa-check" aria-hidden="true" onClick={this.save}></i>
						<i className="fa fa-times" aria-hidden="true" onClick={this.cancel}></i>
					</div>
				</div>
			)
		} else {
			return (
				<div className="editable">
					{ this.props.renderViewMode({ ...this.state.data }) }
					<div className="action-icons">
						<i className="fa fa-pencil" aria-hidden="true" onClick={this.toggle}></i>
					</div>
				</div>
			)
		}
	}
}