const createError = require('http-errors');
const express = require('express');
const session = require('express-session');
const path = require('path');
const cookieParser = require('cookie-parser');
const logger = require('morgan');

const indexRouter = require('./routes/index');
const registerRouter = require('./routes/register');
const connectRouter = require('./routes/connect');
const panelRouter = require('./routes/panel');
const editRouter = require('./routes/edit');
const disconnectRouter = require('./routes/disconnect');
const activitiesRouter = require('./routes/activities');
const uploadRouter = require('./routes/upload');
const aproposRouter = require('./routes/apropos');

const app = express();

// Setup session
app.use(session({
  secret: 'amogus',
  resave: false,
  saveUninitialized: false
}));

// View engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

// Routes
app.use('/', indexRouter);
app.use('/register', registerRouter);
app.use('/connect', connectRouter);
app.use('/panel', panelRouter);
app.use('/edit', editRouter);
app.use('/disconnect', disconnectRouter);
app.use('/activities', activitiesRouter);
app.use('/upload', uploadRouter);
app.use('/apropos', aproposRouter);

// Catch 404 and forward to error handler
app.use((req, res, next) => {
  next(createError(404));
});

// Error handler
app.use((err, req, res, next) => {
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};
  res.status(err.status || 500);
  res.render('error_page');
});

module.exports = app;
