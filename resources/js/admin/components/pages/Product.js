import axios from 'axios';
import ReactDOM from 'react-dom';
import React, {Component} from 'react';
import FormError from './../form/FormError';
import validateInput from './../form/Validate';
import 'react-toastify/dist/ReactToastify.css';
import { ToastContainer, toast } from 'react-toastify';
import { Button, ButtonToolbar, Modal } from 'react-bootstrap';

class Product extends Component {
    constructor(props) {
        super(props);
        this.state =    {
                            value: '', 
                            products: '', 
                            show: false,
                            phonenumber: {
                                value: '',
                                errorMessage: ''
                            },
                            fullname: {
                                value : '',
                                errorMessage: ''
                            }
                        };
        this.handleClose = this.handleClose.bind(this);
        this.handleShow = this.handleShow.bind(this);
        this.handleSave = this.handleSave.bind(this);
        this.handleInput = this.handleInput.bind(this);
        this.handleInputValidation = this.handleInputValidation.bind(this);
    }
    componentDidMount() {
        axios.get('/products')
            .then(response => {
                this.setState({ products: response.data });
            })
            .catch(function (error) {
                console.log(error);
            })
    }
    handleClose () {
        this.setState({ 
            show: false
        });
    }
    handleShow() {
        this.setState({ 
            show: true
        });
    }
    handleInput(event) {
        const { name, value } = event.target;
        const newState = {...this.state[name]}; /* dummy object */
        newState.value = value;
        this.setState({[name]: newState});
    }

    handleInputValidation(event) {
        const { name } = event.target;
        const {errorMessage } = validateInput(name, this.state[name].value);
        const newState = {...this.state[name]}; /* dummy object */
        newState.errorMessage = errorMessage;
        this.setState({[name]: newState})
    }
    handleSave() {
        validateInput('123124');
        toast("Default Notification !");
        this.setState({ 
            show: false
        });
    }
    tabRow() {
        if(this.state.products instanceof Array){
            return this.state.products.map(function(object, i){
                return (
                    <tr key={i}>
                        <td>
                            { i }
                        </td>
                        <td>
                            { object.title }
                        </td>
                        <td>
                            { object.body }
                        </td>
                        <td>
                            <form>
                                <input type="submit" value="Edit" className="btn btn-success"/>
                            </form>
                        </td>
                    </tr>
                );
            })
        }
    }

    render() {
        return (
            <div>
                <h1>Products List - Demo</h1>
              <Modal show={this.state.show} onHide={this.handleClose}>
                <Modal.Header closeButton>
                  <Modal.Title>Modal heading</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <input
                        name="fullname"
                        onChange={this.handleInput}
                        onBlur={this.handleInputValidation} />
                    <FormError
                        type="fullname"
                        errorMessage={this.state.fullname.errorMessage} />
                    <input
                        name="phonenumber"
                        onChange={this.handleInput}
                        onBlur={this.handleInputValidation} />
                    <FormError
                        type="phonenumber"
                        errorMessage={this.state.phonenumber.errorMessage} />
                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={this.handleClose}>
                    Close
                  </Button>
                  <Button variant="primary" onClick={this.handleSave}>
                    Save Changes
                  </Button>
                </Modal.Footer>
              </Modal>
              <ToastContainer />
                <div className="row">
                    <div className="col-md-10"></div>
                    <div className="col-md-2">
                        <Button  className="btn btn-success btn-sm" variant="primary" onClick={this.handleShow}>
                        Add Product
                      </Button>
                    </div>
                    </div><br />
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Product Title</td>
                        <td>Product Body</td>
                        <td width="200px">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                        { this.tabRow() }
                    </tbody>
                </table>
            </div>
        )
    }
}

export default Product