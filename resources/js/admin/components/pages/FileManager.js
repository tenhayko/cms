import React, {Component} from 'react';
import axios, { post } from 'axios';
import 'react-toastify/dist/ReactToastify.css';
import { ToastContainer, toast } from 'react-toastify';
import Image from 'react-bootstrap/Image';
import { Container, Row, Col } from 'react-bootstrap';

class FileManager extends Component {
	constructor(props) {
			super(props);
			this.state ={
				image: '',
				selectedFile: null
			}
			this.onFormSubmit = this.onFormSubmit.bind(this)
			this.onChange = this.onChange.bind(this)
			this.fileUpload = this.fileUpload.bind(this)
		}
		onFormSubmit(e){
			e.preventDefault() 
			this.fileUpload();
		}
		onChange(e) {
			let files = e.target.files || e.dataTransfer.files;
			if (!files.length)
						return;
			this.setState({
				selectedFile: files[0]
			})
			this.createImage(files[0]);
		}
		createImage(file) {
			let reader = new FileReader();
			reader.onload = (e) => {
				this.setState({
					image: e.target.result
				})
			};
			reader.readAsDataURL(file);
		}
		fileUpload(){
			const url = '/image/fileupload';
			console.log(url);
			const data = new FormData();
			let toastId = null;
			data.append('file', this.state.selectedFile)
			data.append('image', this.state.image)
			axios.request({
							method: "post", 
							url: url, 
							data: data,
							onUploadProgress: p => {
								const progress = p.loaded / p.total;
								// check if we already displayed a toast
								if(toastId === null){
									// toastId = toast('Upload in Progress', {
									//   progress: progress
									// });
								} else {
									// toast.update(toastId, {
									//   progress: progress
									// })
								}
							}
						})
						.then(response => {
							// toast.done(toastId);
							toast("Default Notification !");
							console.log(response);
						})
						.catch(function (error) {
								console.log(error);
						});
		}
		render() {
				return (
					<div>
						<ToastContainer />
						<form onSubmit={this.onFormSubmit}>
							<label htmlFor="imageUpload">Brow
								<input style={{'display':'none'}} id="imageUpload" type="file"  onChange={this.onChange} />
							</label>
							<button type="submit">Upload</button>
						</form>
						<Container>
						  <Row className="mb-md-3">
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						  </Row>
						  <Row className="mb-md-3">
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						  </Row>
						  <Row className="mb-md-3">
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						    <Col className="text-center" xs={6} md={3}>
						      <Image src="/storage/profile_images/thumbnail/503422289518819916825328410311436114329600n-1551159734309126081543_medium_1569838511.jpg" rounded />
						    </Col>
						  </Row>
						</Container>
					</div>
				)
		}
}

export default FileManager