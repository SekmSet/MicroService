const express = require("express");
const bodyParser = require("body-parser");
const mongoose = require("mongoose");
require("dotenv").config();

const discussion = require("./src/routes/discussion.route");

// init app
const app = express();

// connect MongoDB with mongoose
const mongoDB = process.env.MONGODB_URI;

mongoose.connect(mongoDB, {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});
mongoose.Promise = global.Promise;

const db = mongoose.connection;

db.on("error", console.error.bind(console, "ConnexionerroronMongoDB:"));

// Utilisation de body parser
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.use("/discussion", discussion);

const port = process.env.SERVER_PORT;
app.listen(port, () => {
  console.log("Server running on:" + port);
});
