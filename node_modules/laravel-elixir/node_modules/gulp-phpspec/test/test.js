/*jshint node:true */
/*jslint node:true */
/*global require */
/*global describe */
/*global it */

'use strict';

var phpspec = require('../');

var should  = require('should');
var assert  = require('chai').assert;
//var expect  = require('chai').expect;

// LOAD TEST LIBRARY
// =============================================================================
// just in case we dont have it installed globally, need to load it here
require('mocha');

// TEST PLUGIN
// =============================================================================
// TODO: Add more tests
// more tests will be added here as we flush out the upgrade

describe('gulp-phpspec', function() {

		it('should not error if no parameters passed', function(done) {

			var caughtErr;

			try {
				phpspec();
			} catch (err) {
				caughtErr = err;
			}

			assert.notOk(caughtErr);
			should.not.exist(caughtErr);

			//caughtErr.message.indexOf('required').should.be.above(-1);
			done();
		});

		it('should throw error if object passed as first parameter', function(done){

			// arrange
			var caughtErr;

			// act
			try {
				phpspec({debug: true});
			} catch (err) {
				caughtErr = err;
			}

			// assert
			should.exist(caughtErr);
			caughtErr.message.should.equal('Invalid PHPSpec Binary');

			done();

		});

		it('should test dryRun [*** for testing only ***]', function(done){

			var caughtErr;
			var result = '';
			var options = {dryRun: true, testing: true};

			try {
				result = phpspec('',options);
			} catch (err) {
				caughtErr = err;
			}

			should.not.exist(caughtErr);
			assert(result);

			//console.log('message', caughtErr);
			//caughtErr.message.should.equal('Invalid PHPSpec Binary');

			done();

		});

});
