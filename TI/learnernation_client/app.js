// module includes
var express = require('express')
, path = require('path')
//, favicon = require('serve-favicon')
, cookieParser = require('cookie-parser')
, bodyParser = require('body-parser')
, logger = require('morgan')
, basicAuth = require('basic-auth')
, config = require('./config')
, variables = require('./vars')
, app = express();

/*
app.all("*", function (req, res, next) {
		res.header("Access-Control-Allow-Origin", "*");
		res.header("Access-Control-Allow-Headers", "Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With");
		res.header("Access-Control-Allow-Methods", "GET, PUT, POST");
		res.header("X-CORS-Ender", "true")
		return next();
});
*/

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'jade');

variables.all(app)
console.log(app.locals);

app.use(function (req, res, next) {
	res.locals.title = app.locals.meta.title;
	res.locals.description = app.locals.meta.description;
	res.locals.keywords = app.locals.meta.keywords;
	next();
})

// https redirect
function requireHTTPS(req, res, next) {
	if (req.get('x-site-deployment-id') && !req.get('x-arr-ssl')) {
		return res.redirect('https://' + req.get('host') + req.url);
	}
	next();
}
app.use(requireHTTPS);

app.use(function (req, res, next) {
	function unauthorized(res) {
		res.set('WWW-Authenticate', 'Basic realm=Authorization Required');
		return res.send(401);
	};

	if (config.nodeEnv == "demo-azure") {
		var user = basicAuth(req);

		if (!user || !user.name || !user.pass) {
			return unauthorized(res);
		};

		if (user.name === 'impactly' && user.pass === 'imp@ctly2015') {
			return next();
		} else {
			return unauthorized(res);
		};
	} else {
		return next();
	}
});

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());

// sass parsing
app.use(require('node-sass-middleware')({
	src: path.join(__dirname, 'public'),
	dest: path.join(__dirname, 'public'),
	indentedSyntax: true,
	sourceMap: true
}));



// static content routes
app.use(express.static(path.join(__dirname, 'public')));
app.use("/bower_components", express.static(path.join(__dirname, "bower_components")));

// route includes
var routes = require('./routes/index');
var apps = require('./routes/apps');
var score = require('./routes/score');

// main page route
app.get('/', routes.index);

// page template routes
app.get('/login', routes.login);
app.get('/account', routes.account);
app.get('/connecting', routes.connecting);
app.get('/apps/connect', apps.appconnect);
app.get('/home', routes.home);
app.get('/courses', routes.courses);
app.get('/privacy', routes.privacy);
app.get('/terms', routes.terms);
app.get('/help', routes.help);
app.get('/about', routes.about);
app.get('/science', routes.science);
app.get('/notify', routes.notify);
app.get('/welcome', routes.welcome);
app.get('/request', routes.request);
app.get('/api', routes.api);
app.get('/upgrade', routes.upgrade);
app.get('/apps/index', apps.index);
app.get('/score', score.index);
app.get('/score/index', score.index);
app.get('/score/person', score.person);
app.get('/score/slider', score.slider);
app.get('/score/suggestions', score.suggestions);
app.get('/score/new', score.new);

app.get('/*', function(req, res) {
  // AJAX requests are aren't expected to be redirected to the AngularJS app
  if (req.xhr) {
		var err = new Error('Not Found');
		err.status = 404;
    return res.status(err.status).send(req.url + err);
  }

  // `sendfile` requires the safe, resolved path to your AngularJS app
  res.sendfile(path.resolve(__dirname + '/'));
});

// catch 404 and forward to error handler
app.use("*", function(req, res, next) {
	var err = new Error('Not Found');
	err.status = 404;
	next(err);
});


// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
	app.use(function(err, req, res, next) {
		res.status(err.status || 500);
		res.render('error', {
			message: err.message,
			error: err
		});
	});
}


// production error handler
// no stacktraces leaked to user
app.use(function(err, req, res, next) {
	res.status(err.status || 500);
	res.render('error', {
		message: err.message,
		error: err
	});
});

module.exports = app;
