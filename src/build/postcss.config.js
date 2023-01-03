'use strict';

const process = require( 'process' );

const colors = [
	'blue',
	'indigo',
	'purple',
	'pink',
	'red',
	'orange',
	'yellow',
	'green',
	'teal',
	'cyan',
	'white',
	'gray',
	'gray-dark',
];

module.exports = ( ctx ) => {
	return {
		map: {
			inline: false,
			annotation: true,
			sourcesContent: true,
		},
		plugins: {
			autoprefixer: {
				cascade: false,
				env: 'bs5',
			},
			'postcss-tracomme2023-palette-generator': {
				colors: colors.map( ( x ) => `--${ 'bs-' }${ x }` ),
			},
		},
	};
};
