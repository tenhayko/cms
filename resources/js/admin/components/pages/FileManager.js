import React, {Component} from 'react';
import axios, { post } from 'axios';
import 'react-toastify/dist/ReactToastify.css';
import { ToastContainer, toast } from 'react-toastify';

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
        return (<div>
            <ToastContainer />
            <h1>Welcome to FileManager!</h1>
            <form onSubmit={this.onFormSubmit}>
		        <h1>React js Laravel File Upload Tutorial</h1>
		        <input type="file"  onChange={this.onChange} />
		        <button type="submit">Upload</button>
		    </form>
        </div>)
    }
}

export default FileManager