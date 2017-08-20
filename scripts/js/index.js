require('../scss/main.scss');

var $ = require('jquery');
global.jQuery = $;

require('foundation-sites');
require('./scripts.js');
require('jquery-circliful')(window, $);