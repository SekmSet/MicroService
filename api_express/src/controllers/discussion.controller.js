const {
  Discussion,
  Validate,
  ValidateMessage,
} = require("../models/discussion.model");

exports.getDiscussion = async (req, res) => {
  const _id = req.params.id;

  try {
    const discussions = await Discussion.findOne({ _id });
    res.json(discussions);
  } catch (e) {
    return res.status(400).json({ error: "la discussion n'existe pas" });
  }
};

exports.getDiscussions = async (req, res) => {
  const discussions = await Discussion.find();
  res.json(discussions);
};

exports.createDiscussion = async (req, res) => {
  const { error } = Validate(req.body);

  if (error) {
    return res.status(400).json({ error: error.details[0].message });
  }

  const discussionNew = new Discussion({
    room: req.body.room,
    message: [],
  });

  await discussionNew.save();

  res.json(discussionNew);
};

exports.addMessageToDiscussion = async (req, res) => {
  const _id = req.params.id;
  const { error } = ValidateMessage(req.body);

  if (error) {
    return res.status(400).json({ error: error.details[0].message });
  }

  const discussion = await Discussion.findOne({ _id });
  if (!discussion) {
    return res.status(400).json({ error: "la discussion n'existe pas" });
  }

  discussion.messages.push(req.body);

  await discussion.save();
  res.json("nouveau message envoyé");
};

exports.deleteMessageToDiscussion = async (req, res) => {
  const _idRoom = req.params.id_room;
  const _idMessage = parseInt(req.params.id_message);
  const discussion = await Discussion.findOne({ _id: _idRoom });

  if (!discussion) {
    return res
      .status(400)
      .json({ error: "la discussion ou le message n'existe pas" });
  }

  discussion.messages = discussion.messages.filter(
    (message) => _idMessage !== parseInt(message.id_messages)
  );
  await discussion.save();

  res.json("Message Supprimé");
};

exports.deleteDiscussion = async (req, res) => {
  const _idRoom = req.params.id_room;
  const discussion = await Discussion.find({ _id: _idRoom });

  if (!discussion) {
    return res.status(400).json({ error: "la discussion n'existe pas" });
  }

  await Discussion.findOneAndDelete({ _id: _idRoom });

  res.json("Discussion Supprimé");
};
