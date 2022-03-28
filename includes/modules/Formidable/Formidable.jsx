// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
// import './style.css';


class DICM_Formidable extends Component {

  static slug = 'dicm_formidable';

  render() {

    return (
      <div>
        <h1>{this.props.heading}</h1>
        <div>
            [formidable id={this.props.formidable_id} title={this.props.title} description={this.props.description} ]
        </div>
      </div>
    );
  }
}

export default DICM_Formidable;
