import React from 'react';
import axios from 'axios';
import ReactDOM from 'react-dom';

// Require Editor JS files.
import 'froala-editor/js/froala_editor.pkgd.min.js';

// Require Editor CSS files.
import 'froala-editor/css/froala_style.min.css';
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Require Font Awesome.
import 'font-awesome/css/font-awesome.css';

import FroalaEditor from 'react-froala-wysiwyg';
/*
 * FroalaEditor
 * Can phai xu ly them ve image manager
 * https://www.froala.com/wysiwyg-editor/docs/concepts/image/manager
 */
const config = {
    charCounterCount: false,
    /* Image Manager */
    // Set the load images request URL.
    imageManagerLoadURL: '/image/manager',
    // Set the load images request type.
    imageManagerLoadMethod: "GET",
    // Set page size.
    imageManagerPageSize: 20,
    // Set a scroll offset (value in pixels).
    imageManagerScrollOffset: 10,
    // Set the delete image request URL.
    imageManagerDeleteURL: "image/manager/delete",
    // Set the delete image request type.
    imageManagerDeleteMethod: "DELETE",
    /* End Image Manager*/
    imageUploadURL: '/image/upload',
    requestHeaders:{
        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
    },
    imageUploadMethod: 'POST',
    events: {
        'froalaEditor.image.uploaded': (e, editor, response) => {
            response = JSON.parse(response);
            editor.image.insert(response.secure_url, true, null, editor.image.get(), null)
            return false
        },
        'froalaEditor.image.removed': (e, editor, $img) => {
            let data = {
              url : $img.attr('src'),
              data : $img.data()
            }
            axios.post('/image/delete', data).then(response => {});
            return false
        }
    }
}
class EditorComponent extends React.Component {
  constructor () {
    super();
    this.handleModelChange = this.handleModelChange.bind(this);
    this.state = {
      model: 'Example text'
    };
  }

  handleModelChange(model) {
    this.setState({
      model: model
    });
  }

  render () {
    return <FroalaEditor
            config={config}
            model={this.state.model}
            onModelChange={this.handleModelChange}
           />
  }
}
if (document.getElementById('editor')) {
    ReactDOM.render(<EditorComponent />, document.getElementById('editor'));
}
