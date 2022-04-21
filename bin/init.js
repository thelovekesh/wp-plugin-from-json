const path = require('path');
const wpJSON = require('../wp.json');
const Mustache = require( 'mustache' );

const {
	name,
	pluginDirName,
	pluginPath,
	pluginMainFile,
	pluginPackage,
	pluginHeaderFields
} = wpJSON;

/**
 * Generate Plugin Info from Plugin Name
 *
 * @param {string} pluginName
 */
const generatePluginInfo = ( pluginName ) => {
	const pluginNameLowerCase = pluginName.toLowerCase();

	const kebabCase = pluginName.replace( /\s+/g, '-' ).toLowerCase();
	const packageName = `rtcamp/${ kebabCase }`;
	const snakeCase = kebabCase.replace( /\-/g, '_' );
	const kebabCaseWithHyphenSuffix = kebabCase + '-';
	const snakeCaseWithUnderscoreSuffix = snakeCase + '_';

	const trainCase = kebabCase.replace( /\b\w/g, ( l ) => {
		return l.toUpperCase();
	} );
	const pluginNameTrainCase = trainCase.replace( /\-/g, ' ' );
	const pascalSnakeCase = trainCase.replace( /\-/g, '_' );
	const trainCaseWithHyphenSuffix = trainCase + '-';
	const pascalSnakeCaseWithUnderscoreSuffix = pascalSnakeCase + '_';

	const cobolCase = kebabCase.toUpperCase();
	const pluginNameCobolCase = pluginNameTrainCase.toUpperCase();
	const macroCase = snakeCase.toUpperCase();
	const cobolCaseWithHyphenSuffix = cobolCase + '-';
	const macroCaseWithUnderscoreSuffix = macroCase + '_';

	return {
		pluginName,
		packageName,
		pluginNameLowerCase,
		kebabCase,
		snakeCase,
		kebabCaseWithHyphenSuffix,
		snakeCaseWithUnderscoreSuffix,
		trainCase,
		pluginNameTrainCase,
		pascalSnakeCase,
		trainCaseWithHyphenSuffix,
		pascalSnakeCaseWithUnderscoreSuffix,
		cobolCase,
		pluginNameCobolCase,
		macroCase,
		cobolCaseWithHyphenSuffix,
		macroCaseWithUnderscoreSuffix,
	};
};

console.log(generatePluginInfo(name));
