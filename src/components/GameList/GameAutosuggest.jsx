import React, { Component } from 'react';
import { ENDPOINTS, fetchTwitchEndpoint } from '../../utilities';
import Autosuggest from 'react-autosuggest';
import { ReactComponent as Search } from '../../icons/magnifying-glass.svg';
import debounce from 'lodash/debounce';

const getSuggestionValue = suggestion => suggestion.name;

const renderSuggestion = suggestion => (
  <a href={"/games/"+suggestion.name}>{suggestion.name}</a>
);

const renderInputComponent = inputProps => (
  <React.Fragment>
    <input {...inputProps} />
    <div className="react-autosuggest__input-icon">
      <Search />
    </div>
  </React.Fragment>
)

class GameAutosuggest extends Component {
  constructor(props){
    super(props);
    this.state = {
      value: '',
      suggestions: []
    };
  } 

  handleChange = (event, { newValue }) => {
    this.setState({
      value: newValue
    });
  };

  handleFetchSuggestions = debounce(({ value }) => {
    fetchTwitchEndpoint(ENDPOINTS.GAMES_SEARCH, `?query=${encodeURIComponent(value)}&live=true`)
      .then(data => {
        this.setState({
          suggestions: data.games || []
        });
      });
  }, 350);

  handleClearSuggestions = () => {
    this.setState({
      suggestions: []
    });
  };

  render() {
    const {value,suggestions} = this.state;
    const inputProps = {
      placeholder: 'Search Games...',
      value: value,
      onChange: this.handleChange
    };

    return (
      <Autosuggest
        suggestions={suggestions}
        onSuggestionsFetchRequested={this.handleFetchSuggestions}
        onSuggestionsClearRequested={this.handleClearSuggestions}
        getSuggestionValue={getSuggestionValue}
        renderSuggestion={renderSuggestion}
        renderInputComponent={renderInputComponent}
        inputProps={inputProps}
      ></Autosuggest>
    );
  }
}

export default GameAutosuggest;