import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Cropper from 'react-cropper';
import { Button } from 'reactstrap';
import 'cropperjs/dist/cropper.css';

export default class Avatar extends Component {
		constructor(props) {
			super(props);
			this.state = {
				previewFile: '',
				canvasFile: '',
				cropped: false,
				cropX: '',
				cropY: '',
				cropWidth: '',
				cropHeight: ''
			}

			this.inputFile = React.createRef();
			this.cropper = React.createRef();
			this.handleChange = this.handleChange.bind(this);
			this.handleSave = this.handleSave.bind(this);
			this.handleCancel = this.handleCancel.bind(this);
		}

		handleChange(e) {
			const fileReader = new FileReader();
			const file = e.target.files[0];

			fileReader.readAsDataURL(file);
			fileReader.addEventListener("load", (e) => {
				this.setState({
					canvasFile: fileReader.result
				});
			});
		}

		handleSave() {
			this.setState({ 
				canvasFile: '',
				previewFile: this.cropper.current.cropper.getCroppedCanvas().toDataURL(),
				cropX: this.cropper.current.cropper.getData().x,
				cropY: this.cropper.current.cropper.getData().y,
				cropWidth: this.cropper.current.cropper.getData().width,
				cropHeight: this.cropper.current.cropper.getData().height,
				cropped: true 
			});
		}

		handleCancel() {
			this.inputFile.current.value = "";
			this.setState({
				previewFile: '', 
				canvasFile: '', 
				cropped: false,
				cropX: '',
				cropY: '',
				cropWidth: '',
				cropHeight: ''
			});
		}

		componentDidMount() {
			this.inputFile.current.addEventListener('change', this.handleChange);
		}

    render() {
				console.log(this.state);
				const hideInputFile = this.state.canvasFile !== '' || this.state.previewFile !== '';
        return (
					<div className="avatar-cropper">
						{
							hideInputFile &&
							<div className="mb-2">
								{
									!this.state.cropped ? 
										<div className="cropper-container">
											<Cropper
												ref={this.cropper}
												src={this.state.canvasFile}
												style={{height: 400, width: '100%'}}
												aspectRatio={1 / 1}
												guides={true}
											/>
											<Button onClick={this.handleSave} color="primary">Save</Button>
											<Button onClick={this.handleCancel} color="primary">Cancel</Button>
										</div>
									:
										<div className="preview-container">
											<img src={this.state.previewFile} alt="Cropped Photo" />
											<Button onClick={this.handleCancel} color="primary">Cancel</Button>
										</div>
								}
							</div>
						}
						<div className={`form-group ${hideInputFile ? 'd-none' : 'd-block'}`}>
							<label htmlFor="avatarFile">Avatar</label>
							<input type="file" ref={this.inputFile} accept="image/png, image/jpg, image/jpeg" className="form-control-file" id="avatarFile" name="avatar" required />
							<input type="hidden" value={this.state.cropX} name="avatar_crop_x" />
							<input type="hidden" value={this.state.cropY} name="avatar_crop_y" />
							<input type="hidden" value={this.state.cropWidth} name="avatar_crop_width" />
							<input type="hidden" value={this.state.cropHeight} name="avatar_crop_height" />
						</div>
					</div>
        );
    }
}

if (document.getElementById('avatar')) {
    ReactDOM.render(<Avatar />, document.getElementById('avatar'));
}
