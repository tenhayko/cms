import React, {Component} from 'react';
import {Route, Switch} from 'react-router-dom';
import Home from "./pages/Home";
import About from "./pages/About";
import Topic from "./pages/Topic";
import Product from "./pages/Product";
import FileManager from "./pages/FileManager";

class RouterPath extends Component {
    render() {
        return (
            <main>
                <Switch>
                    <Route exact path='/' component={Home}/>
                    <Route exact path='/about' component={About}/>
                    <Route exact path='/product' component={Product}/>
                    <Route exact path='/topic' component={Topic}/>
                    <Route exact path='/file-manager' component={FileManager}/>
                </Switch>
            </main>
        )
    }
}

export default RouterPath